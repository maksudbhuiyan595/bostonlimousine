@extends('layout.app')
@section('title', "Step2")

@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        /* --- PREMIUM AMBER COLOR SCHEME (#B9924B) --- */
        .booking-wrapper {
            font-family: 'Inter', sans-serif;
            color: #1F2937;
            background: linear-gradient(135deg, #F9FAFB 0%, #F0F4F8 100%);
            max-width: 1280px;
            margin: 0 auto;
            padding: 40px 20px;
            margin-top: 20px;
            border-radius: 12px;
        }

        .booking-wrapper {
            --premium-amber: #B9924B;
            --premium-amber-dark: #8B6B2E;
            --premium-amber-light: #D4AE6E;
            --premium-amber-glow: rgba(185, 146, 75, 0.2);
            --primary-brand: #B9924B;
            --primary-brand-hover: #8B6B2E;
            --primary-dark: #1F2937;
            --secondary-text: #6B7280;
            --price-red: #DC2626;
            --card-bg-dark: #2C3E50;
            --sidebar-bg: #FFFBEB;
            --sidebar-border: #FCD34D;
            --radius: 12px;
            margin-top: 90px;
        }

        /* HEADER */
        .booking-wrapper .breadcrumb-nav {
            font-size: 0.9rem;
            color: var(--secondary-text);
            margin-bottom: 12px;
            margin-top: -12px;
            font-weight: 500;
        }

        .booking-wrapper .breadcrumb-nav span {
            color: var(--primary-brand);
            font-weight: 700;
        }

        .booking-wrapper .page-title {
            font-weight: 800;
            font-size: 2rem;
            margin-bottom: 10px;
            color: var(--primary-dark);
            letter-spacing: -0.5px;
        }

        .booking-wrapper .page-sub {
            font-size: 1rem;
            color: var(--secondary-text);
            margin-bottom: 50px;
            margin-bottom: 20px;
        }

        /* LEFT COL: VEHICLE CARD */
        .vehicle-card-dark {
            background: linear-gradient(145deg, #2C3E50, #1a252f);
            border-radius: var(--radius);
            color: white;
            padding: 30px;
            text-align: center;
            margin-bottom: 25px;
            position: relative;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            border-top: 3px solid var(--primary-brand);
        }

        .vehicle-card-dark:hover {
            transform: translateY(-2px);
        }

        .v-img-main {
            max-width: 100%;
            height: auto;
            max-height: 220px;
            object-fit: contain;
            margin-bottom: 20px;
            filter: drop-shadow(0 15px 25px rgba(0, 0, 0, 0.4));
            transition: transform 0.5s ease;
        }

        .vehicle-card-dark:hover .v-img-main {
            transform: scale(1.05);
        }

        .v-title-main {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 25px;
            color: #fff;
        }

        .v-icons-row {
            display: flex;
            justify-content: center;
            gap: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            padding-top: 20px;
            margin-top: 15px;
        }

        .v-icon-box {
            text-align: center;
            font-size: 0.85rem;
            opacity: 0.9;
        }

        .v-icon-box i {
            font-size: 1.6rem;
            display: block;
            margin-bottom: 8px;
            color: var(--primary-brand);
        }

        /* PAYMENT TOGGLE */
        .pay-box-container {
            display: flex;
            border: 1px solid #E5E7EB;
            background: #fff;
            border-radius: var(--radius);
            position: relative;
            margin-bottom: 15px;
            overflow: hidden;
        }

        .discount-badge {
            position: absolute;
            top: -12px;
            left: -12px;
            background: linear-gradient(135deg, var(--premium-amber), var(--premium-amber-dark));
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 0.75rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transform: rotate(-15deg);
        }

        .pay-col {
            flex: 1;
            padding: 20px;
            text-align: center;
            transition: background 0.2s;
            cursor: pointer;
        }

        .pay-col:first-child {
            border-right: 1px solid #E5E7EB;
        }

        .pay-col:hover {
            background-color: rgba(185, 146, 75, 0.05);
        }

        .pay-lbl {
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            display: block;
            color: var(--secondary-text);
            margin-bottom: 5px;
        }

        .pay-amt {
            font-size: 1.4rem;
            font-weight: 800;
            display: block;
            margin: 5px 0;
            color: var(--primary-dark);
        }

        .text-red {
            color: var(--price-red);
        }

        .pay-note {
            font-size: 0.75rem;
            color: #9CA3AF;
            font-weight: 500;
        }

        .bottom-note {
            font-size: 0.8rem;
            color: var(--secondary-text);
            line-height: 1.5;
            margin-bottom: 40px;
            background: #F3F4F6;
            padding: 12px;
            border-radius: 8px;
            border-left: 4px solid var(--primary-brand);
        }

        /* PRICING TABLE */
        .pricing-card {
            background: white;
            border-radius: var(--radius);
            padding: 25px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid #E5E7EB;
            height: 100%;
            transition: all 0.3s ease;
        }

        .pricing-card:hover {
            border-color: var(--primary-brand);
            box-shadow: 0 10px 25px -5px rgba(185, 146, 75, 0.1);
        }

        .pricing-header {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--primary-dark);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(185, 146, 75, 0.2);
        }

        .pricing-header i {
            color: var(--primary-brand);
            margin-right: 8px;
        }

        .pricing-table {
            width: 100%;
            font-size: 0.95rem;
            color: var(--primary-dark);
        }

        .pricing-table td {
            padding: 8px 0;
            vertical-align: top;
        }

        .pricing-table td:nth-child(2) {
            width: 25px;
            text-align: center;
            color: #D1D5DB;
        }

        .pricing-table td:last-child {
            text-align: right;
            font-weight: 700;
        }

        .extra-lug-box {
            background: var(--sidebar-bg);
            border: 1px dashed var(--sidebar-border);
            padding: 15px;
            margin-top: 25px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #92400E;
        }

        /* SIDEBAR */
        .btn-book-primary {
            display: block;
            width: 100%;
            background: linear-gradient(135deg, var(--primary-brand) 0%, var(--primary-brand-hover) 100%);
            color: white;
            text-align: center;
            font-weight: 700;
            padding: 18px;
            border-radius: var(--radius);
            border: none;
            text-decoration: none;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            font-size: 1.1rem;
            box-shadow: 0 4px 15px rgba(185, 146, 75, 0.3);
        }

        .btn-book-primary:hover {
            background: linear-gradient(135deg, var(--primary-brand-hover) 0%, #6B4E1A 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(185, 146, 75, 0.4);
        }

        .summary-box {
            background: var(--sidebar-bg);
            border: 1px solid var(--sidebar-border);
            padding: 25px;
            border-radius: var(--radius);
        }

        .sum-header {
            font-weight: 800;
            font-size: 1.1rem;
            margin-bottom: 20px;
            color: var(--primary-brand);
            text-transform: uppercase;
            border-bottom: 1px dashed var(--sidebar-border);
            padding-bottom: 10px;
        }

        .sum-table {
            width: 100%;
            font-size: 0.9rem;
            color: #4B5563;
        }

        .sum-table td {
            padding: 6px 0;
            vertical-align: top;
        }

        .sum-table td:first-child {
            font-weight: 600;
            width: 100px;
            color: var(--primary-brand);
        }

        .sum-val {
            color: #1F2937;
            font-weight: 600;
        }

        /* MORE OPTIONS */
        .more-opt-title {
            text-align: center;
            margin: 60px 0 40px;
            font-weight: 800;
            color: var(--primary-dark);
            font-size: 1.5rem;
            position: relative;
        }

        .more-opt-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-brand), var(--primary-brand-hover));
            margin: 10px auto 0;
            border-radius: 2px;
        }

        .veh-row {
            background: white;
            border: 1px solid #E5E7EB;
            border-radius: var(--radius);
            padding: 25px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .veh-row:hover {
            border-color: var(--primary-brand);
            box-shadow: 0 10px 25px -5px rgba(185, 146, 75, 0.15);
            transform: translateY(-3px);
        }

        .vr-img-box {
            width: 180px;
            margin-right: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .vr-img {
            width: 100%;
            height: auto;
            object-fit: contain;
            transition: transform 0.3s;
        }

        .veh-row:hover .vr-img {
            transform: scale(1.05);
        }

        .vr-info h5 {
            margin: 0 0 8px;
            font-weight: 800;
            font-size: 1.2rem;
            color: var(--primary-dark);
        }

        .vr-meta {
            font-size: 0.9rem;
            color: var(--secondary-text);
            margin-bottom: 8px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .vr-meta i {
            color: var(--primary-brand);
            margin-right: 5px;
        }

        .vr-action {
            margin-left: auto;
            text-align: right;
            min-width: 160px;
        }

        .vr-price {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary-brand);
            display: block;
            margin-bottom: 10px;
        }

        .btn-select {
            border: 2px solid var(--primary-brand);
            background: transparent;
            color: var(--primary-brand);
            padding: 8px 20px;
            font-weight: 700;
            font-size: 0.9rem;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-select:hover {
            background: var(--primary-brand);
            color: white;
        }

        .d-none-custom {
            display: none !important;
        }

        /* Alert Styles */
        .alert-warning-custom {
            background: #FEF3C7;
            border: 1px solid var(--primary-brand);
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            color: #92400E;
        }

        @media(max-width: 768px) {
            .veh-row {
                flex-direction: column;
                text-align: center;
            }

            .vr-img-box {
                width: 100%;
                margin: 0 0 20px 0;
            }

            .vr-action {
                margin-top: 20px;
                margin-left: 0;
                width: 100%;
            }

            .vr-meta {
                justify-content: center;
            }

            .pay-box-container {
                flex-direction: row;
            }

            .pricing-card {
                margin-bottom: 25px;
            }

            .page-title {
                font-size: 1.5rem;
            }
        }
    </style>

    <div class="booking-wrapper animate__animated animate__fadeIn">

        <div class="breadcrumb-nav">
            <i class="fas fa-home" style="color: #B9924B;"></i> Home &raquo; Reservation &raquo; <span>Choose vehicle (Step
                2 of 4)</span>
        </div>

        <h1 class="page-title">Select Vehicle & Confirm Ride</h1>
        <p class="page-sub">Review your selection and choose the best option for your journey.</p>

        <form id="bookingForm" action="{{ route('step3') }}" method="GET">

            {{-- Hidden Inputs (Data Passing) with Null Safety --}}
            @if(isset($request) && is_array($request))
                @foreach($request as $key => $value)
                    @if(!is_array($value) && $key != 'fare')
                        <input type="hidden" name="{{ $key }}" value="{{ $value ?? '' }}">
                    @endif
                @endforeach
            @endif

            <input type="hidden" name="distance_miles" value="{{ $distance_miles ?? 0 }}">
            <input type="hidden" name="trip_type" value="{{ $trip_type ?? '' }}">
            <input type="hidden" name="pickup" value="{{ $pickup ?? '' }}">
            <input type="hidden" name="dropoff" value="{{ $dropoff ?? '' }}">
            <input type="hidden" name="vehicles_used" value="1">
            <input type="hidden" name="reqPassengers" value="{{ $reqPassengers ?? 0 }}">

            {{-- Dynamic Inputs with Null Safety --}}
            <input type="hidden" name="vehicle_id" id="inp_vid" value="{{ $defaultVehicle['vehicle_id'] ?? '' }}">
            <input type="hidden" name="fare[name]" id="inp_vname" value="{{ $defaultVehicle['name'] ?? '' }}">
            <input type="hidden" name="fare[estimatedFare]" id="inp_base"
                value="{{ $defaultVehicle['estimated_fare'] ?? 0 }}">
            <input type="hidden" name="fare[gratuity]" id="inp_grat" value="{{ $defaultVehicle['gratuity_fee'] ?? 0 }}">
            <input type="hidden" name="fare[surcharge_fee]" id="inp_sur"
                value="{{ $defaultVehicle['surcharge_fee'] ?? 0 }}">
            <input type="hidden" name="fare[extra_luggage_fee]" id="inp_elug"
                value="{{ $defaultVehicle['extra_luggage_fee'] ?? 0 }}">
            <input type="hidden" name="fare[total]" id="inp_total" value="{{ $defaultVehicle['total_fare'] ?? 0 }}">
            <input type="hidden" name="pay_cash" id="inp_cash" value="{{ $defaultVehicle['pay_cash'] ?? 0 }}">

            {{-- Static Fees with Null Safety --}}
            <input type="hidden" name="fare[pickup_tax]" value="{{ $defaultVehicle['pickup_tax'] ?? 0 }}">
            <input type="hidden" name="fare[dropoff_tax]" value="{{ $defaultVehicle['dropoff_tax'] ?? 0 }}">
            <input type="hidden" name="fare[parking_fee]" value="{{ $defaultVehicle['parking_fee'] ?? 0 }}">
            <input type="hidden" name="fare[stopover_fee]" value="{{ $defaultVehicle['stopover_fee'] ?? 0 }}">
            <input type="hidden" name="fare[pet_fee]" value="{{ $defaultVehicle['pet_fee'] ?? 0 }}">
            <input type="hidden" name="fare[child_seat_fee]" value="{{ $defaultVehicle['child_seat_fee'] ?? 0 }}">
            <input type="hidden" name="fare[booster_seat_fee]" value="{{ $defaultVehicle['booster_seat_fee'] ?? 0 }}">
            <input type="hidden" name="fare[front_seat_fee]" value="{{ $defaultVehicle['front_seat_fee'] ?? 0 }}">
            <input type="hidden" name="fare[extra_charges]" value="{{ $defaultVehicle['extra_charges'] ?? 0 }}">
            <input type="hidden" name="fare[toll_fee]" value="{{ $defaultVehicle['toll_fee'] ?? 0 }}">

            <div class="row">

                {{-- COLUMN 1: Vehicle Card --}}
                <div class="col-lg-4">
                    <div class="vehicle-card-dark">
                        <img src="{{ (!empty($defaultVehicle) && !empty($defaultVehicle['image'])) ? asset($defaultVehicle['image']) : asset('images/car-3.png') }}"
                            id="disp_img" class="v-img-main"
                            onerror="this.onerror=null;this.src='{{ asset('images/car-3.png') }}';">
                        <div class="v-title-main">
                            <i class="fas fa-users" style="color: #B9924B;"></i>
                            <span id="disp_pax">{{ $defaultVehicle['capacity_passenger'] ?? 0 }}</span> Passenger
                            <span id="disp_name">{{ $defaultVehicle['name'] ?? 'Vehicle' }}</span>
                            <span id="disp_lug">{{ $defaultVehicle['capacity_luggage'] ?? 0 }}</span> Bags
                        </div>
                        <div class="v-icons-row">
                            <div class="v-icon-box" title="Passengers">
                                <i class="fas fa-user-friends"></i>
                                <div>{{ $reqPassengers ?? 0 }} Passenger</div>
                            </div>
                            <div class="v-icon-box" title="Luggage">
                                <i class="fas fa-suitcase-rolling"></i>
                                <div>{{ $request['luggage'] ?? 0 }} Bags</div>
                            </div>
                            <div class="v-icon-box" title="Child Seat">
                                <i class="fas fa-baby-carriage"></i>
                                <div>{{ $child_seat ?? 0 }} Childseats</div>
                            </div>
                        </div>
                    </div>

                    <div class="pay-box-container">
                        <div class="discount-badge"><i class="fas fa-tag"></i></div>
                        <div class="pay-col">
                            <span class="pay-lbl"><i class="fas fa-money-bill-wave"></i> Pay Cash</span>
                            <span class="pay-amt text-red">$<span
                                    id="disp_cash">{{ isset($defaultVehicle['pay_cash']) ? number_format($defaultVehicle['pay_cash'], 2) : '0.00' }}</span></span>
                            <div class="pay-note">Pay $1 Reservation Fee</div>
                        </div>
                        <div class="pay-col">
                            <span class="pay-lbl"><i class="fas fa-credit-card"></i> Pay Card</span>
                            <span class="pay-amt">$<span
                                    id="disp_card">{{ isset($defaultVehicle['total_fare']) ? number_format($defaultVehicle['total_fare'], 2) : '0.00' }}</span></span>
                            <div class="pay-note">Full Online Payment</div>
                        </div>
                    </div>
                    <div class="bottom-note">
                        <i class="fas fa-shield-alt me-1" style="color: #B9924B;"></i> <strong>Secure Booking:</strong> Pay
                        only $1.00 now to confirm your reservation. Balance is payable after service.
                    </div>
                </div>

                {{-- COLUMN 2: Pricing Details --}}
                <div class="col-lg-4">
                    <div class="pricing-card">
                        <div class="pricing-header">
                            <i class="fas fa-receipt"></i> Price Breakdown
                        </div>
                        <table class="pricing-table">
                            <tr>
                                <td>Distance Covered</td>
                                <td>:</td>
                                <td>{{ $distance_miles ?? 0 }} Miles</td>
                            </tr>
                            <tr>
                                <td>Estimated Fare</td>
                                <td>:</td>
                                <td>$<span
                                        id="tbl_base">{{ isset($defaultVehicle['estimated_fare']) ? number_format($defaultVehicle['estimated_fare'], 2) : '0.00' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Gratuity (20%)</td>
                                <td>:</td>
                                <td>$<span
                                        id="tbl_grat">{{ isset($defaultVehicle['gratuity_fee']) ? number_format($defaultVehicle['gratuity_fee'], 2) : '0.00' }}</span>
                                </td>
                            </tr>

                            @if(isset($defaultVehicle['pickup_tax']) && $defaultVehicle['pickup_tax'] > 0)
                                <tr>
                                    <td>Airport Pickup Toll</td>
                                    <td>:</td>
                                    <td>${{ number_format($defaultVehicle['pickup_tax'], 2) }}</td>
                                </tr>
                            @endif

                            @if(isset($defaultVehicle['dropoff_tax']) && $defaultVehicle['dropoff_tax'] > 0)
                                <tr>
                                    <td>Airport Dropoff Toll</td>
                                    <td>:</td>
                                    <td>${{ number_format($defaultVehicle['dropoff_tax'], 2) }}</td>
                                </tr>
                            @endif

                            @if(isset($defaultVehicle['stopover_fee']) && $defaultVehicle['stopover_fee'] > 0)
                                <tr>
                                    <td>Stopover Fee</td>
                                    <td>:</td>
                                    <td>${{ number_format($defaultVehicle['stopover_fee'], 2) }}</td>
                                </tr>
                            @endif

                            @if(isset($defaultVehicle['pet_fee']) && $defaultVehicle['pet_fee'] > 0)
                                <tr>
                                    <td>Pets Fee</td>
                                    <td>:</td>
                                    <td>${{ number_format($defaultVehicle['pet_fee'], 2) }}</td>
                                </tr>
                            @endif

                            @if(isset($defaultVehicle['child_seat_fee']) && $defaultVehicle['child_seat_fee'] > 0)
                                <tr>
                                    <td>Infant Seat Fee</td>
                                    <td>:</td>
                                    <td>${{ number_format($defaultVehicle['child_seat_fee'], 2) }}</td>
                                </tr>
                            @endif

                            @if(isset($defaultVehicle['booster_seat_fee']) && $defaultVehicle['booster_seat_fee'] > 0)
                                <tr>
                                    <td>Booster Seat Fee</td>
                                    <td>:</td>
                                    <td>${{ number_format($defaultVehicle['booster_seat_fee'], 2) }}</td>
                                </tr>
                            @endif

                            @if(isset($defaultVehicle['front_seat_fee']) && $defaultVehicle['front_seat_fee'] > 0)
                                <tr>
                                    <td>Front Seat Fee</td>
                                    <td>:</td>
                                    <td>${{ number_format($defaultVehicle['front_seat_fee'], 2) }}</td>
                                </tr>
                            @endif

                            @if(isset($defaultVehicle['toll_fee']) && $defaultVehicle['toll_fee'] > 0)
                                <tr>
                                    <td>Extra Toll Fee</td>
                                    <td>:</td>
                                    <td>${{ number_format($defaultVehicle['toll_fee'], 2) }}</td>
                                </tr>
                            @endif

                            @if(isset($defaultVehicle['extra_charges']) && $defaultVehicle['extra_charges'] > 0)
                                <tr>
                                    <td>Extra Zip Charges</td>
                                    <td>:</td>
                                    <td>${{ number_format($defaultVehicle['extra_charges'], 2) }}</td>
                                </tr>
                            @endif

                            <tr id="row_sur"
                                style="{{ (isset($defaultVehicle['surcharge_fee']) && $defaultVehicle['surcharge_fee'] > 0) ? '' : 'display:none;' }}">
                                <td>Surcharge / Night</td>
                                <td>:</td>
                                <td>$<span
                                        id="tbl_sur">{{ isset($defaultVehicle['surcharge_fee']) ? number_format($defaultVehicle['surcharge_fee'], 2) : '0.00' }}</span>
                                </td>
                            </tr>

                            <tr class="border-top">
                                <td class="pt-3 fw-bold text-dark">Total Payable</td>
                                <td class="pt-3">:</td>
                                <td class="pt-3 fw-bold text-dark fs-5" style="color: #B9924B !important;">$<span
                                        id="tbl_total">{{ isset($defaultVehicle['total_fare']) ? number_format($defaultVehicle['total_fare'], 2) : '0.00' }}</span>
                                </td>
                            </tr>
                        </table>

                        <div id="box_elug" class="extra-lug-box"
                            style="{{ (isset($defaultVehicle['extra_luggage_fee']) && $defaultVehicle['extra_luggage_fee'] > 0) ? '' : 'display:none;' }}">
                            <span class="fw-bold"><i class="fas fa-luggage-cart me-2"></i>Extra Luggage Fee</span>
                            <span class="fw-bold fs-5">$<span
                                    id="disp_elug">{{ isset($defaultVehicle['extra_luggage_fee']) ? number_format($defaultVehicle['extra_luggage_fee'], 2) : '0.00' }}</span></span>
                        </div>
                    </div>
                </div>

                {{-- COLUMN 3: Sidebar Summary --}}
                <div class="col-lg-4">
                    <button type="submit" class="btn-book-primary">
                        <i class="fas fa-check-circle me-2"></i> Book Now <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                    <div class="btn-pay-note text-muted text-center mb-3">Pay only $1 & confirm your reservation. Balance is
                        payable after service</div>

                    <div class="summary-box">
                        <div class="sum-header">
                            <i class="fas fa-clipboard-list me-2"></i> Booking Details
                        </div>
                        <table class="sum-table">
                            <tr>
                                <td>Service</td>
                                <td>:</td>
                                <td class="sum-val">
                                    {{ $trip_type == 'fromAirport' ? '✈️ From Airport' : ($trip_type == 'toAirport' ? '🛫 To Airport' : '🚗 Door-to-Door') }}
                                </td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>:</td>
                                <td class="sum-val">{{ $formattedDate ?? ($request['date'] ?? 'N/A') }}</td>
                            </tr>
                            <tr>
                                <td>Time</td>
                                <td>:</td>
                                <td class="sum-val">{{ $formattedTime ?? ($request['time'] ?? 'N/A') }}</td>
                            </tr>
                            <tr>
                                <td>Pick up</td>
                                <td>:</td>
                                <td class="sum-val">{{ Str::limit($pickup ?? 'N/A', 28) }}</td>
                            </tr>
                            <tr>
                                <td>Drop off</td>
                                <td>:</td>
                                <td class="sum-val">{{ Str::limit($dropoff ?? 'N/A', 28) }}</td>
                            </tr>
                            <tr>
                                <td>Passengers</td>
                                <td>:</td>
                                <td class="sum-val">{{ $reqPassengers ?? 0 }} ({{ $request['adults'] ?? 0 }} Adults +
                                    {{ $child_seat ?? 0 }} Children)</td>
                            </tr>
                            <tr>
                                <td>Luggage</td>
                                <td>:</td>
                                <td class="sum-val">{{ $request['luggage'] ?? 0 }} bags</td>
                            </tr>
                            @if(($request['infant_seat'] ?? 0) > 0)
                                <tr>
                                    <td>Infant Seat</td>
                                    <td>:</td>
                                    <td class="sum-val">{{ $request['infant_seat'] }}</td>
                            </tr>@endif
                            @if(($request['booster_seat'] ?? 0) > 0)
                                <tr>
                                    <td>Booster Seat</td>
                                    <td>:</td>
                                    <td class="sum-val">{{ $request['booster_seat'] }}</td>
                            </tr>@endif
                            <tr>
                                <td colspan="3">
                                    <hr style="border-color:#E5E7EB; margin:15px 0;">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"
                                    style="font-weight:700; color:#B9924B; text-transform:uppercase; font-size:0.8rem;"><i
                                        class="fas fa-car me-1"></i> Vehicle Info</td>
                            </tr>
                            <tr>
                                <td>Selected</td>
                                <td>:</td>
                                <td class="sum-val"><span id="sum_vname">{{ $defaultVehicle['name'] ?? 'N/A' }}</span></td>
                            </tr>
                            <tr>
                                <td>Capacity</td>
                                <td>:</td>
                                <td class="sum-val"><span
                                        id="sum_vpax">{{ $defaultVehicle['capacity_passenger'] ?? 0 }}</span> Pax, <span
                                        id="sum_vlug">{{ $defaultVehicle['capacity_luggage'] ?? 0 }}</span> Bags</td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <hr style="border-color:#E5E7EB; margin:15px 0;">
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold fs-6 text-dark">ESTIMATED TOTAL</td>
                                <td class="fw-bold fs-6">:</td>
                                <td class="fw-bold fs-5" style="color:#B9924B;">$<span
                                        id="sum_total">{{ isset($defaultVehicle['total_fare']) ? number_format($defaultVehicle['total_fare'], 2) : '0.00' }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </form>

        {{-- BOTTOM: MORE VEHICLE OPTIONS --}}
        <div class="more-opt-title">More Vehicle Options</div>

        <div id="vehicle_list_container">
            @if(isset($vehicleOptions) && count($vehicleOptions) > 0)
                @foreach($vehicleOptions as $option)
                    @php
                        $isCurrent = (isset($option['vehicle_id']) && isset($defaultVehicle['vehicle_id']) && $option['vehicle_id'] == $defaultVehicle['vehicle_id']);
                    @endphp
                    <div class="veh-row {{ $isCurrent ? 'd-none-custom' : '' }}" id="vrow_{{ $option['vehicle_id'] ?? '' }}"
                        onclick="updateVehicle({{ json_encode($option) }})">

                        <div class="vr-img-box">
                            <img src="{{ asset($option['image'] ?? 'images/home1.jpeg') }}" class="vr-img"
                                alt="{{ $option['name'] ?? 'Vehicle' }}">
                        </div>

                        <div class="vr-info flex-grow-1">
                            <h5>{{ $option['name'] ?? 'Vehicle' }} <i class="fas fa-crown"
                                    style="color: #B9924B; font-size: 0.9rem;"></i></h5>
                            <div class="vr-meta">
                                <span><i class="fas fa-user-group"></i> {{ $option['capacity_passenger'] ?? 0 }} Pax</span>
                                <span><i class="fas fa-suitcase"></i> {{ $option['capacity_luggage'] ?? 0 }} Bags</span>
                                <span><i class="fas fa-star" style="color: #B9924B;"></i> Premium Class</span>
                            </div>
                            <div class="text-muted" style="font-size:0.8rem">
                                Base Fare: ${{ number_format($option['estimated_fare'] ?? 0, 2) }} &bull; Gratuity:
                                ${{ number_format($option['gratuity_fee'] ?? 0, 2) }}
                            </div>
                        </div>

                        <div class="vr-action">
                            <span class="vr-price">${{ number_format($option['total_fare'] ?? 0, 2) }}</span>
                            <button type="button" class="btn-select">
                                Select <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert-warning-custom">
                    <i class="fas fa-exclamation-triangle fa-2x mb-2 d-block"></i>
                    <strong>No vehicles available</strong><br>
                    Please try adjusting your passenger count or contact support.
                </div>
            @endif
        </div>
    </div>

    <script>
        function formatMoney(amount) {
            return Number(amount).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }

        function updateVehicle(data) {
            // Animation for smooth transition
            const mainCard = document.querySelector('.vehicle-card-dark');
            if (mainCard) {
                mainCard.classList.add('animate__animated', 'animate__pulse');
                setTimeout(() => mainCard.classList.remove('animate__animated', 'animate__pulse'), 500);
            }

            // 1. Reset all rows to visible
            document.querySelectorAll('.veh-row').forEach(row => row.classList.remove('d-none-custom'));

            // 2. Hide selected row
            const selectedRow = document.getElementById('vrow_' + data.vehicle_id);
            if (selectedRow) selectedRow.classList.add('d-none-custom');

            // 3. Update Left Col (Card & Payment)
            const dispImg = document.getElementById('disp_img');
            if (dispImg) dispImg.src = "{{ asset('') }}" + (data.image || 'images/home1.jpeg');

            const dispName = document.getElementById('disp_name');
            if (dispName) dispName.innerText = data.name || 'Vehicle';

            const dispPax = document.getElementById('disp_pax');
            if (dispPax) dispPax.innerText = data.capacity_passenger || 0;

            const dispLug = document.getElementById('disp_lug');
            if (dispLug) dispLug.innerText = data.capacity_luggage || 0;

            const dispCash = document.getElementById('disp_cash');
            if (dispCash) dispCash.innerText = formatMoney(data.pay_cash || 0);

            const dispCard = document.getElementById('disp_card');
            if (dispCard) dispCard.innerText = formatMoney(data.total_fare || 0);

            // 4. Update Middle Col (Table)
            const tblBase = document.getElementById('tbl_base');
            if (tblBase) tblBase.innerText = formatMoney(data.estimated_fare || 0);

            const tblGrat = document.getElementById('tbl_grat');
            if (tblGrat) tblGrat.innerText = formatMoney(data.gratuity_fee || 0);

            // Toggle Surcharge Row
            const rowSur = document.getElementById('row_sur');
            const tblSur = document.getElementById('tbl_sur');
            if (rowSur && tblSur) {
                if (data.surcharge_fee > 0) {
                    rowSur.style.display = 'table-row';
                    tblSur.innerText = formatMoney(data.surcharge_fee);
                } else {
                    rowSur.style.display = 'none';
                }
            }

            // Toggle Extra Luggage Box
            const boxElug = document.getElementById('box_elug');
            const dispElug = document.getElementById('disp_elug');
            if (boxElug && dispElug) {
                if (data.extra_luggage_fee > 0) {
                    boxElug.style.display = 'flex';
                    dispElug.innerText = formatMoney(data.extra_luggage_fee);
                } else {
                    boxElug.style.display = 'none';
                }
            }

            const tblTotal = document.getElementById('tbl_total');
            if (tblTotal) tblTotal.innerText = formatMoney(data.total_fare || 0);

            // 5. Update Sidebar Summary
            const sumVname = document.getElementById('sum_vname');
            if (sumVname) sumVname.innerText = data.name || 'N/A';

            const sumVpax = document.getElementById('sum_vpax');
            if (sumVpax) sumVpax.innerText = data.capacity_passenger || 0;

            const sumVlug = document.getElementById('sum_vlug');
            if (sumVlug) sumVlug.innerText = data.capacity_luggage || 0;

            const sumTotal = document.getElementById('sum_total');
            if (sumTotal) sumTotal.innerText = formatMoney(data.total_fare || 0);

            // 6. Update Hidden Inputs
            const inpVid = document.getElementById('inp_vid');
            if (inpVid) inpVid.value = data.vehicle_id || '';

            const inpVname = document.getElementById('inp_vname');
            if (inpVname) inpVname.value = data.name || '';

            const inpBase = document.getElementById('inp_base');
            if (inpBase) inpBase.value = data.estimated_fare || 0;

            const inpGrat = document.getElementById('inp_grat');
            if (inpGrat) inpGrat.value = data.gratuity_fee || 0;

            const inpSur = document.getElementById('inp_sur');
            if (inpSur) inpSur.value = data.surcharge_fee || 0;

            const inpElug = document.getElementById('inp_elug');
            if (inpElug) inpElug.value = data.extra_luggage_fee || 0;

            const inpTotal = document.getElementById('inp_total');
            if (inpTotal) inpTotal.value = data.total_fare || 0;

            const inpCash = document.getElementById('inp_cash');
            if (inpCash) inpCash.value = data.pay_cash || 0;

            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>

@endsection
