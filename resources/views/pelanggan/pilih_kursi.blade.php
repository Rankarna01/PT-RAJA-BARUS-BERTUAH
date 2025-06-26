@extends('layouts.pelanggan')
@section('title', 'Pilih Kursi & Isi Data')

@push('styles')
<style>
    /* Style baru untuk denah kursi yang lebih baik */
    .seat-map-container {
        background-color: #e9ecef;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #dee2e6;
    }
    .seat-map {
        display: grid;
        /* Membuat 4 kolom: 2 kursi, 1 gang, 1 kursi */
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
        max-width: 280px;
        margin: auto;
    }
    .seat {
        height: 50px;
        border-radius: 8px;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        font-size: 1.1rem;
        transition: all 0.2s ease;
        border: 2px solid transparent;
    }
    .seat.gang {
        /* Kolom gang tidak terlihat dan tidak bisa diklik */
        visibility: hidden;
    }
    .seat.driver {
        grid-column: span 4; /* Supir mengambil lebar penuh */
        background-color: #343a40;
        color: white;
        cursor: not-allowed;
        margin-bottom: 15px;
    }
    /* Merah untuk kursi yang sudah dipesan */
    .seat.booked {
        background-color: #dc3545;
        color: white;
        cursor: not-allowed;
        opacity: 0.7;
    }
    /* Hijau untuk kursi yang tersedia */
    .seat.available {
        background-color: #198754;
        color: white;
    }
    .seat.available:hover {
        transform: scale(1.1);
        box-shadow: 0 0 10px rgba(0,0,0,0.3);
    }
    /* Biru terang untuk kursi yang dipilih */
    .seat.selected {
        background-color: #0dcaf0;
        color: black;
        border-color: #000;
        transform: scale(1.1);
        box-shadow: 0 0 15px #0dcaf0;
    }
</style>
@endpush

