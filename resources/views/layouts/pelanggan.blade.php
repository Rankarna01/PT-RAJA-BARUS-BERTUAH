{{-- File: resources/views/layouts/pelanggan.blade.php --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '88 Travel Jambi')</title>

    {{-- Font Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- ✅ Link ke file CSS dari folder public/assets --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('assets/vendor/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    {{-- Style Terpusat --}}
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            /* background-color: #ffffff; */
        }
        .navbar-pelanggan {
            background-color: #0d6efd;
            padding: 1rem 0;
            font-family: 'Poppins', sans-serif;
        }
        .navbar-pelanggan .navbar-brand { font-weight: bold; font-size: 1.8rem; }
        .navbar-pelanggan .nav-link { color: rgba(255, 255, 255, 0.85); font-weight: 500; transition: color 0.2s; }
        .navbar-pelanggan .nav-link:hover, .navbar-pelanggan .nav-link.active { color: white; border-bottom: 2px solid white; }
        .main-content { min-height: calc(100vh - 82px); }
    </style>
    @stack('styles')
</head>
<body>
    <div id="app">
        
        {{-- Navbar --}}
        @include('layouts.partials.navbar_pelanggan')

        {{-- Konten --}}
        <main class="main-content py-4">
            @yield('content')
        </main>

    </div>

    {{-- ✅ Script dari folder public/assets --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

    {{-- Inisialisasi AOS jika digunakan --}}
    <script>
        AOS.init();
    </script>

    @stack('scripts')
</body>
</html>
