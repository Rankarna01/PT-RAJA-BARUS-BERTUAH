@extends('admin.layouts.app')
@section('title', 'Edit Data Mobil')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Data Mobil</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.mobil.update', $mobil->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama_mobil" class="form-label">Nama/Jenis Mobil</label>
                    <input type="text" class="form-control @error('nama_mobil') is-invalid @enderror" id="nama_mobil" name="nama_mobil" value="{{ old('nama_mobil', $mobil->nama_mobil) }}" required>
                    @error('nama_mobil') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="nomor_polisi" class="form-label">Nomor Polisi</label>
                    <input type="text" class="form-control @error('nomor_polisi') is-invalid @enderror" id="nomor_polisi" name="nomor_polisi" value="{{ old('nomor_polisi', $mobil->nomor_polisi) }}" required>
                    @error('nomor_polisi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="kapasitas" class="form-label">Kapasitas Kursi</label>
                    <input type="number" class="form-control @error('kapasitas') is-invalid @enderror" id="kapasitas" name="kapasitas" value="{{ old('kapasitas', $mobil->kapasitas) }}" required>
                    @error('kapasitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="nama_supir" class="form-label">Nama Supir</label>
                    <input type="text" class="form-control @error('nama_supir') is-invalid @enderror" id="nama_supir" name="nama_supir" value="{{ old('nama_supir', $mobil->nama_supir) }}" required>
                    @error('nama_supir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <a href="{{ route('admin.mobil.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection