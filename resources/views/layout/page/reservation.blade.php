@extends('layout.app')
@section('title', "Reserve Boston Taxi to Logan Airport, CT, RI, NH, VT, NY")
@section('meta_description', "Book Boston taxi to Logan Airport, New Haven, Stamford, Portsmouth & beyond! Safe, 24/7 cabs with child seats, minivans. Instant booking, call 617-230-6362.")

@section('schema')
    @php
        $schemaData = [
            "@context" => "https://schema.org",
            "@type" => "WebPage",
            "name" => "Reserve Boston Taxi to Logan Airport, CT, RI, NH, VT, NY",
            "url" => url()->current() .'/',
            "image" => asset('images/cab6.png'),
            "description" => "Book Boston taxi to Logan Airport, New Haven, Stamford, Portsmouth & beyond! Safe, 24/7 cabs with child seats, minivans. Instant booking, call 617-230-6362.",
            "telephone" => "617-230-6362",
            "priceRange" => "$$",
            "provider" => [
                "@type" => "LocalBusiness",
                "name" => "Boston Express Cab",
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
        /* --- HERO SECTION --- */
        .reservation-hero {
            position: relative;
            width: 100vw;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
            height: 450px;
            background: url('{{ asset('images/cab6.png') }}') no-repeat center center;
            background-size: 100% 100% !important;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
        }

        .hero-overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .hero-content { position: relative; z-index: 2; padding: 0 20px; width: 100%; color: #fff;}
        .hero-subtitle { color: #2D9CDB; font-size: clamp(1rem, 2vw, 1.5rem); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5); }
        .hero-title { color: #ffffff; font-weight: 800; font-size: clamp(1.8rem, 5vw, 3.5rem); margin-bottom: 25px; text-shadow: 0 4px 10px rgba(0, 0, 0, 0.5); }

        @media (max-width: 767px) { .reservation-hero { height: 150px; } }

        /* --- PAGE LAYOUT --- */
        .page-wrapper { padding: 60px 0; background-color: #ffffff; }
        .section-heading { color: #333; font-weight: 800; font-size: 2rem; margin-bottom: 10px; }
        .section-divider { width: 60px; height: 4px; background-color: #2D9CDB; margin-bottom: 30px; }

        /* --- FEATURE CARDS --- */
        .feature-card { background: #f9f9f9; border: 1px solid #eee; border-radius: 10px; padding: 25px; margin-bottom: 25px; transition: all 0.3s ease; height: 100%; }
        .feature-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05); border-top: 4px solid #2D9CDB; }
        .feature-title { color: #2D9CDB; font-weight: 700; font-size: 1.25rem; margin-bottom: 15px; display: flex; align-items: center; gap: 10px; }
        .feature-text { color: #555; font-size: 0.95rem; line-height: 1.6; }

        /* --- HOW TO RESERVE LIST --- */
        .step-list { list-style: none; padding: 0; counter-reset: step-counter; }
        .step-list li { position: relative; padding-left: 50px; margin-bottom: 20px; color: #555; line-height: 1.6; }
        .step-list li::before { counter-increment: step-counter; content: counter(step-counter); position: absolute; left: 0; top: 0; width: 35px; height: 35px; background-color: #2D9CDB; color: white; border-radius: 50%; text-align: center; line-height: 35px; font-weight: bold; }

        /* --- FAQ --- */
        .faq-item { margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 20px; }
        .faq-question { font-weight: 700; color: #333; font-size: 1.1rem; margin-bottom: 10px; }
        .faq-question i { color: #2D9CDB; margin-right: 8px; }
        .faq-answer { color: #666; font-size: 0.95rem; line-height: 1.6; padding-left: 28px; }

        /* --- SIDEBAR --- */
        .sidebar-box { background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #f0f0f0; margin-bottom: 30px; text-align: center; }
        .sidebar-title { font-weight: 700; color: #333; margin-bottom: 20px; font-size: 1.1rem; }
        .trust-img { max-width: 140px; margin: 0 auto 15px; display: block; }
        .contact-widget { background: #2D9CDB; color: white; border-radius: 8px; padding: 25px; }
        .contact-widget a { color: white; font-weight: 800; font-size: 1.3rem; text-decoration: none; }
    </style>

    <div class="reservation-hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h2 class="hero-subtitle">Boston Express Cab Reservation</h2>
            <h1 class="hero-title">Reserve Your Ride with Boston Express Cab</h1>
            {{-- <h1>Boston Express Cab Reservation</h1> --}}
        </div>
    </div>

    @include('layout.include.booking')

    <section class="page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 pr-lg-5">
                    <h2 class="section-heading">Booking a Taxi in Boston Has Never Been Easier</h2>
                    <div class="section-divider"></div>
                    <p class="text-muted mb-5">
                        With Boston Express Cab, you can enjoy a hassle-free and convenient reservation process for all your transportation needs. Whether you’re traveling for business, leisure, or a special event, our professional drivers and well-maintained fleet are here to provide you with a comfortable and reliable ride.
                    </p>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h4 class="feature-title"><i class="fas fa-mouse-pointer"></i> Easy Online Booking</h4>
                                <p class="feature-text">Simply enter your pickup and drop-off locations, select your vehicle, and choose your preferred time. You’ll receive an instant confirmation.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h4 class="feature-title"><i class="fas fa-clock"></i> 24/7 Support</h4>
                                <p class="feature-text">Our customer support team is available around the clock to help you with any questions or concerns about your booking.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h4 class="feature-title"><i class="fas fa-car"></i> Diverse Fleet</h4>
                                <p class="feature-text">From sedans and SUVs to minivans and luxury cars, we have the perfect ride for every occasion and group size.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-card">
                                <h4 class="feature-title"><i class="fas fa-credit-card"></i> Flexible Payment</h4>
                                <p class="feature-text">We accept credit cards, debit cards, and online payment methods for a seamless transaction process.</p>
                            </div>
                        </div>
                    </div>

                    <div class="how-to-reserve mt-5 mb-5">
                        <h2 class="section-heading">How to Reserve</h2>
                        <div class="section-divider"></div>
                        <ul class="step-list">
                            <li><strong>Visit our website:</strong> Head to our reservation page and fill out the booking form with your details.</li>
                            <li><strong>Choose your vehicle:</strong> Select the type of vehicle that suits your needs from our diverse fleet.</li>
                            <li><strong>Select your time:</strong> Pick your desired pickup time to match your schedule.</li>
                            <li><strong>Confirm your booking:</strong> Review your details and confirm. You’ll receive an instant confirmation via email.</li>
                        </ul>
                    </div>

                    <div class="faq-container mt-5">
                        <h2 class="section-heading">Frequently Asked Questions</h2>
                        <div class="section-divider"></div>

                        <div class="faq-item">
                            <div class="faq-question"><i class="fas fa-question-circle"></i> How can I book a taxi?</div>
                            <div class="faq-answer">You can easily book through our website at bostonexpresscab.com or via phone at 617-230-6362.</div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question"><i class="fas fa-baby"></i> Do you provide child seats?</div>
                            <div class="faq-answer">Yes, we offer secure and comfortable child seats upon request to ensure the safety of your little ones.</div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question"><i class="fas fa-calendar-check"></i> Can I modify or cancel my reservation?</div>
                            <div class="faq-answer">Yes, you can. Please refer to our cancellation policy on the website or contact our support team for assistance.</div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-question"><i class="fas fa-clock"></i> Do you offer hourly services?</div>
                            <div class="faq-answer">Yes, we offer flexible hourly services to meet your specific needs. You can book for a set number of hours for added convenience.</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar-box p-0 border-0">
                        <div class="contact-widget">
                            <h5>Book via Phone</h5>
                            <a href="tel:6172306362">617-230-6362</a>
                            <p class="mt-2 small">Available 24/7 for support</p>
                        </div>
                    </div>

                    <div class="sidebar-box">
                        <h5 class="sidebar-title">Why Choose Us?</h5>
                        <ul class="text-left small mb-4">
                            <li>Instant Confirmation</li>
                            <li>Professional Drivers</li>
                            <li>24/7 Service</li>
                            <li>Special Requests Accommodated</li>
                        </ul>
                        <img src="{{ asset('images/Google-Rating-1.jpeg') }}" class="trust-img">
                        <img src="{{ asset('images/Trustpilot.jpeg') }}" class="trust-img">
                        <img src="{{ asset('images/Limotrust-1.webp') }}" class="trust-img">
                        <img src="{{ asset('images/Tripadvisor.webp') }}" class="trust-img">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
