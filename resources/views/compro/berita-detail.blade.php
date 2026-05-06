@extends('layouts.company')

@section('title', ($item->meta_title ?: $item->title) . ' | RSIA IBI Surabaya')

@section('meta')
    <meta name="description" content="{{ $item->meta_description ?: Str::limit(strip_tags($item->content), 160) }}">
    <meta name="keywords" content="{{ $item->meta_keywords ?: 'RSIA IBI, Berita Kesehatan, Surabaya, Rumah Sakit' }}">
    
    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $item->meta_title ?: $item->title }}">
    <meta property="og:description" content="{{ $item->meta_description ?: Str::limit(strip_tags($item->content), 160) }}">
    <meta property="og:image" content="{{ $item->image ? asset('storage/' . $item->image) : asset('images/logo.png') }}">

    {{-- Twitter --}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $item->meta_title ?: $item->title }}">
    <meta property="twitter:description" content="{{ $item->meta_description ?: Str::limit(strip_tags($item->content), 160) }}">
    <meta property="twitter:image" content="{{ $item->image ? asset('storage/' . $item->image) : asset('images/logo.png') }}">
@endsection

@section('styles')
<style>
    .news-detail-container {
        padding: 80px 0;
        background: var(--bg-main);
    }
    
    .news-detail-grid {
        display: grid;
        grid-template-columns: 0.65fr 0.35fr;
        gap: 48px;
        align-items: start;
    }
    
    /* Left Sidebar: Recommendations (Sticky) */
    .news-sidebar {
        position: sticky;
        top: 100px;
    }
    
    .sidebar-card {
        background: white;
        border-radius: 20px;
        padding: 24px;
        border: 1px solid var(--border-soft);
        box-shadow: var(--shadow-sm);
    }
    
    .sidebar-card h4 {
        font-size: 1.1rem;
        color: var(--primary);
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid var(--accent);
        display: inline-block;
        font-family: 'Urbanist', sans-serif;
        font-weight: 800;
    }
    
    .rec-item {
        margin-bottom: 24px;
        display: block;
        text-decoration: none;
        transition: var(--transition);
    }
    
    .rec-item:last-child {
        margin-bottom: 0;
    }
    
    .rec-item:hover .rec-title {
        color: var(--primary-light);
    }
    
    .rec-image {
        width: 100%;
        height: 140px;
        border-radius: 12px;
        object-fit: cover;
        margin-bottom: 12px;
    }
    
    .rec-date {
        font-size: 0.75rem;
        color: var(--text-muted);
        display: block;
        margin-bottom: 4px;
    }
    
    .rec-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--primary);
        line-height: 1.4;
    }
    
    /* Right Content: Main News */
    .news-main-content {
        background: white;
        border-radius: 24px;
        padding: 48px;
        border: 1px solid var(--border-soft);
        box-shadow: var(--shadow-md);
    }
    
    .news-main-image {
        width: 100%;
        border-radius: 20px;
        margin-bottom: 32px;
        box-shadow: var(--shadow-sm);
    }
    
    .news-main-meta {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
        font-size: 0.85rem;
        color: var(--text-muted);
        font-weight: 600;
    }
    
    .news-main-meta i {
        color: var(--accent);
        margin-right: 6px;
    }
    
    .news-main-content h1 {
        font-size: clamp(1.8rem, 3vw, 2.6rem);
        color: var(--primary);
        margin-bottom: 24px;
        line-height: 1.2;
        font-family: 'Urbanist', sans-serif;
        font-weight: 800;
    }
    
    .news-body {
        font-size: 1.1rem;
        color: var(--text-main);
        line-height: 1.9;
    }
    
    .news-body p {
        margin-bottom: 24px;
    }
    
    @media (max-width: 1024px) {
        .news-detail-grid {
            grid-template-columns: 1fr;
        }
        .news-sidebar {
            position: static;
            order: 2;
        }
        .news-main-content {
            padding: 24px;
        }
    }
</style>
@endsection

@section('content')
<div class="news-detail-container">
    <div class="container">
        <div class="news-detail-grid">
            {{-- LEFT CONTENT --}}
            <main class="news-main-content">
                <div class="news-main-meta">
                    <span><i class="bi bi-calendar3"></i> {{ $item->created_at->format('d F Y') }}</span>
                    <span><i class="bi bi-person"></i> Admin RSIA IBI</span>
                </div>
                <h1>{{ $item->title }}</h1>
                
                <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://via.placeholder.com/1200x600' }}" class="news-main-image" alt="{{ $item->title }}">
                
                <div class="news-body">
                    {!! nl2br(e($item->content)) !!}
                </div>
                
                <div style="margin-top: 48px; padding-top: 32px; border-top: 1px solid var(--border-soft);">
                    <a href="{{ route('compro.berita') }}" class="btn-hero outline" style="color: var(--primary); border-color: var(--primary); text-decoration: none; padding: 12px 24px; display: inline-block;">← Kembali ke Berita & Artikel</a>
                </div>
            </main>

            {{-- RIGHT SIDEBAR --}}
            <aside class="news-sidebar">
                @if($sidebarAd)
                <div class="sidebar-card mb-4" style="padding: 16px;">
                    {!! $sidebarAd !!}
                </div>
                @endif

                <div class="sidebar-card">
                    <h4>Rekomendasi Artikel</h4>
                    <div class="rec-list">
                        @forelse($recommendations as $rec)
                        <a href="{{ route('compro.berita.detail', $rec->slug) }}" class="rec-item">
                            <img src="{{ $rec->image ? asset('storage/' . $rec->image) : 'https://via.placeholder.com/400x250' }}" class="rec-image" alt="{{ $rec->title }}">
                            <span class="rec-date">{{ $rec->created_at->format('d M Y') }}</span>
                            <span class="rec-title">{{ Str::limit($rec->title, 60) }}</span>
                        </a>
                        @empty
                        <p class="text-muted small">Belum ada berita lain.</p>
                        @endforelse
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

<section id="cta" data-nav-label="Konsultasi" class="cta-modern">
    <div class="container">
        <h2>Konsultasi Kesehatan Anda Sekarang</h2>
        <p>Jangan tunda untuk menjaga kesehatan Anda dan keluarga. Hubungi kami untuk informasi lebih lanjut.</p>
        <a href="{{ url('/company-profile/kontak') }}" class="btn btn-light">Hubungi Kami →</a>
    </div>
</section>
@endsection
