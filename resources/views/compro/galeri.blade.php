@extends('layouts.company')

@section('content')
    <style>
        .gallery-item {
            margin-bottom: 15px;
        }

        .gallery-item img {
            transition: transform 0.3s ease;
            cursor: pointer;
            width: 100%;
            border-radius: 8px;
            display: block;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .lightbox-img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
        }

        .lightbox-backdrop {
            background-color: rgba(0, 0, 0, 0.85);
            z-index: 1050;
        }

        .hero-bg {
            background-image: url('{{ asset('images/header4bg.svg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            padding: 100px 0 10px;
        }

        .hero-bg .container {
            position: relative;
            z-index: 1;
        }

        .hero-title {
            color: #014421ff !important;
            font-weight: 900;
        }

        .hero-subtitle {
            color: #3c3c3cff !important;
        }

        /* Masonry Grid Container */
        .masonry-container {
            margin: 0 auto;
        }

        .masonry-item {
            width: calc(25% - 15px);
            margin-bottom: 15px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .masonry-item {
                width: calc(33.333% - 15px);
            }
        }

        @media (max-width: 768px) {
            .masonry-item {
                width: calc(50% - 15px);
            }
        }

        @media (max-width: 576px) {
            .masonry-item {
                width: 100%;
            }
        }
    </style>

    <section class="hero text-center hero-bg">
        <div class="container" style="margin-top: 30px;">
            <h2 class="hero-title text-3xl font-extrabold mb-4">Galeri RSIAIBI</h2>
            <p class="hero-subtitle max-w-2xl mx-auto">
                Dokumentasi kegiatan, fasilitas, dan pelayanan terbaik kami
            </p>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            <!-- Masonry Grid dengan Masonry.js -->
            <div class="masonry-container" id="masonryGrid">
                @foreach (range(1, 21) as $i)
                <div class="masonry-item gallery-item">
                    <img src="{{ asset('images/galeri' . $i . '.jpg') }}" 
                         alt="Galeri RSIAIBI {{ $i }}" 
                         class="w-100"
                         data-bs-toggle="modal"
                         data-bs-target="#lightboxModal" 
                         data-bs-image="{{ asset('images/galeri' . $i . '.jpg') }}">
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Modal Lightbox Bootstrap -->
    <div class="modal fade lightbox-backdrop" id="lightboxModal" tabindex="-1" aria-labelledby="lightboxModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-header border-0 position-absolute top-0 end-0 z-1">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-0 d-flex justify-content-center align-items-center">
                    <img id="lightboxImage" src="" alt="Galeri RSIAIBI" class="lightbox-img rounded shadow">
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS dengan Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Masonry.js -->
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi lightbox
            const lightboxModal = document.getElementById('lightboxModal');
            const lightboxImage = document.getElementById('lightboxImage');

            lightboxModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const imageSrc = button.getAttribute('data-bs-image');
                lightboxImage.src = imageSrc;
            });

            // Inisialisasi Masonry
            const masonryGrid = document.getElementById('masonryGrid');
            if (masonryGrid) {
                imagesLoaded(masonryGrid, function() {
                    new Masonry(masonryGrid, {
                        itemSelector: '.masonry-item',
                        percentPosition: true,
                        gutter: 15,
                        fitWidth: true 
                    });
                });
            }

            // Fallback untuk imagesLoaded
            function imagesLoaded(container, callback) {
                const images = container.getElementsByTagName('img');
                let loaded = 0;
                
                function imageLoaded() {
                    loaded++;
                    if (loaded === images.length) {
                        callback();
                    }
                }

                for (let i = 0; i < images.length; i++) {
                    if (images[i].complete) {
                        loaded++;
                    } else {
                        images[i].addEventListener('load', imageLoaded);
                        images[i].addEventListener('error', imageLoaded);
                    }
                }

                if (loaded === images.length) {
                    callback();
                }
            }
        });
    </script>
@endsection