@extends('admin.layouts.app')
@section('title', 'Edit Penjadwalan')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Penjadwalan Perjalanan</h1>
        <a href="{{ route('admin.perjalanan.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.perjalanan.update', $perjalanan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4">
                <div class="row gx-5">
                    <!-- Kolom Kiri -->
                    <div class="col-lg-5">
                        <div class="mb-3">
                            <label for="mobil_id" class="form-label fw-bold">Pilih Mobil & Supir</label>
                            <select class="form-select @error('mobil_id') is-invalid @enderror" id="mobil_id" name="mobil_id" required>
                                <option value="">Pilih...</option>
                                @foreach ($semua_mobil as $mobil)
                                    <option value="{{ $mobil->id }}" {{ old('mobil_id', $perjalanan->mobil_id) == $mobil->id ? 'selected' : '' }}>
                                        {{ $mobil->nama_mobil }} ({{ $mobil->nama_supir }})
                                    </option>
                                @endforeach
                            </select>
                             @error('mobil_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="rute_perjalanan_id" class="form-label fw-bold">Rute Berangkat</label>
                            <select class="form-select @error('rute_perjalanan_id') is-invalid @enderror" name="rute_perjalanan_id" required>
                                <option value="">Pilih Rute...</option>
                                @foreach($semua_rute as $rute)
                                    <option value="{{ $rute->id }}" {{ old('rute_perjalanan_id', $perjalanan->rute_perjalanan_id) == $rute->id ? 'selected' : '' }}>
                                        {{ $rute->asal }} - {{ $rute->tujuan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('rute_perjalanan_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-lg-7">
                        <div class="mb-3">
                             <label for="tanggal_berangkat" class="form-label fw-bold">Pilih Tanggal</label>
                             <input type="date" class="form-control @error('tanggal_berangkat') is-invalid @enderror" name="tanggal_berangkat" value="{{ old('tanggal_berangkat', $perjalanan->tanggal_berangkat) }}" required>
                             @error('tanggal_berangkat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jam_berangkat" class="form-label fw-bold">Jam Berangkat</label>
                            <input type="time" class="form-control @error('jam_berangkat') is-invalid @enderror" name="jam_berangkat" value="{{ old('jam_berangkat', $perjalanan->jam_berangkat) }}" required>
                             @error('jam_berangkat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5">UPDATE</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
