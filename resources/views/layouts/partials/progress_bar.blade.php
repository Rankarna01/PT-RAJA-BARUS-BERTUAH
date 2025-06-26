{{-- File: resources/views/layouts/partials/progress_bar.blade.php --}}

@php
    // Menghitung persentase lebar untuk garis progress yang terisi
    // Ada 5 tahap, berarti ada 4 segmen.
    // Jika tahap = 1, width = 0%. Jika tahap = 5, width = 100%.
    $progressPercentage = ($tahap - 1) / 4 * 100;
@endphp

<div class="progress-container mb-5 text-white">
    {{-- Garis Latar Belakang --}}
    <div class="progress-line"></div>
    {{-- Garis Progress yang Terisi --}}
    <div class="progress-line-filled" style="width: {{ $progressPercentage }}%;"></div>
    
    {{-- Tahap 1: Pilih Tujuan --}}
    <div class="progress-step {{ $tahap >= 1 ? 'active' : '' }}">
        <i class="bi bi-geo-alt-fill"></i>
        <span class="progress-step-label">Pilih Tujuan</span>
    </div>

    {{-- Tahap 2: Pilih Kursi --}}
    <div class="progress-step {{ $tahap >= 2 ? 'active' : '' }}">
        <i class="bi bi-person-check-fill"></i>
        <span class="progress-step-label">Pilih Kursi</span>
    </div>

    {{-- Tahap 3: Pembayaran --}}
    <div class="progress-step {{ $tahap >= 3 ? 'active' : '' }}">
        <i class="bi bi-credit-card-fill"></i>
        <span class="progress-step-label">Pembayaran</span>
    </div>

    {{-- Tahap 4: Checkout --}}
    <div class="progress-step {{ $tahap >= 4 ? 'active' : '' }}">
        <i class="bi bi-receipt"></i>
        <span class="progress-step-label">Checkout</span>
    </div>

    {{-- Tahap 5: Selesai --}}
    <div class="progress-step {{ $tahap >= 5 ? 'active' : '' }}">
        <i class="bi bi-check-circle-fill"></i>
        <span class="progress-step-label">Selesai</span>
    </div>
</div>

{{-- 
    CATATAN: 
    Pastikan style ini ada di layout utama Anda (layouts/pelanggan.blade.php) 
    agar bisa diterapkan di semua halaman pemesanan.
--}}
@push('styles')
<style>
    .progress-container { 
        display: flex; 
        justify-content: space-between; 
        position: relative; 
        max-width: 800px; /* Batasi lebar agar tidak terlalu panjang di layar besar */
        margin: 0 auto 50px auto; /* Posisikan di tengah dan beri margin bawah */
    }
    .progress-line, .progress-line-filled { 
        content: ''; 
        position: absolute; 
        top: 50%; 
        left: 0; 
        transform: translateY(-50%); 
        height: 5px; 
        width: 100%; 
        z-index: 1; 
        border-radius: 5px;
    }
    .progress-line {
        background-color: rgba(255, 255, 255, 0.25); /* Garis latar lebih transparan */
    }
    .progress-line-filled {
        background-color: white; /* Garis progress yang terisi berwarna putih */
        width: 0%; /* Default 0, akan diisi oleh inline style */
        transition: width 0.4s ease-in-out;
    }
    .progress-step { 
        width: 40px; 
        height: 40px; 
        background: #0d6efd; 
        border: 4px solid rgba(255, 255, 255, 0.3); 
        border-radius: 50%; 
        z-index: 2; 
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        color: rgba(255, 255, 255, 0.7);
        font-size: 1.2rem;
        transition: all 0.4s ease-in-out;
    }
    .progress-step.active { 
        border-color: white; 
        background-color: white; 
        color: #0d6efd; /* Warna ikon berubah saat aktif */
        transform: scale(1.1); /* Sedikit membesar saat aktif */
    }
    .progress-step-label { 
        position: absolute; 
        top: 50px; /* Posisi teks lebih jauh di bawah lingkaran */
        text-align: center; 
        width: 120px; 
        left: 50%; 
        transform: translateX(-50%); 
        font-size: 14px; 
        font-weight: 500;
        color: white; /* Pastikan teks selalu berwarna putih */
    }
</style>
@endpush
