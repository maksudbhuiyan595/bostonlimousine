@extends('layout.app')

@php
    $pageTitle = $main_page->meta_title ?? $main_page->title ?? 'Reserve Boston Taxi to Logan Airport, CT, RI, NH, VT, NY';
    $pageDesc = $main_page->meta_description ?? $main_page->hero_subheading ?? 'Book reliable Boston taxi and transfer services to Logan Airport and surrounding states.';

    $coverImageUrl = ($main_page && $main_page->cover_image && Storage::disk('public')->exists($main_page->cover_image))
        ? Storage::disk('public')->url($main_page->cover_image)
        : asset('images/bg.jpg');
@endphp

{{-- 1. SEO Meta Tags --}}
@section('title', $pageTitle)
@section('meta_description', $pageDesc)
@section('og_image', $coverImageUrl)

{{-- 2. SCHEMA SECTION --}}
@section('schema')
    @php
        $schemaData = [
            "@context" => "https://schema.org",
            "@type" => "WebPage",
            "name" => $pageTitle,
            "url" => url()->current(),
            "image" => $coverImageUrl,
            "description" => $pageDesc,
            "telephone" => "+1-857-777-2125",
            "priceRange" => "$$",
            "provider" => [
                "@type" => "LocalBusiness",
                "name" => "Logan Airport Transfer",
                "image" => $coverImageUrl,
                "telephone" => "+1-857-777-2125",
                "email" => "loganairporttransfer@gmail.com",
                "address" => [
                    "@type" => "PostalAddress",
                    "streetAddress" => "12 Highland Ave",
                    "addressLocality" => "Woburn",
                    "addressRegion" => "MA",
                    "postalCode" => "01801",
                    "addressCountry" => "US"
                ]
            ],
            "areaServed" => [
                ["@type" => "City", "name" => "Woburn"],
                ["@type" => "City", "name" => "Boston"],
                ["@type" => "Airport", "name" => "Logan International Airport"],
                ["@type" => "City", "name" => "Cambridge"]
            ],
            "author" => [
                "@type" => "Organization",
                "name" => "Logan Airport Transfer"
            ]
        ];
    @endphp
    <script type="application/ld+json">
        {!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
@endsection

@section('content')
    <style>
        :root {
            --brand-gold: #B9924B;
            --brand-gold-hover: #987535;
            --dark-surface: #0f172a;
            --text-heading: #1e293b;
            --text-body: #334155;
            --bg-muted: #f8fafc;
        }

        /* 1. Hero Banner */
        .hero-banner {
            position: relative;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 480px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 80px 20px 100px 20px;
            overflow: hidden;
        }

        .hero-banner::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(15, 23, 42, 0.55) 0%, rgba(15, 23, 42, 0.88) 100%);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 900px;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(185, 146, 75, 0.2);
            border: 1px solid rgba(185, 146, 75, 0.4);
            color: #f1f5f9;
            font-size: 0.82rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            font-weight: 700;
            padding: 6px 18px;
            border-radius: 50px;
            margin-bottom: 20px;
            backdrop-filter: blur(6px);
        }

        .hero-banner h1 {
            font-size: clamp(2rem, 4.5vw, 3.2rem);
            font-weight: 800;
            line-height: 1.25;
            color: #ffffff;
            margin-bottom: 18px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        .hero-banner h1 span {
            color: var(--brand-gold);
        }

        .hero-banner p {
            font-size: clamp(1.05rem, 2vw, 1.25rem);
            color: #e2e8f0;
            line-height: 1.6;
            margin: 0 auto;
            max-width: 750px;
        }

        /* 2. Booking Area Offset */
        .booking-section-wrapper {
            margin-top: 20px !important;
            position: relative;
            z-index: 10;
        }

        /* 3. Rich Text Content Card */
        .content-section {
            background-color: var(--bg-muted);
            padding: 60px 0;
        }

        .content-card-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 45px 50px;
            box-shadow: 0 4px 25px -4px rgba(15, 23, 42, 0.04);
            font-size: 1.125rem;
            line-height: 1.85;
            color: var(--text-body);
        }

        .content-card-box h2, .content-card-box h3 {
            color: var(--text-heading);
            font-weight: 800;
            letter-spacing: -0.02em;
            margin-top: 32px;
            margin-bottom: 16px;
        }

        .content-card-box h2 {
            font-size: 1.85rem;
            position: relative;
            padding-bottom: 10px;
        }

        .content-card-box h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 45px;
            height: 3px;
            background: var(--brand-gold);
            border-radius: 2px;
        }

        .content-card-box p {
            margin-bottom: 1.4rem;
        }

        .content-card-box ul, .content-card-box ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }

        .content-card-box li {
            margin-bottom: 0.5rem;
        }

        .content-card-box img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin: 25px 0;
        }

        /* 4. Modern CTA Banner Block */
        .content-cta-banner {
            padding: 75px 0;
            background: radial-gradient(circle at center, #1e293b 0%, #0f172a 100%);
            color: #ffffff;
            position: relative;
            border-top: 3px solid var(--brand-gold);
            border-bottom: 3px solid var(--brand-gold);
        }

        .content-cta-banner h2 {
            font-size: clamp(1.8rem, 3.5vw, 2.6rem);
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 25px;
            letter-spacing: -0.02em;
        }

        .btn-luxury-cta {
            background-color: var(--brand-gold);
            color: #ffffff !important;
            font-weight: 700;
            font-size: 1rem;
            padding: 14px 38px;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border-radius: 50px;
            box-shadow: 0 6px 20px rgba(185, 146, 75, 0.4);
            transition: all 0.3s ease;
            border: 2px solid var(--brand-gold);
        }

        .btn-luxury-cta:hover {
            background-color: transparent;
            color: var(--brand-gold) !important;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(185, 146, 75, 0.55);
        }

        /* 5. Image Gallery Grid Block */
        .content-gallery-section {
            padding: 70px 0;
            background-color: #ffffff;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }

        .gallery-card {
            position: relative;
            overflow: hidden;
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
            background-color: #0f172a;
            border: 1px solid #e2e8f0;
            aspect-ratio: 16 / 10;
        }

        .gallery-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease, opacity 0.3s ease;
        }

        .gallery-card:hover img {
            transform: scale(1.06);
            opacity: 0.92;
        }

        @media (max-width: 768px) {
            .hero-banner { min-height: 380px; padding: 60px 15px 80px 15px; }
            .booking-section-wrapper { margin-top: -35px !important; }
            .content-card-box { padding: 30px 20px; border-radius: 14px; font-size: 1rem; }
            .gallery-grid { grid-template-columns: 1fr; }
        }
    </style>

    {{-- 1. Hero Banner Section --}}
    <div class="hero-banner" style="background-image: url('{{ $coverImageUrl }}');">
        <div class="hero-content text-center">
            @php
                $heroHeading = $main_page->hero_heading ?? 'Reliable Boston Taxi to Logan Airport';
                $heroSubheading = $main_page->hero_subheading ?? 'Safe, affordable, and professional chauffeured rides across CT, RI, NH, VT, and NY.';
            @endphp
            <span class="hero-badge">Premier Transportation Service</span>
            <h1>{!! str_replace('Logan Airport', '<span>Logan Airport</span>', e($heroHeading)) !!}</h1>
            <p>{{ $heroSubheading }}</p>
        </div>
    </div>

    {{-- 2. Static Booking Section --}}
    <section class="booking-section-wrapper">
        @include('layout.include.booking')
        @include('layout.include.rating')
    </section>

    {{-- 3. Dynamic Content Blocks --}}
    @if($main_page && !empty($main_page->content_blocks))

        @foreach($main_page->content_blocks as $block)
            @switch($block['type'])

                {{-- Rich Text Block --}}
                @case('rich_text')
                    <section class="content-section">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <div class="content-card-box">
                                        {!! $block['data']['body'] ?? '' !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @break

                {{-- CTA Banner Block --}}
                @case('cta_banner')
                    <section class="content-cta-banner text-center">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    @if(!empty($block['data']['title']))
                                        <h2>{{ $block['data']['title'] }}</h2>
                                    @endif

                                    @if(!empty($block['data']['button_text']))
                                        <a href="{{ $block['data']['button_url'] ?? '#' }}" class="btn-luxury-cta">
                                            <span>{{ $block['data']['button_text'] }}</span>
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </section>
                @break

                {{-- Image Gallery Block --}}
                @case('image_gallery')
                    <section class="content-gallery-section">
                        <div class="container">
                            <div class="gallery-grid">
                                @foreach($block['data']['images'] ?? [] as $image)
                                    <div class="gallery-card">
                                        <img src="{{ Storage::disk('public')->url($image) }}" alt="Fleet Gallery" loading="lazy">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @break

            @endswitch
        @endforeach

    @else
        {{-- Fallback content if blocks are empty --}}
        <section class="content-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="content-card-box">
                            <h2>Why Choose Logan Airport Transfer?</h2>
                            <p>We provide top-notch taxi and private car services from Boston to Logan International Airport and all surrounding regions including Connecticut, Rhode Island, New Hampshire, Vermont, and New York. Our fleet is clean, our drivers are professional, and our rates are always transparent.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

@endsection
