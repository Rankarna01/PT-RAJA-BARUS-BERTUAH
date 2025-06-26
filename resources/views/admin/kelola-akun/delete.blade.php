@extends('admin.layouts.app')
@section('title', 'Hapus Akun')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Konfirmasi Hapus Akun</h1>
    <div class="card shadow mb-4 border-left-danger">
        <div class="card-body">
            <p>Apakah Anda yakin ingin menghapus akun ini?</p>
            <ul>
                <li><strong>Nama:</strong> {{ $user->name }}</li>
                <li><strong>Email:</strong> {{ $user->email }}</li>
            </ul>
            <p class="text-danger">Tindakan ini tidak dapat dibatalkan.</p>
            <form action="{{ route('admin.kelola-akun.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <a href="{{ route('admin.kelola-akun.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-danger">Ya, Hapus Akun</button>
            </form>
        </div>
    </div>
</div>
@endsection
