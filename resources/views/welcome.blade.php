@extends('layouts.company')

@section('content')
    {{-- ============================================
    HERO — Split Layout: Left Text + Right Promo Slider
    ============================================ --}}
    @php
        $firstPromo = $promotions->first();
        $heroBg = $firstPromo && $firstPromo->background
            ? asset('storage/' . $firstPromo->background)
            : asset('images/hero-background.svg');
        $heroVideo = $firstPromo && $firstPromo->video
            ? asset('storage/' . $firstPromo->video)
            : null;
    @endphp

    <section id="hero" data-nav-label="Beranda" class="hero-split">
        {{-- Background Layers for Cross-fade --}}
        <div id="bg-layer-1" class="hero-bg-layer active" style="background-image: url('{{ $heroBg }}');">
            @if($heroVideo)
                <video class="hero-video-bg" autoplay muted loop playsinline>
                    <source src="{{ $heroVideo }}" type="video/mp4">
                </video>
            @endif
        </div>
        <div id="bg-layer-2" class="hero-bg-layer" style="opacity: 0;"></div>
        
        <div class="hero-split-overlay"></div>
        <div class="container hero-split-content">
            {{-- LEFT: Text --}}
            <div class="hero-split-text">
                <span class="badge-tag">Rumah Sakit Ibu & Anak IBI Surabaya</span>
                <h1>Pelayanan Kesehatan <span>Berkualitas</span> untuk Keluarga Anda</h1>
                <p>Dengan kasih, profesionalisme, dan perhatian penuh — kami hadir untuk memberikan layanan terbaik bagi ibu
                    dan anak Anda.</p>
                <div class="hero-split-buttons">
                    <a href="#schedules" class="btn-hero primary">Jadwal Dokter Hari Ini</a>
                    <a href="{{ url('/company-profile/kontak') }}" class="btn-hero outline">Hubungi Kami</a>
                </div>
            </div>

            {{-- RIGHT: Promo Slider Box --}}
            <div class="hero-split-slider">
                <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                    <div class="carousel-inner">
                        @forelse($promotions as $index => $promo)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" 
                                 data-bg="{{ $promo->background ? asset('storage/' . $promo->background) : asset('images/hero-background.svg') }}"
                                 data-video="{{ $promo->video ? asset('storage/' . $promo->video) : '' }}">
                                <img src="{{ asset('storage/' . $promo->image) }}" alt="{{ $promo->title }}">
                                @if($promo->title || $promo->subtitle)
                                    <div class="promo-caption text-center" style="border-left: none; padding-left: 0;">
                                        <h5 class="mb-2" style="font-size: 1.4rem;">{{ $promo->title }}</h5>
                                        @if($promo->subtitle)
                                        <p class="mb-0" style="font-size: 1rem; opacity: 0.9;">{{ $promo->subtitle }}</p>@endif
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="carousel-item active" data-bg="{{ asset('images/hero-background.svg') }}" data-video="">
                                <img src="{{ asset('images/hero-default.jpg') }}" alt="RSIA IBI">
                            </div>
                        @endforelse
                    </div>

                    @if($promotions->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" style="width: 40px; height: 40px; background: rgba(0,0,0,0.3); border-radius: 50%; top: 50%; transform: translateY(-100%); left: 15px;">
                            <span class="carousel-control-prev-icon" aria-hidden="true" style="width: 20px;"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" style="width: 40px; height: 40px; background: rgba(0,0,0,0.3); border-radius: 50%; top: 50%; transform: translateY(-100%); right: 15px;">
                            <span class="carousel-control-next-icon" aria-hidden="true" style="width: 20px;"></span>
                        </button>
                        <div class="carousel-indicators">
                            @foreach($promotions as $i => $promo)
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $i }}"
                                    class="{{ $i == 0 ? 'active' : '' }}"></button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <style>
        .hero-bg-layer {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            z-index: -1;
            transition: opacity 1.2s ease-in-out;
        }
        .hero-video-bg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const carousel = document.getElementById('heroCarousel');
            let activeLayer = 1;

            if (carousel) {
                carousel.addEventListener('slide.bs.carousel', (event) => {
                    const nextSlide = event.relatedTarget;
                    const nextBg = nextSlide.getAttribute('data-bg');
                    const nextVideo = nextSlide.getAttribute('data-video');
                    
                    const layer1 = document.getElementById('bg-layer-1');
                    const layer2 = document.getElementById('bg-layer-2');
                    
                    const targetLayer = activeLayer === 1 ? layer2 : layer1;
                    const currentLayer = activeLayer === 1 ? layer1 : layer2;

                    // Prepare target layer
                    targetLayer.style.backgroundImage = nextBg ? `url('${nextBg}')` : 'none';
                    if (nextVideo) {
                        targetLayer.innerHTML = `<video class="hero-video-bg" autoplay muted loop playsinline><source src="${nextVideo}" type="video/mp4"></video>`;
                    } else {
                        targetLayer.innerHTML = '';
                    }

                    // Cross-fade (Dissolve)
                    targetLayer.style.opacity = '1';
                    currentLayer.style.opacity = '0';

                    // Toggle active state
                    activeLayer = activeLayer === 1 ? 2 : 1;
                });
            }
        });
    </script>

    {{-- ============================================
    OVERLAP BAR — Stats / Highlights
    ============================================ --}}
    <div class="overlap-bar reveal">
        <div class="overlap-bar-inner">
            <div class="stat-item">
                <div class="stat-icon"><i class="bi bi-heart-pulse"></i></div>
                <h4><span class="counter" data-target="24">0</span>/7</h4>
                <p>Layanan IGD</p>
            </div>
            <div class="stat-item">
                <div class="stat-icon"><i class="bi bi-people"></i></div>
                <h4><span class="counter" data-target="50">0</span>+</h4>
                <p>Tenaga Medis Profesional</p>
            </div>
            <div class="stat-item">
                <div class="stat-icon"><i class="bi bi-hospital"></i></div>
                <h4><span class="counter" data-target="20">0</span>+</h4>
                <p>Layanan Kesehatan</p>
            </div>
            <div class="stat-item">
                <div class="stat-icon"><i class="bi bi-emoji-smile"></i></div>
                <h4><span class="counter" data-target="10">0</span>K+</h4>
                <p>Pasien Terlayani</p>
            </div>
        </div>
    </div>

    {{-- ============================================
    LAYANAN / FEATURES SECTION
    ============================================ --}}
    <section id="services-preview" data-nav-label="Layanan" class="section-padding">
        <div class="container-standard">
            <div class="section-title reveal">
                <span class="label">Layanan Kami</span>
                <h2>Layanan Unggulan RSIA IBI</h2>
                <p>Berbagai layanan kesehatan profesional dan penuh kasih untuk ibu dan anak Anda.</p>
            </div>
            <div class="features-grid reveal-stagger">
                @foreach($services as $service)
                    <div class="feature-card">
                        <div class="feature-icon">
                            @if($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}"
                                    style="width: 32px; height: 32px; border-radius: 6px;">
                            @elseif($service->icon)
                                <i class="{{ $service->icon }}"></i>
                            @else
                                <i class="bi bi-plus-circle"></i>
                            @endif
                        </div>
                        <h3>{{ $service->title }}</h3>
                        <p>{{ Str::limit($service->description, 100) }}</p>
                    </div>
                @endforeach
            </div>

            <div style="text-align: center; margin-top: 48px;" class="reveal">
                <a href="{{ url('/company-profile/layanan') }}" class="btn btn-accent">Lihat Semua Layanan →</a>
            </div>
        </div>
    </section>

    {{-- ============================================
    JADWAL DOKTER HARI INI
    ============================================ --}}
    <section id="schedules" data-nav-label="Jadwal" class="section-padding" style="background: white; border-top: 1px solid var(--border-soft);">
        <div class="container">
            <div class="section-title reveal">
                <span class="label">Jadwal Praktik</span>
                <h2>Jadwal Dokter Hari Ini ({{ $todayString ?? 'Hari Ini' }})</h2>
                <p>Jadwal dapat berubah, harap hubungi admin untuk konfirmasi</p>
            </div>

            <div class="features-grid reveal-stagger" style="display: grid; grid-template-columns: repeat(3, 1fr) !important; gap: 24px;">
                @forelse($todaySchedules ?? [] as $schedule)
                    <div class="feature-card" style="display: flex; flex-direction: column; align-items: center; text-align: center; border: 1px solid var(--border-soft); box-shadow: var(--shadow-sm);">
                        @if($schedule->doctor->image)
                            <img src="{{ asset('storage/' . $schedule->doctor->image) }}" alt="{{ $schedule->doctor->name }}" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-bottom: 16px; border: 2px solid var(--border-soft);">
                        @else
                            <div style="width: 80px; height: 80px; border-radius: 50%; background: var(--primary-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: bold; margin-bottom: 16px;">
                                {{ substr($schedule->doctor->name, 0, 1) }}
                            </div>
                        @endif
                        
                        <h3 style="margin-bottom: 4px;">{{ $schedule->doctor->name }}</h3>
                        <span style="display: inline-block; background: var(--primary-soft); color: var(--primary); padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 700; margin-bottom: 16px;">
                            {{ $schedule->doctor->specialty ?? 'Umum' }}
                        </span>
                        
                        <div style="width: 100%; text-align: left; background: var(--bg-main); padding: 12px; border-radius: 8px; margin-top: auto;">
                            <div style="display: flex; align-items: center; margin-bottom: 8px;">
                                <i class="far fa-calendar-alt text-emerald-600 mr-2 w-5"></i>
                                <span style="font-size: 0.9rem; font-weight: 600; color: var(--text-main);">{{ $schedule->day }}</span>
                            </div>
                            <div style="display: flex; align-items: center;">
                                <i class="far fa-clock text-emerald-600 mr-2 w-5"></i>
                                <span style="font-size: 0.9rem; color: var(--text-muted);">{{ $schedule->time }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 48px; background: white; border-radius: 16px; border: 1px dashed var(--border-soft);">
                        <i class="fas fa-calendar-times" style="font-size: 3rem; color: var(--border-soft); margin-bottom: 16px;"></i>
                        <h3 style="color: var(--text-muted);">Belum ada jadwal dokter yang tersedia untuk hari ini.</h3>
                    </div>
                @endforelse
            </div>

            <div style="text-align: center; margin-top: 48px;" class="reveal">
                <a href="{{ url('/company-profile/layanan') }}#jadwal-layanan" class="btn btn-accent">Lihat Semua Jadwal →</a>
            </div>
        </div>
    </section>

    {{-- ============================================
    CTA SECTION
    ============================================ --}}
    <section id="cta" data-nav-label="Konsultasi" class="cta-modern">
        <div class="container">
            <h2>RSIA IBI — Kami Hadir untuk Anda</h2>
            <p>Memberikan pelayanan kesehatan berkualitas dengan kasih, profesionalisme, dan perhatian penuh untuk ibu dan
                anak Anda.</p>
            <a href="{{ url('/company-profile/kontak') }}" class="btn btn-light">Hubungi Kami Sekarang →</a>
        </div>
    </section>
@endsection