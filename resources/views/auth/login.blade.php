@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
    .login-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f1f5f9;
    }

    .login-card {
        display: flex;
        width: 100%;
        max-width: 900px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    .login-form {
        flex: 1;
        padding: 40px;
    }

    .login-image {
        flex: 1;
        background: url('{{ asset('assets/img/hero.png') }}') no-repeat center center;
        background-size: cover;
        min-height: 400px;
    }

    .btn-login {
        background-color: #2563eb;
        border: none;
    }

    .btn-login:hover {
        background-color: #1d4ed8;
    }

    .text-link {
        color: #2563eb;
    }

    .text-link:hover {
        text-decoration: underline;
    }
</style>

<div class="login-section">
    <div class="login-card">
        <div class="login-form">
            <h3 class="fw-bold mb-2">Masuk Akun</h3>
            <p class="mb-4">Belum punya akun? <a href="{{ route('register') }}" class="text-link">Daftar di sini</a></p>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input id="password" type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-login text-white py-2">Masuk</button>
                </div>
            </form>
        </div>

        <!-- Gambar Samping -->
        <div class="login-image d-none d-md-block"></div>
    </div>
</div>
@endsection
