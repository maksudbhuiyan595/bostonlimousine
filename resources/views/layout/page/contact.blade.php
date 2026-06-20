@extends('layout.app')
@section('title', "Contact Us")
@section('meta_description', "Boston Express Cab is your go-to for reliable, comfortable transportation in Boston and beyond. Experience luxury and safety with our professional chauffeurs.")

@section('content')
<style>
    .contact-card-wrapper {
        background-color: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        margin: 60px 0;
        display: flex;
        flex-direction: column;
        border: 1px solid rgba(185, 146, 75, 0.2);
    }

    /* Desktop View */
    @media (min-width: 768px) {
        .contact-card-wrapper {
            flex-direction: row;
            min-height: 500px;
        }

        .col-left, .col-right {
            flex: 1;
        }
    }

    /* Left Side - Premium Amber Gradient */
    .contact-info-section {
        background: linear-gradient(135deg, #B9924B 0%, #8B6B2E 100%);
        padding: 60px 40px;
        color: white;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .contact-info-section::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.6s ease;
    }

    .contact-info-section:hover::before {
        opacity: 1;
    }

    .contact-info-section h2 {
        font-weight: 800;
        font-size: 2.2rem;
        margin-bottom: 30px;
        color: white;
        letter-spacing: -0.5px;
        position: relative;
        display: inline-block;
    }

    .contact-info-section h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 3px;
        background: rgba(255,255,255,0.5);
        border-radius: 2px;
    }

    .contact-link {
        display: flex;
        align-items: center;
        color: white;
        text-decoration: none;
        font-size: 1.1rem;
        margin-bottom: 25px;
        transition: all 0.3s ease;
        padding: 8px 0;
        border-radius: 12px;
    }

    .contact-link:hover {
        opacity: 0.9;
        color: white;
        transform: translateX(5px);
    }

    .contact-link i {
        width: 40px;
        font-size: 1.3rem;
        margin-right: 12px;
        text-align: center;
        background: rgba(255,255,255,0.15);
        padding: 10px;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .contact-link:hover i {
        background: rgba(255,255,255,0.25);
        transform: scale(1.05);
    }

    .contact-link span {
        font-weight: 500;
    }

    /* Social Media Icons Section */
    .social-section {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid rgba(255,255,255,0.2);
    }

    .social-title {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 15px;
        opacity: 0.8;
        display: block;
    }

    .social-icons {
        display: flex;
        gap: 15px;
    }

    .social-icon {
        width: 45px;
        height: 45px;
        background: rgba(255,255,255,0.15);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }

    .social-icon:hover {
        background: white;
        color: #B9924B;
        transform: translateY(-3px);
    }

    /* Right Side (Map) */
    .col-right {
        position: relative;
        padding: 0 !important;
        margin: 0 !important;
        background: #F5F5F0;
        min-height: 400px;
    }

    .map-iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }

    /* Map Overlay Info */
    .map-overlay {
        position: absolute;
        bottom: 20px;
        right: 20px;
        background: rgba(255,255,255,0.95);
        padding: 12px 18px;
        border-radius: 12px;
        font-size: 0.75rem;
        color: #B9924B;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        backdrop-filter: blur(8px);
        z-index: 10;
        pointer-events: none;
        border-left: 3px solid #B9924B;
    }

    .map-overlay i {
        margin-right: 5px;
    }

    /* Responsive */
    @media (max-width: 767px) {
        .contact-card-wrapper {
            margin: 30px 0;
            border-radius: 16px;
        }

        .contact-info-section {
            padding: 40px 25px;
        }

        .contact-info-section h2 {
            font-size: 1.8rem;
        }

        .contact-link {
            font-size: 0.95rem;
            margin-bottom: 18px;
        }

        .contact-link i {
            width: 35px;
            font-size: 1.1rem;
            padding: 8px;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }

        .col-right {
            min-height: 350px;
        }

        .map-overlay {
            bottom: 10px;
            right: 10px;
            padding: 8px 12px;
            font-size: 0.65rem;
        }
    }

    @media (min-width: 768px) and (max-width: 991px) {
        .contact-info-section {
            padding: 40px 25px;
        }

        .contact-info-section h2 {
            font-size: 1.8rem;
        }

        .contact-link {
            font-size: 0.9rem;
        }
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            <div class="contact-card-wrapper">

                <div class="col-left">
                    <div class="contact-info-section">
                        <h2>Contact Us</h2>

                        <a href="tel:+16172306362" class="contact-link">
                            <i class="fas fa-phone-alt"></i>
                            <span>Phone: 857-777-2125</span>
                        </a>

                        <a href="mailto:loganairporttransfer@gmail.com" class="contact-link">
                            <i class="far fa-envelope"></i>
                            <span>Email: loganairporttransfer@gmail.com</span>
                        </a>

                        <a href="https://wa.me/16172306362" target="_blank" class="contact-link">
                            <i class="fab fa-whatsapp"></i>
                            <span>WhatsApp: 857-777-2125</span>
                        </a>

                        <div class="social-section">
                            <span class="social-title"><i class="fas fa-share-alt me-2"></i> Follow Us</span>
                            <div class="social-icons">
                                <a href="#" class="social-icon" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="social-icon" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="social-icon" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="social-icon" target="_blank">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-right">
                    <iframe
                        class="map-iframe"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d94233.44474322986!2d-71.19124440854687!3d42.36009388172986!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e370a5cb30cc5f%3A0x2614b9c6c4068564!2sBoston%2C%20MA%2C%20USA!5e0!3m2!1sen!2sbd!4v1705676458321!5m2!1sen!2sbd"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    <div class="map-overlay">
                        <i class="fas fa-map-marker-alt"></i> Boston, Massachusetts
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<!-- Optional: Add Business Hours Section -->
<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="business-hours" style="background: white; border-radius: 16px; padding: 25px; text-align: center; border: 1px solid rgba(185, 146, 75, 0.2);">
                <h4 style="color: #B9924B; font-weight: 800; margin-bottom: 15px;">
                    <i class="fas fa-clock me-2"></i> Business Hours
                </h4>
                <p style="color: #4B5563; margin-bottom: 5px;">
                    <strong>Monday - Sunday:</strong> 24/7 - Available 365 Days
                </p>
                <p style="color: #6B7280; font-size: 0.85rem;">
                    <i class="fas fa-headset me-1"></i> Customer Support Available 24/7
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    .business-hours {
        transition: all 0.3s ease;
    }
    .business-hours:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(185, 146, 75, 0.1);
        border-color: #B9924B;
    }
</style>
@endsection
