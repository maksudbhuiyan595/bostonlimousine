<div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4 footer-title">Contact Information</h4>
                    <div class="d-flex align-items-start mb-3">
                        <i class="fa fa-map-marker-alt me-3 text-gold mt-1"></i>
                        <span class="text-white">870 Main St, Woburn, MA 01801</span>
                    </div>
                    <a href="tel:+16172306362" class="d-flex align-items-center mb-3">
                        <i class="fas fa-phone-alt me-3 text-gold"></i>
                        <span class="text-white">857-777-2125</span>
                    </a>
                    <a href="mailto:bostonexpresscab24@gmail.com" class="d-flex align-items-center">
                        <i class="fas fa-envelope me-3 text-gold"></i>
                        <span class="text-white" style="font-size: 0.9rem;">bostonexpresscab24@gmail.com</span>
                    </a>
                </div>
            </div>

            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4 footer-title">Helpful Links</h4>
                    <a href="{{ url('/') }}"><i class="fas fa-chevron-right me-2 small-icon"></i> Home</a>
                    <a href="#"><i class="fas fa-chevron-right me-2 small-icon"></i> Pickup Location</a>
                    <a href="{{ route('reservation') }}"><i class="fas fa-chevron-right me-2 small-icon"></i> Reservation</a>
                    <a href="#"><i class="fas fa-chevron-right me-2 small-icon"></i> Minivan Taxi</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4 footer-title">About Us</h4>
                    <a href="#"><i class="fas fa-chevron-right me-2 small-icon"></i> About</a>
                    <a href="#"><i class="fas fa-chevron-right me-2 small-icon"></i> Payment Policy</a>
                    <a href="#"><i class="fas fa-chevron-right me-2 small-icon"></i> Blogs</a>
                    <a href="#"><i class="fas fa-chevron-right me-2 small-icon"></i> Terms And Conditions</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-white mb-4 footer-title">Social Network</h4>
                    <div class="d-flex mt-2">
                        <a class="btn btn-social rounded-circle me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-social rounded-circle me-2" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-social rounded-circle me-0" href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid copyright py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 text-center">
                <p class="mb-0 text-white opacity-75">
                    Copyright © {{ date('Y') }}. <span class="text-white fw-bold">Logan Airport Taxi</span> All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --brand-gold: #C5A059;
    --brand-gold-dark: #A8883E;
    --brand-gold-light: #D4B87A;
    --brand-dark: #1A1A1A;
    --brand-white: #FFFFFF;
}

/* Footer Background and Text */
.footer {
    background-color: var(--brand-dark); /* Using your #1A1A1A */
    color: var(--brand-white);
    font-family: 'Poppins', sans-serif;
}

/* Section Title with Gold underline */
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
    background-color: var(--brand-gold); /* Gold Underline */
}

/* Links and Icons */
.footer-item a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    margin-bottom: 12px;
    transition: all 0.3s ease;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
}

.footer-item a:hover {
    color: var(--brand-gold-light);
    transform: translateX(5px);
}

.text-gold {
    color: var(--brand-gold) !important;
}

.small-icon {
    font-size: 0.7rem;
    color: var(--brand-gold);
    opacity: 0.8;
}

/* Social Buttons - Gold Style */
.btn-social {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--brand-gold); /* Gold Border */
    color: var(--brand-gold);
    transition: 0.3s;
}

.btn-social:hover {
    background: linear-gradient(135deg, var(--brand-gold) 0%, var(--brand-gold-dark) 100%);
    color: var(--brand-white);
    border-color: var(--brand-gold-dark);
    transform: translateY(-3px);
}

/* Copyright Section */
.copyright {
    background-color: #111111; /* Slightly darker than footer for depth */
    border-top: 1px solid rgba(197, 160, 89, 0.2); /* Subtle gold border */
    font-size: 0.9rem;
}

.text-gold {
    color: var(--brand-gold);
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
}
</style>
