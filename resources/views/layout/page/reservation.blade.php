@extends('layout.app')

{{-- ডাটাবেজে title থাকলে সেটা দেখাবে, না থাকলে ডিফল্ট টাইটেল বসবে --}}
@section('title', $main_page->title ?? "Reserve Boston Taxi to Logan Airport, CT, RI, NH, VT, NY")

{{-- meta_description এর ক্ষেত্রেও একই সেফটি মেথড --}}
@section('meta_description', $main_page->meta_description ?? "Book Boston taxi to Logan Airport, New Haven, Stamford, Portsmouth & beyond! Safe, 24/7 cabs with child seats, minivans. Instant booking, call 617-230-6362.")

@section('schema')
    @php
        $schemaData = [
            "@context" => "https://schema.org",
            "@type" => "WebPage",
            // ডাটাবেজ থেকে dynamic title অথবা fallback ডিফল্ট title
            "name" => $main_page->title ?? "Reserve Boston Taxi to Logan Airport, CT, RI, NH, VT, NY",
            "url" => url()->current() .'/',
            // ডাটাবেজে ইমেজ থাকলে সেটার অ্যাসেট পাথ, না থাকলে ডিফল্ট ইমেজ
            "image" => isset($main_page->cover_image) ? asset($main_page->cover_image) : asset('images/cab6.png'),
            // dynamic description অথবা fallback ডিফল্ট description
            "description" => $main_page->meta_description ?? "Book Boston taxi to Logan Airport, New Haven, Stamford, Portsmouth & beyond! Safe, 24/7 cabs with child seats, minivans. Instant booking, call 617-230-6362.",
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
</script>
@endsection

@section('content')
    {{-- Hero Banner: ডাটাবেজে ডাটা থাকলে ডাইনামিক দেখাবে, না থাকলে ডিফল্ট স্টাইল বা কন্টেন্ট লোড হবে --}}
    @if($main_page && ($main_page->hero_heading || $main_page->hero_subheading))
        <div class="hero-banner" style="background-image: url('{{ $main_page->cover_image ? asset($main_page->cover_image) : asset('images/cab6.png') }}')">
            <div class="container">
                <h1>{{ $main_page->hero_heading }}</h1>
                <p>{{ $main_page->hero_subheading }}</p>
            </div>
        </div>
    @endif

    {{-- আপনার আগের ফর্ম এবং রেটিং সেকশন --}}
    @include('layout.include.booking')
    @include('layout.include.rating')

    {{-- Dynamic Content Blocks (JSON Data): ডাটাবেজে ব্লক থাকলে সেগুলো লুপ আকারে আসবে --}}
    @if($main_page && $main_page->content_blocks)
        @foreach($main_page->content_blocks as $block)
            @if(view()->exists("layout.blocks." . $block['type']))
                @include("layout.blocks." . $block['type'], ['data' => $block])
            @endif
        @endforeach
    @endif
@endsection
