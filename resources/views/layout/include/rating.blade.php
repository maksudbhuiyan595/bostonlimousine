<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    html, body {
        max-width: 100%;
        overflow-x: hidden;
    }

    .ratings-section {
        background: #FFFFFF;
        border: none !important;
        padding: 45px 20px;
        width: 100%;
        box-sizing: border-box;
    }


    .ratings-container {
        width: 100%;
        max-width: 1320px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        align-items: center;
        justify-content: space-between;
        gap: 40px; /* ডেস্কটপে ৪০ পিক্সেল গ্যাপ */
        box-sizing: border-box;
    }

    .rating-badge {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: #1F2937;
        text-align: center;
        width: 100%;
        min-width: 0;
        box-sizing: border-box;
        transition: transform 0.25s ease;
    }

    .rating-badge:hover {
        transform: translateY(-3px);
    }

    .sub-badge-title {
        font-size: 13px;
        color: #4B5563;
        font-weight: 600;
        margin-bottom: 5px;
        line-height: 1.1;
        white-space: nowrap;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .brand-logo-wrap {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 48px;
        max-width: 100%;
    }

    /* 1. Google */
    .brand-google {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        font-size: 40px;
        font-weight: 700;
        letter-spacing: -1.5px;
        line-height: 1;
        white-space: nowrap;
    }
    .brand-google .g-blue   { color: #4285F4; }
    .brand-google .g-red    { color: #EA4335; }
    .brand-google .g-yellow { color: #FBBC05; }
    .brand-google .g-green  { color: #34A853; }

    /* 2. Tripadvisor */
    .brand-tripadvisor {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 26px;
        font-weight: 800;
        color: #000000;
        letter-spacing: -0.5px;
        white-space: nowrap;
    }
    .ta-icon-circle {
        width: 34px;
        height: 34px;
        background: #00AF87;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #000;
        font-size: 17px;
        flex-shrink: 0;
    }

    /* 3. Trustpilot */
    .brand-trustpilot {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 26px;
        font-weight: 800;
        color: #111827;
        white-space: nowrap;
    }
    .tp-star-logo {
        color: #00B67A;
        font-size: 30px;
        flex-shrink: 0;
    }

    /* 4. Yelp */
    .brand-yelp {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 40px;
        font-weight: 900;
        color: #111827;
        letter-spacing: -1px;
        white-space: nowrap;
    }
    .yelp-icon {
        color: #D32323;
        font-size: 28px;
        flex-shrink: 0;
    }

    /* রেটিং ইনফো টেক্সট ও স্টার */
    .badge-info {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        margin-top: 8px;
        font-size: 14px;
        color: #374151;
        font-weight: 700;
        white-space: nowrap;
    }

    .stars-gold {
        color: #FBBC05;
        font-size: 15px;
        display: inline-flex;
        gap: 1.5px;
    }
    .stars-yelp {
        color: #D32323;
        font-size: 15px;
        display: inline-flex;
        gap: 1.5px;
    }

    .tp-star-boxes {
        display: flex;
        gap: 2.5px;
        margin-top: 8px;
    }
    .tp-box {
        background: #00B67A;
        width: 21px;
        height: 21px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #FFFFFF;
        font-size: 11px;
        border-radius: 2px;
    }

    .ta-dots {
        display: inline-flex;
        gap: 3px;
    }
    .ta-dot {
        width: 9px;
        height: 9px;
        background: #00AF87;
        border-radius: 50%;
    }

    /* -------- ট্যাবলেট অপটিমাইজেশন (max-width: 991px) -------- */
    @media (max-width: 991.98px) {
        .ratings-container {
            gap: 15px;
        }
        .brand-google, .brand-yelp { font-size: 26px; }
        .brand-tripadvisor, .brand-trustpilot { font-size: 17px; }
        .ta-icon-circle { width: 22px; height: 22px; font-size: 11px; }
        .tp-star-logo, .yelp-icon { font-size: 18px; }
        .badge-info { font-size: 11px; gap: 3px; }
        .stars-gold, .stars-yelp { font-size: 11px; }
        .tp-box { width: 15px; height: 15px; font-size: 8px; }
        .ta-dot { width: 6px; height: 6px; }
    }

    /* -------- মোবাইল স্ক্রিন: ১ সারিতে ফিট (No Scroll, Single Row) -------- */
    @media (max-width: 767.98px) {
        .ratings-section {
            padding: 18px 6px;
        }
        .ratings-container {
            gap: 4px; /* ৪টি আইটেম পাশাপাশি রাখতে সামান্য ফাঁকা জায়গা */
        }
        .sub-badge-title {
            font-size: 7.5px;
            margin-bottom: 2px;
            letter-spacing: 0;
        }
        .brand-logo-wrap {
            min-height: 22px;
        }
        .brand-google, .brand-yelp {
            font-size: 15px;
            letter-spacing: -0.3px;
        }
        .brand-tripadvisor, .brand-trustpilot {
            font-size: 9.5px;
            gap: 2px;
        }
        .ta-icon-circle {
            width: 13px;
            height: 13px;
            font-size: 7px;
        }
        .tp-star-logo, .yelp-icon {
            font-size: 10px;
        }
        .badge-info {
            font-size: 7.5px;
            margin-top: 3px;
            gap: 1px;
        }
        .stars-gold, .stars-yelp {
            font-size: 7px;
            gap: 0.5px;
        }
        .tp-star-boxes {
            gap: 1px;
            margin-top: 3px;
        }
        .tp-box {
            width: 9px;
            height: 9px;
            font-size: 5px;
        }
        .ta-dot {
            width: 4px;
            height: 4px;
        }
    }

    /* একদম ছোট স্ক্রিন (<= 360px) */
    @media (max-width: 360px) {
        .ratings-container { gap: 2px; }
        .brand-google, .brand-yelp { font-size: 13px; }
        .brand-tripadvisor, .brand-trustpilot { font-size: 8.5px; }
        .badge-info { font-size: 6.5px; }
        .sub-badge-title { font-size: 6.5px; }
    }
        @media (min-width: 1400px) {
        .container,
        .container-lg,
        .container-md,
        .container-sm,
        .container-xl,
        .container-xxl {
            max-width: 1320px !important;
        }
    }
</style>

<section class="ratings-section">
    <div class="ratings-container">

        <!-- 1. Google -->
        <a href="#" target="_blank" class="rating-badge">
            <span class="sub-badge-title">Top Ratings</span>
            <div class="brand-logo-wrap">
                <span class="brand-google">
                    <span class="g-blue">G</span><span class="g-red">o</span><span class="g-yellow">o</span><span class="g-blue">g</span><span class="g-green">l</span><span class="g-red">e</span>
                </span>
            </div>
            <div class="badge-info">
                <span>5.0</span>
                <span class="stars-gold">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </span>
                <span>(73)</span>
            </div>
        </a>

        <!-- 2. Tripadvisor -->
        <a href="#" target="_blank" class="rating-badge">
            <span class="sub-badge-title">Recommended</span>
            <div class="brand-logo-wrap">
                <div class="brand-tripadvisor">
                    <span class="ta-icon-circle"><i class="fas fa-eye"></i></span>
                    <span>Tripadvisor</span>
                </div>
            </div>
            <div class="badge-info">
                <span class="ta-dots">
                    <span class="ta-dot"></span><span class="ta-dot"></span><span class="ta-dot"></span><span class="ta-dot"></span><span class="ta-dot"></span>
                </span>
                <span>4.9 (36)</span>
            </div>
        </a>

        <!-- 3. Trustpilot -->
        <a href="#" target="_blank" class="rating-badge">
            <span class="sub-badge-title">Verified Reviews</span>
            <div class="brand-logo-wrap">
                <div class="brand-trustpilot">
                    <i class="fas fa-star tp-star-logo"></i>
                    <span>Trustpilot</span>
                </div>
            </div>
            <div class="tp-star-boxes">
                <div class="tp-box"><i class="fas fa-star"></i></div>
                <div class="tp-box"><i class="fas fa-star"></i></div>
                <div class="tp-box"><i class="fas fa-star"></i></div>
                <div class="tp-box"><i class="fas fa-star"></i></div>
                <div class="tp-box"><i class="fas fa-star"></i></div>
            </div>
            <div class="badge-info">
                <span>4.8 | 45</span>
            </div>
        </a>

        <!-- 4. Yelp -->
        <a href="#" target="_blank" class="rating-badge">
            <span class="sub-badge-title">Find Us On</span>
            <div class="brand-logo-wrap">
                <div class="brand-yelp">
                    <span>yelp</span>
                    <i class="fab fa-yelp yelp-icon"></i>
                </div>
            </div>
            <div class="badge-info">
                <span>5.0</span>
                <span class="stars-yelp">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </span>
            </div>
        </a>

    </div>
</section>
