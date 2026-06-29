@extends('layouts.company')

@section('title', 'Panduan Pendaftaran BPJS via Mobile JKN | RSIA IBI Surabaya')

@section('meta')
    <meta name="description"
        content="Panduan lengkap cara mendaftar janji temu di RSIA IBI Surabaya menggunakan aplikasi Mobile JKN untuk peserta BPJS Kesehatan.">
@endsection

@section('content')

    {{-- ============================================
    PAGE HEADER
    ============================================ --}}
    <section id="header" class="page-header bpjs-header">
    </section>

    {{-- ============================================
    BREADCRUMB BAR
    ============================================ --}}
    <div class="bpjs-breadcrumb-bar">
        <div class="container">
            <a href="{{ route('compro.pendaftaran') }}" class="bpjs-back-link">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Pilihan Pendaftaran</span>
            </a>
            <div class="bpjs-breadcrumb-badge">
                <i class="fas fa-shield-alt"></i>
                Panduan BPJS / Mobile JKN
            </div>
        </div>
    </div>

    {{-- ============================================
    HERO INTRO
    ============================================ --}}
    <section class="bpjs-intro-section">
        <div class="container">
            <div class="bpjs-intro-wrap">
                <div class="bpjs-intro-text">
                    <span class="bpjs-label-tag">Khusus Peserta BPJS Kesehatan</span>
                    <h1>Daftar Janji via <span class="bpjs-accent">Mobile JKN</span></h1>
                    <p>Sebagai peserta BPJS Kesehatan, Anda dapat mendaftar antrian dan membuat janji temu dengan mudah
                        melalui aplikasi <strong>Mobile JKN</strong> — layanan resmi BPJS Kesehatan yang tersedia gratis di
                        smartphone Anda.</p>
                    <div class="bpjs-store-badges">
                        <a href="https://play.google.com/store/apps/details?id=app.bpjs.mobile&hl=id" target="_blank"
                            rel="noopener" class="bpjs-store-btn bpjs-store-btn--play">
                            <i class="fab fa-google-play"></i>
                            <div>
                                <span>Unduh di</span>
                                <strong>Google Play</strong>
                            </div>
                        </a>
                        <a href="https://apps.apple.com/id/app/mobile-jkn/id1237601115" target="_blank" rel="noopener"
                            class="bpjs-store-btn bpjs-store-btn--apple">
                            <i class="fab fa-apple"></i>
                            <div>
                                <span>Unduh di</span>
                                <strong>App Store</strong>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="bpjs-intro-image">
                    <img src="{{ asset('images/mjkn-app.png') }}" alt="Aplikasi Mobile JKN">
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
    STEP BY STEP TUTORIAL
    ============================================ --}}
    <section class="bpjs-steps-section">
        <div class="container">
            <div class="bpjs-section-header">
                <span class="bpjs-label-tag">Panduan Langkah demi Langkah</span>
                <h2>Cara Mendaftar Janji Temu</h2>
                <p>Ikuti langkah-langkah berikut untuk membuat janji temu di RSIA IBI Surabaya melalui aplikasi Mobile JKN</p>
            </div>

            <div class="bpjs-steps-grid">

                {{-- Step 1 --}}
                <div class="bpjs-step-card" data-step="1">
                    <div class="bpjs-step-num">
                        <span>1</span>
                    </div>
                    <div class="bpjs-step-content">
                        <h3>Unduh Aplikasi Mobile JKN</h3>
                        <p>Unduh dan instal aplikasi <strong>Mobile JKN</strong> secara gratis melalui Google Play Store
                            (Android) atau App Store (iOS). Pastikan mengunduh aplikasi resmi dari BPJS Kesehatan.</p>
                        <div class="bpjs-step-tip">
                            <i class="fas fa-lightbulb"></i>
                            <span>Cari "Mobile JKN" di toko aplikasi, pastikan logo BPJS Kesehatan tertera.</span>
                        </div>
                    </div>
                </div>

                {{-- Step 2 --}}
                <div class="bpjs-step-card" data-step="2">
                    <div class="bpjs-step-num">
                        <span>2</span>
                    </div>
                    <div class="bpjs-step-content">
                        <h3>Registrasi atau Login Akun</h3>
                        <p>Jika belum memiliki akun, pilih <strong>"Daftar"</strong> dan masukkan nomor kartu BPJS
                            Kesehatan, tanggal lahir, serta nomor handphone yang terdaftar. Jika sudah punya akun, langsung
                            login.</p>
                        <div class="bpjs-step-tip">
                            <i class="fas fa-lightbulb"></i>
                            <span>Siapkan nomor kartu BPJS Kesehatan Anda sebelum mendaftar.</span>
                        </div>
                    </div>
                </div>

                {{-- Step 3 --}}
                <div class="bpjs-step-card" data-step="3">
                    <div class="bpjs-step-num">
                        <span>3</span>
                    </div>
                    <div class="bpjs-step-content">
                        <h3>Pilih Menu "Pendaftaran Pelayanan"</h3>
                        <p>Setelah login, pilih menu <strong>"Pendaftaran Pelayanan"</strong> atau <strong>"Antrian
                                Online"</strong> pada halaman utama aplikasi. Pilih jenis fasilitas kesehatan <strong>Rumah
                                Sakit</strong>.</p>
                        <div class="bpjs-step-tip">
                            <i class="fas fa-lightbulb"></i>
                            <span>Menu ini biasanya berada di bagian atas atau tengah halaman beranda aplikasi.</span>
                        </div>
                    </div>
                </div>

                {{-- Step 4 --}}
                <div class="bpjs-step-card" data-step="4">
                    <div class="bpjs-step-num">
                        <span>4</span>
                    </div>
                    <div class="bpjs-step-content">
                        <h3>Cari RSIA IBI Surabaya</h3>
                        <p>Pada kolom pencarian fasilitas kesehatan, ketik <strong>"RSIA IBI Surabaya"</strong> atau
                            <strong>"IBI Surabaya"</strong>. Pilih rumah sakit yang muncul, kemudian pilih poli atau
                            spesialis yang ingin Anda kunjungi.</p>
                        <div class="bpjs-step-tip">
                            <i class="fas fa-lightbulb"></i>
                            <span>Pastikan Anda memiliki rujukan yang valid sesuai prosedur BPJS Kesehatan.</span>
                        </div>
                    </div>
                </div>

                {{-- Step 5 --}}
                <div class="bpjs-step-card" data-step="5">
                    <div class="bpjs-step-num">
                        <span>5</span>
                    </div>
                    <div class="bpjs-step-content">
                        <h3>Pilih Tanggal & Jam Kunjungan</h3>
                        <p>Pilih tanggal dan sesi kunjungan yang tersedia sesuai jadwal dokter. Sistem akan menampilkan
                            nomor antrian yang telah dipesan. Simpan atau screenshot nomor antrian Anda.</p>
                        <div class="bpjs-step-tip">
                            <i class="fas fa-lightbulb"></i>
                            <span>Datanglah lebih awal sesuai sesi kunjungan yang dipilih.</span>
                        </div>
                    </div>
                </div>

                {{-- Step 6 --}}
                <div class="bpjs-step-card" data-step="6">
                    <div class="bpjs-step-num">
                        <span>6</span>
                    </div>
                    <div class="bpjs-step-content">
                        <h3>Konfirmasi & Datang ke RS</h3>
                        <p>Setelah pendaftaran berhasil, Anda akan mendapatkan <strong>bukti pendaftaran</strong> di
                            aplikasi. Tunjukkan bukti tersebut kepada petugas loket saat tiba di RSIA IBI Surabaya.</p>
                        <div class="bpjs-step-tip">
                            <i class="fas fa-lightbulb"></i>
                            <span>Bawa kartu BPJS fisik, KTP, dan surat rujukan saat datang ke RS.</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ============================================
    INFO PENTING / SYARAT BPJS
    ============================================ --}}
    <section class="bpjs-info-section">
        <div class="container">
            <div class="bpjs-info-grid">

                <div class="bpjs-info-card bpjs-info-card--docs">
                    <div class="bpjs-info-card-icon">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <h3>Dokumen yang Perlu Dibawa</h3>
                    <ul>
                        <li><i class="fas fa-check"></i> Kartu BPJS Kesehatan (fisik / digital)</li>
                        <li><i class="fas fa-check"></i> KTP / Kartu Identitas</li>
                        <li><i class="fas fa-check"></i> Surat Rujukan dari FKTP (Puskesmas/Klinik)</li>
                        <li><i class="fas fa-check"></i> Bukti pendaftaran dari Mobile JKN</li>
                        <li><i class="fas fa-check"></i> Kartu keluarga (jika pasien anak)</li>
                    </ul>
                </div>

                <div class="bpjs-info-card bpjs-info-card--contact">
                    <div class="bpjs-info-card-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3>Butuh Bantuan?</h3>
                    <p>Jika mengalami kesulitan menggunakan aplikasi Mobile JKN atau ada pertanyaan seputar prosedur BPJS,
                        tim kami siap membantu.</p>
                    <div class="bpjs-contact-buttons">
                        <a href="https://wa.me/6285852963005" target="_blank" rel="noopener"
                            class="bpjs-contact-btn bpjs-contact-btn--wa">
                            <i class="fab fa-whatsapp"></i>
                            <span>Chat WhatsApp</span>
                        </a>
                        <a href="tel:+6231XXXXXXX" class="bpjs-contact-btn bpjs-contact-btn--phone">
                            <i class="fas fa-phone"></i>
                            <span>Telepon RS</span>
                        </a>
                    </div>
                    <div class="bpjs-info-note">
                        <i class="fas fa-info-circle"></i>
                        <span>Layanan informasi tersedia Senin–Sabtu, 07.00–20.00 WIB</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="cta-modern">
        <div class="container">
            <h2>Kesehatan Anda, Prioritas Kami</h2>
            <p>Jangan tunda perawatan Anda. Tim medis RSIA IBI siap memberikan pelayanan terbaik untuk ibu dan anak.</p>
            <a href="https://wa.me/6285852963005" target="_blank" class="btn btn-light">
                <i class="fab fa-whatsapp"></i> &nbsp;Hubungi via WhatsApp
            </a>
        </div>
    </section>

