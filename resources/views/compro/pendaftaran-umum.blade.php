@extends('layouts.company')

@section('title', 'Pendaftaran Umum / Asuransi Swasta | RSIA IBI Surabaya')

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
    BREADCRUMB / BACK NAVIGATION
    ============================================ --}}
    <div class="pend-breadcrumb-bar">
        <div class="container">
            <a href="{{ route('compro.pendaftaran') }}" class="pend-back-link">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Pilihan Pendaftaran</span>
            </a>
            <div class="pend-breadcrumb-badge">
                <i class="fas fa-id-card"></i>
                Umum / Asuransi Swasta
            </div>
        </div>
    </div>

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

                <form action="{{ route('compro.pendaftaran.umum.store') }}" method="POST" id="pendaftaranForm" novalidate>
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
                                <div class="pend-field-row pend-field-row--date-poli">
                                    <div class="pend-field" data-required>
                                        <label for="tanggal_kunjungan">Tanggal Kunjungan <span class="req">*</span></label>
                                        <div class="pend-input-wrap">
                                            <i class="fas fa-calendar-alt pend-input-icon"></i>
                                            <input type="date" id="tanggal_kunjungan" name="tanggal_kunjungan"
                                                value="{{ old('tanggal_kunjungan', date('Y-m-d')) }}"
                                                min="{{ date('Y-m-d') }}"
                                                class="pend-input" required>
                                        </div>
                                        <span class="pend-field-error" id="err-tanggal_kunjungan"></span>
                                    </div>

                                    <div class="pend-field" data-required>
                                        <label for="tujuan_poli">Tujuan Periksa / Poli <span class="req">*</span></label>
                                        <div class="pend-input-wrap pend-input-wrap--select">
                                            <i class="fas fa-hospital pend-input-icon"></i>
                                            <select id="tujuan_poli" name="tujuan_poli" required class="pend-input pend-select">
                                                <option value="" disabled selected>-- Pilih Poli --</option>
                                                @foreach($poliList as $poli)
                                                    <option value="{{ $poli }}" {{ old('tujuan_poli') === $poli ? 'selected' : '' }}>{{ $poli }}</option>
                                                @endforeach
                                            </select>
                                            <i class="fas fa-chevron-down pend-select-arrow"></i>
                                        </div>
                                        <span class="pend-field-error" id="err-tujuan_poli"></span>
                                    </div>
                                </div>

                                <div class="pend-field" data-required>
                                    <label for="doctor_id">Pilih Dokter <span class="req">*</span></label>
                                    <div class="pend-input-wrap pend-input-wrap--select">
                                        <i class="fas fa-user-md pend-input-icon"></i>
                                        <select id="doctor_id" name="doctor_id" required class="pend-input pend-select" disabled>
                                            <option value="" disabled selected>-- Pilih poli terlebih dahulu --</option>
                                        </select>
                                        <i class="fas fa-chevron-down pend-select-arrow"></i>
                                    </div>
                                    <span class="pend-field-error" id="err-doctor_id"></span>
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
                                        <div><span>Tanggal Kunjungan</span><strong id="sum-tgl-kunjungan">—</strong></div>
                                        <div><span>Tujuan Poli</span><strong id="sum-poli">—</strong></div>
                                        <div style="grid-column: span 2;"><span>Dokter</span><strong
                                                id="sum-dokter">—</strong></div>
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
                                            class="fas fa-circle-notch fa-spin"></i> Mengirim...</span>
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

        /* ============================================
               BREADCRUMB BAR
            ============================================ */
        .pend-breadcrumb-bar {
            background: var(--white);
            border-bottom: 1px solid var(--border-soft);
            padding: 14px 0;
        }

        .pend-breadcrumb-bar .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .pend-back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 700;
            transition: color 0.2s;
        }

        .pend-back-link:hover {
            color: var(--primary);
        }

        .pend-back-link i {
            font-size: 0.82rem;
        }

        .pend-breadcrumb-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary-soft);
            color: var(--primary);
            padding: 6px 16px;
            border-radius: 60px;
            font-size: 0.8rem;
            font-weight: 800;
            letter-spacing: 0.3px;
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

        .pend-field-row--date-poli {
            grid-template-columns: 1fr 1.6fr;
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
            justify-content: center;
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

        .pend-submit-text,
        .pend-submit-loading {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .pend-submit-loading i {
            display: inline-block;
            line-height: 1;
            vertical-align: middle;
        }

        /* ============================================
               RESPONSIVE
            ============================================ */
        @media (max-width: 768px) {
            .pend-header {
                padding: 64px 0 18px !important;
            }

            .pend-breadcrumb-bar {
                padding: 8px 0;
            }

            .pend-breadcrumb-bar .container {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                gap: 8px;
                flex-wrap: nowrap;
            }

            .pend-back-link {
                min-width: 0;
                gap: 6px;
                font-size: 0.76rem;
                white-space: nowrap;
            }

            .pend-back-link i {
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

            .pend-back-link span {
                max-width: 136px;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .pend-breadcrumb-badge {
                flex-shrink: 0;
                gap: 5px;
                padding: 5px 10px;
                font-size: 0.68rem;
                letter-spacing: 0;
                white-space: nowrap;
            }

            .pend-breadcrumb-badge i {
                font-size: 0.72rem;
            }

            .pend-wizard-section {
                padding: 15px 0 25px;
            }

            .pend-stepper {
                margin-bottom: 12px;
            }

            .pend-stepper-circle {
                width: 30px;
                height: 30px;
                border-width: 2px;
                font-size: 0.74rem;
            }

            .pend-stepper-item {
                gap: 4px;
            }

            .pend-stepper-label {
                font-size: 0.64rem;
            }

            .pend-stepper-line {
                width: 34px;
                height: 2px;
                margin-bottom: 16px;
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

            .pend-step-header h2 {
                font-size: 1.25rem;
                margin-bottom: 4px;
            }

            .pend-step-header p {
                display: none;
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

            .pend-field-row--date-poli {
                grid-template-columns: 1fr 1.5fr !important;
                gap: 10px !important;
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
            .pend-breadcrumb-bar {
                padding: 6px 0;
            }

            .pend-back-link span {
                max-width: 58px;
            }

            .pend-breadcrumb-badge {
                padding: 5px 8px;
                font-size: 0.62rem;
            }

            .pend-stepper-label {
                font-size: 0.58rem;
            }

            .pend-stepper-circle {
                width: 26px;
                height: 26px;
                font-size: 0.66rem;
            }

            .pend-stepper-line {
                width: 24px;
                margin-bottom: 14px;
            }

            .pend-field-row--date-poli {
                grid-template-columns: 135px 1fr !important;
                gap: 8px !important;
            }
        }

        /* ============================================
           SWEETALERT RECEIPT POPUP STYLING & MOBILE RESPONSIVE
           ============================================ */
        .swal2-popup.pend-receipt-popup {
            border-radius: 24px !important;
            padding: 24px 20px !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            box-shadow: 0 20px 50px rgba(18, 53, 36, 0.2) !important;
            max-width: 480px !important;
            width: 92vw !important;
        }

        .swal2-popup.pend-receipt-popup .swal2-title {
            font-size: 1.5rem !important;
            font-weight: 800 !important;
            color: var(--primary) !important;
            margin-bottom: 12px !important;
        }

        .swal2-popup.pend-receipt-popup .swal2-html-container {
            margin: 0 !important;
            padding: 0 !important;
        }

        .swal2-popup.pend-receipt-popup .swal2-icon.swal2-success {
            border-color: var(--primary-light) !important;
            color: var(--primary-light) !important;
        }

        .swal2-popup.pend-receipt-popup .swal2-icon.swal2-success [class^='swal2-success-line'] {
            background-color: var(--primary-light) !important;
        }

        .swal2-popup.pend-receipt-popup .swal2-icon.swal2-success .swal2-success-ring {
            border-color: rgba(62, 123, 39, 0.3) !important;
        }

        .swal2-popup.pend-receipt-popup .swal2-actions {
            margin-top: 20px !important;
            display: grid !important;
            grid-template-columns: 1fr 1fr !important;
            gap: 10px !important;
            width: 100% !important;
        }

        /* Buttons Styling consistent with main theme */
        .swal2-popup.pend-receipt-popup .swal2-confirm {
            grid-column: 1 !important;
            width: 100% !important;
            margin: 0 !important;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%) !important;
            color: #ffffff !important;
            border-radius: 12px !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            padding: 12px 16px !important;
            box-shadow: 0 4px 12px rgba(18, 53, 36, 0.2) !important;
            transition: var(--transition) !important;
        }

        .swal2-popup.pend-receipt-popup .swal2-confirm:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 16px rgba(18, 53, 36, 0.3) !important;
        }

        .swal2-popup.pend-receipt-popup .swal2-deny {
            grid-column: 2 !important;
            width: 100% !important;
            margin: 0 !important;
            background: var(--primary-light) !important;
            color: #ffffff !important;
            border-radius: 12px !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            padding: 12px 16px !important;
            box-shadow: 0 4px 12px rgba(62, 123, 39, 0.2) !important;
            transition: var(--transition) !important;
        }

        .swal2-popup.pend-receipt-popup .swal2-deny:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 16px rgba(62, 123, 39, 0.3) !important;
        }

        .swal2-popup.pend-receipt-popup .swal2-cancel {
            grid-column: 1 / -1 !important;
            width: 100% !important;
            margin: 0 !important;
            background: var(--bg-main) !important;
            color: var(--text-muted) !important;
            border: 1.5px solid var(--border-soft) !important;
            border-radius: 12px !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            padding: 12px 16px !important;
            transition: var(--transition) !important;
        }

        .swal2-popup.pend-receipt-popup .swal2-cancel:hover {
            background: var(--border-soft) !important;
            color: var(--primary) !important;
        }

        /* Mobile Responsiveness for Receipt Popup */
        @media (max-width: 600px) {
            .swal2-popup.pend-receipt-popup {
                padding: 16px 14px !important;
                max-height: 94vh !important;
                overflow-y: auto !important;
                border-radius: 20px !important;
            }

            .swal2-popup.pend-receipt-popup .swal2-icon {
                margin: 8px auto 8px !important;
                transform: scale(0.8) !important;
            }

            .swal2-popup.pend-receipt-popup .swal2-title {
                font-size: 1.2rem !important;
                margin-bottom: 8px !important;
            }

            .swal2-popup.pend-receipt-popup .swal2-actions {
                margin-top: 14px !important;
                gap: 8px !important;
            }

            .swal2-popup.pend-receipt-popup .swal2-actions button {
                padding: 11px 10px !important;
                font-size: 0.84rem !important;
            }

            #receiptPreview {
                border-radius: 12px !important;
            }

            #receiptPreview > div:first-child {
                padding: 12px 14px !important;
            }

            #receiptPreview > div:first-child > div:last-child {
                font-size: 22px !important;
            }

            #receiptPreview > div:nth-child(2) {
                padding: 12px 14px !important;
                gap: 8px !important;
            }

            #receiptPreview > div:nth-child(2) > div {
                grid-template-columns: 105px 1fr !important;
                gap: 8px !important;
            }

            #receiptPreview > div:nth-child(2) span {
                font-size: 11px !important;
            }

            #receiptPreview > div:nth-child(2) strong {
                font-size: 13px !important;
                word-break: break-word !important;
            }

            #receiptPreview > div:last-child {
                padding: 10px 14px !important;
                font-size: 11px !important;
            }
        }
    </style>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let currentStep = 1;
        const TOTAL_STEPS = 3;
        const appointmentReceipt = @json(session('appointment_receipt'));
        const doctorsData = @json($doctors);
        let receiptSavedOrPrinted = false;

        document.addEventListener('DOMContentLoaded', function () {
            // Adjust height initially
            setTimeout(adjustFormHeight, 150);
            setupDoctorOptions();
            showReceiptPopup();

            // If there were validation errors, unlock step 2 and go there
            @if($errors->any())
                unlockStep(2);
                unlockStep(3);
                @if($errors->has('tanggal_kunjungan') || $errors->has('tujuan_poli') || $errors->has('doctor_id') || $errors->has('pesan'))
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
                const tgl = document.getElementById('tanggal_kunjungan');
                const poli = document.getElementById('tujuan_poli');
                const doctor = document.getElementById('doctor_id');
                const pesan = document.getElementById('pesan');

                if (tgl && !tgl.value) {
                    showError('err-tanggal_kunjungan', 'Tanggal kunjungan wajib diisi.', tgl);
                    isValid = false;
                }
                if (!poli.value) {
                    showError('err-tujuan_poli', 'Tujuan poli wajib dipilih.', poli);
                    isValid = false;
                }
                if (!doctor.value) {
                    showError('err-doctor_id', 'Dokter wajib dipilih sesuai poli.', doctor);
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

        function getDayNameIndo(dateStr) {
            if (!dateStr) return '';
            const dateObj = new Date(dateStr + 'T00:00:00');
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            return days[dateObj.getDay()];
        }

        function setupDoctorOptions() {
            const dateInput = document.getElementById('tanggal_kunjungan');
            const poliSelect = document.getElementById('tujuan_poli');
            const doctorSelect = document.getElementById('doctor_id');
            if (!poliSelect || !doctorSelect) return;

            const oldDoctorId = "{{ old('doctor_id') }}";

            function updateDoctors() {
                const selectedPoli = poliSelect.value;
                const selectedDate = dateInput ? dateInput.value : '';
                const dayName = getDayNameIndo(selectedDate);

                doctorSelect.innerHTML = '';

                if (!selectedPoli) {
                    doctorSelect.disabled = true;
                    const opt = document.createElement('option');
                    opt.value = '';
                    opt.disabled = true;
                    opt.selected = true;
                    opt.textContent = '-- Pilih poli terlebih dahulu --';
                    doctorSelect.appendChild(opt);
                    return;
                }

                const filteredDoctors = doctorsData.filter(d => d.specialty === selectedPoli);

                if (filteredDoctors.length === 0) {
                    doctorSelect.disabled = true;
                    const opt = document.createElement('option');
                    opt.value = '';
                    opt.disabled = true;
                    opt.selected = true;
                    opt.textContent = '-- Belum ada dokter untuk poli ini --';
                    doctorSelect.appendChild(opt);
                    return;
                }

                doctorSelect.disabled = false;
                const defaultOpt = document.createElement('option');
                defaultOpt.value = '';
                defaultOpt.disabled = true;
                defaultOpt.selected = !oldDoctorId;
                defaultOpt.textContent = '-- Pilih Dokter --';
                doctorSelect.appendChild(defaultOpt);

                filteredDoctors.forEach(doc => {
                    const opt = document.createElement('option');
                    opt.value = doc.id;

                    let timeStr = '';
                    if (dayName && doc.schedules && doc.schedules.length > 0) {
                        const daySchedules = doc.schedules.filter(s => s.day === dayName && s.is_active);
                        if (daySchedules.length > 0) {
                            timeStr = daySchedules.map(s => s.time).join(', ');
                        }
                    }

                    let label = doc.name;
                    if (timeStr) {
                        label += ` (${timeStr})`;
                    } else if (dayName) {
                        label += ` (Tidak ada jadwal pada ${dayName})`;
                    }

                    opt.textContent = label;
                    if (oldDoctorId && String(doc.id) === String(oldDoctorId)) {
                        opt.selected = true;
                    }
                    doctorSelect.appendChild(opt);
                });
            }

            if (dateInput) {
                dateInput.addEventListener('change', () => {
                    updateDoctors();
                    adjustFormHeight();
                });
            }

            poliSelect.addEventListener('change', () => {
                doctorSelect.value = '';
                updateDoctors();
                adjustFormHeight();
            });

            updateDoctors();
        }

        function showReceiptPopup() {
            if (!appointmentReceipt || typeof Swal === 'undefined') return;

            Swal.fire({
                title: 'Pendaftaran Berhasil',
                html: buildReceiptHtml(appointmentReceipt),
                icon: 'success',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Simpan PNG',
                denyButtonText: 'Cetak / PDF',
                cancelButtonText: 'Tutup',
                allowOutsideClick: false,
                allowEscapeKey: false,
                customClass: {
                    popup: 'pend-receipt-popup',
                    htmlContainer: 'pend-receipt-html',
                },
                didOpen: () => {
                    const cancelBtn = Swal.getCancelButton();
                    if (cancelBtn) {
                        if (!receiptSavedOrPrinted) {
                            cancelBtn.style.opacity = '0.5';
                            cancelBtn.style.cursor = 'not-allowed';
                        } else {
                            cancelBtn.style.opacity = '1';
                            cancelBtn.style.cursor = 'pointer';
                        }

                        cancelBtn.addEventListener('click', function (e) {
                            if (!receiptSavedOrPrinted) {
                                e.stopImmediatePropagation();
                                e.preventDefault();
                                Swal.showValidationMessage('Harap klik tombol simpan / cetak terlebih dahulu');
                            }
                        }, true);
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    receiptSavedOrPrinted = true;
                    downloadReceiptImage(appointmentReceipt);
                    showReceiptPopup();
                } else if (result.isDenied) {
                    receiptSavedOrPrinted = true;
                    printReceipt(appointmentReceipt);
                    showReceiptPopup();
                }
            });
        }

        function buildReceiptHtml(receipt) {
            return `
                <div id="receiptPreview" style="text-align:left; border:1px solid #e4ebe2; border-radius:14px; overflow:hidden; font-family:'Plus Jakarta Sans', Arial, sans-serif;">
                    <div style="background:#123524; color:#fff; padding:18px 20px;">
                        <div style="font-size:12px; opacity:.8; font-weight:700; text-transform:uppercase; letter-spacing:.8px;">Bukti Pendaftaran RSIA IBI</div>
                        <div style="font-size:28px; line-height:1.1; font-weight:900; letter-spacing:1px; margin-top:6px;">${escapeHtml(receipt.kode)}</div>
                    </div>
                    <div style="padding:18px 20px; display:grid; gap:10px; color:#1a2e1a;">
                        ${receiptRow('Nama', receipt.nama)}
                        ${receiptRow('No. HP', receipt.no_telp)}
                        ${receiptRow('Email', receipt.email || '-')}
                        ${receiptRow('Tgl Kunjungan', receipt.tanggal_kunjungan || '-')}
                        ${receiptRow('Poli', receipt.tujuan_poli)}
                        ${receiptRow('Dokter', receipt.dokter || '-')}
                        ${receiptRow('Tanggal Daftar', receipt.tanggal)}
                    </div>
                    <div style="background:#f5f7f3; color:#5a6b5a; padding:12px 20px; font-size:12px; line-height:1.5;">
                        Tunjukkan bukti ini kepada petugas saat tiba di lokasi untuk validasi pendaftaran.
                    </div>
                </div>
            `;
        }

        function receiptRow(label, value) {
            return `
                <div style="display:grid; grid-template-columns:120px 1fr; gap:12px; align-items:start;">
                    <span style="font-size:12px; color:#5a6b5a; font-weight:800; text-transform:uppercase;">${escapeHtml(label)}</span>
                    <strong style="font-size:14px; color:#123524; font-weight:800;">${escapeHtml(value || '-')}</strong>
                </div>
            `;
        }

        function escapeHtml(value) {
            return String(value ?? '').replace(/[&<>"']/g, char => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;',
            }[char]));
        }

        function downloadReceiptImage(receipt) {
            const canvas = document.createElement('canvas');
            const width = 900;
            const height = 680;
            const ratio = window.devicePixelRatio || 1;
            canvas.width = width * ratio;
            canvas.height = height * ratio;
            canvas.style.width = width + 'px';
            canvas.style.height = height + 'px';

            const ctx = canvas.getContext('2d');
            ctx.scale(ratio, ratio);
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(0, 0, width, height);

            ctx.fillStyle = '#123524';
            ctx.fillRect(0, 0, width, 170);
            ctx.fillStyle = '#ffffff';
            ctx.font = '700 22px Arial';
            ctx.fillText('BUKTI PENDAFTARAN RSIA IBI', 54, 58);
            ctx.font = '900 54px Arial';
            ctx.fillText(receipt.kode || '-', 54, 126);

            ctx.fillStyle = '#f5f7f3';
            ctx.fillRect(54, 205, width - 108, 370);
            ctx.strokeStyle = '#e4ebe2';
            ctx.strokeRect(54, 205, width - 108, 370);

            const rows = [
                ['Nama', receipt.nama],
                ['No. HP', receipt.no_telp],
                ['Email', receipt.email || '-'],
                ['Tgl Kunjungan', receipt.tanggal_kunjungan || '-'],
                ['Poli', receipt.tujuan_poli],
                ['Dokter', receipt.dokter || '-'],
                ['Tanggal Daftar', receipt.tanggal],
            ];

            rows.forEach((row, index) => {
                const y = 255 + (index * 42);
                ctx.fillStyle = '#5a6b5a';
                ctx.font = '700 18px Arial';
                ctx.fillText(row[0], 90, y);
                ctx.fillStyle = '#123524';
                ctx.font = '700 20px Arial';
                ctx.fillText(String(row[1] || '-'), 300, y);
            });

            ctx.fillStyle = '#5a6b5a';
            ctx.font = '16px Arial';
            ctx.fillText('Tunjukkan bukti ini kepada petugas saat tiba di lokasi untuk validasi pendaftaran.', 54, 630);

            const link = document.createElement('a');
            link.download = `bukti-pendaftaran-${receipt.kode || 'rsia-ibi'}.png`;
            link.href = canvas.toDataURL('image/png');
            link.click();
        }

        function printReceipt(receipt) {
            const printWindow = window.open('', '_blank', 'width=720,height=900');
            if (!printWindow) return;

            printWindow.document.write(`
                <!doctype html>
                <html>
                <head>
                    <title>Bukti Pendaftaran ${escapeHtml(receipt.kode || '')}</title>
                    <style>
                        body { font-family: Arial, sans-serif; margin: 0; padding: 32px; color: #1a2e1a; }
                        .receipt { border: 1px solid #e4ebe2; border-radius: 14px; overflow: hidden; max-width: 620px; margin: 0 auto; }
                        .head { background: #123524; color: white; padding: 24px; }
                        .label { font-size: 12px; font-weight: 700; letter-spacing: .8px; text-transform: uppercase; opacity: .8; }
                        .code { font-size: 42px; font-weight: 900; letter-spacing: 1px; margin-top: 8px; }
                        .body { padding: 24px; display: grid; gap: 14px; }
                        .row { display: grid; grid-template-columns: 150px 1fr; gap: 16px; }
                        .row span { color: #5a6b5a; font-size: 12px; font-weight: 800; text-transform: uppercase; }
                        .row strong { color: #123524; font-size: 15px; }
                        .note { background: #f5f7f3; color: #5a6b5a; padding: 16px 24px; font-size: 13px; line-height: 1.5; }
                    </style>
                </head>
                <body>
                    <div class="receipt">
                        <div class="head">
                            <div class="label">Bukti Pendaftaran RSIA IBI</div>
                            <div class="code">${escapeHtml(receipt.kode || '-')}</div>
                        </div>
                        <div class="body">
                            ${receiptRow('Nama', receipt.nama)}
                            ${receiptRow('No. HP', receipt.no_telp)}
                            ${receiptRow('Email', receipt.email || '-')}
                            ${receiptRow('Tgl Kunjungan', receipt.tanggal_kunjungan || '-')}
                            ${receiptRow('Poli', receipt.tujuan_poli)}
                            ${receiptRow('Dokter', receipt.dokter || '-')}
                            ${receiptRow('Tanggal Daftar', receipt.tanggal)}
                        </div>
                        <div class="note">Tunjukkan bukti ini kepada petugas saat tiba di lokasi untuk validasi pendaftaran.</div>
                    </div>
                    <script>window.onload = () => window.print();<\/script>
                </body>
                </html>
            `);
            printWindow.document.close();
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
            const tglVal = document.getElementById('tanggal_kunjungan').value;
            if (tglVal) {
                const parts = tglVal.split('-');
                document.getElementById('sum-tgl-kunjungan').textContent = `${parts[2]}/${parts[1]}/${parts[0]}`;
            } else {
                document.getElementById('sum-tgl-kunjungan').textContent = '—';
            }
            document.getElementById('sum-poli').textContent = document.getElementById('tujuan_poli').value || '—';
            const doctorSelect = document.getElementById('doctor_id');
            document.getElementById('sum-dokter').textContent = doctorSelect.selectedOptions[0]?.textContent.trim() || '—';
            document.getElementById('sum-pesan').textContent = document.getElementById('pesan').value || '—';
        }
    </script>
@endpush
