<header>
    <div class="container">
        <nav>
            <a href="{{ url('/') }}" class="logo" style="display: flex; align-items: center; gap: 8px;">
                <img src="{{ asset('images/logo.png') }}" alt="RSIA IBI" style="height: 40px;">
                <span>RSIA<span>IBI</span></span>
            </a>
            <ul class="nav-links">
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li><a href="{{ url('/company-profile/layanan') }}">Layanan</a></li>
                <li><a href="{{ url('/company-profile/tentang') }}">Tentang</a></li>
                <li><a href="{{ url('/company-profile/berita') }}">Berita</a></li>
                <li><a href="{{ url('/company-profile/kontak') }}">Kontak</a></li>
                <li><a href="{{ url('/company-profile/galeri') }}">Galeri</a></li>
            </ul>
            {{-- <button class="mobile-menu-btn">☰</button>
            <a href="{{ url('/login') }}" class="btn">Hubungi Kami</a> --}}
        </nav>
    </div>

    <style>
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav .nav-links {
            display: flex;
            list-style: none;
            gap: 20px;
            margin: 0;
            padding: 0;
        }

        nav .nav-links li a {
            text-decoration: none;
            color: #333;
        }
    </style>
</header>
