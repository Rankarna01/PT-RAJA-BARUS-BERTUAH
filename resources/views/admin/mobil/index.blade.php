@extends('admin.layouts.app')
@section('title', 'Manajemen Mobil')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Data Mobil</h1>
        <a href="{{ route('admin.mobil.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-lg me-2"></i>Tambah Mobil
        </a>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: #0d6efd; color: white;">
            <h6 class="m-0 font-weight-bold">Daftar Mobil & Supir</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mobil</th>
                            <th>No Polisi</th>
                            <th>Nama Supir</th>
                            <th>Kapasitas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($semua_mobil as $index => $mobil)
                        <tr>
                            <td>{{ $semua_mobil->firstItem() + $index }}</td>
                            <td>{{ $mobil->nama_mobil }}</td>
                            <td>{{ $mobil->nomor_polisi }}</td>
                            <td>{{ $mobil->nama_supir }}</td>
                            <td>{{ $mobil->kapasitas }} Kursi</td>
                            <td>
                                <a href="{{ route('admin.mobil.edit', $mobil->id) }}" class="btn btn-sm btn-info" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                {{-- Tombol Hapus sekarang menjadi link biasa ke halaman konfirmasi --}}
                                <a href="{{ route('admin.mobil.showDeleteConfirmation', $mobil->id) }}" class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data mobil.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{ $semua_mobil->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- Tidak ada lagi modal dan @push('scripts') di sini --}}
