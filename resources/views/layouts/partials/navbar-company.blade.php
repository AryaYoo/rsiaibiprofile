<header id="mainHeader">
    <div class="nav-capsule">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="RSIA IBI" style="height: 36px;">
            <div class="brand-text">
                <span class="main-brand">RSIA<span>IBI</span></span>
            </div>
        </a>
        <ul class="nav-links">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="{{ route('compro.layanan') }}" class="{{ request()->routeIs('compro.layanan') ? 'active' : '' }}">Layanan</a></li>
            <li><a href="{{ route('compro.tentang') }}" class="{{ request()->routeIs('compro.tentang') ? 'active' : '' }}">Tentang</a></li>
            <li><a href="{{ route('compro.berita') }}" class="{{ request()->routeIs('compro.berita') ? 'active' : '' }}">Berita</a></li>
            <li><a href="{{ route('compro.kontak') }}" class="{{ request()->routeIs('compro.kontak') ? 'active' : '' }}">Kontak</a></li>
            <li><a href="{{ route('compro.galeri') }}" class="{{ request()->routeIs('compro.galeri') ? 'active' : '' }}">Galeri</a></li>
        </ul>
    </div>
</header>
