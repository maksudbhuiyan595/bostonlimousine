@extends('layout.app')

@section('title', $main_page->title ?? 'Reserve Boston Taxi to Logan Airport, CT, RI, NH, VT, NY')
@section('meta_description', $main_page->meta_description ?? 'Book Boston taxi to Logan Airport...')

@section('content')

    {{-- Hero Banner --}}
    @if($main_page && ($main_page->hero_heading || $main_page->hero_subheading))
        <div class="hero-banner"
            style="background-image: url('{{ $main_page->cover_image ? asset($main_page->cover_image) : asset('images/cab6.png') }}')">
            <div class="container text-center">
                <h1>{{ $main_page->hero_heading }}</h1>
                <p>{{ $main_page->hero_subheading }}</p>
            </div>
        </div>
    @endif

    {{-- Static Sections --}}
    @include('layout.include.booking')
    @include('layout.include.rating')

    @dd($main_page)
    {{-- Dynamic Content Blocks --}}
    @if($main_page && !empty($main_page->content_blocks))

        @foreach($main_page->content_blocks as $block)

            @switch($block['type'])

                {{-- Rich Text --}}
                @case('rich_text')
                    <section class="content-rich-text py-5">
                        <div class="container">
                            {!! $block['data']['body'] ?? '' !!}
                        </div>
                    </section>
                @break


                {{-- CTA Banner --}}
                @case('cta_banner')
                    <section class="content-cta py-5 bg-dark text-white text-center">
                        <div class="container">

                            @if(!empty($block['data']['title']))
                                <h2>{{ $block['data']['title'] }}</h2>
                            @endif

                            @if(!empty($block['data']['button_text']))
                                <a href="{{ $block['data']['button_url'] ?? '#' }}"
                                   class="btn btn-warning mt-3">
                                    {{ $block['data']['button_text'] }}
                                </a>
                            @endif

                        </div>
                    </section>
                @break


                {{-- Image Gallery --}}
                @case('image_gallery')
                    <section class="content-gallery py-5">
                        <div class="container">
                            <div class="row justify-content-center">

                                @foreach($block['data']['images'] ?? [] as $image)
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <img
                                            src="{{ asset($image) }}"
                                            class="img-fluid rounded shadow"
                                            alt="Gallery Image">
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
