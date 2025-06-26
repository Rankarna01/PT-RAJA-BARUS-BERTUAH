@extends('layouts.pelanggan')
@section('title', 'Riwayat Transaksi')

@section('content')
<div class="container my-5">
    <h3 class="fw-bold mb-4">Riwayat Pemesanan Tiket Saya</h3>

    @if (session('success'))
    <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    @forelse($semua_pemesanan as $pesanan)
    <div class="card shadow-sm mb-3">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <div>
                <strong class="text-primary">No. Tiket: {{ $pesanan->nomor_tiket }}</strong>
                <br>
                <small class="text-muted">Dipesan pada: {{ $pesanan->created_at->format('d M Y, H:i') }}</small>
            </div>
            {{-- Tampilan Status --}}
            @if($pesanan->status_pembayaran == 'lunas')
                <span class="badge bg-success fs-6">Lunas</span>
            @elseif($pesanan->status_pembayaran == 'menunggu')
                 <span class="badge bg-warning fs-6 text-dark">Menunggu Pembayaran</span>
            @else
                 <span class="badge bg-danger fs-6">Dibatalkan/Gagal</span>
            @endif
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-7">
                    <p class="mb-1"><strong>Rute:</strong> {{ $pesanan->perjalanan->rutePerjalanan->asal }} &rarr; {{ $pesanan->perjalanan->rutePerjalanan->tujuan }}</p>
                    <p class="mb-1"><strong>Jadwal:</strong> {{ \Carbon\Carbon::parse($pesanan->perjalanan->tanggal_berangkat)->format('l, d F Y') }} pukul {{ \Carbon\Carbon::parse($pesanan->perjalanan->jam_berangkat)->format('H:i') }} WIB</p>
                    <p class="mb-0"><strong>Armada:</strong> {{ $pesanan->perjalanan->mobil->nama_mobil }} ({{ $pesanan->perjalanan->mobil->nomor_polisi }})</p>
                </div>
                <div class="col-md-5">
                    <p class="mb-1"><strong>Penumpang:</strong> {{ $pesanan->nama_penumpang }}</p>
                    <p class="mb-0"><strong>No. Kursi:</strong> 
                        @if($pesanan->kursiDipesan->isNotEmpty())
                            @foreach($pesanan->kursiDipesan as $kursi)
                                <span class="badge bg-dark">{{ $kursi->nomor_kursi }}</span>
                            @endforeach
                        @else
                            <span class="badge bg-secondary">N/A</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="card-footer bg-light d-flex justify-content-between align-items-center">
             <span class="fw-bold">Total: <span class="text-primary">Rp {{ number_format($pesanan->total_pembayaran, 0, ',', '.') }}</span></span>
            <div>
                {{-- Tombol Aksi --}}
                @if($pesanan->status_pembayaran == 'lunas')
                    <a href="{{ route('pemesanan.downloadTiket', $pesanan->id) }}" class="btn btn-primary btn-sm" target="_blank">
                        <i class="bi bi-download me-1"></i>Download E-Ticket
                    </a>
                @elseif($pesanan->status_pembayaran == 'menunggu')
                    <a href="#" class="btn btn-warning btn-sm">Bayar Sekarang</a>
                @endif
            </div>
        </div>
    </div>
    @empty
        <div class="alert alert-info text-center">
            <h4 class="alert-heading">Riwayat Kosong</h4>
            <p>Anda belum memiliki riwayat pemesanan. Mari mulai perjalanan pertama Anda!</p>
            <hr>
            <a href="{{ route('landing') }}" class="btn btn-primary">Pesan Tiket Sekarang</a>
        </div>
    @endforelse
</div>
@endsection