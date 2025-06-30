<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RutePerjalanan; // Import ini bisa dihapus jika tidak lagi digunakan di mana pun dalam controller ini

class LandingPageController extends Controller
{
    /**
     * Menampilkan halaman utama (landing page) untuk semua pengunjung.
     * Route: /
     * View: pelanggan.home
     */
       public function index()
{
     return view('pelanggan.home');
}

    /**
     * Menampilkan halaman home untuk pelanggan yang sudah login.
     * Route: /home (di dalam middleware auth)
     * View: pelanggan.home
     */
    public function landingpage()
    {
        // Method ini akan menampilkan halaman home untuk pelanggan yang login.
        return view('pelanggan.home');
    }

    public function showRutePerjalanan()
    {
    
        // Mengambil semua data rute perjalanan dari model RutePerjalanan
       $semua_rute = RutePerjalanan::all();

  

        // Mengembalikan view dengan data rute perjalanan
        return view('pelanggan.landing', compact('rutePerjalanan'));
    }
}
