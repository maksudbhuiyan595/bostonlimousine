@extends('layout.app')

@section('content')

<style>
    :root {
        --brand-gold: #C5A059;
        --brand-gold-dark: #A8883E;
        --brand-dark: #1A1A1A;
        --brand-white: #FFFFFF;
    }

    /* =========================
       HERO BANNER (IMPROVED)
    ========================== */
    .cities-hero-banner {
        position: relative;
        background-image: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)),
        url('{{ asset("images/new-7.webp") }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;

        min-height: 480px;
        display: flex;
        align-items: center;
        text-align: center;
    }

    .cities-hero-banner::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at center, rgba(0,0,0,0.2), rgba(0,0,0,0.75));
    }

    .cities-hero-banner .container {
        position: relative;
        z-index: 2;
    }

    .banner-title {
        color: var(--brand-white);
        font-weight: 800;
        font-size: 3rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
    }

    .banner-subtitle {
        color: var(--brand-gold);
        font-size: 1.2rem;
        font-weight: 500;
        max-width: 700px;
        margin: 0 auto;
        font-family: 'Poppins', sans-serif;
    }

    /* =========================
       SECTION
    ========================== */
    .cities-section {
        padding: 60px 0;
        background-color: var(--brand-white);
        font-family: 'Poppins', sans-serif;
    }

    .custom-title {
        color: var(--brand-dark);
        font-weight: 800;
        font-size: 2rem;
        text-transform: uppercase;
        text-align: center;
        margin-bottom: 5px;
    }

    .title-underline {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-bottom: 40px;
    }

    .line {
        width: 40px;
        height: 2px;
        background: var(--brand-gold);
        opacity: 0.5;
    }

    .star {
        color: var(--brand-gold);
        font-size: 12px;
    }

    /* =========================
       GRID
    ========================== */
    .cities-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        padding: 0 15px;
    }

    .city-link {
        text-decoration: none !important;
    }

    .city-card {
        background: #fff;
        border-radius: 12px;
        padding: 12px 15px;
        display: flex;
        align-items: center;
        gap: 12px;
        border: 1px solid rgba(197, 160, 89, 0.2);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        transition: all 0.3s ease;
        min-height: 85px;
    }

    .icon-circle {
        width: 38px;
        height: 38px;
        background: rgba(197, 160, 89, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .icon-circle i {
        color: var(--brand-gold);
        font-size: 1rem;
    }

    .city-name {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--brand-dark);
        margin: 0;
        line-height: 1.3;

        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* =========================
       HOVER EFFECT
    ========================== */
    .city-link:hover .city-card {
        background-color: var(--brand-gold);
        border-color: var(--brand-gold-dark);
        transform: translateY(-3px);
    }

    .city-link:hover .city-name {
        color: var(--brand-white);
    }

    .city-link:hover .icon-circle {
        background: var(--brand-white);
    }

    .city-link:hover .icon-circle i {
        color: var(--brand-gold);
    }

    /* =========================
       RESPONSIVE
    ========================== */

    @media (max-width: 991px) {
        .cities-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .banner-title {
            font-size: 2.4rem;
        }
    }

    @media (max-width: 768px) {
        .cities-hero-banner {
            min-height: 340px;
            padding: 60px 0;
        }

        .banner-title {
            font-size: 1.9rem;
            line-height: 1.3;
        }

        .banner-subtitle {
            font-size: 0.95rem;
            padding: 0 10px;
        }

        .cities-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .custom-title {
            font-size: 1.6rem;
        }
    }

    @media (max-width: 480px) {
        .cities-hero-banner {
            min-height: 280px;
        }

        .banner-title {
            font-size: 1.5rem;
        }

        .banner-subtitle {
            font-size: 0.85rem;
        }

        .cities-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .city-card {
            padding: 10px 12px;
            min-height: 75px;
        }

        .city-name {
            font-size: 0.8rem;
        }
    }
</style>

<!-- ================= HERO ================= -->
<section class="cities-hero-banner">
    <div class="container">
        <h1 class="banner-title">Our Service Areas</h1>
        <p class="banner-subtitle">
            Premium & Professional Logan Airport Car Service Across Your Favorite Locations
        </p>
    </div>
</section>

<!-- ================= CITIES ================= -->
<section class="cities-section">
    <div class="container">

        <h2 class="custom-title">Popular Cities We Serve</h2>

        <div class="title-underline">
            <span class="line"></span>
            <span class="star">✦</span>
            <span class="line"></span>
        </div>

        <div class="cities-grid">
            @foreach ($cities as $city)
                <a href="{{ route('dynamic.route', $city->url) }}" class="city-link" title="{{ $city->name }}">
                    <div class="city-card">
                        <div class="icon-circle">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <p class="city-name">{{ $city->name }}</p>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</section>

@endsection
