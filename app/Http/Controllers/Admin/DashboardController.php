<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\Perjalanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // --- Statistik untuk Kartu ---
        $pendapatanBulanIni = Pemesanan::where('status_pembayaran', 'lunas')
                                ->whereMonth('created_at', now()->month)
                                ->whereYear('created_at', now()->year)
                                ->sum('total_pembayaran');

        $pemesananBulanIni = Pemesanan::whereMonth('created_at', now()->month)
                                ->whereYear('created_at', now()->year)
                                ->count();

        $pelangganBaru = User::whereHas('roles', function($q){
                                $q->where('name', 'user');
                            })
                            ->whereMonth('created_at', now()->month)
                            ->whereYear('created_at', now()->year)
                            ->count();
                            
        $perjalananAktif = Perjalanan::where('status', 'Tersedia')
                                ->whereDate('tanggal_berangkat', '>=', now())
                                ->count();

        // --- Data untuk Grafik Pendapatan 7 Hari Terakhir ---
        $pendapatanHarian = Pemesanan::select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('SUM(total_pembayaran) as total')
            )
            ->where('status_pembayaran', 'lunas')
            ->where('created_at', '>=', Carbon::now()->subDays(6))
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'ASC')
            ->get();

        // Siapkan array untuk label (tanggal) dan data (total)
        $chartLabels = [];
        $chartData = [];
        // Isi dengan data default (0) untuk 7 hari terakhir
        for ($i = 6; $i >= 0; $i--) {
            $tanggal = Carbon::now()->subDays($i)->format('d M');
            $chartLabels[] = $tanggal;
            $chartData[$tanggal] = 0;
        }

        // Timpa dengan data dari database jika ada
        foreach ($pendapatanHarian as $data) {
            $tanggalFormatted = Carbon::parse($data->tanggal)->format('d M');
            if (isset($chartData[$tanggalFormatted])) {
                $chartData[$tanggalFormatted] = $data->total;
            }
        }
        
        // Kirim semua data ke view
        return view('admin.dashboard', [
            'pendapatanBulanIni' => $pendapatanBulanIni,
            'pemesananBulanIni' => $pemesananBulanIni,
            'pelangganBaru' => $pelangganBaru,
            'perjalananAktif' => $perjalananAktif,
            'chartLabels' => array_values($chartLabels),
            'chartData' => array_values($chartData),
        ]);
    }
}