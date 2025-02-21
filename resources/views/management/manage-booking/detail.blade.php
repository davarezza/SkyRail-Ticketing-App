@extends('layouts.master')

@section('title')
    <title>Manage Booking Detail | {{ config('app.name') }}</title>
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb" class="py-3 px-3">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('management.manage-booking.index') }}" class="text-decoration-none">Manage Booking</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
</nav>
@endsection

@section('container')
<div class="container py-4">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-primary text-white py-3">
            <h4 class="card-title mb-0 text-center">Detail Booking</h4>
        </div>
        <div class="card-body p-4">
            @php
                $statusColors = [
                    'draft' => 'secondary',
                    'select_seat' => 'primary',
                    'waiting_payment' => 'warning',
                    'paid' => 'success',
                    'expired' => 'danger',
                    'verified' => 'info',
                ];
                $statusDisplay = [
                    'draft' => 'Draft',
                    'select_seat' => 'Select Seat',
                    'waiting_payment' => 'Waiting Payment',
                    'paid' => 'Paid',
                    'expired' => 'Expired',
                    'verified' => 'Verified',
                ];
                $statusColor = $statusColors[strtolower($booking->status)] ?? 'secondary';
                $statusText = $statusDisplay[strtolower($booking->status)] ?? $booking->status;
            @endphp
            <div class="alert alert-{{ $statusColor }} mb-3 text-center">
                <h5 class="mb-0">Status: {{ $statusText }}</h5>
            </div>

            <!-- Main Booking Details -->
            <div class="row g-4">
                <!-- Left Column -->
                <div class="col-md-6">
                    <div class="card h-100 border-0 bg-light">
                        <div class="card-body">
                            <h5 class="card-title mb-3 text-primary fs-5">Customer Information</h5>
                            <div class="mb-3">
                                <label class="text-muted small mb-2">Booking Code</label>
                                <p class="h5 mb-0 fs-6">#{{ $booking->code }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small mb-2">Customer Name</label>
                                <p class="h5 mb-0 fs-6">{{ $booking->booker_name }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small mb-2">Email</label>
                                <p class="h5 mb-0 fs-6">{{ $booking->booker_email }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small mb-2">Phone Number</label>
                                <p class="h5 mb-0 fs-6">{{ $booking->booker_telephone }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small mb-2">Booking Date</label>
                                <p class="h5 mb-0 fs-6">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $booking->departure_date)->format('d F Y') }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small mb-2">Total Payment</label>
                                <p class="h5 mb-0 fs-6">IDR {{ number_format($booking->total_payment, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <div class="card h-100 border-0 bg-light">
                        <div class="card-body">
                            <h5 class="card-title mb-3 text-primary fs-5">Travel Information</h5>
                            <div class="mb-3">
                                <label class="text-muted small mb-2">Route</label>
                                <p class="h5 mb-0 fs-6">
                                    <i class="bi bi-geo-alt-fill text-primary me-2"></i>
                                    {{ $route->departure_city }}
                                    <i class="bi bi-arrow-right mx-2"></i>
                                    {{ $route->objective_city }}
                                </p>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small mb-2">Airports</label>
                                <p class="h5 mb-0 fs-6">
                                    <i class="bi bi-building-fill text-primary me-2"></i>
                                    {{ $route->departure_airport }}
                                    <i class="bi bi-arrow-right mx-2"></i>
                                    {{ $route->objective_airport }}
                                </p>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small mb-2">Time</label>
                                @php
                                    $departure = \Carbon\Carbon::createFromFormat('H:i:s', $route->departure_time);
                                    $arrival = \Carbon\Carbon::createFromFormat('H:i:s', $route->arrival_time);
                                    $duration = $departure->diff($arrival);
                                @endphp
                                <p class="h5 mb-0 fs-6">
                                    <i class="bi bi-building-fill text-primary me-2"></i>
                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $route->departure_time)->format('H.i') }}
                                    <i class="bi bi-arrow-right mx-2"></i>
                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $route->arrival_time)->format('H.i') }} ({{ $duration->h }}h {{ $duration->i }}m)
                                </p>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small mb-2">Transportation</label>
                                <p class="h5 mb-0 fs-6">
                                    <i class="bi bi-airplane-fill text-primary me-2"></i>
                                    {{ $transport->name }} ({{ $transport->kode }})
                                </p>
                            </div>
                            <div class="mb-3">
                                <label class="text-muted small mb-2">Number of Passengers</label>
                                <p class="h5 mb-0 fs-6">
                                    <i class="bi bi-people-fill text-primary me-2"></i>
                                    {{ count($booking_passenger) }} passengers
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Passenger List -->
            <div class="mt-5">
                <h5 class="card-title mb-3 text-primary fs-5">Passenger Details</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th class="fs-6">#</th>
                                <th class="fs-6">Name</th>
                                <th class="fs-6">Type</th>
                                <th class="fs-6">Seat Code</th>
                                <th class="fs-6">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($booking_passenger as $index => $passenger)
                            <tr>
                                <td class="fs-6">{{ $index + 1 }}</td>
                                <td class="fs-6">{{ $passenger->name }}</td>
                                <td>
                                    <span class="badge bg-info fs-6 text-capitalize">{{ $passenger->type }}</span>
                                </td>
                                <td class="fs-6">{{ $passenger->seat_code }}</td>
                                <td>
                                    <span class="fs-6">IDR {{ number_format($passenger->price, 0, ',', '.') }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-5 text-center">
                <a href="{{ route('management.manage-booking.index') }}" class="btn btn-secondary me-3 px-4 py-2 fs-6">
                    <i class="bi bi-arrow-left me-2"></i> Back to List
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
<style>
    .card {
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .badge {
        padding: 8px 12px;
        font-weight: 500;
    }
    .table > :not(caption) > * > * {
        padding: 1rem;
    }
    .text-muted.small {
        font-size: 0.85rem;
    }
    .bi {
        font-size: 1.1rem;
    }
</style>
@endpush
