@extends('layout.app')

@php
    // JSON রেসপন্স অনুযায়ী ডেটা এক্সট্র্যাক্ট এবং ফলব্যাক হ্যান্ডলিং (Minivan Focused)
    $pageTitle = $main_page->meta_title ?? $main_page->title ?? 'Affordable Minivan Taxi to Logan Airport | 6-7 Passenger Vans';
    $pageDesc = $main_page->meta_description ?? $main_page->hero_subheading ?? 'Book a spacious minivan taxi to Logan Airport. Perfect for families and extra luggage across CT, RI, NH, VT, and NY.';

    // আপনার JSON এর পাথ অনুযায়ী URL জেনারেট করা হচ্ছে
    $coverImageUrl = ($main_page && $main_page->cover_image && Storage::disk('public')->exists($main_page->cover_image))
        ? Storage::disk('public')->url($main_page->cover_image)
        : asset('images/bg.jpg'); // এখানে চাইলে আপনার মিনিভ্যানের কোনো ছবি ডিফল্ট দিতে পারেন
@endphp

{{-- SEO Meta Tags --}}
@section('title', $pageTitle)
@section('meta_description', $pageDesc)

{{-- 2. SCHEMA SECTION --}}
@section('schema')
    @php
        $schemaData = [
            "@context" => "https://schema.org",
            "@type" => "TaxiService", // LocalBusiness থেকে TaxiService এ পরিবর্তন করা হয়েছে ভালো SEO এর জন্য
            "name" => "Logan Airport Minivan Taxi Service",
            "provider" => [
                "@type" => "LocalBusiness",
                "name" => "Logan Airport Transfer",
                "image" => $coverImageUrl,
                "telephone" => "+1-857-777-2125",
                "email" => "loganairporttransfer@gmail.com",
                "priceRange" => "$$",
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
                ["@type" => "City", "name" => "Woburn"],
                ["@type" => "City", "name" => "Boston"],
                ["@type" => "Airport", "name" => "Logan International Airport"],
                ["@type" => "City", "name" => "Cambridge"]
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
            min-height: 450px; /* একটু হাইট বাড়ানো হয়েছে */
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
                // Minivan ফোকাসড ডিফল্ট হেডিং
                $heroHeading = $main_page->hero_heading ?? 'Spacious Minivan Taxi to Logan Airport';
                $heroSubheading = $main_page->hero_subheading ?? 'Perfect for families and group travels. 6-7 Passenger capacity with extra luggage space across MA, CT, RI, and NY.';
            @endphp
            {{-- Logan Airport লেখাটিকে হাইলাইট করার পাশাপাশি Minivan শব্দটিও যদি থাকে তবে তা স্প্যান ট্যাগের ভিতরে পড়বে --}}
            <h1>{!! str_replace(['Logan Airport', 'Minivan'], ['<span>Logan Airport</span>', '<span>Minivan</span>'], e($heroHeading)) !!}</h1>
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
                                        <img src="{{ Storage::disk('public')->url($image) }}" class="gallery-img" alt="Minivan Fleet Image">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @break

            @endswitch
        @endforeach

    @else
        {{-- Fallback content if data not found (Minivan Specific) --}}
        <section class="content-rich-text py-5">
            <div class="container">
                <h2>Why Choose Our Logan Airport Minivan Taxi Service?</h2>
                <p>Traveling with family, a large group, or carrying extra luggage, golf clubs, or ski gear? Standard sedans just won't cut it. Our premium Minivan taxi services provide maximum comfort, safety, and ample space for up to 7 passengers.</p>

                <p>We provide seamless transfers from Boston to Logan International Airport and all neighboring states including Connecticut, Rhode Island, New Hampshire, Vermont, and New York. With child car seat options available upon request and professional drivers, your group journey is guaranteed to be smooth and stress-free.</p>
            </div>
        </section>
    @endif

@endsection