@section('content')
<div class="container my-4">
    @include('layouts.partials.progress_bar', ['tahap' => 2])
    
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4 p-lg-5" style="background-color: #f8f9fa;">
            <form action="{{ route('pemesanan.proses') }}" method="POST" id="bookingForm">
                @csrf
                <input type="hidden" name="perjalanan_id" value="{{ $perjalanan->id }}">

                <div class="row g-4">
                    {{-- Bagian Kiri: Denah Kursi & Info --}}
                    <div class="col-lg-5">
                        <div class="card shadow-sm border-0 rounded-3 h-100">
                             <div class="card-header bg-primary text-white"><h4 class="mb-0">Pilih Kursi Anda</h4></div>
                             <div class="card-body text-center">
                                <div class="seat-map-container">
                                    <div class="seat-map">
                                        <div class="seat driver" title="Supir"><i class="bi bi-person-workspace me-2"></i> KEMUDI</div>
                                        
                                        @php
                                            $kursiCounter = 1;
                                            $totalKursi = $perjalanan->mobil->kapasitas;
                                        @endphp

                                        @while ($kursiCounter <= $totalKursi)
                                            {{-- Kursi Sisi Kiri --}}
                                            @if(in_array($kursiCounter, $kursi_dipesan))
                                                <div class="seat booked" title="Kursi Sudah Dipesan">{{ $kursiCounter }}</div>
                                            @else
                                                <div class="seat available" data-seat-number="{{ $kursiCounter }}">{{ $kursiCounter }}</div>
                                            @endif
                                            @php $kursiCounter++; @endphp

                                            {{-- Gang (kosong) --}}
                                            <div class="seat gang"></div>
                                            <div class="seat gang"></div>

                                            {{-- Kursi Sisi Kanan --}}
                                            @if ($kursiCounter <= $totalKursi)
                                                @if(in_array($kursiCounter, $kursi_dipesan))
                                                    <div class="seat booked" title="Kursi Sudah Dipesan">{{ $kursiCounter }}</div>
                                                @else
                                                    <div class="seat available" data-seat-number="{{ $kursiCounter }}">{{ $kursiCounter }}</div>
                                                @endif
                                                @php $kursiCounter++; @endphp
                                            @endif
                                        @endwhile
                                    </div>
                                </div>
                                <input type="hidden" name="nomor_kursi" id="nomor_kursi_input" required>
                                @error('nomor_kursi') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
                                @if (session('error')) <div class="alert alert-danger mt-3">{{ session('error') }}</div> @endif

                                <hr>
                                <h6>Informasi Petunjuk</h6>
                                <ul class="list-inline small">
                                    <li class="list-inline-item"><span class="badge bg-success me-1">&nbsp;</span> Kosong</li>
                                    <li class="list-inline-item"><span class="badge bg-danger me-1">&nbsp;</span> Terisi</li>
                                    <li class="list-inline-item"><span class="badge bg-info me-1">&nbsp;</span> Pilihan Anda</li>
                                </ul>
                             </div>
                        </div>
                    </div>

                    {{-- Bagian Kanan: Form & Ringkasan --}}
                    <div class="col-lg-7">
                        <div class="card shadow-sm border-0 rounded-3 mb-4">
                            <div class="card-header bg-dark text-white"><h4 class="mb-0">Ringkasan & Harga</h4></div>
                            <div class="card-body">
                                <p class="mb-2"><strong class="d-block text-muted">Armada:</strong>{{ strtoupper($perjalanan->mobil->nama_mobil) }} ({{ strtoupper($perjalanan->mobil->nomor_polisi) }})</p>
                                <p class="mb-2"><strong class="d-block text-muted">Rute:</strong>{{ $perjalanan->rutePerjalanan->asal }} &rarr; {{ $perjalanan->rutePerjalanan->tujuan }}</p>
                                <p class="mb-2"><strong class="d-block text-muted">Jadwal:</strong>{{ \Carbon\Carbon::parse($perjalanan->tanggal_berangkat)->format('d M Y') }}, {{ \Carbon\Carbon::parse($perjalanan->jam_berangkat)->format('H:i') }} WIB</p>
                                <hr>
                                <div class="text-center bg-light p-3 rounded">
                                    <h6 class="text-muted mb-0">Harga Tiket</h6>
                                    <h4 class="fw-bold text-primary">Rp {{ number_format($perjalanan->rutePerjalanan->harga, 0, ',', '.') }}/Kursi</h4>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card shadow-sm border-0 rounded-3">
                             <div class="card-header bg-dark text-white"><h4 class="mb-0">Isi Data Penumpang</h4></div>
                             <div class="card-body">
                                 <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_penumpang" class="form-label">Nama Lengkap Sesuai KTP</label>
                                        <input type="text" class="form-control" name="nama_penumpang" id="nama_penumpang" value="{{ Auth::user()->name }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="nomor_telepon" class="form-label">Nomor Telepon (WhatsApp)</label>
                                        <input type="tel" class="form-control" name="nomor_telepon" id="nomor_telepon" required>
                                    </div>
                                     <div class="col-12">
                                        <label for="alamat_jemput" class="form-label">Alamat Lengkap Penjemputan</label>
                                        <textarea name="alamat_jemput" id="alamat_jemput" class="form-control" rows="3" required></textarea>
                                        <small class="form-text text-muted">Pastikan alamat dan titik jemput sudah benar.</small>
                                     </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-warning btn-lg fw-bold" id="pesanSekarangBtn">Lanjut ke Pembayaran</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function(){
    function validateButton(){
        let formIsValid = true;
        $('#bookingForm input[required], #bookingForm textarea[required]').each(function() {
            if ($(this).val() === '') {
                formIsValid = false;
            }
        });
        $('#pesanSekarangBtn').prop('disabled', !formIsValid);
    }

    $('.seat.available').on('click', function(){
        // Jika kursi yang diklik sudah terpilih, batalkan pilihan
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            $('#nomor_kursi_input').val('');
        } else {
            // Jika memilih kursi baru
            $('.seat.available').removeClass('selected'); // Hapus pilihan lama
            $(this).addClass('selected'); // Tandai pilihan baru
            var seatNumber = $(this).data('seat-number');
            $('#nomor_kursi_input').val(seatNumber);
        }
        validateButton();
    });

    // Validasi saat form diisi
    $('#bookingForm input, #bookingForm textarea').on('keyup change', validateButton);

    // Panggil validasi saat halaman dimuat
    validateButton();
});
</script>
@endpush
