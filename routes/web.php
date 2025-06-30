<?php

use Illuminate\Support\Facades\Route;
// --- Pastikan Semua Controller Di-import Di Sini ---
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RutePerjalananController;
use App\Http\Controllers\Admin\MobilController;
use App\Http\Controllers\Admin\PerjalananController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\PemesananController as AdminPemesananController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\Admin\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Route Umum & Autentikasi ---
Route::get('/', [LandingPageController::class, 'index'])->name('landing');
Route::get('/pesan-tiket', [LandingPageController::class, 'showRutePerjalanan'])->name('rutePerjalanan');

// Menjadi seperti ini
// --- GRUP ROUTE UNTUK PELANGGAN YANG SUDAH LOGIN ---
// Middleware ini memastikan hanya user dengan role 'user' yang bisa mengakses
Route::middleware(['auth', 'is.pelanggan'])->group(function () {
    
    Route::get('/home', [LandingPageController::class, 'landingpage'])->name('home');
    Route::get('/dashboard', fn() => redirect()->route('home'))->name('dashboard');

    // === SEMUA ROUTE UNTUK ALUR PEMESANAN PELANGGAN ===
    
    // Route untuk menampilkan halaman Riwayat Transaksi
    Route::get('/tiket-saya', [PemesananController::class, 'index'])->name('pemesanan.index');
    
    // Route untuk pencarian dan pemilihan kursi
    Route::get('/cari-perjalanan', [PemesananController::class, 'cariPerjalanan'])->name('pemesanan.cari');
    Route::get('/pesan/perjalanan/{perjalanan}', [PemesananController::class, 'pilihKursi'])->name('pemesanan.pilihKursi');
    
    // Route untuk memproses pemesanan ke Midtrans
    Route::post('/pesan/proses', [PemesananController::class, 'prosesPemesanan'])->name('pemesanan.proses');
    
    // Route untuk download tiket
    Route::get('/tiket/{pemesanan}/download', [PemesananController::class, 'downloadTiket'])->name('pemesanan.downloadTiket');
    Route::post('/pemesanan/update-status-client', [PemesananController::class, 'updateStatusClient'])->name('pemesanan.updateStatusClient');
    // Route untuk testing di lokal (HAPUS SEBELUM DEPLOY)
    Route::get('/testing/update-status/{nomor_tiket}', [PemesananController::class, 'testingUpdateStatus'])->name('testing.updateStatus');

});
Route::controller(AuthController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        // Route untuk menampilkan form registrasi
        Route::get('register', 'showRegistrationForm')->name('register');
        // Route untuk MENYIMPAN data registrasi
        Route::post('register', 'register')->name('register.store'); // <-- INI YANG MEMPERBAIKI ERROR ANDA

        // Route untuk menampilkan form login
        Route::get('login', 'showLoginForm')->name('login');
        // Route untuk MEMPROSES login
        Route::post('login', 'login'); // Tidak perlu nama karena form action akan ke route('login')
    });
    // Route untuk logout (hanya untuk yang sudah login)
    Route::middleware('auth')->post('logout', 'logout')->name('logout');
});


// --- GRUP ROUTE KHUSUS UNTUK ADMIN ---
Route::prefix('admin')
    ->middleware(['auth', 'is.admin'])
    ->name('admin.') // <-- Ini akan menambahkan prefix "admin." pada semua nama route di dalam grup
    ->group(function () {

        // Route Dashboard Admin
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Route untuk CRUD Rute
        Route::get('/rute/{rute}/hapus', [RutePerjalananController::class, 'showDeleteConfirmation'])->name('rute.showDeleteConfirmation');
        Route::resource('rute', RutePerjalananController::class)->parameters(['rute' => 'rute']); // Cukup satu kali

        // Route untuk CRUD Mobil
        Route::resource('mobil', MobilController::class);
        Route::get('/pesan/perjalanan/{perjalanan}', [PemesananController::class, 'pilihKursi'])->name('pemesanan.pilihKursi');
Route::get('mobil/{mobil}/hapus', [\App\Http\Controllers\Admin\MobilController::class, 'showDeleteConfirmation'])->name('mobil.showDeleteConfirmation');
        // Route untuk CRUD Penjadwalan Perjalanan
        Route::get('perjalanan/{perjalanan}/hapus', [PerjalananController::class, 'showDeleteConfirmation'])->name('perjalanan.showDeleteConfirmation');
        Route::post('perjalanan/{perjalanan}/ubah-status', [PerjalananController::class, 'toggleStatus'])->name('perjalanan.toggleStatus');
        Route::resource('perjalanan', PerjalananController::class);
// --- Route untuk CRUD Pelanggan (SUDAH DIPINDAHKAN KE DALAM SINI) ---
        Route::get('pelanggan/{pelanggan}/hapus', [PelangganController::class, 'showDeleteConfirmation'])->name('pelanggan.showDeleteConfirmation');
        Route::resource('pelanggan', PelangganController::class)->parameters(['pelanggan' => 'pelanggan']);
        Route::get('/pesan/perjalanan/{perjalanan}', [PemesananController::class, 'pilihKursi'])->name('pemesanan.pilihKursi');
Route::resource('pemesanan', AdminPemesananController::class)->only(['index', 'show', 'destroy']);
Route::get('pemesanan/{pemesanan}/hapus', [AdminPemesananController::class, 'showDeleteConfirmation'])->name('pemesanan.showDeleteConfirmation');
// Contoh route lain yang menggunakan alias
Route::post('pemesanan/{pemesanan}/update-status', [AdminPemesananController::class, 'updateStatus'])->name('pemesanan.updateStatus');   
Route::get('laporan', [\App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('laporan.index');
Route::get('laporan/cetak', [LaporanController::class, 'cetakPdf'])->name('laporan.cetakPdf');    
// Route baru untuk Kelola Akun
Route::get('kelola-akun/{kelola_akun}/hapus', [\App\Http\Controllers\Admin\KelolaAkunController::class, 'showDeleteConfirmation'])->name('kelola-akun.showDeleteConfirmation');
Route::resource('kelola-akun', \App\Http\Controllers\Admin\KelolaAkunController::class);

    });

// Tidak ada lagi route admin di sini.