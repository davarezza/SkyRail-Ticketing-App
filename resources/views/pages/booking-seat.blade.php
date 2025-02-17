@extends('layouts.main')

@section('title')
    <title>Booking | {{ config('app.name') }}</title>
@endsection

@push('styles')
<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
</style>
@endpush

@section('container')
<br><br><br>
<div class="max-w-6xl mx-auto p-4 md:p-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
        <div class="bg-white rounded-lg border-2 border-gray-200/50 backdrop-blur-sm shadow-lg">
            <div class="p-6 border-b">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-plane-departure text-blue-500 h-5 w-5"></i>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">{{ $booking->code }}</h2>
                            <p class="text-gray-500">{{ $route->class_name }} Class</p>
                        </div>
                    </div>
                    <span class="px-4 py-1 bg-blue-50 text-blue-600 rounded-full text-sm font-medium">Direct Flight</span>
                </div>
            </div>
        
            <div class="p-6 border-b">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <p class="text-gray-500 text-sm">From</p>
                        <h3 class="text-xl font-bold text-gray-800">{{ strtoupper(substr($route->departure_city, 0, 3)) }}</h3>
                        <p class="text-gray-600">{{ $route->departure_city }}</p>
                        <p class="text-gray-500 text-sm mt-1">{{ $route->departure_airport }}</p>
                    </div>
                    
                    <div class="flex-1 flex flex-col items-center">
                        @php
                            $departure = \Carbon\Carbon::createFromFormat('H:i:s', $route->departure_time);
                            $arrival = \Carbon\Carbon::createFromFormat('H:i:s', $route->arrival_time);
                            $duration = $departure->diff($arrival);
                        @endphp
                        <p class="text-sm text-gray-500">{{ $duration->h }}h {{ $duration->i }}m</p>
                        <div class="w-full flex items-center gap-1 my-2">
                            <div class="h-[2px] flex-1 bg-gray-300"></div>
                            <i class="fas fa-plane text-blue-500"></i>
                            <div class="h-[2px] flex-1 bg-gray-300"></div>
                        </div>
                        <p class="text-sm text-gray-500">Direct</p>
                    </div>
        
                    <div class="flex-1 text-right">
                        <p class="text-gray-500 text-sm">To</p>
                        <h3 class="text-xl font-bold text-gray-800">{{ strtoupper(substr($route->objective_city, 0, 3)) }}</h3>
                        <p class="text-gray-600">{{ $route->objective_city }}</p>
                        <p class="text-gray-500 text-sm mt-1">{{ $route->objective_airport }}</p>
                    </div>
                </div>
            </div>
        
            <div class="p-6 border-b">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-calendar-alt text-gray-400"></i>
                            <span class="text-gray-600 font-medium">Departure Date</span>
                        </div>
                        <p class="text-gray-800 font-semibold">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $route->departure_date)->format('d F Y') }}</p>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <i class="fas fa-clock text-gray-400"></i>
                            <span class="text-gray-600 font-medium">Time</span>
                        </div>
                        <p class="text-gray-800 font-semibold">{{ \Carbon\Carbon::createFromFormat('H:i:s', $route->departure_time)->format('H:i') }} → {{ \Carbon\Carbon::createFromFormat('H:i:s', $route->arrival_time)->format('H:i') }} WIB</p>
                    </div>
                </div>
            </div>
        
            <div class="p-6 border-b" x-data="{ isOpen: false }">
                <button @click="isOpen = !isOpen" class="flex items-center gap-2 mb-2 w-full">
                    <i class="fas fa-user text-gray-400" :class="{ 'text-gray-800': isOpen }" x-transition:enter="transition ease-out duration-600" x-transition:enter-start="transform opacity-0 scale-90" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-600" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-90"></i>
                    <span class="text-gray-600 font-medium">Passenger Details</span>
                </button>
                <div class="mt-3 space-y-3" x-show="isOpen" x-transition:enter="transition ease-out duration-600" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-600" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                    @foreach($booking_passenger as $passenger)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-blue-500 text-sm"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">{{ $passenger->name }}</p>
                                <p class="text-sm text-gray-500">Passenger {{ $loop->iteration }}</p>
                            </div>
                        </div>
                        <div class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-sm text-capitalize">
                            {{ ucfirst($passenger->type) }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        
            <div id="selectedSeatDisplay" class="hidden p-6">
                <div class="bg-blue-50 p-4 rounded-lg">
                    <div class="flex items-center gap-3 mb-2">
                        <i class="fas fa-chair text-blue-500"></i>
                        <span class="font-medium text-blue-800">Selected Seat</span>
                    </div>
                    <div class="text-3xl font-bold text-blue-600" id="seatNumber">-</div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border-2 border-gray-200/50 backdrop-blur-sm shadow-lg p-6">
            <h2 class="text-xl font-semibold mb-6 text-center">Select Your Seat</h2>
        
            <div class="flex flex-wrap justify-center mb-6 gap-4 text-sm">
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 border-2 border-gray-200 rounded"></div>
                    <span>Available</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-blue-500 rounded"></div>
                    <span>Selected</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-gray-200 rounded"></div>
                    <span>Unavailable</span>
                </div>
            </div>
        
            <div class="flex flex-col items-center space-y-4">
                @php
                    $totalSeats = $transport->total_seat;
                    $rows = range('A', chr(ord('A') + ceil($totalSeats / 6) - 1));
                    $columns = range(1, 6);
                    $unavailableSeats = $booking_passenger->pluck('seat_number')->toArray();
                @endphp
        
                @foreach($rows as $row)
                    <div class="flex gap-2 sm:gap-4 justify-center flex-wrap">
                        @foreach($columns as $col)
                            @php
                                $seatId = $row . $col;
                                $isUnavailable = in_array($seatId, $unavailableSeats);
                                $seatNumber = (ord($row) - 65) * 6 + $col;
                            @endphp
        
                            @if($seatNumber <= $totalSeats)
                                <button 
                                    type="button"
                                    data-seat="{{ $seatId }}"
                                    class="seat-btn w-10 h-10 sm:w-12 sm:h-12 rounded-lg flex items-center justify-center text-xs sm:text-sm font-medium
                                        @if($isUnavailable)
                                            bg-gray-200 cursor-not-allowed
                                        @else border-2 border-gray-200 hover:border-blue-500 transition-colors duration-200
                                        @endif"
                                    @if($isUnavailable) disabled @endif
                                >
                                    {{ $seatId }}
                                </button>
        
                                @if($col == 3)
                                    <div class="w-4 sm:w-8"></div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>       
    </div>
</div>
@endsection

@push('scripts')
<script src="{!! asset('js/booking/booking-seat.js') !!}?v={{ time() }}"></script>
<script>
    let passengers = @json($booking_passenger);
    let seatPassenger = {{ count($booking_passenger) }};
</script>
@endpush