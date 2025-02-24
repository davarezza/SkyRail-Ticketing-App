@extends('layouts.main')

@section('title')
    <title>Home | {{ config('app.name') }}</title>
@endsection

@push('styles')
<style>
    #toast-container {
        top: 1rem;
        opacity: 1;
    }
</style>
@endpush

@section('container')
    <section class="px-6 max-w-screen-lg mx-auto pt-24">
        <div class="flex items-center gap-2 mb-8">
            <h1 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h1>
            <i class="fa-solid fa-circle-check text-blue-500 text-xl"></i>
        </div>

        <div class="grid md:grid-cols-4 gap-6">
            @include('partials.sidebar-user')
            <div class="md:col-span-3">
                @foreach ($bookings as $booking)
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 hover:border-blue-100 transition-all duration-300 p-6 mb-4">
                    <div class="space-y-6">
                        <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                            <div class="flex items-center gap-4">
                                <div class="flex items-center text-blue-500 font-medium">
                                    <i class="fas fa-plane-departure mr-2 text-lg"></i>
                                    <span>Flights</span>
                                </div>
                                @php
                                    $statusMap = [
                                        'draft' => ['text' => 'Draft', 'color' => 'bg-gray-100 text-gray-600 ring-gray-200'],
                                        'select_seat' => ['text' => 'Select Seat', 'color' => 'bg-yellow-100 text-yellow-600 ring-yellow-200'],
                                        'waiting_payment' => ['text' => 'Waiting Payment', 'color' => 'bg-orange-100 text-orange-600 ring-orange-200'],
                                        'paid' => ['text' => 'Paid', 'color' => 'bg-green-100 text-green-600 ring-green-200'],
                                        'verified' => ['text' => 'Verified', 'color' => 'bg-blue-100 text-blue-600 ring-blue-200'],
                                        'expired' => ['text' => 'Expired', 'color' => 'bg-red-100 text-red-600 ring-red-200'],
                                    ];
                                @endphp

                                <span class="px-3 py-1 rounded-full text-xs font-medium ring-1 {{ $statusMap[$booking->status]['color'] }}">
                                    {{ $statusMap[$booking->status]['text'] }}
                                </span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                <span class="text-sm font-medium text-gray-600">One Way</span>
                            </div>
                        </div>

                        <!-- Order Details -->
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-3">
                                    {{ $booking->departure_city }}
                                    <span class="text-blue-500">
                                        <i class="fas fa-plane text-sm"></i>
                                    </span>
                                    {{ $booking->objective_city }}
                                </h2>
                                @if (in_array($booking->status, ['paid', 'verified']))
                                <a href="{{ route('booking.check-ticket', $booking->id) }}" class="text-blue-500 text-sm font-medium hover:text-blue-600 flex items-center gap-1 group">
                                    See Detail
                                </a>
                                @endif
                            </div>

                            <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <i class="fas fa-users text-blue-500"></i>
                                    <span>{{ $booking->transport_class }} •
                                        @php
                                            $types = ['adult' => 'Adult', 'child' => 'Child', 'infant' => 'Infant'];
                                            $passengerText = [];

                                            foreach ($types as $key => $label) {
                                                if (!empty($booking->passenger_counts[$key])) {
                                                    $passengerText[] = $booking->passenger_counts[$key] . ' ' . $label;
                                                }
                                            }
                                        @endphp

                                        {{ implode(', ', $passengerText) }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-3 text-sm text-gray-600">
                                    <i class="fas fa-calendar text-blue-500"></i>
                                    <div class="flex items-center gap-2">
                                        <span class="font-medium">
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $booking->departure_date)->format('D, d M Y') }} •
                                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $booking->route->departure_time ?? '00:00:00')->format('H.i') }}
                                        </span>
                                        <i class="fas fa-arrow-right text-xs text-blue-500"></i>
                                        <span class="font-medium">
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d', $booking->departure_date)->format('D, d M Y') }} •
                                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $booking->route->arrival_time ?? '00:00:00')->format('H.i') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
