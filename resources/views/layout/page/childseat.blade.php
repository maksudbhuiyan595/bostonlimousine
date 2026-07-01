```blade
@extends('layout.app')

@section('title', $main_page->title ?? 'Safe Taxi with Child Seats Boston | Boston Express Cab')

@section('meta_description', $main_page->meta_description ?? 'Family-friendly taxi services in Boston with premium child seats, infant seats, and boosters. Professional drivers ensuring safe rides to Logan Airport and beyond. Available 24/7.')

@section('schema')
@endsection

@section('content')

    {{-- Hero Banner --}}
    @if($main_page && ($main_page->cover_image || $main_page->hero_heading))
        <div class="hero-banner"
             style="background-image:url('{{ $main_page->cover_image ? asset($main_page->cover_image) : asset('images/cab6.png') }}');
                    background-size:cover;
                    background-position:center;
                    padding:80px 0;">

            <div class="container text-center text-white">
                <div class="bg-dark bg-opacity-50 p-4 rounded">

                    <h1>
                        {{ $main_page->hero_heading ?? $main_page->title }}
                    </h1>

                    @if(!empty($main_page->hero_subheading))
                        <p class="lead">
                            {{ $main_page->hero_subheading }}
                        </p>
                    @endif

                </div>
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

                    <section class="py-5">
                        <div class="container">
                            {!! $block['data']['body'] ?? '' !!}
                        </div>
                    </section>

                @break


                {{-- CTA Banner --}}
                @case('cta_banner')

                    <section class="py-5 bg-light">
                        <div class="container text-center">

                            @if(!empty($block['data']['title']))
                                <h2>
                                    {{ $block['data']['title'] }}
                                </h2>
                            @endif

                            <a href="{{ $block['data']['button_url'] ?? '#' }}"
                               class="btn btn-primary mt-3">
                                {{ $block['data']['button_text'] ?? 'Book Safe Ride Now' }}
                            </a>

                        </div>
                    </section>

                @break


                {{-- Image Gallery --}}
                @case('image_gallery')

                    <section class="py-5">
                        <div class="container">

                            <div class="row">

                                @foreach($block['data']['images'] ?? [] as $image)

                                    <div class="col-md-4 mb-4">

                                        <img src="{{ asset($image) }}"
                                             class="img-fluid rounded shadow"
                                             alt="Safe Family Car with Child Seat">

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

