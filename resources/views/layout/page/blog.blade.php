@extends('layout.app')

@section('title', "Blogs | Boston Logan Airport Car Service")

@section('meta_description',"Professional Boston Logan Airport car service. Reliable transport to and from Logan Airport. Fast, safe, and 24/7 professional airport transfers. Book your airport ride now!")

@section('schema')
    @php
        $schemaData = [
            "@context" => "https://schema.org",
            "@type" => "Article",
            "name" => "Blogs | Boston Logan Airport Car Service",
            "url" => url()->current() .'/',
            "logo" => asset('images/Boston Express Cab Logo.png'),
            "description" => "Reliable Boston Logan Airport car service. Professional 24/7 transport for airport transfers, individuals, and groups.",
            "telephone" => "617-230-6362",
            "priceRange" => "$$",
            "provider" => [
                "@type" => "LocalBusiness",
                "name" => "Boston Logan Airport Car Service",
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
<style>
    /* --- PREMIUM AMBER COLOR SCHEME (#B9924B) --- */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap');

    .blog-section {
        padding: 80px 0;
        background: linear-gradient(135deg, #F9FAFB 0%, #F0F4F8 100%);
        font-family: 'Inter', sans-serif;
    }

    /* --- HEADER --- */
    .section-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 15px;
        letter-spacing: -0.5px;
    }

    .title-line {
        width: 70px;
        height: 4px;
        background: linear-gradient(90deg, #B9924B, #8B6B2E);
        margin: 0 auto;
        border-radius: 2px;
    }

    .section-subtitle {
        color: #6B7280;
        margin-top: 15px;
        font-size: 1rem;
    }

    /* --- RESPONSIVE GRID --- */
    .blog-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 30px;
    }

    @media (min-width: 992px) {
        .blog-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* --- CARD DESIGN --- */
    .blog-card {
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
    }

    .blog-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 20px 30px -10px rgba(185, 146, 75, 0.15);
        border-color: #B9924B;
    }

    .blog-img-wrapper {
        position: relative;
        height: 240px;
        overflow: hidden;
        background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
    }

    .blog-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .blog-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: linear-gradient(135deg, #B9924B 0%, #8B6B2E 100%);
        color: white;
        padding: 5px 14px;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 700;
        z-index: 2;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .blog-content {
        padding: 25px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .blog-date {
        font-size: 0.8rem;
        color: #94a3b8;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .blog-date i { color: #B9924B; }

    .blog-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1e293b;
        text-decoration: none;
        margin-bottom: 12px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.2s ease;
    }

    .blog-title:hover { color: #B9924B; }

    .blog-excerpt {
        font-size: 0.9rem;
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 20px;
        flex-grow: 1;
    }

    .blog-footer {
        padding-top: 15px;
        border-top: 1px solid #f1f5f9;
    }

    .read-more {
        color: #B9924B;
        font-weight: 700;
        text-decoration: none;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
    }

    .read-more:hover {
        color: #8B6B2E;
        gap: 12px;
    }

    /* --- PAGINATION --- */
    .pagination-wrapper {
        margin-top: 50px;
        display: flex;
        justify-content: center;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #B9924B 0%, #8B6B2E 100%);
        border-color: #B9924B;
        color: white;
    }

    @media (max-width: 768px) {
        .blog-section { padding: 50px 0; }
        .section-title { font-size: 1.8rem; }
    }
</style>

<section class="blog-section">
    <div class="container">

        {{-- Section Header --}}
        <div class="section-header">
            <h2 class="section-title">Boston Logan Airport Travel Blog</h2>
            <div class="title-line"></div>
            <p class="section-subtitle">
                <i class="fas fa-plane-arrival me-2" style="color: #B9924B;"></i>
                Logan Airport updates, travel tips, and transport guides from the experts.
            </p>
        </div>

        {{-- Blog Grid --}}
        <div class="blog-grid">
            @forelse($blogs as $blog)
                <article class="blog-card">
                    <div class="blog-img-wrapper">
                        @php
                            $tags = $blog->tags;
                            if (!is_array($tags)) {
                                $tags = !empty($tags) ? explode(',', $tags) : [];
                            }
                            $firstTag = count($tags) > 0 ? trim($tags[0]) : 'Airport News';
                        @endphp

                        <span class="blog-badge">
                            <i class="fas fa-plane me-1" style="font-size: 0.6rem;"></i>
                            {{ $firstTag }}
                        </span>

                        <img src="{{ $blog->thumbnail ? asset('storage/' . $blog->thumbnail) : asset('images/blog-default.jpg') }}"
                             alt="{{ $blog->title }}"
                             class="blog-img"
                             loading="lazy">
                    </div>

                    <div class="blog-content">
                        <div class="blog-date">
                            <i class="far fa-calendar-alt"></i>
                            {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('M d, Y') : $blog->created_at->format('M d, Y') }}
                        </div>

                        <a href="{{ route('dynamic.route', $blog->slug) }}" class="blog-title">
                            {{ $blog->title }}
                        </a>

                        <p class="blog-excerpt">
                            {{ Str::limit(strip_tags($blog->content), 120) }}
                        </p>

                        <div class="blog-footer">
                            <a href="{{ route('dynamic.route', $blog->slug) }}" class="read-more">
                                Read More <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    <i class="fas fa-plane-slash"></i>
                    <h4>No Logan Airport updates found</h4>
                    <p class="text-muted">Stay tuned for the latest airport transport news!</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($blogs->hasPages())
            <div class="pagination-wrapper">
                {{ $blogs->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>
</section>
@endsection
