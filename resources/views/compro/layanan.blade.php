@extends('layouts.company')

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
                <div class="features-grid reveal-stagger" style="display: grid; grid-template-columns: repeat(3, 1fr) !important; gap: 24px;">
                    @foreach($medis as $service)
                        <div class="feature-card">
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
                <div class="features-grid reveal-stagger" style="display: grid; grid-template-columns: repeat(3, 1fr) !important; gap: 24px;">
                    @foreach($administrasi as $service)
                        <div class="feature-card">
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
                <span class="label">Jadwal Praktek</span>
            </div>

            <div class="features-grid reveal-stagger" style="display: grid; grid-template-columns: repeat(3, 1fr) !important; gap: 24px;">
                @forelse($groupedSchedules ?? [] as $doctorName => $doctorSchedules)
                    @php $firstSchedule = $doctorSchedules->first(); @endphp
                    <div class="feature-card" style="display: flex; flex-direction: column; align-items: center; text-align: center; border: 1px solid var(--border-soft); box-shadow: var(--shadow-sm); padding: 24px;">
                        @if($firstSchedule->image)
                            <img src="{{ asset('storage/' . $firstSchedule->image) }}" alt="{{ $doctorName }}" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-bottom: 16px; border: 2px solid var(--border-soft);">
                        @else
                            <div style="width: 80px; height: 80px; border-radius: 50%; background: var(--primary-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: bold; margin-bottom: 16px;">
                                {{ substr($doctorName, strpos($doctorName, ' ') + 1, 1) !== false ? substr($doctorName, strpos($doctorName, ' ') + 1, 1) : substr($doctorName, 0, 1) }}
                            </div>
                        @endif
                        
                        <h3 style="margin-bottom: 4px; font-size: 1.1rem;">{{ $doctorName }}</h3>
                        <span style="display: inline-block; background: var(--primary-soft); color: var(--primary); padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 700; margin-bottom: 20px;">
                            {{ $firstSchedule->specialty ?? 'Umum' }}
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
            </div>
        </div>

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
