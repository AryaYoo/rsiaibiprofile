@extends('layouts.company')

@section('content')
    {{-- Page Header --}}
    <section id="header" data-nav-label="Karir" class="page-header">
        <div class="container">
            <span class="badge-label">Karir</span>
            <h1>Bekerja Bersama Kami</h1>
            <p style="max-width: 800px; margin: 0 auto;">RSIA IBI Surabaya senantiasa tumbuh dan melayani di tengah
                masyarakat Surabaya yang dinamis. Oleh karena itu, kami sangat mengapresiasi keberagaman unik setiap
                individu, baik dari latar belakang suku, gender, wilayah, maupun kepercayaan.</p>
        </div>
    </section>

    {{-- Career Listings --}}
    <section id="lowongan-list" class="section-padding" style="background: var(--bg-main);">
        <div class="container">
            @php
                $levels = $careers->pluck('level')->unique()->filter()->values();
            @endphp

            @if(!$careers->isEmpty())
                {{-- Search & Filter Bar --}}
                <div class="reveal" style="display: flex; gap: 16px; margin-bottom: 32px; flex-wrap: wrap; background: white; padding: 20px; border-radius: var(--radius); border: 1px solid var(--border-soft); box-shadow: var(--shadow-sm); align-items: center;">
                    {{-- Search Input --}}
                    <div style="flex: 1; min-width: 260px; position: relative;">
                        <i class="bi bi-search" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
                        <input type="text" id="career-search" placeholder="Cari posisi pekerjaan..." 
                            style="width: 100%; padding: 12px 16px 12px 44px; border-radius: 8px; border: 1px solid var(--border-soft); outline: none; font-size: 0.95rem; font-family: inherit; color: var(--text-main); transition: var(--transition);">
                    </div>
                    {{-- Level Filter --}}
                    <div style="min-width: 220px; position: relative;">
                        <select id="career-level-filter" 
                            style="width: 100%; padding: 12px 16px; border-radius: 8px; border: 1px solid var(--border-soft); outline: none; font-size: 0.95rem; font-family: inherit; color: var(--text-main); cursor: pointer; transition: var(--transition); background: white;">
                            <option value="all">Semua Level Jabatan</option>
                            @foreach($levels as $lvl)
                                <option value="{{ $lvl }}">{{ $lvl }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif

            @if($careers->isEmpty())
                {{-- Database Empty State (Full width) --}}
                <div style="text-align: center; padding: 80px 20px; background: white; border-radius: var(--radius); border: 1px dashed var(--border-soft); width: 100%;"
                    class="reveal">
                    <div style="font-size: 3.5rem; color: var(--text-muted); margin-bottom: 24px;">
                        <i class="bi bi-briefcase"></i>
                    </div>
                    <h3 style="margin-bottom: 12px; font-size: 1.6rem; color: var(--primary);">Belum Ada Lowongan</h3>
                    <p style="color: var(--text-muted); max-width: 500px; margin: 0 auto;">Saat ini belum ada lowongan pekerjaan yang tersedia. Silakan cek kembali di lain waktu.</p>
                </div>
            @else
                {{-- Careers List (stacked layout) --}}
                <div id="careers-grid" style="display: flex; flex-direction: column; gap: 16px;"
                    class="reveal-stagger">
                    @foreach($careers as $career)
                        <a href="{{ route('compro.karir.detail', $career->id) }}"
                            class="career-item"
                            data-title="{{ strtolower($career->title) }}"
                            data-level="{{ $career->level }}"
                            style="text-decoration: none; color: inherit; display: block;">
                            <div class="career-card"
                                style="background: white; border-radius: var(--radius); padding: 24px 28px; border: 1px solid var(--border-soft); display: flex; flex-direction: column; gap: 16px; transition: var(--transition); box-shadow: var(--shadow-sm);">
                                
                                {{-- Top Section (Header) --}}
                                <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 16px; flex-wrap: wrap; width: 100%;">
                                    {{-- Left Side: Title & Type --}}
                                    <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                                        <h3 style="font-size: 1.2rem; margin: 0; color: var(--primary); font-weight: 700;">
                                            {{ $career->title }}
                                        </h3>
                                        <span
                                            style="display: inline-block; background: var(--primary-soft); color: var(--primary); padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; white-space: nowrap;">
                                            {{ ucfirst($career->type) }}
                                        </span>
                                    </div>
                                    
                                    {{-- Right Side (Pojok Kanan Atas): Info Metadata --}}
                                    <div style="display: flex; gap: 16px; font-size: 0.88rem; color: var(--text-muted); flex-wrap: wrap; align-items: center;">
                                        <div style="display: flex; align-items: center; gap: 6px;">
                                            <i class="bi bi-geo-alt" style="color: var(--primary-light);"></i>
                                            <span>{{ $career->placement }}</span>
                                        </div>
                                        <div style="display: flex; align-items: center; gap: 6px;">
                                            <i class="bi bi-award" style="color: var(--primary-light);"></i>
                                            <span>{{ $career->level }}</span>
                                        </div>
                                        @if($career->salary_min !== null || $career->salary_max !== null)
                                            <div style="display: flex; align-items: center; gap: 6px;">
                                                <i class="bi bi-cash-stack" style="color: var(--primary-light);"></i>
                                                <span>
                                                    @if($career->salary_min !== null && $career->salary_max !== null)
                                                        Rp {{ number_format($career->salary_min, 0, ',', '.') }} - Rp {{ number_format($career->salary_max, 0, ',', '.') }}
                                                    @elseif($career->salary_min !== null)
                                                        Mulai Rp {{ number_format($career->salary_min, 0, ',', '.') }}
                                                    @else
                                                        Hingga Rp {{ number_format($career->salary_max, 0, ',', '.') }}
                                                    @endif
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Divider --}}
                                <hr style="border: 0; border-top: 1px solid var(--border-soft); margin: 0;">

                                {{-- Bottom Section: Description --}}
                                <div style="width: 100%;">
                                    <p style="font-size: 0.9rem; color: var(--text-muted); line-height: 1.6; margin: 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-align: justify;">
                                        {{ $career->description }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Filter Empty State (Full width) --}}
                <div id="no-results-message" style="display: none; text-align: center; padding: 80px 20px; background: white; border-radius: var(--radius); border: 1px dashed var(--border-soft); width: 100%; margin-top: 24px;" class="reveal">
                    <div style="font-size: 3.5rem; color: var(--text-muted); margin-bottom: 24px;">
                        <i class="bi bi-search"></i>
                    </div>
                    <h3 style="margin-bottom: 12px; font-size: 1.6rem; color: var(--primary);">Pencarian Tidak Ditemukan</h3>
                    <p style="color: var(--text-muted); max-width: 500px; margin: 0 auto;">Tidak ada lowongan pekerjaan yang cocok dengan kata kunci pencarian atau filter level jabatan Anda.</p>
                </div>
            @endif
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
        .career-card {
            cursor: pointer;
        }

        .career-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md) !important;
            border-color: var(--accent) !important;
        }

        #career-search:focus, #career-level-filter:focus {
            border-color: var(--primary-light) !important;
            box-shadow: 0 0 0 3px rgba(62, 123, 39, 0.1);
        }

        @media (max-width: 768px) {
            .career-card {
                padding: 20px !important;
                gap: 16px !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('career-search');
            const levelFilter = document.getElementById('career-level-filter');
            const careerItems = document.querySelectorAll('.career-item');
            const noResultsMessage = document.getElementById('no-results-message');

            function filterCareers() {
                const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
                const selectedLevel = levelFilter ? levelFilter.value : 'all';
                let visibleCount = 0;

                careerItems.forEach(item => {
                    const title = item.getAttribute('data-title');
                    const level = item.getAttribute('data-level');

                    const matchesSearch = title.includes(query);
                    const matchesLevel = selectedLevel === 'all' || level === selectedLevel;

                    if (matchesSearch && matchesLevel) {
                        item.style.display = 'block';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                if (noResultsMessage) {
                    if (visibleCount === 0) {
                        noResultsMessage.style.display = 'block';
                        noResultsMessage.classList.add('active'); // triggers scroll reveal opacity
                    } else {
                        noResultsMessage.style.display = 'none';
                    }
                }
            }

            if (searchInput) searchInput.addEventListener('input', filterCareers);
            if (levelFilter) levelFilter.addEventListener('change', filterCareers);
        });
    </script>
@endsection