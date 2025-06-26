<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules; // <-- Import untuk validasi password
use App\Models\User;
use App\Models\Role;

class AuthController extends Controller
{
    /**
     * Menampilkan form registrasi.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Memproses data dari form registrasi.
     */
    public function register(Request $request)
    {
        // Validasi input dengan aturan password yang lebih baik
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Membuat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Memberikan role default 'user' ke user baru
        $userRole = Role::where('name', 'user')->first();
        if ($userRole) {
            $user->roles()->attach($userRole);
        }

        // Langsung login setelah registrasi berhasil
        Auth::login($user);

        // Redirect ke halaman home pelanggan
        return redirect()->route('home');
    }

    /**
     * Menampilkan form login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Memproses data login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek role user yang login
            if (Auth::user()->roles()->where('name', 'admin')->exists()) {
                // Jika user adalah admin, redirect ke dashboard admin
                return redirect()->route('admin.dashboard');
            }

            // Jika user biasa, redirect ke halaman home pelanggan
            return redirect()->route('home');
        }

        // Jika gagal, kembali dengan pesan error
        return back()->with('error', 'Login gagal! Email atau password salah.');
    }

    /**
     * Proses Logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/'); // Kembali ke landing page publik setelah logout
    }
}