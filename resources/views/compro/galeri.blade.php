@extends('layouts.company')

@section('content')
    {{-- Page Header --}}
    <section class="page-header">
        <div class="container">
            <span class="badge-label">Galeri</span>
            <h1>Galeri RSIA IBI</h1>
            <p>Dokumentasi kegiatan, fasilitas, dan pelayanan terbaik kami</p>
        </div>
    </section>

    {{-- Gallery Grid --}}
    <section class="section-padding" style="background: white;">
        <div class="container">
            <div class="masonry-container reveal-stagger" id="masonryGrid">
                @foreach ($galleries as $gallery)
                <div class="masonry-item gallery-item">
                    <img src="{{ asset('storage/' . $gallery->image) }}" 
                         alt="{{ $gallery->title }}" 
                         class="w-100"
                         data-bs-toggle="modal"
                         data-bs-target="#lightboxModal" 
                         data-bs-image="{{ asset('storage/' . $gallery->image) }}">
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Lightbox Modal --}}
    <div class="modal fade lightbox-backdrop" id="lightboxModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-header border-0 position-absolute top-0 end-0 z-1">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0 d-flex justify-content-center align-items-center">
                    <img id="lightboxImage" src="" alt="Galeri" class="lightbox-img rounded shadow">
                </div>
            </div>
        </div>
    </div>
    {{-- CTA --}}
    <section class="cta-modern">
        <div class="container">
            <h2>Konsultasi Kesehatan Anda Sekarang</h2>
            <p>Jangan tunda untuk menjaga kesehatan Anda dan keluarga. Hubungi kami untuk informasi lebih lanjut.</p>
            <a href="{{ url('/company-profile/kontak') }}" class="btn btn-light">Hubungi Kami →</a>
        </div>
    </section>
@endsection

@section('styles')
<style>
    .masonry-container {
        margin: 0 auto;
    }

    .masonry-item {
        width: calc(25% - 15px);
        margin-bottom: 15px;
    }

    .gallery-item img {
        transition: var(--transition);
        cursor: pointer;
        width: 100%;
        border-radius: var(--radius, 16px);
        display: block;
    }

    .gallery-item:hover img {
        transform: scale(1.03);
        box-shadow: var(--shadow-md);
    }

    .lightbox-img {
        max-width: 90%;
        max-height: 90%;
        object-fit: contain;
        border-radius: var(--radius, 16px);
    }

    .lightbox-backdrop {
        background-color: rgba(0, 0, 0, 0.88);
        z-index: 1050;
    }

    @media (max-width: 992px) { .masonry-item { width: calc(33.333% - 15px); } }
    @media (max-width: 768px) { .masonry-item { width: calc(50% - 15px); } }
    @media (max-width: 576px) { .masonry-item { width: 100%; } }
</style>
@endsection

@push('scripts')
<!-- Masonry.js -->
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lightbox
        const lightboxModal = document.getElementById('lightboxModal');
        const lightboxImage = document.getElementById('lightboxImage');
        lightboxModal.addEventListener('show.bs.modal', function(event) {
            lightboxImage.src = event.relatedTarget.getAttribute('data-bs-image');
        });

        // Masonry
        const grid = document.getElementById('masonryGrid');
        if (grid) {
            function initMasonry() {
                const images = grid.getElementsByTagName('img');
                let loaded = 0;
                function check() {
                    loaded++;
                    if (loaded >= images.length) {
                        new Masonry(grid, { itemSelector: '.masonry-item', percentPosition: true, gutter: 15, fitWidth: true });
                    }
                }
                for (let i = 0; i < images.length; i++) {
                    if (images[i].complete) { loaded++; } else { images[i].addEventListener('load', check); images[i].addEventListener('error', check); }
                }
                if (loaded >= images.length) { new Masonry(grid, { itemSelector: '.masonry-item', percentPosition: true, gutter: 15, fitWidth: true }); }
            }
            initMasonry();
        }
    });
</script>
@endpush