@extends('layouts.pelanggan')
@section('title', 'Home')
<style>
 .hero-image {
  position: relative;
  top: -40px;

}
</style>

@section('content')
<main class="container py-5">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
             

              <h1 class="mb-4">
                Travel Nyaman, Aman<br>
                Dan Terpercaya Bersama <br>
                <span class="accent-text fs-15">PT. RAJA BARUS BERTUAH</span>

              </h1>

              <p class="mb-4 mb-md-5">
                Solusi Transportasi Antar Kota, Rental, dan Pengiriman Barang dengan Harga Terjangkau dan Pelayanan Terbaik!
              </p>

              <div class="hero-buttons">
               <a href="{{ route('landing') }}" class="btn btn-primary me-0 me-sm-2 mx-1">Pesan Sekarang</a>

                <a href="{{ route('login') }}" class="btn btn-link mt-2 mt-sm-0 glightbox">
                  <i class="bi bi-calendar me-1"></i>
                  Cek Jadwal & Tarif
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
              <img src="assets/img/hero.png" alt="Hero Image" class="img-fluid"> 
            </div>
          </div>
        </div>

        <div class="row stats-row gy-4 mt-5" data-aos="fade-up" data-aos-delay="500">
          <div class="col-lg-3 col-md-6">
            <div class="stat-item">
              <div class="stat-icon">
                <i class="bi bi-taxi-front"></i>
              </div>
              <div class="stat-content">
                <h4>10+ Mobil Travel</h4>
                <p class="mb-0">Kendaraan Unit Aktif</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="stat-item">
              <div class="stat-icon">
                <i class="bi bi-geo-alt"></i>
              </div>
              <div class="stat-content">
                <h4>7 Rute Layanan</h4>
                <p class="mb-0">Medan – Barus & lainnya</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="stat-item">
              <div class="stat-icon">
                <i class="bi bi-person"></i>

              </div>
              <div class="stat-content">
                <h4>6.500+ Penumpang</h4>
                <p class="mb-0">Telah mempercayai kami</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="stat-item">
              <div class="stat-icon">
                <i class="bi bi-graph-up"></i>
              </div>
              <div class="stat-content">
                <h4>10 Titik Jemput </h4>
                <p class="mb-0">Lokasi penjemputan strategis</p>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 align-items-center justify-content-between">

          <div class="col-xl-5" data-aos="fade-up" data-aos-delay="200">
            <span class="about-meta">PT RAJA BARUS BERTUAH</span>
            <h2 class="about-title">Tentang Kami</h2>
            <p class="about-description">PT. RAJA BARUS BERTUAH adalah perusahaan jasa transportasi profesional yang melayani trayek reguler Medan - Barus dan sekitarnya, rental mobil dengan sopir, layanan antar jemput bandara, hingga pengiriman barang dan dokumen.</p>

            <div class="row feature-list-wrapper">
              <div class="col-md-6">
                <ul class="feature-list">
                  <li><i class="bi bi-check-circle-fill"></i> Armada Nyaman & Terawat</li>
                  <li><i class="bi bi-check-circle-fill"></i> Driver Berpengalaman & Ramah</li>
                  <li><i class="bi bi-check-circle-fill"></i> Harga Kompetitif & Transparan</li>
                </ul>
              </div>
              <div class="col-md-6">
                <ul class="feature-list">
                  <li><i class="bi bi-check-circle-fill"></i> Jadwal Tepat Waktu</li>
                  <li><i class="bi bi-check-circle-fill"></i> Pembayaran Online</li>
                  <li><i class="bi bi-check-circle-fill"></i> Pemesanan Tiket Online Melalui Website</li>
                </ul>
              </div>
            </div>

            <div class="info-wrapper">
              <div class="row gy-4">
                <div class="col-lg-5">
                  <div class="profile d-flex align-items-center gap-3">
                    <i class="bi bi-envelope-fill fs-2"></i>
                    <div>
                      <h4 class="profile-name mb-0">Email</h4>
                      <p class="profile-position">rajabarustravel@gmail.com</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-7">
                  <div class="contact-info d-flex align-items-center gap-2">
                    <i class="bi bi-telephone-fill"></i>
                    <div>
                      <p class="contact-label">Telepon</p>
                      <p class="contact-number">085261774223</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
            <div class="image-wrapper">
              <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
                <img src="assets/img/about-5.webp" alt="Business Meeting" class="img-fluid main-image rounded-4">
                <img src="assets/img/about-2.webp" alt="Team Discussion" class="img-fluid small-image rounded-4">
              </div>
              <!-- <div class="experience-badge floating">
                <h3>15+ <span>Years</span></h3>
                <p>Of experience in business service</p>
              </div> -->
            </div>
          </div>
        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Features Section -->
    <section id="features" class="features section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Layanan Kami</h2>
        <p>Berikut Ini Beberapa Layanan Yang Ada di PT RAJA BARUS BERTUAH</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="d-flex justify-content-center">

          <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">

            <li class="nav-item">
              <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
                <h4>Trayek PP (Pulang-Pergi)</h4>
              </a>
            </li><!-- End tab nav item -->

            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                <h4>Antar Jemput Bandara</h4>
              </a><!-- End tab nav item -->

            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
                <h4>Rental Mobil + Sopir</h4>
              </a>
            </li><!-- End tab nav item -->

          </ul>

        </div>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

          <div class="tab-pane fade active show" id="features-tab-1">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                <h3>1. Trayek PP (Pulang-Pergi)</h3>
                <p class="fst-italic">
                  Kami melayani perjalanan reguler pulang-pergi dari Medan menuju berbagai daerah seperti Barus, 
                  Barus Utara, Sipodang, Sorkam, Andam Dewi, Sirandorung hingga Manduamas dengan jadwal yang 
                  fleksibel dan harga terjangkau.
                </p>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/Trayek.png" alt="" class="img-fluid">
              </div>
            </div>
          </div><!-- End tab content item -->

          <div class="tab-pane fade" id="features-tab-2">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                <h3>2.Antar Jemput Bandara</h3>
                <p class="fst-italic">
                  Nikmati kemudahan layanan antar jemput langsung dari dan menuju Bandara Kualanamu serta Bandara Silangit—solusi
                   praktis dan tepat waktu bagi penumpang yang mengutamakan kenyamanan.
                </p>
  
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/Antar Jemput.png" alt="" class="img-fluid">
              </div>
            </div>
          </div><!-- End tab content item -->

          <div class="tab-pane fade" id="features-tab-3">
            <div class="row">
              <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
                <h3>Rental Mobil + Supir</h3>
                <p class="fst-italic">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                  magna aliqua.
                </p>
              </div>
              <div class="col-lg-6 order-1 order-lg-2 text-center">
                <img src="assets/img/Rental.png" alt="" class="img-fluid">
              </div>
            </div>
          </div><!-- End tab content item -->

        </div>

      </div>
    </section><!-- /Features Section -->

    <div class="container section-title" data-aos="fade-up">
        <h2>Pemesanan Tiket Online</h2>
        <p>Fitur Pemesanan Tiket Online</p>
      </div>

      <section id="features-2" class="features-2 section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">

          <div class="col-lg-4">

            <div class="feature-item text-end mb-5" data-aos="fade-right" data-aos-delay="200">
              <div class="d-flex align-items-center justify-content-end gap-4">
                <div class="feature-content">
                  <h3>Pesan Tiket Online</h3>
                  <p>Nikmati kemudahan pemesanan tiket travel langsung dari ponsel Anda, kapan saja dan di mana saja tanpa harus datang ke loket.</p>
                </div>
                <div class="feature-icon flex-shrink-0">
                  <i class="bi bi-display"></i>
                </div>
              </div>
            </div><!-- End .feature-item -->

            <div class="feature-item text-end mb-5" data-aos="fade-right" data-aos-delay="300">
              <div class="d-flex align-items-center justify-content-end gap-4">
                <div class="feature-content">
                  <h3>Cek Jadwal Keberangkatan</h3>
                  <p>Lihat dan pilih jadwal keberangkatan terbaru secara online dalam waktu nyata, agar perjalanan Anda lebih terencana dan efisien.</p>
                </div>
                <div class="feature-icon flex-shrink-0">
                  <i class="bi bi-feather"></i>
                </div>
              </div>
            </div><!-- End .feature-item -->

            <div class="feature-item text-end" data-aos="fade-right" data-aos-delay="400">
              <div class="d-flex align-items-center justify-content-end gap-4">
                <div class="feature-content">
                  <h3>Pembayaran Digital</h3>
                  <p>Dukungan pembayaran melalui semua metode: transfer bank, e-wallet, QRIS, dan marketplace. Aman, cepat, dan tanpa ribet.</p>
                </div>
                <div class="feature-icon flex-shrink-0">
                  <i class="bi bi-eye"></i>
                </div>
              </div>
            </div><!-- End .feature-item -->

          </div>

          <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="phone-mockup text-center">
              <img src="assets/img/ipon.png" alt="Phone Mockup" class="img-fluid">
            </div>
          </div><!-- End Phone Mockup -->

          <div class="col-lg-4">

            <div class="feature-item mb-5" data-aos="fade-left" data-aos-delay="200">
              <div class="d-flex align-items-center gap-4">
                <div class="feature-icon flex-shrink-0">
                  <i class="bi bi-code-square"></i>
                </div>
                <div class="feature-content">
                  <h3>Lihat Jadwal Keberangkatan</h3>
                  <p>Lihat Jadwal Keberangkatan Sesuai dengan Masa Keberangkatan mu/p>
                </div>
              </div>
            </div><!-- End .feature-item -->

            <div class="feature-item mb-5" data-aos="fade-left" data-aos-delay="300">
              <div class="d-flex align-items-center gap-4">
                <div class="feature-icon flex-shrink-0">
                  <i class="bi bi-phone"></i>
                </div>
                <div class="feature-content">
                  <h3>Riwayat Pemesanan</h3>
                  <p>Lihat semua riwayat perjalanan Anda sebelumnya, lengkap dengan detail tiket dan invoice otomatis.</p>
                </div>
              </div>
            </div><!-- End .feature-item -->

            <div class="feature-item" data-aos="fade-left" data-aos-delay="400">
              <div class="d-flex align-items-center gap-4">
                <div class="feature-icon flex-shrink-0">
                  <i class="bi bi-browser-chrome"></i>
                </div>
                <div class="feature-content">
                  <h3>Akses Multi-Device</h3>
                  <p>Website kami dapat diakses dari berbagai perangkat – laptop, tablet, hingga smartphone – tanpa kendala.</p>
                </div>
              </div>
            </div><!-- End .feature-item -->

          </div>
        </div>

      </div>

    </section><!-- /Features 2 Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Testimoni</h2>
        <p>Berikut ini Testimoni Beberapa Penumpang Kami/p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row g-5">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="testimonial-item">
              <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
              <h3>Adi</h3>
              <h4>Penumpang</h4>
              <div class="stars">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
              </div>
              <p>
                <i class="bi bi-quote quote-icon-left"></i>
                <span>Perjalanan dari Medan ke Barus sangat nyaman! Mobil bersih, sopir ramah, dan tepat waktu. Sangat direkomendasikan untuk yang butuh travel rutin.</span>
                <i class="bi bi-quote quote-icon-right"></i>
              </p>
            </div>
          </div><!-- End testimonial item -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="testimonial-item">
              <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
              <h3>Dina</h3>
              <h4>Penumpang</h4>
              <div class="stars">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
              </div>
              <p>
                <i class="bi bi-quote quote-icon-left"></i>
                <span>Saya sudah beberapa kali kirim paket lewat travel ini, dan semuanya sampai dengan aman dan cepat. Terima kasih atas pelayanannya!</span>
                <i class="bi bi-quote quote-icon-right"></i>
              </p>
            </div>
          </div><!-- End testimonial item -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="testimonial-item">
              <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
              <h3>Anna</h3>
              <h4>Penumpang</h4>
              <div class="stars">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
              </div>
              <p>
                <i class="bi bi-quote quote-icon-left"></i>
                <span>Layanan antar jemput dari Bandara Kualanamu ke rumah saya sangat membantu. Driver-nya profesional dan komunikatif.</span>
                <i class="bi bi-quote quote-icon-right"></i>
              </p>
            </div>
          </div><!-- End testimonial item -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
            <div class="testimonial-item">
              <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
              <h3>Randy</h3>
              <h4>Penumpang</h4>
              <div class="stars">
                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
              </div>
              <p>
                <i class="bi bi-quote quote-icon-left"></i>
                <span>Booking tiketnya gampang banget lewat HP, bisa pilih jadwal dan langsung bayar. Gak perlu repot lagi datang ke loket!</span>
                <i class="bi bi-quote quote-icon-right"></i>
              </p>
            </div>
          </div><!-- End testimonial item -->

        </div>

      </div>

    </section><!-- /Testimonials Section -->

