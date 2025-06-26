@extends('admin.layouts.app')
@section('title', 'Kelola Akun')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Akun Pengguna</h1>
        <a href="{{ route('admin.kelola-akun.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-person-plus-fill me-2"></i>Tambah Akun
        </a>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($semua_akun as $akun)
                        <tr>
                            <td>{{ $akun->name }}</td>
                            <td>{{ $akun->email }}</td>
                            <td>
                                @foreach ($akun->roles as $role)
                                    <span class="badge bg-primary">{{ Str::ucfirst($role->name) }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('admin.kelola-akun.edit', $akun->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ route('admin.kelola-akun.showDeleteConfirmation', $akun->id) }}" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data akun.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $semua_akun->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
