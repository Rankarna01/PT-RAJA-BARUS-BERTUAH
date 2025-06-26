<nav class="sidebar">
    <div class="sidebar-header">
        <h5>PT. RAJA BARUS BERTUAH</h5>
    </div>

    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                href="{{ route('admin.dashboard') }}">
                <i class="bi bi-grid-1x2-fill"></i>
                Dashboard
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="">
                <i class="bi bi-calendar-week-fill"></i>
                Data Jadwal
            </a>
        </li> --}}
       <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('admin.pemesanan.*') ? 'active' : '' }}" href="{{ route('admin.pemesanan.index') }}">
        <i class="bi bi-book-fill"></i>
        Data Pemesanan
    </a>
</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.rute.*') ? 'active' : '' }}"
                href="{{ route('admin.rute.index') }}">
                <i class="bi bi-sign-turn-right-fill"></i>
                Data Rute
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.mobil.*') ? 'active' : '' }}"
                href="{{ route('admin.mobil.index') }}">
                <i class="bi bi-truck-front-fill"></i>
                Data Mobil
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.perjalanan.*') ? 'active' : '' }}"
                href="{{ route('admin.perjalanan.index') }}"> <i class="bi bi-calendar2-plus-fill"></i>
                Penjadwalan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.pelanggan.*') ? 'active' : '' }}"
                href="{{ route('admin.pelanggan.index') }}">
                <i class="bi bi-people-fill"></i>
                Data Pelanggan
            </a>
        </li>
       <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('admin.kelola-akun.*') ? 'active' : '' }}" href="{{ route('admin.kelola-akun.index') }}">
        <i class="bi bi-people-fill"></i>
        Kelola Akun
    </a>
</li>
        <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}" href="{{ route('admin.laporan.index') }}">
        <i class="bi bi-graph-up-arrow"></i>
        Laporan Pendapatan
    </a>
</li>
    </ul>
</nav>