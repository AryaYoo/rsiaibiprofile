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

                            @php
                                $waNumber = $career->contact_whatsapp ? preg_replace('/[^0-9]/', '', $career->contact_whatsapp) : null;
                                if ($waNumber && str_starts_with($waNumber, '0')) {
                                    $waNumber = '62' . substr($waNumber, 1);
                                }
                            @endphp

                            @if($career->contact_email || $career->contact_whatsapp)
                                <div style="padding-top: 16px; border-top: 1px dashed var(--border-soft); margin-top: 8px;">
                                    <div style="font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase; margin-bottom: 10px;">Kontak Information</div>
                                    @if($career->contact_email)
                                        <div style="display: flex; align-items: center; gap: 8px; font-size: 0.88rem; margin-bottom: 6px;">
                                            <i class="bi bi-envelope-at" style="color: var(--primary-light);"></i>
                                            <a href="mailto:{{ $career->contact_email }}" style="color: var(--primary); text-decoration: underline;">{{ $career->contact_email }}</a>
                                        </div>
                                    @endif
                                    @if($career->contact_whatsapp)
                                        <div style="display: flex; align-items: center; gap: 8px; font-size: 0.88rem;">
                                            <i class="bi bi-whatsapp" style="color: #25D366;"></i>
                                            <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener noreferrer" style="color: #059669; font-weight: 600; text-decoration: underline;">
                                                {{ $career->contact_whatsapp }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>

                        {{-- Apply Button & Logic --}}
                        @php
                            $hasLink = !empty(trim($career->apply_link ?? ''));
                            $isEmailType = $career->apply_type === 'email' || (filter_var($career->apply_link, FILTER_VALIDATE_EMAIL) || str_contains($career->apply_link ?? '', '@'));
                        @endphp

                        @if($hasLink && $isEmailType)
                            {{-- Kondisi 3: Email / Gmail --}}
                            @php
                                $emailAddress = trim($career->apply_link);
                                if (str_starts_with($emailAddress, 'mailto:')) {
                                    $emailAddress = substr($emailAddress, 7);
                                }
                                $emailSubject = rawurlencode('Lamaran Pekerjaan - ' . $career->title);
                                $emailBody = rawurlencode("Kepada Yth. Tim HRD RSIA IBI Surabaya,\n\nSaya bermaksud untuk mengajukan surat lamaran pekerjaan untuk posisi " . $career->title . ".\n\nTerlampir CV dan dokumen pendukung saya.\n\nTerima kasih.");
                                $mailtoUrl = "mailto:" . $emailAddress . "?subject=" . $emailSubject . "&body=" . $emailBody;
                            @endphp
                            <a href="{{ $mailtoUrl }}" class="btn btn-accent" style="width: 100%; justify-content: center; height: 48px; font-size: 0.95rem; border-radius: 10px;">
                                <i class="bi bi-envelope-fill mr-2"></i> Lamar via Email
                            </a>
                            <div style="text-align: center; font-size: 0.8rem; color: var(--text-muted); margin-top: 8px;">
                                Mengirim ke: <strong>{{ $emailAddress }}</strong>
                            </div>
                        @elseif($hasLink)
                            {{-- Kondisi 2: Google Form / Link --}}
                            <a href="{{ str_starts_with($career->apply_link, 'http') ? $career->apply_link : 'https://' . $career->apply_link }}" target="_blank" rel="noopener noreferrer" class="btn btn-accent" style="width: 100%; justify-content: center; height: 48px; font-size: 0.95rem; border-radius: 10px;">
                                Lamar Pekerjaan Ini <i class="bi bi-box-arrow-up-right ml-2" style="font-size: 0.8rem;"></i>
                            </a>
                        @else
                            {{-- Kondisi 1: Dikosongkan --}}
                            <div style="padding: 16px; border: 1px dashed #10B981; border-radius: 12px; background: #F0FDF4; text-align: center;">
                                <div style="font-weight: 700; color: #065F46; font-size: 0.95rem; margin-bottom: 6px;">
                                    <i class="bi bi-info-circle-fill mr-1"></i> Informasi Lamaran
                                </div>
                                <p style="font-size: 0.85rem; color: #047857; margin: 0 0 10px 0; line-height: 1.5;">
                                    Silakan kirimkan CV & Surat Lamaran Anda melalui email atau kontak resmi kami.
                                </p>

                                <div style="display: flex; flex-direction: column; gap: 8px;">
                                    @if($career->contact_email)
                                        @php
                                            $cEmailSubject = rawurlencode('Lamaran Pekerjaan - ' . $career->title);
                                            $cEmailBody = rawurlencode("Kepada Yth. Tim HRD RSIA IBI Surabaya,\n\nSaya bermaksud untuk mengajukan surat lamaran pekerjaan untuk posisi " . $career->title . ".\n\nTerlampir CV dan dokumen pendukung saya.\n\nTerima kasih.");
                                            $cMailtoUrl = "mailto:" . trim($career->contact_email) . "?subject=" . $cEmailSubject . "&body=" . $cEmailBody;
                                        @endphp
                                        <a href="{{ $cMailtoUrl }}" class="btn" style="width: 100%; justify-content: center; height: 38px; font-size: 0.85rem; border-radius: 8px; background: #059669; color: white;">
                                            <i class="bi bi-envelope-fill mr-2"></i> Kirim Email Lamaran
                                        </a>
                                    @endif
                                    @if($career->contact_whatsapp)
                                        <a href="https://wa.me/{{ $waNumber }}?text=Halo%20RSIA%20IBI,%20saya%20ingin%20mengirimkan%20lamaran%20pekerjaan%20posisi%20{{ rawurlencode($career->title) }}" target="_blank" rel="noopener noreferrer" class="btn" style="width: 100%; justify-content: center; height: 38px; font-size: 0.85rem; border-radius: 8px; background: #25D366; color: white;">
                                            <i class="bi bi-whatsapp mr-2"></i> Hubungi via WhatsApp
                                        </a>
                                    @endif
                                    @if(!$career->contact_email && !$career->contact_whatsapp)
                                        <div style="font-size: 0.8rem; color: #047857; font-style: italic;">
                                            Hubungi kontak sekretariat / HRD RSIA IBI Surabaya.
                                        </div>
                                    @endif
                                </div>
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
