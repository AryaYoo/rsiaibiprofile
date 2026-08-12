@extends('layouts.company')

@section('content')
    {{-- Page Header --}}
    <section id="header" data-nav-label="Berita" class="page-header">
        <div class="container">
            <span class="badge-label">Berita & Artikel</span>
            <h1>Informasi Berita & Artikel</h1>
            <p>Update terbaru seputar kesehatan dan rumah sakit ibu dan anak IBI Surabaya</p>
        </div>
    </section>

    {{-- News Grid --}}
    <section id="news-list" data-nav-label="Daftar Berita" class="section-padding" style="background: var(--bg-main);">
        <div class="container">
            {{-- Search Bar --}}
            <div class="news-search-wrapper" style="max-width: 580px; margin: 0 auto 36px auto;">
                <form action="{{ route('compro.berita') }}" method="GET" style="display: flex; gap: 10px;">
                    <div style="position: relative; flex: 1;">
                        <i class="bi bi-search" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 1rem;"></i>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita atau artikel..." style="width: 100%; padding: 12px 40px 12px 44px; border-radius: 12px; border: 1px solid var(--border-soft); background: white; font-size: 0.95rem; outline: none; transition: all 0.2s ease; box-shadow: var(--shadow-sm);" onfocus="this.style.borderColor='var(--primary)'; this.style.boxShadow='0 0 0 3px rgba(18, 53, 36, 0.1)';" onblur="this.style.borderColor='var(--border-soft)'; this.style.boxShadow='var(--shadow-sm)';">
                        @if(request('search'))
                            <a href="{{ route('compro.berita') }}" style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: var(--text-muted); text-decoration: none; font-size: 1.2rem; font-weight: bold;" title="Hapus pencarian">&times;</a>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary" style="border-radius: 12px; padding: 12px 24px; white-space: nowrap; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </form>
                @if(request('search'))
                    <div style="margin-top: 12px; font-size: 0.9rem; color: var(--text-muted); text-align: center;">
                        Menampilkan hasil pencarian untuk: <strong>"{{ request('search') }}"</strong>
                        <a href="{{ route('compro.berita') }}" style="color: var(--primary); font-weight: 600; margin-left: 8px; text-decoration: underline;">Reset Pencarian</a>
                    </div>
                @endif
            </div>

            <div class="news-grid reveal-stagger">
                @forelse($news as $item)
                <div class="news-card">
                    <div class="news-card-image">
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}" onerror="this.onerror=null; this.src='{{ asset('images/default-news.svg') }}';">
                    </div>
                    <div class="news-card-body">
                        <span class="news-date">
                            <i class="bi bi-calendar3"></i> {{ $item->created_at->format('d F Y') }}
                        </span>
                        <h3>{{ $item->title }}</h3>
                        <p>{{ Str::limit($item->content, 120) }}</p>
                        <a href="{{ route('compro.berita.detail', $item->slug) }}" class="news-link">Baca Selengkapnya →</a>
                    </div>
                </div>
                @empty
                <div class="text-center py-5 w-100" style="grid-column: 1 / -1; padding: 48px 24px; background: white; border-radius: 16px; border: 1px dashed var(--border-soft);">
                    <div class="mb-4">
                        <i class="bi bi-journal-x" style="font-size: 4rem; color: var(--border-soft);"></i>
                    </div>
                    @if(request('search'))
                        <h3 class="text-muted" style="font-size: 1.25rem; margin-bottom: 8px;">Tidak ada berita yang cocok dengan kata kunci "{{ request('search') }}".</h3>
                        <p class="text-muted" style="margin-bottom: 16px;">Coba gunakan kata kunci lain atau reset pencarian Anda.</p>
                        <a href="{{ route('compro.berita') }}" class="btn btn-outline-primary" style="border-radius: 10px; padding: 8px 20px;">Lihat Semua Berita</a>
                    @else
                        <h3 class="text-muted" style="font-size: 1.25rem; margin-bottom: 8px;">Belum ada berita atau artikel yang diterbitkan.</h3>
                        <p class="text-muted">Silakan kembali lagi nanti untuk informasi terbaru.</p>
                    @endif
                </div>
                @endforelse
            </div>

            <div class="pagination-wrapper" style="margin-top: 48px; display: flex; justify-content: center;">
                {{ $news->withQueryString()->links() }}
            </div>
        </div>
    </section>

    {{-- Social Media / Instagram Feed Section --}}
    <section id="instagram" data-nav-label="Instagram" class="section-padding" style="background: white; border-top: 1px solid var(--border-soft);">
        <div class="container">
            <div class="section-title reveal" style="text-align: center; margin-bottom: 40px;">
                <span class="label">Social Media</span>
                <h2>Instagram <a href="https://www.instagram.com/rsiaibisby/" target="_blank" style="color: var(--primary); text-decoration: none;">@rsiaibisby</a></h2>
                <p>Ikuti update dan informasi kesehatan terbaru dari media sosial kami</p>
            </div>

            <div class="reveal-stagger" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; max-width: 1000px; margin: 0 auto;">
                @foreach($instagramPosts as $post)
                <div style="border-radius: 16px; overflow: hidden; border: 1px solid var(--border-soft); background: white;">
                    <blockquote class="instagram-media" data-instgrm-captioned data-instgrm-permalink="{{ $post->post_url }}" style="background:#FFF; border:0; border-radius:0; box-shadow:none; margin: 0; max-width:100%; min-width:100%; padding:0; width:100%;"></blockquote>
                </div>
                @endforeach
            </div>
            <script async src="//www.instagram.com/embed.js"></script>

            <div style="text-align: center; margin-top: 48px;" class="reveal">
                <a href="https://www.instagram.com/rsiaibisby/" target="_blank" class="btn btn-accent" style="background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); border: none; padding: 14px 32px; font-size: 1rem;">
                    <i class="fab fa-instagram" style="margin-right: 8px;"></i> Kunjungi Instagram Kami
                </a>
            </div>
        </div>
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

