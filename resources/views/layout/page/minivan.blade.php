@extends('layout.app')
@section('title', "")
@section('meta_description', "")

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
    @include('layout.include.booking')
    @include('layout.include.rating')
@endsection
