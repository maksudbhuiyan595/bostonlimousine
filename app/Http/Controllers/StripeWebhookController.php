<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmationMail;
use App\Mail\PaymentFailedMail;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Stripe\Exception\SignatureVerificationException;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Stripe\Stripe;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
    // public function handle(Request $request)
    // {
    //     $payload = $request->getContent();
    //     $signature = $request->header('Stripe-Signature');
    //     $webhookSecret = config('services.stripe.webhook_secret');

    //     try {
    //         $event = Webhook::constructEvent($payload, $signature, $webhookSecret);
    //     } catch (\UnexpectedValueException $e) {
    //         Log::error('Stripe webhook invalid payload', ['message' => $e->getMessage()]);
    //         return response()->json(['error' => 'Invalid payload'], 400);
    //     } catch (SignatureVerificationException $e) {
    //         Log::error('Stripe webhook invalid signature', ['message' => $e->getMessage()]);
    //         return response()->json(['error' => 'Invalid signature'], 400);
    //     }

    //     Log::info('Stripe webhook received', [
    //         'event_id'   => $event->id,
    //         'event_type' => $event->type,
    //     ]);

    //     switch ($event->type) {
    //         case 'payment_intent.requires_capture':
    //         case 'payment_intent.amount_capturable_updated':
    //             $paymentIntent = $event->data->object;
    //             $this->capturePaymentIntent($paymentIntent);
    //             break;

    //         case 'payment_intent.succeeded':
    //             $paymentIntent = $event->data->object;
    //             $this->handlePaymentSucceeded($paymentIntent);
    //             break;

    //         case 'payment_intent.payment_failed':
    //         case 'payment_intent.canceled':
    //             $paymentIntent = $event->data->object;
    //             $this->handlePaymentFailed($paymentIntent);
    //             break;
    //     }

    //     return response()->json(['received' => true], 200);
    // }

    // private function capturePaymentIntent($paymentIntent): void
    // {
    //     if ($paymentIntent->status === 'requires_capture') {
    //         try {
    //             Stripe::setApiKey(config('services.stripe.secret'));
    //             PaymentIntent::capture($paymentIntent->id);
    //             Log::info('PaymentIntent captured successfully', ['id' => $paymentIntent->id]);
    //         } catch (\Throwable $e) {
    //             Log::error('PaymentIntent capture failed', [
    //                 'id'      => $paymentIntent->id,
    //                 'message' => $e->getMessage(),
    //             ]);
    //         }
    //     }
    // }

    // private function handlePaymentSucceeded($paymentIntent): void
    // {
    //     $bookingId = $paymentIntent->metadata->booking_id ?? null;
    //     $booking = $bookingId
    //         ? Booking::find($bookingId)
    //         : Booking::where('transaction_id', $paymentIntent->id)->first();

    //     if (!$booking) {
    //         Log::error('Booking not found for succeeded payment', ['pi' => $paymentIntent->id]);
    //         return;
    //     }

    //     // Idempotency check: Already confirmed হলে আর কিছু করবে না
    //     if ($booking->status === 'confirmed' && in_array($booking->payment_status, ['paid', 'partial'], true)) {
    //         return;
    //     }

    //     $paidAmount = ((int) $paymentIntent->amount_received) / 100;
    //     $totalFare = (float) $booking->total_fare;
    //     $dueAmount = max(0, round($totalFare - $paidAmount, 2));

    //     $booking->transaction_id = $paymentIntent->id;
    //     $booking->paid_amount    = $paidAmount;
    //     $booking->due_amount     = $dueAmount;
    //     $booking->payment_status = ($dueAmount <= 0.01) ? 'paid' : 'partial';
    //     $booking->status         = 'confirmed';

    //     // কার্ডের ব্রান্ড ও লাস্ট ৪ ডিজিট সংরক্ষণ
    //     try {
    //         if ($paymentIntent->payment_method) {
    //             Stripe::setApiKey(config('services.stripe.secret'));
    //             $paymentMethod = PaymentMethod::retrieve($paymentIntent->payment_method);
    //             if ($paymentMethod->card) {
    //                 $booking->card_brand     = $paymentMethod->card->brand ?? null;
    //                 $booking->card_last_four = $paymentMethod->card->last4 ?? null;
    //             }
    //         }
    //     } catch (\Throwable $e) {
    //         Log::warning('Could not retrieve card details: ' . $e->getMessage());
    //     }

    //     $booking->save();

    //     // ইমেইল পাঠানো
    //     try {
    //         Mail::to($booking->passenger_email)->send(new BookingConfirmationMail($booking));
    //         if ($adminEmail = config('mail.from.address')) {
    //             Mail::to($adminEmail)->send(new BookingConfirmationMail($booking));
    //         }
    //     } catch (\Throwable $e) {
    //         Log::error('Confirmation email failed', [
    //             'booking_id' => $booking->id,
    //             'message'    => $e->getMessage(),
    //         ]);
    //     }
    // }

    // private function handlePaymentFailed($paymentIntent): void
    // {
    //     $bookingId = $paymentIntent->metadata->booking_id ?? null;
    //     $booking = $bookingId
    //         ? Booking::find($bookingId)
    //         : Booking::where('transaction_id', $paymentIntent->id)->first();

    //     if (!$booking) {
    //         return;
    //     }

    //     $booking->status = 'failed';
    //     $booking->payment_status = 'failed';
    //     $booking->transaction_id = $paymentIntent->id;
    //     $booking->save();

    //     try {
    //         $failData = [
    //             'name'          => $booking->passenger_name,
    //             'email'         => $booking->passenger_email,
    //             'phone'         => $booking->passenger_phone,
    //             'error_message' => $paymentIntent->last_payment_error->message ?? 'Payment was declined or canceled.',
    //             'date'          => now()->toDateTimeString(),
    //         ];

    //         if ($adminEmail = config('mail.from.address')) {
    //             Mail::to($adminEmail)->send(new PaymentFailedMail($failData));
    //         }
    //     } catch (\Throwable $e) {
    //         Log::error('Payment failed notification email error: ' . $e->getMessage());
    //     }
    // }
    //  public function confirmBooking(Request $request)
    // {
    //     /*
    //     |--------------------------------------------------------------------------
    //     | 1. Validate Form Request
    //     |--------------------------------------------------------------------------
    //     */
    //     $request->validate([
    //         'stripe_token'     => 'required|string',
    //         'amount_charged'   => 'required|numeric|min:1',
    //         'passenger_name'   => 'required|string|max:255',
    //         'passenger_email'  => 'required|email|max:255',
    //         'phone_number'     => 'nullable|string|max:50',
    //         'payment_method'   => 'nullable|string|in:cash,deposit,card',
    //     ]);

    //     $paymentMethod = $request->input('payment_method', 'card');

    //     /*
    //     |--------------------------------------------------------------------------
    //     | 2. Calculate and Validate Fare
    //     |--------------------------------------------------------------------------
    //     */
    //     $fare = $this->calculateFare($request);
    //     $totalFare = round((float) ($fare['total'] ?? 0), 2);

    //     if ($totalFare <= 0) {
    //         return back()->withInput()->with('error', 'Calculated fare amount is invalid.');
    //     }

    //     // Cash বা Deposit হলে $1.00 হোল্ড ফি, Card হলে সম্পূর্ণ ফেয়ার
    //     $amountToCharge = in_array($paymentMethod, ['cash', 'deposit'], true) ? 1.00 : $totalFare;
    //     $amountCharged  = round((float) $request->amount_charged, 2);

    //     if (abs($amountCharged - $amountToCharge) > 0.05 && abs($amountCharged - $totalFare) > 0.05) {
    //         return back()->withInput()->with(
    //             'error',
    //             'Payment amount mismatch. Expected: $' . number_format($amountToCharge, 2)
    //         );
    //     }

    //     /*
    //     |--------------------------------------------------------------------------
    //     | 3. Create Booking Inside DB Transaction
    //     |--------------------------------------------------------------------------
    //     */
    //     DB::beginTransaction();

    //     try {
    //         // Generate Unique Sequential Booking Number (BLAT-XXXX or LAT-XXXX)
    //         $lastBooking = Booking::lockForUpdate()->orderByDesc('id')->first();
    //         $lastNumber = 0;

    //         if ($lastBooking && preg_match('/(?:BLAT|LAT)-(\d+)/', (string) $lastBooking->booking_no, $matches)) {
    //             $lastNumber = (int) $matches[1];
    //         }

    //         $bookingNo = 'LAT-' . str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

    //         $booking = new Booking();
    //         $booking->booking_no         = $bookingNo;

    //         // Passenger Info
    //         $booking->passenger_name     = $request->passenger_name;
    //         $booking->passenger_email    = $request->passenger_email;
    //         $booking->passenger_phone    = $request->passenger_phone ?? $request->phone_number;
    //         $booking->phone_country_code = $request->phone_country_code;
    //         $booking->alternate_phone    = $request->alternate_phone;
    //         $booking->mailing_address    = $request->mailing_address;
    //         $booking->special_needs      = $request->special_needs;

    //         // Trip Info
    //         $booking->trip_type          = $request->trip_type ?? $request->tripType;
    //         $booking->pickup_date        = $request->pickup_date ?? $request->date;
    //         $booking->pickup_time        = $request->pickup_time ?? $request->time;
    //         $booking->pickup_address     = $request->pickup ?? $request->pickup_address ?? $request->fromAddress;
    //         $booking->dropoff_address    = $request->dropoff ?? $request->dropoff_address ?? $request->to_address;
    //         $booking->distance_miles     = (float) ($request->distance_miles ?? 0);

    //         // Flight Info
    //         $booking->airline_name       = $request->airline_name;
    //         $booking->flight_number      = $request->flight_number;

    //         // Vehicle & Passengers
    //         $booking->vehicle_id         = $request->vehicle_id;
    //         $booking->vehicle_type       = $request->vehicle_type ?? ($fare['name'] ?? null);
    //         $booking->vehicles_used      = (int) ($request->vehicles_used ?? 1);
    //         $booking->adults             = (int) ($request->adults ?? 0);
    //         $booking->children           = (int) ($request->children ?? 0);
    //         $booking->total_passengers   = (int) ($request->total_passengers ?? $request->reqPassengers ?? ($booking->adults + $booking->children));
    //         $booking->luggage            = (int) ($request->luggage ?? 0);

    //         // Extras & Child Seats
    //         $booking->booster_seat_count = (int) ($request->booster_seat_count ?? $request->booster_seat ?? 0);
    //         $booking->infant_seat_count  = (int) ($request->infant_seat_count ?? $request->infant_seat ?? 0);
    //         $booking->front_seat_count   = (int) ($request->front_seat_count ?? $request->front_seat ?? 0);
    //         $booking->stopover_count     = (int) ($request->stopover_count ?? $request->stopover ?? 0);
    //         $booking->pet_count          = (int) ($request->pet_count ?? $request->pets ?? 0);

    //         // Billing Info
    //         $booking->card_holder_name   = $request->card_holder_name ?? $request->passenger_name;
    //         $booking->billing_phone      = $request->billing_phone ?? $booking->passenger_phone;
    //         $booking->billing_address    = $request->billing_address ?? $booking->mailing_address;
    //         $booking->billing_city       = $request->billing_city;
    //         $booking->billing_state      = $request->billing_state;
    //         $booking->billing_zip        = $request->billing_zip;

    //         // Fare Breakdown
    //         $booking->estimated_fare     = (float) $fare['estimated_fare'];
    //         $booking->gratuity           = (float) $fare['gratuity'];
    //         $booking->pickup_tax         = (float) $fare['pickup_tax'];
    //         $booking->dropoff_tax        = (float) $fare['dropoff_tax'];
    //         $booking->parking_fee        = (float) $fare['parking_fee'];
    //         $booking->toll_fee           = (float) $fare['toll_fee'];
    //         $booking->surcharge_fee      = (float) $fare['surcharge_fee'];
    //         $booking->extra_luggage_fee  = (float) $fare['extra_luggage_fee'];
    //         $booking->child_seat_fee     = (float) $fare['child_seat_fee'];
    //         $booking->booster_seat_fee   = (float) $fare['booster_seat_fee'];
    //         $booking->front_seat_fee     = (float) $fare['front_seat_fee'];
    //         $booking->stopover_fee       = (float) $fare['stopover_fee'];
    //         $booking->extras_total       = (float) $fare['extras_total'];
    //         $booking->total_fare         = $totalFare;

    //         // Payment States
    //         $booking->paid_amount        = 0;
    //         $booking->due_amount         = $totalFare;
    //         $booking->payment_method     = $paymentMethod;
    //         $booking->payment_status     = 'pending';
    //         $booking->status             = 'pending';

    //         $booking->save();
    //         DB::commit();

    //     } catch (\Throwable $e) {
    //         DB::rollBack();
    //         Log::error('Booking record creation failed', [
    //             'message' => $e->getMessage(),
    //             'email'   => $request->passenger_email,
    //         ]);

    //         return back()->withInput()->with('error', 'Unable to initiate booking record.');
    //     }

    //     /*
    //     |--------------------------------------------------------------------------
    //     | 4. Stripe PaymentIntent Creation (Outside DB Lock)
    //     |--------------------------------------------------------------------------
    //     */
    //     try {
    //         Stripe::setApiKey(config('services.stripe.secret'));

    //         $idempotencyKey = 'booking-' . $booking->id . '-' . md5($booking->booking_no . '|' . $amountToCharge);

    //         $paymentIntent = PaymentIntent::create([
    //             'amount'               => (int) round($amountToCharge * 100),
    //             'currency'             => 'usd',
    //             'payment_method_data'  => [
    //                 'type' => 'card',
    //                 'card' => [
    //                     'token' => $request->stripe_token,
    //                 ],
    //             ],
    //             'confirmation_method'  => 'manual',
    //             'capture_method'       => 'manual',
    //             'confirm'              => true,
    //             'return_url'           => route('home'),
    //             'description'          => 'Booking: ' . $booking->booking_no,
    //             'receipt_email'        => $booking->passenger_email,
    //             'metadata'             => [
    //                 'booking_id'       => (string) $booking->id,
    //                 'booking_no'       => (string) $booking->booking_no,
    //                 'payment_method'   => (string) $paymentMethod,
    //                 'phone'            => (string) ($booking->passenger_phone ?? ''),
    //                 'total_fare'       => (string) $totalFare,
    //                 'amount_to_charge' => (string) $amountToCharge,
    //             ],
    //         ], [
    //             'idempotency_key' => $idempotencyKey,
    //         ]);

    //         $booking->transaction_id = $paymentIntent->id;
    //         $booking->save();

    //         /*
    //         |--------------------------------------------------------------------------
    //         | Handle 3D Secure / OTP Challenge
    //         |--------------------------------------------------------------------------
    //         */
    //         if ($paymentIntent->status === 'requires_action') {
    //             return redirect()->route('home')->with([
    //                 'status'            => 'requires_action',
    //                 'payment_intent_id' => $paymentIntent->id,
    //                 'client_secret'     => $paymentIntent->client_secret,
    //                 'booking_no'        => $booking->booking_no,
    //             ]);
    //         }

    //         return redirect()->route('home', [
    //             'payment' => 'success',
    //             'booking' => $booking->booking_no,
    //         ])->with('notify', [
    //             'type'    => 'success',
    //             'message' => 'Payment authorization received. Your booking is confirmed!',
    //         ]);

    //     } catch (\Throwable $e) {
    //         $booking->status = 'failed';
    //         $booking->payment_status = 'failed';
    //         $booking->save();

    //         Log::error('Stripe payment authorization failed', [
    //             'booking_id' => $booking->id,
    //             'message'    => $e->getMessage(),
    //         ]);

    //         return back()->withInput()->with('error', 'Payment authorization failed: ' . $e->getMessage());
    //     }
    }

    /**
     * Safely Parse & Extract Fare Details from Form Request
     */
    // private function calculateFare(Request $request): array
    // {
    //     $rawFare = $request->input('fare', []);

    //     $estimatedFare   = (float) ($rawFare['estimatedFare'] ?? $rawFare['estimated_fare'] ?? 0);
    //     $gratuity        = (float) ($rawFare['gratuity'] ?? 0);
    //     $pickupTax       = (float) ($rawFare['pickup_tax'] ?? 0);
    //     $dropoffTax      = (float) ($rawFare['dropoff_tax'] ?? 0);
    //     $parkingFee      = (float) ($rawFare['parking_fee'] ?? 0);
    //     $tollFee         = (float) ($rawFare['toll_fee'] ?? 0);
    //     $surchargeFee    = (float) ($rawFare['surcharge_fee'] ?? 0);
    //     $extraLuggageFee = (float) ($rawFare['extra_luggage_fee'] ?? 0);
    //     $childSeatFee    = (float) ($rawFare['child_seat_fee'] ?? 0);
    //     $boosterSeatFee  = (float) ($rawFare['booster_seat_fee'] ?? 0);
    //     $frontSeatFee    = (float) ($rawFare['front_seat_fee'] ?? 0);
    //     $stopoverFee     = (float) ($rawFare['stopover_fee'] ?? 0);
    //     $extrasTotal     = (float) ($rawFare['extras_total'] ?? $request->input('extras_total', 0));

    //     $total = isset($rawFare['total'])
    //         ? (float) $rawFare['total']
    //         : (float) $request->input('amount_charged', 0);

    //     return [
    //         'name'              => $rawFare['name'] ?? null,
    //         'estimated_fare'    => $estimatedFare,
    //         'gratuity'          => $gratuity,
    //         'pickup_tax'        => $pickupTax,
    //         'dropoff_tax'       => $dropoffTax,
    //         'parking_fee'       => $parkingFee,
    //         'toll_fee'          => $tollFee,
    //         'surcharge_fee'     => $surchargeFee,
    //         'extra_luggage_fee' => $extraLuggageFee,
    //         'child_seat_fee'    => $childSeatFee,
    //         'booster_seat_fee'  => $boosterSeatFee,
    //         'front_seat_fee'    => $frontSeatFee,
    //         'stopover_fee'      => $stopoverFee,
    //         'extras_total'      => $extrasTotal,
    //         'total'             => $total,
    //     ];
    // }
}
