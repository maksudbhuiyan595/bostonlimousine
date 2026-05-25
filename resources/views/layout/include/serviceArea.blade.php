<style>
    /* --- BRAND COLORS --- */
    :root {
        --brand-gold: #C5A059;
        --brand-gold-dark: #A8883E;
        --brand-dark: #1A1A1A;
        --brand-white: #FFFFFF;
    }

    .cities-section {
        padding: 60px 0;
        background-color: var(--brand-white);
        font-family: 'Poppins', sans-serif;
    }

    /* --- TITLE DESIGN --- */
    .custom-title {
        color: var(--brand-dark);
        font-weight: 800;
        font-size: 2rem;
        text-transform: uppercase;
        text-align: center;
        margin-bottom: 5px;
    }

    .title-underline {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-bottom: 40px;
    }

    .line { width: 40px; height: 2px; background: var(--brand-gold); opacity: 0.5; }
    .star { color: var(--brand-gold); font-size: 12px; }

    /* --- CITIES GRID --- */
    .cities-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        padding: 0 15px;
    }

    .city-link { text-decoration: none !important; }

    .city-card {
        background: #fff;
        border-radius: 12px;
        padding: 12px 15px;
        display: flex;
        align-items: center;
        gap: 12px;
        border: 1px solid rgba(197, 160, 89, 0.2);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        transition: all 0.3s ease;
        height: 100%;
        min-height: 85px; /* ২ লাইনের জন্য হাইট কিছুটা বাড়ানো হয়েছে */
        overflow: hidden;
    }

    .icon-circle {
        width: 38px;
        height: 38px;
        background: rgba(197, 160, 89, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .icon-circle i { color: var(--brand-gold); font-size: 1rem; }

    .city-name {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--brand-dark);
        margin: 0;
        line-height: 1.3;
        flex-grow: 1;

        /* --- 2 LINE LIMIT WITH ELLIPSIS --- */
        display: -webkit-box;
        -webkit-line-clamp: 2; /* ২ লাইনে সীমাবদ্ধ করবে */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        word-break: break-word; /* লম্বা শব্দ ভেঙে দিবে যাতে কার্ডের বাইরে না যায় */
    }

    /* --- HOVER EFFECTS --- */
    .city-link:hover .city-card {
        background-color: var(--brand-gold);
        border-color: var(--brand-gold-dark);
        transform: translateY(-3px);
    }

    .city-link:hover .city-name { color: var(--brand-white); }
    .city-link:hover .icon-circle { background: var(--brand-white); }
    .city-link:hover .icon-circle i { color: var(--brand-gold); }

    /* --- RESPONSIVE (MOBILE 2 CARDS) --- */
    @media (max-width: 991px) {
        .cities-grid { grid-template-columns: repeat(3, 1fr); }
    }

    @media (max-width: 768px) {
        .cities-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
        .custom-title { font-size: 1.6rem; }
    }

    @media (max-width: 480px) {
        .cities-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; padding: 0 10px; }
        .city-card { padding: 10px 12px; min-height: 75px; }
        .city-name { font-size: 0.8rem; }
    }
</style>

<section class="cities-section">
    <div class="container">
        <div class="header-content">
            <h2 class="custom-title">Popular Cities We Serve</h2>
            <div class="title-underline">
                <span class="line"></span>
                <span class="star">✦</span>
                <span class="line"></span>
            </div>
        </div>

        <div class="cities-grid">
            @foreach ($cities as $city)
                <a href="{{ route('dynamic.route', $city->url) }}" class="city-link" title="{{ $city->name }}">
                    <div class="city-card">
                        <div class="icon-circle">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <p class="city-name">{{ $city->name }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
