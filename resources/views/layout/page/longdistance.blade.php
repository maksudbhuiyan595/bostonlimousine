@extends('layout.app')

@php
    // JSON রেসপন্স অনুযায়ী ডেটা এক্সট্র্যাক্ট এবং ফলব্যাক হ্যান্ডলিং (Long-Distance Focused)
    $pageTitle = $main_page->meta_title ?? $main_page->title ?? 'Long-Distance Taxi & Car Service From Boston to CT, RI, NH, VT, NY';
    $pageDesc = $main_page->meta_description ?? $main_page->hero_subheading ?? 'Reliable long-distance taxi and private transfers from Boston and Logan Airport to CT, RI, NH, VT, and NY. Safe, non-stop interstate rides.';

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
            "@type" => "TaxiService",
            "name" => "Boston Long-Distance & Interstate Car Service",
            "provider" => [
                "@type" => "LocalBusiness",
                "name" => "Logan Airport Transfer",
                "image" => $coverImageUrl,
                "telephone" => "+1-857-777-2125",
                "email" => "loganairporttransfer@gmail.com",
                "priceRange" => "$$$",
                "address" => [
                    "@type" => "PostalAddress",
                    "streetAddress" => "12 Highland Ave",
                    "addressLocality" => "Woburn",
                    "addressRegion" => "MA",
                    "postalCode" => "01801",
                    "addressCountry" => "US"
                ]
            ],
            "url" => url()->current(),
            "image" => $coverImageUrl,
            "description" => $pageDesc,
            "providerMobility" => "dynamic",
            "areaServed" => [
                ["@type" => "State", "name" => "Massachusetts"],
                ["@type" => "State", "name" => "Connecticut"],
                ["@type" => "State", "name" => "Rhode Island"],
                ["@type" => "State", "name" => "New Hampshire"],
                ["@type" => "State", "name" => "Vermont"],
                ["@type" => "State", "name" => "New York"]
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

        /* 1. Long-Distance Hero Section */
        .long-distance-hero {
            position: relative;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 480px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 85px 20px 115px 20px;
            overflow: hidden;
        }

        .long-distance-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(15, 23, 42, 0.62) 0%, rgba(15, 23, 42, 0.92) 100%);
            z-index: 1;
        }

        .hero-inner {
            position: relative;
            z-index: 2;
            max-width: 940px;
        }

        .hero-route-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(185, 146, 75, 0.2);
            border: 1px solid rgba(185, 146, 75, 0.45);
            color: #ffffff;
            font-size: 0.82rem;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            font-weight: 700;
            padding: 6px 18px;
            border-radius: 50px;
            margin-bottom: 20px;
            backdrop-filter: blur(6px);
        }

        .long-distance-hero h1 {
            font-size: clamp(2.1rem, 4.5vw, 3.3rem);
            font-weight: 800;
            line-height: 1.25;
            color: #ffffff;
            margin-bottom: 18px;
            letter-spacing: -0.02em;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        .long-distance-hero h1 span {
            color: var(--brand-gold);
        }

        .long-distance-hero p {
            font-size: clamp(1.05rem, 2vw, 1.25rem);
            color: #e2e8f0;
            line-height: 1.6;
            margin: 0 auto;
            max-width: 780px;
        }

        /* Route Highlights & Features */
        .route-features-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 12px;
            margin-top: 25px;
        }

        .route-chip {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #f8fafc;
            font-size: 0.88rem;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .route-chip i {
            color: var(--brand-gold);
        }

        /* 2. Booking Section Offset */
        .booking-section-wrapper {
            margin-top: 20px !important;
            position: relative;
            z-index: 10;
        }

        /* 3. Rich Text Content Card */
        .content-section-wrapper {
            background-color: var(--bg-muted);
            padding: 70px 0;
        }

        .content-card-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
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
            margin-bottom: 0.6rem;
        }

        .content-card-box img {
            max-width: 100%;
            height: auto;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
            margin: 25px 0;
        }

        /* 4. CTA Banner */
        .content-cta-banner {
            padding: 80px 0;
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
            padding: 14px 40px;
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

        /* 5. Fleet & Trip Gallery Grid */
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
            .long-distance-hero { min-height: 400px; padding: 60px 15px 85px 15px; }
            .booking-section-wrapper { margin-top: -35px !important; }
            .content-card-box { padding: 30px 20px; border-radius: 14px; font-size: 1rem; }
            .gallery-grid { grid-template-columns: 1fr; }
        }
    </style>

    {{-- 1. Hero Banner Section --}}
    <div class="long-distance-hero" style="background-image: url('{{ $coverImageUrl }}');">
        <div class="hero-inner text-center">
            @php
                $heroHeading = $main_page->hero_heading ?? 'Premium Long-Distance Taxi & Car Service';
                $heroSubheading = $main_page->hero_subheading ?? 'Safe, comfortable, and non-stop interstate rides from Boston and Logan Airport to CT, RI, NH, VT, and NY.';
            @endphp

            <div class="hero-route-badge">
                <i class="fas fa-route"></i>
                <span>Direct Interstate & Highway Travel</span>
            </div>

            <h1>{!! str_replace(['Long-Distance', 'Car Service'], ['<span>Long-Distance</span>', '<span>Car Service</span>'], e($heroHeading)) !!}</h1>
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
                    <section class="content-section-wrapper">
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
                                        <img src="{{ Storage::disk('public')->url($image) }}" alt="Long Distance Ride Fleet" loading="lazy">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @break

            @endswitch
        @endforeach

    @else
        {{-- Fallback content if data not found (Long-Distance Specific) --}}
        <section class="content-section-wrapper">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="content-card-box">
                            <h2>Top-Rated Long-Distance & Interstate Transfers</h2>
                            <p>When it comes to traveling cross-state lines, comfort, safety, and reliability are absolute priorities. Our premium long-distance private car service ensures a seamless journey from the Boston metropolitan area and Logan International Airport directly to your destination in Connecticut, Rhode Island, New Hampshire, Vermont, or New York.</p>

                            <p>Skip the stress of crowded trains, flight delays, or multiple layovers. Our professional chauffeurs drive modern, well-maintained sedans and SUVs equipped for long highway journeys. Enjoy fixed upfront pricing, non-stop rides, door-to-door convenience, and complimentary Wi-Fi or refreshments to make your interstate trip smooth and productive.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

@endsection
