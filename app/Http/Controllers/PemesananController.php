<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Perjalanan;
use App\Models\Pemesanan;
use App\Models\PemesananKursi;
use App\Models\RutePerjalanan;
use Midtrans\Config;
use Midtrans\Snap;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PemesananController extends Controller
{
    /**
     * Konstruktor untuk mengatur konfigurasi Midtrans.
     */
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    /**
     * Menampilkan halaman riwayat pemesanan milik pengguna.
     */
    public function index()
    {
        $semua_pemesanan = Auth::user()->pemesanan()
            ->with(['perjalanan.rutePerjalanan', 'perjalanan.mobil', 'kursiDipesan'])
            ->latest()
            ->get();
            
        return view('pelanggan.riwayat_pemesanan', compact('semua_pemesanan'));
    }

    /**
     * Menangani pencarian perjalanan.
     */
    public function cariPerjalanan(Request $request)
    {
        $request->validate([
            'asal' => 'required|string',
            'tujuan' => 'required|string',
            'tanggal' => 'required|date'
        ]);

        $hasil_perjalanan = Perjalanan::with(['mobil', 'rutePerjalanan'])
            ->whereHas('rutePerjalanan', function ($query) use ($request) {
                $query->where('asal', $request->asal)->where('tujuan', $request->tujuan);
            })
            ->whereDate('tanggal_berangkat', $request->tanggal)
            ->where('status', 'Tersedia')
            ->get();

        return view('pelanggan.hasil_pencarian', compact('hasil_perjalanan'));
    }

    /**
     * Menampilkan halaman pemilihan kursi.
     */
    public function pilihKursi(Perjalanan $perjalanan)
    {
        $kursi_dipesan = PemesananKursi::where('perjalanan_id', $perjalanan->id)
                                        ->pluck('nomor_kursi')
                                        ->toArray();
        
        return view('pelanggan.pilih_kursi', compact('perjalanan', 'kursi_dipesan'));
    }

    /**
     * Memproses pemesanan dan menghasilkan token Midtrans.
     */
    public function prosesPemesanan(Request $request)
    {
        $request->validate([
            'perjalanan_id' => 'required|exists:perjalanan,id',
            'nomor_kursi' => 'required|integer',
            'nama_penumpang' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'alamat_jemput' => 'required|string',
        ]);

        $perjalanan = Perjalanan::with(['rutePerjalanan'])->findOrFail($request->perjalanan_id);
        $nomor_kursi_dipilih = $request->nomor_kursi;

        $kursiSudahDipesan = PemesananKursi::where('perjalanan_id', $perjalanan->id)
                                          ->where('nomor_kursi', $nomor_kursi_dipilih)
                                          ->exists();
        if ($kursiSudahDipesan) {
            return back()->with('error', 'Maaf, kursi nomor ' . $nomor_kursi_dipilih . ' baru saja dipesan orang lain. Silakan pilih kursi lain.');
        }

        $pemesanan = Pemesanan::create([
            'nomor_tiket' => 'TRV-' . strtoupper(Str::random(8)),
            'user_id' => Auth::id(),
            'perjalanan_id' => $perjalanan->id,
            'nama_penumpang' => $request->nama_penumpang,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat_jemput' => $request->alamat_jemput,
            'jumlah_kursi' => 1,
            'total_pembayaran' => $perjalanan->rutePerjalanan->harga,
            'status_pembayaran' => 'menunggu',
        ]);
        
        PemesananKursi::create([
            'perjalanan_id' => $perjalanan->id,
            'pemesanan_id' => $pemesanan->id,
            'nomor_kursi' => $nomor_kursi_dipilih,
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $pemesanan->nomor_tiket,
                'gross_amount' => (int) $pemesanan->total_pembayaran,
            ],
            'customer_details' => [
                'first_name' => $pemesanan->nama_penumpang,
                'email' => Auth::user()->email,
                'phone' => $pemesanan->nomor_telepon,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('pelanggan.pembayaran', compact('pemesanan', 'snapToken'));
    }

    /**
     * Mengunduh tiket dalam format PDF.
     */
    public function downloadTiket(Pemesanan $pemesanan)
    {
        $pemesanan->load(['perjalanan.rutePerjalanan', 'perjalanan.mobil', 'kursiDipesan']);
        $qrCode = base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate($pemesanan->nomor_tiket));
        $pdf = Pdf::loadView('pelanggan.tiket', compact('pemesanan', 'qrCode'));
        $namaFile = 'tiket-' . $pemesanan->nomor_tiket . '.pdf';
        return $pdf->stream($namaFile);
    }

    /**
     * HANYA UNTUK TESTING DI LOKAL.
     */
    public function testingUpdateStatus($nomor_tiket)
    {
        $pemesanan = \App\Models\Pemesanan::where('nomor_tiket', $nomor_tiket)->firstOrFail();
        $pemesanan->status_pembayaran = 'lunas';
        $pemesanan->save();
        return redirect()->route('pemesanan.index')->with('success', 'Status untuk tiket ' . $nomor_tiket . ' berhasil diubah menjadi LUNAS.');
    }

    /**
     * HANYA UNTUK TESTING DI LOKAL. Menerima request dari JavaScript.
     */
    public function updateStatusClient(Request $request)
    {
        $request->validate(['order_id' => 'required|string']);
        $pemesanan = \App\Models\Pemesanan::where('nomor_tiket', $request->order_id)->first();
        if ($pemesanan) {
            $pemesanan->status_pembayaran = 'lunas';
            $pemesanan->save();
            return response()->json(['message' => 'Status berhasil diupdate menjadi Lunas.']);
        }
        return response()->json(['message' => 'Pemesanan tidak ditemukan.'], 404);
    }
}