@section('styles')
<style>
    .news-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 24px;
    }

    .news-card {
        background: var(--white, #fff);
        border-radius: var(--radius, 16px);
        overflow: hidden;
        border: 1px solid var(--border-soft, #e4ebe2);
        transition: var(--transition);
    }

    .news-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-md);
        border-color: var(--accent, #85A947);
    }

    .news-card-image {
        height: 200px;
        overflow: hidden;
    }

    .news-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .news-card:hover .news-card-image img {
        transform: scale(1.06);
    }

    .news-card-body {
        padding: 24px;
    }

    .news-date {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.8rem;
        color: var(--text-muted, #5a6b5a);
        font-weight: 600;
        margin-bottom: 12px;
    }

    .news-card-body h3 {
        font-size: 1.1rem;
        margin-bottom: 10px;
        color: var(--primary, #123524);
        line-height: 1.4;
    }

    .news-card-body p {
        font-size: 0.88rem;
        color: var(--text-muted, #5a6b5a);
        line-height: 1.7;
        margin-bottom: 16px;
    }

    .news-link {
        font-weight: 700;
        font-size: 0.85rem;
        color: var(--primary-light, #3E7B27);
        text-decoration: none;
        transition: var(--transition);
    }

    .news-link:hover {
        color: var(--accent, #85A947);
    }

    /* Pagination Styling */
    .pagination-wrapper .pagination {
        display: flex;
        padding-left: 0;
        list-style: none;
        gap: 6px;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        margin: 0;
    }

    .pagination-wrapper .page-item .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 14px;
        border-radius: 10px;
        background: white;
        border: 1px solid var(--border-soft, #e4ebe2);
        color: var(--text-main, #123524);
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .pagination-wrapper .page-item.active .page-link {
        background: var(--primary, #123524);
        color: white;
        border-color: var(--primary, #123524);
        box-shadow: 0 4px 10px rgba(18, 53, 36, 0.2);
    }

    .pagination-wrapper .page-item.disabled .page-link {
        opacity: 0.4;
        cursor: not-allowed;
        background: #f8f9fa;
        color: var(--text-muted, #5a6b5a);
    }

    .pagination-wrapper .page-item .page-link:hover:not(.active):not(.disabled) {
        background: var(--primary-soft, #eef4ed);
        color: var(--primary, #123524);
        border-color: var(--primary-light, #3E7B27);
    }

    .pagination-wrapper nav[role="navigation"] svg {
        width: 16px !important;
        height: 16px !important;
    }

    .pagination-wrapper nav[role="navigation"] .flex {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .pagination-wrapper nav[role="navigation"] p {
        margin: 0 0 12px 0;
        font-size: 0.88rem;
        color: var(--text-muted, #5a6b5a);
        text-align: center;
    }
</style>
@endsection
