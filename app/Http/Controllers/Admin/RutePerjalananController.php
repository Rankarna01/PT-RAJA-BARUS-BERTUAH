<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RutePerjalanan;
use Illuminate\Http\Request;

class RutePerjalananController extends Controller
{
    public function index()
    {
        $semua_rute = RutePerjalanan::latest()->paginate(10); // Ambil data, 10 per halaman
        return view('admin.rute.index', compact('semua_rute'));
    }

    public function create()
    {
        return view('admin.rute.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'asal' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
             'harga' => 'required|numeric|min:0',
        ]);

        RutePerjalanan::create($request->all());

        return redirect()->route('admin.rute.index')->with('success', 'Rute baru berhasil ditambahkan.');
    }

    public function edit(RutePerjalanan $rute)
    {
        return view('admin.rute.edit', compact('rute'));
    }

    public function update(Request $request, RutePerjalanan $rute)
    {
        $request->validate([
            'asal' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        $rute->update($request->all());

        return redirect()->route('admin.rute.index')->with('success', 'Rute berhasil diperbarui.');
    }

    public function showDeleteConfirmation(RutePerjalanan $rute)
    {
        // Cukup tampilkan view dan kirim data rute yang akan dihapus
        return view('admin.rute.delete', compact('rute'));
    }

    /**
     * Menghapus data dari database.
     * (Method ini sudah benar dan tidak perlu diubah)
     */
    public function destroy(RutePerjalanan $rute)
    {
        $rute->delete();
        return redirect()->route('admin.rute.index')->with('success', 'Rute berhasil dihapus.');
    }
}