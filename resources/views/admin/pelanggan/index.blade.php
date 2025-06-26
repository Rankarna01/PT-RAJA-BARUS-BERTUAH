@extends('admin.layouts.app')
@section('title', 'Manajemen Pelanggan')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Data Pelanggan</h1>
        <a href="{{ route('admin.pelanggan.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg me-2"></i>Tambah Pelanggan
        </a>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
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
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th>Tanggal Gabung</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($semua_pelanggan as $index => $pelanggan)
                        <tr>
                            <td>{{ $semua_pelanggan->firstItem() + $index }}</td>
                            <td>{{ $pelanggan->name }}</td>
                            <td>{{ $pelanggan->email }}</td>
                            <td>{{ $pelanggan->nomor_telepon ?? '-' }}</td>
                            <td>{{ $pelanggan->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.pelanggan.edit', $pelanggan->id) }}" class="btn btn-sm btn-info" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="{{ route('admin.pelanggan.showDeleteConfirmation', $pelanggan->id) }}" class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data pelanggan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{ $semua_pelanggan->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection