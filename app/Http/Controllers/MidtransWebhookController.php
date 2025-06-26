<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransWebhookController extends Controller
{
    /**
     * Handle notifikasi dari Midtrans.
     */
    public function handle(Request $request)
    {
        // Set konfigurasi server key Midtrans Anda
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        // Buat instance notifikasi Midtrans
        $notification = new Notification();

        // Ambil ID pesanan dan status transaksi dari notifikasi
        $orderId = $notification->order_id;
        $transactionStatus = $notification->transaction_status;
        $fraudStatus = $notification->fraud_status;

        // Cari pemesanan di database Anda berdasarkan order_id (nomor_tiket)
        $pemesanan = Pemesanan::where('nomor_tiket', $orderId)->first();

        // 1. Validasi Keamanan Notifikasi (Sangat Penting!)
        // Cocokkan signature key dari Midtrans dengan yang di-generate dari server key Anda
        $signature_key = hash('sha512', $orderId . $notification->status_code . $notification->gross_amount . config('midtrans.server_key'));
        if ($notification->signature_key != $signature_key) {
            // Jika tidak cocok, ini mungkin notifikasi palsu. Hentikan proses.
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // 2. Handle Status Transaksi
        if ($pemesanan) {
            if ($transactionStatus == 'capture') {
                // Untuk transaksi kartu kredit
                if ($fraudStatus == 'accept') {
                    // Pembayaran diterima, update status menjadi lunas
                    $pemesanan->status_pembayaran = 'lunas';
                    $pemesanan->save();
                }
            } else if ($transactionStatus == 'settlement') {
                // Untuk metode pembayaran lain (GoPay, Transfer Bank, dll)
                // Pembayaran diterima, update status menjadi lunas
                $pemesanan->status_pembayaran = 'lunas';
                $pemesanan->save();
            } else if ($transactionStatus == 'pending') {
                // Pembayaran masih menunggu (misal: Transfer Bank belum dibayar)
                // Anda bisa menambahkan logika di sini jika perlu
            } else if ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
                // Pembayaran gagal atau dibatalkan
                $pemesanan->status_pembayaran = 'gagal';
                $pemesanan->save();
                // Anda juga bisa membuka kembali kursi yang dipesan jika pembayaran gagal
            }
        }

        // Beri respons OK ke Midtrans agar tidak mengirim notifikasi berulang
        return response()->json(['message' => 'Notification handled'], 200);
    }
}