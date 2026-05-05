@extends('layouts.company')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            <div class="features-grid" style="display: grid; grid-template-columns: repeat(3, 1fr) !important; gap: 24px;">
                {{-- Card Umum --}}
                <div class="feature-card" style="text-align: center;">
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
                <div class="feature-card" style="text-align: center;">
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
                <div class="feature-card" style="text-align: center;">
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
            <div class="reveal" style="margin-top: 64px; width: 100%;">
                <div class="feature-card" style="padding: 60px; border-radius: 24px; box-shadow: var(--shadow-lg);">
                    <div style="text-align: center; margin-bottom: 48px;">
                        <div class="feature-icon" style="margin: 0 auto 20px; width: 64px; height: 64px; font-size: 1.6rem; border-radius: 18px;">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                        <h2 style="font-size: 2.2rem; margin-bottom: 12px;">Kritik & Saran</h2>
                        <p style="color: var(--text-muted); font-size: 1.1rem;">Masukan Anda sangat berharga bagi peningkatan kualitas pelayanan kami.</p>
                    </div>

                    @if(session('success'))
                        <div style="background: #ecfdf5; border: 1px solid #10b981; color: #065f46; padding: 20px; border-radius: 16px; margin-bottom: 32px; text-align: center; font-weight: 700; font-size: 1rem;">
                            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('compro.feedback.store') }}" method="POST" style="max-width: 1000px; margin: 0 auto;">
                        @csrf
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 32px; margin-bottom: 32px;">
                            <div>
                                <label style="display: block; font-size: 0.9rem; font-weight: 800; color: var(--primary); margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Nama Lengkap *</label>
                                <input type="text" name="name" required placeholder="Masukkan nama Anda" style="width: 100%; padding: 16px 20px; border-radius: 12px; border: 1px solid var(--border-soft); background: var(--bg-main); outline: none; transition: all 0.2s; font-size: 1rem;" onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 4px rgba(18, 53, 36, 0.05)';" onblur="this.style.borderColor='var(--border-soft)'; this.style.boxShadow='none';">
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.9rem; font-weight: 800; color: var(--primary); margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Email (Opsional)</label>
                                <input type="email" name="email" placeholder="email@contoh.com" style="width: 100%; padding: 16px 20px; border-radius: 12px; border: 1px solid var(--border-soft); background: var(--bg-main); outline: none; transition: all 0.2s; font-size: 1rem;" onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 4px rgba(18, 53, 36, 0.05)';" onblur="this.style.borderColor='var(--border-soft)'; this.style.boxShadow='none';">
                            </div>
                        </div>
                        <div style="margin-bottom: 32px;">
                            <label style="display: block; font-size: 0.9rem; font-weight: 800; color: var(--primary); margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Subjek Pesan</label>
                            <input type="text" name="subject" placeholder="Apa perihal pesan Anda?" style="width: 100%; padding: 16px 20px; border-radius: 12px; border: 1px solid var(--border-soft); background: var(--bg-main); outline: none; transition: all 0.2s; font-size: 1rem;" onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 4px rgba(18, 53, 36, 0.05)';" onblur="this.style.borderColor='var(--border-soft)'; this.style.boxShadow='none';">
                        </div>
                        <div style="margin-bottom: 40px;">
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