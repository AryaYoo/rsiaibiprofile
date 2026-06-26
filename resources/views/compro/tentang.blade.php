@extends('layouts.company')

@section('content')
    {{-- Page Header --}}
    <section id="header" data-nav-label="Tentang" class="page-header">
        <div class="container">
            <span class="badge-label">Tentang</span>
            <h1>{{ $aboutTitle ?? 'Tentang Kami' }}</h1>
            <p>Mengenal lebih dekat visi, misi, dan nilai yang kami pegang untuk memberikan pelayanan kesehatan terbaik.</p>
        </div>
    </section>

    {{-- About Section --}}
    <section id="profil" data-nav-label="Profil" class="section-padding reveal" style="background: white;">
        <div class="container">
            <div class="about-profile-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: center;">
                <div class="about-profile-copy">
                    <span class="section-title" style="text-align: left; margin-bottom: 0;">
                        <span class="label" style="margin-bottom: 16px;">Profil</span>
                    </span>
                    <h2 style="font-size: 2rem; margin-bottom: 20px;">{{ $aboutTitle ?? 'RSIA IBI SURABAYA' }}</h2>
                    <p style="color: var(--text-muted); line-height: 1.8; font-size: 0.95rem;">{{ $aboutContent }}</p>
                </div>
                <div class="about-profile-photo" style="text-align: center;">
                    <img src="{{ asset('images/direktur.jpg') }}" alt="Direktur RSIA IBI" style="width: 100%; border-radius: 20px; box-shadow: var(--shadow-lg);">
                    <p style="margin-top: 16px; color: var(--text-muted); font-weight: 700; font-size: 0.9rem;">Dr. Ramli Tarigan (Direktur)</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Vision & Mission --}}
    <section id="visi-misi" data-nav-label="Visi & Misi" class="section-padding" style="background: var(--bg-main);">
        <div class="container">
            <div class="section-title reveal">
                <span class="label">Komitmen</span>
                <h2>Visi & Misi Kami</h2>
                <p>Komitmen kami dalam memberikan pelayanan terbaik untuk ibu dan anak</p>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; max-width: 960px; margin: 0 auto;" class="reveal-stagger about-commitment-grid">
                {{-- Visi --}}
                <div class="feature-card about-commitment-card">
                    <div class="feature-icon">
                        <i class="bi bi-eye"></i>
                    </div>
                    <h3 style="font-size: 1.3rem;">Visi</h3>
                    <p>{{ $vision }}</p>
                </div>

                {{-- Misi --}}
                <div class="feature-card about-commitment-card">
                    <div class="feature-icon">
                        <i class="bi bi-flag"></i>
                    </div>
                    <h3 style="font-size: 1.3rem;">Misi</h3>
                    <ul style="list-style: none; padding: 0;">
                        @foreach($mission as $m)
                        <li style="display: flex; align-items: flex-start; gap: 10px; margin-bottom: 12px;">
                            <span style="display: inline-flex; align-items: center; justify-content: center; width: 22px; height: 22px; background: var(--accent); color: var(--primary); border-radius: 50%; font-size: 0.7rem; font-weight: 800; flex-shrink: 0; margin-top: 2px;">✓</span>
                            <span style="color: var(--text-muted); line-height: 1.6; font-size: 0.9rem;">{{ $m }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Dokter Spesialis --}}
    <section id="tim-dokter" data-nav-label="Tim Dokter" class="section-padding" style="background: white;">
        <div class="container">
            <div class="section-title reveal">
                <span class="label">Tim Dokter Kami</span>
                <h2>Dokter Spesialis Berpengalaman</h2>
                <p>Ditangani oleh tenaga medis profesional dan terpercaya</p>
            </div>

            <div class="reveal about-filter" style="text-align: center; margin-bottom: 40px; display: flex; align-items: center; justify-content: center; gap: 12px;">
                <label for="specialty-filter" style="font-weight: 600; font-size: 0.9rem; color: var(--text-main);">Spesialisasi:</label>
                <select id="specialty-filter" style="padding: 8px 16px; border-radius: 8px; border: 1px solid var(--border-soft); background: white; font-family: inherit; font-size: 0.9rem; color: var(--text-main); min-width: 200px; cursor: pointer; outline: none;">
                    <option value="all">Semua Spesialis</option>
                    @foreach($specialties as $specialty)
                        <option value="{{ $specialty }}">{{ $specialty }}</option>
                    @endforeach
                </select>
            </div>

            <div class="features-grid reveal-stagger about-doctor-grid" id="doctor-grid">
                @forelse($groupedSchedules ?? [] as $doctorId => $doctorSchedules)
                    @php $doctor = $doctorSchedules->first()->doctor; @endphp
                    <div class="feature-card doctor-card about-doctor-card" data-specialty="{{ $doctor->specialty ?? 'Umum' }}" style="display: flex; flex-direction: column; align-items: center; text-align: center; border: 1px solid var(--border-soft); box-shadow: var(--shadow-sm); padding: 24px; transition: all 0.3s ease;">
                        @if($doctor->image)
                            <img src="{{ asset('storage/' . $doctor->image) }}" alt="{{ $doctor->name }}" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin-bottom: 16px; border: 3px solid var(--primary-soft);">
                        @else
                            <div style="width: 100px; height: 100px; border-radius: 50%; background: var(--primary-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 2.5rem; font-weight: bold; margin-bottom: 16px;">
                                {{ substr($doctor->name, 0, 1) }}
                            </div>
                        @endif
                        
                        <h3 style="margin-bottom: 4px; font-size: 1.15rem;">{{ $doctor->name }}</h3>
                        <span style="display: inline-block; background: var(--primary-soft); color: var(--primary); padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 700;">
                            {{ $doctor->specialty ?? 'Umum' }}
                        </span>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 48px; background: white; border-radius: 16px; border: 1px dashed var(--border-soft);">
                        <i class="fas fa-user-md" style="font-size: 3rem; color: var(--border-soft); margin-bottom: 16px;"></i>
                        <h3 style="color: var(--text-muted);">Belum ada data dokter spesialis.</h3>
                    </div>
                @endforelse
            </div>
            
            <div id="no-doctor-found" style="display: none; text-align: center; padding: 48px; background: white; border-radius: 16px; border: 1px dashed var(--border-soft);">
                <i class="fas fa-search" style="font-size: 3rem; color: var(--border-soft); margin-bottom: 16px;"></i>
                <h3 style="color: var(--text-muted);">Tidak ada dokter untuk spesialisasi tersebut.</h3>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterSelect = document.getElementById('specialty-filter');
            const doctorCards = document.querySelectorAll('.doctor-card');
            const noDoctorMsg = document.getElementById('no-doctor-found');
            const doctorGrid = document.getElementById('doctor-grid');

            if(filterSelect) {
                filterSelect.addEventListener('change', function() {
                    const selectedSpecialty = this.value;
                    let visibleCount = 0;

                    doctorCards.forEach(card => {
                        if (selectedSpecialty === 'all' || card.dataset.specialty === selectedSpecialty) {
                            card.style.display = 'flex';
                            visibleCount++;
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    if (visibleCount === 0) {
                        doctorGrid.style.display = 'none';
                        noDoctorMsg.style.display = 'block';
                    } else {
                        doctorGrid.style.display = 'grid';
                        noDoctorMsg.style.display = 'none';
                    }
                });
            }
        });
    </script>
    {{-- CTA --}}
    <section id="cta" data-nav-label="Konsultasi" class="cta-modern">
        <div class="container">
            <h2>Konsultasi Kesehatan Anda Sekarang</h2>
            <p>Jangan tunda untuk menjaga kesehatan Anda dan keluarga. Hubungi kami untuk informasi lebih lanjut.</p>
            <a href="{{ url('/company-profile/kontak') }}" class="btn btn-light">Hubungi Kami →</a>
        </div>
    </section>
@endsection

@section('styles')
<style>
    .about-doctor-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 24px;
    }

    .about-doctor-card {
        min-width: 0;
    }

    .about-doctor-card h3,
    .about-doctor-card span {
        max-width: 100%;
        overflow-wrap: anywhere;
    }

    @media (max-width: 992px) {
        .about-profile-grid,
        .about-commitment-grid {
            grid-template-columns: 1fr !important;
            gap: 28px !important;
        }

        .about-profile-photo {
            max-width: 520px;
            margin: 0 auto;
        }

        .about-profile-photo img {
            max-height: 420px;
            object-fit: cover;
        }

        .about-doctor-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .about-doctor-card {
            padding: 18px 14px !important;
        }
    }

    @media (max-width: 768px) {
        #profil.section-padding,
        #visi-misi.section-padding,
        #tim-dokter.section-padding {
            padding-top: 42px;
            padding-bottom: 52px;
        }

        #header.page-header h1 {
            font-size: 2.25rem;
        }

        #header.page-header p {
            max-width: 320px;
            margin-left: auto;
            margin-right: auto;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .about-profile-grid {
            gap: 22px !important;
        }

        .about-profile-copy .section-title {
            text-align: center !important;
        }

        .about-profile-copy h2 {
            font-size: 1.45rem !important;
            margin-bottom: 14px !important;
            text-align: center;
        }

        .about-profile-copy p {
            font-size: 0.9rem !important;
            line-height: 1.7 !important;
            text-align: left;
        }

        .about-profile-photo img {
            border-radius: 16px !important;
            max-height: 340px;
            object-fit: cover;
        }

        .about-profile-photo p {
            font-size: 0.82rem !important;
            margin-top: 10px !important;
        }

        .about-commitment-card {
            padding: 22px 18px !important;
            border-radius: 16px !important;
        }

        .about-commitment-card .feature-icon {
            width: 48px !important;
            height: 48px !important;
            font-size: 1.2rem !important;
            margin-bottom: 14px !important;
        }

        .about-commitment-card h3 {
            font-size: 1.08rem !important;
        }

        .about-commitment-card p,
        .about-commitment-card li span:last-child {
            font-size: 0.88rem !important;
            line-height: 1.6 !important;
        }

        .about-filter {
            flex-direction: column;
            align-items: stretch !important;
            gap: 8px !important;
            margin-bottom: 24px !important;
        }

        .about-filter label {
            text-align: left;
        }

        .about-filter select {
            width: 100%;
            min-width: 0 !important;
            padding: 11px 14px !important;
        }

        .about-doctor-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .about-doctor-card {
            padding: 12px 8px !important;
            border-radius: 14px !important;
        }

        .about-doctor-card img,
        .about-doctor-card > div[style*="border-radius: 50%"] {
            width: 58px !important;
            height: 58px !important;
            margin-bottom: 9px !important;
            font-size: 1.55rem !important;
            border-width: 2px !important;
        }

        .about-doctor-card h3 {
            font-size: 0.82rem !important;
            line-height: 1.25;
            margin-bottom: 6px !important;
        }

        .about-doctor-card span {
            font-size: 0.64rem !important;
            line-height: 1.3;
            padding: 3px 7px !important;
        }

        #no-doctor-found,
        #doctor-grid > div[style*="grid-column"] {
            padding: 28px 16px !important;
        }

        #cta.cta-modern h2 {
            font-size: 1.45rem;
        }

        #cta.cta-modern p {
            font-size: 0.92rem;
        }
    }

    @media (max-width: 420px) {
        #header.page-header {
            padding-top: 96px;
            padding-bottom: 42px;
        }

        #header.page-header h1 {
            font-size: 1.9rem;
        }

        .about-profile-copy h2 {
            font-size: 1.3rem !important;
        }

        .about-profile-photo img {
            max-height: 280px;
        }

        .about-commitment-card {
            padding-left: 14px !important;
            padding-right: 14px !important;
        }

        .about-doctor-grid {
            gap: 8px;
        }

        .about-doctor-card {
            padding: 10px 6px !important;
        }

        .about-doctor-card img,
        .about-doctor-card > div[style*="border-radius: 50%"] {
            width: 52px !important;
            height: 52px !important;
        }

        .about-doctor-card h3 {
            font-size: 0.76rem !important;
        }

        .about-doctor-card span {
            font-size: 0.58rem !important;
        }
    }
</style>
@endsection
