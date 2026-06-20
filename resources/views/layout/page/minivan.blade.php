@extends('layout.app')

{{-- ১. ডাইনামিক বা ফলব্যাক মেটা ডাটা --}}
@section('title', $main_page->title ?? "Logan Airport Taxi Transfer Boston | 24/7 Reliable Ride")
@section('meta_description', $main_page->meta_description ?? "Safe and reliable Logan Airport taxi transfer service. Affordable rates, child seats available, 24/7 instant booking. Call 617-230-6362.")

@section('schema')
    {{-- @php
        $schemaData = [
            "@context" => "https://schema.org",
            "@type" => "WebPage",
            "name" => "Reserve Boston Taxi to Logan Airport, CT, RI, NH, VT, NY",
            "url" => url()->current() .'/',
            "image" => asset('images/cab6.png'),
            "description" => "Book Boston taxi to Logan Airport, New Haven, Stamford, Portsmouth & beyond! Safe, 24/7 cabs with child seats, minivans. Instant booking, call 617-230-6362.",
            "telephone" => "617-230-6362",
            "priceRange" => "$$",
            "provider" => [
                "@type" => "LocalBusiness",
                "name" => "Boston Express Cab",
                "address" => [
                    "@type" => "PostalAddress",
                    "addressLocality" => "Boston",
                    "addressRegion" => "MA",
                    "addressCountry" => "US"
                ]
            ],
            "areaServed" => [
                ["@type" => "City", "name" => "Boston"],
                ["@type" => "Airport", "name" => "Logan International Airport"],
                ["@type" => "City", "name" => "Cambridge"]
            ],
            "author" => [
                "@type" => "Person",
                "name" => "Omar Khan"
            ]
        ];
    @endphp
<script type="application/ld+json">
    {!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script> --}}
@endsection

@section('content')
    {{-- ২. ডাইনামিক হিরো ব্যানার (ডাটাবেজে থাকলে দেখাবে, না থাকলে হাইড থাকবে) --}}
    @if($main_page && ($main_page->cover_image || $main_page->hero_heading))
        <div class="hero-banner" style="background-image: url('{{ asset('storage/' . $main_page->cover_image) }}'); background-size: cover; background-position: center; padding: 60px 0;">
            <div class="container text-center text-white" style="background: rgba(0,0,0,0.5); padding: 30px; border-radius: 8px;">
                @if($main_page->hero_heading)
                    <h1 class="display-4 fw-bold">{{ $main_page->hero_heading }}</h1>
                @endif
                @if($main_page->hero_subheading)
                    <p class="lead">{{ $main_page->hero_subheading }}</p>
                @endif
            </div>
        </div>
    @endif

    {{-- ৩. আপনার বুকিং ফর্ম ও রেটিং সেকশন --}}
    @include('layout.include.booking')
    @include('layout.include.rating')

    {{-- ৪. এডভান্সড ডাইনামিক সেকশনস (লুপ ফর পেজ ব্লগস) --}}
    @if($main_page && $main_page->content_blocks)
        @foreach($main_page->content_blocks as $block)

            {{-- ক) Rich Text Body Block --}}
            @if($block['type'] === 'rich_text' || isset($block['data']['body']))
                @php $bodyContent = $block['data']['body'] ?? $block['body'] ?? ''; @endphp
                <section class="block-rich-text my-5">
                    <div class="container">
                        <div class="prose max-w-none">
                            {!! $bodyContent !!}
                        </div>
                    </div>
                </section>
            @endif

            {{-- খ) Call to Action Banner Block --}}
            @if($block['type'] === 'cta' || isset($block['data']['button_text']))
                @php
                    $ctaTitle = $block['data']['title'] ?? $block['title'] ?? '';
                    $btnText  = $block['data']['button_text'] ?? $block['button_text'] ?? 'Book Now';
                    $btnUrl   = $block['data']['button_url'] ?? $block['button_url'] ?? '#';
                @endphp
                <section class="block-cta py-5 bg-light my-5 text-center border-top border-bottom">
                    <div class="container">
                        @if($ctaTitle)
                            <h3 class="mb-3">{{ $ctaTitle }}</h3>
                        @endif
                        <a href="{{ $btnUrl }}" class="btn btn-primary btn-lg px-4">
                            {{ $btnText }}
                        </a>
                    </div>
                </section>
            @endif

            {{-- গ) Image Gallery Block --}}
            @if($block['type'] === 'gallery' || isset($block['data']['images']))
                @php $images = $block['data']['images'] ?? $block['images'] ?? []; @endphp
                <section class="block-gallery my-5">
                    <div class="container">
                        <div class="row g-4 justify-content-center">
                            @if(is_array($images))
                                @foreach($images as $image)
                                    <div class="col-md-4 col-sm-6">
                                        <div class="card h-100 shadow-sm">
                                            <img src="{{ asset('storage/' . $image) }}" class="card-img-top img-fluid rounded" alt="Gallery Image">
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-6">
                                    <img src="{{ asset('storage/' . $images) }}" class="img-fluid rounded shadow" alt="Gallery Image">
                                </div>
                            @endif
                        </div>
                    </div>
                </section>
            @endif

        @endforeach
    @endif
@endsection
