@extends('admin.layouts.app')
@section('title', 'Tambah Jam Keberangkatan')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Jam Keberangkatan Baru</h1>
        <a href="{{ route('admin.jam-keberangkatan.index') }}" class="btn btn-secondary shadow-sm">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3" style="background-color: #0d6efd; color: white;">
                    <h6 class="m-0 font-weight-bold">Formulir Penambahan Jam</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.jam-keberangkatan.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="hari" class="form-label">Hari</label>
                            <select class="form-select @error('hari') is-invalid @enderror" id="hari" name="hari" required>
                                <option value="">Pilih Hari...</option>
                                @foreach($daftar_hari as $hari_item)
                                <option value="{{ $hari_item }}" {{ old('hari') == $hari_item ? 'selected' : '' }}>{{ $hari_item }}</option>
                                @endforeach
                            </select>
                            @error('hari') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jam" class="form-label">Jam Keberangkatan</label>
                            <input type="time" class="form-control @error('jam') is-invalid @enderror" id="jam" name="jam" value="{{ old('jam') }}" required>
                            @error('jam') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection