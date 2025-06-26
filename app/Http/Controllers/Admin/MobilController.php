<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    public function index()
    {
        $semua_mobil = Mobil::latest()->paginate(10);
        return view('admin.mobil.index', compact('semua_mobil'));
    }

    public function create()
    {
        return view('admin.mobil.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'nomor_polisi' => 'required|string|max:20|unique:mobil',
            'kapasitas' => 'required|integer|min:1',
            'nama_supir' => 'required|string|max:255',
        ]);

        Mobil::create($request->all());

        return redirect()->route('admin.mobil.index')->with('success', 'Data mobil baru berhasil ditambahkan.');
    }

    public function edit(Mobil $mobil)
    {
        return view('admin.mobil.edit', compact('mobil'));
    }

    public function update(Request $request, Mobil $mobil)
    {
        $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'nomor_polisi' => 'required|string|max:20|unique:mobil,nomor_polisi,' . $mobil->id,
            'kapasitas' => 'required|integer|min:1',
            'nama_supir' => 'required|string|max:255',
        ]);

        $mobil->update($request->all());

        return redirect()->route('admin.mobil.index')->with('success', 'Data mobil berhasil diperbarui.');
    }

    public function destroy(Mobil $mobil)
    {
        $mobil->delete();
        return redirect()->route('admin.mobil.index')->with('success', 'Data mobil berhasil dihapus.');
    }
     
    public function showDeleteConfirmation(Mobil $mobil)
    {
        return view('admin.mobil.delete', compact('mobil'));
    }
}