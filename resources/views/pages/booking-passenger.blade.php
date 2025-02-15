@extends('layouts.main')

@section('title')
    <title>Booking | {{ config('app.name') }}</title>
@endsection

@push('styles')
<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    
    .gradient-bg {
        background: linear-gradient(145deg, #ffffff 0%, #f3f4f6 100%);
    }
</style>
@endpush

@section('container')
<br><br><br>
    <div class="max-w-6xl mx-auto p-4 md:p-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Booking Form -->
            <div class="lg:col-span-2">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Booker Detail</h1>
                <p class="text-gray-500 mb-6">This contact detail will be used for e-ticket delivery and other purposes</p>

                <div class="rounded-lg shadow-lg p-4 mb-4 border-2 border-gray-200/50 backdrop-blur-sm">
                    <form class="space-y-4">
                        <div>
                            <input type="text" placeholder="Full Name" value="{{ $booking->booker_name }}" readonly
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all">
                        </div>
                        <div class="relative">
                            <div class="flex items-center absolute left-3 top-1/2 transform -translate-y-1/2 space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-8" viewBox="0 0 24 12" fill="none">
                                    <rect width="24" height="8" fill="#FF0000"/>
                                    <rect y="8" width="24" height="8" fill="#fcfcfc"/>
                                </svg>
                                <!-- Kode Negara -->
                                <span class="text-gray-700 text-sm">+62</span>
                                <!-- Divider -->
                                <span class="text-gray-300 ml-1">|</span>
                            </div>
                            <input type="tel" readonly
                                   placeholder="08xxxx" value="{{ $booking->booker_telephone }}" 
                                   class="w-full pl-24 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all text-gray-700"
                            >
                        </div>
                        <div>
                            <input type="email" placeholder="Email" value="{{ $booking->booker_email }}" readonly
                                   class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all">
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column - Flight Summary -->
            <div class="lg:col-span-1">
                <div class="rounded-lg shadow-lg p-4 mb-4 border-2 border-gray-200/50 backdrop-blur-sm">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold">{{ $route->departure_city }} → {{ $route->objective_city }}</h2>
                    </div>
                    <hr class="border-gray-300 p-2">
                    
                    <div class="flex justify-between items-center mb-4">
                        <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm shadow-sm">One Way</span>
                        <div class="flex items-center">
                            <span class="font-semibold">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $route->departure_date)->format('l, d F Y') }}</span>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 mb-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <img src="/api/placeholder/32/32" class="rounded-full">
                                <div>
                                    <div class="text-xl font-bold">{{ \Carbon\Carbon::createFromFormat('H:i:s', $route->departure_time)->format('H:i') }}</div>
                                    <div class="text-gray-600 text-center">{{ strtoupper(substr($route->departure_city, 0, 3)) }}</div>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                @php
                                    $departure = \Carbon\Carbon::createFromFormat('H:i:s', $route->departure_time);
                                    $arrival = \Carbon\Carbon::createFromFormat('H:i:s', $route->arrival_time);
                                    $duration = $departure->diff($arrival);
                                @endphp
                                <div class="text-sm text-gray-500">{{ $duration->h }}h {{ $duration->i }}m</div>
                                <div class="text-sm text-gray-500">Direct</div>
                            </div>

                            <div>
                                <div class="text-xl font-bold">{{ \Carbon\Carbon::createFromFormat('H:i:s', $route->arrival_time)->format('H:i') }}</div>
                                <div class="text-gray-600 text-center">{{ strtoupper(substr($route->objective_city, 0, 3)) }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                        <span class="text-gray-600">Total Payment</span>
                        <div class="flex items-center text-red-500 font-bold">
                            IDR {{ number_format($booking->total_payment, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-6 mt-12">
            <!-- Left Column - Booking Form -->
            <div class="lg:col-span-2">
                <h1 class="text-2xl font-bold text-gray-900 mb-4">Passenger Detail</h1>
                <form action="#" method="POST">
                    @csrf
                    <div id="passenger-container" class="grid grid-cols-1 md:grid-cols-2 gap-4"></div>
                    <div class="rounded-lg shadow-lg p-4 mb-4 border-2 border-gray-200/50 backdrop-blur-sm mt-8">
                        <div class="flex justify-between items-center mb-6">
                            <span class="text-gray-600 text-lg">Total Payment</span>
                            <div class="flex items-center text-red-500 font-bold text-xl">
                                IDR {{ number_format($booking->total_payment, 0, ',', '.') }}
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                     class="h-5 w-5 ml-1" 
                                     fill="none" 
                                     viewBox="0 0 24 24" 
                                     stroke="currentColor">
                                    <path stroke-linecap="round" 
                                          stroke-linejoin="round" 
                                          stroke-width="2" 
                                          d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        <div class="border-b border-gray-200 mb-6"></div>
                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-4 px-4 rounded-lg transition-colors duration-200">
                            Continue Payment
                        </button>
                    </div>
                </form>                
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    let passengers = @json($booking_passenger);
</script>
<script src="{!! asset('js/booking/booking-passenger.js') !!}?v={{ time() }}"></script>
@endpush