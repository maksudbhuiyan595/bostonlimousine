@extends('layout.app')
@section('title', "Step3")
@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- PHP Logic for Dates & Formatting --}}
    @php
        use Carbon\Carbon;
        // Handle Date/Time from your JSON keys (date, time)
        $rawDate = request('date') ?? now()->toDateString();
        $rawTime = request('time') ?? '12:00';

        try {
            $bostonDateTime = Carbon::createFromFormat('Y-m-d H:i', $rawDate . ' ' . $rawTime, 'America/New_York');
        } catch (\Exception $e) {
            $bostonDateTime = Carbon::now('America/New_York');
        }

        $formattedDate = $bostonDateTime->format('l, F j, Y');
        $formattedTime = $bostonDateTime->format('g:i A');

        // Access Fare Array Helper
        $fare = request('fare', []);
    @endphp

    <style>
        /* --- PREMIUM AMBER COLOR SCHEME (#B9924B) --- */
        .passenger-wrapper {
            font-family: 'Inter', sans-serif;
            color: #1F2937;
            background: linear-gradient(135deg, #F9FAFB 0%, #F0F4F8 100%);
            max-width: 1280px;
            margin: 20px auto;
            padding: 40px 20px;
            position: relative;
            z-index: 1;
            border-radius: 12px;
            margin-top: 90px;
        }

        /* Page Titles */
        .passenger-wrapper .page-title {
            font-weight: 800;
            font-size: 1.8rem;
            color: #1F2937;
            margin-bottom: 5px;
            margin-top: 12px;
        }

        .passenger-wrapper .step-text {
            color: #6B7280;
            font-size: 0.95rem;
            margin-bottom: 30px;
        }

        /* --- LEFT FORM --- */
        .passenger-wrapper .traveler-bar {
            background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%);
            border: 1px solid #B9924B;
            padding: 12px 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
            font-weight: 700;
            color: #92400E;
        }

        .passenger-wrapper .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #4B5563;
            margin-bottom: 6px;
            display: block;
        }

        .passenger-wrapper .text-req {
            color: #B9924B;
            margin-left: 2px;
        }

        .passenger-wrapper .form-control,
        .passenger-wrapper .form-select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #D1D5DB;
            border-radius: 8px;
            font-size: 0.95rem;
            background: #fff;
            transition: all 0.2s ease;
        }

        .passenger-wrapper .form-control:focus,
        .passenger-wrapper .form-select:focus {
            border-color: #B9924B;
            outline: none;
            box-shadow: 0 0 0 3px rgba(185, 146, 75, 0.15);
        }

        /* --- RIGHT SIDEBAR (Amber Theme) --- */
        .passenger-wrapper .sidebar-amber {
            background: linear-gradient(135deg, #FFFBEB 0%, #FEF9E3 100%);
            border: 1px solid #B9924B;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(185, 146, 75, 0.1);
        }

        .passenger-wrapper .sidebar-head {
            font-size: 1.1rem;
            font-weight: 800;
            color: #B9924B;
            margin-bottom: 15px;
            border-bottom: 2px solid #B9924B;
            padding-bottom: 10px;
        }

        .passenger-wrapper .sidebar-head i {
            margin-right: 8px;
        }

        .passenger-wrapper .sum-table {
            width: 100%;
            font-size: 0.85rem;
            color: #4B5563;
        }

        .passenger-wrapper .sum-table td {
            padding: 8px 0;
            vertical-align: top;
        }

        /* ALIGNMENT FIX: Labels bold, Values Left Aligned */
        .passenger-wrapper .sum-lbl {
            font-weight: 700;
            width: 100px;
            color: #B9924B;
        }

        .passenger-wrapper .sum-val {
            text-align: left;
            color: #1F2937;
            font-weight: 600;
            padding-left: 10px;
        }

        /* Button */
        .passenger-wrapper .btn-continue {
            background: linear-gradient(135deg, #B9924B 0%, #8B6B2E 100%);
            color: white;
            font-weight: 700;
            padding: 14px 28px;
            border: none;
            border-radius: 40px;
            width: 100%;
            display: block;
            margin-top: 20px;
            cursor: pointer;
            text-align: center;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            box-shadow: 0 4px 12px rgba(185, 146, 75, 0.3);
        }

        .passenger-wrapper .btn-continue:hover {
            background: linear-gradient(135deg, #8B6B2E 0%, #6B4E1A 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(185, 146, 75, 0.4);
        }

        .passenger-wrapper .note-text {
            font-size: 0.75rem;
            color: #6B7280;
            text-align: center;
            margin-top: 10px;
        }

        /* --- PRICE BOXES --- */
        .passenger-wrapper .price-row {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .passenger-wrapper .p-box {
            flex: 1;
            background: #fff;
            border: 2px solid #E5E7EB;
            padding: 12px;
            text-align: center;
            border-radius: 12px;
            position: relative;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .passenger-wrapper .p-box:hover {
            border-color: #B9924B;
            transform: translateY(-2px);
        }

        .passenger-wrapper .p-badge {
            position: absolute;
            top: -10px;
            left: -8px;
            background: linear-gradient(135deg, #B9924B, #8B6B2E);
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            font-size: 0.7rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .passenger-wrapper .p-amt {
            font-size: 1.2rem;
            font-weight: 800;
            display: block;
        }

        .passenger-wrapper .p-lbl {
            font-size: 0.7rem;
            font-weight: 700;
            color: #374151;
            display: block;
            margin-top: 5px;
        }

        .passenger-wrapper .p-sub {
            font-size: 0.6rem;
            color: #9CA3AF;
            margin-top: 3px;
        }

        /* Grid */
        .passenger-wrapper .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .passenger-wrapper .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 0 15px;
            margin-bottom: 15px;
        }

        .passenger-wrapper .col-12 {
            flex: 0 0 100%;
            max-width: 100%;
            padding: 0 15px;
            margin-bottom: 15px;
        }

        .passenger-wrapper .col-lg-8 {
            flex: 0 0 66.66%;
            max-width: 66.66%;
            padding: 0 15px;
        }

        .passenger-wrapper .col-lg-4 {
            flex: 0 0 33.33%;
            max-width: 33.33%;
            padding: 0 15px;
        }

        /* Radio Button Styling */
        .passenger-wrapper input[type="radio"] {
            accent-color: #B9924B;
            width: 16px;
            height: 16px;
            margin-right: 5px;
        }

        /* Divider */
        .passenger-wrapper .amber-divider {
            border-top: 1px dashed #B9924B;
            margin: 15px 0;
        }

        @media(max-width: 768px) {
            .passenger-wrapper .col-lg-8,
            .passenger-wrapper .col-lg-4,
            .passenger-wrapper .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
            .passenger-wrapper .traveler-bar {
                flex-direction: column;
                align-items: flex-start;
            }
            .passenger-wrapper .price-row {
                flex-direction: column;
            }
        }
    </style>

    <div class="passenger-wrapper">

        <h1 class="page-title">Passenger Information</h1>
        <p class="step-text">Your Current Selection (Step 3 of 4)</p>

        <form action="{{ route('step4') }}" method="GET">

            {{--
                ========================================================
                RECURSIVE HIDDEN INPUTS (Fixed for Nested Arrays)
                This takes the JSON structure (like 'fare') and creates:
                <input type="hidden" name="fare[pickup_tax]" value="42.00">
                ========================================================
            --}}
            @php
                $renderHiddenInputs = function($data, $prefix = '') use (&$renderHiddenInputs) {
                    foreach ($data as $key => $value) {
                        // Create the name attribute: parent[child] or just name
                        $name = $prefix === '' ? $key : $prefix . '[' . $key . ']';

                        if (is_array($value)) {
                            // Recursively call for nested arrays (like 'fare')
                            $renderHiddenInputs($value, $name);
                        } else {
                            // Render simple input
                            echo '<input type="hidden" name="' . htmlspecialchars($name) . '" value="' . htmlspecialchars((string)$value) . '">' . PHP_EOL;
                        }
                    }
                };

                // Exclude current form fields to avoid duplication conflicts, but include all previous data
                $renderHiddenInputs(request()->except(['_token', 'passenger_name', 'passenger_email', 'phone_number']));
            @endphp

            <div class="row">

                {{-- LEFT: FORM --}}
                <div class="col-lg-8">

                    <div class="traveler-bar">
                        <i class="fas fa-user-check" style="color: #B9924B;"></i>
                        <span>Are you also the traveler?</span>
                        <div style="display: flex; gap: 15px;">
                            <label style="display:flex; align-items:center; gap:5px; cursor:pointer;">
                                <input type="radio" name="is_traveler" value="yes" checked>
                                Yes
                            </label>
                            <label style="display:flex; align-items:center; gap:5px; opacity:0.6;">
                                <input type="radio" name="is_traveler" value="no" disabled>
                                No
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Passenger Name <span class="text-req">*</span></label>
                            <input type="text" class="form-control" name="passenger_name" value="{{ request('passenger_name') }}" placeholder="Enter full name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Passenger Email <span class="text-req">*</span></label>
                            <input type="email" class="form-control" name="passenger_email" value="{{ request('passenger_email') }}" placeholder="Enter email address" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Airline Name</label>
                            <input type="text" class="form-control" name="airline_name" value="{{ request('airline_name') }}" placeholder="e.g., Delta, United, American">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Flight No.</label>
                            <input type="text" class="form-control" name="flight_number" value="{{ request('flight_number') }}" placeholder="e.g., AA1234">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Passenger Phone <span class="text-req">*</span></label>
                            <div style="display: flex;">
                                <select class="form-select" style="width: 100px; border-radius: 8px 0 0 8px; background:#F3F4F6;">
                                    <option>🇺🇸 +1</option>
                                    <option>🇨🇦 +1</option>
                                    <option>🇬🇧 +44</option>
                                </select>
                                <input type="tel" class="form-control" name="phone_number" value="{{ request('phone_number') }}" required style="border-radius: 0 8px 8px 0; border-left: 0;" placeholder="(555) 123-4567">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Alternate Phone Number</label>
                            <input type="tel" class="form-control" name="alternate_phone" value="{{ request('alternate_phone') }}" placeholder="Optional">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Mailing Address</label>
                            <textarea class="form-control" name="mailing_address" rows="2" placeholder="Street address, city, state, zip code">{{ request('mailing_address') }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Special Needs / Requests</label>
                            <textarea class="form-control" name="special_needs" rows="2" placeholder="Wheelchair access, extra assistance, etc.">{{ request('special_needs') }}</textarea>
                        </div>

                        <div class="col-12" style="text-align: right;">
                            <button type="submit" class="btn-continue" style="width:auto; float:right;">
                                Continue to Payment <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                            <div style="clear:both;"></div>
                            <div class="note-text" style="text-align:right;">
                                <i class="fas fa-lock me-1" style="color: #B9924B;"></i>
                                Pay only $1 & confirm your reservation. Balance is payable after service.
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT: SIDEBAR --}}
                <div class="col-lg-4">
                    <div class="sidebar-amber">
                        <div class="sidebar-head">
                            <i class="fas fa-clipboard-list"></i> Booking Details
                        </div>
                        <table class="sum-table">
                            <tr>
                                <td class="sum-lbl">Service</td>
                                <td>:</td>
                                <td class="sum-val">
                                    @if(request('tripType') == 'fromAirport')
                                        ✈️ From Airport
                                    @elseif(request('tripType') == 'toAirport')
                                        🛫 To Airport
                                    @else
                                        🚗 Door-to-Door
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="sum-lbl">Date</td>
                                <td>:</td>
                                <td class="sum-val">{{ $formattedDate }}</td>
                            </tr>
                            <tr>
                                <td class="sum-lbl">Time</td>
                                <td>:</td>
                                <td class="sum-val">{{ $formattedTime }}</td>
                            </tr>
                            <tr>
                                <td class="sum-lbl">Pick up</td>
                                <td>:</td>
                                <td class="sum-val">{{ Str::limit(request('pickup'), 25) }}</td>
                            </tr>
                            <tr>
                                <td class="sum-lbl">Drop off</td>
                                <td>:</td>
                                <td class="sum-val">{{ Str::limit(request('dropoff'), 25) }}</td>
                            </tr>
                            <tr>
                                <td class="sum-lbl">Passengers</td>
                                <td>:</td>
                                <td class="sum-val">
                                    {{ request('reqPassengers') }}
                                    <small class="text-muted">({{ request('adults') }} Adults, {{ request('children') ?? 0 }} Children)</small>
                                </td>
                            </tr>
                            <tr>
                                <td class="sum-lbl">Luggage</td>
                                <td>:</td>
                                <td class="sum-val">{{ request('luggage') }} bags</td>
                            </tr>

                            {{-- Divider --}}
                            <tr><td colspan="3"><div class="amber-divider"></div></td></tr>

                            {{-- Vehicle Info & Fees --}}
                            <tr>
                                <td colspan="3" style="color:#B9924B; font-weight:800; font-size:0.85rem; text-transform:uppercase; padding-bottom:5px;">
                                    <i class="fas fa-car me-1"></i> Vehicle & Price
                                </td>
                            </tr>
                            <tr>
                                <td class="sum-lbl">Vehicle</td>
                                <td>:</td>
                                <td class="sum-val">{{ $fare['name'] ?? 'Luxury Sedan' }}</td>
                            </tr>
                            <tr>
                                <td class="sum-lbl">Distance</td>
                                <td>:</td>
                                <td class="sum-val">{{ number_format(request('distance_miles', 0), 2) }} Miles</td>
                            </tr>
                            <tr>
                                <td class="sum-lbl">Base Fare</td>
                                <td>:</td>
                                <td class="sum-val">${{ number_format($fare['estimatedFare'] ?? 0, 2) }}</td>
                            </tr>
                            <tr>
                                <td class="sum-lbl">Gratuity (20%)</td>
                                <td>:</td>
                                <td class="sum-val">${{ number_format($fare['gratuity'] ?? 0, 2) }}</td>
                            </tr>

                            {{-- DYNAMIC FEES FROM JSON --}}
                            @if(($fare['pickup_tax'] ?? 0) > 0)
                                <tr><td class="sum-lbl">Pickup Tax</td><td>:</td><td class="sum-val">${{ number_format($fare['pickup_tax'], 2) }}</td></tr>
                            @endif
                            @if(($fare['parking_fee'] ?? 0) > 0)
                                <tr><td class="sum-lbl">Parking Fee</td><td>:</td><td class="sum-val">${{ number_format($fare['parking_fee'], 2) }}</td></tr>
                            @endif
                            @if(($fare['surcharge_fee'] ?? 0) > 0)
                                <tr><td class="sum-lbl">Surcharge</td><td>:</td><td class="sum-val">${{ number_format($fare['surcharge_fee'], 2) }}</td></tr>
                            @endif
                            @if(($fare['extra_luggage_fee'] ?? 0) > 0)
                                <tr><td class="sum-lbl">Extra Luggage</td><td>:</td><td class="sum-val">${{ number_format($fare['extra_luggage_fee'], 2) }}</td></tr>
                            @endif
                            @if(($fare['front_seat_fee'] ?? 0) > 0)
                                <tr><td class="sum-lbl">Front Seat</td><td>:</td><td class="sum-val">${{ number_format($fare['front_seat_fee'], 2) }}</td></tr>
                            @endif
                            @if(($fare['stopover_fee'] ?? 0) > 0)
                                <tr><td class="sum-lbl">Stopover</td><td>:</td><td class="sum-val">${{ number_format($fare['stopover_fee'], 2) }}</td></tr>
                            @endif
                            @if(($fare['pet_fee'] ?? 0) > 0)
                                <tr><td class="sum-lbl">Pet Fee</td><td>:</td><td class="sum-val">${{ number_format($fare['pet_fee'], 2) }}</td></tr>
                            @endif
                            @if(($fare['child_seat_fee'] ?? 0) > 0)
                                <tr><td class="sum-lbl">Child Seat</td><td>:</td><td class="sum-val">${{ number_format($fare['child_seat_fee'], 2) }}</td></tr>
                            @endif
                            @if(($fare['booster_seat_fee'] ?? 0) > 0)
                                <tr><td class="sum-lbl">Booster Seat</td><td>:</td><td class="sum-val">${{ number_format($fare['booster_seat_fee'], 2) }}</td></tr>
                            @endif

                            <tr><td colspan="3"><div class="amber-divider"></div></td></tr>

                            <tr>
                                <td class="sum-lbl" style="font-size:1.1rem; padding-top:10px;">Total</td>
                                <td style="padding-top:10px;">:</td>
                                <td class="sum-val" style="font-size:1.3rem; font-weight:800; color:#B9924B; padding-top:10px;">
                                    ${{ number_format($fare['total'] ?? 0, 2) }}
                                </td>
                            </tr>
                        </table>

                        {{-- Price Boxes --}}
                        <div class="price-row">
                            <div class="p-box">
                                <div class="p-badge"><i class="fas fa-tag"></i></div>
                                <span class="p-amt" style="color:#DC2626;">${{ number_format(request('pay_cash', 0), 2) }}</span>
                                <span class="p-lbl"><i class="fas fa-money-bill-wave me-1"></i> PAY CASH</span>
                                <span class="p-sub">Save 10% • $1 reservation fee</span>
                            </div>
                            <div class="p-box">
                                <span class="p-amt" style="color:#B9924B;">${{ number_format($fare['total'] ?? 0, 2) }}</span>
                                <span class="p-lbl"><i class="fas fa-credit-card me-1"></i> PAY CARD</span>
                                <span class="p-sub">Full online payment</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

@endsection
