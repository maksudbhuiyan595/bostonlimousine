<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
:root {
    --brand-gold: #C5A059;
    --brand-dark: #1A1A1A;
    --brand-white: #FFFFFF;
}

/* 1400px Container Width Fix */
@media (min-width: 1400px) {
    .footer .container-xxl,
    .copyright .container-xxl {
        max-width: 1320px !important;
    }
}

/* Footer Background and Text */
.footer {
    background-color: var(--brand-dark);
    color: var(--brand-white);
    font-family: 'Poppins', sans-serif;
}

/* Section Title with Gold Underline */
.footer-title {
    font-size: 1.25rem;
    font-weight: 700;
    position: relative;
    padding-bottom: 15px;
    color: var(--brand-white);
}

.footer-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 50px;
    height: 2px;
    background-color: var(--brand-gold);
}

/* Links and Contact Details */
.footer-item a {
    color: rgba(255, 255, 255, 0.85);
    text-decoration: none;
    margin-bottom: 12px;
    font-size: 0.95rem;
    display: inline-flex;
    align-items: center;
    transition: none !important;
    transform: none !important;
}

/* শুধুমাত্র টেক্সট কালার গোল্ড হবে (আর কিছুই পরিবর্তন হবে না) */
.footer-item a:hover,
.footer-item a:focus,
.footer-item a:hover span {
    color: var(--brand-gold) !important;
    text-decoration: none !important;
    background: transparent !important;
    transform: none !important;
}

.text-gold {
    color: var(--brand-gold) !important;
}

.small-icon {
    font-size: 0.75rem;
    color: var(--brand-gold);
    opacity: 0.85;
}

.mail-text {
    font-size: 0.9rem;
    word-break: break-all;
}

/* Social Buttons - ব্যাকগ্রাউন্ড ফিক্সড থাকবে, শুধু আইকন কালার পরিবর্তন হবে */
.btn-social {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--brand-gold) !important;
    background: transparent !important;
    color: var(--brand-white) !important;
    text-decoration: none;
    transition: none !important;
    transform: none !important;
}

.btn-social:hover,
.btn-social:focus {
    background: transparent !important; /* ব্যাকগ্রাউন্ড পরিবর্তন হবে না */
    border-color: var(--brand-gold) !important;
    color: var(--brand-gold) !important; /* শুধু আইকন গোল্ড হবে */
    transform: none !important;
}

/* Copyright Section */
.copyright {
    background-color: #111111;
    border-top: 1px solid rgba(197, 160, 89, 0.2);
    font-size: 0.9rem;
}

/* Responsive adjustments */
@media (max-width: 767.98px) {
    .footer-item {
        text-align: center;
        align-items: center;
    }
    .footer-title::after {
        left: 50%;
        transform: translateX(-50%);
    }
    .footer-item a {
        justify-content: center;
    }
    .footer-contact-row {
        justify-content: center;
    }
    .social-links {
        justify-content: center;
    }
}
</style>

<!-- MAIN FOOTER -->
<div class="container-fluid footer py-5">
    <div class="container-xxl py-5">
        <div class="row g-5">
            <!-- 1. Contact Information -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4 footer-title">Contact Information</h4>
                    <div class="d-flex align-items-start mb-3 footer-contact-row">
                        <i class="fa fa-map-marker-alt me-3 text-gold mt-1"></i>
                        <span class="text-white">12 highland Ave Woburn MA 01801</span>
                    </div>
                    <a href="tel:+18577772125" class="d-flex align-items-center mb-3">
                        <i class="fas fa-phone-alt me-3 text-gold"></i>
                        <span class="text-white">857-777-2125</span>
                    </a>
                    <a href="mailto:loganairporttransfer@gmail.com" class="d-flex align-items-center">
                        <i class="fas fa-envelope me-3 text-gold"></i>
                        <span class="text-white mail-text">loganairporttransfer@gmail.com</span>
                    </a>
                </div>
            </div>

            <!-- 2. Helpful Links -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4 footer-title">Helpful Links</h4>
                    <a href="{{ url('/') }}"><i class="fas fa-chevron-right me-2 small-icon"></i> <span>Home</span></a>
                    <a href="#"><i class="fas fa-chevron-right me-2 small-icon"></i> <span>Pickup Location</span></a>
                    <a href="{{ route('reservation') }}"><i class="fas fa-chevron-right me-2 small-icon"></i> <span>Reservation</span></a>
                    <a href="#"><i class="fas fa-chevron-right me-2 small-icon"></i> <span>Minivan Taxi</span></a>
                </div>
            </div>

            <!-- 3. About Us -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4 footer-title">About Us</h4>
                    <a href="#"><i class="fas fa-chevron-right me-2 small-icon"></i> <span>About</span></a>
                    <a href="#"><i class="fas fa-chevron-right me-2 small-icon"></i> <span>Payment Policy</span></a>
                    <a href="{{ route('blogs') }}"><i class="fas fa-chevron-right me-2 small-icon"></i> <span>Blogs</span></a>
                    <a href="#"><i class="fas fa-chevron-right me-2 small-icon"></i> <span>Terms And Conditions</span></a>
                </div>
            </div>

            <!-- 4. Social Network -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4 footer-title">Social Network</h4>
                    <div class="d-flex mt-2 social-links">
                        <a class="btn btn-social rounded-circle me-2" href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-social rounded-circle me-2" href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-social rounded-circle me-0" href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Copyright Section -->
<div class="container-fluid copyright py-4">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="col-md-12 text-center">
                <p class="mb-0 text-white opacity-75">
                    Copyright © {{ date('Y') }}. <span class="text-white fw-bold">Logan Airport Taxi</span> All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
</div>
