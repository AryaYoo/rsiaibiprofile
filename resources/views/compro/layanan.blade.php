@extends('layouts.company')

@section('content')
    <!-- Hero Section -->
    <section class="hero text-center hero-bg">
        <div class="container" style="margin-top: 30px;">
            <h2 class="hero-title text-3xl font-extrabold mb-4">Layanan Kami</h2>
            <p class="hero-subtitle max-w-2xl mx-auto">
                Berbagai layanan kesehatan profesional dan penuh kasih untuk ibu dan anak Anda
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

    <!-- Tab Buttons Section -->
    <section class="tab-buttons-section">
        <div class="container text-center py-2">
            <button class="tab-btn active" data-tab="medis">Medis & Keperawatan</button>
            <button class="tab-btn" data-tab="administrasi">Administrasi</button>
        </div>

        <style>
            .tab-buttons-section {
                background-color: #f1f1f1;
                /* abu-abu */
            }

            .tab-btn {
                padding: 8px 20px;
                /* dikurangi sedikit */
                margin: 0 8px;
                /* jarak antar tombol sedikit lebih rapat */
                border: none;
                background: #e0e0e0;
                color: #333;
                font-weight: 600;
                cursor: pointer;
                border-radius: 8px;
                transition: 0.3s;
            }

            .tab-btn.active {
                background: var(--primary);
                color: white;
            }
        </style>
    </section>


    <!-- Tab Contents Section -->
    <section class="features">
        <div class="container">
            <div class="tab-content" id="medis">
                <div class="features-grid">
                    <!-- Contoh feature card -->
                    <div class="feature-card">
                        <div class="feature-icon">
                            <img src="{{ asset('images/1.svg') }}" alt="Gawat Darurat" style="width: 40px; height: 40px;">
                        </div>
                        <h3>Layanan Gawat Darurat</h3>
                        <p>Pemeriksaan kehamilan, konsultasi dokter spesialis, dan layanan persalinan modern.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <img src="{{ asset('images/2.svg') }}" alt="Rawat Inap" style="width: 40px; height: 40px;">
                        </div>
                        <h3>Layanan Rawat Inap</h3>
                        <p>Perawatan anak, imunisasi lengkap, dan konsultasi kesehatan anak secara profesional.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <img src="{{ asset('images/4.svg') }}" alt="Perawatan Khusus"
                                style="width: 40px; height: 40px;">
                        </div>
                        <h3>Layanan Perawatan Khusus</h3>
                        <p>Layanan kesehatan gigi untuk anak dan ibu, termasuk perawatan preventif dan estetika.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <img src="{{ asset('images/6.svg') }}" alt="Poli Rawat Jalan"
                                style="width: 40px; height: 40px;">
                        </div>
                        <h3>Layanan Poli Rawat Jalan</h3>
                        <p>Tes laboratorium lengkap dan cepat dengan hasil akurat untuk diagnosis tepat.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <img src="{{ asset('images/7.svg') }}" alt="Laboratorium" style="width: 40px; height: 40px;">
                        </div>
                        <h3>Layanan Laboratorium</h3>
                        <p>Penyediaan obat dan konsultasi penggunaan obat secara aman dan terpercaya.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <img src="{{ asset('images/8.svg') }}" alt="Farmasi" style="width: 40px; height: 40px;">
                        </div>
                        <h3>Layanan Farmasi</h3>
                        <p>Paket pemeriksaan kesehatan rutin untuk ibu dan anak dengan rekomendasi dokter.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <img src="{{ asset('images/9.svg') }}" alt="Farmasi" style="width: 40px; height: 40px;">
                        </div>
                        <h3>Layanan Gizi</h3>
                        <p>Paket pemeriksaan kesehatan rutin untuk ibu dan anak dengan rekomendasi dokter.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <img src="{{ asset('images/10.svg') }}" alt="Farmasi" style="width: 40px; height: 40px;">
                        </div>
                        <h3>Layanan Rekam Medik</h3>
                        <p>Paket pemeriksaan kesehatan rutin untuk ibu dan anak dengan rekomendasi dokter.</p>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="administrasi" style="display:none;">
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <img src="{{ asset('images/11.svg') }}" alt="Poli Rawat Jalan"
                                style="width: 40px; height: 40px;">
                        </div>
                        <h3>Layanan Administrasi Perkantoran</h3>
                        <p>Tes laboratorium lengkap dan cepat dengan hasil akurat untuk diagnosis tepat.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <img src="{{ asset('images/12.svg') }}" alt="Laboratorium" style="width: 40px; height: 40px;">
                        </div>
                        <h3>Layanan Administrasi Keuangan</h3>
                        <p>Penyediaan obat dan konsultasi penggunaan obat secara aman dan terpercaya.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <img src="{{ asset('images/13.svg') }}" alt="Farmasi" style="width: 40px; height: 40px;">
                        </div>
                        <h3>Layanan Administrasi Rekam Medis</h3>
                        <p>Paket pemeriksaan kesehatan rutin untuk ibu dan anak dengan rekomendasi dokter.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <img src="{{ asset('images/14.svg') }}" alt="Farmasi" style="width: 40px; height: 40px;">
                        </div>
                        <h3>Layanan Kerohanian</h3>
                        <p>Paket pemeriksaan kesehatan rutin untuk ibu dan anak dengan rekomendasi dokter.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <img src="{{ asset('images/15.svg') }}" alt="Farmasi" style="width: 40px; height: 40px;">
                        </div>
                        <h3>Layanan Konsultasi Gizi</h3>
                        <p>Paket pemeriksaan kesehatan rutin untuk ibu dan anak dengan rekomendasi dokter.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <img src="{{ asset('images/16.svg') }}" alt="Farmasi" style="width: 40px; height: 40px;">
                        </div>
                        <h3>Layanan Ambulance</h3>
                        <p>Ambulan</p>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .features-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 30px;
            }

            .feature-card {
                background: #fff;
                border-radius: 15px;
                padding: 25px;
                text-align: center;
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            }
        </style>

        <script>
            const tabs = document.querySelectorAll('.tab-btn');
            const contents = document.querySelectorAll('.tab-content');

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    tabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');

                    contents.forEach(c => c.style.display = 'none');
                    document.getElementById(tab.dataset.tab).style.display = 'grid';
                });
            });
        </script>
    </section>



    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2>Konsultasi Kesehatan Anda Sekarang</h2>
            <p>
                Jangan tunda untuk menjaga kesehatan Anda dan keluarga. Hubungi kami untuk informasi lebih lanjut atau buat
                janji temu dengan dokter spesialis.
            </p>
            <a href="#" class="btn btn-light">Hubungi Kami</a>
        </div>
    </section>
@endsection
