@extends('layouts.main')

@section('title')
    <title>Booking Payment | {{ config('app.name') }}</title>
@endsection

@push('styles')
<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
</style>
@endpush

@section('container')
<div class="pt-16 pb-12">
    <div class="max-w-6xl mx-auto p-4 md:p-6">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">Payment Checkout</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            <div class="bg-white rounded-lg border-2 border-gray-200/50 backdrop-blur-sm shadow-lg lg:col-span-2 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-4">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <i class="fas fa-check text-xl mr-2"></i>
                            <span class="font-medium">E-Ticket - {{ strtoupper(substr($route->departure_city, 0, 3)) }} to {{ strtoupper(substr($route->objective_city, 0, 3)) }}</span>
                        </div>
                        <span class="text-sm bg-white/20 py-1 px-2 rounded">Ref: #ABC123456</span>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="flex items-center mb-4 md:mb-0">
                            <img src="{{ asset('assets/img/transport_logo/' . $transport->logo) }}" alt="Airline" class="w-12 h-12 rounded-full object-contain mr-3">
                            <div>
                                <h2 class="font-bold text-gray-800">{{ $route->departure_city }} ({{ strtoupper(substr($route->departure_city, 0, 3)) }}) → {{ $route->objective_city }} ({{ strtoupper(substr($route->objective_city, 0, 3)) }})</h2>
                                <p class="text-gray-500 text-sm">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $booking->departure_date)->format('l, d M Y') }} · {{ $transport->class_name }} · {{ $transport->kode }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xl font-bold text-blue-600">IDR {{ number_format($booking->total_payment, 0, ',', '.') }}</p>
                            <p class="text-gray-500 text-sm">Including tax</p>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Flight Details</h3>

                        <div class="bg-gray-50 rounded-lg p-4 mb-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 pt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                    </svg>
                                </div>
                                <div class="ml-3 flex-grow">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-semibold text-gray-800 mb-1">{{ $route->departure_city }} ({{ strtoupper(substr($route->departure_city, 0, 3)) }}) → {{ $route->objective_city }} ({{ strtoupper(substr($route->objective_city, 0, 3)) }})</p>
                                            @php
                                                $departure = \Carbon\Carbon::createFromFormat('H:i:s', $route->departure_time);
                                                $arrival = \Carbon\Carbon::createFromFormat('H:i:s', $route->arrival_time);
                                                $duration = $departure->diff($arrival);
                                            @endphp
                                            <p class="text-sm text-gray-600">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $booking->departure_date)->format('l, d F Y') }} · {{ \Carbon\Carbon::createFromFormat('H:i:s', $route->departure_time)->format('H:i') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $route->arrival_time)->format('H:i') }} · {{ $duration->h }}h {{ $duration->i }}m</p>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Direct</span>
                                        </div>
                                    </div>
                                    <div class="mt-2 text-sm text-gray-600">
                                        <p>{{ $transport->name }} - {{ $transport->kode }}</p>
                                        <p>{{ $transport->class_name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="font-semibold text-gray-800 mb-4">E-Ticket Shipping</h3>

                        <div class="bg-gray-50 rounded-lg border border-gray-200">
                            <div class="flex justify-between items-center p-4">
                                <div>
                                    <span class="font-medium text-gray-800">Email Notification</span>
                                    <p class="text-sm text-gray-600 mt-1">Ticket will be sent to email after payment success</p>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Passenger Details</h3>

                        @foreach($booking_passenger as $passenger)
                        <div class="bg-gray-50 rounded-lg p-4 mb-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $passenger->name }}</p>
                                    <p class="text-sm text-blue-600">{{ ucfirst($passenger->type) }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 lg:col-span-1 border-2 border-gray-200/50 backdrop-blur-sm sticky top-24">
                <div class="space-y-6">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 flex justify-between">
                            <span>Payment Methods</span>
                        </h2>
                    </div>

                    <div id="payment-methods" class="space-y-2">
                        @foreach (['BCA', 'DANA', 'GoPay'] as $method)
                            <div class="payment-option flex items-center p-3 rounded-lg cursor-pointer border border-gray-300 hover:bg-gray-100 transition duration-200" data-method="{{ $method }}">
                                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white font-semibold">{{ substr($method, 0, 1) }}</span>
                                </div>
                                <span class="text-lg font-medium text-gray-800">{{ $method }}</span>
                                <div class="ml-auto">
                                    <div class="radio-indicator w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center transition duration-200">
                                        <div class="inner-circle w-3 h-3 rounded-full hidden transition duration-200"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="selected_payment" id="selected-payment">

                    <div class="mt-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Payment Summary</h2>

                        @php
                            $groupedPassengers = [];
                            foreach ($booking_passenger as $passenger) {
                                $type = ucfirst($passenger->type);
                                if (!isset($groupedPassengers[$type])) {
                                    $groupedPassengers[$type] = [
                                        'count' => 0,
                                        'price' => 0
                                    ];
                                }
                                $groupedPassengers[$type]['count']++;
                                $groupedPassengers[$type]['price'] += $passenger->price;
                            }
                        @endphp

                        <div class="space-y-3">
                            @foreach ($groupedPassengers as $type => $data)
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Ticket ({{ $data['count'] }} {{ $type }})</span>
                                    <span class="font-medium">IDR {{ number_format($data['price'], 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tax & Fee</span>
                                <span class="font-medium">Included</span>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 mt-6 pt-4">
                            <div class="flex justify-between items-center py-2">
                                <span class="text-lg font-semibold text-gray-800">Total Payment</span>
                                <span class="text-xl font-bold text-blue-600">IDR {{ number_format($booking->total_payment, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg mt-6 flex items-center justify-center transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Pay Now
                        </button>

                        <p class="text-sm text-center text-gray-600 mt-4">
                            By continuing to payment, you agree to our <a href="#" class="text-blue-600 hover:underline">Terms & Conditions</a> and <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let passengers = @json($booking_passenger);
</script>
<script src="{!! asset('js/booking/booking-payment.js') !!}?v={{ time() }}"></script>
@endpush
