<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>
    :root {
        --brand-accent: #b9924b;
        --brand-dark: #0a2b3e;
    }

    body {
        margin: 0;
        font-family: 'Inter', sans-serif;
    }

    /* HERO BANNER */
    .hero-banner {
        position: relative;
        width: 100%;
        min-height: 90vh;
        background-image: url('{{ asset('images/new-3.webp') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        isolation: isolate;
        overflow: hidden;
    }

    /* Premium Overlay */
    .hero-banner::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(105deg,
            rgba(10, 43, 62, 0.9) 0%,
            rgba(10, 43, 62, 0.7) 50%,
            rgba(185, 146, 75, 0.15) 100%);
        z-index: 1;
    }

    /* Bottom Decorative Gradient */
    .hero-banner::after {
        content: "";
        position: absolute;
        bottom: 0;
        right: 0;
        width: 100%;
        height: 40%;
        background: linear-gradient(to top, rgba(10, 43, 62, 0.8), transparent);
        z-index: 1;
    }

    .banner-container {
        position: relative;
        z-index: 3;
        max-width: 1300px;
        width: 100%;
        margin: 0 auto;
        padding: 0 40px;
    }

    .banner-content {
        max-width: 750px;
        animation: fadeInUp 0.9s ease-out forwards;
    }

    .banner-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(185, 146, 75, 0.15);
        padding: 10px 22px;
        border-radius: 50px;
        font-size: 0.85rem;
        color: var(--brand-accent);
        margin-bottom: 24px;
        border: 1px solid rgba(185, 146, 75, 0.4);
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    h1 {
        font-family: 'Playfair Display', serif;
        font-size: 4.2rem;
        line-height: 1.1;
        color: #fff;
        margin-bottom: 20px;
    }

    .gold-split {
        color: var(--brand-accent);
        display: block; /* মোবাইলে আলাদা লাইনে দেখাবে */
    }

    .banner-description {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 35px;
        line-height: 1.6;
        max-width: 600px;
    }

    /* Buttons */
    .btn-group {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .btn-gold {
        background: var(--brand-accent);
        color: #fff;
        padding: 16px 35px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px rgba(185, 146, 75, 0.3);
    }

    .btn-gold:hover {
        background: #9c7b3d;
        transform: translateY(-3px);
        box-shadow: 0 15px 25px rgba(185, 146, 75, 0.4);
    }

    .btn-outline {
        border: 2px solid white;
        padding: 14px 30px;
        border-radius: 50px;
        color: white;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .btn-outline:hover {
        background: white;
        color: var(--brand-dark);
    }

    /* Trust Badges */
    .trust-badges {
        margin-top: 50px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .badge-modern {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(5px);
        padding: 10px 20px;
        border-radius: 12px;
        color: white;
        font-size: 0.9rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .badge-modern i {
        color: var(--brand-accent);
    }
    /* Button Hover Update */
    .btn-gold:hover {
        background: #9c7b3d;
        color: #fff !important; /* হোভার করলে টেক্সট সাদা হবে */
        transform: translateY(-3px);
        box-shadow: 0 15px 25px rgba(185, 146, 75, 0.4);
    }

    /* বাটনের ভেতরের আইকন যাতে হোভারে সাদা থাকে তা নিশ্চিত করতে */
    .btn-gold:hover i {
        color: #fff !important;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px);}
        to { opacity: 1; transform: translateY(0);}
    }

    /* RESPONSIVE FIXES */
    @media (max-width: 992px) {
        h1 { font-size: 3.2rem; }
    }

    @media (max-width: 768px) {
        .hero-banner {
            background-attachment: scroll;
            min-height: 80vh;
            padding-top: 60px;
        }

        .banner-container {
            padding: 0 25px;
        }

        h1 {
            font-size: 2.5rem;
        }

        .banner-description {
            font-size: 1rem;
        }

        .btn-group {
            flex-direction: column;
        }

        .btn-gold, .btn-outline {
            width: 100%;
            text-align: center;
            justify-content: center;
        }

        .trust-badges {
            gap: 10px;
        }

        .badge-modern {
            width: calc(50% - 10px);
            font-size: 0.75rem;
            padding: 8px 12px;
        }
    }
</style>

<section class="hero-banner">
    <div class="banner-container">
        <div class="banner-content">

            <div class="banner-eyebrow">
                <i class="fas fa-crown"></i>Logan Car Service
            </div>

            <h1>
                Boston Airport <br>
                <span class="gold-split">Car Service</span>
            </h1>

            <div class="banner-description">
                Experience luxury, reliability, and punctuality with our premium Logan airport transfers and executive chauffeur services. Available 24/7.
            </div>

            <div class="btn-group">
                <a href="{{ route('home') }}" class="btn-gold">
                    <i class="fas fa-calendar-check"></i> Book Now
                </a>
                <a href="tel:+16175558888" class="btn-outline">
                    <i class="fas fa-phone-alt me-2"></i>857-777-2125
                </a>
            </div>

            <div class="trust-badges">
                <div class="badge-modern"><i class="fas fa-plane-arrival"></i> Flight Tracking</div>
                <div class="badge-modern"><i class="fas fa-shield-alt"></i> Safe & Insured</div>
                <div class="badge-modern"><i class="fas fa-clock"></i> 24/7 Availability</div>
                <div class="badge-modern"><i class="fas fa-user-check"></i> Meet & Greet</div>
            </div>

        </div>
    </div>
</section>
