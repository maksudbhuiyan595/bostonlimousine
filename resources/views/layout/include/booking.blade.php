
    <!-- Bootstrap 5 + Icons + Flatpickr + Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">

    <style>
        /* ========================================
           PREMIUM AMBER COLOR SCHEME - #B9924B
           COMPACT HEIGHT VERSION
           ======================================== */

        :root {
            --amber-primary: #B9924B;
            --amber-dark: #8B6B2E;
            --amber-light: #D4AE6E;
            --amber-glow: rgba(185, 146, 75, 0.2);
            --bg-dark: #0F171D;
            --bg-card: #1A242C;
            --border-dark: #2D3E48;
            --text-light: #FFFFFF;
            --text-muted: #A0B4C0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #0F171D 0%, #1A242C 100%);
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
        }
        .hero-section {
            background-image: linear-gradient(rgba(15, 23, 29, 0.85), rgba(15, 23, 29, 0.85)),
                              url('images/new-8.webp');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            color: var(--text-light);
            min-height: 100vh;
        }

        .reservation-card {
            background: rgba(26, 36, 44, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 28px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.6);
        }

        .hero-section {
            padding: 28px 0 50px 0;
            position: relative;
        }

        /* ---------- COMPACT PREMIUM AMBER CARD ---------- */
        .reservation-card {
            background: var(--bg-card);
            border-radius: 28px;
            box-shadow: 0 25px 42px -18px rgba(0, 0, 0, 0.8), 0 0 0 1px rgba(185, 146, 75, 0.25);
            border: none;
            border-top: 4px solid var(--amber-primary);
            width: 100%;
            z-index: 100;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .reservation-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 30px 48px -20px rgba(0,0,0,0.9);
        }

        .form-header {
            background: linear-gradient(135deg, var(--amber-primary) 0%, var(--amber-dark) 100%);
            color: #0A0D12;
            padding: 8px 14px;
            text-align: center;
        }

        .form-header h3 {
            margin: 0;
            font-size: 1rem;
            font-weight: 800;
            letter-spacing: -0.2px;
            color: #fff;
            text-transform: uppercase;
        }

        .form-header p {
            margin: 0;
            font-size: 0.55rem;
            font-weight: 600;
            opacity: 0.9;
            color: #fff;
        }

        .booking-inner {
            padding: 12px 16px 16px 16px;
        }

        /* ========== COMPACT INPUTS - REDUCED HEIGHT ========== */
        .form-control, .form-select {
            background-color: var(--bg-dark);
            border: 1px solid var(--border-dark);
            color: var(--text-light) !important;
            font-weight: 500;
            height: 36px;
            border-radius: 12px;
            font-size: 0.78rem;
            transition: all 0.2s;
            line-height: 1.2;
            padding: 0 10px;
        }

        .form-control::placeholder,
        input::placeholder {
            color: var(--text-muted) !important;
            opacity: 0.7;
            font-size: 0.72rem;
        }

        .form-select {
            padding: 0 10px;
        }

        .form-select option {
            background-color: var(--bg-dark);
            color: var(--text-light);
            font-size: 0.75rem;
        }

        .form-control:focus, .form-select:focus {
            background-color: #25333C;
            border-color: var(--amber-primary);
            box-shadow: 0 0 0 3px var(--amber-glow);
        }

        /* Compact Input Group */
        .input-group-text {
            width: 36px;
            justify-content: center;
            background: var(--bg-dark);
            color: var(--amber-primary);
            border: 1px solid var(--border-dark);
            height: 36px;
            border-radius: 12px 0 0 12px;
            font-size: 0.75rem;
            padding: 0;
        }

        /* ========== TRIP TYPE: SINGLE ROW ON MOBILE (FIXED) ========== */
        .trip-type-container {
            display: flex;
            flex-direction: row;
            gap: 8px;
            margin: 6px 0 10px 0;
            flex-wrap: nowrap;
            width: 100%;
        }

        .trip-option {
            flex: 1;
            min-width: 0;
        }

        .trip-option input {
            display: none;
        }

        .trip-card {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            padding: 6px 4px;
            border: 1px solid var(--border-dark);
            border-radius: 28px;
            cursor: pointer;
            transition: 0.2s;
            background: var(--bg-dark);
            gap: 5px;
            font-weight: 600;
            color: var(--text-muted);
            font-size: 0.7rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .trip-option input:checked + .trip-card {
            background: linear-gradient(135deg, var(--amber-primary) 0%, var(--amber-dark) 100%);
            border-color: var(--amber-primary);
            color: #0A0D12;
            font-weight: 800;
            box-shadow: 0 4px 10px rgba(185, 146, 75, 0.4);
        }

        .trip-card i {
            font-size: 0.75rem;
            flex-shrink: 0;
        }

        .trip-card span {
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: -0.2px;
        }

        /* Compact Labels */
        .mini-label {
            font-size: 0.55rem;
            color: var(--amber-primary);
            margin-left: 4px;
            font-weight: 700;
            display: block;
            margin-bottom: 3px;
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }

        /* Compact Extras Section */
        #extrasSection {
            display: none;
            background: #111C22;
            padding: 8px 10px;
            border-radius: 18px;
            border: 1px solid var(--border-dark);
            margin-top: 8px;
        }

        .extras-toggle {
            color: #E8F0F5;
            font-weight: 600;
            cursor: pointer;
            padding: 6px 10px;
            font-size: 0.68rem;
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--bg-dark);
            border-radius: 40px;
            margin-top: 5px;
            border: 1px solid var(--border-dark);
            transition: all 0.2s;
        }

        .extras-toggle:hover {
            border-color: var(--amber-primary);
            background: #1F2E38;
        }

        .extras-toggle i:first-child {
            color: var(--amber-primary);
            font-size: 0.8rem;
        }

        .extra-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 6px;
            padding-bottom: 4px;
            border-bottom: 1px solid var(--border-dark);
        }

        .extra-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .extra-label {
            font-size: 0.68rem;
            color: #CFE2EC;
            font-weight: 500;
        }

        .extra-price-tag {
            color: var(--amber-primary);
            font-weight: 700;
            margin-left: 4px;
            font-size: 0.65rem;
        }

        .extra-row .form-select {
            width: 60px !important;
            height: 28px !important;
            font-size: 0.68rem;
            background-color: var(--bg-dark);
            border-color: var(--amber-primary);
            padding: 0 5px;
        }

        .total-price-display {
            font-weight: bold;
            color: var(--amber-primary);
            font-size: 0.7rem;
            min-width: 35px;
            text-align: right;
        }

        /* Compact Get Fare Button */
        .btn-get-fare {
            width: 100%;
            background: linear-gradient(95deg, var(--amber-primary) 0%, var(--amber-dark) 100%);
            color: #fff;
            border: none;
            padding: 8px 12px;
            font-size: 0.8rem;
            font-weight: 800;
            border-radius: 40px;
            margin-top: 10px;
            transition: all 0.2s;
            letter-spacing: 0.5px;
            box-shadow: 0 3px 9px rgba(185, 146, 75, 0.3);
        }

        .btn-get-fare:hover {
            background: linear-gradient(95deg, #D4AE6E 0%, var(--amber-primary) 100%);
            transform: scale(0.98);
        }

        /* Compact Footer Note */
        .footer-note {
            text-align: center;
            font-size: 0.55rem;
            color: var(--text-muted);
            margin-top: 8px;
            font-weight: 500;
        }

        /* MAP SIDEBAR */
        .map-sidebar-card {
            background: #FFFFFF;
            border-radius: 28px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            overflow: hidden;
            box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.2);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .map-header {
            background: linear-gradient(135deg, var(--amber-primary) 0%, var(--amber-dark) 100%);
            padding: 10px 18px;
        }

        .map-header h4 {
            margin: 0;
            font-size: 0.85rem;
            font-weight: 800;
            letter-spacing: 0.8px;
            color: #fff;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .map-header h4 i {
            font-size: 0.9rem;
        }

        #map {
            height: 240px;
            width: 100%;
            background: #EAF0F5;
        }

        .location-info-panel {
            padding: 12px 16px;
            background: #FFFFFF;
            flex: 1;
        }

        .route-detail {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 12px;
            background: #F8FBFF;
            padding: 8px 12px;
            border-radius: 18px;
            border-left: 3px solid var(--amber-primary);
            box-shadow: 0 1px 4px rgba(0,0,0,0.03);
        }

        .route-icon {
            font-size: 1.1rem;
        }

        .route-text strong {
            color: var(--amber-primary);
            font-size: 0.55rem;
            letter-spacing: 0.6px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .route-text span {
            font-size: 0.75rem;
            font-weight: 600;
            color: #1A2E3A;
            word-break: break-word;
            line-height: 1.2;
        }

        .route-text small {
            color: #6E8E9E;
            font-size: 0.55rem;
        }

        .dynamic-fare-badge {
            background: linear-gradient(135deg, #FEF8E8 0%, #FDF4DC 100%);
            border-radius: 40px;
            padding: 8px 14px;
            text-align: center;
            font-weight: 700;
            font-size: 0.7rem;
            color: var(--amber-dark);
            border: 1px solid var(--amber-primary);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 6px;
        }

        /* Loading spinner for airports */
        .airport-loading {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid var(--amber-primary);
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 0.6s linear infinite;
            margin-left: 8px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive: Trip row remains single row on all screens */
        @media (max-width: 480px) {
            .trip-card {
                padding: 5px 2px;
            }
            .trip-card span {
                font-size: 0.6rem;
            }
            .trip-card i {
                font-size: 0.65rem;
            }
            .trip-type-container {
                gap: 5px;
            }
        }

        @media (max-width: 991px) {
            .reservation-card {
                margin-bottom: 20px;
            }
            .booking-inner {
                padding: 12px;
            }
            .trip-type-container {
                flex-wrap: nowrap !important;
            }
        }

        @media (min-width: 992px) {
            .form-column {
                position: relative;
            }
            .reservation-card {
                position: absolute;
                top: 0;
                left: 12px;
                width: calc(100% - 24px);
            }
        }

        /* Flatpickr Date Input Fix */
        #date,
        #date.form-control,
        #date.flatpickr-input {
            color: var(--text-light) !important;
            -webkit-text-fill-color: var(--text-light) !important;
             background-color: #121B20;
        }

        #date::placeholder {
            color: var(--text-muted) !important;
            opacity: 1 !important;
        }

        /* Disabled input style */
        .form-control:disabled, .form-select:disabled {
            background-color: #121B20;
            border-color: #2A3840;
            color: #6A808C !important;
            cursor: not-allowed;
            opacity: 0.7;
        }

        /* Row margin adjustments */
        .row.g-2 {
            --bs-gutter-y: 0.3rem;
        }

        .mb-2 {
            margin-bottom: 0.5rem !important;
        }

        .mb-3 {
            margin-bottom: 0.6rem !important;
        }

        @media (max-width: 767px) {
            .hero-section h1 {
                font-size: 1.3rem !important;
            }

            .hero-section p {
                font-size: 0.65rem !important;
            }

            .reservation-card {
                margin-bottom: 20px;
                position: relative !important;
                top: 0 !important;
                left: 0 !important;
                width: 100% !important;
            }

            .trip-type-container {
                flex-direction: row;
                flex-wrap: nowrap;
            }
            .trip-card {
                padding: 5px 4px;
            }
            .trip-card span {
                font-size: 0.6rem;
            }

            #map {
                height: 200px;
            }

            .form-control, .form-select {
                height: 42px;
                font-size: 0.85rem;
            }

            .input-group-text {
                height: 42px;
            }

            .extra-label {
                font-size: 0.75rem;
            }

            .extra-row .form-select {
                width: 70px !important;
                height: 34px !important;
            }

            .btn-get-fare {
                padding: 12px;
                font-size: 0.9rem;
            }

            .route-text span {
                font-size: 0.7rem;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            #map {
                height: 300px;
            }
        }
        @media (min-width: 992px) {
            .hero-section {
                padding-bottom: 100px;
            }
        }
    </style>


