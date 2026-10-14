@extends('layout.app')

@php
    if (!isset($page) || !$page) {
        abort(404, 'Page not found');
    }

    // Resolve cover image once
    $coverImageUrl = (!empty($page->cover_image) && Storage::disk('public')->exists($page->cover_image))
        ? asset('storage/' . $page->cover_image)
        : asset('images/bg.jpg');

    // Parse tags
    $tags = [];
    if (!empty($page->tags)) {
        $tags = is_array($page->tags) ? $page->tags : array_map('trim', explode(',', $page->tags));
    }
    $tagsString = !empty($tags) ? implode(', ', $tags) : 'Logan Airport Transfer, airport taxi, car service Boston, Woburn taxi';

    // Parse FAQs & FAQ Schema
    $faqItems = [];
    if (!empty($page->faqs)) {
        $faqItems = is_string($page->faqs) ? json_decode($page->faqs, true) : $page->faqs;
    }

    $faqSchemaData = null;
    if (!empty($faqItems) && is_array($faqItems)) {
        $mainEntity = [];
        foreach ($faqItems as $faq) {
            $question = $faq['question'] ?? ($faq['title'] ?? '');
            $answer = $faq['answer'] ?? ($faq['description'] ?? '');

            if (!empty($question)) {
                $mainEntity[] = [
                    '@type' => 'Question',
                    'name' => $question,
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => strip_tags($answer)
                    ]
                ];
            }
        }
        if (!empty($mainEntity)) {
            $faqSchemaData = [
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'mainEntity' => $mainEntity
            ];
        }
    }
@endphp

{{-- 1. SEO SECTION (Fixed: Only values passed, no duplicate HTML tags) --}}
@section('title', ($page->meta_title ?? $page->route_name) . ' | Logan Airport Transfer')
@section('meta_description', $page->meta_description ?? 'Affordable and reliable airport car service by Logan Airport Transfer.')
@section('meta_keywords', $tagsString)
@section('og_image', $coverImageUrl)

