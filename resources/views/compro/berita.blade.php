@extends('layouts.company')

@section('content')
    <section class="hero text-center hero-bg">
        <div class="container" style="margin-top: 30px;">
            <h2 class="hero-title text-3xl font-extrabold mb-4">Informasi Berita</h2>
            <p class="hero-subtitle max-w-2xl mx-auto">
                Berita terbaru seputar rumah sakit ibu dan anak IBI Surabaya
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

    <section class="news-section">
        <div class="container">
            <div class="news-grid">
                <div class="news-card">
                    <img src="https://via.placeholder.com/400x250" alt="Berita 1">
                    <div class="news-content">
                        <span class="news-date">22 September 2025</span>
                        <h3>Meet Our New Doctor!</h3>
                        <p>Selamat datang, dr. Heri Slamet Santoso, Sp.OG, Dokter Spesialis Kandungan di RSIA IBI Surabaya. Siap memberikan pelayanan terbaik untuk kesehatan ibu dan calon buah hati tercinta.</p>
                        <a href="https://www.instagram.com/p/DNrfJAJZKCy/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA=="
                            class="btn" target="_blank" rel="noopener noreferrer">Baca Selengkapnya</a>
                    </div>
                </div>
                <div class="news-card">
                    <img src="https://via.placeholder.com/400x250" alt="Berita 2">
                    <div class="news-content">
                        <span class="news-date">20 September 2025</span>
                        <h3>Room Tour Ruang VIP RSIA IBI Surabaya</h3>
                        <p>Setiap momen bersama keluarga adalah istimewa Ruang VIP RSIA hadir untuk memberikan kenyamanan, privasi, dan ketenangan hati. </p>
                        <a href="https://www.instagram.com/reel/DOZ6KDaEY9W/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA=="
                            class="btn" target="_blank" rel="noopener noreferrer">Baca Selengkapnya</a>
                    </div>
                </div>
                <div class="news-card">
                    <img src="https://via.placeholder.com/400x250" alt="Berita 3">
                    <div class="news-content">
                        <span class="news-date">18 September 2025</span>
                        <h3>Pelatihan APAR</h3>
                        <p>Bukan sekadar teori, tapi langsung praktik! Di In House Training kali ini, kami belajar cara mencegah, mengendalikan, hingga menanggulangi kebakaran dengan benar</p>
                        <a href="https://www.instagram.com/reel/DOnJSbrka33/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA=="
                            class="btn" target="_blank" rel="noopener noreferrer">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            <style>
                .news-card .btn {
                    background: var(--primary);
                    color: white;
                    padding: 12px 28px;
                    border-radius: 50px;
                    font-weight: 600;
                    text-decoration: none;
                    display: inline-block;
                    transition: var(--transition);
                    border: none;
                    cursor: pointer;
                }

                .news-card .btn:hover {
                    background: var(--secondary);
                    transform: translateY(-3px);
                    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
                }
            </style>
        </div>

        <style>
            .news-section {
                padding: 6rem 0;
                background-color: var(--light);
            }

            .news-grid {
                display: grid;
                grid-template-columns: 1fr;
                gap: 2.5rem;
            }

            @media (min-width: 768px) {
                .news-grid {
                    grid-template-columns: repeat(3, 1fr);
                }
            }

            .news-card {
                background: white;
                border-radius: 15px;
                overflow: hidden;
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
                transition: var(--transition);
            }

            .news-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            }

            .news-card img {
                width: 100%;
                height: auto;
                display: block;
            }

            .news-content {
                padding: 20px;
            }

            .news-date {
                display: block;
                font-size: 0.9rem;
                color: #64748b;
                margin-bottom: 10px;
            }

            .news-content h3 {
                font-size: 1.5rem;
                color: var(--primary);
                margin-bottom: 10px;
            }

            .news-content p {
                font-size: 1rem;
                color: #475569;
                margin-bottom: 15px;
            }

            .news-content .btn {
                font-size: 0.9rem;
                padding: 10px 20px;
            }
        </style>
    </section>
@endsection

@section('styles')
    <style>
        .news-section {
            padding: 60px 0;
            background: #f9f9f9;
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        }

        .news-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            transition: transform 0.3s;
        }

        .news-card:hover {
            transform: translateY(-5px);
        }

        .news-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .news-content {
            padding: 20px;
        }

        .news-content h3 {
            margin: 10px 0;
            font-size: 20px;
            color: #333;
        }

        .news-date {
            font-size: 14px;
            color: #888;
        }

        .news-content p {
            font-size: 15px;
            color: #555;
            margin-bottom: 15px;
        }

        .news-content .btn {
            display: inline-block;
            padding: 8px 15px;
            background: #007bff;
            color: #fff;
            border-radius: 8px;
            font-size: 14px;
            transition: background 0.3s;
            text-decoration: none;
        }

        .news-content .btn:hover {
            background: #0056b3;
        }
    </style>
@endsection
