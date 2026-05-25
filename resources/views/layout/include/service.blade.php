<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --premium-gold: #C5A059;
        --premium-gold-light: #D4B87A;
        --premium-gold-dark: #A8883E;
        --premium-black: #1A1A1A;
        --premium-dark: #2C2C2C;
        --premium-gray: #A0A0A0;
        --transition-smooth: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .logan-transfer-section {
        padding: 100px 0;
        background: linear-gradient(135deg, #0A0A0A 0%, var(--premium-black) 50%, #0F0F0F 100%);
        position: relative;
        overflow: hidden;
        color: #fff;
        font-family: 'Poppins', sans-serif;
    }

    /* Animated Background Elements */
    .logan-transfer-section::before {
        content: '';
        position: absolute;
        width: 200%; height: 200%;
        top: -50%; left: -50%;
        background: radial-gradient(circle, rgba(197,160,89,0.03) 1px, transparent 1px);
        background-size: 50px 50px;
        animation: floatPattern 20s linear infinite;
        pointer-events: none;
    }

    .glow-orb {
        position: absolute; border-radius: 50%;
        filter: blur(80px); opacity: 0.15;
        animation: floatOrb 8s ease-in-out infinite;
        pointer-events: none;
    }
    .glow-orb-1 { width: 300px; height: 300px; background: var(--premium-gold); top: -50px; right: -50px; }
    .glow-orb-2 { width: 400px; height: 400px; background: var(--premium-gold-dark); bottom: -100px; left: -100px; animation-delay: 4s; }

    @keyframes floatPattern { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    @keyframes floatOrb { 0%, 100% { transform: translate(0, 0); } 50% { transform: translate(30px, -30px); } }

    /* LAYOUT */
    .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; position: relative; z-index: 5; }
    .transfer-wrapper { display: grid; grid-template-columns: 1.1fr 0.9fr; gap: 60px; align-items: center; }

    /* CONTENT SIDE */
    .badge {
        display: inline-flex; align-items: center; gap: 10px;
        background: rgba(197, 160, 89, 0.1); border: 1px solid rgba(197, 160, 89, 0.3);
        padding: 8px 20px; border-radius: 50px; margin-bottom: 25px;
        color: var(--premium-gold-light); font-size: 0.75rem; font-weight: 700;
        letter-spacing: 1.5px; text-transform: uppercase;
    }

    .transfer-content h1 {
        font-size: 3.2rem; font-weight: 800; line-height: 1.1; margin-bottom: 20px;
    }

    .gold-text { color: var(--premium-gold); }

    .tagline { font-size: 1.1rem; color: var(--premium-gray); margin-bottom: 35px; line-height: 1.7; }

    /* FEATURES */
    .features-list { display: grid; gap: 20px; margin-bottom: 40px; }
    .feature-item { display: flex; align-items: flex-start; gap: 15px; }

    .feature-icon {
        width: 45px; height: 45px; background: rgba(197, 160, 89, 0.1);
        border: 1px solid rgba(197, 160, 89, 0.3); border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        color: var(--premium-gold); font-size: 1.1rem; flex-shrink: 0;
    }

    .feature-text h4 { font-size: 1.05rem; margin: 0 0 5px 0; color: #fff; font-weight: 600; }
    .feature-text p { font-size: 0.85rem; margin: 0; color: var(--premium-gray); line-height: 1.4; }

    /* CTA GROUP */
    .cta-group { display: flex; gap: 15px; flex-wrap: wrap; }
    .btn-primary {
        background: var(--premium-gold); color: #fff; padding: 15px 35px;
        border-radius: 50px; text-decoration: none; font-weight: 700;
        display: inline-flex; align-items: center; gap: 10px; transition: 0.3s;
    }
    .btn-outline {
        border: 2px solid var(--premium-gold); color: var(--premium-gold);
        padding: 13px 35px; border-radius: 50px; text-decoration: none;
        font-weight: 700; transition: 0.3s; display: inline-flex; align-items: center; gap: 10px;
    }
    .btn-primary:hover { background: var(--premium-gold-dark); transform: translateY(-3px); }
    .btn-outline:hover { background: var(--premium-gold); color: #fff; transform: translateY(-3px); }

    /* VISUAL SIDE */
    .transfer-visual { position: relative; text-align: center; }
    .car-container { position: relative; animation: floatCar 4s ease-in-out infinite; z-index: 2; }
    .car-image { width: 100%; max-width: 550px; filter: drop-shadow(0 20px 40px rgba(0,0,0,0.8)); }

    @keyframes floatCar { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-15px); } }

    .road-lines {
        position: absolute; bottom: -20px; left: 15%; right: 15%; height: 2px;
        background: repeating-linear-gradient(90deg, var(--premium-gold) 0, var(--premium-gold) 20px, transparent 20px, transparent 40px);
        animation: moveRoad 0.8s linear infinite; opacity: 0.3;
    }
    @keyframes moveRoad { from { background-position: 0 0; } to { background-position: 40px 0; } }

    /* STATS */
    .stats-container {
        display: flex; justify-content: space-between; margin-top: 50px;
        padding-top: 30px; border-top: 1px solid rgba(197, 160, 89, 0.1);
    }
    .stat-number { font-size: 1.8rem; font-weight: 800; color: var(--premium-gold); display: block; }
    .stat-label { font-size: 0.7rem; color: var(--premium-gray); text-transform: uppercase; letter-spacing: 1px; }

    /* RESPONSIVE */
    @media (max-width: 991px) {
        .transfer-wrapper { grid-template-columns: 1fr; text-align: center; }
        .feature-item { text-align: left; max-width: 500px; margin: 0 auto; }
        .cta-group { justify-content: center; }
        .stats-container { justify-content: center; gap: 30px; }
        .transfer-content h1 { font-size: 2.5rem; }
    }

    @media (max-width: 576px) {
        .transfer-content h1 { font-size: 2rem; }
        .cta-group { flex-direction: column; }
        .btn-primary, .btn-outline { width: 100%; justify-content: center; }
    }
</style>

<section class="logan-transfer-section">
    <div class="glow-orb glow-orb-1"></div>
    <div class="glow-orb glow-orb-2"></div>

    <div class="container">
        <div class="transfer-wrapper">
            <div class="transfer-content">
                <div class="badge">
                    <i class="fas fa-crown"></i>
                    <span>Logan Car Service</span>
                </div>

                <h1>
                    Boston Airport<br>
                    <span class="gold-text">Car Service</span>
                </h1>

                <p class="tagline">
                    Experience the ultimate in luxury and reliability. We provide seamless airport transfers, professional chauffeurs, and a first-class journey to Logan International Airport.
                </p>

                <div class="features-list">
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-plane-arrival"></i></div>
                        <div class="feature-text">
                            <h4>Real-Time Flight Tracking</h4>
                            <p>We monitor your flight status to ensure timely pickups, even with delays.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-user-check"></i></div>
                        <div class="feature-text">
                            <h4>Professional Chauffeurs</h4>
                            <p>Highly trained, punctual, and expert drivers for a stress-free ride.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-tags"></i></div>
                        <div class="feature-text">
                            <h4>Transparent Pricing</h4>
                            <p>Flat rates with no hidden fees and a 10% cash payment discount.</p>
                        </div>
                    </div>
                </div>

                <div class="cta-group">
                    <a href="{{ route(('home')) }}" class="btn-primary">Book Now <i class="fas fa-arrow-right"></i></a>
                    <a href="tel:8577772125" class="btn-outline"><i class="fas fa-phone-alt"></i> 857-777-2125</a>
                </div>

                <div class="stats-container">
                    <div class="stat-item">
                        <span class="stat-number">24/7</span>
                        <span class="stat-label">Service Available</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">100%</span>
                        <span class="stat-label">Punctuality Rate</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">4.9/5</span>
                        <span class="stat-label">Customer Rating</span>
                    </div>
                </div>
            </div>

            <div class="transfer-visual">
                <div class="car-container">
                    <img src="{{ asset('images/car-3.png') }}" alt="Luxury Boston Airport Car" class="car-image">
                    <div class="road-lines"></div>
                </div>

                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 80%; height: 80%; border: 1px solid rgba(197, 160, 89, 0.1); border-radius: 50%; z-index: 1;"></div>
            </div>
        </div>
    </div>
</section>
