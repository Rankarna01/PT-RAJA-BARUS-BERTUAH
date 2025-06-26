@extends('admin.layouts.app')
@section('title', 'Konfirmasi Hapus Pelanggan')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Konfirmasi Hapus Pelanggan</h1>
    <div class="card shadow mb-4 border-left-danger">
        <div class="card-body">
            <p>Apakah Anda yakin ingin menghapus pelanggan ini?</p>
            <ul>
                <li><strong>Nama:</strong> {{ $pelanggan->name }}</li>
                <li><strong>Email:</strong> {{ $pelanggan->email }}</li>
            </ul>
            <p class="text-danger">Tindakan ini akan menghapus akun user secara permanen dan tidak dapat dibatalkan.</p>
            <hr>
            <form action="{{ route('admin.pelanggan.destroy', $pelanggan->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-danger">Ya, Hapus Pelanggan Ini</button>
            </form>
        </div>
    </div>
</div>
@endsection