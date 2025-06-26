@extends('admin.layouts.app')
@section('title', 'Hapus Data Mobil')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Konfirmasi Hapus Data Mobil</h1>
    <div class="card shadow mb-4 border-left-danger">
        <div class="card-body">
            <p>Apakah Anda yakin ingin menghapus data mobil ini secara permanen?</p>
            <ul>
                <li><strong>Nama Mobil:</strong> {{ $mobil->nama_mobil }}</li>
                <li><strong>Nomor Polisi:</strong> {{ $mobil->nomor_polisi }}</li>
                <li><strong>Nama Supir:</strong> {{ $mobil->nama_supir }}</li>
            </ul>
            <p class="text-danger">Tindakan ini tidak dapat dibatalkan.</p>
            <hr>
            <form action="{{ route('admin.mobil.destroy', $mobil->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <a href="{{ route('admin.mobil.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-danger">Ya, Hapus Data Ini</button>
            </form>
        </div>
    </div>
</div>
@endsection
