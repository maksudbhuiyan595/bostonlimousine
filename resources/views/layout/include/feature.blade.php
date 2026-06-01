<section class="specialized-features py-5">
    <style>
        :root {
            --brand-gold: #C5A059;
            --brand-gold-dark: #A8883E;
            --brand-dark: #1A1A1A;
            --brand-white: #FFFFFF;
        }

        .specialized-features {
            background: #ffffff;
            padding: 80px 0;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
        }

        /* --- ANIMATIONS --- */
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }

        @keyframes pulse-gold {
            0% { box-shadow: 0 0 0 0 rgba(197, 160, 89, 0.3); }
            70% { box-shadow: 0 0 0 15px rgba(197, 160, 89, 0); }
            100% { box-shadow: 0 0 0 0 rgba(197, 160, 89, 0); }
        }

        /* --- FEATURE CARDS --- */
        .feature-card {
            background: var(--brand-white);
            border-radius: 20px;
            padding: 25px 30px;
            margin-bottom: 30px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 10px 30px rgba(0,0,0,0.04);
            transition: all 0.4s ease;
            position: relative;
            z-index: 10;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            border-color: var(--brand-gold);
            box-shadow: 0 15px 35px rgba(197, 160, 89, 0.15);
        }

        /* Overlap & Text Alignment Fix */
        .left-col .feature-card { text-align: right; margin-right: 35px; padding-right: 60px; }
        .right-col .feature-card { text-align: left; margin-left: 35px; padding-left: 60px; }

        .icon-box {
            width: 55px;
            height: 55px;
            background: var(--brand-white);
            color: var(--brand-gold);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            animation: pulse-gold 3s infinite;
            border: 1px solid rgba(197, 160, 89, 0.2);
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            z-index: 11;
        }

        .left-col .icon-box { right: -28px; }
        .right-col .icon-box { left: -28px; }

        /* --- LARGE CENTER IMAGE --- */
        .center-display {
            position: relative;
            z-index: 1;
            animation: floating 6s ease-in-out infinite;
        }

        .main-image {
            width: 115%; /* Extra large focus */
            margin-left: -7.5%; /* Center adjustment */
            border-radius: 35px;
            box-shadow: 0 30px 70px rgba(0,0,0,0.15);
            display: block;
        }

        .feature-card h4 { color: var(--brand-dark); font-weight: 700; font-size: 1.2rem; margin-bottom: 8px; }
        .feature-card p { color: #777; font-size: 0.88rem; line-height: 1.5; margin: 0; }

        @media (max-width: 991px) {
            .main-image { width: 100%; margin-left: 0; }
            .left-col .feature-card, .right-col .feature-card {
                margin: 0 0 20px 0;
                padding: 25px !important;
                text-align: left;
            }
            .icon-box { position: static; transform: none; margin-bottom: 12px; }
        }
    </style>

    <div class="container-fluid px-lg-5">
        <div class="text-center mb-5">
            <h2 style="color: var(--brand-gold); font-weight: 800; font-size: 3rem; margin-bottom: 15px;">Our Specialized Features</h2>
            <div style="width: 60px; height: 3px; background: var(--brand-gold); margin: 0 auto 20px auto;"></div>
            <p style="color: #666; max-width: 700px; margin: 0 auto; font-size: 1.05rem; line-height: 1.6;">
                Enjoy unmatched convenience, safety, and customization with Boston Airport Transfer. We ensure seamless travel solutions tailored to your needs.
            </p>
        </div>

        <div class="row align-items-center">
            <div class="col-lg-3 left-col">
                <div class="feature-card">
                    <div class="icon-box"><i class="fas fa-plane"></i></div>
                    <h4>Airport Transfer</h4>
                    <p>Reliable Logan Airport Transfer pickups with expert flight tracking.</p>
                </div>
                <div class="feature-card">
                    <div class="icon-box"><i class="fas fa-baby-carriage"></i></div>
                    <h4>Child Seat</h4>
                    <p>Safety seats pre-installed for your little one's protection.</p>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="center-display text-center">
                    <img src="{{ asset('images/children.webp') }}"
                         class="main-image"
                         alt="Boston Premium Service Focus">
                </div>
            </div>

            <div class="col-lg-3 right-col">
                <div class="feature-card">
                    <div class="icon-box"><i class="fas fa-briefcase"></i></div>
                    <h4>Corporate Taxi</h4>
                    <p>Executive travel solutions for your high-priority business needs.</p>
                </div>
                <div class="feature-card">
                    <div class="icon-box"><i class="fas fa-history"></i></div>
                    <h4>Long Distance Car Service</h4>
                    <p>Need transportation outside Boston? Our long-distance car service offers comfortable and private transportation for travelers heading across Massachusetts and neighboring states.</p>
                </div>
            </div>
        </div>
    </div>
</section>
