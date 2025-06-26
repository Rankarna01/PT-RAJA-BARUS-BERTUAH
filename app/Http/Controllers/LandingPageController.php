<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\RutePerjalanan; // <-- Import model Rute

class LandingPageController extends Controller
{
   public function index()
{
    $semua_rute = RutePerjalanan::all();
    // UBAH DI SINI
    return view('pelanggan.landing', compact('semua_rute'));
}
  public function landingpage()
    {
        // Method ini akan menampilkan halaman home baru Anda.
        return view('pelanggan.home');
    }
}