{{-- 2. SCHEMA SECTION --}}
@section('schema')
    @php
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
    @if(!empty($faqSchemaData))
        <script type="application/ld+json">
            {!! json_encode($faqSchemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
        </script>
    @endif
@endsection

@section('content')
    <style>
        :root {
            --brand-primary: #0284c7;
            --brand-primary-hover: #0369a1;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --card-border: #f1f5f9;
        }

        /* Hero / Cover Section */
        .page-cover-wrapper {
            position: relative;
            width: 100%;
            min-height: 440px;
            background-color: #0f172a;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cover-backdrop-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            opacity: 0.45;
            filter: scale(1.02);
            transition: transform 0.6s ease;
        }

        .cover-overlay-gradient {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(15, 23, 42, 0.4) 0%, rgba(15, 23, 42, 0.85) 100%);
            z-index: 1;
        }

        .cover-text-overlay {
            position: relative;
            z-index: 2;
            text-align: center;
            color: #ffffff;
            padding: 40px 20px 80px 20px;
            max-width: 900px;
        }

        .cover-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #e2e8f0;
            font-size: 0.8rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 50px;
            margin-bottom: 16px;
        }

        .cover-text-overlay h1 {
            font-size: clamp(2rem, 5vw, 3.4rem);
            font-weight: 800;
            letter-spacing: -0.02em;
            line-height: 1.2;
            text-shadow: 0 4px 18px rgba(0, 0, 0, 0.4);
            margin: 0;
        }

        /* Breadcrumb Section */
        .breadcrumb-wrapper {
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 14px 0;
        }

        .breadcrumb {
            margin-bottom: 0;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .breadcrumb-item a {
            color: var(--brand-primary);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .breadcrumb-item a:hover {
            color: var(--brand-primary-hover);
            text-decoration: underline;
        }

        .breadcrumb-item.active {
            color: var(--text-muted);
        }

        /* Booking Section Offset */
        .booking-section-wrapper {
            margin-top: 20px !important;
            position: relative;
            z-index: 10;
        }

        /* Main Content Container */
        .page-content-wrapper {
            padding: 70px 0;
            background-color: #f8fafc;
        }

        .content-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 48px;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.05);
        }

        .page-content {
            font-size: 1.125rem;
            line-height: 1.85;
            color: #334155;
        }

        .page-content h2, .page-content h3 {
            color: var(--text-main);
            font-weight: 700;
            letter-spacing: -0.02em;
            margin-top: 36px;
            margin-bottom: 16px;
        }

        .page-content h2 {
            font-size: 1.85rem;
            position: relative;
            padding-bottom: 10px;
        }

        .page-content h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 45px;
            height: 3px;
            background: var(--brand-primary);
            border-radius: 2px;
        }

        .page-content h3 {
            font-size: 1.45rem;
        }

        .page-content p {
            margin-bottom: 1.4rem;
        }

        .page-content ul, .page-content ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }

        .page-content li {
            margin-bottom: 0.6rem;
        }

        .page-content img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            margin: 24px 0;
        }

        .page-content table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
            margin: 28px 0;
        }

        .page-content th, .page-content td {
            border-bottom: 1px solid #e2e8f0;
            padding: 14px 18px;
            text-align: left;
        }

        .page-content th {
            background-color: #f8fafc;
            font-weight: 700;
            color: #1e293b;
        }

        .page-content tr:last-child td {
            border-bottom: none;
        }

        /* Tags Section */
        .tags-wrapper {
            margin-top: 45px;
            padding-top: 25px;
            border-top: 1px solid #f1f5f9;
        }

        .tag-pill {
            background-color: #f1f5f9;
            color: #475569;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            margin: 4px;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .tag-pill:hover {
            background-color: #e0f2fe;
            color: var(--brand-primary);
            border-color: #bae6fd;
            transform: translateY(-1px);
        }

        /* Share Section */
        .share-wrapper {
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #f1f5f9;
        }

        .share-icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background-color: #f1f5f9;
            color: #475569;
            margin-right: 8px;
            transition: all 0.25s ease;
            text-decoration: none;
        }

        .share-icon-btn:hover {
            color: #ffffff;
            transform: translateY(-2px);
        }

        .share-icon-btn.fb:hover { background-color: #1877F2; }
        .share-icon-btn.x:hover { background-color: #000000; }
        .share-icon-btn.ln:hover { background-color: #0A66C2; }
        .share-icon-btn.mail:hover { background-color: #ea4335; }

        /* Modernized FAQs */
        .faq-section {
            margin-top: 50px;
        }

        .faq-title {
            font-size: 1.8rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: var(--text-main);
            margin-bottom: 24px;
        }

        .modern-accordion .accordion-item {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px !important;
            margin-bottom: 12px;
            overflow: hidden;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .modern-accordion .accordion-item:hover {
            border-color: #cbd5e1;
        }

        .modern-accordion .accordion-button {
            font-weight: 600;
            font-size: 1.05rem;
            color: #1e293b;
            padding: 18px 22px;
            background-color: transparent;
            box-shadow: none !important;
        }

        .modern-accordion .accordion-button:not(.collapsed) {
            background-color: #f8fafc;
            color: var(--brand-primary);
        }

        .modern-accordion .accordion-body {
            padding: 20px 22px;
            color: #475569;
            line-height: 1.7;
            font-size: 1rem;
        }

        @media (max-width: 768px) {
            .page-cover-wrapper { min-height: 300px; }
            .content-card { padding: 24px 18px; border-radius: 12px; }
            .page-content { font-size: 1rem; }
            .booking-section-wrapper { margin-top: -30px !important; }
        }

        @media print {
            .booking-section-wrapper, .breadcrumb-wrapper, .tags-wrapper, .share-wrapper, .faq-section {
                display: none;
            }
            .content-card { border: none; box-shadow: none; padding: 0; }
            .page-cover-wrapper { min-height: auto; background: none; }
            .cover-text-overlay h1 { color: #000; text-shadow: none; }
        }
        @media (min-width: 1400px) {
            .container,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl,
            .container-xxl {
                max-width: 1320px !important;
            }
        }

    </style>

    {{-- BREADCRUMB SECTION --}}
    <nav class="breadcrumb-wrapper" aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/services') }}">Services</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $page->route_name }}</li>
            </ol>
        </div>
    </nav>

    {{-- COVER / HERO SECTION --}}
    <div class="page-cover-wrapper">
        <img src="{{ $coverImageUrl }}" alt="{{ $page->meta_title ?? $page->route_name }}" class="cover-backdrop-img" loading="eager">
        <div class="cover-overlay-gradient"></div>
        <div class="cover-text-overlay">
            <span class="cover-badge">Airport Transportation</span>
            <h1>{{ $page->route_name }}</h1>
        </div>
    </div>

    {{-- BOOKING SECTION --}}
    <section class="booking-section-wrapper">
        @include('layout.include.booking')
        @include('layout.include.rating')
    </section>

    {{-- MAIN CONTENT SECTION --}}
    <section class="page-content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto">

                    <article class="content-card">
                        {{-- DYNAMIC BODY CONTENT --}}
                        <div class="page-content">
                            {!! $page->content !!}
                        </div>

                        {{-- TAGS --}}
                        @if(!empty($tags))
                            <div class="tags-wrapper d-flex flex-wrap align-items-center">
                                <span class="fw-bold text-dark me-2 small">Tags:</span>
                                <div class="d-flex flex-wrap">
                                    @foreach($tags as $tag)
                                        @if(!empty($tag))
                                            <a href="{{ url('/search?tag=' . urlencode($tag)) }}" class="tag-pill">
                                                #{{ $tag }}
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- SHARE BAR --}}
                        <div class="share-wrapper d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <div class="d-flex align-items-center">
                                <span class="fw-bold text-dark me-3 small">Share:</span>
                                @php
                                    $currentUrl = urlencode(url()->current());
                                    $shareTitle = urlencode($page->meta_title ?? $page->route_name);
                                @endphp
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $currentUrl }}" target="_blank" rel="noopener noreferrer" class="share-icon-btn fb" aria-label="Share on Facebook">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ $currentUrl }}&text={{ $shareTitle }}" target="_blank" rel="noopener noreferrer" class="share-icon-btn x" aria-label="Share on X (Twitter)">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $currentUrl }}&title={{ $shareTitle }}" target="_blank" rel="noopener noreferrer" class="share-icon-btn ln" aria-label="Share on LinkedIn">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                                </a>
                                <a href="mailto:?subject={{ $shareTitle }}&body={{ $currentUrl }}" class="share-icon-btn mail" aria-label="Share via Email">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polygon points="22,6 12,13 2,6"/></svg>
                                </a>
                            </div>

                            <span class="text-muted small">
                                Updated {{ ($page->updated_at instanceof \Carbon\Carbon) ? $page->updated_at->format('M d, Y') : date('M d, Y', strtotime($page->updated_at ?? 'now')) }}
                            </span>
                        </div>
                    </article>

                    {{-- FAQ SECTION --}}
                    @if(!empty($faqItems) && count($faqItems) > 0)
                        <div class="faq-section">
                            <h2 class="faq-title text-center">Frequently Asked Questions</h2>
                            <div class="accordion modern-accordion" id="faqAccordion">
                                @foreach($faqItems as $index => $faq)
                                    @php
                                        $q = $faq['question'] ?? ($faq['title'] ?? null);
                                        $a = $faq['answer'] ?? ($faq['description'] ?? null);
                                    @endphp
                                    @if(!empty($q))
                                        <div class="accordion-item">
                                            <h3 class="accordion-header" id="heading-{{ $loop->index }}">
                                                <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse-{{ $loop->index }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="faqCollapse-{{ $loop->index }}">
                                                    {{ $q }}
                                                </button>
                                            </h3>
                                            <div id="faqCollapse-{{ $loop->index }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="heading-{{ $loop->index }}" data-bs-parent="#faqAccordion">
                                                <div class="accordion-body">
                                                    {!! $a ?? '<p class="text-muted m-0">No answer provided.</p>' !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection
