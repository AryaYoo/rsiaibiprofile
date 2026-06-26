@extends('layouts.company')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .contact-services-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
            gap: 24px;
        }

        .contact-service-card {
            text-align: center;
        }

        .contact-feedback-wrap {
            margin-top: 64px;
            width: 100%;
        }

        .contact-feedback-card {
            padding: 60px;
            border-radius: 24px;
            box-shadow: var(--shadow-lg);
        }

        .contact-feedback-head {
            text-align: center;
            margin-bottom: 48px;
        }

        .contact-feedback-head h2 {
            font-size: 2.2rem;
            margin-bottom: 12px;
        }

        .contact-feedback-head p {
            color: var(--text-muted);
            font-size: 1.1rem;
            margin: 0;
        }

        .contact-form {
            max-width: 1000px;
            margin: 0 auto;
        }

        .contact-form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            margin-bottom: 32px;
        }

        .contact-field {
            margin-bottom: 32px;
        }

        .contact-message-field {
            margin-bottom: 40px;
        }

        @media (max-width: 992px) {
            .contact-services-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                gap: 18px !important;
            }

            .contact-service-card:last-child {
                grid-column: 1 / -1;
            }

            .contact-feedback-card {
                padding: 40px 28px !important;
                border-radius: 18px !important;
            }

            .contact-feedback-head {
                margin-bottom: 32px !important;
            }

            .contact-feedback-head h2 {
                font-size: 1.8rem !important;
            }
        }

        @media (max-width: 768px) {
            #info.section-padding {
                padding-top: 42px;
                padding-bottom: 54px;
            }

            .contact-services-grid {
                grid-template-columns: 1fr !important;
                gap: 14px !important;
            }

            .contact-service-card {
                padding: 22px 18px !important;
                border-radius: 16px !important;
            }

            .contact-service-card .feature-icon {
                width: 48px !important;
                height: 48px !important;
                margin-bottom: 14px !important;
                font-size: 1.15rem !important;
            }

            .contact-service-card h3 {
                font-size: 1.05rem !important;
                margin-bottom: 8px !important;
            }

            .contact-service-card p {
                font-size: 0.9rem !important;
                line-height: 1.55 !important;
                margin-bottom: 16px !important;
            }

            .contact-service-card .btn {
                display: inline-flex;
                align-items: center;
                width: 100%;
                justify-content: center;
                padding: 11px 16px !important;
                font-size: 0.9rem !important;
            }

            .contact-feedback-wrap {
                margin-top: 32px !important;
            }

            .contact-feedback-card {
                padding: 28px 16px !important;
                border-radius: 16px !important;
            }

            .contact-feedback-head {
                margin-bottom: 24px !important;
            }

            .contact-feedback-head .feature-icon {
                width: 52px !important;
                height: 52px !important;
                border-radius: 14px !important;
                font-size: 1.25rem !important;
                margin-bottom: 14px !important;
            }

            .contact-feedback-head h2 {
                font-size: 1.45rem !important;
            }

            .contact-feedback-head p {
                font-size: 0.92rem !important;
                line-height: 1.6;
            }

            .contact-form-grid {
                grid-template-columns: 1fr !important;
                gap: 18px !important;
                margin-bottom: 18px !important;
            }

            .contact-field,
            .contact-message-field {
                margin-bottom: 18px !important;
            }

            .contact-form label {
                font-size: 0.76rem !important;
                line-height: 1.35;
                margin-bottom: 8px !important;
            }

            .contact-form input,
            .contact-form textarea {
                padding: 13px 14px !important;
                border-radius: 10px !important;
                font-size: 0.92rem !important;
            }

            .contact-form textarea {
                min-height: 140px;
            }

            .contact-form button[type="submit"] {
                height: auto !important;
                min-height: 52px;
                padding: 14px 16px !important;
                font-size: 0.92rem !important;
                letter-spacing: 0 !important;
                white-space: normal;
            }

            #cta.cta-modern h2 {
                font-size: 1.45rem;
            }

            #cta.cta-modern p {
                font-size: 0.92rem;
            }
        }

        @media (max-width: 420px) {
            #header.page-header {
                padding-top: 96px;
                padding-bottom: 42px;
            }

            #header.page-header h1 {
                font-size: 2rem;
            }

            #header.page-header p {
                font-size: 0.95rem;
            }

            .contact-service-card {
                padding: 18px 14px !important;
            }

            .contact-feedback-card {
                padding: 24px 12px !important;
            }

            .contact-feedback-head h2 {
                font-size: 1.3rem !important;
            }
        }
    </style>
@endsection

