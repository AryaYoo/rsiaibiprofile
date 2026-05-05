<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RSIAIBI | Surabaya')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Urbanist:wght@700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

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

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS khusus Company -->
    @vite('resources/js/company.js')

    {{-- Script tambahan per halaman --}}
    @stack('scripts')

    <!-- WhatsApp Float -->
    <a href="https://wa.me/6285852963005" class="whatsapp-float" target="_blank" rel="noopener noreferrer">
        <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="WhatsApp" width="50" height="50">
    </a>

    <style>
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 32px;
            right: 32px;
            background-color: var(--primary);
            color: #fff;
            border-radius: 50%;
            box-shadow: 0 8px 24px rgba(18, 53, 36, 0.25);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .whatsapp-float:hover {
            transform: scale(1.1);
            background-color: var(--primary-light);
            box-shadow: 0 12px 32px rgba(18, 53, 36, 0.3);
        }

        .whatsapp-float img {
            width: 34px;
            height: 34px;
        }
    </style>

    <!-- Header scroll effect & Section Nav -->
    <script>
        window.addEventListener('scroll', function() {
            const header = document.getElementById('mainHeader');
            if (header) {
                header.classList.toggle('scrolled', window.scrollY > 60);
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            const sections = document.querySelectorAll('section[id]');
            if (sections.length < 2) return; // Don't show if only 1 section

            const nav = document.createElement('div');
            nav.className = 'section-nav';

            sections.forEach(section => {
                const item = document.createElement('div');
                item.className = 'section-nav-item';
                const label = section.getAttribute('data-nav-label') || section.id.replace(/-/g, ' ');
                item.setAttribute('data-label', label);
                
                item.addEventListener('click', () => {
                    const offset = 80;
                    const bodyRect = document.body.getBoundingClientRect().top;
                    const elementRect = section.getBoundingClientRect().top;
                    const elementPosition = elementRect - bodyRect;
                    const offsetPosition = elementPosition - offset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                });

                nav.appendChild(item);
            });

            document.body.appendChild(nav);

            function updateActive() {
                let current = "";
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    if (window.pageYOffset >= sectionTop - 150) {
                        current = section.getAttribute("id");
                    }
                });

                document.querySelectorAll('.section-nav-item').forEach((item, index) => {
                    item.classList.remove('active');
                    if (sections[index].getAttribute('id') === current) {
                        item.classList.add('active');
                    }
                });
            }

            window.addEventListener('scroll', updateActive);
            updateActive();
        });
    </script>
</body>

</html>
