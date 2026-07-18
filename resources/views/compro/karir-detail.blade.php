@extends('layouts.company')

@section('content')
    {{-- Page Header --}}
    <section id="header" data-nav-label="Detail Lowongan" class="page-header">
        <div class="container">
            <span class="badge-label">Detail Lowongan</span>
            <h1>{{ $career->title }}</h1>
            <p>RSIA IBI Surabaya - {{ $career->placement }}</p>
        </div>
    </section>

    {{-- Detail Content --}}
    <section id="detail-lowongan" class="section-padding" style="background: white;">
        <div class="container">
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 48px; align-items: start;" class="career-detail-grid">
                {{-- Left Content: Details --}}
                <div class="reveal">
                    {{-- Deskripsi --}}
                    <div style="margin-bottom: 40px;">
                        <h2 style="font-size: 1.6rem; color: var(--primary); margin-bottom: 16px; border-left: 4px solid var(--primary-light); padding-left: 12px;">Deskripsi Pekerjaan</h2>
                        <p style="color: var(--text-muted); line-height: 1.8; font-size: 0.98rem; text-align: justify; margin: 0;">
                            {!! nl2br(e($career->description)) !!}
                        </p>
                    </div>

                    {{-- Day to Day Task (Jobdesc) --}}
                    @if($career->day_to_day_tasks)
                        <div style="margin-bottom: 40px;">
                            <h2 style="font-size: 1.6rem; color: var(--primary); margin-bottom: 16px; border-left: 4px solid var(--primary-light); padding-left: 12px;">Tugas & Tanggung Jawab (Jobdesc)</h2>
                            <div style="color: var(--text-muted); line-height: 1.8; font-size: 0.98rem;">
                                {!! nl2br(e($career->day_to_day_tasks)) !!}
                            </div>
                        </div>
                    @endif

                    {{-- Requirement --}}
                    @if($career->requirements)
                        <div style="margin-bottom: 40px;">
                            <h2 style="font-size: 1.6rem; color: var(--primary); margin-bottom: 16px; border-left: 4px solid var(--primary-light); padding-left: 12px;">Persyaratan Kualifikasi</h2>
                            <div style="color: var(--text-muted); line-height: 1.8; font-size: 0.98rem;">
                                {!! nl2br(e($career->requirements)) !!}
                            </div>
                        </div>
                    @endif

                    {{-- Security Warning --}}
                    <div style="background: #FFF9E6; border: 1px solid #FFE0B2; border-radius: 12px; padding: 24px; margin-top: 48px; display: flex; gap: 16px;">
                        <div style="color: #FF9800; font-size: 1.8rem; line-height: 1; flex-shrink: 0;">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <div>
                            <h4 style="color: #E65100; margin-top: 0; margin-bottom: 8px; font-size: 1.05rem;">Peringatan Keamanan</h4>
                            <p style="color: #5D4037; font-size: 0.9rem; line-height: 1.6; margin: 0; text-align: justify;">
                                RSIA IBI Surabaya <strong>tidak pernah memungut biaya apapun</strong> (termasuk biaya transportasi, akomodasi, biaya tes, atau biaya administrasi lainnya) selama proses seleksi penerimaan karyawan baru. Mohon berhati-hati terhadap pihak yang mengatasnamakan RSIA IBI Surabaya dan menawarkan bantuan dengan imbalan finansial.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Right Content: Job Info Sidebar --}}
                <div class="reveal" style="position: sticky; top: 100px;">
                    <div style="background: var(--bg-main); border-radius: var(--radius); padding: 32px; border: 1px solid var(--border-soft); box-shadow: var(--shadow-sm);">
                        <h3 style="font-size: 1.3rem; color: var(--primary); margin-bottom: 24px; font-weight: 700;">Informasi Pekerjaan</h3>
                        
                        <div style="display: flex; flex-direction: column; gap: 20px; margin-bottom: 32px;">
                            <div style="display: flex; align-items: flex-start; gap: 12px;">
                                <i class="bi bi-geo-alt" style="color: var(--primary-light); font-size: 1.2rem; margin-top: 2px;"></i>
                                <div>
                                    <div style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase;">Penempatan</div>
                                    <div style="font-weight: 700; color: var(--text-main); font-size: 0.95rem;">{{ $career->placement }}</div>
                                </div>
                            </div>

                            <div style="display: flex; align-items: flex-start; gap: 12px;">
                                <i class="bi bi-briefcase" style="color: var(--primary-light); font-size: 1.2rem; margin-top: 2px;"></i>
                                <div>
                                    <div style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase;">Tipe Kerja</div>
                                    <div style="font-weight: 700; color: var(--text-main); font-size: 0.95rem;">{{ ucfirst($career->type) }}</div>
                                </div>
                            </div>

                            <div style="display: flex; align-items: flex-start; gap: 12px;">
                                <i class="bi bi-award" style="color: var(--primary-light); font-size: 1.2rem; margin-top: 2px;"></i>
                                <div>
                                    <div style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase;">Level Jabatan</div>
                                    <div style="font-weight: 700; color: var(--text-main); font-size: 0.95rem;">{{ $career->level }}</div>
                                </div>
                            </div>

                            @if($career->salary_min !== null || $career->salary_max !== null)
                                <div style="display: flex; align-items: flex-start; gap: 12px;">
                                    <i class="bi bi-cash-stack" style="color: var(--primary-light); font-size: 1.2rem; margin-top: 2px;"></i>
                                    <div>
                                        <div style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase;">Perkiraan Gaji</div>
                                        <div style="font-weight: 700; color: var(--text-main); font-size: 0.95rem;">
                                            @if($career->salary_min !== null && $career->salary_max !== null)
                                                Rp {{ number_format($career->salary_min, 0, ',', '.') }} - Rp {{ number_format($career->salary_max, 0, ',', '.') }}
                                            @elseif($career->salary_min !== null)
                                                Mulai dari Rp {{ number_format($career->salary_min, 0, ',', '.') }}
                                            @else
                                                Hingga Rp {{ number_format($career->salary_max, 0, ',', '.') }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- Apply Button --}}
                        @if($career->apply_link)
                            <a href="{{ $career->apply_link }}" target="_blank" rel="noopener noreferrer" class="btn btn-accent" style="width: 100%; justify-content: center; height: 48px; font-size: 0.95rem; border-radius: 10px;">
                                Lamar Pekerjaan Ini <i class="bi bi-box-arrow-up-right ml-2" style="font-size: 0.8rem;"></i>
                            </a>
                        @else
                            <div style="text-align: center; font-size: 0.9rem; color: var(--text-muted); padding: 12px; border: 1px dashed var(--border-soft); border-radius: 8px; background: white;">
                                Silakan kirimkan CV & lamaran Anda ke email RSIA IBI atau hubungi kontak resmi kami.
                            </div>
                        @endif

                        <a href="{{ route('compro.karir') }}" class="btn" style="width: 100%; justify-content: center; height: 48px; font-size: 0.95rem; border-radius: 10px; margin-top: 12px; background: transparent; color: var(--primary); border: 2px solid var(--primary-soft);">
                            <i class="bi bi-arrow-left mr-2"></i> Kembali ke Lowongan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
    CTA SECTION
    ============================================ --}}
    <section id="cta" data-nav-label="Konsultasi" class="cta-modern">
        <div class="container">
            <h2>RSIA IBI — Kami Hadir untuk Anda</h2>
            <p>Memberikan pelayanan kesehatan berkualitas dengan kasih, profesionalisme, dan perhatian penuh untuk ibu dan
                anak Anda.</p>
            <a href="{{ url('/company-profile/kontak') }}" class="btn btn-light">Hubungi Kami Sekarang →</a>
        </div>
    </section>

    <style>
        @media (max-width: 992px) {
            .career-detail-grid {
                grid-template-columns: 1fr !important;
                gap: 36px !important;
            }
            div[style*="position: sticky"] {
                position: static !important;
            }
        }
    </style>
@endsection
