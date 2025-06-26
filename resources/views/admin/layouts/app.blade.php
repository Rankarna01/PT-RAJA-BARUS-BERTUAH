<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- Penting untuk AJAX --}}
    <title>@yield('title', 'Admin Dashboard') - PT Raja Barus Bertuah</title>

    {{-- Fonts & Icons --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Vite (CSS) --}}
    @vite(['resources/scss/app.scss'])

    {{-- Custom Styles --}}
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
        }
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background-color: #0d6efd;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            transition: all 0.3s ease; /* Tambahkan ease untuk transisi yang lebih halus */
            z-index: 1000;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
            padding: 0.9rem 1.5rem;
            display: flex;
            align-items: center;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid white;
            padding-left: calc(1.5rem - 4px);
        }
        .sidebar .nav-link .bi {
            margin-right: 1rem;
            font-size: 1.2rem;
            width: 20px;
        }
        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }
        .sidebar-header h3 {
            color: white;
            font-weight: 700;
        }
        .main-content {
            margin-left: 260px;
            padding: 0;
            width: calc(100% - 260px);
            transition: all 0.3s ease; /* Tambahkan ease untuk transisi yang lebih halus */
        }
        .content {
            padding: 2rem;
        }
        .admin-header {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        /* Responsive adjustments */
        /* Sidebar collapse for smaller screens */
        @media (max-width: 991.98px) { /* Contoh breakpoint untuk tablet dan mobile */
            .sidebar {
                left: -260px; /* Sembunyikan sidebar di luar layar */
                /* Optional: tambahkan lebar minimal agar tidak sepenuhnya hilang saat di-toggle */
                width: 260px;
            }
            .sidebar.active { /* Class 'active' akan ditambahkan dengan JS saat sidebar dibuka */
                left: 0; /* Tampilkan sidebar */
            }
            .main-content {
                margin-left: 0; /* Content tidak lagi terpengaruh oleh lebar sidebar */
                width: 100%; /* Content mengambil seluruh lebar */
            }
            .sidebar-toggle-btn {
                display: block; /* Tampilkan tombol toggle */
            }
            .overlay { /* Overlay untuk menutup sidebar saat area content diklik */
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 990;
            }
            .overlay.active {
                display: block;
            }
        }

        @media (max-width: 575.98px) { /* Untuk layar yang lebih kecil lagi, seperti ponsel */
            .content {
                padding: 1rem; /* Kurangi padding untuk konten */
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        {{-- Overlay untuk mode mobile --}}
        <div class="overlay" id="sidebar-overlay"></div>

        @include('admin.partials.sidebar')

        <div class="main-content">
            @include('admin.partials.header')

            {{-- Tombol toggle sidebar untuk mobile --}}
            <button class="btn btn-primary d-lg-none m-3" id="sidebar-toggle">
                <i class="bi bi-list"></i>
            </button>

            <main class="content">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- Semua script dipindahkan ke akhir body untuk performa terbaik --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @vite(['resources/js/app.js'])
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (sidebarToggle && sidebar && overlay) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                    overlay.classList.toggle('active');
                });

                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                });
            }
        });
    </script>
    @stack('scripts') {{-- Untuk script khusus dari setiap halaman --}}
</body>
</html>