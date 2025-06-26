@extends('layouts.app')
@extends('pelanggan.home')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/">PT Raja Barus Bertuah</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
         @auth
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
            </li>
            <li class="nav-item">
               <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link">Logout</button>
                </form>
            </li>
         @else
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
             @if (Route::has('register'))
             <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
            @endif
         @endauth
      </ul>
    </div>
  </div>
</nav>

<div class="container text-center py-5">
    <h1 class="display-4 fw-bold">Pesan Tiket Travel Medan - Barus</h1>
    <p class="lead text-muted mt-3">Cari jadwal keberangkatan dan pesan tiket Anda sekarang juga.</p>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg">
                <div class="card-body p-5">
                    <form action="#" method="GET">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="asal" class="form-label">Rute Asal</label>
                                <select id="asal" name="asal" class="form-select form-select-lg">
                                    <option selected>Medan</option>
                                    <option>Barus</option>
                                </select>
                            </div>
                             <div class="col-md-4">
                                <label for="tujuan" class="form-label">Rute Tujuan</label>
                                <select id="tujuan" name="tujuan" class="form-select form-select-lg">
                                    <option>Medan</option>
                                    <option selected>Barus</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="tanggal" class="form-label">Tanggal Berangkat</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control form-control-lg">
                            </div>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">Cari Tiket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="text-center py-4 mt-5 text-muted">
    <p>Copyright &copy; {{ date('Y') }} TravelGo</p>
</footer>
@endsection