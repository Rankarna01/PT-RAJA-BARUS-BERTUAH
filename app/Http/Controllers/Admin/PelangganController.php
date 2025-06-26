<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class PelangganController extends Controller
{
    /**
     * Menampilkan daftar semua pelanggan (user dengan role 'user').
     */
    public function index()
    {
        $semua_pelanggan = User::whereHas('roles', function($q){
            $q->where('name', 'user');
        })->latest()->paginate(10);
        
        return view('admin.pelanggan.index', compact('semua_pelanggan'));
    }

    /**
     * Menampilkan form untuk menambah pelanggan baru.
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    /**
     * Menyimpan pelanggan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'username' => 'nullable|string|max:255|unique:users',
            'nomor_telepon' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'username' => $request->username,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat,
        ]);

        $userRole = Role::where('name', 'user')->first();
        if ($userRole) {
            $user->roles()->attach($userRole);
        }

        return redirect()->route('admin.pelanggan.index')->with('success', 'Pelanggan baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data pelanggan.
     */
    public function edit(User $pelanggan)
    {
        return view('admin.pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Memperbarui data pelanggan di database.
     */
    public function update(Request $request, User $pelanggan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $pelanggan->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'username' => 'nullable|string|max:255|unique:users,username,' . $pelanggan->id,
            'nomor_telepon' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        $data = $request->except('password');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $pelanggan->update($data);

        return redirect()->route('admin.pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    /**
     * Menampilkan halaman konfirmasi hapus.
     */
    public function showDeleteConfirmation(User $pelanggan)
    {
        return view('admin.pelanggan.delete', compact('pelanggan'));
    }

    /**
     * Menghapus data pelanggan dari database.
     */
    public function destroy(User $pelanggan)
    {
        if (auth()->user()->id == $pelanggan->id) {
            return redirect()->route('admin.pelanggan.index')->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
        }

        $pelanggan->delete();
        return redirect()->route('admin.pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus.');
    }
}