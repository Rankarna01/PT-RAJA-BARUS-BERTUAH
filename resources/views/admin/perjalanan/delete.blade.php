@extends('admin.layouts.app')
@section('title', 'Konfirmasi Hapus Penjadwalan')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Konfirmasi Hapus Penjadwalan</h1>

    <div class="card shadow mb-4 border-left-danger">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Peringatan</h6>
        </div>
        <div class="card-body">
            <p>Apakah Anda yakin ingin menghapus jadwal perjalanan ini?</p>
            <ul>
                <li><strong>Rute:</strong> {{ $perjalanan->rutePerjalanan->asal }} - {{ $perjalanan->rutePerjalanan->tujuan }}</li>
                <li><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($perjalanan->tanggal_berangkat)->format('d M Y') }}</li>
                <li><strong>Jam:</strong> {{ \Carbon\Carbon::parse($perjalanan->jam_berangkat)->format('H:i') }}</li>
                <li><strong>Mobil:</strong> {{ $perjalanan->mobil->nama_mobil }}</li>
            </ul>
            <p class="text-danger">Tindakan ini tidak dapat dibatalkan.</p>
            <hr>
            <form action="{{ route('admin.perjalanan.destroy', $perjalanan->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <a href="{{ route('admin.perjalanan.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-danger">Ya, Hapus Jadwal Ini</button>
            </form>
        </div>
    </div>
</div>
@endsection