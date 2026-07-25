@extends('layouts.company')

@section('styles')
    <style>
        #services-list .service-list-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
            gap: 24px;
        }

        #services-list .service-list-card {
            min-width: 0;
        }

        #services-list .service-list-card h3,
        #services-list .service-list-card p {
            overflow-wrap: anywhere;
        }

        @media (max-width: 992px) {
            #services-list .service-list-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                gap: 16px !important;
            }

            #services-list .service-list-card {
                padding: 22px 18px !important;
            }
        }

        @media (max-width: 768px) {
            #filter {
                padding: 12px 0 !important;
            }

            #filter .container {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 8px;
            }

            .tab-btn {
                width: 100%;
                min-width: 0;
                padding: 10px 8px !important;
                font-size: 0.76rem !important;
                line-height: 1.25;
                white-space: normal;
            }

            #services-list.section-padding {
                padding-top: 34px;
                padding-bottom: 46px;
            }

            #services-list .service-list-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                gap: 10px !important;
            }

            #services-list .service-list-card {
                padding: 14px 9px !important;
                border-radius: 14px !important;
            }

            #services-list .service-list-card .feature-icon {
                width: 42px !important;
                height: 42px !important;
                border-radius: 12px !important;
                margin-bottom: 10px !important;
                font-size: 1.05rem !important;
            }

            #services-list .service-list-card .feature-icon img {
                width: 24px !important;
                height: 24px !important;
            }

            #services-list .service-list-card h3 {
                font-size: 0.86rem !important;
                line-height: 1.25;
                margin-bottom: 6px !important;
            }

            #services-list .service-list-card p {
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
                font-size: 0.72rem !important;
                line-height: 1.45 !important;
                margin-bottom: 0 !important;
            }
        }

        @media (max-width: 420px) {
            #services-list .service-list-grid {
                gap: 8px !important;
            }

            #services-list .service-list-card {
                padding: 12px 7px !important;
            }

            #services-list .service-list-card .feature-icon {
                width: 38px !important;
                height: 38px !important;
            }

            #services-list .service-list-card h3 {
                font-size: 0.78rem !important;
            }

            #services-list .service-list-card p {
                -webkit-line-clamp: 2;
                font-size: 0.66rem !important;
            }
        }
    </style>
@endsection

