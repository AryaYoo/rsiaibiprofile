@extends('layouts.company')

@section('title', 'Pendaftaran Janji Online | RSIA IBI Surabaya')

@section('meta')
    <meta name="description"
        content="Daftarkan janji temu online Anda dengan dokter spesialis di RSIA IBI Surabaya. Cepat, mudah, dan tanpa antrian panjang.">
@endsection

@section('content')

    {{-- ============================================
    PAGE HEADER
    ============================================ --}}
    <section id="header" class="page-header pend-header">
    </section>

    {{-- ============================================
    STEP WIZARD
    ============================================ --}}
    <section class="pend-wizard-section">
        <div class="container">

            {{-- Step Indicator --}}
            <div class="pend-stepper" id="stepIndicator">
                <div class="pend-stepper-item active" id="step-ind-1">
                    <div class="pend-stepper-circle">
                        <span class="step-num">1</span>
                        <i class="fas fa-check step-check" style="display:none;"></i>
                    </div>
                    <span class="pend-stepper-label">Data Diri</span>
                </div>
                <div class="pend-stepper-line" id="line-1"></div>
                <div class="pend-stepper-item locked" id="step-ind-2">
                    <div class="pend-stepper-circle">
                        <span class="step-num">2</span>
                        <i class="fas fa-check step-check" style="display:none;"></i>
                    </div>
                    <span class="pend-stepper-label">Kunjungan</span>
                </div>
                <div class="pend-stepper-line" id="line-2"></div>
                <div class="pend-stepper-item locked" id="step-ind-3">
                    <div class="pend-stepper-circle">
                        <span class="step-num">3</span>
                        <i class="fas fa-check step-check" style="display:none;"></i>
                    </div>
                    <span class="pend-stepper-label">Ringkasan</span>
                </div>
            </div>

            {{-- Form Card --}}
            <div class="pend-form-wrap">

                @if(session('success'))
                    <div class="pend-alert pend-alert--success">
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <strong>Pendaftaran Berhasil Dikirim!</strong>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                <form action="{{ route('compro.pendaftaran.store') }}" method="POST" id="pendaftaranForm" novalidate>
                    @csrf

                    <div class="pend-steps-slider">

                        {{-- ======= STEP 1: Data Diri ======= --}}
                        <div class="pend-step active" id="step-1">
                            <div class="pend-step-header">
                                <h2>Data Diri</h2>
                                <p>Isi informasi kontak Anda agar kami bisa menghubungi Anda.</p>
                            </div>

                            <div class="pend-fields">
                                <div class="pend-field" data-required>
                                    <label for="nama">Nama Lengkap <span class="req">*</span></label>
                                    <div class="pend-input-wrap">
                                        <i class="fas fa-user pend-input-icon"></i>
                                        <input type="text" id="nama" name="nama" placeholder="Nama lengkap pasien"
                                            value="{{ old('nama') }}" class="pend-input" required autocomplete="name">
                                    </div>
                                    <span class="pend-field-error" id="err-nama"></span>
                                </div>

                                <div class="pend-field-row">
                                    <div class="pend-field" data-required>
                                        <label for="email">Email <span class="req">*</span></label>
                                        <div class="pend-input-wrap">
                                            <i class="fas fa-envelope pend-input-icon"></i>
                                            <input type="email" id="email" name="email" placeholder="email@contoh.com"
                                                value="{{ old('email') }}" class="pend-input" required autocomplete="email">
                                        </div>
                                        <span class="pend-field-error" id="err-email"></span>
                                    </div>
                                    <div class="pend-field" data-required>
                                        <label for="no_telp">Nomor Telepon / HP <span class="req">*</span></label>
                                        <div class="pend-input-wrap">
                                            <i class="fas fa-phone pend-input-icon"></i>
                                            <input type="tel" id="no_telp" name="no_telp" placeholder="08xxxxxxxxxx"
                                                value="{{ old('no_telp') }}" class="pend-input" required>
                                        </div>
                                        <span class="pend-field-error" id="err-no_telp"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="pend-step-nav">
                                <div></div>
                                <button type="button" class="pend-btn-next" onclick="nextStep(1)">
                                    Lanjut: Info Kunjungan <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>

                        {{-- ======= STEP 2: Info Kunjungan ======= --}}
                        <div class="pend-step pend-step--locked" id="step-2">
                            <div class="pend-step-header">
                                <h2>Info Kunjungan</h2>
                                <p>Pilih tujuan poli dan sampaikan keluhan Anda.</p>
                            </div>

                            <div class="pend-locked-overlay" id="overlay-2">
                                <div class="pend-locked-msg">
                                    <i class="fas fa-lock"></i>
                                    <p>Selesaikan <strong>Data Diri</strong> terlebih dahulu</p>
                                </div>
                            </div>

                            <div class="pend-fields">
                                <div class="pend-field" data-required>
                                    <label for="tujuan_poli">Tujuan Periksa / Poli <span class="req">*</span></label>
                                    <div class="pend-input-wrap pend-input-wrap--select">
                                        <i class="fas fa-hospital pend-input-icon"></i>
                                        <select id="tujuan_poli" name="tujuan_poli" required class="pend-input pend-select">
                                            <option value="" disabled selected>-- Pilih Poli --</option>
                                            <option value="Poli Anak" {{ old('tujuan_poli') === 'Poli Anak' ? 'selected' : '' }}>Poli Anak</option>
                                            <option value="Poli Penyakit Dalam" {{ old('tujuan_poli') === 'Poli Penyakit Dalam' ? 'selected' : '' }}>Poli Penyakit Dalam</option>
                                            <option value="Poli OBGYN" {{ old('tujuan_poli') === 'Poli OBGYN' ? 'selected' : '' }}>Poli OBGYN</option>
                                        </select>
                                        <i class="fas fa-chevron-down pend-select-arrow"></i>
                                    </div>
                                    <span class="pend-field-error" id="err-tujuan_poli"></span>
                                </div>

                                <div class="pend-field" data-required>
                                    <label for="pesan">Keluhan / Pesan <span class="req">*</span></label>
                                    <div class="pend-input-wrap pend-input-wrap--textarea">
                                        <i class="fas fa-comment-medical pend-input-icon pend-input-icon--top"></i>
                                        <textarea id="pesan" name="pesan" rows="4"
                                            placeholder="Ceritakan keluhan Anda atau informasi yang perlu diketahui dokter..."
                                            class="pend-input pend-textarea" required>{{ old('pesan') }}</textarea>
                                    </div>
                                    <span class="pend-field-error" id="err-pesan"></span>
                                </div>
                            </div>

                            <div class="pend-step-nav">
                                <button type="button" class="pend-btn-back" onclick="prevStep(2)">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </button>
                                <button type="button" class="pend-btn-next" onclick="nextStep(2)">
                                    Lanjut: Ringkasan <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>

                        {{-- ======= STEP 3: Ringkasan & Kirim ======= --}}
                        <div class="pend-step pend-step--locked" id="step-3">
                            <div class="pend-step-header">
                                <h2>Ringkasan & Kirim</h2>
                                <p>Periksa kembali data Anda sebelum mengirim pendaftaran.</p>
                            </div>

                            <div class="pend-locked-overlay" id="overlay-3">
                                <div class="pend-locked-msg">
                                    <i class="fas fa-lock"></i>
                                    <p>Selesaikan <strong>Info Kunjungan</strong> terlebih dahulu</p>
                                </div>
                            </div>

                            <div class="pend-fields">
                                {{-- Summary Review --}}
                                <div class="pend-summary" id="summaryBox">
                                    <div class="pend-summary-title"><i class="fas fa-clipboard-check"></i> Ringkasan Data
                                        Janji</div>
                                    <div class="pend-summary-grid">
                                        <div><span>Nama Lengkap</span><strong id="sum-nama">—</strong></div>
                                        <div><span>No. HP / WhatsApp</span><strong id="sum-hp">—</strong></div>
                                        <div style="grid-column: span 2;"><span>Email</span><strong
                                                id="sum-email">—</strong></div>
                                        <div style="grid-column: span 2;"><span>Tujuan Poli</span><strong
                                                id="sum-poli">—</strong></div>
                                        <div style="grid-column: span 2;">
                                            <span>Keluhan / Pesan</span>
                                            <p id="sum-pesan"
                                                style="font-size: 0.9rem; font-weight: 600; color: var(--primary); margin-top: 4px; background: rgba(18, 53, 36, 0.04); padding: 12px; border-radius: 8px; border: 1px dashed rgba(18, 53, 36, 0.15); font-family: inherit; white-space: pre-line;">
                                                —</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="pend-privacy-note">
                                    <i class="fas fa-shield-alt"></i>
                                    <span>Data Anda aman dan hanya digunakan untuk keperluan pendaftaran layanan kesehatan
                                        di RSIA IBI Surabaya.</span>
                                </div>
                            </div>

                            <div class="pend-step-nav">
                                <button type="button" class="pend-btn-back" onclick="prevStep(3)">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </button>
                                <button type="submit" class="pend-btn-submit" id="submitBtn">
                                    <span class="pend-submit-text"><i class="fas fa-paper-plane"></i> Kirim
                                        Pendaftaran</span>
                                    <span class="pend-submit-loading" style="display:none;"><i
                                            class="fas fa-spinner fa-spin"></i> Mengirim...</span>
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
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
        /* Hide Whatsapp Float only on this page */
        .whatsapp-float {
            display: none !important;
        }

        /* ============================================
               PAGE HEADER
            ============================================ */
        .pend-header {
            padding: 95px 0 15px !important;
        }

        .pend-header h1 .pend-accent {
            color: var(--accent);
        }

        /* ============================================
               WIZARD SECTION
            ============================================ */
        .pend-wizard-section {
            background: var(--bg-main);
            padding: 64px 0 80px;
        }

        /* ============================================
               STEP INDICATOR
            ============================================ */
        .pend-stepper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            margin-bottom: 48px;
        }

        .pend-stepper-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            position: relative;
        }

        .pend-stepper-circle {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1rem;
            border: 3px solid var(--border-soft);
            background: var(--white);
            color: var(--text-muted);
            transition: all 0.35s ease;
            position: relative;
            z-index: 1;
        }

        .pend-stepper-item.active .pend-stepper-circle {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--white);
            box-shadow: 0 0 0 6px rgba(18, 53, 36, 0.1);
        }

        .pend-stepper-item.done .pend-stepper-circle {
            background: var(--primary-light);
            border-color: var(--primary-light);
            color: var(--white);
        }

        .pend-stepper-item.locked .pend-stepper-circle {
            background: var(--bg-main);
            border-color: var(--border-soft);
            color: var(--border-soft);
        }

        .pend-stepper-label {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text-muted);
            text-align: center;
            transition: color 0.3s;
            white-space: nowrap;
        }

        .pend-stepper-item.active .pend-stepper-label {
            color: var(--primary);
        }

        .pend-stepper-item.done .pend-stepper-label {
            color: var(--primary-light);
        }

        .pend-stepper-item.locked .pend-stepper-label {
            color: var(--border-soft);
        }

        .pend-stepper-line {
            width: 120px;
            height: 3px;
            background: var(--border-soft);
            border-radius: 3px;
            margin-bottom: 28px;
            transition: background 0.4s ease;
            flex-shrink: 0;
        }

        .pend-stepper-line.done {
            background: var(--primary-light);
        }

        /* ============================================
               FORM WRAP
            ============================================ */
        .pend-form-wrap {
            max-width: 680px;
            margin: 0 auto;
            overflow: hidden;
            transition: height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .pend-steps-slider {
            display: flex;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            width: 100%;
            align-items: flex-start;
        }

        /* ============================================
               ALERTS
            ============================================ */
        .pend-alert {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 18px 24px;
            border-radius: 16px;
            margin-bottom: 24px;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .pend-alert i {
            font-size: 1.2rem;
            margin-top: 1px;
            flex-shrink: 0;
        }

        .pend-alert div {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .pend-alert strong {
            font-weight: 800;
            display: block;
        }

        .pend-alert--success {
            background: #ecfdf5;
            border: 1px solid #10b981;
            color: #065f46;
        }

        .pend-alert--success i {
            color: #10b981;
        }

        /* ============================================
               STEP CARD
            ============================================ */
        .pend-step {
            width: 100%;
            flex: 0 0 100%;
            box-sizing: border-box;
            background: var(--white);
            border-radius: var(--radius);
            border: 1px solid var(--border-soft);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            position: relative;
            transition: all 0.35s ease;
        }

        .pend-step--locked {
            opacity: 0.6;
        }

        .pend-step-header {
            padding: 32px 40px 28px;
            border-bottom: 1px solid var(--border-soft);
            background: linear-gradient(135deg, var(--primary-soft) 0%, var(--white) 100%);
        }

        .pend-step-header-badge {
            display: inline-block;
            background: var(--primary);
            color: var(--accent);
            padding: 4px 14px;
            border-radius: 60px;
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .pend-step-header h2 {
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: 6px;
        }

        .pend-step-header p {
            color: var(--text-muted);
            font-size: 0.92rem;
            margin: 0;
        }

        /* ============================================
               LOCK OVERLAY
            ============================================ */
        .pend-locked-overlay {
            position: absolute;
            inset: 0;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(245, 247, 243, 0.6);
            backdrop-filter: blur(3px);
            -webkit-backdrop-filter: blur(3px);
            transition: opacity 0.35s ease;
            border-radius: var(--radius);
        }

        .pend-locked-msg {
            text-align: center;
            color: var(--text-muted);
        }

        .pend-locked-msg i {
            font-size: 2.5rem;
            color: var(--border-soft);
            margin-bottom: 12px;
            display: block;
        }

        .pend-locked-msg p {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-muted);
            margin: 0;
        }

        /* ============================================
               FIELDS
            ============================================ */
        .pend-fields {
            padding: 32px 40px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .pend-field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .pend-field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .pend-field label {
            font-size: 0.84rem;
            font-weight: 800;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .req {
            color: #ef4444;
        }

        .pend-field-error {
            font-size: 0.78rem;
            color: #ef4444;
            font-weight: 600;
            min-height: 16px;
            display: block;
            margin-top: -4px;
        }

        /* ============================================
               INPUTS
            ============================================ */
        .pend-input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .pend-input-wrap--textarea {
            align-items: flex-start;
        }

        .pend-input-icon {
            position: absolute;
            left: 16px;
            color: var(--text-muted);
            font-size: 0.9rem;
            pointer-events: none;
            z-index: 1;
            transition: color 0.2s;
        }

        .pend-input-icon--top {
            top: 16px;
        }

        .pend-input {
            width: 100%;
            padding: 14px 16px 14px 44px;
            border-radius: 12px;
            border: 1.5px solid var(--border-soft);
            background: var(--bg-main);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.95rem;
            color: var(--text-main);
            outline: none;
            transition: all 0.2s;
            -webkit-appearance: none;
            appearance: none;
        }

        .pend-input:focus {
            border-color: var(--primary);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(18, 53, 36, 0.06);
        }

        .pend-input-wrap:focus-within .pend-input-icon {
            color: var(--primary);
        }

        .pend-input.is-error {
            border-color: #ef4444;
            background: #fff5f5;
        }

        .pend-textarea {
            resize: vertical;
            min-height: 110px;
            line-height: 1.6;
        }

        .pend-input-wrap--select {
            position: relative;
        }

        .pend-select {
            cursor: pointer;
        }

        .pend-select-arrow {
            position: absolute;
            right: 16px;
            color: var(--text-muted);
            font-size: 0.8rem;
            pointer-events: none;
        }

        /* ============================================
               SUMMARY
            ============================================ */
        .pend-summary {
            background: var(--primary-soft);
            border: 1px solid rgba(18, 53, 36, 0.12);
            border-radius: 14px;
            padding: 24px;
        }

        .pend-summary-title {
            font-size: 0.85rem;
            font-weight: 800;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .pend-summary-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px 24px;
        }

        .pend-summary-grid>div {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .pend-summary-grid span {
            font-size: 0.75rem;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .pend-summary-grid strong {
            font-size: 0.9rem;
            color: var(--primary);
            font-weight: 700;
        }

        /* ============================================
               PRIVACY NOTE
            ============================================ */
        .pend-privacy-note {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 14px 18px;
            background: var(--primary-soft);
            border-radius: 10px;
            font-size: 0.82rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .pend-privacy-note i {
            color: var(--primary-light);
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* ============================================
               STEP NAV
            ============================================ */
        .pend-step-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 24px 40px 32px;
            border-top: 1px solid var(--border-soft);
            background: var(--bg-main);
        }

        .pend-btn-next {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--primary);
            color: var(--white);
            border: none;
            border-radius: 12px;
            padding: 14px 28px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.92rem;
            font-weight: 800;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 6px 16px rgba(18, 53, 36, 0.18);
            margin-left: auto;
        }

        .pend-btn-next:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(18, 53, 36, 0.25);
        }

        .pend-btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: var(--text-muted);
            border: 1.5px solid var(--border-soft);
            border-radius: 12px;
            padding: 13px 22px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition);
        }

        .pend-btn-back:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-soft);
        }

        .pend-btn-submit {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: var(--white);
            border: none;
            border-radius: 12px;
            padding: 14px 32px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.95rem;
            font-weight: 800;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 8px 20px rgba(18, 53, 36, 0.2);
        }

        .pend-btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 28px rgba(18, 53, 36, 0.3);
        }

        /* ============================================
               RESPONSIVE
            ============================================ */
        @media (max-width: 768px) {
            .pend-header {
                padding: 70px 0 10px !important;
            }

            .pend-wizard-section {
                padding: 15px 0 25px;
            }

            .pend-stepper {
                margin-bottom: 20px;
            }

            .pend-stepper-circle {
                width: 36px;
                height: 36px;
                font-size: 0.85rem;
            }

            .pend-stepper-item {
                gap: 6px;
            }

            .pend-stepper-label {
                font-size: 0.75rem;
            }

            .pend-stepper-line {
                width: 40px;
                margin-bottom: 20px;
            }

            .pend-step-header,
            .pend-fields,
            .pend-step-nav {
                padding-left: 15px;
                padding-right: 15px;
            }

            .pend-step-header {
                padding-top: 15px;
                padding-bottom: 10px;
            }

            .pend-step-header-badge {
                margin-bottom: 8px;
                font-size: 0.65rem;
                padding: 3px 10px;
            }

            .pend-step-header h2 {
                font-size: 1.25rem;
                margin-bottom: 4px;
            }

            .pend-fields {
                padding-top: 15px;
                padding-bottom: 15px;
                gap: 12px;
            }

            .pend-field-row {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .pend-field label {
                font-size: 0.75rem;
            }

            .pend-input {
                padding: 10px 14px 10px 38px;
                font-size: 0.85rem;
            }

            .pend-input-icon {
                font-size: 0.8rem;
                left: 14px;
            }

            .pend-input-icon--top {
                top: 12px;
            }

            .pend-textarea {
                min-height: 80px;
            }

            .pend-summary {
                padding: 15px;
            }

            .pend-summary-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .pend-step-nav {
                flex-direction: column;
                gap: 10px;
                padding-top: 15px;
                padding-bottom: 15px;
            }

            .pend-btn-next,
            .pend-btn-back,
            .pend-btn-submit {
                width: 100%;
                justify-content: center;
                padding: 12px 20px;
                font-size: 0.85rem;
            }
        }

        @media (max-width: 480px) {
            .pend-stepper-label {
                font-size: 0.65rem;
            }

            .pend-stepper-circle {
                width: 32px;
                height: 32px;
                font-size: 0.8rem;
            }

            .pend-stepper-line {
                width: 25px;
            }
        }
    </style>
@endsection

@push('scripts')
    <script>
        let currentStep = 1;
        const TOTAL_STEPS = 3;

        document.addEventListener('DOMContentLoaded', function () {
            // Adjust height initially
            setTimeout(adjustFormHeight, 150);

            // If there were validation errors, unlock step 2 and go there
            @if($errors->any())
                unlockStep(2);
                unlockStep(3);
                @if($errors->has('tujuan_poli') || $errors->has('pesan'))
                    goToStep(2);
                @endif
            @else
                                        // Set initial tabindex for steps 2 and 3
                                        const step2 = document.getElementById('step-2');
                    if (step2) step2.querySelectorAll('input, select, textarea, button').forEach(el => el.setAttribute('tabindex', '-1'));
                    const step3 = document.getElementById('step-3');
                    if (step3) step3.querySelectorAll('input, select, textarea, button').forEach(el => el.setAttribute('tabindex', '-1'));
                @endif

            // Submit validation and loading state
            document.getElementById('pendaftaranForm').addEventListener('submit', function (e) {
                if (!validateStep(1) || !validateStep(2)) {
                    e.preventDefault();
                    if (!validateStep(1)) {
                        goToStep(1);
                    } else {
                        goToStep(2);
                    }
                    return false;
                }
                const btn = document.getElementById('submitBtn');
                btn.querySelector('.pend-submit-text').style.display = 'none';
                btn.querySelector('.pend-submit-loading').style.display = 'inline-flex';
                btn.disabled = true;
            });

            // Listen for window resize to adjust container height
            window.addEventListener('resize', adjustFormHeight);
        });

        function adjustFormHeight() {
            const activeStepEl = document.querySelector('.pend-step.active');
            const formWrap = document.querySelector('.pend-form-wrap');
            if (activeStepEl && formWrap) {
                formWrap.style.height = activeStepEl.offsetHeight + 'px';
            }
        }

        function validateStep(step) {
            let isValid = true;
            const stepEl = document.getElementById('step-' + step);

            // Clear previous errors
            stepEl.querySelectorAll('.pend-field-error').forEach(el => el.textContent = '');
            stepEl.querySelectorAll('.pend-input').forEach(el => el.classList.remove('is-error'));

            if (step === 1) {
                const nama = document.getElementById('nama');
                const email = document.getElementById('email');
                const hp = document.getElementById('no_telp');

                if (!nama.value.trim()) {
                    showError('err-nama', 'Nama lengkap wajib diisi.', nama);
                    isValid = false;
                }
                if (!email.value.trim()) {
                    showError('err-email', 'Email wajib diisi.', email);
                    isValid = false;
                } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
                    showError('err-email', 'Format email tidak valid.', email);
                    isValid = false;
                }
                if (!hp.value.trim()) {
                    showError('err-no_telp', 'Nomor telepon wajib diisi.', hp);
                    isValid = false;
                }
            }

            if (step === 2) {
                const poli = document.getElementById('tujuan_poli');
                const pesan = document.getElementById('pesan');

                if (!poli.value) {
                    showError('err-tujuan_poli', 'Tujuan poli wajib dipilih.', poli);
                    isValid = false;
                }
                if (!pesan.value.trim()) {
                    showError('err-pesan', 'Keluhan atau pesan wajib diisi.', pesan);
                    isValid = false;
                }
            }

            return isValid;
        }

        function showError(errId, message, inputEl) {
            document.getElementById(errId).textContent = message;
            if (inputEl) inputEl.classList.add('is-error');
        }

        function nextStep(from) {
            if (!validateStep(from)) return;

            const next = from + 1;
            unlockStep(next);
            goToStep(next);

            if (next === 3) fillSummary();
        }

        function prevStep(from) {
            goToStep(from - 1);
        }

        function unlockStep(step) {
            const overlay = document.getElementById('overlay-' + step);
            const stepEl = document.getElementById('step-' + step);

            if (overlay) {
                overlay.style.opacity = '0';
                overlay.style.pointerEvents = 'none';
            }

            stepEl.classList.remove('pend-step--locked');
        }

        function goToStep(step) {
            currentStep = step;

            // Slide to the current step
            const slider = document.querySelector('.pend-steps-slider');
            if (slider) {
                slider.style.transform = `translateX(-${(step - 1) * 100}%)`;
            }

            // Toggle active class and disable/enable tab index
            for (let i = 1; i <= TOTAL_STEPS; i++) {
                const stepEl = document.getElementById('step-' + i);
                if (stepEl) {
                    if (i === step) {
                        stepEl.classList.add('active');
                        stepEl.querySelectorAll('input, select, textarea, button').forEach(el => el.removeAttribute('tabindex'));
                    } else {
                        stepEl.classList.remove('active');
                        stepEl.querySelectorAll('input, select, textarea, button').forEach(el => el.setAttribute('tabindex', '-1'));
                    }
                }
            }

            // Update step indicator
            for (let i = 1; i <= TOTAL_STEPS; i++) {
                const ind = document.getElementById('step-ind-' + i);
                if (ind) {
                    ind.classList.remove('active', 'done', 'locked');

                    if (i < step) ind.classList.add('done');
                    else if (i === step) ind.classList.add('active');
                    else ind.classList.add('locked');

                    const numEl = ind.querySelector('.step-num');
                    const checkEl = ind.querySelector('.step-check');
                    if (numEl && checkEl) {
                        if (i < step) {
                            numEl.style.display = 'none';
                            checkEl.style.display = 'inline';
                        } else {
                            numEl.style.display = 'inline';
                            checkEl.style.display = 'none';
                        }
                    }
                }
            }

            // Update step lines
            const line1 = document.getElementById('line-1');
            if (line1) {
                line1.classList.toggle('done', step > 1);
            }
            const line2 = document.getElementById('line-2');
            if (line2) {
                line2.classList.toggle('done', step > 2);
            }

            // Smooth height transition
            setTimeout(adjustFormHeight, 50);

            // Smooth scroll to form
            const formWrap = document.querySelector('.pend-form-wrap');
            if (formWrap) {
                formWrap.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        }

        function fillSummary() {
            document.getElementById('sum-nama').textContent = document.getElementById('nama').value || '—';
            document.getElementById('sum-email').textContent = document.getElementById('email').value || '—';
            document.getElementById('sum-hp').textContent = document.getElementById('no_telp').value || '—';
            document.getElementById('sum-poli').textContent = document.getElementById('tujuan_poli').value || '—';
            document.getElementById('sum-pesan').textContent = document.getElementById('pesan').value || '—';
        }
    </script>
@endpush