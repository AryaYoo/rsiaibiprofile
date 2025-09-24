@extends('layouts.company')

@section('content')
    <!-- Hero Section -->
    <section class="hero"
        style="background: url('{{ asset('images/hero-background.svg') }}') no-repeat center center / cover;">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Kami Hadir untuk Memberikan Pelayanan Kesehatan <span>Terbaik</span></h1>
                    <p>Memberikan pelayanan kesehatan berkualitas dengan kasih, profesionalisme, dan perhatian penuh untuk
                        ibu dan anak Anda.</p>
                    <div class="hero-buttons">
                        <a href="#" class="btn">Mulai Sekarang</a>
                        <a href="#" class="btn btn-accent" style="margin-left: 15px;">Pelajari Lebih Lanjut</a>
                    </div>
                </div>

                <div id="heroCarousel" class="carousel slide hero-image" data-bs-ride="carousel" data-bs-interval="3000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://direktori.vokasi.unair.ac.id/wp-content/uploads/2024/07/252.png"
                                class="d-block w-100" alt="App Illustration">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/249.png') }}" class="d-block w-100" alt="Second Slide">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/250.png') }}" class="d-block w-100" alt="Third Slide">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/251.png') }}" class="d-block w-100" alt="Fourth Slide">
                        </div>
                    </div>

                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>

                <style>
                    .hero-image {
                        border-radius: 20px;
                        overflow: hidden;
                        /* biar radius kepotong rapi */
                        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
                    }

                    .hero-image img {
                        object-fit: cover;
                        height: 100%;
                    }
                </style>


            </div>
        </div>
    </section>

    <section class="accent">
        <style>
            .accent {
                background-color: var(--primary);
                height: 50px;
                width: 100%;
            }
        </style>
    </section>


    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="section-title">
                <h2>Layanan RSIA IBI</h2>
                <p>Berbagai layanan kesehatan profesional dan penuh kasih untuk ibu dan anak Anda.</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <img src="{{ asset('images/1.svg') }}" alt="Gawat Darurat" style="width: 40px; height: 40px;">
                    </div>
                    <h3>Layanan Gawat Darurat</h3>
                    <p>Pemeriksaan kehamilan, konsultasi dokter spesialis, dan layanan persalinan modern.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <img src="{{ asset('images/2.svg') }}" alt="Gawat Darurat" style="width: 40px; height: 40px;">
                    </div>
                    <h3>Layanan Rawat Inap</h3>
                    <p>Perawatan anak, imunisasi lengkap, dan konsultasi kesehatan anak secara profesional.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <img src="{{ asset('images/4.svg') }}" alt="Gawat Darurat" style="width: 40px; height: 40px;">
                    </div>
                    <h3>Layanan Perawatan Khusus</h3>
                    <p>Layanan kesehatan gigi untuk anak dan ibu, termasuk perawatan preventif dan estetika.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <img src="{{ asset('images/6.svg') }}" alt="Gawat Darurat" style="width: 40px; height: 40px;">
                    </div>
                    <h3>Layanan Poli Rawat Jalan</h3>
                    <p>Tes laboratorium lengkap dan cepat dengan hasil akurat untuk diagnosis tepat.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <img src="{{ asset('images/7.svg') }}" alt="Gawat Darurat" style="width: 40px; height: 40px;">
                    </div>
                    <h3>Layanan Laboratorium</h3>
                    <p>Penyediaan obat dan konsultasi penggunaan obat secara aman dan terpercaya.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <img src="{{ asset('images/8.svg') }}" alt="Gawat Darurat" style="width: 40px; height: 40px;">
                    </div>
                    <h3>Layanan Farmasi</h3>
                    <p>Paket pemeriksaan kesehatan rutin untuk ibu dan anak dengan rekomendasi dokter.</p>
                </div>
            </div>

            <!-- Tombol Selengkapnya -->
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ url('/company-profile/layanan') }}" class="btn btn-accent">Selengkapnya</a>
            </div>
        </div>
    </section>

    <section class="accent">
        <style>
            .accent {
                background-color: var(--primary);
                height: 50px;
                width: 100%;
            }
        </style>
    </section>

    <!-- CTA Section -->
    <section class="cta cta-bg">
        <div class="container">
            <h2>RSIA IBI – Kami Hadir untuk Kesehatan Ibu dan Anak</h2>
            <p>Memberikan pelayanan kesehatan berkualitas dengan kasih, profesionalisme, dan perhatian penuh untuk ibu dan
                anak Anda.</p>
            <a href="#" class="btn btn-light">Hubungi Sekarang</a>
        </div>

        <style>
            .cta-bg {
                position: relative;
                padding: 100px 0;
                background-image: url('{{ asset('images/headerbg.svg') }}');
                /* path SVG di public/images */
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                color: white;
            }

            /* Overlay hitam semi-transparan */
            .cta-bg::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.4);
                /* 40% transparansi */
                z-index: 0;
            }

            .cta-bg .container {
                position: relative;
                z-index: 1;
                /* konten di atas overlay */
            }

            /* Pastikan teks tetap putih */
            .cta-bg h2,
            .cta-bg p {
                color: white !important;
            }
        </style>
    </section>
@endsection
