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
        height: 36px;           /* Compact height */
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

    /* Compact Trip Cards */
    .trip-type-container {
        display: flex;
        gap: 8px;
        margin: 6px 0 10px 0;
    }

    .trip-option {
        flex: 1;
    }

    .trip-option input {
        display: none;
    }

    .trip-card {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        padding: 5px 6px;
        border: 1px solid var(--border-dark);
        border-radius: 28px;
        cursor: pointer;
        transition: 0.2s;
        background: var(--bg-dark);
        gap: 5px;
        font-weight: 600;
        color: var(--text-muted);
        font-size: 0.7rem;
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

    /* Responsive */
    @media (max-width: 991px) {
        .reservation-card {
            margin-bottom: 20px;
        }
        .booking-inner {
            padding: 12px;
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
</style>

<section class="hero-section">
    <div class="container">
        <div class="text-center mb-3">
            <h1 class="display-6 fw-bold" style="color: #FFFFFF; text-shadow: 0 2px 8px rgba(0,0,0,0.3); letter-spacing: -0.6px; font-size: 1.6rem;">
                <i class="fas fa-plane-departure me-2" style="color: #B9924B;"></i>
                Logan Transfer <span style="color: #B9924B;">| Boston Limousine</span>
            </h1>
            <p class="text-light-emphasis" style="color: #fff; font-size: 0.7rem;">Boston Limousine • Luxury Fleet • Executive Service</p>
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
                        <form id="reservationForm" action="{{ route('step2') }}" method="GET" novalidate>
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

                            <!-- Trip Type Cards -->
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
                                        <option value="1">1</option><option value="2">2</option>
                                        <option value="3">3</option><option value="4">4</option>
                                        <option value="5">5</option><option value="6">6</option>
                                        <option value="7">7</option><option value="8">8</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <span class="mini-label"><i class="fas fa-child me-1"></i> Children (≤7)</span>
                                    <select name="children" id="children" class="form-select">
                                        <option value="0">0</option><option value="1">1</option>
                                        <option value="2">2</option><option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <span class="mini-label"><i class="fas fa-suitcase-rolling me-1"></i> Luggage</span>
                                    <select name="luggage" id="luggage" class="form-select" required>
                                        <option value="">Select luggage</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <span class="mini-label"><i class="fas fa-car-seat me-1"></i> Child Seats</span>
                                    <select name="seats_dummy" id="childSeatsTrigger" class="form-select">
                                        <option value="0">0</option><option value="1">1</option>
                                        <option value="2">2</option><option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Extras Toggle -->
                            <div>
                                <div class="extras-toggle" id="toggleExtrasBtn">
                                    <i class="fas fa-plus-circle"></i>
                                    Add Stops / Premium Seats / Pets
                                    <i class="fas fa-chevron-down ms-auto"></i>
                                </div>
                                <div id="extrasSection">
                                    <div class="extra-row">
                                        <div class="extra-label">Stopover <span class="extra-price-tag">$25</span></div>
                                        <div class="d-flex align-items-center gap-2">
                                            <select id="stopover" data-price="25" class="form-select">
                                                <option value="0">0</option><option value="1">1</option><option value="2">2</option>
                                            </select>
                                            <div id="stopoverDisplay" class="total-price-display">$0</div>
                                        </div>
                                    </div>
                                    <div class="extra-row">
                                        <div class="extra-label">Pets <span class="extra-price-tag">$20</span></div>
                                        <div class="d-flex align-items-center gap-2">
                                            <select id="pets" data-price="20" class="form-select">
                                                <option value="0">0</option><option value="1">1</option><option value="2">2</option>
                                            </select>
                                            <div id="petsDisplay" class="total-price-display">$0</div>
                                        </div>
                                    </div>
                                    <div class="extra-row">
                                        <div class="extra-label">Infant Seat <span class="extra-price-tag">$15</span></div>
                                        <div class="d-flex align-items-center gap-2">
                                            <select id="infantSeat" data-price="15" class="form-select">
                                                <option value="0">0</option><option value="1">1</option><option value="2">2</option>
                                            </select>
                                            <div id="infantSeatDisplay" class="total-price-display">$0</div>
                                        </div>
                                    </div>
                                    <div class="extra-row">
                                        <div class="extra-label">Front Facing <span class="extra-price-tag">$15</span></div>
                                        <div class="d-flex align-items-center gap-2">
                                            <select id="frontSeat" data-price="15" class="form-select">
                                                <option value="0">0</option><option value="1">1</option><option value="2">2</option>
                                            </select>
                                            <div id="frontSeatDisplay" class="total-price-display">$0</div>
                                        </div>
                                    </div>
                                    <div class="extra-row">
                                        <div class="extra-label">Booster Seat <span class="extra-price-tag">$12</span></div>
                                        <div class="d-flex align-items-center gap-2">
                                            <select id="boosterSeat" data-price="12" class="form-select">
                                                <option value="0">0</option><option value="1">1</option><option value="2">2</option>
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
                        <h4><i class="fas fa-map-marked-alt"></i> Boston Limousine • LIVE</h4>
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
                        {{-- <div class="dynamic-fare-badge" id="estimatedFareMsg">
                            <span><i class="fas fa-dollar-sign"></i> Est. fare: — </span>
                            <span><i class="fas fa-road"></i> Distance: — mi</span>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Rest of JavaScript remains the same -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB8jlhc5ZRDUU1SHHpxuwFh4dM0Ggq4n2Q&libraries=places&callback=initMap" async defer></script>

<script>
    // [JavaScript remains exactly the same as your original]
    let map, directionsService, directionsRenderer;
    let googleMapsReady = false;

    const airportsList = [
        { id: 1, name: "Boston Logan International Airport", address: "Boston Logan Int'l Airport, Boston, MA" },
        { id: 2, name: "Manchester-Boston Regional Airport", address: "Manchester, NH" },
        { id: 3, name: "T.F. Green Airport", address: "Warwick, RI" }
    ];

    function getCurrentPickupAddress() {
        const tripType = document.querySelector('input[name="tripType"]:checked')?.value;
        if (tripType === 'doorToDoor') return "Concierge Pickup";
        if (tripType === 'fromAirport') {
            let sel = document.querySelector('select[name="from_airport"]');
            if (sel && sel.value && !sel.disabled) return sel.options[sel.selectedIndex]?.textContent || "Boston Logan Airport";
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
            if (sel && sel.value && !sel.disabled) return sel.options[sel.selectedIndex]?.textContent || "Boston Logan Airport";
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
        const tripType = document.querySelector('input[name="tripType"]:checked')?.value;
        if (tripType === 'doorToDoor') {
            document.getElementById('estimatedFareMsg').innerHTML = `<span><i class="fas fa-concierge-bell"></i> Contact Concierge</span><span><i class="fas fa-phone-alt"></i> +1 (617) 555-8888</span>`;
            return;
        }
        if (!originRaw || originRaw === "Pickup address" || !destRaw || destRaw === "Destination address" || destRaw === "Destination") return;
        directionsService.route({
            origin: originRaw,
            destination: destRaw,
            travelMode: google.maps.TravelMode.DRIVING
        }, (response, status) => {
            if (status === 'OK') {
                directionsRenderer.setDirections(response);
                let route = response.routes[0];
                let distanceMiles = (route.legs[0].distance.value / 1609.34).toFixed(1);
                let durationMin = Math.round(route.legs[0].duration.value / 60);
                let baseFare = 45, perMile = 2.5;
                let estFare = (baseFare + (parseFloat(distanceMiles) * perMile)).toFixed(0);
                document.getElementById('estimatedFareMsg').innerHTML = `<span><i class="fas fa-dollar-sign"></i> $${estFare}</span><span><i class="fas fa-road"></i> ${distanceMiles} mi · ${durationMin} min</span>`;
            } else {
                document.getElementById('estimatedFareMsg').innerHTML = `<span><i class="fas fa-exclamation-triangle"></i> Route unavailable</span><span>— mi</span>`;
            }
        });
    }

    window.initMap = function() {
        const boston = { lat: 42.3601, lng: -71.0589 };
        map = new google.maps.Map(document.getElementById("map"), {
            center: boston,
            zoom: 11,
            styles: [
                { featureType: "all", elementType: "geometry", stylers: [{ color: "#F5F8FC" }] },
                { featureType: "water", elementType: "geometry", stylers: [{ color: "#D4E5F0" }] },
                { featureType: "road.highway", elementType: "geometry", stylers: [{ color: "#FEF3C7" }, { weight: 2 }] }
            ],
            zoomControl: true,
            mapTypeControl: false,
        });
        directionsService = new google.maps.DirectionsService();
        directionsRenderer = new google.maps.DirectionsRenderer({
            map: map,
            polylineOptions: { strokeColor: "#B9924B", strokeWeight: 5, strokeOpacity: 0.9 }
        });
        googleMapsReady = true;
        setTimeout(() => updateMapRoute(), 400);
    };

    function initAutocompleteOnField(fieldId) {
        if (!window.google || !google.maps.places) setTimeout(() => initAutocompleteOnField(fieldId), 300);
        const inputEl = document.getElementById(fieldId);
        if (inputEl && !inputEl._autocompleteAttached && !inputEl.disabled) {
            const autocomplete = new google.maps.places.Autocomplete(inputEl, {
                componentRestrictions: { country: "us" },
                fields: ["formatted_address"]
            });
            autocomplete.addListener('place_changed', () => setTimeout(updateMapRoute, 200));
            inputEl._autocompleteAttached = true;
            inputEl.addEventListener('change', () => setTimeout(updateMapRoute, 200));
        }
    }

    function buildAirportSelect(name, includeSelectedLogan = true) {
        let html = `<select name="${name}" class="form-select" required><option value="">Select Airport</option>`;
        airportsList.forEach(airport => {
            let selected = (airport.name === "Boston Logan International Airport" && includeSelectedLogan) ? "selected" : "";
            html += `<option value="${airport.id}" data-address="${airport.address}" ${selected}>${airport.name}</option>`;
        });
        html += `</select>`;
        return html;
    }

    function updateTripFields() {
        let t = document.querySelector('input[name="tripType"]:checked')?.value;
        if (!t) return;
        if (t === 'doorToDoor') {
            document.getElementById("fromLocation").innerHTML = `<input type="text" class="form-control" value="📞 Contact Concierge" disabled style="color:#B9924B; font-weight:500;">`;
            document.getElementById("toLocation").innerHTML = `<input type="text" class="form-control" value="📞 Call +1 (617) 555-8888" disabled style="color:#B9924B; font-weight:500;">`;
        }
        else if (t === 'fromAirport') {
            document.getElementById("fromLocation").innerHTML = buildAirportSelect("from_airport", true);
            document.getElementById("toLocation").innerHTML = `<input type="text" name="to_address" id="toAddress" class="form-control" placeholder="Enter dropoff address" required>`;
            setTimeout(() => {
                initAutocompleteOnField("toAddress");
                attachAirportSelectEvent("from_airport");
            }, 80);
        }
        else if (t === 'toAirport') {
            document.getElementById("fromLocation").innerHTML = `<input type="text" name="from_address" id="fromAddress" class="form-control" placeholder="Enter pickup address" required>`;
            document.getElementById("toLocation").innerHTML = buildAirportSelect("to_airport", true);
            setTimeout(() => {
                initAutocompleteOnField("fromAddress");
                attachAirportSelectEvent("to_airport");
            }, 80);
        }
        setTimeout(() => updateMapRoute(), 250);
    }

    function attachAirportSelectEvent(selectName) {
        let sel = document.querySelector(`select[name="${selectName}"]`);
        if (sel) sel.addEventListener("change", () => updateMapRoute());
    }

    document.addEventListener("DOMContentLoaded", () => {
        flatpickr("#date", { minDate: "today", dateFormat: "Y-m-d", disableMobile: true });

        const timeSelect = document.getElementById("time");
        for (let h = 0; h < 24; h++) {
            for (let m = 0; m < 60; m += 15) {
                let hh = String(h).padStart(2, '0'), mmStr = String(m).padStart(2, '0');
                let ampm = h < 12 ? 'AM' : 'PM', displayHour = h % 12 || 12;
                timeSelect.innerHTML += `<option value="${hh}:${mmStr}">${displayHour}:${mmStr} ${ampm}</option>`;
            }
        }

        function updateLuggageMax() {
            let adults = parseInt($("#adults").val()) || 1, children = parseInt($("#children").val()) || 0;
            let total = adults + children, maxLug = Math.min(10, total + 2);
            let opts = '<option value="">Select luggage</option>';
            for (let i = 0; i <= maxLug; i++) opts += `<option value="${i}">${i}</option>`;
            $("#luggage").html(opts);
            if ($("#luggage").val() === "") $("#luggage").val(1);
        }

        $("#adults, #children").on("change", updateLuggageMax);
        updateLuggageMax();

        document.querySelectorAll('input[name="tripType"]').forEach(r => {
            r.addEventListener('change', (e) => {
                updateTripFields();
                if(e.target.value === 'doorToDoor') {
                    Swal.fire({
                        icon: 'info',
                        title: '🚖 Door-to-Door',
                        text: 'Call Concierge +1 (617) 555-8888',
                        background: '#0F171D',
                        color: '#FFF',
                        confirmButtonColor: '#B9924B'
                    });
                }
            });
        });
        updateTripFields();

        const extras = [
            { id: 'stopover', price: 25 },
            { id: 'pets', price: 20 },
            { id: 'infantSeat', price: 15 },
            { id: 'frontSeat', price: 15 },
            { id: 'boosterSeat', price: 12 }
        ];

        extras.forEach(item => {
            let el = document.getElementById(item.id);
            if(el) {
                el.addEventListener("change", () => {
                    let total = (parseInt(el.value)||0) * item.price;
                    document.getElementById(item.id + "Display").innerText = "$" + total;
                    let grand = extras.reduce((sum, it) => sum + ((parseInt(document.getElementById(it.id)?.value)||0) * it.price), 0);
                    document.getElementById("extrasTotalInput").value = grand;
                });
            }
        });

        $("#toggleExtrasBtn").on("click", function() {
            $("#extrasSection").slideToggle();
            $(this).find(".fa-chevron-down").toggleClass("fa-chevron-up");
        });

        $("#childSeatsTrigger").on("change", function(){
            if($(this).val() !== "0" && $("#extrasSection").is(":hidden")) {
                $("#extrasSection").slideDown();
                $("#toggleExtrasBtn .fa-chevron-down").addClass("fa-chevron-up");
            }
        });

        $("#reservationForm").on("submit", function(e){
            e.preventDefault();
            const tripType = document.querySelector('input[name="tripType"]:checked')?.value;
            if(tripType === 'doorToDoor') {
                Swal.fire({
                    icon: 'info',
                    title: 'Concierge Booking',
                    text: 'Please call +1 (617) 555-8888',
                    background: '#0F171D',
                    color: '#FFF',
                    confirmButtonColor: '#B9924B'
                });
                return;
            }

            let missing = !$("#date").val() || !$("#time").val() || !$("#adults").val() || !$("#luggage").val();
            let fromVal = document.querySelector('[name="from_airport"]')?.value || document.querySelector('[name="from_address"]')?.value;
            let toVal = document.querySelector('[name="to_airport"]')?.value || document.querySelector('[name="to_address"]')?.value;

            if(missing || !fromVal || !toVal) {
                return Swal.fire({
                    icon: 'warning',
                    title: 'Incomplete',
                    text: 'Fill all required fields',
                    background: '#0F171D',
                    color: '#FFF',
                    confirmButtonColor: '#B9924B'
                });
            }

            Swal.fire({
                title: 'Processing',
                text: 'Redirecting to secure portal',
                icon: 'success',
                timer: 1200,
                showConfirmButton: false,
                background: '#0F171D',
                didClose: () => {
                    document.getElementById("reservationForm").submit();
                }
            });
        });

        $(document).on('change keyup', '#fromAddress, #toAddress, select[name="from_airport"], select[name="to_airport"]', () => setTimeout(updateMapRoute, 400));
    });
</script>
