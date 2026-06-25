<header id="mainHeader">
    <div class="nav-capsule">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="RSIA IBI" style="height: 36px;">
            <div class="brand-text">
                <span class="main-brand">RSIA<span>IBI</span></span>
            </div>
        </a>
        <button class="nav-toggle" id="navToggle" aria-label="Toggle Navigation">
            <i class="fas fa-bars"></i>
        </button>
        <ul class="nav-links">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="{{ route('compro.layanan') }}"
                    class="{{ request()->routeIs('compro.layanan') ? 'active' : '' }}">Layanan</a></li>
            <li><a href="{{ route('compro.tentang') }}"
                    class="{{ request()->routeIs('compro.tentang') ? 'active' : '' }}">Tentang</a></li>
            <li><a href="{{ route('compro.berita') }}"
                    class="{{ request()->routeIs('compro.berita') ? 'active' : '' }}">Berita & Artikel</a></li>
            <li><a href="{{ route('compro.kontak') }}"
                    class="{{ request()->routeIs('compro.kontak') ? 'active' : '' }}">Kontak</a></li>
            <li><a href="{{ route('compro.galeri') }}"
                    class="{{ request()->routeIs('compro.galeri') ? 'active' : '' }}">Galeri</a></li>
            <li><a href="{{ route('compro.pendaftaran') }}" class="btn-cta">Pendaftaran Online</a></li>
        </ul>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('navToggle');
        const links = document.querySelector('.nav-links');
        const capsule = document.querySelector('.nav-capsule');
        
        if (toggle && links && capsule) {
            toggle.addEventListener('click', function () {
                links.classList.toggle('active');
                capsule.classList.toggle('active');
                
                // Toggle between hamburger and close icon
                const icon = toggle.querySelector('i');
                if (icon) {
                    if (links.classList.contains('active')) {
                        icon.className = 'fas fa-times';
                    } else {
                        icon.className = 'fas fa-bars';
                    }
                }
            });
        }
    });
</script>