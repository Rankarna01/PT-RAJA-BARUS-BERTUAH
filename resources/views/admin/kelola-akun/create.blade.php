@extends('admin.layouts.app')
@section('title', 'Tambah Akun Baru')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Akun Baru</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.kelola-akun.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="role_id" class="form-label">Role</label>
                    <select name="role_id" class="form-select" required>
                        <option value="">Pilih Role...</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ Str::ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <hr>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" name="password_confirmation" required>
                </div>
                <a href="{{ route('admin.kelola-akun.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
