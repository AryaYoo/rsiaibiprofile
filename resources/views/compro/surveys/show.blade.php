@extends('layouts.company')

@section('title', 'Isi Kuesioner: ' . $survey->title . ' | RSIA IBI Surabaya')

@section('content')

    {{-- ============================================
    PAGE HEADER & BREADCRUMB
    ============================================ --}}
    <div class="survey-breadcrumb-bar py-3" style="background: var(--white); border-bottom: 1px solid var(--border-soft);">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ route('compro.surveys') }}" class="text-decoration-none fw-bold text-success small d-flex align-items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Daftar Kuesioner</span>
            </a>
            <div class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill font-semibold">
                <i class="fas fa-clipboard-check me-1"></i> {{ $survey->title }}
            </div>
        </div>
    </div>

    {{-- ============================================
    STEP WIZARD
    ============================================ --}}
    <section class="section-padding" style="background: var(--bg-main); min-height: 650px;" x-data="{
        currentStep: 1,
        nama: '{{ old('respondent_name', '') }}',
        email: '{{ old('respondent_email', '') }}',
        phone: '{{ old('respondent_phone', '') }}',
        age: '{{ old('respondent_age', '') }}',
        gender: '{{ old('respondent_gender', 'Perempuan') }}',
        captchaInput: '',
        captchaTarget: {{ $captchaNum1 + $captchaNum2 }},
        robotChecked: false,
        errorMsg: '',

        validateStep1() {
            this.errorMsg = '';
            if (!this.nama.trim()) {
                this.errorMsg = 'Nama Lengkap wajib diisi.';
                return false;
            }
            if (!this.email.trim() || !this.email.includes('@')) {
                this.errorMsg = 'Email yang valid wajib diisi.';
                return false;
            }
            if (!this.phone.trim()) {
                this.errorMsg = 'Nomor Telepon / WhatsApp wajib diisi.';
                return false;
            }
            this.currentStep = 2;
            window.scrollTo({ top: 120, behavior: 'smooth' });
        },

        validateStep2() {
            this.errorMsg = '';
            // Check if required answers are filled
            const form = document.getElementById('surveyForm');
            const step2Inputs = form.querySelectorAll('#step-2 input[required], #step-2 textarea[required]');
            let allFilled = true;

            for (let input of step2Inputs) {
                if (input.type === 'radio') {
                    const name = input.name;
                    const checked = form.querySelector(`input[name='${name}']:checked`);
                    if (!checked) {
                        allFilled = false;
                        break;
                    }
                } else if (!input.value.trim()) {
                    allFilled = false;
                    break;
                }
            }

            if (!allFilled) {
                this.errorMsg = 'Mohon lengkapi semua pertanyaan kuesioner sebelum melanjutkan.';
                return false;
            }

            this.currentStep = 3;
            window.scrollTo({ top: 120, behavior: 'smooth' });
        }
    }">
        <div class="container" style="max-width: 820px;">

            {{-- Step Indicator --}}
            <div class="survey-stepper mb-5">
                <div class="survey-stepper-item" :class="{ 'active': currentStep === 1, 'completed': currentStep > 1 }">
                    <div class="survey-stepper-circle">
                        <span x-show="currentStep <= 1">1</span>
                        <i class="fas fa-check" x-show="currentStep > 1"></i>
                    </div>
                    <span class="survey-stepper-label">Data Diri</span>
                </div>
                <div class="survey-stepper-line" :class="{ 'active': currentStep > 1 }"></div>
                <div class="survey-stepper-item" :class="{ 'active': currentStep === 2, 'completed': currentStep > 2, 'locked': currentStep < 2 }">
                    <div class="survey-stepper-circle">
                        <span x-show="currentStep <= 2">2</span>
                        <i class="fas fa-check" x-show="currentStep > 2"></i>
                    </div>
                    <span class="survey-stepper-label">Isi Kuesioner</span>
                </div>
                <div class="survey-stepper-line" :class="{ 'active': currentStep > 2 }"></div>
                <div class="survey-stepper-item" :class="{ 'active': currentStep === 3, 'locked': currentStep < 3 }">
                    <div class="survey-stepper-circle">
                        <span>3</span>
                    </div>
                    <span class="survey-stepper-label">Konfirmasi</span>
                </div>
            </div>

            <!-- Error Banner -->
            <div x-show="errorMsg" x-cloak class="alert alert-danger rounded-4 p-3 mb-4 d-flex align-items-center gap-3">
                <i class="fas fa-exclamation-circle text-danger fs-5"></i>
                <span x-text="errorMsg" class="small fw-bold"></span>
            </div>

            @if($errors->any())
                <div class="alert alert-danger rounded-4 p-4 mb-4">
                    <h6 class="fw-bold mb-2"><i class="fas fa-exclamation-triangle me-2"></i>Terdapat kesalahan:</h6>
                    <ul class="mb-0 small ps-3">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form Card --}}
            <div class="card border-0 shadow-sm overflow-hidden" style="background: var(--white); border-radius: var(--radius); border: 1px solid var(--border-soft);">
                <form action="{{ route('compro.surveys.submit', $survey) }}" method="POST" id="surveyForm">
                    @csrf

                    {{-- ======= STEP 1: Data Diri ======= --}}
                    <div x-show="currentStep === 1" x-transition>
                        <div class="p-4 p-md-5 border-bottom bg-light bg-opacity-40">
                            <h2 class="h4 fw-bold mb-2" style="color: var(--primary);">Data Diri</h2>
                            <p class="text-muted small mb-0">Isi informasi kontak Anda agar kami dapat memproses masukan dengan baik.</p>
                        </div>

                        <div class="p-4 p-md-5 d-flex flex-column gap-4">
                            <!-- Nama Lengkap -->
                            <div>
                                <label class="form-label text-uppercase fw-bold small text-secondary">Nama Lengkap <span class="text-danger">*</span></label>
                                <div class="input-group-custom">
                                    <i class="fas fa-user input-icon"></i>
                                    <input type="text" name="respondent_name" x-model="nama" placeholder="Nama lengkap responden" required class="form-input-custom">
                                </div>
                            </div>

                            <div class="row g-3">
                                <!-- Email -->
                                <div class="col-md-6">
                                    <label class="form-label text-uppercase fw-bold small text-secondary">Email <span class="text-danger">*</span></label>
                                    <div class="input-group-custom">
                                        <i class="fas fa-envelope input-icon"></i>
                                        <input type="email" name="respondent_email" x-model="email" placeholder="email@contoh.com" required class="form-input-custom">
                                    </div>
                                </div>

                                <!-- Telepon / WhatsApp -->
                                <div class="col-md-6">
                                    <label class="form-label text-uppercase fw-bold small text-secondary">Nomor Telepon / WhatsApp <span class="text-danger">*</span></label>
                                    <div class="input-group-custom">
                                        <i class="fas fa-phone input-icon"></i>
                                        <input type="tel" name="respondent_phone" x-model="phone" placeholder="08xxxxxxxxxx" required class="form-input-custom">
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3">
                                <!-- Usia -->
                                <div class="col-md-6">
                                    <label class="form-label text-uppercase fw-bold small text-secondary">Usia (Tahun)</label>
                                    <div class="input-group-custom">
                                        <i class="fas fa-birthday-cake input-icon"></i>
                                        <input type="number" name="respondent_age" x-model="age" placeholder="Contoh: 28" min="1" max="120" class="form-input-custom">
                                    </div>
                                </div>

                                <!-- Jenis Kelamin -->
                                <div class="col-md-6">
                                    <label class="form-label text-uppercase fw-bold small text-secondary">Jenis Kelamin</label>
                                    <div class="input-group-custom">
                                        <i class="fas fa-venus-mars input-icon"></i>
                                        <select name="respondent_gender" x-model="gender" class="form-input-custom">
                                            <option value="Perempuan">Perempuan</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 p-md-4 border-top bg-light bg-opacity-30 d-flex justify-content-end">
                            <button type="button" @click="validateStep1()" class="btn py-2.5 px-4 fw-bold text-white rounded-3 d-inline-flex align-items-center gap-2" style="background: var(--primary);">
                                <span>Lanjut: Isi Kuesioner</span>
                                <i class="fas fa-arrow-right text-xs"></i>
                            </button>
                        </div>
                    </div>

                    {{-- ======= STEP 2: Isi Pertanyaan Kuesioner ======= --}}
                    <div x-show="currentStep === 2" x-transition id="step-2">
                        <div class="p-4 p-md-5 border-bottom bg-light bg-opacity-40">
                            <h2 class="h4 fw-bold mb-2" style="color: var(--primary);">Pertanyaan Kuesioner</h2>
                            <p class="text-muted small mb-0">Mohon berikan penilaian atau jawaban Anda secara jujur dan objektif.</p>
                        </div>

                        <div class="p-4 p-md-5 d-flex flex-column gap-5">
                            @foreach($survey->questions as $qIndex => $question)
                                <div class="question-box p-4 rounded-4" style="background: var(--bg-main); border: 1px solid var(--border-soft);">
                                    <div class="d-flex align-items-start gap-3 mb-3">
                                        <span class="badge rounded-circle p-2 d-flex align-items-center justify-content-center text-white flex-shrink-0" style="width: 32px; height: 32px; background: var(--primary-light);">
                                            {{ $qIndex + 1 }}
                                        </span>
                                        <h4 class="h6 fw-bold mb-0 text-dark pt-1" style="line-height: 1.5;">{{ $question->question_text }}</h4>
                                    </div>

                                    <div class="mt-3 ps-sm-5">
                                        @if($question->question_type === 'rating')
                                            <div class="rating-bar-wrapper">
                                                <div class="d-flex justify-content-between align-items-center gap-2 max-w-sm mx-auto">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <label class="rating-choice text-center flex-grow-1">
                                                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $i }}" required class="d-none rating-input">
                                                            <div class="rating-btn">
                                                                <span class="rating-val">{{ $i }}</span>
                                                            </div>
                                                            <span class="rating-sub">
                                                                @if($i == 1) Buruk
                                                                @elseif($i == 3) Cukup
                                                                @elseif($i == 5) Sangat Baik
                                                                @endif
                                                            </span>
                                                        </label>
                                                    @endfor
                                                </div>
                                            </div>

                                        @elseif($question->question_type === 'multiple_choice')
                                            <div class="d-flex flex-column gap-2">
                                                @foreach($question->options_array as $opt)
                                                    <label class="option-pill p-3 rounded-3 d-flex align-items-center gap-3 cursor-pointer">
                                                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $opt }}" required class="form-check-input mt-0">
                                                        <span class="text-secondary fw-semibold small">{{ $opt }}</span>
                                                    </label>
                                                @endforeach
                                            </div>

                                        @else
                                            <textarea name="answers[{{ $question->id }}]" rows="3" required placeholder="Tuliskan tanggapan atau masukan Anda..." class="form-control rounded-3 p-3 border-secondary-subtle small"></textarea>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="p-4 p-md-4 border-top bg-light bg-opacity-30 d-flex justify-content-between">
                            <button type="button" @click="currentStep = 1" class="btn btn-light border py-2.5 px-4 fw-bold text-secondary rounded-3">
                                <i class="fas fa-arrow-left me-2"></i> Kembali
                            </button>
                            <button type="button" @click="validateStep2()" class="btn py-2.5 px-4 fw-bold text-white rounded-3 d-inline-flex align-items-center gap-2" style="background: var(--primary);">
                                <span>Lanjut: Konfirmasi</span>
                                <i class="fas fa-arrow-right text-xs"></i>
                            </button>
                        </div>
                    </div>

                    {{-- ======= STEP 3: Konfirmasi & Anti-Robot ======= --}}
                    <div x-show="currentStep === 3" x-transition>
                        <div class="p-4 p-md-5 border-bottom bg-light bg-opacity-40">
                            <h2 class="h4 fw-bold mb-2" style="color: var(--primary);">Konfirmasi & Keamanan</h2>
                            <p class="text-muted small mb-0">Pastikan data Anda sudah benar sebelum mengirimkan formulir survey.</p>
                        </div>

                        <div class="p-4 p-md-5 d-flex flex-column gap-4">
                            <!-- Ringkasan Data -->
                            <div class="p-4 rounded-4 border bg-white">
                                <h5 class="fw-bold h6 mb-3 text-success"><i class="fas fa-id-card me-2"></i>Ringkasan Data Diri</h5>
                                <div class="row g-2 small">
                                    <div class="col-sm-4 text-muted">Nama:</div>
                                    <div class="col-sm-8 fw-bold" x-text="nama"></div>

                                    <div class="col-sm-4 text-muted">Email:</div>
                                    <div class="col-sm-8 fw-bold" x-text="email"></div>

                                    <div class="col-sm-4 text-muted">WhatsApp:</div>
                                    <div class="col-sm-8 fw-bold" x-text="phone"></div>

                                    <div class="col-sm-4 text-muted">Usia / Gender:</div>
                                    <div class="col-sm-8 fw-bold"><span x-text="age ? age + ' Thn' : '-'"></span> / <span x-text="gender"></span></div>
                                </div>
                            </div>

                            <!-- Custom Anti-Robot Box (No Cloudflare) -->
                            <div class="p-4 rounded-4 border" style="background: #f8faf7; border-color: #d1e7dd !important;">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="p-2 rounded-3 bg-white border text-success shadow-xs">
                                        <i class="fas fa-shield-alt fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold h6 mb-0 text-dark">Verifikasi Keamanan (Anti-Robot)</h5>
                                        <p class="text-muted small mb-0">Jawab pertanyaan sederhana berikut untuk membuktikan Anda bukan program otomatis.</p>
                                    </div>
                                </div>

                                <div class="bg-white p-4 rounded-3 border d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <label class="form-check-label d-flex align-items-center gap-2 cursor-pointer">
                                            <input type="checkbox" x-model="robotChecked" required class="form-check-input p-2" style="width: 24px; height: 24px;">
                                            <span class="fw-bold small text-secondary">Saya bukan robot</span>
                                        </label>
                                    </div>
                                    
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-light text-dark border p-2 fw-bold" style="font-size: 0.95rem;">
                                            Berapa {{ $captchaNum1 }} + {{ $captchaNum2 }} =
                                        </span>
                                        <input type="number" name="captcha_answer" x-model="captchaInput" placeholder="Hasil" required class="form-control text-center fw-bold rounded-3" style="width: 90px; border-color: var(--primary-light);">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 p-md-4 border-top bg-light bg-opacity-30 d-flex justify-content-between">
                            <button type="button" @click="currentStep = 2" class="btn btn-light border py-2.5 px-4 fw-bold text-secondary rounded-3">
                                <i class="fas fa-arrow-left me-2"></i> Kembali
                            </button>
                            <button type="submit" :disabled="!robotChecked || !captchaInput" class="btn py-2.5 px-5 fw-bold text-white rounded-3 shadow-sm d-inline-flex align-items-center gap-2" style="background: var(--primary);" :style="(!robotChecked || !captchaInput) ? 'opacity: 0.6; cursor: not-allowed;' : ''">
                                <span>Kirim Tanggapan Survey</span>
                                <i class="fas fa-paper-plane text-xs"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- Styling matching pendaftaran-online design --}}
    <style>
        /* Stepper */
        .survey-stepper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            max-width: 520px;
            margin: 0 auto;
        }
        .survey-stepper-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }
        .survey-stepper-circle {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1rem;
            background: #e9ecef;
            color: #6c757d;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }
        .survey-stepper-item.active .survey-stepper-circle {
            background: var(--primary);
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(18, 53, 36, 0.25);
        }
        .survey-stepper-item.completed .survey-stepper-circle {
            background: var(--primary-light);
            color: #ffffff;
        }
        .survey-stepper-label {
            font-size: 0.82rem;
            font-weight: 700;
            color: #6c757d;
        }
        .survey-stepper-item.active .survey-stepper-label {
            color: var(--primary);
        }
        .survey-stepper-line {
            flex-grow: 1;
            height: 3px;
            background: #e9ecef;
            margin-bottom: 24px;
            transition: all 0.3s ease;
        }
        .survey-stepper-line.active {
            background: var(--primary-light);
        }

        /* Form Inputs */
        .input-group-custom {
            position: relative;
            display: flex;
            align-items: center;
        }
        .input-icon {
            position: absolute;
            left: 18px;
            color: #94a3b8;
            font-size: 0.95rem;
            pointer-events: none;
        }
        .form-input-custom {
            width: 100%;
            padding: 13px 18px 13px 48px;
            background: #f8faf7;
            border: 1.5px solid var(--border-soft);
            border-radius: 12px;
            font-size: 0.95rem;
            color: var(--text-main);
            outline: none;
            transition: all 0.25s ease;
        }
        .form-input-custom:focus {
            background: #ffffff;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 4px rgba(62, 123, 39, 0.12);
        }

        /* Rating UI */
        .rating-choice {
            cursor: pointer;
        }
        .rating-btn {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            border: 2px solid var(--border-soft);
            background: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            box-shadow: var(--shadow-sm);
        }
        .rating-val {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--text-muted);
        }
        .rating-sub {
            display: block;
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--text-muted);
            margin-top: 6px;
        }
        .rating-choice:hover .rating-btn {
            border-color: var(--primary-light);
            background: var(--primary-soft);
        }
        .rating-input:checked + .rating-btn {
            background: var(--primary);
            border-color: var(--primary);
        }
        .rating-input:checked + .rating-btn .rating-val {
            color: #ffffff;
        }

        /* Multiple Choice */
        .option-pill {
            background: #ffffff;
            border: 1.5px solid var(--border-soft);
            transition: all 0.2s ease;
        }
        .option-pill:hover {
            border-color: var(--primary-light);
            background: var(--primary-soft);
        }
        .option-pill:has(input:checked) {
            border-color: var(--primary-light);
            background: var(--primary-soft);
        }
        .cursor-pointer {
            cursor: pointer;
        }
    </style>
@endsection
