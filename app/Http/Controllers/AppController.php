<?php

namespace App\Http\Controllers;

use App\Mail\AdminBookingConfirmationMail;
use App\Mail\BookingConfirmationMail;
use App\Mail\PaymentFailedMail;
use App\Models\Airport;
use App\Models\BlogPost;
use App\Models\Booking;
use App\Models\City;
use App\Models\ExtraCharge;
use App\Models\MainPage;
use App\Models\Surcharge;
use App\Models\Vehicle;
use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Stripe\PaymentMethod;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class AppController extends Controller
{
     public function airport(Request $request)
    {
       $airports = Airport::where('is_active', true)->get();
        return response()->json($airports);
    }
    public function areService(Request $request)
    {
        $area_services = ExtraCharge::where('is_active',true)->get();
        return response()->json($area_services);
    }
    public function capacityLuggage(Request $request)
    {
        $pax = $request->passenger;
        $vehicle = Vehicle::where('is_active', true)
                        ->where('capacity_passenger', '=', $pax)
                        ->orderBy('capacity_passenger', 'asc')
                        ->select('capacity_luggage')
                        ->first();
        $limit = $vehicle ? $vehicle->capacity_luggage : 12;
        return response()->json(['capacity_luggage' => $limit]);
    }
    public function home(Request $request)
    {
         $blogs = BlogPost::where("is_published", true)
                            ->orderBy("published_at", "desc")
                            ->take(3)
                            ->get();
        $cities = City::where('is_featured',true)->orderBy('name', 'asc')->paginate(20);
        $settings = app(GeneralSettings::class);
        $prefilledData = $request->all();
        return view("layout.page.home",compact("blogs", "cities", "settings", "prefilledData"));
    }
    public function step2(Request $request)
    {
        $settings = app(GeneralSettings::class);
        $now = Carbon::now();

        // ---------------------------------------------------
        // 1. BOOKING STATUS & SCHEDULE CHECK
        // ---------------------------------------------------
        if ($settings->booking_status === 'closed') {
            return redirect()->back()->with('notify', ['type' => 'error', 'message' => $settings->closing_message ?? 'Booking is currently closed']);
        }

        if ($settings->booking_status === 'scheduled') {
            if ($settings->schedule_type === 'daily') {
                $start = Carbon::createFromFormat('H:i', $settings->daily_start_time);
                $end   = Carbon::createFromFormat('H:i', $settings->daily_end_time);
                if (!$now->between($start, $end)) {
                    return redirect()->back()->with('notify', ['type' => 'error', 'message' => $settings->closing_message ?? 'Booking is closed for now']);
                }
            }
            if ($settings->schedule_type === 'weekly') {
                $today = $now->format('l');
                if (in_array($today, $settings->weekly_off_days ?? [])) {
                    return redirect()->back()->with('notify', ['type' => 'error', 'message' => $settings->closing_message ?? 'Booking is closed today']);
                }
            }
            if ($settings->schedule_type === 'specific_date') {
                $startDate = Carbon::parse($settings->closed_start_date);
                $endDate   = Carbon::parse($settings->closed_end_date);
                if ($now->between($startDate, $endDate)) {
                    return redirect()->back()->with('notify', ['type' => 'error', 'message' => $settings->closing_message ?? 'Booking is temporarily unavailable']);
                }
            }
        }

        // ---------------------------------------------------
        // 2. VALIDATION
        // ---------------------------------------------------

        $request->validate([
            'tripType'     => 'required|in:fromAirport,toAirport,doorToDoor',
            'from_airport' => 'nullable|exists:airports,id',
            'to_airport'   => 'nullable|exists:airports,id',
            'from_address' => 'nullable|string',
            'to_address'   => 'nullable|string',
            'date'         => 'required|date',
            'time'         => 'required',
            'adults'       => 'required|integer|min:1|max:12',
            'luggage'      => 'nullable|integer|min:0',
            'children'     => 'nullable|integer|min:0',
            'booster_seat' => 'nullable|integer|min:0',
            'stopover'     => 'nullable|integer|min:0',
            'pets'         => 'nullable|integer|min:0',
            'front_seat'   => 'nullable|integer|min:0',
            'infant_seat'  => 'nullable|integer|min:0',
        ]);

        try {
            // ---------------------------------------------------
            // 3. DEFINE ORIGIN & DESTINATION
            // ---------------------------------------------------
            $airport = null;
            if ($request->tripType === 'fromAirport') {
                $airport = Airport::findOrFail($request->from_airport);
                $origin = $airport->address;
                $destination = $request->to_address;
            } elseif ($request->tripType === 'toAirport') {
                $airport = Airport::findOrFail($request->to_airport);
                $origin = $request->from_address;
                $destination = $airport->address;
            } else { // doorToDoor
                $origin = $request->from_address;
                $destination = $request->to_address;
            }

            if (!$origin || !$destination) {
                return redirect()->back()->with('notify', ['type' => 'error', 'message' => 'Invalid origin or destination']);
            }

            // ---------------------------------------------------
            // 4. GOOGLE MAPS DISTANCE CALCULATION
            // ---------------------------------------------------
            $apiKey = config('services.google_maps.key');

            // Default distance if API fails (Optional: Remove in production)
            $distanceMiles = 0;

            $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json', [
                'origins'      => $origin,
                'destinations' => $destination,
                'units'        => 'imperial',
                'key'          => $apiKey,
            ]);
            $data = $response->json();

            if (($data['status'] ?? null) === 'OK' && ($data['rows'][0]['elements'][0]['status'] ?? null) === 'OK') {
                $distanceMiles = round($data['rows'][0]['elements'][0]['distance']['value'] * 0.000621371, 2);
            } else {
                // Log error or handle gracefully
                // \Log::error('Google Maps Error', $data);
                return redirect()->back()->with('notify', ['type' => 'error', 'message' => 'Could not calculate distance. Please check address.']);
            }

            // ---------------------------------------------------
            // 5. COMMON FEES CALCULATION
            // ---------------------------------------------------

            $pickupTax  = $request->tripType === 'fromAirport' ? ($airport->pickup_tax_fee ?? 0) : 0;
            $dropoffTax = $request->tripType === 'toAirport' ? ($airport->dropoff_tax_fee ?? 0) : 0;
            $parkingFee = ($request->tripType === 'fromAirport' || $request->tripType === 'toAirport') ? ($airport->parking_fee ?? 0) : 0;

            $childSeatFee   = ($settings->child_seat_fee ?? 0) * ($request->infant_seat ?? 0);
            $boosterSeatFee = ($settings->booster_seat_fee ?? 0) * ($request->booster_seat ?? 0);
            $stopoverFee    = ($settings->stopover_fee ?? 0) * ($request->stopover ?? 0);
            $petFee    = ($settings->pet_fee ?? $settings->stopover_fee) * ($request->pets ?? 0);
            $frontSeatFee   = ($settings->regular_Seat_rules ?? 0) * ($request->front_seat ?? 0);

            // ZIP Code Logic
            $extractZip = function($address) { preg_match('/\b\d{5}\b/', $address, $matches); return $matches[0] ?? null; };
            $originZip = $extractZip($origin);
            $destinationZip = $extractZip($destination);

            $extractZip = function($address) {
                preg_match('/\b\d{5}(-\d{4})?\b/', $address, $matches);
                return $matches[0] ?? null;
            };

            $originAddress = $data['origin_addresses'][0] ?? $origin;
            $destinationAddress = $data['destination_addresses'][0] ?? $destination;

            $originZip = $extractZip($originAddress);
            $destinationZip = $extractZip($destinationAddress);


           $extraChargeTotal = 0;
           $tollFeeTotal = 0;
           $appliedExtraCharges = []; // ADD THIS
            // Multiplier Logic
            $multiplier = $request->adults > 6 ? 2 : 1;

            if ($originZip || $destinationZip) {
                $extraCharges = ExtraCharge::where('is_active', true)->get();

                foreach ($extraCharges as $charge) {
                    $zipCodes = is_array($charge->zip_codes) ? $charge->zip_codes : json_decode($charge->zip_codes, true);

                    if ($zipCodes && (in_array($originZip, $zipCodes) || in_array($destinationZip, $zipCodes))) {
                        $extraChargeTotal += ($charge->price ?? 0) * $multiplier;
                        $tollFeeTotal += ($charge->toll_fee ?? 0) * $multiplier;

                        $appliedExtraCharges[] = [
                            'name' => $charge->name,
                            'amount' => ($charge->price ?? 0) * $multiplier
                        ];
                    }
                }
            }
            // ---------------------------------------------------
            // 6. CALCULATE FOR ALL ACTIVE VEHICLES
            // ---------------------------------------------------
            $vehicles = Vehicle::where('is_active', 1)->orderBy('capacity_passenger', 'asc')->get();
            $vehicleOptions = [];

            $reqLuggage = (int) ($request->luggage ?? 0);
            $reqPassengers = (int) ($request->adults ?? 0)
                            + ((int) ($request->children ?? 0) );
            $gratuityPercent = (float) ($settings->gratuity_percent ?? 0);

            // Surcharge Preparation
            $bookingTimeStr = Carbon::parse($request->time)->format('H:i:s');
            $bookingDateStr = Carbon::parse($request->date)->format('Y-m-d');
            $activeSurcharges = Surcharge::where('is_active', 1)->get();

            foreach ($vehicles as $vehicle) {
                // A. Base + Distance Fare
                $baseFare = (float) $vehicle->base_fare;
                $minFare  = (float) $vehicle->min_fare;
                $distanceFare = 0;

                foreach ($vehicle->slabs ?? [] as $slab) {
                    if ($distanceMiles >= $slab['start_mile'] && $distanceMiles <= $slab['end_mile']) {
                        $distanceFare = $distanceMiles * (float) $slab['price'];
                        break;
                    }
                }
                $estimatedFare = $baseFare + $distanceFare;
                if ($estimatedFare < $minFare) $estimatedFare = $minFare;

                // B. Surcharges (Must be calculated inside loop as % depends on Fare)
                $surchargeTotal = 0;
                $appliedSurcharges = [];

                foreach ($activeSurcharges as $surcharge) {
                    $isApplicable = false;
                    // Time Check
                    if ($surcharge->type === 'time') {
                        if ($surcharge->start_time > $surcharge->end_time) { // Overnight logic
                            if ($bookingTimeStr >= $surcharge->start_time || $bookingTimeStr <= $surcharge->end_time) $isApplicable = true;
                        } else { // Standard Day
                            if ($bookingTimeStr >= $surcharge->start_time && $bookingTimeStr <= $surcharge->end_time) $isApplicable = true;
                        }
                    }
                    // Date Check
                    elseif ($surcharge->type === 'date') {
                        if ($bookingDateStr >= $surcharge->start_date && $bookingDateStr <= $surcharge->end_date) $isApplicable = true;
                    }

                    if ($isApplicable) {
                        $amountToAdd = ($surcharge->is_percentage == 1)
                            ? ($estimatedFare * $surcharge->price) / 100
                            : $surcharge->price;

                        $surchargeTotal += $amountToAdd;
                        $appliedSurcharges[] = ['name' => $surcharge->name, 'amount' => round($amountToAdd, 2)];
                    }
                }

                // C. Gratuity
                $gratuityFee = round(($estimatedFare * $gratuityPercent) / 100, 2);

                // D. Extra Luggage Logic
                $freeLuggageCapacity = (int) $vehicle->capacity_luggage;

                $extraLuggageCount =max(0, $request->luggage - $reqPassengers);
                $child_seat = ($request->children ?? 0);
                $extraLuggageFee = $extraLuggageCount * ($settings->luggage_fee ?? 0);

                // E. Final Total
                $totalFare = $estimatedFare + $gratuityFee + $pickupTax + $dropoffTax + $parkingFee +
                            $childSeatFee + $boosterSeatFee + $stopoverFee + $frontSeatFee + $petFee +
                            $extraChargeTotal + $tollFeeTotal + $surchargeTotal + $extraLuggageFee;

                // Store Data
                $vehicleOptions[] = [
                    'vehicle_id'        => $vehicle->id,
                    'name'              => $vehicle->name,
                    'image'             => $vehicle->image,
                    'capacity_passenger'=> $vehicle->capacity_passenger,
                    'capacity_luggage'  => $vehicle->capacity_luggage,
                    'features'          => $vehicle->features ?? ['Luxury'],

                    // Pricing
                    'estimated_fare'    => round($estimatedFare, 2),
                    'gratuity_fee'      => $gratuityFee,
                    'pickup_tax'        => $pickupTax,
                    'dropoff_tax'       => $dropoffTax,
                    'parking_fee'       => $parkingFee,
                    'stopover_fee'      => $stopoverFee,
                    'pet_fee'           => $petFee,
                    'child_seat_fee'    => $childSeatFee,
                    'booster_seat_fee'  => $boosterSeatFee,
                    'front_seat_fee'    => $frontSeatFee,
                    'extra_charges'     => $extraChargeTotal,
                    'toll_fee'          => $tollFeeTotal,
                    'surcharge_fee'     => round($surchargeTotal, 2),
                    'surcharge_details' => $appliedSurcharges,

                    // Luggage
                    'extra_luggage_fee' => $extraLuggageFee,
                    'extra_luggage_count'=> $extraLuggageCount,

                    // Final
                    'total_fare'        => round($totalFare, 2),
                    'pay_cash'          => round($totalFare * 0.9, 2),
                ];
            }

            // ---------------------------------------------------
            // 7. DEFAULT SELECTION & RETURN
            // ---------------------------------------------------
            // Find first vehicle that fits passengers
            $defaultVehicle = collect($vehicleOptions)->first(function($v) use ($reqPassengers) {
                return $v['capacity_passenger'] >= $reqPassengers;
            });

            if (!$defaultVehicle) {
                $defaultVehicle = $vehicleOptions[0] ?? null;
            }

            return view('layout.page.step2', [
                'trip_type' => $request->tripType,
                'distance_miles' => $distanceMiles,
                'child_seat' => $request->children?? 0,
                'reqPassengers' => $reqPassengers,
                'pickup' => $origin,
                'dropoff' => $destination,
                'request' => $request->all(),
                'vehicleOptions' => $vehicleOptions,
                'defaultVehicle' => $defaultVehicle,
                'extra_charge_details' => $appliedExtraCharges,

                // ERROR FIX: Add this variable
                'vehicles_used' => 1,
            ]);

        } catch (\Exception $e) {
            // Log error for debugging
            // \Log::error($e);
            return redirect()->back()->with('notify', ['type' => 'error', 'message' => 'System Error: ' . $e->getMessage()]);
        }

    }
    public function step3(Request $request)
    {
        // return $request;
        return view("layout.page.step3",compact("request"));
    }
    public function step4(Request $request)
    {
        return view("layout.page.step4",compact("request"));
    }
    public function blogs(Request $request)
    {
         $blogs = BlogPost::where("is_published", true)
                         ->orderBy("published_at", "desc")
                         ->paginate(12);
        return view("layout.page.blog",compact('blogs'));
    }
     public function contact(Request $request)
    {
        return view("layout.page.contact");
    }
    public function about(Request $request)
    {
        return view("layout.page.about");
    }
     public function paymentPolicy(Request $request)
    {
        return view("layout.page.paymentPolicy");
    }
     public function termConditions(Request $request)
    {
        return view("layout.page.termConditions");
    }
    public function minivan(Request $request)
    {
        $main_page = MainPage::where('slug', 'minivan')
                            ->where('is_active', true)
                            ->first();
        return view("layout.page.minivan", compact('main_page'));
    }
    public function longdistance(Request $request)
    {
        $main_page = MainPage::where('slug', 'long-distance')
                            ->where('is_active', true)
                            ->first();
        return view("layout.page.longdistance",compact('main_page'));
    }
    public function pickupLocation(Request $request)
    {
        return view("layout.page.pickuplocation");
    }
   public function reservation(Request $request)
    {
        $main_page = MainPage::where('slug', 'reservation')
                            ->where('is_active', true)
                            ->first();
        return view("layout.page.reservation", compact('main_page'));
    }
    public function services(Request $request)
    {
         $cities = City::where('is_featured',true)->orderBy('name', 'asc')->paginate(30);
          $main_page = MainPage::where('slug', 'service')
                            ->where('is_active', true)
                            ->first();
        return view("layout.page.services",compact('cities','main_page'));
    }
    public function childSeat(Request $request)
    {
        $main_page = MainPage::where('slug', 'child-seat')
                            ->where('is_active', true)
                            ->first();
        return view("layout.page.childseat",compact('main_page'));
    }
   public function confirmBooking(Request $request)
{
    $request->validate([
        'stripe_token' => ['required', 'string'],
        'amount_charged' => ['required', 'numeric', 'min:1'],
        'passenger_name' => ['required', 'string', 'max:255'],
        'passenger_email' => ['required', 'email', 'max:255'],
        'phone_number' => ['nullable', 'string', 'max:50'],
        'payment_method' => ['nullable', 'string', 'in:cash,deposit,card'],
    ]);

    $paymentMethod = $request->input('payment_method', 'card');

    /*
    |--------------------------------------------------------------------------
    | Calculate Fare
    |--------------------------------------------------------------------------
    */

    $fare = $this->calculateFare($request);

    $totalFare = round((float) ($fare['total'] ?? 0), 2);

    if ($totalFare <= 0) {
        return back()
            ->withInput()
            ->with('error', 'Calculated fare amount is invalid.');
    }

    /*
    |--------------------------------------------------------------------------
    | Amount To Charge
    |--------------------------------------------------------------------------
    */

    $amountToCharge = in_array(
        $paymentMethod,
        ['cash', 'deposit'],
        true
    )
        ? 1.00
        : $totalFare;

    $amountCharged = round(
        (float) $request->amount_charged,
        2
    );

    if (abs($amountCharged - $amountToCharge) > 0.05) {
        return back()
            ->withInput()
            ->with(
                'error',
                'Payment amount mismatch. Expected: $' .
                number_format($amountToCharge, 2)
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Create Booking
    |--------------------------------------------------------------------------
    */

    DB::beginTransaction();

    try {

        $lastBooking = Booking::lockForUpdate()
            ->orderByDesc('id')
            ->first();

        $lastNumber = 0;

        if (
            $lastBooking &&
            preg_match(
                '/(?:BLAT|LAT)-(\d+)/',
                (string) $lastBooking->booking_no,
                $matches
            )
        ) {
            $lastNumber = (int) $matches[1];
        }

        $bookingNo = 'LAT-' .
            str_pad(
                $lastNumber + 1,
                4,
                '0',
                STR_PAD_LEFT
            );

        $booking = new Booking();

        $booking->booking_no = $bookingNo;

        // Passenger
        $booking->passenger_name = $request->passenger_name;
        $booking->passenger_email = $request->passenger_email;
        $booking->passenger_phone =
            $request->passenger_phone ??
            $request->phone_number;

        $booking->phone_country_code =
            $request->phone_country_code;

        $booking->alternate_phone =
            $request->alternate_phone;

        $booking->mailing_address =
            $request->mailing_address;

        $booking->special_needs =
            $request->special_needs;

        // Trip
        $booking->trip_type =
            $request->trip_type ??
            $request->tripType;

        $booking->pickup_date =
            $request->pickup_date ??
            $request->date;

        $booking->pickup_time =
            $request->pickup_time ??
            $request->time;

        $booking->pickup_address =
            $request->pickup ??
            $request->pickup_address ??
            $request->fromAddress;

        $booking->dropoff_address =
            $request->dropoff ??
            $request->dropoff_address ??
            $request->to_address;

        $booking->distance_miles =
            (float) ($request->distance_miles ?? 0);

        // Flight
        $booking->airline_name =
            $request->airline_name;

        $booking->flight_number =
            $request->flight_number;

        // Vehicle
        $booking->vehicle_id =
            $request->vehicle_id;

        $booking->vehicle_type =
            $request->vehicle_type ??
            ($fare['name'] ?? null);

        $booking->vehicles_used =
            (int) ($request->vehicles_used ?? 1);

        // Passengers
        $booking->adults =
            (int) ($request->adults ?? 0);

        $booking->children =
            (int) ($request->children ?? 0);

        $booking->total_passengers =
            (int) (
                $request->total_passengers ??
                $request->reqPassengers ??
                (
                    $booking->adults +
                    $booking->children
                )
            );

        $booking->luggage =
            (int) ($request->luggage ?? 0);

        // Extras
        $booking->booster_seat_count =
            (int) (
                $request->booster_seat_count ??
                $request->booster_seat ??
                0
            );

        $booking->infant_seat_count =
            (int) (
                $request->infant_seat_count ??
                $request->infant_seat ??
                0
            );

        $booking->front_seat_count =
            (int) (
                $request->front_seat_count ??
                $request->front_seat ??
                0
            );

        $booking->stopover_count =
            (int) (
                $request->stopover_count ??
                $request->stopover ??
                0
            );

        $booking->pet_count =
            (int) (
                $request->pet_count ??
                $request->pets ??
                0
            );

        // Billing
        $booking->card_holder_name =
            $request->card_holder_name ??
            $request->passenger_name;

        $booking->billing_phone =
            $request->billing_phone ??
            $booking->passenger_phone;

        $booking->billing_address =
            $request->billing_address ??
            $booking->mailing_address;

        $booking->billing_city =
            $request->billing_city;

        $booking->billing_state =
            $request->billing_state;

        $booking->billing_zip =
            $request->billing_zip;

        // Fare
        $booking->estimated_fare =
            (float) ($fare['estimated_fare'] ?? 0);

        $booking->gratuity =
            (float) ($fare['gratuity'] ?? 0);

        $booking->pickup_tax =
            (float) ($fare['pickup_tax'] ?? 0);

        $booking->dropoff_tax =
            (float) ($fare['dropoff_tax'] ?? 0);

        $booking->parking_fee =
            (float) ($fare['parking_fee'] ?? 0);

        $booking->toll_fee =
            (float) ($fare['toll_fee'] ?? 0);

        $booking->surcharge_fee =
            (float) ($fare['surcharge_fee'] ?? 0);

        $booking->extra_luggage_fee =
            (float) ($fare['extra_luggage_fee'] ?? 0);

        $booking->child_seat_fee =
            (float) ($fare['child_seat_fee'] ?? 0);

        $booking->booster_seat_fee =
            (float) ($fare['booster_seat_fee'] ?? 0);

        $booking->front_seat_fee =
            (float) ($fare['front_seat_fee'] ?? 0);

        $booking->stopover_fee =
            (float) ($fare['stopover_fee'] ?? 0);

        $booking->extras_total =
            (float) ($fare['extras_total'] ?? 0);

        $booking->total_fare = $totalFare;

        // Payment initial state
        $booking->paid_amount = 0;
        $booking->due_amount = $totalFare;
        $booking->payment_method = $paymentMethod;
        $booking->payment_status = 'pending';
        $booking->status = 'pending';

        $booking->save();

        DB::commit();

    } catch (\Throwable $e) {

        DB::rollBack();

        Log::error('Booking creation failed', [
            'message' => $e->getMessage(),
            'email' => $request->passenger_email,
        ]);

        return back()
            ->withInput()
            ->with(
                'error',
                'Unable to create booking.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Stripe Payment
    |--------------------------------------------------------------------------
    */

    try {

        Stripe::setApiKey(
            config('services.stripe.secret')
        );

        if (
            empty(
                config('services.stripe.secret')
            )
        ) {
            throw new \Exception(
                'Stripe secret key is not configured.'
            );
        }

        $idempotencyKey =
            'booking-' .
            $booking->id .
            '-' .
            md5(
                $booking->booking_no .
                '|' .
                $amountToCharge .
                '|' .
                $paymentMethod
            );


        /*
        |--------------------------------------------------------------------------
        | Create + Confirm PaymentIntent
        |--------------------------------------------------------------------------
        */

        $paymentIntent = PaymentIntent::create(
            [
                'amount' =>
                    (int) round(
                        $amountToCharge * 100
                    ),

                'currency' => 'usd',

                'payment_method_data' => [
                    'type' => 'card',
                    'card' => [
                        'token' =>
                            $request->stripe_token,
                    ],
                ],

                /*
                | Automatic capture
                */
                'capture_method' => 'automatic',

                /*
                | Confirm immediately
                */
                'confirm' => true,

                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'never',
                ],

                'description' =>
                    'Booking: ' .
                    $booking->booking_no,

                'receipt_email' =>
                    $booking->passenger_email,

                'metadata' => [
                    'booking_id' =>
                        (string) $booking->id,

                    'booking_no' =>
                        (string) $booking->booking_no,

                    'payment_method' =>
                        (string) $paymentMethod,

                    'total_fare' =>
                        (string) $totalFare,

                    'amount_to_charge' =>
                        (string) $amountToCharge,
                ],
            ],
            [
                'idempotency_key' =>
                    $idempotencyKey,
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Stripe Payment Status
        |--------------------------------------------------------------------------
        */

        Log::info(
            'Stripe PaymentIntent created',
            [
                'booking_id' => $booking->id,
                'booking_no' => $booking->booking_no,
                'payment_intent_id' =>
                    $paymentIntent->id,
                'status' =>
                    $paymentIntent->status,
                'amount' =>
                    $amountToCharge,
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | 3D Secure / Requires Action
        |--------------------------------------------------------------------------
        */

        if (
            $paymentIntent->status ===
            'requires_action'
        ) {

            $booking->transaction_id =
                $paymentIntent->id;

            $booking->save();

            return redirect()
                ->route('home')
                ->with([
                    'status' => 'requires_action',

                    'payment_intent_id' =>
                        $paymentIntent->id,

                    'client_secret' =>
                        $paymentIntent->client_secret,

                    'booking_no' =>
                        $booking->booking_no,
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Payment Must Be Succeeded
        |--------------------------------------------------------------------------
        */

        if (
            $paymentIntent->status !==
            'succeeded'
        ) {

            throw new \Exception(
                'Stripe payment was not successful. Status: ' .
                $paymentIntent->status
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Verify Amount
        |--------------------------------------------------------------------------
        */

        $amountPaid =
            (
                (float)
                ($paymentIntent->amount_received ?? 0)
            ) / 100;

        if (
            abs(
                $amountPaid -
                $amountToCharge
            ) > 0.01
        ) {

            throw new \Exception(
                'Stripe payment amount mismatch.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Update Booking
        |--------------------------------------------------------------------------
        */

        $dueAmount = max(
            0,
            round(
                $totalFare -
                $amountPaid,
                2
            )
        );

        $paymentStatus =
            $dueAmount <= 0.01
                ? 'paid'
                : 'partial';


        $booking->transaction_id =
            $paymentIntent->id;

        $booking->paid_amount =
            $amountPaid;

        $booking->due_amount =
            $dueAmount;

        $booking->payment_status =
            $paymentStatus;

        $booking->status =
            'confirmed';


        /*
        |--------------------------------------------------------------------------
        | Card Details
        |--------------------------------------------------------------------------
        */

        try {

            if (
                !empty(
                    $paymentIntent->payment_method
                )
            ) {

                $paymentMethodObject =
                    PaymentMethod::retrieve(
                        $paymentIntent->payment_method
                    );

                if (
                    $paymentMethodObject->card
                ) {

                    $booking->card_brand =
                        $paymentMethodObject
                            ->card
                            ->brand ??
                        null;

                    $booking->card_last_four =
                        $paymentMethodObject
                            ->card
                            ->last4 ??
                        null;
                }
            }

        } catch (\Throwable $e) {

            Log::warning(
                'Unable to retrieve card details',
                [
                    'payment_intent_id' =>
                        $paymentIntent->id,

                    'message' =>
                        $e->getMessage(),
                ]
            );
        }


        $booking->save();


        /*
        |--------------------------------------------------------------------------
        | Success Log
        |--------------------------------------------------------------------------
        */

        Log::info(
            'Booking confirmed successfully',
            [
                'booking_id' => $booking->id,

                'booking_no' =>
                    $booking->booking_no,

                'payment_intent_id' =>
                    $paymentIntent->id,

                'payment_method' =>
                    $paymentMethod,

                'total_fare' =>
                    $totalFare,

                'paid_amount' =>
                    $amountPaid,

                'due_amount' =>
                    $dueAmount,

                'payment_status' =>
                    $paymentStatus,
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Email
        |--------------------------------------------------------------------------
        */

        try {

            if (
                !empty(
                    $booking->passenger_email
                )
            ) {

                Mail::to(
                    $booking->passenger_email
                )->queue(
                    new BookingConfirmationMail(
                        $booking
                    )
                );
            }

            $adminEmail =
                config('mail.from.address');

            if (!empty($adminEmail)) {

                Mail::to($adminEmail)->queue(
                    new AdminBookingConfirmationMail(
                        $booking
                    )
                );
            }

        } catch (\Throwable $e) {

            Log::error(
                'Booking confirmation email failed',
                [
                    'booking_id' =>
                        $booking->id,

                    'message' =>
                        $e->getMessage(),
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('home', [
                'payment' => 'success',
                'booking' =>
                    $booking->booking_no,
            ])
            ->with('notify', [
                'type' => 'success',
                'message' =>
                    'Payment successful! Booking confirmed.',
            ]);

    } catch (\Throwable $e) {

        /*
        |--------------------------------------------------------------------------
        | Payment Failed
        |--------------------------------------------------------------------------
        */

        $booking->status = 'pending';
        $booking->payment_status = 'failed';
        $booking->save();

        Log::error(
            'Stripe payment failed',
            [
                'booking_id' =>
                    $booking->id,

                'booking_no' =>
                    $booking->booking_no,

                'payment_method' =>
                    $paymentMethod,

                'amount' =>
                    $amountToCharge,

                'message' =>
                    $e->getMessage(),
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Payment Failed Email
        |--------------------------------------------------------------------------
        */

        try {

            if (
                !empty(
                    $booking->passenger_email
                )
            ) {

                Mail::to(
                    $booking->passenger_email
                )->queue(
                    new PaymentFailedMail(
                        $booking
                    )
                );
            }

        } catch (\Throwable $mailException) {

            Log::error(
                'Payment failed email failed',
                [
                    'booking_id' =>
                        $booking->id,

                    'message' =>
                        $mailException->getMessage(),
                ]
            );
        }


        return back()
            ->withInput()
            ->with(
                'error',
                'Payment could not be processed. Please try again.'
            );
    }
    }
    private function calculateFare(Request $request): array
{
    $rawFare = $request->input('fare', []);

    $estimatedFare = (float) (
        $rawFare['estimatedFare']
        ?? $rawFare['estimated_fare']
        ?? 0
    );

    $gratuity = (float) (
        $rawFare['gratuity'] ?? 0
    );

    $pickupTax = (float) (
        $rawFare['pickup_tax'] ?? 0
    );

    $dropoffTax = (float) (
        $rawFare['dropoff_tax'] ?? 0
    );

    $parkingFee = (float) (
        $rawFare['parking_fee'] ?? 0
    );

    $tollFee = (float) (
        $rawFare['toll_fee'] ?? 0
    );

    $surchargeFee = (float) (
        $rawFare['surcharge_fee'] ?? 0
    );

    $extraLuggageFee = (float) (
        $rawFare['extra_luggage_fee'] ?? 0
    );

    $childSeatFee = (float) (
        $rawFare['child_seat_fee'] ?? 0
    );

    $boosterSeatFee = (float) (
        $rawFare['booster_seat_fee'] ?? 0
    );

    $frontSeatFee = (float) (
        $rawFare['front_seat_fee'] ?? 0
    );

    $stopoverFee = (float) (
        $rawFare['stopover_fee'] ?? 0
    );

    $extrasTotal = (float) (
        $rawFare['extras_total']
        ?? $request->input('extras_total', 0)
    );

    $total = isset($rawFare['total'])
        ? (float) $rawFare['total']
        : (float) $request->input('amount_charged', 0);

    return [
        'name' => $rawFare['name'] ?? null,

        'estimated_fare' => $estimatedFare,

        'gratuity' => $gratuity,

        'pickup_tax' => $pickupTax,

        'dropoff_tax' => $dropoffTax,

        'parking_fee' => $parkingFee,

        'toll_fee' => $tollFee,

        'surcharge_fee' => $surchargeFee,

        'extra_luggage_fee' => $extraLuggageFee,

        'child_seat_fee' => $childSeatFee,

        'booster_seat_fee' => $boosterSeatFee,

        'front_seat_fee' => $frontSeatFee,

        'stopover_fee' => $stopoverFee,

        'extras_total' => $extrasTotal,

        'total' => $total,
    ];
}

}
