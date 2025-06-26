@extends('layouts.app')

@section('title', 'Register')

@section('content')
<style>
    .register-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f1f5f9;
    }

    .register-card {
        display: flex;
        width: 100%;
        max-width: 900px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    .register-form {
        flex: 1;
        padding: 40px;
    }

    .register-image {
        flex: 1;
        background: url('{{ asset('assets/img/hero.png') }}') no-repeat center center;
        background-size: cover;
        min-height: 400px;
    }

    .btn-register {
        background-color: #2563eb;
        border: none;
    }

    .btn-register:hover {
        background-color: #1d4ed8;
    }

    .text-link {
        color: #2563eb;
    }

    .text-link:hover {
        text-decoration: underline;
    }
</style>

<div class="register-section">
    <div class="register-card">
        <div class="register-form">
            <h3 class="fw-bold mb-2">Buat Akun Baru</h3>
            <p class="mb-4">Sudah punya akun? <a href="{{ route('login') }}" class="text-link">Login di sini</a></p>

            <form method="POST" action="{{ route('register.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password-confirm" class="form-label">Konfirmasi Password</label>
                    <input id="password-confirm" type="password" class="form-control"
                           name="password_confirmation" required>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-register text-white py-2">Register</button>
                </div>
            </form>
        </div>

        <!-- Gambar di samping -->
        <div class="register-image d-none d-md-block"></div>
    </div>
</div>
@endsection
