@extends('layouts.pelanggan')
@section('title', 'Hasil Pencarian')

@section('content')
<div class="container">
    @include('layouts.partials.progress_bar', ['tahap' => 1])

    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-body p-4 p-lg-5">
             <h3 class="card-title text-center fw-bold mb-4">Pilih Keberangkatan</h3>
             @forelse ($hasil_perjalanan as $perjalanan)
                <div class="card mb-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-bold">{{ \Carbon\Carbon::parse($perjalanan->jam_berangkat)->format('H:i') }} - {{ $perjalanan->mobil->nama_mobil }}</h5>
                            <p class="mb-0 text-muted">{{ $perjalanan->rutePerjalanan->asal }} &rarr; {{ $perjalanan->rutePerjalanan->tujuan }}</p>
                        </div>
                        <div class="text-end">
                             <h5 class="fw-bold text-primary">Rp {{ number_format($perjalanan->rutePerjalanan->harga) }}</h5>
                             <a href="{{ route('pemesanan.pilihKursi', $perjalanan->id) }}" class="btn btn-primary">Pilih & Lanjutkan</a>
                        </div>
                    </div>
                </div>
             @empty
                <div class="alert alert-warning text-center">
                    Tidak ada perjalanan yang tersedia untuk rute dan tanggal yang Anda pilih.
                </div>
             @endforelse
        </div>
    </div>
</div>
@endsection