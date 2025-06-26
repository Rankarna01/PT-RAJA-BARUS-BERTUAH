<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    /**
     * Menampilkan daftar semua data pemesanan.
     */
    public function index()
    {
        // Ambil semua data pemesanan dengan relasinya untuk ditampilkan
        $semua_pemesanan = Pemesanan::with(['user', 'perjalanan.mobil', 'perjalanan.rutePerjalanan', 'kursiDipesan'])
                            ->latest()
                            ->paginate(10);
                            
        return view('admin.pemesanan.index', compact('semua_pemesanan'));
    }

    /**
     * Menampilkan detail satu pemesanan.
     */
    public function show(Pemesanan $pemesanan)
    {
        // Eager load relasi untuk memastikan semua data tersedia di view
        $pemesanan->load(['user', 'perjalanan.mobil', 'perjalanan.rutePerjalanan', 'kursiDipesan']);
        return view('admin.pemesanan.show', compact('pemesanan'));
    }

    /**
     * Menghapus data pemesanan.
    //  */
    // public function destroy(Pemesanan $pemesanan)
    // {
    //     // Hapus juga data kursi yang terhubung (opsional, tergantung logika bisnis)
    //     $pemesanan->kursiDipesan()->delete();
    //     $pemesanan->delete();

    //     return redirect()->route('admin.pemesanan.index')->with('success', 'Data pemesanan berhasil dihapus.');
    // }

   
   public function showDeleteConfirmation(Pemesanan $pemesanan)
{
    return view('admin.pemesanan.delete', compact('pemesanan'));
}

    public function destroy(Pemesanan $pemesanan)
    {
        $pemesanan->kursiDipesan()->delete();
        $pemesanan->delete();

        return redirect()->route('admin.pemesanan.index')->with('success', 'Data pemesanan berhasil dihapus.');
    }

    /**
     * Mengupdate status pembayaran dari form di halaman admin.
     */
    public function updateStatus(Request $request, Pemesanan $pemesanan)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:menunggu,lunas,gagal,batal',
        ]);

        $pemesanan->status_pembayaran = $request->status_pembayaran;
        $pemesanan->save();

        return redirect()->back()->with('success', 'Status pembayaran untuk tiket ' . $pemesanan->nomor_tiket . ' berhasil diperbarui.');
    }
}