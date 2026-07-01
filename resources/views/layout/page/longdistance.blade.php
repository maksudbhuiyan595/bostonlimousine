@extends('layout.app')

@php
    // JSON রেসপন্স অনুযায়ী ডেটা এক্সট্র্যাক্ট এবং ফলব্যাক হ্যান্ডলিং (Long-Distance Focused)
    $pageTitle = $main_page->meta_title ?? $main_page->title ?? 'Long-Distance Taxi & Car Service From Boston to CT, RI, NH, VT, NY';
    $pageDesc = $main_page->meta_description ?? $main_page->hero_subheading ?? 'Reliable long-distance taxi and private transfers from Boston and Logan Airport to CT, RI, NH, VT, and NY. Safe, non-stop interstate rides.';

    // আপনার JSON এর পাথ অনুযায়ী URL জেনারেট করা হচ্ছে
    $coverImageUrl = ($main_page && $main_page->cover_image && Storage::disk('public')->exists($main_page->cover_image))
        ? Storage::disk('public')->url($main_page->cover_image)
        : asset('images/bg.jpg');
@endphp

{{-- SEO Meta Tags --}}
@section('title', $pageTitle)
@section('meta_description', $pageDesc)

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
                "priceRange" => "$$$", // লং-ডিস্ট্যান্সের জন্য রেঞ্জ বাড়ানো হয়েছে
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

    <style>
        :root {
            --primary-color: #f4bd18;
            --dark-color: #1a1a1a;
            --light-bg: #f8f9fa;
            --text-color: #333333;
        }

        .hero-banner {
            position: relative;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 450px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        .hero-banner::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.65);
            z-index: -1;
        }

        .hero-banner h1 {
            font-size: 2.8rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 15px;
        }

        .hero-banner h1 span {
            color: var(--primary-color);
        }

        .hero-banner p {
            font-size: 1.25rem;
            color: #e0e0e0;
        }

        .content-rich-text {
            padding: 60px 0;
            line-height: 1.8;
            font-size: 1.1rem;
        }

        .content-cta {
            padding: 50px 0;
            background-color: var(--dark-color);
            color: #ffffff;
            border-top: 4px solid var(--primary-color);
        }

        .btn-taxi-cta {
            background-color: var(--primary-color);
            color: var(--dark-color);
            font-weight: 700;
            padding: 12px 30px;
            text-transform: uppercase;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn-taxi-cta:hover {
            background-color: transparent;
            color: var(--primary-color);
            box-shadow: 0 4px 15px rgba(244, 189, 24, 0.4);
            border: 2px solid var(--primary-color);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            padding: 20px 0;
        }

        .gallery-item {
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .gallery-img {
            width: 100%;
            height: 240px;
            object-fit: cover;
            display: block;
            transition: 0.5s;
        }

        .gallery-item:hover .gallery-img {
            transform: scale(1.05);
        }
        .booking-section-wrapper{
            margin-top: -80px !important;
        }

        @media (max-width: 768px) {
            .hero-banner h1 { font-size: 2rem; }
            .hero-banner p { font-size: 1rem; }
        }
    </style>

@section('content')

    {{-- 1. Hero Banner Section --}}
    <div class="hero-banner" style="background-image: url('{{ $coverImageUrl }}')">
        <div class="container text-center text-white">
            @php
                // Long-Distance ফোকাসড ডিফল্ট হেডিং
                $heroHeading = $main_page->hero_heading ?? 'Premium Long-Distance Taxi & Car Service';
                $heroSubheading = $main_page->hero_subheading ?? 'Safe, comfortable, and non-stop interstate rides from Boston and Logan Airport to CT, RI, NH, VT, and NY.';
            @endphp
            {{-- Long-Distance এবং Car Service শব্দ দুটিকে গোল্ডেন হাইলাইট করা হচ্ছে --}}
            <h1>{!! str_replace(['Long-Distance', 'Car Service'], ['<span>Long-Distance</span>', '<span>Car Service</span>'], e($heroHeading)) !!}</h1>
            <p>{{ $heroSubheading }}</p>
        </div>
    </div>

    {{-- 2. Static Include Sections --}}
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
                    <section class="content-rich-text py-5">
                        <div class="container">
                            {!! $block['data']['body'] ?? '' !!}
                        </div>
                    </section>
                @break

                {{-- CTA Banner Block --}}
                @case('cta_banner')
                    <section class="content-cta text-center py-5">
                        <div class="container">
                            @if(!empty($block['data']['title']))
                                <h2>{{ $block['data']['title'] }}</h2>
                            @endif

                            @if(!empty($block['data']['button_text']))
                                <a href="{{ $block['data']['button_url'] ?? '#' }}" class="btn-taxi-cta mt-3">
                                    {{ $block['data']['button_text'] }}
                                </a>
                            @endif
                        </div>
                    </section>
                @break

                {{-- Image Gallery Block --}}
                @case('image_gallery')
                    <section class="content-gallery py-5 bg-light">
                        <div class="container">
                            <div class="gallery-grid">
                                @foreach($block['data']['images'] ?? [] as $image)
                                    <div class="gallery-item">
                                        <img src="{{ Storage::disk('public')->url($image) }}" class="gallery-img" alt="Long Distance Ride Fleet">
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
        <section class="content-rich-text py-5">
            <div class="container">
                <h2>Top-Rated Long-Distance & Interstate Transfers</h2>
                <p>When it comes to traveling cross-state lines, comfort, safety, and reliability are absolute priorities. Our premium long-distance private car service ensures a seamless journey from the Boston metropolitan area and Logan International Airport directly to your destination in Connecticut, Rhode Island, New Hampshire, Vermont, or New York.</p>

                <p>Skip the stress of crowded trains, flight delays, or multiple layovers. Our professional chauffeurs drive modern, well-maintained sedans and SUVs equipped for long highway journeys. Enjoy fixed upfront pricing, non-stop rides, door-to-door convenience, and complimentary Wi-Fi or refreshments to make your interstate trip smooth and productive.</p>
            </div>
        </section>
    @endif

@endsection
