@extends('admin.layouts.app')
@section('title', 'Detail Pemesanan ' . $pemesanan->nomor_tiket)

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pemesanan: {{ $pemesanan->nomor_tiket }}</h1>
        <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="row">
        <div class="col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Informasi Perjalanan</h6></div>
                <div class="card-body">
                    <p><strong>Rute:</strong> {{ $pemesanan->perjalanan->rutePerjalanan->asal }} &rarr; {{ $pemesanan->perjalanan->rutePerjalanan->tujuan }}</p>
                    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($pemesanan->perjalanan->tanggal_berangkat)->format('l, d F Y') }}</p>
                    <p><strong>Jam:</strong> {{ \Carbon\Carbon::parse($pemesanan->perjalanan->jam_berangkat)->format('H:i') }} WIB</p>
                    <hr>
                    <p><strong>Armada:</strong> {{ $pemesanan->perjalanan->mobil->nama_mobil }} ({{ $pemesanan->perjalanan->mobil->nomor_polisi }})</p>
                    <p><strong>Supir:</strong> {{ $pemesanan->perjalanan->mobil->nama_supir }}</p>
                </div>
            </div>
             <div class="card shadow mb-4">
                <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Informasi Pembayaran</h6></div>
                <div class="card-body">
                    <p><strong>Total Pembayaran:</strong> Rp {{ number_format($pemesanan->total_pembayaran) }}</p>
                    <p><strong>Status:</strong>
                        @if($pemesanan->status_pembayaran == 'lunas') <span class="badge bg-success">Lunas</span>
                        @elseif($pemesanan->status_pembayaran == 'menunggu') <span class="badge bg-warning text-dark">Menunggu</span>
                        @else <span class="badge bg-danger">Gagal/Batal</span> @endif
                    </p>
                    <p><strong>Tanggal Pesan:</strong> {{ $pemesanan->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Informasi Pelanggan</h6></div>
                <div class="card-body">
                    <p><strong>Nama Penumpang:</strong> {{ $pemesanan->nama_penumpang }}</p>
                    <p><strong>Nomor Telepon:</strong> {{ $pemesanan->nomor_telepon }}</p>
                    <p><strong>Email Akun:</strong> {{ $pemesanan->user->email }}</p>
                    <p><strong>Alamat Jemput:</strong> {{ $pemesanan->alamat_jemput }}</p>
                    <hr>
                    <p><strong>Jumlah Kursi:</strong> {{ $pemesanan->jumlah_kursi }}</p>
                    <p><strong>Nomor Kursi:</strong> 
                         @foreach($pemesanan->kursiDipesan as $kursi)
                            <span class="badge bg-dark fs-6">{{ $kursi->nomor_kursi }}</span>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
