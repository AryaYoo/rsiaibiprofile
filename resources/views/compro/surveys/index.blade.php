@extends('layouts.company')

@section('title', 'Survey Kepuasan | RSIA IBI Surabaya')

@section('content')
    {{-- Page Header --}}
    <section id="header" data-nav-label="Survey" class="page-header">
        <div class="container">
            <span class="badge-label">Feedback</span>
            <h1>Survey Kepuasan</h1>
            <p>Tanggapan Anda sangat berharga bagi kami untuk terus meningkatkan kualitas pelayanan kesehatan ibu dan anak.</p>
        </div>
    </section>

    {{-- Survey Grid Section --}}
    <section class="section-padding" style="background: var(--bg-main); min-height: 500px;">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success border-0 rounded-4 p-4 mb-5 shadow-sm text-center" style="background-color: var(--primary-soft); color: var(--primary);">
                    <i class="bi bi-check-circle-fill text-success fs-2 mb-3 d-block"></i>
                    <h4 class="fw-bold mb-1">Berhasil Terkirim!</h4>
                    <p class="mb-0 text-muted">{{ session('success') }}</p>
                </div>
            @endif

            <div class="row g-4 justify-content-center">
                @forelse($surveys as $survey)
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 h-100 p-4 transition-all duration-300" style="background: var(--white); border-radius: var(--radius); box-shadow: var(--shadow-md); border: 1px solid var(--border-soft);">
                            <div class="card-body d-flex flex-col justify-content-between p-0">
                                <div>
                                    <div class="d-inline-flex align-items-center justify-content-center rounded-4 mb-4 text-white" style="width: 54px; height: 54px; background: var(--primary-light);">
                                        <i class="bi bi-chat-square-heart fs-4"></i>
                                    </div>
                                    <h3 class="card-title fw-bold h5 mb-3" style="color: var(--primary);">{{ $survey->title }}</h3>
                                    <p class="card-text text-muted small mb-4" style="line-height: 1.6;">
                                        {{ $survey->description ?? 'Bantu kami meningkatkan kualitas layanan dengan mengisi kuesioner singkat ini.' }}
                                    </p>
                                </div>
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="badge bg-light text-success fw-semibold border border-success-subtle">
                                            {{ $survey->questions_count }} Pertanyaan
                                        </span>
                                        <span class="small text-muted"><i class="bi bi-clock me-1"></i> ± 3 Menit</span>
                                    </div>
                                    <a href="{{ route('compro.surveys.show', $survey) }}" class="btn w-100 py-2.5 fw-bold text-white rounded-3 transition-colors" style="background: var(--primary); font-size: 0.9rem;">
                                        Mulai Isi Survey <i class="bi bi-arrow-right-short ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5 text-muted">
                        <div class="mb-4">
                            <i class="bi bi-clipboard-x text-muted" style="font-size: 4rem;"></i>
                        </div>
                        <h4 class="fw-bold">Belum Ada Kuesioner Aktif</h4>
                        <p class="text-muted">Saat ini belum ada survey atau kuesioner yang aktif untuk diisi. Silakan kembali lagi nanti.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <style>
        .card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg) !important;
            border-color: var(--primary-light) !important;
        }
        .card:hover .btn {
            background: var(--primary-light) !important;
        }
    </style>
@endsection
