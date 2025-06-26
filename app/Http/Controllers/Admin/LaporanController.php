<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf; // <-- Import library PDF

class LaporanController extends Controller
{
    /**
     * Menampilkan halaman laporan dengan filter.
     */
    public function index(Request $request)
    {
        // Panggil method private untuk mengambil data, agar bisa dipakai ulang untuk cetak PDF
        $data = $this->getLaporanData($request);

        return view('admin.laporan.index', $data);
    }

    /**
     * Membuat dan mengunduh laporan dalam format PDF.
     */
    public function cetakPdf(Request $request)
    {
        // Ambil data yang sama persis dengan filter yang sedang diterapkan
        $data = $this->getLaporanData($request);
        
        // Load view khusus untuk PDF dan kirim datanya
        $pdf = Pdf::loadView('admin.laporan.pdf', $data);

        // Atur nama file PDF
        $namaFile = 'laporan-pendapatan-' . date('Y-m-d') . '.pdf';

        // Download file PDF
        return $pdf->download($namaFile);
    }

    /**
     * Method private untuk mengambil dan memfilter data laporan.
     */
    private function getLaporanData(Request $request)
    {
        // Logika untuk menangani input tahun yang berbeda dari form
        $tahunDariForm = $request->get('tipe') === 'bulanan' ? $request->get('tahun_bulanan') : $request->get('tahun_tahunan');

        $tipeLaporan = $request->get('tipe', 'harian');
        $tanggal = $request->get('tanggal', Carbon::now()->format('Y-m-d'));
        $bulan = $request->get('bulan', Carbon::now()->month);
        $tahun = $request->get('tahun', $tahunDariForm ?? Carbon::now()->year);

        $query = Pemesanan::with('user')->where('status_pembayaran', 'lunas');

        if ($tipeLaporan == 'harian') {
            $query->whereDate('created_at', $tanggal);
        } elseif ($tipeLaporan == 'bulanan') {
            $query->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun);
        } elseif ($tipeLaporan == 'tahunan') {
            $query->whereYear('created_at', $tahun);
        }

        $laporan = $query->latest()->get();
        $totalPendapatan = $laporan->sum('total_pembayaran');

        // Kembalikan semua data dalam bentuk array
        return [
            'laporan' => $laporan,
            'totalPendapatan' => $totalPendapatan,
            'tipeLaporan' => $tipeLaporan,
            'tanggal' => $tanggal,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];
    }
}