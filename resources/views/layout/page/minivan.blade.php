```blade
@extends('layout.app')

@section('title', $main_page->title ?? "Logan Airport Taxi Transfer Boston | 24/7 Reliable Ride")
@section('meta_description', $main_page->meta_description ?? "Safe and reliable Logan Airport taxi transfer service. Affordable rates, child seats available, 24/7 instant booking. Call 617-230-6362.")

@section('schema')
    {{-- Your Schema Here --}}
@endsection

@section('content')

    {{-- Hero Banner --}}
    @if($main_page && ($main_page->cover_image || $main_page->hero_heading))
        <div class="hero-banner"
             style="background-image:url('{{ $main_page->cover_image ? asset($main_page->cover_image) : asset('images/cab6.png') }}');
                    background-size:cover;
                    background-position:center;
                    padding:60px 0;">

            <div class="container text-center text-white"
                 style="background:rgba(0,0,0,.5);padding:30px;border-radius:8px;">

                @if(!empty($main_page->hero_heading))
                    <h1 class="display-4 fw-bold">
                        {{ $main_page->hero_heading }}
                    </h1>
                @endif

                @if(!empty($main_page->hero_subheading))
                    <p class="lead">
                        {{ $main_page->hero_subheading }}
                    </p>
                @endif

            </div>
        </div>
    @endif

    {{-- Booking Form --}}
    @include('layout.include.booking')

    {{-- Rating --}}
    @include('layout.include.rating')

    {{-- Dynamic Content Blocks --}}
    @if($main_page && !empty($main_page->content_blocks))

        @foreach($main_page->content_blocks as $block)

            @switch($block['type'])

                {{-- Rich Text --}}
                @case('rich_text')

                    <section class="block-rich-text my-5">
                        <div class="container">
                            <div class="prose max-w-none">
                                {!! $block['data']['body'] ?? '' !!}
                            </div>
                        </div>
                    </section>

                @break


                {{-- CTA Banner --}}
                @case('cta_banner')

                    <section class="block-cta py-5 bg-light my-5 text-center border-top border-bottom">
                        <div class="container">

                            @if(!empty($block['data']['title']))
                                <h3 class="mb-3">
                                    {{ $block['data']['title'] }}
                                </h3>
                            @endif

                            @if(!empty($block['data']['button_text']))
                                <a href="{{ $block['data']['button_url'] ?? '#' }}"
                                   class="btn btn-primary btn-lg px-4">
                                    {{ $block['data']['button_text'] }}
                                </a>
                            @endif

                        </div>
                    </section>

                @break


                {{-- Image Gallery --}}
                @case('image_gallery')

                    <section class="block-gallery my-5">
                        <div class="container">

                            <div class="row g-4 justify-content-center">

                                @foreach($block['data']['images'] ?? [] as $image)

                                    <div class="col-md-4 col-sm-6">

                                        <div class="card h-100 shadow-sm">

                                            <img src="{{ asset($image) }}"
                                                 class="card-img-top img-fluid rounded"
                                                 alt="Gallery Image">

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>
                    </section>

                @break

            @endswitch

        @endforeach

    @endif

@endsection
```
