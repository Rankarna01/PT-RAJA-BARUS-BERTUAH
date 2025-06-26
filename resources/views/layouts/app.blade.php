<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">

 <meta name="csrf-token" content="{{ csrf_token() }}">

 <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Dashboard')</title>

 <link rel="dns-prefetch" href="//fonts.bunny.net">
 <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

 <style>
 body {
 background-color: #e3f2fd; /* Warna biru muda sebagai background */
 }
 .navbar {
 background-color: #1976d2 !important; /* Warna biru tua untuk navbar */
 }
 .navbar-brand {
 font-weight: bold;
 }
 .nav-link {
 color: white !important;
 }
 .dropdown-menu {
 background-color: #1976d2;
 }
 .dropdown-item {
 color: white;
 }
 .dropdown-item:hover {
 background-color: #1565c0;
 }
 .card {
 border: none;
 box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
 border-radius: 0.5rem;
 }
 </style>

 @stack('styles')
</head>
<body>
 <div id="app">
 @yield('content')
 </div>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
 @stack('scripts')
</body>
</html>