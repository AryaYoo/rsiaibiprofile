@extends('layouts.company')

@section('title', 'Isi Kuesioner: ' . $survey->title . ' | RSIA IBI Surabaya')

@section('meta')
    <meta name="description" content="Isi kuesioner {{ $survey->title }} dan berikan masukan Anda untuk RSIA IBI Surabaya.">
@endsection

@section('styles')
<style>
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
        gap: 12px;
    }

    .pend-back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--primary);
        transition: var(--transition);
    }

    .pend-back-link:hover {
        color: var(--primary-light);
    }

    .pend-breadcrumb-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 14px;
        border-radius: 999px;
        background: var(--primary-soft);
        color: var(--primary);
        font-size: 0.8rem;
        font-weight: 700;
        border: 1px solid rgba(18, 53, 36, 0.12);
    }

    /* ============================================
       WIZARD SECTION
    ============================================ */
    .pend-wizard-section {
        background: var(--bg-main);
        padding: 56px 0 80px;
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

    .pend-stepper-item.active .pend-stepper-label { color: var(--primary); }
    .pend-stepper-item.done .pend-stepper-label { color: var(--primary-light); }
    .pend-stepper-item.locked .pend-stepper-label { color: var(--border-soft); }

    .pend-stepper-line {
        width: 120px;
        height: 3px;
        background: var(--border-soft);
        border-radius: 3px;
        margin-bottom: 28px;
        transition: background 0.4s ease;
        flex-shrink: 0;
    }

    .pend-stepper-line.done { background: var(--primary-light); }

    /* ============================================
       FORM WRAP
    ============================================ */
    .pend-form-wrap {
        max-width: 720px;
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

    .pend-step--locked { opacity: 0.6; }

    .pend-step-header {
        padding: 32px 40px 28px;
        border-bottom: 1px solid var(--border-soft);
        background: linear-gradient(135deg, var(--primary-soft) 0%, var(--white) 100%);
    }

    .pend-step-header h2 {
        font-size: 1.5rem;
        color: var(--primary);
        margin-bottom: 6px;
        font-weight: 800;
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

    .req { color: #ef4444; }

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

    .pend-input-icon {
        position: absolute;
        left: 16px;
        color: var(--text-muted);
        font-size: 0.9rem;
        pointer-events: none;
        z-index: 1;
        transition: color 0.2s;
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

    .pend-input-wrap:focus-within .pend-input-icon { color: var(--primary); }

    .pend-input.is-error {
        border-color: #ef4444;
        background: #fff5f5;
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

    .pend-btn-submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    /* ============================================
       QUESTION BOXES (Step 2)
    ============================================ */
    .survey-question-box {
        background: var(--bg-main);
        border: 1px solid var(--border-soft);
        border-radius: 14px;
        padding: 24px;
        transition: border-color 0.2s;
    }

    .survey-question-box:focus-within {
        border-color: var(--primary-light);
        background: var(--white);
    }

    .survey-q-num {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--primary-light);
        color: white;
        font-weight: 800;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .survey-q-text {
        font-size: 0.97rem;
        font-weight: 700;
        color: var(--text-main);
        line-height: 1.55;
    }

    /* Rating buttons */
    .rating-group {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .rating-label {
        cursor: pointer;
        text-align: center;
    }

    .rating-label input[type="radio"] {
        display: none;
    }

    .rating-btn {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        border: 2px solid var(--border-soft);
        background: var(--white);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--text-muted);
        transition: all 0.2s ease;
        box-shadow: 0 1px 4px rgba(0,0,0,0.05);
    }

    .rating-label:hover .rating-btn {
        border-color: var(--primary-light);
        background: var(--primary-soft);
        color: var(--primary);
    }

    .rating-label input:checked + .rating-btn {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
        box-shadow: 0 4px 12px rgba(18, 53, 36, 0.25);
    }

    .rating-sublabel {
        display: block;
        font-size: 0.68rem;
        font-weight: 700;
        color: var(--text-muted);
        margin-top: 6px;
    }

    /* Multiple choice */
    .option-pill {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 18px;
        border: 1.5px solid var(--border-soft);
        border-radius: 12px;
        background: var(--white);
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-main);
    }

    .option-pill:hover {
        border-color: var(--primary-light);
        background: var(--primary-soft);
    }

    .option-pill input[type="radio"] {
        accent-color: var(--primary);
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }

    .option-pill:has(input:checked) {
        border-color: var(--primary-light);
        background: var(--primary-soft);
        color: var(--primary);
    }

    /* Textarea */
    .survey-textarea {
        width: 100%;
        padding: 14px 16px;
        border-radius: 12px;
        border: 1.5px solid var(--border-soft);
        background: var(--white);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.92rem;
        color: var(--text-main);
        resize: vertical;
        min-height: 100px;
        outline: none;
        transition: all 0.2s;
    }

    .survey-textarea:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(18, 53, 36, 0.06);
    }

    /* ============================================
       CONFIRMATION STEP 3
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

    .pend-summary-grid > div {
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

    /* Anti-robot box */
    .anti-robot-box {
        border: 1.5px solid #d1e7dd;
        border-radius: 14px;
        padding: 24px;
        background: #f8faf7;
    }

    .anti-robot-inner {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        background: var(--white);
        border: 1px solid var(--border-soft);
        border-radius: 10px;
        padding: 16px 20px;
        margin-top: 16px;
    }

    .robot-check-label {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        font-weight: 700;
        font-size: 0.9rem;
        color: var(--text-main);
        user-select: none;
    }

    .robot-check-label input[type="checkbox"] {
        width: 22px;
        height: 22px;
        accent-color: var(--primary);
        flex-shrink: 0;
    }

    .captcha-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .captcha-badge {
        background: var(--primary-soft);
        border: 1px solid rgba(18, 53, 36, 0.15);
        color: var(--primary);
        font-weight: 800;
        font-size: 1rem;
        padding: 8px 16px;
        border-radius: 8px;
        white-space: nowrap;
    }

    .captcha-input {
        width: 80px;
        padding: 10px 12px;
        border-radius: 10px;
        border: 1.5px solid var(--border-soft);
        background: var(--bg-main);
        font-weight: 800;
        font-size: 1rem;
        text-align: center;
        outline: none;
        font-family: 'Plus Jakarta Sans', sans-serif;
        transition: all 0.2s;
    }

    .captcha-input:focus {
        border-color: var(--primary);
        background: var(--white);
        box-shadow: 0 0 0 4px rgba(18, 53, 36, 0.06);
    }

    /* Alert */
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

    .pend-alert i { font-size: 1.2rem; margin-top: 1px; flex-shrink: 0; }
    .pend-alert div { display: flex; flex-direction: column; gap: 2px; }
    .pend-alert strong { font-weight: 800; display: block; }

    .pend-alert--error {
        background: #fff5f5;
        border: 1px solid #ef4444;
        color: #7f1d1d;
    }

    .pend-alert--error i { color: #ef4444; }

    /* ============================================
       RESPONSIVE
    ============================================ */
    @media (max-width: 768px) {
        .pend-wizard-section { padding: 36px 0 56px; }
        .pend-stepper { margin-bottom: 32px; }
        .pend-stepper-line { width: 56px; }
        .pend-step-header { padding: 20px 18px 18px; }
        .pend-step-header h2 { font-size: 1.2rem; }
        .pend-step-header p { font-size: 0.84rem; }
        .pend-fields { padding: 18px 16px; gap: 16px; }
        .pend-step-nav { padding: 14px 16px 20px; flex-wrap: wrap; gap: 10px; }
        .pend-field-row { grid-template-columns: 1fr; gap: 16px; }
        .pend-field label { font-size: 0.78rem; }
        .pend-input { font-size: 0.88rem; padding: 12px 14px 12px 40px; }
        .pend-btn-next, .pend-btn-submit { width: 100%; justify-content: center; padding: 13px 20px; font-size: 0.88rem; margin-left: 0; }
        .pend-btn-back { padding: 11px 18px; font-size: 0.85rem; }
        .pend-summary-grid { grid-template-columns: 1fr; gap: 10px; }
        .pend-summary { padding: 18px; }
        .anti-robot-inner { flex-direction: column; align-items: flex-start; gap: 12px; }
        .captcha-badge { font-size: 0.88rem; }
        .captcha-input { width: 70px; }
        .rating-group { gap: 8px; }
        .rating-btn { width: 44px; height: 44px; font-size: 1rem; border-radius: 10px; }
        .rating-sublabel { font-size: 0.62rem; }
        .survey-question-box { padding: 16px; }
        .survey-q-text { font-size: 0.88rem; }
        .option-pill { padding: 10px 14px; font-size: 0.84rem; }
        .survey-textarea { font-size: 0.88rem; }
        .pend-breadcrumb-bar .container { gap: 8px; }
        .pend-back-link span { display: none; }
        .pend-breadcrumb-badge { font-size: 0.72rem; padding: 5px 10px; }
    }

    @media (max-width: 480px) {
        .pend-stepper-line { width: 28px; }
        .pend-stepper-circle { width: 38px; height: 38px; font-size: 0.85rem; }
        .pend-stepper-label { font-size: 0.68rem; }
        .pend-step-header h2 { font-size: 1.05rem; }
        .pend-fields { padding: 14px 12px; }
        .pend-step-nav { padding: 12px 12px 16px; }
        .rating-btn { width: 38px; height: 38px; font-size: 0.9rem; border-radius: 8px; }
        .captcha-input { width: 64px; font-size: 0.9rem; }
    }
</style>
@endsection

@section('content')

    {{-- PAGE HEADER --}}
    <section class="page-header" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); padding: 72px 0 24px; min-height: unset;"></section>

    {{-- BREADCRUMB --}}
    <div class="pend-breadcrumb-bar">
        <div class="container">
            <a href="{{ route('compro.surveys') }}" class="pend-back-link">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Daftar Kuesioner</span>
            </a>
            <div class="pend-breadcrumb-badge">
                <i class="fas fa-clipboard-check"></i>
                {{ $survey->title }}
            </div>
        </div>
    </div>

    {{-- WIZARD SECTION --}}
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
                    <span class="pend-stepper-label">Isi Kuesioner</span>
                </div>
                <div class="pend-stepper-line" id="line-2"></div>
                <div class="pend-stepper-item locked" id="step-ind-3">
                    <div class="pend-stepper-circle">
                        <span class="step-num">3</span>
                        <i class="fas fa-check step-check" style="display:none;"></i>
                    </div>
                    <span class="pend-stepper-label">Konfirmasi</span>
                </div>
            </div>

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="pend-alert pend-alert--error" style="max-width: 720px; margin: 0 auto 24px;">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        <strong>Terdapat kesalahan pada formulir:</strong>
                        @foreach($errors->all() as $err)
                            <span>• {{ $err }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Form Wrap --}}
            <div class="pend-form-wrap">
                <form action="{{ route('compro.surveys.submit', $survey) }}" method="POST" id="surveyForm" novalidate>
                    @csrf

                    <div class="pend-steps-slider">

                        {{-- ======= STEP 1: Data Diri ======= --}}
                        <div class="pend-step active" id="step-1">
                            <div class="pend-step-header">
                                <h2>Data Diri</h2>
                                <p>Isi informasi kontak Anda agar kami dapat memproses masukan dengan baik.</p>
                            </div>

                            <div class="pend-fields">
                                <div class="pend-field" data-required>
                                    <label for="respondent_name">Nama Lengkap <span class="req">*</span></label>
                                    <div class="pend-input-wrap">
                                        <i class="fas fa-user pend-input-icon"></i>
                                        <input type="text" id="respondent_name" name="respondent_name"
                                            placeholder="Nama lengkap responden"
                                            value="{{ old('respondent_name') }}"
                                            class="pend-input" required autocomplete="name">
                                    </div>
                                    <span class="pend-field-error" id="err-nama"></span>
                                </div>

                                <div class="pend-field-row">
                                    <div class="pend-field" data-required>
                                        <label for="respondent_email">Email <span class="req">*</span></label>
                                        <div class="pend-input-wrap">
                                            <i class="fas fa-envelope pend-input-icon"></i>
                                            <input type="email" id="respondent_email" name="respondent_email"
                                                placeholder="email@contoh.com"
                                                value="{{ old('respondent_email') }}"
                                                class="pend-input" required autocomplete="email">
                                        </div>
                                        <span class="pend-field-error" id="err-email"></span>
                                    </div>
                                    <div class="pend-field" data-required>
                                        <label for="respondent_phone">Nomor WhatsApp <span class="req">*</span></label>
                                        <div class="pend-input-wrap">
                                            <i class="fas fa-phone pend-input-icon"></i>
                                            <input type="tel" id="respondent_phone" name="respondent_phone"
                                                placeholder="08xxxxxxxxxx"
                                                value="{{ old('respondent_phone') }}"
                                                class="pend-input" required>
                                        </div>
                                        <span class="pend-field-error" id="err-phone"></span>
                                    </div>
                                </div>

                                <div class="pend-field-row">
                                    <div class="pend-field">
                                        <label for="respondent_age">Usia (Tahun)</label>
                                        <div class="pend-input-wrap">
                                            <i class="fas fa-birthday-cake pend-input-icon"></i>
                                            <input type="number" id="respondent_age" name="respondent_age"
                                                placeholder="Contoh: 28"
                                                value="{{ old('respondent_age') }}"
                                                min="1" max="120" class="pend-input">
                                        </div>
                                    </div>
                                    <div class="pend-field">
                                        <label for="respondent_gender">Jenis Kelamin</label>
                                        <div class="pend-input-wrap">
                                            <i class="fas fa-venus-mars pend-input-icon"></i>
                                            <select id="respondent_gender" name="respondent_gender" class="pend-input">
                                                <option value="Perempuan" {{ old('respondent_gender', 'Perempuan') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                <option value="Laki-laki" {{ old('respondent_gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pend-step-nav">
                                <div></div>
                                <button type="button" class="pend-btn-next" onclick="nextStep(1)">
                                    Lanjut: Isi Kuesioner <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>

                        {{-- ======= STEP 2: Pertanyaan Kuesioner ======= --}}
                        <div class="pend-step pend-step--locked" id="step-2">
                            <div class="pend-step-header">
                                <h2>Pertanyaan Kuesioner</h2>
                                <p>Mohon berikan penilaian atau jawaban Anda secara jujur dan objektif.</p>
                            </div>

                            <div class="pend-locked-overlay" id="overlay-2">
                                <div class="pend-locked-msg">
                                    <i class="fas fa-lock"></i>
                                    <p>Selesaikan <strong>Data Diri</strong> terlebih dahulu</p>
                                </div>
                            </div>

                            <div class="pend-fields">
                                @forelse($survey->questions as $qIndex => $question)
                                    <div class="survey-question-box">
                                        <div style="display:flex; align-items:flex-start; gap:12px; margin-bottom:16px;">
                                            <span class="survey-q-num">{{ $qIndex + 1 }}</span>
                                            <p class="survey-q-text mb-0">{{ $question->question_text }}</p>
                                        </div>

                                        @if($question->question_type === 'rating')
                                            <div class="rating-group">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <label class="rating-label">
                                                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $i }}" required>
                                                        <div class="rating-btn">{{ $i }}</div>
                                                        <span class="rating-sublabel">
                                                            @if($i == 1) Buruk
                                                            @elseif($i == 3) Cukup
                                                            @elseif($i == 5) Sangat Baik
                                                            @endif
                                                        </span>
                                                    </label>
                                                @endfor
                                            </div>

                                        @elseif($question->question_type === 'multiple_choice')
                                            <div style="display:flex; flex-direction:column; gap:10px;">
                                                @foreach($question->options_array as $opt)
                                                    <label class="option-pill">
                                                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $opt }}" required>
                                                        <span>{{ $opt }}</span>
                                                    </label>
                                                @endforeach
                                            </div>

                                        @else
                                            <textarea name="answers[{{ $question->id }}]" rows="3" required
                                                placeholder="Tuliskan tanggapan atau masukan Anda..."
                                                class="survey-textarea"></textarea>
                                        @endif
                                    </div>
                                @empty
                                    <div style="text-align:center; padding: 32px; color: var(--text-muted);">
                                        <i class="fas fa-info-circle fs-3 mb-2 d-block"></i>
                                        <p>Belum ada pertanyaan untuk kuesioner ini.</p>
                                    </div>
                                @endforelse
                            </div>

                            <div class="pend-step-nav">
                                <button type="button" class="pend-btn-back" onclick="prevStep(2)">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </button>
                                <button type="button" class="pend-btn-next" onclick="nextStep(2)">
                                    Lanjut: Konfirmasi <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>

                        {{-- ======= STEP 3: Konfirmasi & Anti-Robot ======= --}}
                        <div class="pend-step pend-step--locked" id="step-3">
                            <div class="pend-step-header">
                                <h2>Konfirmasi & Keamanan</h2>
                                <p>Pastikan data Anda sudah benar, lalu selesaikan verifikasi keamanan.</p>
                            </div>

                            <div class="pend-locked-overlay" id="overlay-3">
                                <div class="pend-locked-msg">
                                    <i class="fas fa-lock"></i>
                                    <p>Selesaikan <strong>Isi Kuesioner</strong> terlebih dahulu</p>
                                </div>
                            </div>

                            <div class="pend-fields">
                                {{-- Summary --}}
                                <div class="pend-summary">
                                    <div class="pend-summary-title">
                                        <i class="fas fa-id-card"></i> Ringkasan Data Diri
                                    </div>
                                    <div class="pend-summary-grid">
                                        <div>
                                            <span>Nama Lengkap</span>
                                            <strong id="sum-nama">-</strong>
                                        </div>
                                        <div>
                                            <span>Email</span>
                                            <strong id="sum-email">-</strong>
                                        </div>
                                        <div>
                                            <span>Nomor WhatsApp</span>
                                            <strong id="sum-phone">-</strong>
                                        </div>
                                        <div>
                                            <span>Usia / Jenis Kelamin</span>
                                            <strong id="sum-gender">-</strong>
                                        </div>
                                    </div>
                                </div>

                                {{-- Anti-Robot --}}
                                <div class="anti-robot-box">
                                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:4px;">
                                        <div style="width:40px; height:40px; border-radius:10px; background:var(--white); border:1px solid var(--border-soft); display:flex; align-items:center; justify-content:center; color: var(--primary-light);">
                                            <i class="fas fa-shield-alt" style="font-size:1.1rem;"></i>
                                        </div>
                                        <div>
                                            <p style="font-weight:800; font-size:0.92rem; margin:0; color:var(--text-main);">Verifikasi Keamanan (Anti-Robot)</p>
                                            <p style="font-size:0.8rem; color:var(--text-muted); margin:0;">Jawab pertanyaan sederhana untuk membuktikan Anda bukan program otomatis.</p>
                                        </div>
                                    </div>

                                    <div class="anti-robot-inner">
                                        <label class="robot-check-label">
                                            <input type="checkbox" id="robotCheck" name="robot_confirm" value="1">
                                            <span>Saya bukan robot</span>
                                        </label>

                                        <div class="captcha-group">
                                            <span class="captcha-badge">
                                                Berapa {{ $captchaNum1 }} + {{ $captchaNum2 }} =
                                            </span>
                                            <input type="number" name="captcha_answer" id="captchaInput"
                                                placeholder="?" required
                                                class="captcha-input">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pend-step-nav">
                                <button type="button" class="pend-btn-back" onclick="prevStep(3)">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </button>
                                <button type="submit" class="pend-btn-submit" id="submitBtn" disabled>
                                    <i class="fas fa-paper-plane"></i>
                                    <span>Kirim Tanggapan Survey</span>
                                </button>
                            </div>
                        </div>

                    </div>{{-- end pend-steps-slider --}}
                </form>
            </div>{{-- end pend-form-wrap --}}
        </div>
    </section>

    {{-- CTA SECTION --}}
    <section id="cta" class="cta-modern">
        <div class="container">
            <h2>Ada Keluhan atau Pertanyaan?</h2>
            <p>Tim RSIA IBI Surabaya siap membantu Anda. Hubungi kami untuk konsultasi lebih lanjut mengenai layanan kesehatan kami.</p>
            <a href="{{ url('/company-profile/kontak') }}" class="btn btn-light">Hubungi Kami →</a>
        </div>
    </section>

@endsection


@push('scripts')
<script>
    let currentStep = 1;
    const TOTAL_STEPS = 3;

    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(adjustFormHeight, 100);
        window.addEventListener('resize', adjustFormHeight);

        // Enable submit only when robot check and captcha are filled
        const robotCheck = document.getElementById('robotCheck');
        const captchaInput = document.getElementById('captchaInput');
        const submitBtn = document.getElementById('submitBtn');

        function updateSubmitState() {
            submitBtn.disabled = !(robotCheck.checked && captchaInput.value.trim() !== '');
        }

        robotCheck.addEventListener('change', updateSubmitState);
        captchaInput.addEventListener('input', updateSubmitState);

        @if($errors->any())
            unlockStep(2); unlockStep(3); goToStep(3);
        @endif
    });

    function adjustFormHeight() {
        const activeStepEl = document.querySelector('.pend-step.active');
        const formWrap = document.querySelector('.pend-form-wrap');
        if (activeStepEl && formWrap) {
            formWrap.style.height = activeStepEl.offsetHeight + 'px';
        }
    }

    function goToStep(step) {
        const slider = document.querySelector('.pend-steps-slider');
        const offset = (step - 1) * 100;
        slider.style.transform = 'translateX(-' + offset + '%)';

        // Update active step class
        document.querySelectorAll('.pend-step').forEach((el, idx) => {
            el.classList.remove('active');
            if (idx + 1 === step) el.classList.add('active');
        });

        currentStep = step;
        updateStepper();

        setTimeout(adjustFormHeight, 50);
        window.scrollTo({ top: 100, behavior: 'smooth' });
    }

    function unlockStep(step) {
        const stepEl = document.getElementById('step-' + step);
        const overlay = document.getElementById('overlay-' + step);
        if (stepEl) stepEl.classList.remove('pend-step--locked');
        if (overlay) overlay.style.display = 'none';
    }

    function lockStep(step) {
        const stepEl = document.getElementById('step-' + step);
        const overlay = document.getElementById('overlay-' + step);
        if (stepEl) stepEl.classList.add('pend-step--locked');
        if (overlay) overlay.style.display = '';
    }

    function updateStepper() {
        for (let i = 1; i <= TOTAL_STEPS; i++) {
            const item = document.getElementById('step-ind-' + i);
            if (!item) continue;
            const circle = item.querySelector('.pend-stepper-circle');
            const numEl = circle.querySelector('.step-num');
            const checkEl = circle.querySelector('.step-check');

            item.classList.remove('active', 'done', 'locked');

            if (i < currentStep) {
                item.classList.add('done');
                numEl.style.display = 'none';
                checkEl.style.display = '';
            } else if (i === currentStep) {
                item.classList.add('active');
                numEl.style.display = '';
                checkEl.style.display = 'none';
            } else {
                item.classList.add('locked');
                numEl.style.display = '';
                checkEl.style.display = 'none';
            }

            // Update lines
            if (i < TOTAL_STEPS) {
                const line = document.getElementById('line-' + i);
                if (line) {
                    if (i < currentStep) {
                        line.classList.add('done');
                    } else {
                        line.classList.remove('done');
                    }
                }
            }
        }
    }

    function validateStep1() {
        let isValid = true;
        clearErrors(1);

        const nama = document.getElementById('respondent_name');
        const email = document.getElementById('respondent_email');
        const phone = document.getElementById('respondent_phone');

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
        if (!phone.value.trim()) {
            showError('err-phone', 'Nomor WhatsApp wajib diisi.', phone);
            isValid = false;
        }

        return isValid;
    }

    function validateStep2() {
        const form = document.getElementById('surveyForm');
        // Check all radio groups in step 2
        const radioGroups = {};
        const step2 = document.getElementById('step-2');
        step2.querySelectorAll('input[type="radio"]').forEach(function(r) {
            radioGroups[r.name] = true;
        });

        let allAnswered = true;
        for (const name in radioGroups) {
            const checked = step2.querySelector('input[name="' + name + '"]:checked');
            if (!checked) {
                allAnswered = false;
                break;
            }
        }

        // Check textareas
        step2.querySelectorAll('textarea[required]').forEach(function(ta) {
            if (!ta.value.trim()) allAnswered = false;
        });

        if (!allAnswered) {
            alert('Mohon lengkapi semua pertanyaan kuesioner sebelum melanjutkan.');
            return false;
        }
        return true;
    }

    function nextStep(step) {
        if (step === 1) {
            if (!validateStep1()) return;
            // Fill summary
            document.getElementById('sum-nama').textContent = document.getElementById('respondent_name').value;
            document.getElementById('sum-email').textContent = document.getElementById('respondent_email').value;
            document.getElementById('sum-phone').textContent = document.getElementById('respondent_phone').value;
            const age = document.getElementById('respondent_age').value;
            const gender = document.getElementById('respondent_gender').value;
            document.getElementById('sum-gender').textContent = (age ? age + ' Thn' : '-') + ' / ' + gender;

            unlockStep(2);
            goToStep(2);
        } else if (step === 2) {
            if (!validateStep2()) return;
            unlockStep(3);
            goToStep(3);
        }
    }

    function prevStep(step) {
        if (step > 1) {
            goToStep(step - 1);
        }
    }

    function clearErrors(step) {
        const stepEl = document.getElementById('step-' + step);
        stepEl.querySelectorAll('.pend-field-error').forEach(el => el.textContent = '');
        stepEl.querySelectorAll('.pend-input').forEach(el => el.classList.remove('is-error'));
    }

    function showError(errId, message, inputEl) {
        const errEl = document.getElementById(errId);
        if (errEl) errEl.textContent = message;
        if (inputEl) inputEl.classList.add('is-error');
    }
</script>
@endpush
