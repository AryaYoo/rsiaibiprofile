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
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: center;">
                <div>
                    <span class="section-title" style="text-align: left; margin-bottom: 0;">
                        <span class="label" style="margin-bottom: 16px;">Profil</span>
                    </span>
                    <h2 style="font-size: 2rem; margin-bottom: 20px;">{{ $aboutTitle ?? 'RSIA IBI SURABAYA' }}</h2>
                    <p style="color: var(--text-muted); line-height: 1.8; font-size: 0.95rem;">{{ $aboutContent }}</p>
                </div>
                <div style="text-align: center;">
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

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; max-width: 960px; margin: 0 auto;" class="reveal-stagger">
                {{-- Visi --}}
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-eye"></i>
                    </div>
                    <h3 style="font-size: 1.3rem;">Visi</h3>
                    <p>{{ $vision }}</p>
                </div>

                {{-- Misi --}}
                <div class="feature-card">
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

            <div class="reveal" style="text-align: center; margin-bottom: 40px; display: flex; align-items: center; justify-content: center; gap: 12px;">
                <label for="specialty-filter" style="font-weight: 600; font-size: 0.9rem; color: var(--text-main);">Spesialisasi:</label>
                <select id="specialty-filter" style="padding: 8px 16px; border-radius: 8px; border: 1px solid var(--border-soft); background: white; font-family: inherit; font-size: 0.9rem; color: var(--text-main); min-width: 200px; cursor: pointer; outline: none;">
                    <option value="all">Semua Spesialis</option>
                    @foreach($specialties as $specialty)
                        <option value="{{ $specialty }}">{{ $specialty }}</option>
                    @endforeach
                </select>
            </div>

            <div class="features-grid reveal-stagger" id="doctor-grid" style="display: grid; grid-template-columns: repeat(3, 1fr) !important; gap: 24px;">
                @forelse($groupedSchedules ?? [] as $doctorName => $doctorSchedules)
                    @php $firstSchedule = $doctorSchedules->first(); @endphp
                    <div class="feature-card doctor-card" data-specialty="{{ $firstSchedule->specialty ?? 'Umum' }}" style="display: flex; flex-direction: column; align-items: center; text-align: center; border: 1px solid var(--border-soft); box-shadow: var(--shadow-sm); padding: 24px; transition: all 0.3s ease;">
                        @if($firstSchedule->image)
                            <img src="{{ asset('storage/' . $firstSchedule->image) }}" alt="{{ $doctorName }}" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin-bottom: 16px; border: 3px solid var(--primary-soft);">
                        @else
                            <div style="width: 100px; height: 100px; border-radius: 50%; background: var(--primary-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 2.5rem; font-weight: bold; margin-bottom: 16px;">
                                {{ substr($doctorName, strpos($doctorName, ' ') + 1, 1) !== false ? substr($doctorName, strpos($doctorName, ' ') + 1, 1) : substr($doctorName, 0, 1) }}
                            </div>
                        @endif
                        
                        <h3 style="margin-bottom: 4px; font-size: 1.15rem;">{{ $doctorName }}</h3>
                        <span style="display: inline-block; background: var(--primary-soft); color: var(--primary); padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 700;">
                            {{ $firstSchedule->specialty ?? 'Umum' }}
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
    @media (max-width: 768px) {
        .container > div[style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endsection
