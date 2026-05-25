@extends('layout.app')

{{-- SEO Meta Tags --}}
@section('title', $blog->meta_title ?? ($blog->title . ' | Boston Car Service'))

@section('meta')
    <meta name="description" content="{{ $blog->meta_description ?? Str::limit(strip_tags($blog->content), 160) }}">

    {{-- Tags Handling --}}
    @php
        $keywords = is_array($blog->tags) ? implode(', ', $blog->tags) : ($blog->tags ?? 'blog, car service, Boston, airport transport');
    @endphp
    <meta name="keywords" content="{{ $keywords }}">
@endsection



@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-8">

            {{-- Category / Label --}}
            <div class="mb-2">
                @php
                    $tagData = is_array($blog->tags) ? $blog->tags : explode(',', $blog->tags ?? '');
                    $category = !empty($tagData[0]) ? trim($tagData[0]) : 'Travel Insights';
                @endphp
                <span class="text-primary fw-bold text-uppercase small">{{ $category }}</span>
            </div>

            {{-- Title --}}
            <h1 class="mb-3" style="font-weight: 800; line-height: 1.2; color: #1e293b;">{{ $blog->title }}</h1>

            {{-- Post Info --}}
            <div class="text-muted mb-4 pb-3 border-bottom d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-car-side me-2"></i>
                    <span>By Boston Car Service</span>
                </div>
                <div class="d-flex align-items-center">
                    <i class="far fa-calendar-alt me-2"></i>
                    <span>{{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('F d, Y') : $blog->created_at->format('F d, Y') }}</span>
                </div>
            </div>

            {{-- Featured Image --}}
            @if($blog->thumbnail)
                <div class="mb-4 shadow-sm rounded overflow-hidden">
                    <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->title }}" class="img-fluid w-100">
                </div>
            @endif

            {{-- Main Body --}}
            <div class="blog-text" style="font-size: 1.15rem; line-height: 1.8; color: #334155;">
                {!! $blog->content !!}
            </div>

            {{-- Tags Section --}}
            <hr class="my-5">

            @if(!empty($tagData) && $tagData[0] !== "")
                <div class="mb-4">
                    <span class="me-2 text-muted fw-bold">Tags:</span>
                    @foreach($tagData as $tag)
                        @if(trim($tag))
                            <span class="badge bg-light text-dark border me-1 px-3 py-2">{{ trim($tag) }}</span>
                        @endif
                    @endforeach
                </div>
            @endif

            {{-- Action Buttons --}}
            <div class="d-flex justify-content-between align-items-center mt-5">
                <a href="{{ route('blogs') }}" class="btn btn-outline-dark px-4">
                    <i class="fas fa-arrow-left me-2"></i> Back to Blog List
                </a>
            </div>

        </div>
    </div>
</div>

<style>
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

    @media (max-width: 768px) {
        .blog-text { font-size: 1.05rem; }
        h1 { font-size: 1.8rem; }
    }
</style>
@endsection
