@extends('layout.app')

{{-- ১. ডাইনামিক বা ফলব্যাক মেটা ডাটা (Child Seat & Family Safety Context) --}}
@section('title', $main_page->title ?? 'Safe Taxi with Child Seats Boston | Boston Express Cab')

@section('meta_description', $main_page->meta_description ?? 'Family-friendly taxi services in Boston with premium child seats, infant seats, and boosters. Professional drivers ensuring safe rides to Logan Airport and beyond. Available 24/7.')

@section('schema')
@endsection

@section('content')

{{-- ২. ডাইনামিক হিরো ব্যানার --}}
@if($main_page && ($main_page->cover_image || $main_page->hero_heading))
<div class="hero-banner"
     style="background-image:url('{{ asset('storage/'.$main_page->cover_image) }}');
            background-size:cover;
            background-position:center;
            padding:80px 0;">
    <div class="container text-center text-white">
        <div class="bg-dark bg-opacity-50 p-4 rounded">
            <h1>{{ $main_page->hero_heading ?? $main_page->title }}</h1>

            @if($main_page->hero_subheading)
                <p class="lead">{{ $main_page->hero_subheading }}</p>
            @endif
        </div>
    </div>
</div>
@endif

{{-- ৩. বুকিং ফর্ম ও রেটিং সেকশন --}}
@include('layout.include.booking')
@include('layout.include.rating')

{{-- ৪. এডভান্সড ডাইনামিক সেকশনস (Filament Repeater Blocks) --}}
@if($main_page && $main_page->content_blocks)

    @foreach($main_page->content_blocks as $block)

        {{-- ক) Rich Text Body Block --}}
        @if(($block['type'] ?? '') === 'rich_text')
            <section class="py-5">
                <div class="container">
                    {!! $block['data']['body'] ?? '' !!}
                </div>
            </section>
        @endif

        {{-- খ) Call to Action Banner Block --}}
        @if(($block['type'] ?? '') === 'cta')
            <section class="py-5 bg-light">
                <div class="container text-center">
                    <h2>{{ $block['data']['title'] ?? '' }}</h2>

                    <a href="{{ $block['data']['button_url'] ?? '#' }}"
                       class="btn btn-primary mt-3">
                        {{ $block['data']['button_text'] ?? 'Book Safe Ride Now' }}
                    </a>
                </div>
            </section>
        @endif

        {{-- গ) Image Gallery Block (গাড়ি ও চাইল্ড সিটের ইমেজের জন্য) --}}
        @if(($block['type'] ?? '') === 'gallery')
            <section class="py-5">
                <div class="container">
                    <div class="row">
                        @foreach(($block['data']['images'] ?? []) as $image)
                            <div class="col-md-4 mb-4">
                                <img src="{{ asset('storage/'.$image) }}"
                                     class="img-fluid rounded shadow"
                                     alt="Safe Family Car with Child Seat">
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

    @endforeach

@endif

@endsection