@section('content')
    {{-- Page Header --}}
    <section id="header" data-nav-label="Kontak" class="page-header">
        <div class="container">
            <span class="badge-label">Kontak</span>
            <h1>Kontak Kami</h1>
            <p>Dapatkan informasi seputar pelayanan kami!</p>
        </div>
    </section>

    {{-- Services Info --}}
    <section id="info" data-nav-label="Informasi" class="section-padding" style="background: var(--bg-main);">
        <div class="container">
            <div class="features-grid contact-services-grid">
                {{-- Card Umum --}}
                <div class="feature-card contact-service-card">
                    <div class="feature-icon" style="margin: 0 auto 20px;">
                        <i class="fas fa-hospital-user"></i>
                    </div>
                    <h3>Pelayanan Umum</h3>
                    <p style="margin-bottom: 24px;">Dapatkan informasi lengkap mengenai pelayanan kesehatan umum di RSIA IBI
                        Surabaya.</p>
                    <a href="https://api.whatsapp.com/send/?phone={{ $phoneUmum }}&text&type=phone_number&app_absent=0"
                        class="btn btn-accent">Hubungi →</a>
                </div>

                {{-- Card BPJS --}}
                <div class="feature-card contact-service-card">
                    <div class="feature-icon" style="margin: 0 auto 20px;">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <h3>Pelayanan BPJS</h3>
                    <p style="margin-bottom: 24px;">Informasi mengenai prosedur dan fasilitas bagi pasien dengan jaminan
                        BPJS Kesehatan.</p>
                    <a href="https://api.whatsapp.com/send/?phone={{ $phoneBpjs }}&text&type=phone_number&app_absent=0"
                        class="btn btn-accent">Hubungi →</a>
                </div>

                {{-- Card Non BPJS --}}
                <div class="feature-card contact-service-card">
                    <div class="feature-icon" style="margin: 0 auto 20px;">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3>Pendaftaran Poli Non BPJS</h3>
                    <p style="margin-bottom: 24px;">Cara mendaftar poli untuk pasien umum/non BPJS dengan mudah dan cepat.
                    </p>
                    <a href="https://docs.google.com/forms/d/e/1FAIpQLScPvWSVAXgbBt71_hHI5m0eF6Ja2d0VMEYkNNyhR42yejZPbw/viewform"
                        class="btn btn-accent">Daftar →</a>
                </div>
            </div>

            {{-- Formulir Kritik & Saran --}}
            <div class="reveal contact-feedback-wrap">
                <div class="feature-card contact-feedback-card">
                    <div class="contact-feedback-head">
                        <div class="feature-icon" style="margin: 0 auto 20px; width: 64px; height: 64px; font-size: 1.6rem; border-radius: 18px;">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                        <h2>Kritik & Saran</h2>
                        <p>Masukan Anda sangat berharga bagi peningkatan kualitas pelayanan kami.</p>
                    </div>

                    @if(session('success'))
                        <div style="background: #ecfdf5; border: 1px solid #10b981; color: #065f46; padding: 20px; border-radius: 16px; margin-bottom: 32px; text-align: center; font-weight: 700; font-size: 1rem;">
                            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('compro.feedback.store') }}" method="POST" class="contact-form">
                        @csrf
                        <div class="contact-form-grid">
                            <div>
                                <label style="display: block; font-size: 0.9rem; font-weight: 800; color: var(--primary); margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Nama Lengkap *</label>
                                <input type="text" name="name" required placeholder="Masukkan nama Anda" style="width: 100%; padding: 16px 20px; border-radius: 12px; border: 1px solid var(--border-soft); background: var(--bg-main); outline: none; transition: all 0.2s; font-size: 1rem;" onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 4px rgba(18, 53, 36, 0.05)';" onblur="this.style.borderColor='var(--border-soft)'; this.style.boxShadow='none';">
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.9rem; font-weight: 800; color: var(--primary); margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Email (Opsional)</label>
                                <input type="email" name="email" placeholder="email@contoh.com" style="width: 100%; padding: 16px 20px; border-radius: 12px; border: 1px solid var(--border-soft); background: var(--bg-main); outline: none; transition: all 0.2s; font-size: 1rem;" onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 4px rgba(18, 53, 36, 0.05)';" onblur="this.style.borderColor='var(--border-soft)'; this.style.boxShadow='none';">
                            </div>
                        </div>
                        <div class="contact-field">
                            <label style="display: block; font-size: 0.9rem; font-weight: 800; color: var(--primary); margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Subjek Pesan</label>
                            <input type="text" name="subject" placeholder="Apa perihal pesan Anda?" style="width: 100%; padding: 16px 20px; border-radius: 12px; border: 1px solid var(--border-soft); background: var(--bg-main); outline: none; transition: all 0.2s; font-size: 1rem;" onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 4px rgba(18, 53, 36, 0.05)';" onblur="this.style.borderColor='var(--border-soft)'; this.style.boxShadow='none';">
                        </div>
                        <div class="contact-message-field">
                            <label style="display: block; font-size: 0.9rem; font-weight: 800; color: var(--primary); margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Pesan Anda *</label>
                            <textarea name="message" required rows="6" placeholder="Tuliskan kritik, saran, atau pertanyaan Anda di sini..." style="width: 100%; padding: 16px 20px; border-radius: 12px; border: 1px solid var(--border-soft); background: var(--bg-main); outline: none; resize: vertical; transition: all 0.2s; font-size: 1rem; line-height: 1.6;" onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 4px rgba(18, 53, 36, 0.05)';" onblur="this.style.borderColor='var(--border-soft)'; this.style.boxShadow='none';"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%; height: 60px; font-size: 1.1rem; font-weight: 800; letter-spacing: 1px; border-radius: 12px; box-shadow: 0 10px 20px rgba(18, 53, 36, 0.15);">Kirim Pesan Sekarang <i class="fas fa-paper-plane ml-2"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section id="cta" data-nav-label="Konsultasi" class="cta-modern">
        <div class="container">
            <h2>Konsultasi Kesehatan Anda Sekarang</h2>
            <p>Jangan tunda untuk menjaga kesehatan Anda dan keluarga. Hubungi kami untuk informasi lebih lanjut.</p>
            <a href="https://wa.me/6285852963005" class="btn btn-light" target="_blank">Hubungi via WhatsApp →</a>
        </div>
    </section>
@endsection
