@extends('layouts.company')

@section('content')
    <section class="dev-section">
        <div class="container">
            <h2>
                Hi sobat sehat!
            </h2>
            <img src="{{ asset('images/development-page-gif-2.gif') }}" alt="Under Development">
            <p>
                Halaman ini masih dalam proses pengembangan
            </p>
        </div>
    </section>

    <section>

    </section>
@endsection

@section('styles')
    <style>
        .dev-section {
            padding: 120px 0;
            padding-top: 160px;
            /* top lebih besar */
            text-align: center;
            background: url("{{ asset('images/hero-background.svg') }}") no-repeat center center/cover;
            position: relative;
            color: var(--dark);
        }


        /* Overlay biar teks tetap terbaca */
        .dev-section::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.8);
            /* putih transparan */
        }

        .dev-section .container {
            position: relative;
            z-index: 1;
        }

        .dev-section h2 {
            color: var(--primary);
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 30px;
            animation: fadeIn 1s ease;
        }

        .dev-section img {
            max-width: 300px;
            margin-bottom: 25px;
            animation: float 4s ease-in-out infinite;
        }

        .dev-section .desc {
            font-size: 1rem;
            color: #555;
            opacity: 0.9;
            animation: fadeIn 1.2s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }

            100% {
                transform: translateY(0);
            }
        }
    </style>
@endsection
