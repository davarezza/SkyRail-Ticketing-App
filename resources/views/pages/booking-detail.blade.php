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

    .timeline-dot {
        width: 12px;
        height: 12px;
        background-color: #e5e7eb;
        border: 2px solid #9ca3af;
        border-radius: 50%;
        position: relative;
    }

    .timeline-line {
        width: 2px;
        background-color: #e5e7eb;
        position: absolute;
        left: 5px;
        top: 12px;
        bottom: 12px;
    }

    .timeline-dot:last-child {
        margin-top: 26.8rem;
    }

    .timeline-line::after {
        content: "";
        width: 2px;
        background-color: #e5e7eb;
        position: absolute;
        left: 0;
        bottom: 12px;
        height: calc(100% - 24px);
    }
</style>
@endpush

@section('container')
<br><br><br>
    <div class="max-w-6xl mx-auto p-4 md:p-6">
        <div class="mb-4">
            <div class="flex items-center gap-2">
                <h1 class="text-xl font-semibold">{{ $booking->departure_city }} → {{ $booking->objective_city }}</h1>
            </div>
            <p class="text-gray-600">1 Dewasa</p>
        </div>

        <div class="rounded-lg shadow-lg p-4 mb-4 border-2 border-gray-200/50 backdrop-blur-sm">
            <div class="flex items-center mb-2">
                <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm shadow-sm">One Way</span>
            </div>

            <div class="flex mt-4">
                <div class="relative w-3 mr-4">
                    <div class="timeline-dot"></div>
                    <div class="timeline-line"></div>
                    <div class="timeline-dot"></div>
                </div>

                <div class="flex-1">
                    <div class="mb-4">
                        <div class="text-lg font-medium">{{ \Carbon\Carbon::createFromFormat('H:i:s', $booking->departure_time)->format('H:i') }}</div>
                        <div class="text-gray-600 text-sm">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $booking->departure_date)->format('l, d F Y') }}</div>
                        <div class="text-gray-600">{{ $booking->departure_airport }}</div>
                    </div>

                    <div class="bg-white/80 border-2 border-gray-200/50 rounded-lg p-4 mb-4 shadow-md">
                        <div class="flex items-center gap-3 mb-4">
                            <img src="{{ asset('assets/img/transport_logo/' . $booking->transport_logo) }}" class="w-10 h-10 shadow-sm rounded-full"/>
                            <div>
                                <div class="font-medium">{{ $booking->transport_name }}</div>
                                @php
                                    $departure = \Carbon\Carbon::createFromFormat('H:i:s', $booking->departure_time);
                                    $arrival = \Carbon\Carbon::createFromFormat('H:i:s', $booking->arrival_time);
                                    $duration = $departure->diff($arrival);
                                @endphp
                                <div class="text-gray-500 text-sm">{{ $booking->transport_code }} • {{ $booking->class_name }} • {{ $duration->h }}h {{ $duration->i }}m</div>
                            </div>
                        </div>
                        <hr class="border-gray-300 my-2"/>

                        <div class="space-y-3">
                            <h3 class="font-medium text-gray-800">Ticket Includes</h3>
                            @php
                                $facilities = $booking->class_facilities_detail;
                                $facilitiesArray = explode(',', $facilities);
                                $facilitiesLimited = array_slice($facilitiesArray, 0, 3);
                            @endphp

                            @foreach($facilitiesLimited as $facility)
                            <div class="flex items-center gap-2">
                                <i class="fas fa-check-circle text-green-400 mr-2"></i>
                                <span>{{ trim($facility) }}</span>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" class="text-blue-600 mt-4 text-sm font-bold hover:text-blue-700 transition-colors" onclick="detailFacilities({{ $booking->id }})">See other facilities</button>
                    </div>

                    <div class="mb-4">
                        <div class="text-lg font-medium">{{ \Carbon\Carbon::createFromFormat('H:i:s', $booking->arrival_time)->format('H:i') }}</div>
                        <div class="text-gray-600 text-sm">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $booking->departure_date)->format('l, d F Y') }}</div>
                        <div class="text-gray-600">{{ $booking->objective_airport }}</div>
                    </div>
                </div>
            </div>

            <hr class="border-gray-300"/>
            <div class="mt-4">
                <h3 class="font-medium text-gray-800 mb-2">Free Benefits for You</h3>
                <p class="text-gray-600 mb-2">Direct Flight</p>
                <p class="text-gray-600">Choose Your Own Seat</p>
            </div>
        </div>

        <div class="my-4">
            <div class="flex items-center gap-2">
                <h1 class="text-xl font-semibold">Ticket Summary</h1>
            </div>
        </div>

        <div class="rounded-lg shadow-lg p-4 mb-4 border-2 border-gray-200/50 backdrop-blur-sm">
            <!-- Ticket Class -->
            <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ $booking->class_name }}</h2>
            
            <!-- Features Box -->
            <div class="bg-blue-50/80 rounded-lg p-4 mb-4">
                <div class="flex items-center gap-2 mb-3">
                    <i class="fas fa-calendar-check text-green-600 mr-2"></i>
                    <span class="text-gray-700">Can check-in earlier</span>
                </div>
                
                <div class="flex items-center gap-2 mb-3">
                    <i class="fas fa-tag text-green-600 mr-2"></i>
                    <span class="text-gray-700">Free seat selection</span>
                </div>
                
                <button class="text-blue-600 text-sm font-bold hover:text-blue-700 transition-colors">
                    View Details
                </button>
            </div>
            
            <!-- Pricing Section -->
            <div class="space-y-2">
                <div class="text-gray-600">IDR {{ number_format($booking->price, 0, ',', '.') }}/pax</div>
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center gap-1">
                            <span class="text-gray-600">Total</span>
                            <span class="text-xl font-bold text-red-500">IDR 3.461.594</span>
                        </div>
                        <div class="text-sm text-gray-500">Including Tax</div>
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.booking-modal')
@endsection

@push('scripts')
<script src="{!! asset('js/booking/booking.js') !!}?v={{ time() }}"></script>
@endpush