@endsection

@section('styles')
    <style>
        /* ============================================
               PAGE HEADER
            ============================================ */
        .bpjs-header {
            padding: 95px 0 15px !important;
        }

        /* ============================================
               BREADCRUMB BAR
            ============================================ */
        .bpjs-breadcrumb-bar {
            background: var(--white);
            border-bottom: 1px solid var(--border-soft);
            padding: 14px 0;
        }

        .bpjs-breadcrumb-bar .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .bpjs-back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 700;
            transition: color 0.2s;
        }

        .bpjs-back-link:hover {
            color: var(--primary);
        }

        .bpjs-breadcrumb-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary-soft);
            color: var(--primary);
            padding: 6px 16px;
            border-radius: 60px;
            font-size: 0.8rem;
            font-weight: 800;
        }

        /* ============================================
               INTRO SECTION
            ============================================ */
        .bpjs-intro-section {
            background: var(--primary);
            padding: 72px 0 80px;
            position: relative;
            overflow: hidden;
        }

        .bpjs-intro-section::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 320px;
            height: 320px;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 50%;
        }

        .bpjs-intro-section::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -40px;
            width: 240px;
            height: 240px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 50%;
        }

        .bpjs-intro-wrap {
            display: flex;
            align-items: center;
            gap: 48px;
            position: relative;
            z-index: 1;
        }

        .bpjs-intro-icon-wrap {
            flex-shrink: 0;
        }
        
        .bpjs-intro-icon {
            width: 120px;
            height: 120px;
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: var(--accent);
        }

        .bpjs-label-tag {
            display: inline-block;
            background: rgba(255, 255, 255, 0.12);
            color: var(--accent);
            padding: 6px 16px;
            border-radius: 60px;
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 16px;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .bpjs-intro-text h1 {
            font-size: 2.4rem;
            color: var(--white);
            margin-bottom: 16px;
            line-height: 1.25;
        }

        .bpjs-accent {
            color: var(--accent);
        }

        .bpjs-intro-text p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 28px;
            max-width: 580px;
        }

        .bpjs-intro-text strong {
            color: var(--white);
        }

        /* Store Badges */
        .bpjs-store-badges {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .bpjs-store-btn {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            border-radius: 14px;
            text-decoration: none;
            transition: all 0.25s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .bpjs-store-btn i {
            font-size: 1.6rem;
        }

        .bpjs-store-btn div {
            display: flex;
            flex-direction: column;
            gap: 1px;
        }

        .bpjs-store-btn span {
            font-size: 0.72rem;
            font-weight: 600;
            opacity: 0.85;
        }

        .bpjs-store-btn strong {
            font-size: 0.92rem;
            font-weight: 800;
        }

        .bpjs-store-btn--play {
            background: rgba(255, 255, 255, 0.1);
            border: 1.5px solid rgba(255, 255, 255, 0.2);
            color: var(--white);
        }

        .bpjs-store-btn--play:hover {
            background: rgba(255, 255, 255, 0.18);
            color: var(--white);
            transform: translateY(-2px);
        }

        .bpjs-store-btn--apple {
            background: var(--accent);
            border: 1.5px solid var(--accent);
            color: var(--primary);
        }

        .bpjs-store-btn--apple:hover {
            background: var(--white);
            border-color: var(--white);
            color: var(--primary);
            transform: translateY(-2px);
        }

        /* ============================================
               STEPS SECTION
            ============================================ */
        .bpjs-steps-section {
            background: var(--bg-main);
            padding: 80px 0;
        }

        .bpjs-section-header {
            text-align: center;
            margin-bottom: 56px;
        }

        .bpjs-steps-section .bpjs-label-tag {
            background: var(--primary-soft);
            color: var(--primary);
            border: 1px solid rgba(18, 53, 36, 0.12);
        }

        .bpjs-section-header h2 {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 12px;
        }

        .bpjs-section-header p {
            color: var(--text-muted);
            font-size: 0.96rem;
            max-width: 560px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* Steps Grid */
        .bpjs-steps-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .bpjs-step-card {
            background: var(--white);
            border-radius: 20px;
            border: 1px solid var(--border-soft);
            padding: 32px 28px;
            display: flex;
            gap: 20px;
            align-items: flex-start;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .bpjs-step-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--primary);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .bpjs-step-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 40px rgba(18, 53, 36, 0.1);
            border-color: rgba(18, 53, 36, 0.15);
        }

        .bpjs-step-card:hover::before {
            transform: scaleX(1);
        }

        .bpjs-step-num {
            flex-shrink: 0;
            width: 36px;
            height: 36px;
            background: var(--primary);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 4px;
        }

        .bpjs-step-num span {
            font-size: 0.85rem;
            font-weight: 900;
            color: var(--white);
        }

        .bpjs-step-content {
            flex: 1;
        }

        .bpjs-step-icon {
            width: 44px;
            height: 44px;
            background: var(--primary-soft);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
            color: var(--primary);
            font-size: 1.1rem;
            transition: all 0.3s;
        }

        .bpjs-step-card:hover .bpjs-step-icon {
            background: var(--primary);
            color: var(--white);
        }

        .bpjs-step-content h3 {
            font-size: 1rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 10px;
            line-height: 1.35;
        }

        .bpjs-step-content p {
            font-size: 0.88rem;
            color: var(--text-muted);
            line-height: 1.65;
            margin-bottom: 14px;
        }

        .bpjs-step-content strong {
            color: var(--text-main);
        }

        .bpjs-step-tip {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            background: var(--primary-soft);
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 0.8rem;
            color: var(--primary);
            line-height: 1.5;
            border-left: 3px solid var(--primary);
        }

        .bpjs-step-tip i {
            color: var(--accent-dark, var(--primary));
            flex-shrink: 0;
            margin-top: 1px;
            font-size: 0.85rem;
        }

        /* ============================================
               INFO SECTION
            ============================================ */
        .bpjs-info-section {
            background: var(--white);
            padding: 72px 0 80px;
            border-top: 1px solid var(--border-soft);
        }

        .bpjs-info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28px;
        }

        .bpjs-info-card {
            border-radius: 20px;
            padding: 36px;
            border: 1px solid var(--border-soft);
        }

        .bpjs-info-card--docs {
            background: var(--primary-soft);
        }

        .bpjs-info-card--contact {
            background: var(--primary);
        }

        .bpjs-info-card-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-bottom: 20px;
        }

        .bpjs-info-card--docs .bpjs-info-card-icon {
            background: var(--primary);
            color: var(--white);
        }

        .bpjs-info-card--contact .bpjs-info-card-icon {
            background: rgba(255, 255, 255, 0.12);
            color: var(--accent);
        }

        .bpjs-info-card h3 {
            font-size: 1.1rem;
            font-weight: 800;
            margin-bottom: 18px;
        }

        .bpjs-info-card--docs h3 {
            color: var(--primary);
        }

        .bpjs-info-card--contact h3 {
            color: var(--white);
        }

        .bpjs-info-card--docs ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .bpjs-info-card--docs ul li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 0.9rem;
            color: var(--text-main);
            font-weight: 600;
        }

        .bpjs-info-card--docs ul li i {
            color: var(--primary);
            font-size: 0.8rem;
            margin-top: 3px;
            flex-shrink: 0;
        }

        .bpjs-info-card--contact p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            line-height: 1.65;
            margin-bottom: 24px;
        }

        .bpjs-contact-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .bpjs-contact-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 800;
            transition: all 0.25s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .bpjs-contact-btn--wa {
            background: #25d366;
            color: var(--white);
        }

        .bpjs-contact-btn--wa:hover {
            background: #1db954;
            color: var(--white);
            transform: translateY(-2px);
        }

        .bpjs-contact-btn--phone {
            background: rgba(255, 255, 255, 0.12);
            color: var(--white);
            border: 1.5px solid rgba(255, 255, 255, 0.2);
        }

        .bpjs-contact-btn--phone:hover {
            background: rgba(255, 255, 255, 0.2);
            color: var(--white);
            transform: translateY(-2px);
        }

        .bpjs-info-note {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .bpjs-info-note i {
            margin-top: 2px;
            flex-shrink: 0;
        }

        /* ============================================
               RESPONSIVE
            ============================================ */
        @media (max-width: 992px) {
            .bpjs-steps-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .bpjs-header {
                padding: 64px 0 18px !important;
            }

            .bpjs-breadcrumb-bar {
                padding: 8px 0;
            }

            .bpjs-breadcrumb-bar .container {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                gap: 8px;
                flex-wrap: nowrap;
            }

            .bpjs-back-link {
                min-width: 0;
                gap: 6px;
                font-size: 0.76rem;
                white-space: nowrap;
            }

            .bpjs-back-link i {
                width: 30px;
                height: 30px;
                border-radius: 50%;
                background: var(--primary-soft);
                color: var(--primary);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                font-size: 0.72rem;
                flex-shrink: 0;
            }

            .bpjs-back-link span {
                max-width: 136px;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .bpjs-breadcrumb-badge {
                flex-shrink: 0;
                gap: 5px;
                padding: 5px 10px;
                font-size: 0.66rem;
                line-height: 1.2;
                white-space: nowrap;
            }

            .bpjs-breadcrumb-badge i {
                font-size: 0.72rem;
            }

            .bpjs-intro-section {
                padding: 28px 0 34px;
            }

            .bpjs-intro-wrap {
                flex-direction: row;
                align-items: flex-start;
                gap: 14px;
                text-align: left;
            }

            .bpjs-intro-icon {
                width: 50px;
                height: 50px;
                font-size: 1.25rem;
                border-radius: 14px;
            }

            .bpjs-label-tag {
                font-size: 0.58rem;
                line-height: 1.25;
                padding: 4px 9px;
                letter-spacing: 0.4px;
                margin-bottom: 8px;
            }

            .bpjs-intro-text h1 {
                font-size: 1.25rem;
                margin-bottom: 8px;
            }

            .bpjs-intro-text p {
                display: none;
            }

            .bpjs-store-badges {
                gap: 8px;
                flex-wrap: nowrap;
            }

            .bpjs-store-btn {
                gap: 7px;
                padding: 8px 10px;
                border-radius: 10px;
            }

            .bpjs-store-btn i {
                font-size: 1.05rem;
            }

            .bpjs-store-btn span {
                font-size: 0.56rem;
            }

            .bpjs-store-btn strong {
                font-size: 0.68rem;
            }

            .bpjs-steps-section {
                padding: 34px 0 42px;
            }

            .bpjs-section-header {
                margin-bottom: 20px;
            }

            .bpjs-section-header h2 {
                font-size: 1.35rem;
                margin-bottom: 0;
            }

            .bpjs-section-header p {
                display: none;
            }

            .bpjs-steps-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 10px;
            }

            .bpjs-step-card {
                display: block;
                padding: 12px 9px;
                border-radius: 14px;
                min-width: 0;
                text-align: center;
            }

            .bpjs-step-num {
                width: 26px;
                height: 26px;
                border-radius: 8px;
                margin: 0 auto 8px;
            }

            .bpjs-step-num span {
                font-size: 0.68rem;
            }

            .bpjs-step-icon {
                width: 34px;
                height: 34px;
                border-radius: 10px;
                font-size: 0.9rem;
                margin: 0 auto 8px;
            }

            .bpjs-step-content h3 {
                font-size: 0.78rem;
                line-height: 1.25;
                margin-bottom: 6px;
                overflow-wrap: anywhere;
            }

            .bpjs-step-content p {
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
                font-size: 0.68rem;
                line-height: 1.45;
                margin-bottom: 0;
            }

            .bpjs-step-tip {
                display: none;
            }

            .bpjs-info-section {
                padding: 34px 0 42px;
            }

            .bpjs-info-grid {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .bpjs-info-card {
                padding: 22px 16px;
                border-radius: 16px;
            }

            .bpjs-info-card-icon {
                width: 42px;
                height: 42px;
                border-radius: 12px;
                font-size: 1.05rem;
                margin-bottom: 12px;
            }

            .bpjs-info-card h3 {
                font-size: 0.98rem;
                margin-bottom: 12px;
            }

            .bpjs-info-card--docs ul {
                gap: 9px;
            }

            .bpjs-info-card--docs ul li,
            .bpjs-info-card--contact p {
                font-size: 0.82rem;
                line-height: 1.55;
            }

            .bpjs-contact-buttons {
                gap: 8px;
                margin-bottom: 14px;
            }

            .bpjs-contact-btn {
                padding: 10px 14px;
                font-size: 0.78rem;
            }

            .bpjs-info-note {
                font-size: 0.72rem;
            }
        }

        @media (max-width: 480px) {
            .bpjs-breadcrumb-bar {
                padding: 6px 0;
            }

            .bpjs-back-link span {
                max-width: 58px;
            }

            .bpjs-breadcrumb-badge {
                padding: 5px 8px;
                font-size: 0.58rem;
            }

            .bpjs-intro-section {
                padding: 24px 0 30px;
            }

            .bpjs-intro-wrap {
                gap: 10px;
            }

            .bpjs-intro-icon {
                width: 44px;
                height: 44px;
                font-size: 1.1rem;
            }

            .bpjs-intro-text h1 {
                font-size: 1.12rem;
            }

            .bpjs-store-btn {
                padding: 7px 8px;
            }

            .bpjs-store-btn div span {
                display: none;
            }

            .bpjs-steps-grid {
                gap: 8px;
            }

            .bpjs-step-card {
                padding: 10px 7px;
            }

            .bpjs-step-content h3 {
                font-size: 0.72rem;
            }

            .bpjs-step-content p {
                -webkit-line-clamp: 2;
                font-size: 0.62rem;
            }

            .bpjs-contact-btn {
                justify-content: center;
                width: 100%;
            }
        }
    </style>
@endsection
