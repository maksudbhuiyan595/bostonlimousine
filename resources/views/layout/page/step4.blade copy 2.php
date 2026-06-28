@extends('layout.app')
@section('title', "Step4")

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>

    {{-- PHP Logic --}}
    @php
        use Carbon\Carbon;
        $rawDate = request('date') ?? now()->toDateString();
        $rawTime = request('time') ?? '12:00';
        try {
            $bostonDateTime = Carbon::createFromFormat('Y-m-d H:i', $rawDate . ' ' . $rawTime, 'America/New_York');
        } catch (\Exception $e) {
            $bostonDateTime = Carbon::now('America/New_York');
        }
        $formattedDate = $bostonDateTime->format('l, F j, Y');
        $formattedTime = $bostonDateTime->format('g:i A');

        $fare = request('fare', []);
        $totalFare = $fare['total'] ?? 0;
        $cashFare  = request('pay_cash') ?? 0;
    @endphp

    <style>
        /* --- PREMIUM AMBER COLOR SCHEME (#B9924B) --- */
        .payment-wrapper {
            font-family: 'Inter', sans-serif;
            color: #1F2937;
            background: linear-gradient(135deg, #F9FAFB 0%, #F0F4F8 100%);
            max-width: 1280px;
            margin: 0 auto;
            padding: 40px 20px;
            margin-top: 20px;
            border-radius: 12px;
            margin-top: 90px;
        }

        .payment-wrapper .page-title {
            font-weight: 800;
            font-size: 1.8rem;
            color: #1F2937;
            margin-bottom: 5px;
            margin-top: -12px;
        }

        .payment-wrapper .step-text {
            color: #6B7280;
            font-size: 0.95rem;
            margin-bottom: 30px;
        }

        /* --- CARD DESIGN WITH AMBER THEME --- */
        .payment-toggles {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: nowrap;
            overflow-x: auto;
            padding-bottom: 10px;
        }

        .payment-toggles::-webkit-scrollbar { height: 4px; }
        .payment-toggles::-webkit-scrollbar-thumb { background: #B9924B; border-radius: 4px; }

        .toggle-card {
            flex: 1;
            min-width: 150px;
            background: #fff;
            border: 2px solid #E5E7EB;
            border-radius: 16px;
            text-align: center;
            padding: 15px 10px;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 160px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }

        .toggle-card:hover {
            border-color: #B9924B;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(185, 146, 75, 0.15);
        }

        .toggle-card.active {
            border: 2px solid #B9924B;
            background: linear-gradient(135deg, #FFFBEB 0%, #FEF9E3 100%);
        }

        .toggle-card.active::after {
            content: '\f00c';
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            top: 10px;
            right: 10px;
            background: #B9924B;
            color: #fff;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .t-center-text {
            font-size: 1rem;
            font-weight: 800;
            color: #B9924B;
            margin: auto 0;
        }

        .t-price {
            font-size: 1.4rem;
            font-weight: 800;
            color: #1F2937;
            margin-top: 10px;
        }

        .t-sub {
            font-size: 0.7rem;
            color: #6B7280;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .card-btn {
            width: 100%;
            padding: 10px 0;
            border-radius: 30px;
            font-weight: 700;
            font-size: 0.8rem;
            border: none;
            margin-top: auto;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-amber-card {
            background: linear-gradient(135deg, #B9924B 0%, #8B6B2E 100%);
            color: #fff;
        }

        .btn-amber-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(185, 146, 75, 0.3);
        }

        .btn-outline-amber {
            background: transparent;
            border: 2px solid #B9924B;
            color: #B9924B;
        }

        .btn-outline-amber:hover {
            background: #B9924B;
            color: white;
        }

        /* --- SIDEBAR (AMBER THEME) --- */
        .sidebar-amber {
            background: linear-gradient(135deg, #FFFBEB 0%, #FEF9E3 100%);
            padding: 20px;
            border-radius: 16px;
            border: 1px solid #B9924B;
            box-shadow: 0 4px 15px rgba(185, 146, 75, 0.1);
        }

        .sidebar-header {
            border-bottom: 2px solid #B9924B;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .sidebar-title {
            font-size: 1.1rem;
            font-weight: 800;
            color: #B9924B;
            margin: 0;
        }

        .summary-table {
            width: 100%;
            font-size: 0.85rem;
            color: #333;
        }

        .summary-table td {
            padding: 6px 0;
            vertical-align: top;
        }

        .summary-table tr td:last-child {
            text-align: left;
            font-weight: 600;
            padding-left: 8px;
            color: #1F2937;
        }

        .summary-table tr td:first-child {
            color: #B9924B;
            font-weight: 700;
            white-space: nowrap;
            width: 1%;
            padding-right: 10px;
        }

        .summary-table .amber-divider {
            border-top: 1px dashed #B9924B;
            margin: 12px 0;
        }

        /* --- FORMS --- */
        .payment-alert {
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%);
            color: #92400E;
            border: 1px solid #B9924B;
            text-align: center;
            font-weight: 500;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #4B5563;
            margin-bottom: 5px;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 1px solid #D1D5DB;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: #B9924B;
            outline: none;
            box-shadow: 0 0 0 3px rgba(185, 146, 75, 0.15);
        }

        .btn-pay-main {
            background: linear-gradient(135deg, #B9924B 0%, #8B6B2E 100%);
            color: #fff;
            width: 100%;
            padding: 16px;
            font-weight: 800;
            border: none;
            border-radius: 40px;
            font-size: 1rem;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(185, 146, 75, 0.3);
        }

        .btn-pay-main:hover {
            background: linear-gradient(135deg, #8B6B2E 0%, #6B4E1A 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(185, 146, 75, 0.4);
        }

        .StripeElement {
            height: 50px;
            padding: 12px 15px;
            border: 1px solid #D1D5DB;
            border-radius: 8px;
            background: white;
            transition: all 0.2s ease;
        }

        .StripeElement--focus {
            border-color: #B9924B;
            box-shadow: 0 0 0 3px rgba(185, 146, 75, 0.15);
        }

        #card-errors {
            color: #DC2626;
            margin-top: 10px;
            font-size: 0.875rem;
        }

        /* Checkbox Styling */
        .checkbox-custom {
            accent-color: #B9924B;
            width: 18px;
            height: 18px;
            margin-right: 8px;
            cursor: pointer;
        }

        /* Billing Card */
        .billing-card {
            background: #fff;
            padding: 25px;
            border-radius: 16px;
            border: 1px solid #E5E7EB;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }

        .billing-card h5 {
            font-weight: 800;
            color: #B9924B;
            margin-bottom: 20px;
        }

        @media(max-width: 768px) {
            .payment-toggles {
                display: flex;
                flex-wrap: nowrap;
                gap: 8px;
                overflow: hidden;
                padding-bottom: 0;
            }

            .toggle-card {
                flex: 1;
                min-width: 0;
                height: 140px;
                padding: 8px 4px;
            }

            .t-center-text { font-size: 0.75rem; }
            .t-price { font-size: 0.9rem; }
            .t-sub { font-size: 0.6rem; }
            .card-btn { font-size: 0.65rem; padding: 6px 0; }

            .payment-wrapper {
                padding: 20px 15px;
            }
        }
    </style>

    <div class="payment-wrapper">
        <h1 class="page-title">Payment Information</h1>
        <p class="step-text">Final Step (4 of 4)</p>

        <form action="{{ route('book.confirm') }}" method="POST" id="payment-form">
            @csrf

            @php
                $renderHiddenInputs = function($data, $prefix = '') use (&$renderHiddenInputs) {
                    foreach ($data as $key => $value) {
                        $name = $prefix === '' ? $key : $prefix . '[' . $key . ']';
                        if (is_array($value)) {
                            $renderHiddenInputs($value, $name);
                        } else {
                            echo '<input type="hidden" name="' . htmlspecialchars($name) . '" value="' . htmlspecialchars((string)$value) . '">' . PHP_EOL;
                        }
                    }
                };
                $renderHiddenInputs(request()->except(['_token', 'payment_method', 'stripe_token', 'amount_charged', 'card_holder_name', 'billing_phone', 'billing_address', 'billing_city', 'billing_state', 'billing_zip']));
            @endphp

            <input type="hidden" name="payment_method" id="selectedPaymentMethod" value="cash">
            <input type="hidden" name="stripe_token" id="stripe-token">
            <input type="hidden" name="amount_charged" id="amountCharged" value="1.00">

            <div class="row">

                {{-- LEFT COLUMN --}}
                <div class="col-lg-8">
                    <div class="payment-toggles">
                        <div class="toggle-card active" onclick="selectPayment('cash')" id="box-cash">
                            <div class="t-center-text"><i class="fas fa-dollar-sign"></i> $1 for reservation</div>
                            <div class="t-sub">Balance payable by cash</div>
                            <button type="button" class="card-btn btn-outline-amber">Pay Cash</button>
                        </div>
                        <div class="toggle-card" onclick="selectPayment('deposit')" id="box-deposit">
                            <div class="t-price">${{ number_format($cashFare, 2) }}</div>
                            <div class="t-sub">$1 for reservation</div>
                            <button type="button" class="card-btn btn-amber-card">Pay Cash</button>
                        </div>
                        <div class="toggle-card" onclick="selectPayment('card')" id="box-card">
                            <div class="t-price">${{ number_format($totalFare, 2) }}</div>
                            <div class="t-sub">Pay Full Online</div>
                            <button type="button" class="card-btn btn-amber-card">Pay Card</button>
                        </div>
                    </div>

                    <div id="paymentAlert" class="payment-alert">
                        <i class="fas fa-info-circle me-2"></i>
                        Pay <strong>$1.00</strong> Reservation Fee now via Stripe to confirm. Balance is payable by cash.
                    </div>

                    <div class="billing-card">
                        <h5><i class="fas fa-credit-card me-2"></i> Billing & Card Details</h5>
                        <div class="mb-4">
                            <label class="form-label">Credit or Debit Card</label>
                            <div id="card-element" class="StripeElement"></div>
                            <div id="card-errors" role="alert"></div>
                        </div>

                        <div class="row" style="margin:0 -10px;">
                            <div class="col-md-6" style="padding:0 10px;">
                                <label class="form-label">Card Holder Name</label>
                                <input type="text" class="form-control" id="cardholder-name" name="card_holder_name" value="{{ request('passenger_name') }}" required>
                            </div>
                            <div class="col-md-6" style="padding:0 10px;">
                                <label class="form-label">Billing Phone</label>
                                <input type="tel" class="form-control" name="billing_phone" value="{{ request('phone_number') }}" required>
                            </div>
                            <div class="col-12" style="padding:0 10px;">
                                <label class="form-label">Billing Address</label>
                                <input type="text" class="form-control" id="billing-address" name="billing_address" value="{{ request('mailing_address') }}" required>
                            </div>
                            <div class="col-md-4" style="padding:0 10px;">
                                <label class="form-label">City</label>
                                <input type="text" class="form-control" id="billing-city" name="billing_city" required>
                            </div>
                            <div class="col-md-4" style="padding:0 10px;">
                                <label class="form-label">State</label>
                                <input type="text" class="form-control" id="billing-state" name="billing_state" required>
                            </div>
                            <div class="col-md-4" style="padding:0 10px;">
                                <label class="form-label">Zip Code</label>
                                <input type="text" class="form-control" id="billing-zip" name="billing_zip" required>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div style="margin-bottom:15px; display: flex; align-items: center;">
                                <input type="checkbox" id="terms" class="checkbox-custom" checked>
                                <label for="terms" style="font-size:0.85rem; color:#555; cursor: pointer;">I agree to the <strong style="color:#B9924B;">Terms & Conditions</strong></label>
                            </div>
                            <button type="submit" class="btn-pay-main" id="card-button">
                                <i class="fas fa-lock me-2"></i> Confirm Booking & Pay $1.00
                            </button>
                        </div>
                    </div>
                </div>

                {{-- RIGHT COLUMN: SIDEBAR --}}
                <div class="col-lg-4">
                    <div class="sidebar-amber">
                        <div class="sidebar-header">
                            <h3 class="sidebar-title"><i class="fas fa-user me-2"></i>Personal Information</h3>
                        </div>
                        <table class="summary-table mb-3">
                            <tr><td>Name</td><td>:</td><td style="word-break: break-all;">{{ request('passenger_name') }}</td></tr>
                            <tr><td>Email</td><td>:</td><td style="word-break: break-all;">{{ request('passenger_email') }}</td></tr>
                            <tr><td>Phone</td><td>:</td><td>{{ request('phone_number') }}</td></tr>
                            @if(request('airline_name'))
                            <tr><td>Airline</td><td>:</td><td>{{ request('airline_name') }}</td></tr>
                            @endif
                            @if(request('flight_number'))
                            <tr><td>Flight #</td><td>:</td><td>{{ request('flight_number') }}</td></tr>
                            @endif
                        </table>

                        <div class="sidebar-header mt-3">
                            <h3 class="sidebar-title"><i class="fas fa-car me-2"></i>Booking Details</h3>
                        </div>
                        <table class="summary-table">
                            <tr><td>Service</td><td>:</td><td>{{ request('tripType') == 'fromAirport' ? '✈️ From Airport' : (request('tripType') == 'toAirport' ? '🛫 To Airport' : '🚗 Door-to-Door') }}</td></tr>
                            <tr><td>Date</td><td>:</td><td>{{ $formattedDate }}</td></tr>
                            <tr><td>Time</td><td>:</td><td>{{ $formattedTime }}</td></tr>
                            <tr><td>Pickup</td><td>:</td><td>{{ Str::limit(request('pickup'), 25) }}</td></tr>
                            <tr><td>Dropoff</td><td>:</td><td>{{ Str::limit(request('dropoff'), 25) }}</td></tr>
                            <tr><td>Passengers</td><td>:</td><td>{{ request('adults') }} Adults, {{ request('children') ?? 0 }} Children</td></tr>
                            <tr><td>Luggage</td><td>:</td><td>{{ request('luggage') }} bags</td></tr>

                            <tr><td colspan="3"><div class="amber-divider"></div></td></tr>

                            {{-- FEES --}}
                            <tr><td class="fw-bold">Vehicle</td><td>:</td><td>{{ $fare['name'] ?? 'Luxury Sedan' }}</td></tr>
                            <tr><td>Base Fare</td><td>:</td><td>${{ number_format($fare['estimatedFare'] ?? 0, 2) }}</td></tr>
                            @if(($fare['gratuity'] ?? 0) > 0) <tr><td>Gratuity (20%)</td><td>:</td><td>${{ number_format($fare['gratuity'], 2) }}</td></tr> @endif
                            @if(($fare['surcharge_fee'] ?? 0) > 0) <tr><td>Surcharge</td><td>:</td><td>${{ number_format($fare['surcharge_fee'], 2) }}</td></tr> @endif
                            @if(($fare['pickup_tax'] ?? 0) > 0) <tr><td>Pickup Tax</td><td>:</td><td>${{ number_format($fare['pickup_tax'], 2) }}</td></tr> @endif
                            @if(($fare['dropoff_tax'] ?? 0) > 0) <tr><td>Dropoff Tax</td><td>:</td><td>${{ number_format($fare['dropoff_tax'], 2) }}</td></tr> @endif
                            @if(($fare['parking_fee'] ?? 0) > 0) <tr><td>Parking Fee</td><td>:</td><td>${{ number_format($fare['parking_fee'], 2) }}</td></tr> @endif
                            @if(($fare['stopover_fee'] ?? 0) > 0) <tr><td>Stopover Fee</td><td>:</td><td>${{ number_format($fare['stopover_fee'], 2) }}</td></tr> @endif
                            @if(($fare['pet_fee'] ?? 0) > 0) <tr><td>Pet Fee</td><td>:</td><td>${{ number_format($fare['pet_fee'], 2) }}</td></tr> @endif
                            @if(($fare['child_seat_fee'] ?? 0) > 0) <tr><td>Child Seat</td><td>:</td><td>${{ number_format($fare['child_seat_fee'], 2) }}</td></tr> @endif
                            @if(($fare['booster_seat_fee'] ?? 0) > 0) <tr><td>Booster Seat</td><td>:</td><td>${{ number_format($fare['booster_seat_fee'], 2) }}</td></tr> @endif
                            @if(($fare['front_seat_fee'] ?? 0) > 0) <tr><td>Front Seat</td><td>:</td><td>${{ number_format($fare['front_seat_fee'], 2) }}</td></tr> @endif
                            @if(($fare['extra_luggage_fee'] ?? 0) > 0) <tr><td>Ex. Luggage</td><td>:</td><td>${{ number_format($fare['extra_luggage_fee'], 2) }}</td></tr> @endif
                            @if(($fare['toll_fee'] ?? 0) > 0) <tr><td>Toll Fee</td><td>:</td><td>${{ number_format($fare['toll_fee'], 2) }}</td></tr> @endif

                            <tr><td colspan="3"><div class="amber-divider"></div></td></tr>

                            <tr><td class="fw-bold fs-6">Total</td><td>:</td><td class="fw-bold fs-5" style="color:#B9924B;">${{ number_format($totalFare, 2) }}</td></tr>
                            @if(request('pay_cash'))
                            <tr><td>Cash Price</td><td>:</td><td class="fw-bold" style="color:#B9924B;">${{ number_format(request('pay_cash'), 2) }}</td></tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        const stripe = Stripe('{{ config('services.stripe.key') }}');
        const elements = stripe.elements();
        const card = elements.create('card', {
            style: {
                base: {
                    color: '#32325d',
                    fontFamily: '"Inter", sans-serif',
                    fontSize: '16px',
                    '::placeholder': { color: '#9CA3AF' }
                },
                invalid: { color: '#DC2626' }
            },
            hidePostalCode: true
        });
        card.mount('#card-element');

        card.addEventListener('change', function(event) {
            document.getElementById('card-errors').textContent = event.error ? event.error.message : '';
        });

        const cardButton = document.getElementById('card-button');
        const form = document.getElementById('payment-form');
        const fullTotal = parseFloat("{{ $totalFare }}").toFixed(2);

        cardButton.addEventListener('click', async (e) => {
            e.preventDefault();
            if (!form.checkValidity()) { form.reportValidity(); return; }
            cardButton.disabled = true;
            cardButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Processing...';

            const {token, error} = await stripe.createToken(card, {
                name: document.getElementById('cardholder-name').value,
                address_line1: document.getElementById('billing-address').value,
                address_city: document.getElementById('billing-city').value,
                address_state: document.getElementById('billing-state').value,
                address_zip: document.getElementById('billing-zip').value,
            });

            if (error) {
                document.getElementById('card-errors').textContent = error.message;
                cardButton.disabled = false;
                cardButton.innerHTML = '<i class="fas fa-lock me-2"></i> Confirm Booking & Pay $' + document.getElementById('amountCharged').value;
            } else {
                document.getElementById('stripe-token').value = token.id;
                form.submit();
            }
        });

        function selectPayment(method) {
            document.getElementById('selectedPaymentMethod').value = method;
            ['box-cash', 'box-deposit', 'box-card'].forEach(id => document.getElementById(id).classList.remove('active'));
            document.getElementById('box-' + method).classList.add('active');
            const alertBox = document.getElementById('paymentAlert');
            const amountInput = document.getElementById('amountCharged');

            if (method === 'card') {
                alertBox.innerHTML = `<i class="fas fa-credit-card me-2"></i> You are paying the <strong>Full Amount $${fullTotal}</strong> now via Card.`;
                amountInput.value = fullTotal;
            } else if (method === 'deposit') {
                alertBox.innerHTML = `<i class="fas fa-dollar-sign me-2"></i> Pay <strong>$1.00</strong> Reservation Fee Now. Discounted balance payable by cash later.`;
                amountInput.value = "1.00";
            } else {
                alertBox.innerHTML = `<i class="fas fa-cash-register me-2"></i> Pay <strong>$1.00</strong> Reservation Fee Now. Balance is payable by cash.`;
                amountInput.value = "1.00";
            }
            document.getElementById('card-button').innerHTML = `<i class="fas fa-lock me-2"></i> Confirm Booking & Pay $${amountInput.value}`;
        }

        selectPayment('cash');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('notify'))
    <script>Swal.fire({ toast: true, position: 'top-center', icon: "{{ session('notify.type') }}", title: "{{ session('notify.message') }}", showConfirmButton: false, timer: 3000, timerProgressBar: true });</script>
    @endif
@endsection
