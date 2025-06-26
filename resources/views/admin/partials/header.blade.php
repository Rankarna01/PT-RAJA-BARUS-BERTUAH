<header class="admin-header p-3">
    <div class="d-flex justify-content-end align-items-center">
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="adminDropdownToggle" aria-expanded="false">
                <i class="bi bi-person-circle fs-4 me-2"></i>
                <strong class="me-2">{{ Auth::user()->name }}</strong>
            </a>
            
            <ul class="dropdown-menu dropdown-menu-end text-small shadow" id="adminDropdownMenu" style="position: absolute;">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Sign out</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>

<style>
    /* CSS untuk menyembunyikan dan menampilkan menu secara manual */
    #adminDropdownMenu {
        display: none; /* Sembunyikan menu secara default */
    }
    #adminDropdownMenu.show {
        display: block; /* Tampilkan menu jika memiliki class 'show' */
    }
</style>

<script>
    // Pastikan skrip berjalan setelah halaman dimuat sepenuhnya
    document.addEventListener('DOMContentLoaded', function() {

        // Ambil elemen tombol dropdown dan menunya
        const dropdownToggle = document.getElementById('adminDropdownToggle');
        const dropdownMenu = document.getElementById('adminDropdownMenu');

        // Tambahkan event listener saat tombol di-klik
        dropdownToggle.addEventListener('click', function(event) {
            // Mencegah link default (href="#") agar tidak melompat ke atas halaman
            event.preventDefault(); 
            
            // Toggle (tambah/hapus) class 'show' pada menu
            dropdownMenu.classList.toggle('show');
        });

        // Tambahkan event listener untuk menutup dropdown saat mengklik di luar area menu
        window.addEventListener('click', function(event) {
            // Cek apakah yang di-klik BUKAN tombol dropdown DAN BUKAN bagian dari menu
            if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                // Jika ya, hapus class 'show' (tutup menu)
                dropdownMenu.classList.remove('show');
            }
        });

    });
</script>
 <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>