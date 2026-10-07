@extends('layout.app')

{{-- 1. SEO SECTION --}}
@section('title', $page->meta_title ? e($page->meta_title) : (e($page->route_name) . ' | Logan Airport Transfer'))
@section('meta_description', e($page->meta_description ?? 'Affordable and reliable airport car service by Logan Airport Transfer.'))

@section('meta_keywords')
    <meta name="keywords" content="{{ is_array($page->tags) ? implode(', ', array_map('e', $page->tags)) : e($page->tags ?? 'Logan Airport Transfer, airport taxi, car service Boston, Woburn taxi') }}">
    <meta property="og:image" content="{{ $page->cover_image ? asset('storage/' . $page->cover_image) : asset('images/home3.jpeg') }}">
@endsection

{{-- 2. SCHEMA SECTION --}}
@section('schema')
    @php
        $coverImageUrl = $page->cover_image && Storage::disk('public')->exists($page->cover_image)
            ? asset('storage/' . $page->cover_image)
            : asset('images/bg.jpg');

        $schemaData = [
            "@context" => "https://schema.org",
            "@type" => "WebPage",
            "name" => $page->meta_title ?? $page->route_name,
            "url" => url()->current(),
            "image" => $coverImageUrl,
            "description" => $page->meta_description ?? 'Logan Airport Transfer service provider.',
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
    @php
        if (!isset($page) || !$page) {
            abort(404, 'Page not found');
        }

        $coverImage = $page->cover_image && Storage::disk('public')->exists($page->cover_image)
            ? asset('storage/' . $page->cover_image)
            : asset('images/bg.jpg');

        $tags = [];
        if ($page->tags) {
            $tags = is_array($page->tags) ? $page->tags : explode(',', $page->tags);
        }

        $faqItems = [];
        if (!empty($page->faqs)) {
            $faqItems = is_string($page->faqs) ? json_decode($page->faqs, true) : $page->faqs;
        }

        // Clean and prepare FAQ Schema safely using PHP to avoid broken JSON string generations
        $faqSchemaData = null;
        if (!empty($faqItems) && count($faqItems) > 0) {
            $mainEntity = [];
            foreach ($faqItems as $faq) {
                $question = $faq['question'] ?? ($faq['title'] ?? '');
                $answer = $faq['answer'] ?? ($faq['description'] ?? '');

                if (!empty($question)) {
                    $mainEntity[] = [
                        "@type" => "Question",
                        "name" => $question,
                        "acceptedAnswer" => [
                            "@type" => "Answer",
                            "text" => strip_tags($answer)
                        ]
                    ];
                }
            }
            if (!empty($mainEntity)) {
                $faqSchemaData = [
                    "@context" => "https://schema.org",
                    "@type" => "FAQPage",
                    "mainEntity" => $mainEntity
                ];
            }
        }
    @endphp

    <style>
        /* --- COVER SECTION --- */
        .page-cover-wrapper {
            position: relative;
            width: 100%;
            height: 400px;
            background-color: #000;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .responsive-cover-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
            opacity: 0.6;
        }

        .cover-text-overlay {
            position: absolute;
            z-index: 2;
            text-align: center;
            color: white;
            padding: 0 20px;
            width: 100%;
        }

        .cover-text-overlay h1 {
            font-size: 3.5rem;
            font-weight: 800;
            text-transform: uppercase;
            text-shadow: 2px 4px 15px rgba(0, 0, 0, 0.7);
            margin: 0;
        }

        /* --- BREADCRUMB --- */
        .breadcrumb-wrapper {
            background-color: #f8f9fa;
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .breadcrumb {
            margin-bottom: 0;
            font-size: 0.9rem;
        }

        .breadcrumb-item a {
            color: #2D9CDB;
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }

        /* --- MAIN WRAPPER --- */
        .page-content-wrapper {
            padding: 60px 0;
            background-color: #fff;
        }

        .page-content {
            font-size: 1.15rem;
            line-height: 1.8;
            color: #334155;
        }

        .page-content h2, .page-content h3 {
            color: #1e293b;
            font-weight: 700;
            margin-top: 30px;
            margin-bottom: 15px;
        }

        .page-content h4, .page-content h5, .page-content h6 {
            color: #334155;
            font-weight: 600;
            margin-top: 25px;
            margin-bottom: 12px;
        }

        .page-content p {
            margin-bottom: 1.2rem;
        }

        .page-content ul, .page-content ol {
            margin-bottom: 1.2rem;
            padding-left: 1.5rem;
        }

        .page-content li {
            margin-bottom: 0.5rem;
        }

        .page-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 20px 0;
        }

        .page-content a {
            color: #2D9CDB;
            text-decoration: none;
        }

        .page-content a:hover {
            text-decoration: underline;
        }

        .page-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .page-content th, .page-content td {
            border: 1px solid #e2e8f0;
            padding: 12px;
            text-align: left;
        }

        .page-content th {
            background-color: #f8fafc;
            font-weight: 600;
        }

        /* --- TAGS --- */
        .tags-wrapper {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid #e2e8f0;
        }

        .tags-label {
            font-weight: 700;
            margin-right: 15px;
            color: #1e293b;
        }

        .tag-badge {
            background-color: #e2e8f0;
            color: #475569;
            padding: 6px 15px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
            margin: 5px;
            transition: all 0.3s;
            text-decoration: none;
        }

        .tag-badge:hover {
            background-color: #2D9CDB;
            color: #fff;
            text-decoration: none;
        }

        /* --- FAQ --- */
        .faq-section {
            margin-top: 60px;
        }

        .faq-section h3 {
            font-weight: 800;
            margin-bottom: 30px;
            color: #1e293b;
        }

        .accordion-button:not(.collapsed) {
            background-color: #f0f9ff;
            color: #2D9CDB;
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(45, 156, 219, 0.25);
        }

        /* --- SHARE --- */
        .share-section {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .share-label {
            font-weight: 700;
            margin-right: 15px;
            color: #1e293b;
        }

        .share-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background-color: #e2e8f0;
            color: #475569;
            margin: 0 5px;
            transition: all 0.3s;
            text-decoration: none;
        }

        .share-link:hover {
            background-color: #2D9CDB;
            color: #fff;
            transform: translateY(-2px);
        }
        .booking-section-wrapper{
            margin-top: -80px !important;
        }

        /* --- RESPONSIVE MEDIA QUERIES --- */
        @media (max-width: 768px) {
            .page-cover-wrapper { height: 250px; }
            .cover-text-overlay h1 { font-size: 1.8rem; font-weight: 700; }
            .page-content-wrapper { padding: 30px 0; }
            .page-content { font-size: 1rem; line-height: 1.6; }
            .faq-section h3 { font-size: 1.5rem; }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .page-cover-wrapper { height: 350px; }
            .cover-text-overlay h1 { font-size: 2.5rem; }
        }

        @media print {
            .booking-section-wrapper, .breadcrumb-wrapper, .tags-wrapper, .faq-section, .share-section {
                display: none;
            }
            .page-cover-wrapper { height: auto; background: none; }
            .cover-text-overlay h1 { color: #000; text-shadow: none; }
        }
    </style>

    {{-- BREADCRUMB SECTION --}}
    <div class="breadcrumb-wrapper">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $page->route_name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- COVER IMAGE SECTION --}}
    <div class="page-cover-wrapper">
        <img src="{{ $coverImage }}" alt="{{ $page->meta_title ?? $page->route_name }} - Logan Airport Transfer" class="responsive-cover-img" loading="eager">
        <div class="cover-text-overlay">
            <h1>{{ $page->route_name }}</h1>
        </div>
    </div>

    {{-- BOOKING SECTION --}}
    <section class="booking-section-wrapper">
           @include('layout.include.booking')
            @include('layout.include.rating')
    </section>

    {{-- MAIN CONTENT SECTION --}}
    <div class="page-content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="page-content">
                        {!! $page->content !!}
                    </div>

                    {{-- TAGS SECTION --}}
                    @if(!empty($tags))
                        <div class="tags-wrapper">
                            <div class="d-flex flex-wrap align-items-center">
                                <span class="tags-label">Topics:</span>
                                <div>
                                    @foreach($tags as $tag)
                                        @php $tag = trim($tag); @endphp
                                        @if(!empty($tag))
                                            <a href="{{ url('/search?tag=' . urlencode($tag)) }}" class="tag-badge">
                                                #{{ e($tag) }}
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- SHARE SECTION --}}
                    <div class="share-section">
                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <span class="share-label">Share this page:</span>
                                <div>
                                    @php
                                        $currentUrl = urlencode(url()->current());
                                        $pageTitle = urlencode($page->meta_title ?? $page->route_name);
                                    @endphp
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $currentUrl }}" target="_blank" rel="noopener noreferrer" class="share-link" aria-label="Share on Facebook">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ $currentUrl }}&text={{ $pageTitle }}" target="_blank" rel="noopener noreferrer" class="share-link" aria-label="Share on Twitter">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
                                    </a>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $currentUrl }}&title={{ $pageTitle }}" target="_blank" rel="noopener noreferrer" class="share-link" aria-label="Share on LinkedIn">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                                    </a>
                                    <a href="mailto:?subject={{ $pageTitle }}&body={{ $currentUrl }}" class="share-link" aria-label="Share via Email">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polygon points="22,6 12,13 2,6"/></svg>
                                    </a>
                                </div>
                            </div>
                            <div class="mt-3 mt-sm-0">
                                <small class="text-muted">
                                    Last updated: {{ ($page->updated_at instanceof \Carbon\Carbon) ? $page->updated_at->format('F j, Y') : date('F j, Y', strtotime($page->updated_at ?? 'now')) }}
                                </small>
                            </div>
                        </div>
                    </div>

                    {{-- FAQ SECTION --}}
                    @if(!empty($faqItems) && count($faqItems) > 0)
                        <div class="faq-section">
                            <h3 class="text-center">Frequently Asked Questions</h3>
                            <div class="accordion accordion-flush shadow-sm border rounded" id="faqAccordion">
                                @foreach($faqItems as $index => $faq)
                                    @if(!empty($faq['question']) || !empty($faq['title']))
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse{{ $index }}" style="font-weight: 600;">
                                                    {{ $faq['question'] ?? ($faq['title'] ?? 'Question') }}
                                                </button>
                                            </h2>
                                            <div id="faqCollapse{{ $index }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                                                <div class="accordion-body text-secondary">
                                                    {!! $faq['answer'] ?? ($faq['description'] ?? '<p>No answer provided.</p>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        {{-- SCHEMA FOR FAQ (Safely injected out of loop logic) --}}
                        @if(!empty($faqSchemaData))
                            <script type="application/ld+json">
                                {!! json_encode($faqSchemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
                            </script>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
