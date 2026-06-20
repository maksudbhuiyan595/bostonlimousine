
    <style>
        :root {
            --brand-gold: #C5A059;
            --brand-gold-dark: #A8883E;
            --brand-gold-light: #D4B87A;
            --brand-dark: #1A1A1A;
            --brand-dark-bg: #0F0F0F;
            --brand-white: #FFFFFF;
            --brand-gray: #6C757D;
            --brand-light-gray: #F8F9FA;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Poppins', sans-serif;
            background: var(--brand-white);
            color: var(--brand-dark);
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: radial-gradient(var(--brand-gold) 1px, transparent 1px);
            background-size: 40px 40px;
            opacity: 0.08;
            pointer-events: none;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--brand-white);
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero-title span {
            color: var(--brand-gold);
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: #CCCCCC;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .btn-gold {
            background: var(--brand-gold);
            color: var(--brand-white);
            padding: 12px 35px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-gold:hover {
            background: var(--brand-gold-dark);
            color: var(--brand-white);
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(197, 160, 89, 0.3);
        }

        .btn-outline-gold {
            background: transparent;
            color: var(--brand-gold);
            padding: 12px 35px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            border: 2px solid var(--brand-gold);
            transition: all 0.3s ease;
        }

        .btn-outline-gold:hover {
            background: var(--brand-gold);
            color: var(--brand-white);
            transform: translateY(-2px);
        }

        /* Section Styles */
        .section-padding {
            padding: 80px 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 15px;
            color: var(--brand-dark);
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: var(--brand-gray);
            max-width: 700px;
            margin: 0 auto;
        }

        .gold-divider {
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--brand-gold), var(--brand-gold-light));
            margin: 20px auto;
            border-radius: 2px;
        }

        /* Service Cards */
        .service-card {
            background: var(--brand-white);
            border-radius: 20px;
            padding: 35px 25px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(197, 160, 89, 0.1);
            height: 100%;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(197, 160, 89, 0.15);
            border-color: var(--brand-gold);
        }

        .service-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--brand-gold) 0%, var(--brand-gold-dark) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .service-icon i {
            font-size: 2rem;
            color: var(--brand-white);
        }

        .service-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--brand-dark);
        }

        .service-card p {
            color: var(--brand-gray);
            line-height: 1.6;
            font-size: 0.95rem;
        }

        /* Feature Highlights */
        .feature-highlights {
            background: var(--brand-light-gray);
        }

        .highlight-item {
            text-align: center;
            padding: 30px;
        }

        .highlight-icon {
            width: 80px;
            height: 80px;
            background: rgba(197, 160, 89, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .highlight-icon i {
            font-size: 2.5rem;
            color: var(--brand-gold);
        }

        .highlight-item h4 {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .highlight-item p {
            color: var(--brand-gray);
            font-size: 0.9rem;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--brand-dark) 0%, var(--brand-dark-bg) 100%);
            padding: 60px 0;
            text-align: center;
        }

        .cta-section h2 {
            color: var(--brand-white);
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .cta-section p {
            color: #CCCCCC;
            margin-bottom: 30px;
            font-size: 1.1rem;
        }

        /* Child Seat Banner */
        .child-seat-banner {
            background: linear-gradient(135deg, var(--brand-gold) 0%, var(--brand-gold-dark) 100%);
            padding: 50px;
            border-radius: 20px;
            color: var(--brand-white);
        }

        .child-seat-banner h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .hero-title { font-size: 2.5rem; }
            .section-padding { padding: 50px 0; }
            .section-title { font-size: 2rem; }
            .service-card { padding: 25px 20px; }
            .child-seat-banner { padding: 30px; }
            .child-seat-banner h3 { font-size: 1.4rem; }
        }

        @media (max-width: 768px) {
            .hero-title { font-size: 2rem; }
            .hero-subtitle { font-size: 1rem; }
            .btn-gold, .btn-outline-gold { padding: 10px 25px; font-size: 0.9rem; }
        }
    </style>
<!-- Services Section -->
<section class="section-padding">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title">Our Premium Services</h2>
            <div class="gold-divider"></div>
            <p class="section-subtitle">Discover our comprehensive range of transportation solutions tailored to your needs</p>
        </div>

        <div class="row mt-5">
            <!-- Logan Airport Transfer -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-plane-arrival"></i>
                    </div>
                    <h3>Logan Airport Transfer</h3>
                    <p>Reliable airport transportation is the foundation of our service. We provide professional pickup and drop-off service to and from Boston Logan International Airport with a strong focus on punctuality and comfort.</p>
                    <p class="mt-2">Our airport transportation service includes flight monitoring, luggage assistance, clean vehicles, and dependable scheduling to help travelers arrive on time without unnecessary stress. Whether you are traveling for business, vacation, or family visits, we make airport transportation simple and convenient.</p>
                </div>
            </div>

            <!-- Long Distance Car Service -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-route"></i>
                    </div>
                    <h3>Long Distance Car Service</h3>
                    <p>Need transportation outside Boston? Our long-distance car service offers comfortable and private transportation for travelers heading across Massachusetts and neighboring states.</p>
                    <p class="mt-2">Avoid crowded buses, train delays, and rideshare uncertainty with a dependable private transportation service designed around your schedule.</p>
                </div>
            </div>

            <!-- Corporate Car Service -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3>Corporate Car Service</h3>
                    <p>Business professionals need transportation they can rely on. Our corporate car service provides executive transportation for meetings, conferences, airport pickups, and business events.</p>
                    <p class="mt-2">We focus on professionalism, punctuality, and comfortable travel to help corporate clients maintain a smooth schedule throughout the day.</p>
                </div>
            </div>

            <!-- Special Event Transfer -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-glass-cheers"></i>
                    </div>
                    <h3>Special Event Transfer</h3>
                    <p>Planning a special occasion? We provide comfortable and reliable transportation for private events throughout Boston and nearby areas.</p>
                    <p class="mt-2">Whether it is a wedding, concert, sporting event, birthday celebration, graduation, or private gathering, our special event transportation service helps you travel safely and comfortably. Enjoy your event while we handle the driving.</p>
                </div>
            </div>

            <!-- Child Seat Options -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-baby-carriage"></i>
                    </div>
                    <h3>Child Seat Options</h3>
                    <p>Your family safety is very important to us. Logan Airport Transfer offers child seats, infant seats, and booster seats options for families traveling with infants, toddlers, and young children.</p>
                    <p class="mt-2">We provide child seating upon request to help parents travel with greater comfort and peace of mind. Please request child seating during booking so we can prepare the appropriate seat for the tiniest member of your family.</p>
                </div>
            </div>

            <!-- Door-to-Door Car Service -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-door-open"></i>
                    </div>
                    <h3>Door-to-Door Car Service</h3>
                    <p>Our door-to-door car service provides convenient transportation directly from your location to your destination.</p>
                    <p class="mt-2">Whether you need pickup from your home, hotel, office, airport, or university, our drivers ensure a smooth and hassle-free ride without unnecessary stops or delays. We make transportation easy, comfortable, and dependable.</p>
                </div>
            </div>
        </div>
    </div>
</section>



