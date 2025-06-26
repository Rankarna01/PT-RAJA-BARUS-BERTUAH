@extends('admin.layouts.app')
@section('title', 'Manajemen Rute & Harga')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Rute & Harga Tiket</h1>
        <a href="{{ route('admin.rute.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg me-2"></i>Tambah Rute
        </a>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Rute Asal</th>
                            <th>Rute Tujuan</th>
                            <th>Harga Tiket</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($semua_rute as $index => $rute)
                        <tr>
                            <td>{{ $semua_rute->firstItem() + $index }}</td>
                            <td>{{ $rute->asal }}</td>
                            <td>{{ $rute->tujuan }}</td>
                            <td class="fw-bold">Rp {{ number_format($rute->harga, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.rute.edit', $rute->id) }}" class="btn btn-sm btn-info" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="{{ route('admin.rute.showDeleteConfirmation', $rute->id) }}" class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data rute.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{ $semua_rute->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection