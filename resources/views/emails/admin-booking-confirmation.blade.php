<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: #333333;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #0FA96D;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }

        .header h2 {
            color: #0FA96D;
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .booking-ref {
            font-size: 15px;
            color: #555555;
            margin-top: 6px;
        }

        .section-title {
            background: #f8f9fa;
            padding: 10px 14px;
            font-weight: 700;
            border-left: 4px solid #0FA96D;
            margin-top: 25px;
            margin-bottom: 8px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            font-size: 13px;
        }

        td {
            padding: 9px 10px;
            vertical-align: top;
            border-bottom: 1px solid #f0f0f0;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .label {
            font-weight: 600;
            width: 42%;
            color: #555555;
        }

        .value {
            color: #111111;
        }

        .footer {
            margin-top: 35px;
            text-align: center;
            font-size: 12px;
            color: #888888;
            border-top: 1px solid #eeeeee;
            padding-top: 20px;
            line-height: 1.5;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h2>Booking Confirmed</h2>
            <div class="booking-ref">Reference No: <strong>{{ $booking->booking_no }}</strong></div>
        </div>

        <p>Dear <strong>{{ $booking->passenger_name }}</strong>,</p>

        <p>We are pleased to inform you that your booking has been successfully confirmed by our team. Please review the details below.</p>

        <!-- Trip Information -->
        <div class="section-title">Trip Information</div>
        <table>
            <tr>
                <td class="label">Service Type:</td>
                <td class="value">
                    @if ($booking->trip_type == 'fromAirport') From Airport
                    @elseif ($booking->trip_type == 'toAirport') To Airport
                    @else Door to Door
                    @endif
                </td>
            </tr>

            @if($booking->pickup_date)
            <tr>
                <td class="label">Pickup Date:</td>
                <td class="value">{{ \Carbon\Carbon::parse($booking->pickup_date)->format('l, d M Y') }}</td>
            </tr>
            @endif

            @if($booking->pickup_time)
            <tr>
                <td class="label">Pickup Time:</td>
                <td class="value">{{ \Carbon\Carbon::parse($booking->pickup_time)->format('h:i A') }}</td>
            </tr>
            @endif

            @if($booking->pickup_address)
            <tr>
                <td class="label">Pickup Location:</td>
                <td class="value">{{ $booking->pickup_address }}</td>
            </tr>
            @endif

            @if($booking->dropoff_address)
            <tr>
                <td class="label">Dropoff Location:</td>
                <td class="value">{{ $booking->dropoff_address }}</td>
            </tr>
            @endif

            @if(!empty($booking->flight_number))
            <tr>
                <td class="label">Flight Info:</td>
                <td class="value">{{ $booking->airline_name ? $booking->airline_name . ' ' : '' }}(Flight: {{ $booking->flight_number }})</td>
            </tr>
            @endif
        </table>

        <!-- Vehicle & Passengers -->
        <div class="section-title">Vehicle & Passengers</div>
        <table>
            @if($booking->vehicle_type)
            <tr>
                <td class="label">Selected Vehicle:</td>
                <td class="value">Luxury Vehicle</td>
            </tr>
            @endif

            <tr>
                <td class="label">Passengers:</td>
                <td class="value">
                    @php
                        $adults = (int)($booking->adults ?? 0);
                        $children = (int)($booking->children ?? 0);
                        $totalPassengers = $booking->total_passengers ?? ($adults + $children);

                        $breakdown = [];
                        if ($adults > 0) $breakdown[] = "{$adults} " . \Illuminate\Support\Str::plural('Adult', $adults);
                        if ($children > 0) $breakdown[] = "{$children} " . \Illuminate\Support\Str::plural('Child', $children);
                    @endphp

                    <strong>{{ $totalPassengers }}</strong>
                    @if(!empty($breakdown))
                        ({{ implode(', ', $breakdown) }})
                    @endif
                </td>
            </tr>

            @php
                $extras = [];
                if (!empty($booking->infant_seat_count)) $extras[] = "{$booking->infant_seat_count} Infant Seat(s)";
                if (!empty($booking->booster_seat_count)) $extras[] = "{$booking->booster_seat_count} Booster Seat(s)";
                if (!empty($booking->front_seat_count)) $extras[] = "{$booking->front_seat_count} Front Facing Seat(s)";
                if (!empty($booking->stopover_count)) $extras[] = "{$booking->stopover_count} Stopover(s)";
                if (!empty($booking->pet_count)) $extras[] = "{$booking->pet_count} Pet(s)";
            @endphp

            @if(!empty($extras))
            <tr>
                <td class="label">Add-ons & Requests:</td>
                <td class="value">{{ implode(', ', $extras) }}</td>
            </tr>
            @endif

            @if(isset($booking->luggage))
            <tr>
                <td class="label">Luggage:</td>
                <td class="value">{{ $booking->luggage }} {{ \Illuminate\Support\Str::plural('Bag', (int)$booking->luggage) }}</td>
            </tr>
            @endif
        </table>

        <!-- Booking & Fare Details -->
        @if($booking->total_fare > 0 || $booking->status)
        <div class="section-title">Payment & Status</div>
        <table>
            @if($booking->total_fare > 0)
            <tr>
                <td class="label">Total Estimated Fare:</td>
                <td class="value" style="font-weight: bold; color: #0FA96D;">${{ number_format($booking->total_fare, 2) }}</td>
            </tr>
            @endif

            @if($booking->status)
            <tr>
                <td class="label">Payment Status:</td>
                <td class="value" style="text-transform: capitalize;">{{ $booking->status }}</td>
            </tr>
            @endif
        </table>
        @endif

        <div class="footer">
            <p>If you have questions, reply directly to this email.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All Rights Reserved.</p>
        </div>
    </div>

</body>

</html>
