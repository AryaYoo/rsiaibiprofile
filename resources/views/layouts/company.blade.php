<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RSIAIBI | Surabaya')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap (opsional, tetap boleh via CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicon Sederhana -->
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">


    <!-- CSS khusus Company -->
    @vite('resources/css/company.css')

    {{-- Styles tambahan per halaman --}}
    @yield('styles')

    {{-- Made with love -Yohanes Mahardika A- --}}
</head>
<body>
    {{-- Navbar --}}
    @include('layouts.partials.navbar-company')

    {{-- Konten dinamis --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.partials.footer-company')

    <!-- Bootstrap Bundle (opsional, tetap boleh via CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS khusus Company -->
    @vite('resources/js/company.js')

    {{-- Script tambahan per halaman --}}
    @stack('scripts')
</body>
</html>
