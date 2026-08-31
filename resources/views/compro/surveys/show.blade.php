@extends('layouts.company')

@section('title', $survey->title . ' | RSIA IBI Surabaya')

@section('content')
    {{-- Page Header --}}
    <section id="header" data-nav-label="Isi Survey" class="page-header">
        <div class="container">
            <span class="badge-label">Isi Kuesioner</span>
            <h1>{{ $survey->title }}</h1>
            <p>{{ $survey->description ?? 'Bantu kami meningkatkan pelayanan dengan mengisi kuesioner singkat berikut.' }}</p>
        </div>
    </section>

    {{-- Questionnaire Form --}}
    <section class="section-padding" style="background: var(--bg-main);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form action="{{ route('compro.surveys.submit', $survey) }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <!-- Respondent Identity Card -->
                        <div class="card border-0 p-4 mb-4 shadow-sm" style="background: var(--white); border-radius: var(--radius); border: 1px solid var(--border-soft);">
                            <h3 class="fw-bold h5 mb-3" style="color: var(--primary);"><i class="bi bi-person-check me-2"></i>Identitas Responden (Opsional)</h3>
                            <p class="text-muted small mb-4">Anda dapat mengisi nama dan email Anda, atau mengosongkannya jika ingin mengirim tanggapan secara anonim.</p>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="respondent_name" class="form-label fw-semibold text-secondary small">Nama Lengkap</label>
                                    <input type="text" name="respondent_name" id="respondent_name" placeholder="Masukkan nama Anda (atau kosongkan)" class="form-control py-2.5 rounded-3 border-secondary-subtle">
                                </div>
                                <div class="col-md-6">
                                    <label for="respondent_email" class="form-label fw-semibold text-secondary small">Alamat Email</label>
                                    <input type="email" name="respondent_email" id="respondent_email" placeholder="contoh@email.com (atau kosongkan)" class="form-control py-2.5 rounded-3 border-secondary-subtle">
                                </div>
                            </div>
                        </div>

                        <!-- Questions Loop -->
                        <div class="space-y-4">
                            @foreach($survey->questions as $index => $question)
                                <div class="card border-0 p-4 mb-4 shadow-sm question-card" style="background: var(--white); border-radius: var(--radius); border: 1px solid var(--border-soft);">
                                    <div class="d-flex align-items-start gap-3">
                                        <span class="d-inline-flex align-items-center justify-content-center rounded-3 fw-bold text-white flex-shrink-0" style="width: 32px; height: 32px; background: var(--primary-light); font-size: 0.9rem;">
                                            {{ $index + 1 }}
                                        </span>
                                        <div class="flex-grow-1">
                                            <h4 class="fw-bold h6 mb-3 text-dark" style="line-height: 1.5;">{{ $question->question_text }}</h4>
                                            
                                            <!-- Render according to question type -->
                                            @if($question->question_type === 'text')
                                                <textarea name="answers[{{ $question->id }}]" rows="3" required placeholder="Tulis tanggapan atau saran Anda di sini..." class="form-control rounded-3 border-secondary-subtle"></textarea>
                                                <div class="invalid-feedback">Mohon isi jawaban Anda.</div>
                                            
                                            @elseif($question->question_type === 'rating')
                                                <div class="d-flex justify-content-between mx-auto rating-container" style="max-width: 360px;">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <label class="rating-item text-center">
                                                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $i }}" required class="rating-radio">
                                                            <span class="rating-circle">
                                                                <span class="rating-num">{{ $i }}</span>
                                                            </span>
                                                            <span class="rating-label-text">
                                                                @if($i == 1) Buruk
                                                                @elseif($i == 5) Sangat Baik
                                                                @endif
                                                            </span>
                                                        </label>
                                                    @endfor
                                                </div>
                                                <div class="invalid-feedback text-center mt-3">Mohon pilih salah satu nilai rating.</div>
                                            
                                            @elseif($question->question_type === 'multiple_choice')
                                                <div class="row g-3">
                                                    @foreach($question->options_array as $optIndex => $option)
                                                        <div class="col-12">
                                                            <label class="choice-container d-block p-3 border rounded-3 transition-colors cursor-pointer">
                                                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option }}" required class="choice-radio me-2">
                                                                <span class="choice-text text-secondary font-semibold">{{ $option }}</span>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="invalid-feedback mt-2">Mohon pilih salah satu opsi jawaban.</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <a href="{{ route('compro.surveys') }}" class="btn btn-light border py-2.5 px-4 rounded-3 fw-bold text-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary py-2.5 px-5 rounded-3 fw-bold text-white shadow-sm" style="background: var(--primary); border: none;">
                                Kirim Tanggapan <i class="bi bi-send ms-1"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Styling -->
    <style>
        .question-card:focus-within {
            border-color: var(--primary-light) !important;
            box-shadow: var(--shadow-md) !important;
        }

        /* Rating Style */
        .rating-item {
            cursor: pointer;
            position: relative;
            flex: 1;
        }
        .rating-radio {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }
        .rating-circle {
            width: 46px;
            height: 46px;
            border-radius: 50%;
            border: 2px solid var(--border-soft);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: var(--white);
            transition: all 0.2s ease;
            box-shadow: var(--shadow-sm);
        }
        .rating-num {
            font-weight: 800;
            color: var(--text-muted);
            font-size: 1.1rem;
        }
        .rating-label-text {
            display: block;
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--text-muted);
            margin-top: 6px;
        }
        .rating-item:hover .rating-circle {
            border-color: var(--primary-light);
            background-color: var(--primary-soft);
        }
        .rating-radio:checked + .rating-circle {
            border-color: var(--primary-light);
            background-color: var(--primary-light);
        }
        .rating-radio:checked + .rating-circle .rating-num {
            color: var(--white);
        }

        /* Multiple Choice Style */
        .choice-container {
            border-color: var(--border-soft);
            background-color: var(--white);
            box-shadow: var(--shadow-sm);
        }
        .choice-container:hover {
            border-color: var(--primary-light);
            background-color: var(--primary-soft);
        }
        .choice-radio:checked + .choice-text {
            color: var(--primary) !important;
            font-weight: 700 !important;
        }
        .choice-container:has(.choice-radio:checked) {
            border-color: var(--primary-light) !important;
            background-color: var(--primary-soft) !important;
        }
        
        .cursor-pointer {
            cursor: pointer;
        }
    </style>

    <!-- Bootstrap 5 Form Validation Script -->
    <script>
        (() => {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
@endsection
