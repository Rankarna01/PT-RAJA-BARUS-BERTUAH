<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perjalanan;
use App\Models\Mobil;
use App\Models\RutePerjalanan;
use Illuminate\Http\Request;

class PerjalananController extends Controller
{
    /**
     * Menampilkan daftar semua perjalanan yang dijadwalkan.
     */
    public function index()
    {
        $semua_perjalanan = Perjalanan::with(['mobil', 'rutePerjalanan'])->latest()->paginate(10);
        return view('admin.perjalanan.index', compact('semua_perjalanan'));
    }

    /**
     * Menampilkan form untuk membuat jadwal perjalanan baru.
     */
    public function create()
    {
        $semua_mobil = Mobil::all();
        $semua_rute = RutePerjalanan::all();
        return view('admin.perjalanan.create', compact('semua_mobil', 'semua_rute'));
    }

    /**
     * Menyimpan jadwal perjalanan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mobil_id' => 'required|exists:mobil,id',
            'rute_perjalanan_id' => 'required|exists:rute_perjalanan,id',
            'tanggal_berangkat' => 'required|date',
            'jam_berangkat' => 'required|date_format:H:i',
        ]);

        Perjalanan::create($request->all());

        return redirect()->route('admin.perjalanan.index')->with('success', 'Penjadwalan perjalanan baru berhasil dibuat.');
    }

    /**
     * Menampilkan form untuk mengedit jadwal perjalanan.
     */
    public function edit(Perjalanan $perjalanan)
    {
        $semua_mobil = Mobil::all();
        $semua_rute = RutePerjalanan::all();
        return view('admin.perjalanan.edit', compact('perjalanan', 'semua_mobil', 'semua_rute'));
    }

    /**
     * Memperbarui data jadwal perjalanan di database.
     */
    public function update(Request $request, Perjalanan $perjalanan)
    {
        $request->validate([
            'mobil_id' => 'required|exists:mobil,id',
            'rute_perjalanan_id' => 'required|exists:rute_perjalanan,id',
            'tanggal_berangkat' => 'required|date',
            'jam_berangkat' => 'required|date_format:H:i',
        ]);

        $perjalanan->update($request->all());

        return redirect()->route('admin.perjalanan.index')->with('success', 'Penjadwalan perjalanan berhasil diperbarui.');
    }

    // ... method hapus dan ubah status lainnya ...
    
    public function showDeleteConfirmation(Perjalanan $perjalanan)
    {
        return view('admin.perjalanan.delete', compact('perjalanan'));
    }
    
    public function destroy(Perjalanan $perjalanan)
    {
        $perjalanan->delete();
        return redirect()->route('admin.perjalanan.index')->with('success', 'Penjadwalan perjalanan berhasil dihapus.');
    }
    
    public function toggleStatus(Perjalanan $perjalanan)
    {
        $perjalanan->status = ($perjalanan->status == 'Tersedia') ? 'Tidak Tersedia' : 'Tersedia';
        $perjalanan->save();
        return redirect()->back()->with('success', 'Status perjalanan berhasil diubah.');
    }
}