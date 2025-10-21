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

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">


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


    <a href="https://wa.me/6285852963005" class="whatsapp-float" target="_blank" rel="noopener noreferrer">
        <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="WhatsApp" width="50" height="50">
    </a>

    <style>
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 20px;
            right: 20px;
            background-color: #25d366;
            color: #fff;
            border-radius: 50px;
            text-align: center;
            box-shadow: 2px 2px 5px #999;
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: transform 0.2s ease-in-out;
        }

        .whatsapp-float:hover {
            transform: scale(1.1);
        }

        .whatsapp-float img {
            width: 35px;
            height: 35px;
        }
    </style>
</body>

</html>
