@extends('layout.app')

@section('title', 'Logan Airport Transfer | Boston Airport Car Service')

@section('meta_description', 'Reliable Logan Airport Transfer and Boston Airport Car Service. Professional chauffeurs, luxury vehicles, and 24/7 airport transportation.')

@section('schema')

@php
    $schema = [
        "@context" => "https://schema.org",
        "@type" => ["TaxiService", "LocalBusiness"],
        "@id" => url()->current() . "#localbusiness",
        "name" => "Logan Airport Transfer | Boston Airport Car Service",
        "url" => url()->current(),
        "logo" => asset('images/logo.png'),
        "image" => asset('images/logo.png'),
        "telephone" => "+1-857-331-9544",
        "priceRange" => "$$",

        "address" => [
            "@type" => "PostalAddress",
            "streetAddress" => "12 Highland Ave",
            "addressLocality" => "Woburn",
            "addressRegion" => "MA",
            "postalCode" => "01801",
            "addressCountry" => "US"
        ],

        "areaServed" => [
            "@type" => "Place",
            "name" => "Boston Metropolitan Area"
        ],

        "serviceType" => "Airport Transfer & Taxi Service",

        "openingHoursSpecification" => [
            "@type" => "OpeningHoursSpecification",
            "dayOfWeek" => [
                "Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"
            ],
            "opens" => "00:00",
            "closes" => "23:59"
        ],

        "sameAs" => []
    ];
@endphp

<script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>

@endsection

@section('content')

@include('layout.include.booking')
@include('layout.include.rating')
@include('layout.include.hero')
@include('layout.include.serviceArea')
@include('layout.include.service')
@include('layout.include.feature')
@include('layout.include.what_we_offer')
@include('layout.include.blog')

@endsection
