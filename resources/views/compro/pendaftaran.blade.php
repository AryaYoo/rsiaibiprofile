@extends('layouts.company')

@section('title', 'Pendaftaran Online | RSIA IBI Surabaya')

@section('meta')
    <meta name="description"
        content="Daftarkan janji temu online Anda di RSIA IBI Surabaya. Pilih jalur pendaftaran sesuai jenis penjamin Anda — BPJS Kesehatan atau Umum / Asuransi Swasta.">
@endsection

@section('content')

    {{-- ============================================
    PAGE HEADER
    ============================================ --}}
    <section id="header" class="page-header berita-header">
        <div class="container">
            <span class="badge-label">Pendaftaran Online</span>
            <h1>Pilih Jenis Pendaftaran</h1>
            <p>Silahkan pilih pendaftaran sesuai dengan jenis penjamin atau asuransi kesehatan Anda.</p>
        </div>
    </section>

    {{-- ============================================
    PENDAFTARAN PILIHAN SECTION
    ============================================ --}}
    <section class="pend-pick-section">
        <div class="container">

            {{-- Cards --}}
            <div class="pend-pick-grid">

                {{-- Card BPJS --}}
                <a href="{{ route('compro.pendaftaran.bpjs') }}" class="pend-pick-card pend-pick-card--bpjs"
                    id="card-bpjs">
                    <div class="pend-pick-card-inner">
                        <div class="pend-pick-card-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="pend-pick-card-badge">BPJS Kesehatan</div>
                        <h2>Pasien BPJS<br>Kesehatan</h2>
                        <p>Pendaftaran menggunakan kartu BPJS Kesehatan melalui aplikasi <strong>Mobile JKN</strong>. Kami
                            akan memandu Anda langkah demi langkah.</p>
                        <ul class="pend-pick-list">
                            <li><i class="fas fa-check-circle"></i> Peserta BPJS Kesehatan aktif</li>
                            <li><i class="fas fa-check-circle"></i> Memiliki surat rujukan FKTP</li>
                            <li><i class="fas fa-check-circle"></i> Menggunakan aplikasi Mobile JKN</li>
                        </ul>
                        <div class="pend-pick-card-cta">
                            <span>Lihat Panduan</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                    <div class="pend-pick-card-bg-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                </a>

                {{-- Card Umum --}}
                <a href="{{ route('compro.pendaftaran.umum') }}" class="pend-pick-card pend-pick-card--umum"
                    id="card-umum">
                    <div class="pend-pick-card-inner">
                        <div class="pend-pick-card-icon">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <div class="pend-pick-card-badge">Umum / Asuransi Swasta</div>
                        <h2>Pasien Umum &<br>Asuransi Swasta</h2>
                        <p>Pendaftaran secara langsung tanpa menggunakan BPJS — termasuk pasien umum, asuransi swasta,
                            perusahaan rekanan, atau mandiri.</p>
                        <ul class="pend-pick-list">
                            <li><i class="fas fa-check-circle"></i> Pasien umum / mandiri</li>
                            <li><i class="fas fa-check-circle"></i> Asuransi swasta / perusahaan</li>
                            <li><i class="fas fa-check-circle"></i> Isi formulir online langsung</li>
                        </ul>
                        <div class="pend-pick-card-cta">
                            <span>Daftar Sekarang</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                    <div class="pend-pick-card-bg-icon">
                        <i class="fas fa-id-card"></i>
                    </div>
                </a>
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

        .berita-header {
            padding-bottom: 30px !important; /* sesuaikan angka */
        }
        /* ============================================
               PAGE HEADER
            ============================================ */
        .pend-pick-header {
            padding: 95px 0 15px !important;
        }

        /* ============================================
               MAIN SECTION
            ============================================ */
        .pend-pick-section {
            background: var(--bg-main);
            padding: 72px 0 88px;
            min-height: calc(100svh - 110px);
            display: flex;
            align-items: center;
        }

        .pend-pick-section>.container {
            width: 100%;
        }

        /* ============================================
               HEADING
            ============================================ */
        .pend-pick-heading {
            text-align: center;
            margin-bottom: 56px;
        }

        .pend-pick-tag {
            display: inline-block;
            background: var(--primary-soft);
            color: var(--primary);
            padding: 6px 18px;
            border-radius: 60px;
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 16px;
            border: 1px solid rgba(18, 53, 36, 0.12);
        }

        .pend-pick-heading h1 {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 14px;
            line-height: 1.2;
        }

        .pend-pick-accent {
            color: var(--primary-light);
            position: relative;
        }

        .pend-pick-heading p {
            font-size: 1rem;
            color: var(--text-muted);
            max-width: 520px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* ============================================
               CARDS GRID
            ============================================ */
        .pend-pick-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28px;
            max-width: 900px;
            margin: 0 auto;
        }

        .pend-pick-card {
            display: block;
            text-decoration: none;
            border-radius: 24px;
            overflow: hidden;
            position: relative;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
        }

        .pend-pick-card:hover {
            transform: translateY(-8px);
            text-decoration: none;
        }

        /* BPJS Card — Solid Dark Green */
        .pend-pick-card--bpjs {
            background: var(--primary);
        }

        .pend-pick-card--bpjs:hover {
            border-color: var(--accent);
            box-shadow: 0 24px 56px rgba(18, 53, 36, 0.35);
        }

        /* Umum Card — White with accent border */
        .pend-pick-card--umum {
            background: var(--white);
            border: 2px solid var(--border-soft);
            box-shadow: var(--shadow-sm);
        }

        .pend-pick-card--umum:hover {
            border-color: var(--primary);
            box-shadow: 0 24px 56px rgba(18, 53, 36, 0.15);
        }

        /* Card Inner */
        .pend-pick-card-inner {
            padding: 40px 36px;
            position: relative;
            z-index: 1;
        }

        /* Icon */
        .pend-pick-card-icon {
            width: 64px;
            height: 64px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 20px;
            transition: all 0.3s;
        }

        .pend-pick-card--bpjs .pend-pick-card-icon {
            background: rgba(255, 255, 255, 0.12);
            color: var(--accent);
            border: 1.5px solid rgba(255, 255, 255, 0.15);
        }

        .pend-pick-card--bpjs:hover .pend-pick-card-icon {
            background: var(--accent);
            color: var(--primary);
        }

        .pend-pick-card--umum .pend-pick-card-icon {
            background: var(--primary-soft);
            color: var(--primary);
            border: 1.5px solid rgba(18, 53, 36, 0.1);
        }

        .pend-pick-card--umum:hover .pend-pick-card-icon {
            background: var(--primary);
            color: var(--white);
        }

        /* Badge */
        .pend-pick-card-badge {
            display: inline-block;
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 60px;
            margin-bottom: 14px;
        }

        .pend-pick-card--bpjs .pend-pick-card-badge {
            background: rgba(255, 255, 255, 0.12);
            color: var(--accent);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .pend-pick-card--umum .pend-pick-card-badge {
            background: var(--primary-soft);
            color: var(--primary);
            border: 1px solid rgba(18, 53, 36, 0.1);
        }

        /* Heading */
        .pend-pick-card-inner h2 {
            font-size: 1.55rem;
            font-weight: 900;
            line-height: 1.25;
            margin-bottom: 14px;
        }

        .pend-pick-card--bpjs .pend-pick-card-inner h2 {
            color: var(--white);
        }

        .pend-pick-card--umum .pend-pick-card-inner h2 {
            color: var(--primary);
        }

        /* Description */
        .pend-pick-card-inner p {
            font-size: 0.9rem;
            line-height: 1.65;
            margin-bottom: 20px;
        }

        .pend-pick-card--bpjs .pend-pick-card-inner p {
            color: rgba(255, 255, 255, 0.75);
        }

        .pend-pick-card--bpjs .pend-pick-card-inner p strong {
            color: var(--white);
        }

        .pend-pick-card--umum .pend-pick-card-inner p {
            color: var(--text-muted);
        }

        /* List */
        .pend-pick-list {
            list-style: none;
            padding: 0;
            margin: 0 0 28px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .pend-pick-list li {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.87rem;
            font-weight: 600;
        }

        .pend-pick-list li i {
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        .pend-pick-card--bpjs .pend-pick-list li {
            color: rgba(255, 255, 255, 0.85);
        }

        .pend-pick-card--bpjs .pend-pick-list li i {
            color: var(--accent);
        }

        .pend-pick-card--umum .pend-pick-list li {
            color: var(--text-main);
        }

        .pend-pick-card--umum .pend-pick-list li i {
            color: var(--primary);
        }

        /* CTA Row */
        .pend-pick-card-cta {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 0.92rem;
            font-weight: 800;
            padding: 12px 22px;
            border-radius: 12px;
            transition: all 0.25s;
        }

        .pend-pick-card--bpjs .pend-pick-card-cta {
            background: var(--accent);
            color: var(--primary);
        }

        .pend-pick-card--bpjs:hover .pend-pick-card-cta {
            background: var(--white);
        }

        .pend-pick-card--umum .pend-pick-card-cta {
            background: var(--primary);
            color: var(--white);
        }

        .pend-pick-card--umum:hover .pend-pick-card-cta {
            background: var(--primary-light);
        }

        .pend-pick-card-cta i {
            transition: transform 0.25s;
        }

        .pend-pick-card:hover .pend-pick-card-cta i {
            transform: translateX(4px);
        }

        /* Background Decorative Icon */
        .pend-pick-card-bg-icon {
            position: absolute;
            bottom: -20px;
            right: -20px;
            font-size: 9rem;
            pointer-events: none;
            z-index: 0;
            transition: all 0.4s;
        }

        .pend-pick-card--bpjs .pend-pick-card-bg-icon {
            color: rgba(255, 255, 255, 0.04);
        }

        .pend-pick-card--umum .pend-pick-card-bg-icon {
            color: rgba(18, 53, 36, 0.04);
        }

        .pend-pick-card:hover .pend-pick-card-bg-icon {
            transform: scale(1.08) rotate(5deg);
        }

        /* ============================================
               INFO BAR
            ============================================ */
        .pend-pick-info-bar {
            max-width: 900px;
            margin: 0 auto;
            background: var(--white);
            border: 1px solid var(--border-soft);
            border-radius: 20px;
            padding: 24px 36px;
            display: flex;
            align-items: center;
            gap: 0;
            box-shadow: var(--shadow-sm);
        }

        .pend-pick-info-item {
            display: flex;
            align-items: center;
            gap: 14px;
            flex: 1;
        }

        .pend-pick-info-item>i {
            width: 40px;
            height: 40px;
            background: var(--primary-soft);
            color: var(--primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .pend-pick-info-item div {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .pend-pick-info-item strong {
            font-size: 0.84rem;
            font-weight: 800;
            color: var(--primary);
        }

        .pend-pick-info-item span {
            font-size: 0.82rem;
            color: var(--text-muted);
        }

        .pend-pick-info-divider {
            width: 1px;
            height: 48px;
            background: var(--border-soft);
            margin: 0 28px;
            flex-shrink: 0;
        }

        /* ============================================
               RESPONSIVE
            ============================================ */
        @media (max-width: 768px) {
            .berita-header {
                padding: 90px 0 30px;
            }

            .berita-header .badge-label {
                display: inline-block;
                margin-bottom: 12px;
                padding: 6px 16px;
                background: #6fa85e; /* hijau lebih terang dari background */
                border-radius: 20px;
                font-size: 11px;
                font-weight: 700;
                letter-spacing: 0.5px;
                text-transform: uppercase;
                color: #fff;
            }

            .berita-header h1 {
                font-size: 24px;
                font-weight: 700;
                line-height: 1.3;
                margin-bottom: 10px;
            }

            .berita-header p {
                font-size: 14px;
                line-height: 1.6;
                color: #cfe8d8;
                max-width: 320px;
                margin: 0 auto;
            }
            .pend-pick-header {
                padding: 64px 0 0 !important;
            }

            .pend-pick-section {
    padding: 24px 0 48px;
    min-height: calc(100svh - 300px);
}

            .pend-pick-heading {
                margin-bottom: 20px;
            }

            .pend-pick-heading h1 {
                font-size: 1.55rem;
                margin-bottom: 8px;
            }

            .pend-pick-tag {
                font-size: 0.68rem;
                padding: 5px 14px;
                margin-bottom: 10px;
            }

            .pend-pick-heading p {
                display: none;
            }

            .pend-pick-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
                margin-bottom: 0;
            }

            .pend-pick-card {
                border-radius: 16px;
            }

            .pend-pick-card-inner {
                min-height: 168px;
                padding: 14px 10px 12px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-align: center;
            }

            .pend-pick-card-icon {
                width: 42px;
                height: 42px;
                border-radius: 12px;
                font-size: 1.05rem;
                margin: 0 auto 10px;
            }

            .pend-pick-card-badge {
                align-self: center;
                max-width: 100%;
                font-size: 0.58rem;
                line-height: 1.25;
                padding: 4px 7px;
                margin-bottom: 8px;
                white-space: normal;
            }

            .pend-pick-card-inner h2 {
                font-size: 0.95rem;
                line-height: 1.25;
                margin-bottom: 12px;
            }

            .pend-pick-card-inner p,
            .pend-pick-list {
                display: none;
            }

            .pend-pick-card-cta {
                width: 100%;
                justify-content: center;
                gap: 6px;
                font-size: 0.72rem;
                line-height: 1.2;
                padding: 9px 6px;
                border-radius: 10px;
                margin-top: auto;
                text-align: center;
            }

            .pend-pick-card-bg-icon {
                right: -14px;
                bottom: -12px;
                font-size: 5rem;
            }

            .pend-pick-info-bar {
                flex-direction: column;
                gap: 20px;
                padding: 24px;
                align-items: flex-start;
            }

            .pend-pick-info-item {
                width: 100%;
            }

            .pend-pick-info-divider {
                width: 100%;
                height: 1px;
                margin: 0;
            }
        }

        @media (max-width: 480px) {
            .pend-pick-heading h1 {
                font-size: 1.35rem;
            }

            .pend-pick-card-inner h2 {
                font-size: 0.82rem;
            }

            .pend-pick-grid {
                gap: 10px;
            }

            .pend-pick-card-inner {
                min-height: 152px;
                padding: 12px 8px 10px;
            }

            .pend-pick-card-icon {
                width: 36px;
                height: 36px;
                margin-bottom: 8px;
            }

            .pend-pick-card-badge {
                font-size: 0.5rem;
                padding: 3px 6px;
                margin-bottom: 7px;
            }

            .pend-pick-card-cta {
                font-size: 0.64rem;
                padding: 8px 5px;
            }

            .pend-pick-card-cta i {
                display: none;
            }
        }
    </style>
@endsection

@push('scripts')
    <script>
        // Entrance animation for cards
        document.addEventListener('DOMContentLoaded', function () {
            const cards = document.querySelectorAll('.pend-pick-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                setTimeout(() => {
                    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 150 + (index * 120));
            });
        });
    </script>
@endpush
