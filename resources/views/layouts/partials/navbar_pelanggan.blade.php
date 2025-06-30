{{-- File: resources/views/layouts/partials/navbar_pelanggan.blade.php --}}

<nav class="navbar navbar-expand-lg navbar-pelanggan">
    <div class="container">
        <a class="navbar-brand text-white" href="{{ route('home') }}" style="font-size: 0.9em;">
    <i class="bi bi-bus-front-fill"></i>
    PT. RAJA BARUS BERTUAH
</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavPelanggan" aria-controls="navbarNavPelanggan" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavPelanggan">
            <ul class="navbar-nav mx-auto">
                @auth
                    {{-- Home akan aktif hanya di halaman home --}}
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>

                    {{-- Pesan Tiket akan aktif selama alur pemesanan --}}
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('landing', 'pemesanan.cari', 'pemesanan.pilihKursi', 'pemesanan.proses') ? 'active' : '' }}" href="{{ route('rutePerjalanan') }}">Pesan Tiket</a></li>
                    
                    {{-- Menu statis, belum ada route --}}
                    
                    
                    
                    
                    {{-- Menu statis, belum ada route --}}
                    {{-- <li class="nav-item"><a class="nav-link" href="#">Kirim Saran</a></li> --}}

                    {{-- Riwayat Transaksi akan aktif di halaman daftar riwayat --}}
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('pemesanan.index') ? 'active' : '' }}" href="{{ route('pemesanan.index') }}">Riwayat Transaksi</a></li>
                @endauth
            </ul>
            <ul class="navbar-nav">
                @auth
                {{-- JIKA PENGGUNA SUDAH LOGIN, TAMPILKAN INI --}}
                <li class="nav-item dropdown position-relative">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdownToggle" aria-expanded="false">
                        Halo, {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" id="userDropdownMenu">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                {{-- JIKA PENGGUNA ADALAH TAMU (BELUM LOGIN), TAMPILKAN INI --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="btn btn-outline-light ms-2">Daftar</a>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

{{-- CSS & JS untuk Dropdown Manual --}}
<style>
    #userDropdownMenu { display: none; position: absolute; top: 100%; right: 0; }
    #userDropdownMenu.show { display: block; }
    .navbar-toggler {
  border-color: white; /* Opsional: garis border putih */
}

.navbar-toggler-icon {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='white' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
}

</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownToggle = document.getElementById('userDropdownToggle');
        const dropdownMenu = document.getElementById('userDropdownMenu');
        if (dropdownToggle && dropdownMenu) {
            dropdownToggle.addEventListener('click', function (event) {
                event.preventDefault();
                dropdownMenu.classList.toggle('show');
            });
            window.addEventListener('click', function (event) {
                if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    if (dropdownMenu.classList.contains('show')) {
                        dropdownMenu.classList.remove('show');
                    }
                }
            });
        }
    });
</script>
