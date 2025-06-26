<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JamKeberangkatan;
use Illuminate\Http\Request;

class JamKeberangkatanController extends Controller
{
    public function index()
    {
        // Ambil semua data dan kelompokkan berdasarkan hari
        $semua_jam = JamKeberangkatan::orderBy('jam')->get()->groupBy('hari');
        $daftar_hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        return view('admin.jam_keberangkatan.index', compact('semua_jam', 'daftar_hari'));
    }

    public function create()
    {
        // Tampilkan halaman form tambah data
        $daftar_hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        return view('admin.jam_keberangkatan.create', compact('daftar_hari'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|string',
            'jam' => 'required', // Format H:i
        ]);

        JamKeberangkatan::create($request->all());

        return redirect()->route('admin.jam-keberangkatan.index')->with('success', 'Jam keberangkatan berhasil ditambahkan.');
    }

    public function edit(JamKeberangkatan $jam_keberangkatan)
    {
        // Tampilkan halaman form edit data
        $daftar_hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        return view('admin.jam_keberangkatan.edit', compact('jam_keberangkatan', 'daftar_hari'));
    }

    public function update(Request $request, JamKeberangkatan $jam_keberangkatan)
    {
        $request->validate([
            'hari' => 'required|string',
            'jam' => 'required',
        ]);

        $jam_keberangkatan->update($request->all());

        return redirect()->route('admin.jam-keberangkatan.index')->with('success', 'Jam keberangkatan berhasil diperbarui.');
    }

    public function destroy(JamKeberangkatan $jam_keberangkatan)
    {
        $jam_keberangkatan->delete();
        return redirect()->route('admin.jam-keberangkatan.index')->with('success', 'Jam keberangkatan berhasil dihapus.');
    }
}