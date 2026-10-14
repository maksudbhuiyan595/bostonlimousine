@extends('layout.app')

@php
    $thumbnailUrl = $blog->thumbnail
        ? asset('storage/' . $blog->thumbnail)
        : asset('images/car-2.png');

    $tagData = is_array($blog->tags)
        ? $blog->tags
        : array_filter(array_map('trim', explode(',', $blog->tags ?? '')));

    $keywords = !empty($tagData)
        ? implode(', ', $tagData)
        : 'Logan Airport Transfer, airport taxi, car service Boston, Woburn taxi';

    $category = !empty($tagData[0]) ? $tagData[0] : 'Travel Blog';
    $metaDescription = $blog->meta_description ?? Str::limit(strip_tags($blog->content), 160);

    $currentUrl = urlencode(url()->current());
    $shareTitle = urlencode($blog->title);
@endphp

{{-- SEO Meta Tags (Direct values to avoid ">" display bug) --}}
@section('title', $blog->meta_title ?? ($blog->title . ' | Logan Airport Transfer'))
@section('meta_description', $metaDescription)
@section('meta_keywords', $keywords)
@section('og_image', $thumbnailUrl)

{{-- 2. SCHEMA SECTION --}}
@section('schema')
    @php
        $blogSchemaData = [
            "@context" => "https://schema.org",
            "@type" => "BlogPosting",
            "headline" => $blog->title,
            "image" => [
                $thumbnailUrl
            ],
            "datePublished" => $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->toIso8601String() : $blog->created_at->toIso8601String(),
            "dateModified" => $blog->updated_at ? \Carbon\Carbon::parse($blog->updated_at)->toIso8601String() : $blog->created_at->toIso8601String(),
            "description" => $metaDescription,
            "mainEntityOfPage" => [
                "@type" => "WebPage",
                "@id" => url()->current()
            ],
            "author" => [
                "@type" => "Organization",
                "name" => "Logan Airport Transfer",
                "url" => url('/')
            ],
            "publisher" => [
                "@type" => "LocalBusiness",
                "name" => "Logan Airport Transfer",
                "image" => asset('images/car-2.png'),
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
            ]
        ];
    @endphp
    <script type="application/ld+json">
        {!! json_encode($blogSchemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            {{-- Category / Label --}}
            <div class="mb-3">
                <span class="blog-category-badge">{{ $category }}</span>
            </div>

            {{-- Title --}}
            <h1 class="mb-3" style="font-weight: 800; line-height: 1.2; color: #1e293b;">{{ $blog->title }}</h1>

            {{-- Post Info --}}
            <div class="text-muted mb-4 pb-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="d-flex align-items-center">
                    <i class="fas fa-car-side me-2"></i>
                    <span>By Logan Airport Transfer</span>
                </div>
                <div class="d-flex align-items-center">
                    <i class="far fa-calendar-alt me-2"></i>
                    <span>{{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('F d, Y') : $blog->created_at->format('F d, Y') }}</span>
                </div>
            </div>

            {{-- Featured Image --}}
            @if($blog->thumbnail)
                <div class="mb-4 shadow-sm rounded overflow-hidden">
                    <img src="{{ $thumbnailUrl }}" alt="{{ $blog->title }}" class="img-fluid w-100">
                </div>
            @endif

            {{-- Main Body --}}
            <div class="blog-text" style="font-size: 1.15rem; line-height: 1.8; color: #334155;">
                {!! $blog->content !!}
            </div>

            {{-- Tags Section --}}
            @if(!empty($tagData))
                <hr class="my-5">
                <div class="mb-4">
                    <span class="me-2 text-muted fw-bold">Tags:</span>
                    @foreach($tagData as $tag)
                        @if(trim($tag))
                            <a href="{{ url('/search?tag=' . urlencode(trim($tag))) }}" class="badge bg-light text-dark border me-1 px-3 py-2 text-decoration-none">
                                #{{ trim($tag) }}
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif

            {{-- Social Share & Action Buttons --}}
            <div class="share-and-nav-wrapper d-flex flex-wrap justify-content-between align-items-center pt-4 border-top mt-5 gap-3">

                {{-- Back to list button --}}
                <a href="{{ route('blogs') }}" class="btn btn-outline-dark px-4 py-2">
                    <i class="fas fa-arrow-left me-2"></i> Back to Blog List
                </a>

                {{-- Social Share Bar --}}
                <div class="d-flex align-items-center flex-wrap">
                    <span class="fw-bold me-3 text-secondary">Share:</span>
                    <div class="social-share-group d-flex align-items-center">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $currentUrl }}" target="_blank" rel="noopener noreferrer" class="social-share-btn fb" aria-label="Share on Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ $currentUrl }}&text={{ $shareTitle }}" target="_blank" rel="noopener noreferrer" class="social-share-btn x" aria-label="Share on X">
                            <i class="fab fa-x-twitter"></i>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $currentUrl }}&title={{ $shareTitle }}" target="_blank" rel="noopener noreferrer" class="social-share-btn ln" aria-label="Share on LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?text={{ $shareTitle }}%20{{ $currentUrl }}" target="_blank" rel="noopener noreferrer" class="social-share-btn wa" aria-label="Share on WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="mailto:?subject={{ $shareTitle }}&body={{ $currentUrl }}" class="social-share-btn mail" aria-label="Share via Email">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<style>
    .blog-category-badge {
        display: inline-block;
        background-color: rgba(185, 146, 75, 0.12); /* হালকা গোল্ড ব্যাকগ্রাউন্ড */
        color: #B9924B;                                /* ব্র্যান্ড গোল্ড কালার */
        border: 1px solid rgba(185, 146, 75, 0.25);
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        padding: 6px 16px;
        border-radius: 50px;
        transition: all 0.2s ease;
    }
    /* Content Typography Styling */
    .blog-text p { margin-bottom: 1.6rem; }
    .blog-text h2, .blog-text h3 {
        margin-top: 2.5rem;
        margin-bottom: 1.2rem;
        font-weight: 700;
        color: #1e293b;
    }
    .blog-text img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 25px 0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .blog-text ul, .blog-text ol { margin-bottom: 1.6rem; padding-left: 1.5rem; }
    .blog-text li { margin-bottom: 0.5rem; }

    /* Social Share Buttons */
    .social-share-btn {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background-color: #f1f5f9;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #475569;
        text-decoration: none;
        margin-left: 8px;
        transition: all 0.25s ease;
        border: 1px solid #e2e8f0;
    }

    .social-share-btn:hover {
        color: #ffffff !important;
        transform: translateY(-2px);
    }

    .social-share-btn.fb:hover { background-color: #1877F2; border-color: #1877F2; }
    .social-share-btn.x:hover { background-color: #000000; border-color: #000000; }
    .social-share-btn.ln:hover { background-color: #0A66C2; border-color: #0A66C2; }
    .social-share-btn.wa:hover { background-color: #25D366; border-color: #25D366; }
    .social-share-btn.mail:hover { background-color: #ea4335; border-color: #ea4335; }

    @media (max-width: 768px) {
        .blog-text { font-size: 1.05rem; }
        h1 { font-size: 1.8rem; }
        .share-and-nav-wrapper {
            flex-direction: column-reverse;
            align-items: flex-start !important;
        }
        .social-share-btn {
            margin-left: 0;
            margin-right: 8px;
        }
    }
</style>
@endsection
