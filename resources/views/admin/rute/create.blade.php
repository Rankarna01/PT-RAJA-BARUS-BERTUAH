@extends('admin.layouts.app')
@section('title', 'Tambah Rute Baru')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Rute Baru</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.rute.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="asal" class="form-label">Rute Asal</label>
                    <input type="text" class="form-control @error('asal') is-invalid @enderror" id="asal" name="asal" value="{{ old('asal') }}" required>
                    @error('asal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="tujuan" class="form-label">Rute Tujuan</label>
                    <input type="text" class="form-control @error('tujuan') is-invalid @enderror" id="tujuan" name="tujuan" value="{{ old('tujuan') }}" required>
                    @error('tujuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga Tiket</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') }}" placeholder="Contoh: 150000" required>
                    </div>
                    @error('harga') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>

                <a href="{{ route('admin.rute.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection