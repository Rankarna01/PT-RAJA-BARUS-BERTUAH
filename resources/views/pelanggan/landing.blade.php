@extends('layouts.pelanggan')
@section('title', 'Pesan Tiket')

@section('content')
<div class="container">
    {{-- Progress Bar --}}
    @include('layouts.partials.progress_bar', ['tahap' => 1])

    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-body p-4 p-lg-5">
            <h3 class="card-title text-center fw-bold mb-4">Cari Perjalanan Anda</h3>
            <form action="{{ route('pemesanan.cari') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-5">
                        <label for="asal" class="form-label">Berangkat Dari</label>
                        <select name="asal" id="asal" class="form-select form-select-lg">
                            @foreach ($semua_rute->unique('asal') as $rute)
                                <option value="{{ $rute->asal }}">{{ $rute->asal }}</option>
                            @endforeach
                        </select>
                    </div>
                     <div class="col-md-5">
                        <label for="tujuan" class="form-label">Tujuan Ke</label>
                        <select name="tujuan" id="tujuan" class="form-select form-select-lg">
                             @foreach ($semua_rute->unique('tujuan') as $rute)
                                <option value="{{ $rute->tujuan }}">{{ $rute->tujuan }}</option>
                            @endforeach
                        </select>
                    </div>
                     <div class="col-md-2">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control form-control-lg" name="tanggal" id="tanggal" required>
                    </div>
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-warning btn-lg fw-bold">Cari Perjalanan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection