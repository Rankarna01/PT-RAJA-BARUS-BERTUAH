@extends('admin.layouts.app')
@section('title', 'Manajemen Jam Keberangkatan')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Jam Keberangkatan</h1>
        <a href="{{ route('admin.jam-keberangkatan.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg me-2"></i>Tambah Jam
        </a>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow mb-4" style="border-left: 4px solid #0d6efd;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" width="100%" cellspacing="0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 20%;">Hari</th>
                            <th>Jam Berangkat</th>
                            <th style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftar_hari as $hari)
                        <tr>
                            <td class="fw-bold">{{ $hari }}</td>
                            <td>
                                @if(isset($semua_jam[$hari]))
                                    @foreach($semua_jam[$hari] as $jam)
                                        <span class="badge bg-primary fs-6 me-1 mb-1">{{ \Carbon\Carbon::parse($jam->jam)->format('H:i') }}</span>
                                    @endforeach
                                @else
                                    <span class="badge bg-secondary">Belum ada jadwal</span>
                                @endif
                            </td>
                            <td>
                                @if(isset($semua_jam[$hari]))
                                    @foreach($semua_jam[$hari] as $jam)
                                    <div class="d-inline-block mb-1">
                                        <a href="{{ route('admin.jam-keberangkatan.edit', $jam->id) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger tombol-hapus" data-id="{{ $jam->id }}">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                        <form id="form-hapus-{{ $jam->id }}" action="{{ route('admin.jam-keberangkatan.destroy', $jam->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHapusLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus jam ini? Tindakan ini tidak bisa dibatalkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="tombolKonfirmasiHapus">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    var idUntukDihapus;
    // Tampilkan modal saat tombol hapus di-klik
    $('.tombol-hapus').on('click', function() {
        idUntukDihapus = $(this).data('id');
        $('#modalHapus').modal('show');
    });

    // Jalankan form hapus saat tombol konfirmasi di modal di-klik
    $('#tombolKonfirmasiHapus').on('click', function() {
        $('#form-hapus-' + idUntukDihapus).submit();
    });
});
</script>
@endpush