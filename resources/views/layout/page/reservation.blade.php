@extends('layout.app')

@section('title', $main_page->title ?? "Reserve Boston Taxi to Logan Airport, CT, RI, NH, VT, NY")
@section('meta_description', $main_page->meta_description ?? "Book Boston taxi to Logan Airport...")

@section('content')
    {{-- 1. Simple Hero Content (Form er 1st block onushare) --}}
    @if($main_page && ($main_page->hero_heading || $main_page->hero_subheading))
        <div class="hero-banner" style="background-image: url('{{ $main_page->cover_image ? asset($main_page->cover_image) : asset('images/cab6.png') }}')">
            <div class="container text-center">
                <h1>{{ $main_page->hero_heading }}</h1>
                <p>{{ $main_page->hero_subheading }}</p>
            </div>
        </div>
    @endif

    {{-- Old static includes --}}
    @include('layout.include.booking')
    @include('layout.include.rating')

    {{-- 2. Advanced Dynamic Sections (Form er "Page Blocks" onushare loop) --}}
    @if($main_page && $main_page->content_blocks)
        @foreach($main_page->content_blocks as $block)

            {{-- BLOCK A: Rich Text Body --}}
            @if($block['type'] === 'rich_text' || isset($block['body']))
                <section class="content-rich-text my-5">
                    <div class="container">
                        {!! $block['body'] !!}
                    </div>
                </section>
            @endif

            {{-- BLOCK B: Call to Action Banner --}}
            @if($block['type'] === 'cta' || isset($block['button_text']))
                <section class="content-cta text-center py-5 bg-dark text-white">
                    <div class="container">
                        <h2>{{ $block['title'] ?? 'Ready to Ride?' }}</h2>
                        <a href="{{ $block['button_url'] ?? '#' }}" class="btn btn-warning mt-3">
                            {{ $block['button_text'] ?? 'Book Now' }}
                        </a>
                    </div>
                </section>
            @endif

            {{-- BLOCK C: Image Gallery (Jamon form e car image dewa) --}}
            @if($block['type'] === 'gallery' || isset($block['images']))
                <section class="content-gallery my-5">
                    <div class="container text-center">
                        <div class="row justify-content-center">
                            {{-- Multiple images hole loop hobe, single hole direct image asset --}}
                            @if(is_array($block['images']))
                                @foreach($block['images'] as $img)
                                    <div class="col-md-6">
                                        <img src="{{ asset($img) }}" class="img-fluid rounded shadow" alt="Fleet Image">
                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-8">
                                    <img src="{{ asset($block['images']) }}" class="img-fluid rounded shadow" alt="Fleet Image">
                                </div>
                            @endif
                        </div>
                    </div>
                </section>
            @endif

        @endforeach
    @endif

@endsection