<section class="hero-section">
    <div class="container">
        <div class="text-center mb-3">
            <h1 class="display-6 fw-bold" style="color: #FFFFFF; text-shadow: 0 2px 8px rgba(0,0,0,0.3); letter-spacing: -0.6px; font-size: 1.6rem;">
                <i class="fas fa-plane-departure me-2" style="color: #B9924B;"></i>
                Logan Airport Transfer <span style="color: #B9924B;">| Boston Car Service</span>
            </h1>
        </div>

        <div class="row align-items-stretch">
            <!-- LEFT: COMPACT BOOKING FORM -->
            <div class="col-lg-5 form-column mb-4 mb-lg-0">
                <div class="reservation-card">
                    <div class="form-header">
                        <h3> Booking Reservation</h3>
                        <p>Instant Reservation EMAIL Confirmation</p>
                    </div>
                    <div class="booking-inner">
                        <form id="reservationForm" action="{{ route('step2') }}" method="POST" novalidate>
                            @csrf
                            <input type="hidden" name="extras_total" id="extrasTotalInput" value="0">

                            <!-- Date & Time row compact -->
                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        <input type="text" id="date" name="date" class="form-control flatpickr-input" placeholder="Pickup Date" readonly required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        <select id="time" name="time" class="form-select" required>
                                            <option value="">Select Time</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Trip Type Cards - SINGLE ROW (MOBILE FIX) -->
                            <div class="trip-type-container">
                                <div class="trip-option">
                                    <input type="radio" name="tripType" id="type_from" value="fromAirport" checked>
                                    <label class="trip-card" for="type_from">
                                        <i class="fas fa-plane-arrival"></i>
                                        <span>From Airport</span>
                                    </label>
                                </div>
                                <div class="trip-option">
                                    <input type="radio" name="tripType" id="type_to" value="toAirport">
                                    <label class="trip-card" for="type_to">
                                        <i class="fas fa-plane-departure"></i>
                                        <span>To Airport</span>
                                    </label>
                                </div>
                                <div class="trip-option">
                                    <input type="radio" name="tripType" id="type_ptp" value="doorToDoor">
                                    <label class="trip-card" for="type_ptp">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>Door to Door</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Dynamic Location Fields -->
                            <div id="fromLocation" class="mb-2"></div>
                            <div id="toLocation" class="mb-2"></div>

                            <!-- Passenger & Luggage -->
                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <span class="mini-label"><i class="fas fa-user-tie me-1"></i> Adults (8+)</span>
                                    <select name="adults" id="adults" class="form-select" required>
                                        <option value="">Select</option>
                                        @for ($i = 1; $i <= 14; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-6">
                                    <span class="mini-label"><i class="fas fa-child me-1"></i> Children (≤7)</span>
                                    <select name="children" id="children" class="form-select">
                                        <option value="0">0</option>
                                        @for ($i = 1; $i <= 6; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <span class="mini-label"><i class="fas fa-suitcase-rolling me-1"></i> Luggage</span>
                                    <select name="luggage" id="luggage" class="form-select" required>
                                        <option value="">Select luggage</option>
                                        @for ($i = 0; $i <= 12; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-6">
                                    <span class="mini-label"><i class="fas fa-car-seat me-1"></i> Child Seats</span>
                                    <select name="seats_dummy" id="childSeatsTrigger" class="form-select">
                                        <option value="0">0</option>
                                        @for ($i = 1; $i <= 6; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <!-- Extras Toggle -->
                            <div>
                                <div class="extras-toggle" id="toggleExtrasBtn">
                                    <i class="fas fa-plus-circle"></i>
                                    Add Stops / Children Seat / Pets
                                    <i class="fas fa-chevron-down ms-auto"></i>
                                </div>
                                <div id="extrasSection">
                                    <div class="extra-row">
                                        <div class="extra-label">Stopover <span class="extra-price-tag">${{ $settings->stopover_fee ?? 0 }}</span></div>
                                        <div class="d-flex align-items-center gap-2">
                                            <select id="stopover" name="stopover" data-price="{{ $settings->stopover_fee ?? 0 }}" class="form-select">
                                                <option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option>
                                            </select>
                                            <div id="stopoverDisplay" class="total-price-display">$0</div>
                                        </div>
                                    </div>
                                    <div class="extra-row">
                                        <div class="extra-label">Pets <span class="extra-price-tag">${{ $settings->pet_fee ?? $settings->stopover_fee ?? 0 }}</span></div>
                                        <div class="d-flex align-items-center gap-2">
                                            <select id="pets" name="pets" data-price="{{ $settings->pet_fee ?? $settings->stopover_fee ?? 0 }}" class="form-select">
                                                <option value="0">0</option><option value="1">1</option><option value="2">2</option>
                                            </select>
                                            <div id="petsDisplay" class="total-price-display">$0</div>
                                        </div>
                                    </div>
                                    <div class="extra-row">
                                        <div class="extra-label">Infant Seat <span class="extra-price-tag">${{ $settings->child_seat_fee ?? 0 }}</span></div>
                                        <div class="d-flex align-items-center gap-2">
                                            <select id="infantSeat" name="infant_seat" data-price="{{ $settings->child_seat_fee ?? 0 }}" class="form-select">
                                                <option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>
                                            </select>
                                            <div id="infantSeatDisplay" class="total-price-display">$0</div>
                                        </div>
                                    </div>
                                    <div class="extra-row">
                                        <div class="extra-label">Front Facing <span class="extra-price-tag">${{ $settings->regular_Seat_rules ?? 0 }}</span></div>
                                        <div class="d-flex align-items-center gap-2">
                                            <select id="frontSeat" name="front_seat" data-price="{{ $settings->regular_Seat_rules ?? 0 }}" class="form-select">
                                                <option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>
                                            </select>
                                            <div id="frontSeatDisplay" class="total-price-display">$0</div>
                                        </div>
                                    </div>
                                    <div class="extra-row">
                                        <div class="extra-label">Booster Seat <span class="extra-price-tag">${{ $settings->booster_seat_fee ?? 0 }}</span></div>
                                        <div class="d-flex align-items-center gap-2">
                                            <select id="boosterSeat" name="booster_seat" data-price="{{ $settings->booster_seat_fee ?? 0 }}" class="form-select">
                                                <option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>
                                            </select>
                                            <div id="boosterSeatDisplay" class="total-price-display">$0</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn-get-fare">
                                GET FARE & RESERVE
                            </button>
                            <p class="footer-note">
                                <i class="fas fa-lock me-1"></i>Pay only $1 to confirm. Balance payable after service. 10% cash discount.
                            </p>
                        </form>
                    </div>
                </div>
            </div>

            <!-- RIGHT: MAP SIDEBAR -->
            <div class="col-lg-7 d-flex">
                <div class="map-sidebar-card w-100">
                    <div class="map-header">
                        <h4><i class="fas fa-map-marked-alt"></i> Boston Logan Transfer • LIVE</h4>
                    </div>
                    <div id="map"></div>
                    <div class="location-info-panel">
                        <div class="route-detail">
                            <div class="route-icon">📍</div>
                            <div class="route-text">
                                <strong>PICKUP POINT</strong><br>
                                <span id="pickupAddrDisplay">— Awaiting address —</span><br>
                                <small>Executive concierge</small>
                            </div>
                        </div>
                        <div class="route-detail">
                            <div class="route-icon">🏁</div>
                            <div class="route-text">
                                <strong>DESTINATION</strong><br>
                                <span id="dropoffAddrDisplay">— Not selected —</span><br>
                                <small>Premium arrival zone</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8jlhc5ZRDUU1SHHpxuwFh4dM0Ggq4n2Q&libraries=places&callback=initMap" async defer></script>

<script>
    let map, directionsService, directionsRenderer;
    let googleMapsReady = false;
    let airportsData = [];

    function fetchAirports() {
        return $.ajax({ url: '/airports', method: 'GET', dataType: 'json' });
    }

    function buildAirportSelectFromData(name, includeSelectedLogan = true) {
        if (!airportsData || airportsData.length === 0) {
            return `<select name="${name}" class="form-select" required disabled><option value="">Loading airports...</option></select>`;
        }
        let html = `<select name="${name}" class="form-select" required><option value="">Select Airport</option>`;
        airportsData.forEach(airport => {
            let selected = (airport.name === "Boston Logan International Airport" && includeSelectedLogan) ? "selected" : "";
            html += `<option value="${airport.id}" data-address="${airport.address || airport.name}" data-name="${airport.name}" ${selected}>${airport.name}</option>`;
        });
        html += `</select>`;
        return html;
    }

    function getCurrentPickupAddress() {
        const tripType = document.querySelector('input[name="tripType"]:checked')?.value;
        if (tripType === 'doorToDoor') return "Concierge Pickup";
        if (tripType === 'fromAirport') {
            let sel = document.querySelector('select[name="from_airport"]');
            if (sel && sel.value && !sel.disabled) {
                let selectedOption = sel.options[sel.selectedIndex];
                return selectedOption?.getAttribute('data-address') || selectedOption?.textContent || "Boston Logan Airport";
            }
            return "Boston Logan International Airport";
        } else {
            let inputField = document.getElementById('fromAddress');
            if (inputField && !inputField.disabled) return inputField.value || "Pickup address";
            return "Pickup address";
        }
    }

    function getCurrentDropoffAddress() {
        const tripType = document.querySelector('input[name="tripType"]:checked')?.value;
        if (tripType === 'doorToDoor') return "Concierge Dropoff";
        if (tripType === 'fromAirport') {
            let toInput = document.getElementById('toAddress');
            if (toInput && !toInput.disabled) return toInput.value || "Destination";
            return "Destination";
        } else if (tripType === 'toAirport') {
            let sel = document.querySelector('select[name="to_airport"]');
            if (sel && sel.value && !sel.disabled) {
                let selectedOption = sel.options[sel.selectedIndex];
                return selectedOption?.getAttribute('data-address') || selectedOption?.textContent || "Boston Logan Airport";
            }
            return "Boston Logan International Airport";
        } else {
            let toInput = document.getElementById('toAddress');
            if (toInput && !toInput.disabled) return toInput.value || "Destination address";
            return "Destination address";
        }
    }

    function updateMapRoute() {
        if (!googleMapsReady || !directionsService || !directionsRenderer) return;
        const originRaw = getCurrentPickupAddress();
        const destRaw = getCurrentDropoffAddress();
        document.getElementById('pickupAddrDisplay').innerHTML = originRaw || "— Awaiting address —";
        document.getElementById('dropoffAddrDisplay').innerHTML = destRaw || "— Not selected —";
        if (!originRaw || originRaw === "Pickup address" || !destRaw || destRaw === "Destination address" || destRaw === "Destination") return;
        directionsService.route({
            origin: originRaw,
            destination: destRaw,
            travelMode: google.maps.TravelMode.DRIVING
        }, (response, status) => {
            if (status === 'OK') directionsRenderer.setDirections(response);
        });
    }

    window.initMap = function() {
        const boston = { lat: 42.3601, lng: -71.0589 };
        map = new google.maps.Map(document.getElementById("map"), { center: boston, zoom: 11 });
        directionsService = new google.maps.DirectionsService();
        directionsRenderer = new google.maps.DirectionsRenderer({ map: map, polylineOptions: { strokeColor: "#B9924B", strokeWeight: 5 } });
        googleMapsReady = true;
        setTimeout(() => updateMapRoute(), 400);
    };

    function initAutocompleteOnField(fieldId) {
        if (!window.google || !google.maps.places) setTimeout(() => initAutocompleteOnField(fieldId), 300);
        const inputEl = document.getElementById(fieldId);
        if (inputEl && !inputEl._autocompleteAttached && !inputEl.disabled) {
            const autocomplete = new google.maps.places.Autocomplete(inputEl, { componentRestrictions: { country: "us" }, fields: ["formatted_address"] });
            autocomplete.addListener('place_changed', () => setTimeout(updateMapRoute, 200));
            inputEl._autocompleteAttached = true;
            inputEl.addEventListener('change', () => setTimeout(updateMapRoute, 200));
        }
    }

    function attachAirportSelectEvent(selectName) {
        let sel = document.querySelector(`select[name="${selectName}"]`);
        if (sel) sel.addEventListener("change", () => updateMapRoute());
    }

    function updateTripFields() {
        let t = document.querySelector('input[name="tripType"]:checked')?.value;
        if (!t) return;
        if (t === 'doorToDoor') {
            document.getElementById("fromLocation").innerHTML = `<input type="text" class="form-control" value="📞 Contact Concierge" disabled style="color:#B9924B; font-weight:500;">`;
            document.getElementById("toLocation").innerHTML = `<input type="text" class="form-control" value="📞 Call 857-777-2125" disabled style="color:#B9924B; font-weight:500;">`;
        }
        else if (t === 'fromAirport') {
            document.getElementById("fromLocation").innerHTML = buildAirportSelectFromData("from_airport", true);
            document.getElementById("toLocation").innerHTML = `<input type="text" name="to_address" id="toAddress" class="form-control" placeholder="Enter dropoff address" required>`;
            setTimeout(() => { initAutocompleteOnField("toAddress"); attachAirportSelectEvent("from_airport"); }, 80);
        }
        else if (t === 'toAirport') {
            document.getElementById("fromLocation").innerHTML = `<input type="text" name="from_address" id="fromAddress" class="form-control" placeholder="Enter pickup address" required>`;
            document.getElementById("toLocation").innerHTML = buildAirportSelectFromData("to_airport", true);
            setTimeout(() => { initAutocompleteOnField("fromAddress"); attachAirportSelectEvent("to_airport"); }, 80);
        }
        setTimeout(() => updateMapRoute(), 250);
    }

    function updateLuggageByPassengers() {
        let adults = parseInt($("#adults").val()) || 0;
        let children = parseInt($("#children").val()) || 0;
        let totalPax = adults + children;

        if (totalPax === 0) return;

        // Show loading state
        $("#luggage").html('<option value="">Loading...</option>');
        $("#luggage").prop('disabled', true);

        $.ajax({
            url: "{{ route('luggage.capacity') }}",
            type: "GET",
            data: { passenger: totalPax },
            dataType: "json",
            success: function(response) {
                const maxLuggage = (response && response.capacity_luggage !== undefined) ? parseInt(response.capacity_luggage) : 12;
                let html = '<option value="">Select luggage</option>';
                for (let i = 0; i <= maxLuggage; i++) {
                    let selected = (i === 1) ? 'selected' : '';
                    html += `<option value="${i}" ${selected}>${i}</option>`;
                }
                $("#luggage").html(html);
                $("#luggage").prop('disabled', false);
            },
            error: function() {
                let html = '<option value="">Select luggage</option>';
                for (let i = 0; i <= 12; i++) {
                    html += `<option value="${i}" ${i === 1 ? 'selected' : ''}>${i}</option>`;
                }
                $("#luggage").html(html);
                $("#luggage").prop('disabled', false);
            }
        });
    }

    document.addEventListener("DOMContentLoaded", () => {
        fetchAirports().then(response => { airportsData = response; initializeForm(); }).catch(error => { console.error(error); airportsData = [{ id: 1, name: "Boston Logan International Airport", address: "Boston Logan Int'l Airport, Boston, MA" }]; initializeForm(); });
    });

    function initializeForm() {
        flatpickr("#date", { minDate: "today", dateFormat: "Y-m-d", disableMobile: true });

        const timeSelect = document.getElementById("time");
        for (let h = 0; h < 24; h++) {
            for (let m = 0; m < 60; m += 15) {
                let hh = String(h).padStart(2, '0'), mmStr = String(m).padStart(2, '0');
                let ampm = h < 12 ? 'AM' : 'PM', displayHour = h % 12 || 12;
                timeSelect.innerHTML += `<option value="${hh}:${mmStr}">${displayHour}:${mmStr} ${ampm}</option>`;
            }
        }

        // Luggage update on passenger change using AJAX
        $("#adults, #children").on("change", function() {
            updateLuggageByPassengers();
        });

        // Initial luggage load
        setTimeout(updateLuggageByPassengers, 100);

        // Trip type change handler with Door-to-Door notification
        document.querySelectorAll('input[name="tripType"]').forEach(r => r.addEventListener('change', (e) => {
            updateTripFields();
            if(e.target.value === 'doorToDoor') {
                Swal.fire({
                    icon: 'info',
                    title: '🚖 Door-to-Door Service',
                    text: 'Please call our concierge at 857-777-2125 for door-to-door booking',
                    background: '#0F171D',
                    color: '#FFF',
                    confirmButtonColor: '#B9924B',
                    confirmButtonText: 'Call Now'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'tel:8577772125';
                    }
                });
            }
        }));

        updateTripFields();

        // Extras calculation
        const extras = [
            { id: 'stopover', price: {{ $settings->stopover_fee ?? 0 }} },
            { id: 'pets', price: {{ $settings->pet_fee ?? $settings->stopover_fee ?? 0 }} },
            { id: 'infantSeat', price: {{ $settings->child_seat_fee ?? 0 }} },
            { id: 'frontSeat', price: {{ $settings->regular_Seat_rules ?? 0 }} },
            { id: 'boosterSeat', price: {{ $settings->booster_seat_fee ?? 0 }} }
        ];

        extras.forEach(item => {
            let el = document.getElementById(item.id);
            if(el) el.addEventListener("change", () => {
                let total = (parseInt(el.value)||0) * item.price;
                document.getElementById(item.id + "Display").innerText = "$" + total;
                let grand = extras.reduce((sum, it) => sum + ((parseInt(document.getElementById(it.id)?.value)||0) * it.price), 0);
                document.getElementById("extrasTotalInput").value = grand;
            });
        });

        $("#toggleExtrasBtn").on("click", function() { $("#extrasSection").slideToggle(); $(this).find(".fa-chevron-down").toggleClass("fa-chevron-up"); });

        $("#childSeatsTrigger").on("change", function(){
            if($(this).val() !== "0" && $("#extrasSection").is(":hidden")) {
                $("#extrasSection").slideDown();
                $("#toggleExtrasBtn .fa-chevron-down").addClass("fa-chevron-up");
            }
        });

        // Form submission
        $("#reservationForm").on("submit", function(e){
            e.preventDefault();

            const tripType = document.querySelector('input[name="tripType"]:checked')?.value;

            if(tripType === 'doorToDoor') {
                Swal.fire({
                    icon: 'info',
                    title: '🚖 Door-to-Door Service',
                    text: 'Please call our concierge at 857-777-2125 for door-to-door booking',
                    background: '#0F171D',
                    color: '#FFF',
                    confirmButtonColor: '#B9924B',
                    confirmButtonText: 'Call Now'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'tel:8577772125';
                    }
                });
                return;
            }

            let missing = !$("#date").val() || !$("#time").val() || !$("#adults").val() || !$("#luggage").val();
            let fromVal = document.querySelector('[name="from_airport"]')?.value || document.querySelector('[name="from_address"]')?.value;
            let toVal = document.querySelector('[name="to_airport"]')?.value || document.querySelector('[name="to_address"]')?.value;

            if(missing || !fromVal || !toVal) {
                return Swal.fire({ icon: 'warning', title: 'Incomplete', text: 'Fill all required fields', background: '#0F171D', color: '#FFF', confirmButtonColor: '#B9924B' });
            }

            // Child seats validation
            const requiredSeats = parseInt($("#childSeatsTrigger").val()) || 0;
            const vInfant = parseInt($("#infantSeat").val()) || 0;
            const vFront = parseInt($("#frontSeat").val()) || 0;
            const vBooster = parseInt($("#boosterSeat").val()) || 0;

            if(requiredSeats > 0 && requiredSeats !== (vInfant + vFront + vBooster)) {
                Swal.fire({ icon: 'error', title: 'Seat Mismatch', text: `Please select ${requiredSeats} child seat(s)`, background: '#0F171D', color: '#FFF', confirmButtonColor: '#B9924B' });
                return;
            }

            Swal.fire({ title: 'Processing', text: 'Redirecting to secure portal', icon: 'success', timer: 1200, showConfirmButton: false, background: '#0F171D', didClose: () => { document.getElementById("reservationForm").submit(); } });
        });

        $(document).on('change keyup', '#fromAddress, #toAddress, select[name="from_airport"], select[name="to_airport"]', () => setTimeout(updateMapRoute, 400));
    }
</script>