@section('content')
    {{-- Page Header --}}
    <section id="header" data-nav-label="Layanan" class="page-header">
        <div class="container">
            <span class="badge-label">Layanan</span>
            <h1>Layanan Kami</h1>
            <p>Berbagai layanan kesehatan profesional dan penuh kasih untuk ibu dan anak Anda</p>
        </div>
    </section>

    {{-- Tabs --}}
    <section id="filter" data-nav-label="Filter" style="background: white; padding: 16px 0;">
        <div class="container" style="text-align: center;">
            <button class="tab-btn active" data-tab="medis">Medis & Keperawatan</button>
            <button class="tab-btn" data-tab="administrasi">Administrasi</button>
        </div>
    </section>

    {{-- Content --}}
    <section id="services-list" data-nav-label="Daftar Layanan" class="section-padding" style="background: var(--bg-main);">
        <div class="container">
            <div class="tab-content" id="medis">
                <div class="features-grid reveal-stagger service-list-grid">
                    @foreach($medis as $service)
                        <div class="feature-card service-list-card">
                            <div class="feature-icon">
                                @if($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" style="width: 32px; height: 32px; border-radius: 6px;">
                                @elseif($service->icon)
                                    <i class="{{ $service->icon }}"></i>
                                @else
                                    <i class="bi bi-plus-circle"></i>
                                @endif
                            </div>
                            <h3>{{ $service->title }}</h3>
                            <p>{{ $service->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="tab-content" id="administrasi" style="display:none;">
                <div class="features-grid reveal-stagger service-list-grid">
                    @foreach($administrasi as $service)
                        <div class="feature-card service-list-card">
                            <div class="feature-icon">
                                @if($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" style="width: 32px; height: 32px; border-radius: 6px;">
                                @elseif($service->icon)
                                    <i class="{{ $service->icon }}"></i>
                                @else
                                    <i class="bi bi-plus-circle"></i>
                                @endif
                            </div>
                            <h3>{{ $service->title }}</h3>
                            <p>{{ $service->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Jadwal Layanan Section --}}
    <section id="jadwal-layanan" data-nav-label="Jadwal Dokter" class="section-padding" style="background: white; border-top: 1px solid var(--border-soft);">
        <div class="container">
            <div class="section-title reveal">
                <span class="label">Jadwal Praktek Dokter</span>
                <h2>Pencarian & Jadwal dokter</h2>
                <p>Cari dokter atau filter berdasarkan spesialisasi & hari praktik</p>
            </div>

            {{-- Filter & Search Bar --}}
            <div class="schedule-filter-bar reveal" style="background: var(--bg-main); padding: 20px; border-radius: 16px; border: 1px solid var(--border-soft); margin-bottom: 32px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 16px; align-items: center;" class="filter-grid">
                    {{-- Input Search --}}
                    <div style="position: relative;">
                        <i class="bi bi-search" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 1rem;"></i>
                        <input type="text" id="doctor-search" placeholder="Cari nama dokter atau spesialisasi..." 
                            style="width: 100%; padding: 12px 16px 12px 44px; border-radius: 12px; border: 1px solid var(--border-soft); outline: none; font-size: 0.95rem; background: white; transition: all 0.2s;"
                            onkeyup="filterDoctorSchedules()">
                    </div>

                    {{-- Filter Spesialisasi --}}
                    <div>
                        <select id="specialty-filter" onchange="filterDoctorSchedules()" 
                            style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 1px solid var(--border-soft); outline: none; font-size: 0.95rem; background: white; color: var(--text-main);">
                            <option value="">Semua Spesialisasi</option>
                            @php
                                $specialties = collect($groupedSchedules ?? [])->map(fn($s) => $s->first()->doctor->specialty ?? 'Umum')->unique()->filter()->values();
                            @endphp
                            @foreach($specialties as $spec)
                                <option value="{{ $spec }}">{{ $spec }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filter Hari Praktik --}}
                    <div>
                        <select id="day-filter" onchange="filterDoctorSchedules()" 
                            style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 1px solid var(--border-soft); outline: none; font-size: 0.95rem; background: white; color: var(--text-main);">
                            <option value="">Semua Hari Praktik</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="schedules-grid reveal-stagger">
                @forelse($groupedSchedules ?? [] as $doctorId => $doctorSchedules)
                    @php 
                        $doctor = $doctorSchedules->first()->doctor;
                        $doctorDays = strtolower(implode(',', $doctorSchedules->pluck('day')->toArray()));
                    @endphp
                    <div class="schedule-card" 
                        data-name="{{ strtolower($doctor->name) }}" 
                        data-specialty="{{ strtolower($doctor->specialty ?? 'Umum') }}"
                        data-days="{{ $doctorDays }}">
                        @if($doctor->image)
                            <img src="{{ asset('storage/' . $doctor->image) }}" alt="{{ $doctor->name }}" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-bottom: 16px; border: 2px solid var(--border-soft);">
                        @else
                            <div style="width: 80px; height: 80px; border-radius: 50%; background: var(--primary-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: bold; margin-bottom: 16px;">
                                {{ substr($doctor->name, 0, 1) }}
                            </div>
                        @endif
                        
                        <h3 style="margin-bottom: 4px; font-size: 1.1rem;">{{ $doctor->name }}</h3>
                        <span style="display: inline-block; background: var(--primary-soft); color: var(--primary); padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 700; margin-bottom: 20px;">
                            {{ $doctor->specialty ?? 'Umum' }}
                        </span>
                        
                        <div style="width: 100%; text-align: left; background: var(--bg-main); padding: 16px; border-radius: 8px; margin-top: auto;">
                            <h4 style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 12px; border-bottom: 1px solid var(--border-soft); padding-bottom: 8px;">Jadwal Praktik:</h4>
                            
                            <ul style="list-style: none; padding: 0; margin: 0; font-size: 0.9rem;">
                                @foreach($doctorSchedules as $schedule)
                                <li style="display: flex; justify-content: space-between; margin-bottom: 8px; align-items: center;">
                                    <span style="font-weight: 600; color: var(--text-main); display: flex; align-items: center;">
                                        <i class="far fa-calendar-check text-emerald-600 mr-2" style="width: 16px;"></i> {{ $schedule->day }}
                                    </span>
                                    <span style="color: var(--text-muted); background: white; padding: 2px 8px; border-radius: 4px; border: 1px solid var(--border-soft); font-size: 0.8rem;">
                                        {{ $schedule->time }}
                                    </span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 48px; background: white; border-radius: 16px; border: 1px dashed var(--border-soft);">
                        <i class="fas fa-calendar-times" style="font-size: 3rem; color: var(--border-soft); margin-bottom: 16px;"></i>
                        <h3 style="color: var(--text-muted);">Belum ada jadwal dokter yang tersedia.</h3>
                    </div>
                @endforelse

                {{-- Empty filter result container --}}
                <div id="no-schedule-results" style="display: none; grid-column: 1 / -1; text-align: center; padding: 48px; background: white; border-radius: 16px; border: 1px dashed var(--border-soft);">
                    <i class="fas fa-search-minus" style="font-size: 3rem; color: var(--border-soft); margin-bottom: 16px;"></i>
                    <h3 style="color: var(--text-muted); margin-bottom: 8px;">Tidak ada dokter yang cocok</h3>
                    <p style="color: var(--text-muted); font-size: 0.9rem;">Coba gunakan kata kunci pencarian atau filter yang berbeda.</p>
                </div>
            </div>
        </div>

        <style>
            @media (max-width: 768px) {
                .filter-grid {
                    grid-template-columns: 1fr !important;
                }
            }
        </style>

        <script>
            const tabs = document.querySelectorAll('.tab-btn');
            const contents = document.querySelectorAll('.tab-content');

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    tabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');

                    contents.forEach(c => c.style.display = 'none');
                    document.getElementById(tab.dataset.tab).style.display = 'block';
                });
            });

            function filterDoctorSchedules() {
                const searchVal = (document.getElementById('doctor-search')?.value || '').toLowerCase().trim();
                const specialtyVal = (document.getElementById('specialty-filter')?.value || '').toLowerCase().trim();
                const dayVal = (document.getElementById('day-filter')?.value || '').toLowerCase().trim();

                const cards = document.querySelectorAll('.schedule-card');
                let visibleCount = 0;

                cards.forEach(card => {
                    const name = card.getAttribute('data-name') || '';
                    const specialty = card.getAttribute('data-specialty') || '';
                    const days = card.getAttribute('data-days') || '';

                    const matchSearch = !searchVal || name.includes(searchVal) || specialty.includes(searchVal);
                    const matchSpecialty = !specialtyVal || specialty === specialtyVal;
                    const matchDay = !dayVal || days.includes(dayVal);

                    if (matchSearch && matchSpecialty && matchDay) {
                        card.style.display = 'flex';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                const noResultsEl = document.getElementById('no-schedule-results');
                if (noResultsEl) {
                    noResultsEl.style.display = (visibleCount === 0 && cards.length > 0) ? 'block' : 'none';
                }
            }
        </script>
    </section>

    {{-- CTA --}}
    <section id="cta" data-nav-label="Konsultasi" class="cta-modern">
        <div class="container">
            <h2>Konsultasi Kesehatan Anda Sekarang</h2>
            <p>Jangan tunda untuk menjaga kesehatan Anda dan keluarga. Hubungi kami untuk informasi lebih lanjut.</p>
            <a href="{{ url('/company-profile/kontak') }}" class="btn btn-light">Hubungi Kami →</a>
        </div>
    </section>
@endsection
