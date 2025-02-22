<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: #fff;
        }

        .e-ticket {
            position: relative;
            background: white;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 24px;
            padding: 24px;
            page-break-inside: avoid;
        }

        .gradient-bar {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 8px;
            background: linear-gradient(to right, #3b82f6, #22d3ee);
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }

        .route-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            margin-top: 20px;
            position: relative;
            padding: 0 40px;
        }

        .city-info {
            text-align: center;
            flex: 0 0 auto;
            z-index: 1;
            background: white;
            padding: 0 16px;
        }

        .city-name {
            font-size: 18px;
            font-weight: bold;
            color: #1f2937;
        }

        .flight-path {
            position: absolute;
            left: 0;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            width: 100%;
            z-index: 0;
        }

        .flight-line {
            flex: 1;
            height: 2px;
            background: #d1d5db;
            max-width: 200px;
        }

        .plane-icon {
            color: #3b82f6;
            transform: rotate(90deg);
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            padding: 0 8px;
        }

        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 20px;
        }

        .carrier-info {
            text-align: center;
            font-size: 16px;
            color: #6b7280;
            margin-bottom: 30px;
        }

        .flight-details {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }

        .detail-item {
            margin-bottom: 16px;
        }

        .detail-label {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 4px;
        }

        .detail-value {
            font-weight: 600;
            color: #1f2937;
        }

        .ticket-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 24px;
            border-top: 1px dashed #e5e7eb;
        }

        .booking-info {
            margin-bottom: 8px;
        }

        .booking-code {
            font-size: 20px;
            font-weight: bold;
            color: #1f2937;
            margin: 8px 0;
        }

        .seat-number {
            font-size: 12px;
            font-weight: 600;
            color: #6b7280;
        }

        .qr-code {
            width: 96px;
            height: 96px;
            background: #f3f4f6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="title">E-TICKET</div>
    <div class="carrier-info">{{ config('app.name') }} Airlines</div>
    @foreach($booking_passenger as $passenger)
    <div class="e-ticket">
        <div class="gradient-bar"></div>

        <div class="route-header">
            <div class="city-info">
                <div class="city-name">{{ $booking->departure_city }}</div>
            </div>
            <div class="city-info">
                <div class="city-name">{{ $booking->objective_city }}</div>
            </div>
        </div>

        <div class="flight-details">
            <div class="detail-item">
                <div class="detail-label">Passenger</div>
                <div class="detail-value">{{ $passenger->name }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Flight Date</div>
                <div class="detail-value">{{ date('d M Y', strtotime($booking->departure_date)) }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Departure</div>
                <div class="detail-value">{{ date('H:i', strtotime($route->departure_time)) }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Arrival</div>
                <div class="detail-value">{{ date('H:i', strtotime($route->arrival_time)) }}</div>
            </div>
        </div>

        <div class="ticket-footer">
            <div class="booking-info">
                <div class="detail-label">Booking Code</div>
                <div class="booking-code">{{ $booking->code }}</div>
                <div class="seat-number">Seat {{ $passenger->seat_code }}</div>
            </div>

            <div class="qr-code">
                {!! QrCode::size(80)->generate($booking->code) !!}
            </div>
        </div>
    </div>
    @endforeach
</body>
</html>
