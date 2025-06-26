<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class KelolaAkunController extends Controller
{
    /**
     * Menampilkan daftar semua akun (admin & pelanggan).
     */
    public function index()
    {
        // Ambil semua user beserta rolenya
        $semua_akun = User::with('roles')->latest()->paginate(10);
        return view('admin.kelola-akun.index', compact('semua_akun'));
    }

    /**
     * Menampilkan form untuk membuat akun baru.
     */
    public function create()
    {
        $roles = Role::all(); // Ambil semua role untuk dropdown
        return view('admin.kelola-akun.create', compact('roles'));
    }

    /**
     * Menyimpan akun baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Berikan role yang dipilih
        $user->roles()->attach($request->role_id);

        return redirect()->route('admin.kelola-akun.index')->with('success', 'Akun baru berhasil dibuat.');
    }

    /**
     * Menampilkan form untuk mengedit akun.
     */
    public function edit(User $kelola_akun) // Variabel harus cocok dengan nama route
    {
        $roles = Role::all();
        $user = $kelola_akun;
        return view('admin.kelola-akun.edit', compact('user', 'roles'));
    }

    /**
     * Memperbarui data akun di database.
     */
    public function update(Request $request, User $kelola_akun)
    {
        $user = $kelola_akun;
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role_id' => 'required|exists:roles,id',
        ]);

        $data = $request->except('password', 'role_id');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        $user->roles()->sync($request->role_id); // sync untuk update role

        return redirect()->route('admin.kelola-akun.index')->with('success', 'Data akun berhasil diperbarui.');
    }
    
    /**
     * Menampilkan halaman konfirmasi hapus.
     */
    public function showDeleteConfirmation(User $kelola_akun)
    {
        $user = $kelola_akun;
        return view('admin.kelola-akun.delete', compact('user'));
    }

    /**
     * Menghapus data akun dari database.
     */
    public function destroy(User $kelola_akun)
    {
        $user = $kelola_akun;
        if (auth()->user()->id == $user->id) {
            return redirect()->route('admin.kelola-akun.index')->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
        }

        $user->delete();
        return redirect()->route('admin.kelola-akun.index')->with('success', 'Akun berhasil dihapus.');
    }
}