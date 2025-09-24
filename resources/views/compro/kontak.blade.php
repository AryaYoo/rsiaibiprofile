@extends('layouts.company')

@section('content')
    <!-- Hero Section -->
    <section class="hero text-center hero-bg">
        <div class="container" style="margin-top: 30px;">
            <h2 class="hero-title text-3xl font-extrabold mb-4">Kontak Kami</h2>
            <p class="hero-subtitle max-w-2xl mx-auto">
                Dapatkan informasi seputar pelayanan kami!
            </p>
        </div>

        <style>
            .hero-bg {
                background-image: url('{{ asset('images/header4bg.svg') }}');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                position: relative;
                padding: 100px 0 10px;
                /* dikurangi tinggi */
            }

            .hero-bg .container {
                position: relative;
                z-index: 1;
            }

            .hero-title {
                color: #014421ff !important;
                font-weight: 900;
            }

            .hero-subtitle {
                color: #3c3c3cff !important;
            }
        </style>
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

    <!-- Info Services Section -->
    <section class="services-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Informasi Layanan</h2>
            </div>

            <div class="services-grid">
                <!-- Card 1: Pelayanan Umum -->
                <div class="service-card">
                    <div class="card-icon">
                        <i class="fas fa-hospital-user"></i>
                    </div>
                    <h3 class="card-title">Pelayanan Umum</h3>
                    <p class="card-description">
                        Dapatkan informasi lengkap mengenai pelayanan kesehatan umum di RSIA IBI Surabaya.
                    </p>
                    <a href="#" class="card-button">Selengkapnya</a>
                </div>

                <!-- Card 2: Pelayanan BPJS -->
                <div class="service-card">
                    <div class="card-icon">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <h3 class="card-title">Pelayanan BPJS</h3>
                    <p class="card-description">
                        Informasi mengenai prosedur dan fasilitas bagi pasien dengan jaminan BPJS Kesehatan.
                    </p>
                    <a href="#" class="card-button">Selengkapnya</a>
                </div>

                <!-- Card 3: Pendaftaran Poli Non BPJS -->
                <div class="service-card">
                    <div class="card-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3 class="card-title">Pendaftaran Poli Non BPJS</h3>
                    <p class="card-description">
                        Cara mendaftar poli untuk pasien umum/non BPJS dengan mudah dan cepat.
                    </p>
                    <a href="#" class="card-button">Selengkapnya</a>
                </div>
            </div>
        </div>

        <style>
            .services-section {
                padding: 5rem 0;
                background-color: #f8f9fa;
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
            }

            .section-header {
                text-align: center;
                margin-bottom: 3rem;
            }

            .section-title {
                font-size: 2.25rem;
                font-weight: 700;
                color: #1a1a1a;
                margin-bottom: 1rem;
            }

            .services-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 2rem;
                justify-content: center;
            }

            .service-card {
                background: white;
                border-radius: 12px;
                padding: 2.5rem 2rem;
                text-align: center;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                display: flex;
                flex-direction: column;
                height: 100%;
            }

            .service-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            }

            .card-icon {
                margin-bottom: 1.5rem;
            }

            .card-icon i {
                font-size: 3rem;
                color: #007c3c;
            }

            .card-title {
                font-size: 1.5rem;
                font-weight: 600;
                color: #1a1a1a;
                margin-bottom: 1rem;
                line-height: 1.3;
            }

            .card-description {
                color: #666;
                line-height: 1.6;
                margin-bottom: 2rem;
                flex-grow: 1;
            }

            .card-button {
                background: #007c3c;
                color: white;
                padding: 12px 28px;
                border-radius: 50px;
                font-weight: 600;
                text-decoration: none;
                transition: all 0.3s ease;
                display: inline-block;
                border: 2px solid #007c3c;
                margin-top: auto;
            }

            .card-button:hover {
                background: #0ca35d;
                border-color: #0ca35d;
                transform: translateY(-2px);
            }

            @media (max-width: 768px) {
                .services-section {
                    padding: 3rem 0;
                }

                .section-title {
                    font-size: 1.875rem;
                }

                .services-grid {
                    grid-template-columns: 1fr;
                    gap: 1.5rem;
                }

                .service-card {
                    padding: 2rem 1.5rem;
                }
            }
        </style>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">Konsultasi Kesehatan Anda Sekarang</h2>
                <p class="cta-description">
                    Jangan tunda untuk menjaga kesehatan Anda dan keluarga. Hubungi kami untuk informasi lebih lanjut atau
                    buat
                    janji temu dengan dokter spesialis.
                </p>
                <a href="#" class="cta-button">Hubungi Kami</a>
            </div>
        </div>

        <style>
            .cta-section {
                padding: 4rem 0;
                background: linear-gradient(135deg, #f0f7f4 0%, #e8f4ef 100%);
                text-align: center;
            }

            .cta-content {
                max-width: 700px;
                margin: 0 auto;
            }

            .cta-title {
                font-size: 2rem;
                font-weight: 700;
                color: #1a1a1a;
                margin-bottom: 1.5rem;
            }

            .cta-description {
                font-size: 1.125rem;
                color: #666;
                line-height: 1.6;
                margin-bottom: 2.5rem;
            }

            .cta-button {
                background: white;
                color: #007c3c;
                padding: 14px 32px;
                border-radius: 50px;
                font-weight: 600;
                text-decoration: none;
                transition: all 0.3s ease;
                display: inline-block;
                border: 2px solid #007c3c;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }

            .cta-button:hover {
                background: #007c3c;
                color: white;
                transform: translateY(-2px);
                box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
            }

            @media (max-width: 768px) {
                .cta-section {
                    padding: 3rem 0;
                }

                .cta-title {
                    font-size: 1.75rem;
                }

                .cta-description {
                    font-size: 1rem;
                }
            }
        </style>
    </section>

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection
@endsection
