@extends('admin.layouts.app')
@section('title', 'Konfirmasi Hapus Pemesanan')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Konfirmasi Hapus Pemesanan</h1>

    <div class="card shadow mb-4 border-left-danger">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Peringatan</h6>
        </div>
        <div class="card-body">
            <p>Apakah Anda yakin ingin menghapus data pemesanan dengan nomor tiket di bawah ini secara permanen?</p>
            <h4 class="text-center my-3"><strong>{{ $pemesanan->nomor_tiket }}</strong></h4>
            <p class="text-danger">Tindakan ini tidak dapat dibatalkan.</p>

            <hr>

            <!-- Form ini akan mengirim request DELETE ke method destroy -->
            <form action="{{ route('admin.pemesanan.destroy', $pemesanan->id) }}" method="POST">
                @csrf
                @method('DELETE')
                
                <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn btn-danger">
                    Ya, Hapus Data Ini
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