<footer id="footer" class="footer">

  <div class="container footer-top">
    <div class="row gy-4">
      <!-- Kolom kiri: Logo + Kontak -->
      <div class="col-lg-6 col-md-6 footer-about">
        <a href="index.html" class="logo d-flex align-items-center">
          <span class="sitename">PT RAJA BARUS BERTUAH</span>
        </a>
        <div class="footer-contact pt-3">
          <p><strong>Phone:</strong> <span>085261774223</span></p>
          <p><strong>Email:</strong> <span>rajabarustravel@gmail.com</span></p>
        </div>
        <div class="social-links d-flex mt-4">
          <a href=""><i class="bi bi-twitter-x"></i></a>
          <a href=""><i class="bi bi-facebook"></i></a>
          <a href=""><i class="bi bi-instagram"></i></a>
          <a href=""><i class="bi bi-linkedin"></i></a>
        </div>
      </div>

      <!-- Kolom kanan: Alamat -->
      <div class="col-lg-6 col-md-6 footer-address">
        <h4>Alamat Travel</h4>
        <p>Jl. Menteng Raya, Pasar Merah</p>
        <h4>Alamat Loket Medan</h4>
        <p>JL Syekh Rukunuddin, Padang Masiang</p>
      </div>
    </div>
  </div>

  <div class="container copyright text-center mt-4">
    <p>© <span>Copyright</span> <strong class="px-1 sitename">PT RAJA BARUS BERTUAH</strong> <span>All Rights Reserved</span></p>
  </div>

</footer>


</main>
@endsection

{{-- Kita bisa tambahkan style untuk action card di layout atau di sini --}}
@push('styles')
<style>
    .welcome-header {
        background: linear-gradient(90deg, rgba(25,118,210,1) 0%, rgba(30,136,229,1) 100%);
        color: white;
    }
    .action-card {
        transition: transform .2s ease-in-out, box-shadow .2s ease-in-out;
        border: none;
    }
    .action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
</style>
@endpush