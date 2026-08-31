@extends('layouts.company')

@section('title', 'Daftar Kuesioner & Survey | RSIA IBI Surabaya')

@section('content')
    {{-- Page Header --}}
    <section id="header" data-nav-label="Survey" class="page-header">
        <div class="container">
            <span class="badge-label">Kuesioner</span>
            <h1>Survey Kepuasan Pasien</h1>
            <p>Tanggapan dan masukan Anda sangat berarti untuk membantu kami terus meningkatkan kualitas pelayanan di RSIA IBI Surabaya.</p>
        </div>
    </section>

    {{-- Survey List Section --}}
    <section class="section-padding" style="background: var(--bg-main); min-height: 550px;" x-data="{
        search: '',
        surveys: {{ json_encode($surveys) }},
        get filteredSurveys() {
            if (this.search.trim() === '') return this.surveys;
            const q = this.search.toLowerCase();
            return this.surveys.filter(s => 
                s.title.toLowerCase().includes(q) || 
                (s.description && s.description.toLowerCase().includes(q))
            );
        }
    }">
        <div class="container" style="max-width: 920px;">
            @if(session('success'))
                <div class="alert alert-success border-0 rounded-4 p-4 mb-5 shadow-sm text-center" style="background-color: var(--primary-soft); color: var(--primary);">
                    <i class="bi bi-check-circle-fill text-success fs-2 mb-3 d-block"></i>
                    <h4 class="fw-bold mb-1">Berhasil Terkirim!</h4>
                    <p class="mb-0 text-muted">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Search Bar Card -->
            <div class="card border-0 p-3 mb-4 shadow-sm" style="background: var(--white); border-radius: var(--radius); border: 1px solid var(--border-soft);">
                <div class="d-flex align-items-center gap-3 px-2">
                    <i class="fas fa-search text-muted fs-5"></i>
                    <input type="text" x-model="search" placeholder="Cari judul kuesioner atau topik survei..." class="form-control border-0 shadow-none py-2" style="font-size: 1rem; color: var(--text-main);">
                    <button type="button" x-show="search.length > 0" @click="search = ''" class="btn btn-sm btn-light rounded-circle text-muted" style="width: 32px; height: 32px;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <!-- List of Surveys -->
            <div class="d-flex flex-column gap-3">
                <template x-for="survey in filteredSurveys" :key="survey.id">
                    <div class="card border-0 p-4 transition-all duration-300 survey-list-item" style="background: var(--white); border-radius: var(--radius); box-shadow: var(--shadow-sm); border: 1px solid var(--border-soft);">
                        <div class="row align-items-center g-4">
                            <div class="col-auto d-none d-sm-block">
                                <div class="d-flex align-items-center justify-content-center rounded-4 text-white" style="width: 58px; height: 58px; background: var(--primary-light);">
                                    <i class="fas fa-clipboard-list fs-4"></i>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                    <h3 class="fw-bold h5 mb-0" style="color: var(--primary);" x-text="survey.title"></h3>
                                    <span class="badge bg-light text-success fw-semibold border border-success-subtle px-2 py-1">
                                        <span x-text="survey.questions_count"></span> Pertanyaan
                                    </span>
                                </div>
                                <p class="text-muted small mb-0" style="line-height: 1.6;" x-text="survey.description || 'Bantu kami meningkatkan kualitas layanan dengan mengisi kuesioner singkat ini.'"></p>
                            </div>
                            <div class="col-12 col-md-auto text-end">
                                <a :href="'{{ url('company-profile/surveys') }}/' + survey.id" class="btn px-4 py-2.5 fw-bold text-white rounded-3 transition-colors d-inline-flex align-items-center gap-2" style="background: var(--primary); font-size: 0.9rem;">
                                    <span>Mulai Isi Kuesioner</span>
                                    <i class="fas fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- Empty state for search -->
                <div x-show="filteredSurveys.length === 0 && surveys.length > 0" class="text-center py-5 text-muted bg-white rounded-4 border p-5">
                    <i class="fas fa-search text-muted mb-3" style="font-size: 3rem; color: var(--border-soft);"></i>
                    <h5 class="fw-bold text-dark">Kuesioner Tidak Ditemukan</h5>
                    <p class="small text-muted mb-0">Tidak ada kuesioner yang cocok dengan kata kunci "<span x-text="search" class="fw-bold"></span>".</p>
                </div>

                <!-- Empty state when no surveys at all -->
                <div x-show="surveys.length === 0" class="text-center py-5 text-muted bg-white rounded-4 border p-5">
                    <i class="fas fa-clipboard-check mb-3" style="font-size: 3.5rem; color: var(--border-soft);"></i>
                    <h5 class="fw-bold text-dark">Belum Ada Kuesioner Aktif</h5>
                    <p class="small text-muted mb-0">Saat ini belum ada survei yang aktif. Silakan kunjungi kembali di lain waktu.</p>
                </div>
            </div>
        </div>
    </section>

    <style>
        .survey-list-item:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md) !important;
            border-color: var(--primary-light) !important;
        }
        .survey-list-item:hover .btn {
            background: var(--primary-light) !important;
        }
    </style>
@endsection
