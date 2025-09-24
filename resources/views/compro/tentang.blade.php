@extends('layouts.company')

@section('content')
    <!-- Hero Section -->
    <section class="hero text-center hero-bg">
        <div class="container" style="margin-top: 30px;">
            <h2 class="hero-title text-3xl font-extrabold mb-4">Tentang Kami</h2>
            <p class="hero-subtitle max-w-2xl mx-auto">
                Mengenal lebih dekat visi, misi, dan nilai yang kami pegang untuk memberikan pelayanan kesehatan terbaik.
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

    <!-- About Section -->
    <section class="about py-16 bg-light">
        <div class="container">
            <div class="about-grid">
                <!-- Teks About -->
                <div class="about-text">
                    <h3 class="section-title">RSIA IBI SURABAYA</h3>
                    <p class="about-paragraph">
                        Rumah Sakit Ibu dan Anak (RSIA) IBI Surabaya adalah fasilitas kesehatan yang berlokasi di Jl. Dupak
                        No. 15A Surabaya. Fokus utama rumah sakit ini adalah pada pelayanan kesehatan ibu dan anak,
                        khususnya dalam mendukung proses persalinan baik secara normal maupun caesar. RSIA IBI memiliki
                        status rumah sakit kelas C, dengan fasilitas yang meliputi ruang UGD 24 jam, ruang operasi, serta
                        berbagai layanan kebidanan, kandungan, dan kesehatan anak. Selain itu, rumah sakit ini juga menerima
                        pasien dengan jaminan BPJS Kesehatan dan memiliki tenaga medis spesialis di bidang obstetri,
                        ginekologi, dan pediatri.
                    </p>
                </div>

                <!-- Foto Direktur -->
                <div class="about-image">
                    <img src="{{ asset('images/direktur.jpg') }}" alt="Direktur RSIA IBI Surabaya">
                    <p class="image-caption">Dr. Ramli Tarigan (Direktur)</p>
                </div>
            </div>
        </div>

        <style>
            .about {
                padding-top: 4rem;
                padding-bottom: 4rem;
            }

            .section-title {
                font-size: 2.5rem;
                font-weight: 700;
                color: var(--primary);
                margin-bottom: 1.5rem;
            }

            .about-paragraph {
                line-height: 1.7;
                color: #475569;
            }

            .about-image img {
                width: 100%;
                border-radius: 12px;
                margin-bottom: 0.75rem;
            }

            .image-caption {
                text-align: center;
                font-size: 1rem;
                color: #64748b;
                font-weight: 500;
            }

            @media (max-width: 768px) {
                .about {
                    padding-top: 4rem;
                    padding-bottom: 4rem;
                }

                .section-title {
                    font-size: 2rem;
                }
            }
        </style>
    </section>

    <!-- Vision & Mission Section -->
    <section class="vision-mission-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Visi & Misi Kami</h2>
                <p class="section-subtitle">Komitmen kami dalam memberikan pelayanan terbaik untuk ibu dan anak</p>
            </div>

            <div class="vision-mission-grid">
                <!-- Visi Card -->
                <div class="vision-card">
                    <div class="card-icon">
                        <svg viewBox="0 0 24 24" width="48" height="48">
                            <path fill="currentColor"
                                d="M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9M12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17M12,4.5C7,4.5 2.73,7.61 1,12C2.73,16.39 7,19.5 12,19.5C17,19.5 21.27,16.39 23,12C21.27,7.61 17,4.5 12,4.5Z" />
                        </svg>
                    </div>
                    <h3 class="card-title">Visi</h3>
                    <div class="card-content">
                        <p>Mewujudkan Rumah sakit Ibu dan Anak Ikatan Bidan Indonesia yang unggul dalam pelayanan yang
                            profesional sebagai pilihan masyarakat Kota Surabaya dan sekitarnya.</p>
                    </div>
                </div>

                <!-- Misi Card -->
                <div class="mission-card">
                    <div class="card-icon">
                        <svg viewBox="0 0 24 24" width="48" height="48">
                            <path fill="currentColor"
                                d="M21,16.5C21,16.88 20.79,17.21 20.47,17.38L12.57,21.82C12.41,21.94 12.21,22 12,22C11.79,22 11.59,21.94 11.43,21.82L3.53,17.38C3.21,17.21 3,16.88 3,16.5V7.5C3,7.12 3.21,6.79 3.53,6.62L11.43,2.18C11.59,2.06 11.79,2 12,2C12.21,2 12.41,2.06 12.57,2.18L20.47,6.62C20.79,6.79 21,7.12 21,7.5V16.5M12,4.15L5,8.09V15.91L12,19.85L19,15.91V8.09L12,4.15Z" />
                        </svg>
                    </div>
                    <h3 class="card-title">Misi</h3>
                    <div class="card-content">
                        <ul class="mission-list">
                            <li><span class="list-icon">✓</span>Mengembangkan pelayanan kesehatan ibu dan anak yang prima
                                secara professional</li>
                            <li><span class="list-icon">✓</span>Mengembangkan SDM secara profesional berwawasan IT melalui
                                pendidikan dan pelatihan</li>
                            <li><span class="list-icon">✓</span>Bekerjasama dengan pemerintah dan swasta dalam meningkatkan
                                derajat kesehatan masyarakat kota surabaya dan sekitarnya melalui pelayanan kesehatan ibu
                                dan anak secara paripurna</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .vision-mission-section {
                padding: 5rem 0;
                /* padding top dikurangi */
                background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
                position: relative;
                overflow: hidden;
            }

            @media (max-width: 768px) {
                .vision-mission-section {
                    padding: 3rem 0;
                }
            }
        </style>


        <style>
            .vision-mission-section {
                padding: 4rem 0;
                /* disesuaikan dengan global section padding */
                background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
                position: relative;
                overflow: hidden;
            }

            .section-header {
                text-align: center;
                margin-bottom: 4rem;
            }

            .section-title {
                font-size: 2.5rem;
                font-weight: 700;
                color: var(--primary);
                /* warna primary sesuai global */
                margin-bottom: 1rem;
                position: relative;
                display: inline-block;
            }

            .section-title::after {
                content: "";
                position: absolute;
                bottom: -10px;
                left: 50%;
                transform: translateX(-50%);
                width: 80px;
                height: 4px;
                background: var(--primary);
                border-radius: 2px;
            }

            .section-subtitle {
                font-size: 1.125rem;
                color: #64748b;
                max-width: 600px;
                margin: 0 auto;
                line-height: 1.6;
            }

            .vision-mission-grid {
                display: grid;
                grid-template-columns: 1fr;
                gap: 2.5rem;
                max-width: 1000px;
                margin: 0 auto;
            }

            @media (min-width: 768px) {
                .vision-mission-grid {
                    grid-template-columns: 1fr 1fr;
                    gap: 3rem;
                }
            }

            .vision-card,
            .mission-card {
                background: white;
                border-radius: 16px;
                padding: 2.5rem;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .vision-card:hover,
            .mission-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            }

            .card-icon {
                display: flex;
                justify-content: center;
                margin-bottom: 1.5rem;
                color: var(--primary);
            }

            .mission-card .card-icon {
                color: var(--accent);
            }

            .card-title {
                font-size: 1.75rem;
                font-weight: 600;
                color: var(--primary);
                margin-bottom: 1.5rem;
                text-align: center;
            }

            .card-content {
                color: #475569;
                line-height: 1.7;
            }

            .mission-list li {
                display: flex;
                align-items: flex-start;
                margin-bottom: 1rem;
                padding: 0.75rem;
                border-radius: 8px;
                transition: background 0.2s ease;
            }

            .mission-list li:hover {
                background: #f8fafc;
            }

            .list-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 24px;
                height: 24px;
                background: var(--secondary);
                color: white;
                border-radius: 50%;
                font-size: 0.875rem;
                font-weight: bold;
                margin-right: 1rem;
                flex-shrink: 0;
                margin-top: 2px;
            }

            @media (max-width: 768px) {
                .vision-mission-section {
                    padding: 5rem 0;
                }

                .section-title {
                    font-size: 2rem;
                }

                .vision-card,
                .mission-card {
                    padding: 2rem;
                }
            }
        </style>
    </section>

    <section class="accent">
        <div class="container">
            <h2 class="accent-title">Struktur Organisasi</h2>
        </div>

        <style>
            .accent {
                background-color: var(--primary);
                width: 100%;
                padding: 2rem 0;
                /* tinggi section jadi lebih fleksibel */
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .accent-title {
                color: white;
                font-size: 2rem;
                font-weight: 700;
                text-align: center;
                margin: 0;
            }

            @media (max-width: 768px) {
                .accent-title {
                    font-size: 1.5rem;
                }
            }
        </style>
    </section>

    <section class="struktur-organisasi">
        <div class="container">
            <img src="{{ asset('images/struktur-organisasi.jpg') }}" alt="Struktur Organisasi RSIA IBI Surabaya">
        </div>

        <style>
            .struktur-organisasi {
                padding: 4rem 0;
                /* jarak atas & bawah section */
                background-color: #f8fafc;
                /* bisa disesuaikan dengan tema */
            }

            .struktur-organisasi .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
                display: flex;
                justify-content: center;
            }

            .struktur-organisasi img {
                width: 100%;
                max-width: 1000px;
                /* agar tidak terlalu besar */
                height: auto;
                border-radius: 12px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            }

            @media (max-width: 768px) {
                .struktur-organisasi {
                    padding: 3rem 0;
                }
            }
        </style>
    </section>
@endsection

@section('styles')
    <style>
        .about-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
        }

        @media(min-width: 768px) {
            .about-grid {
                grid-template-columns: 1fr 1fr;
                align-items: center;
            }
        }

        .about-text p {
            line-height: 1.7;
            color: #3c3c3cff;
        }

        .about-image img {
            width: 100%;
            border-radius: 10px;
        }

        .card {
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .cta {
            background: var(--primary);
            color: white;
            padding: 80px 0;
        }

        .cta h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .cta p {
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto 30px;
        }

        .btn-light {
            background: white;
            color: var(--primary);
            border: none;
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-light:hover {
            background: #f1f1f1;
        }
    </style>
@endsection
