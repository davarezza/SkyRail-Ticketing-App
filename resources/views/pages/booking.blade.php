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
        background: linear-gradient(135deg, #4ade80, #22c55e);
    }
</style>
@endpush

@section('container') <br><br><br>
<div class="container mx-auto p-4 md:p-6">
    <!-- Search Section -->
    <div class="shadow-lg rounded-lg p-4 md:p-6 mb-6 bg-white">
        <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
            <div class="relative w-full md:flex-1">
                <input
                    type="text"
                    class="w-full p-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    placeholder="Kota Asal"
                    value="Jakarta, JKTC"
                />
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fas fa-map-marker-alt text-gray-400"></i>
                </span>
            </div>
            <button class="p-3 bg-gray-100 rounded-full hover:bg-gray-200 transition transform hover:scale-105">
                <i class="fas fa-exchange text-gray-600"></i>
            </button>
            <div class="relative w-full md:flex-1">
                <input
                    type="text"
                    class="w-full p-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    placeholder="Kota Tujuan"
                    value="Bandung, BDG"
                />
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fas fa-map-marker-alt text-gray-400"></i>
                </span>
            </div>
            <div class="relative w-full md:flex-1">
                <input
                    type="date"
                    class="w-full p-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    value="2025-02-03"
                />
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fas fa-calendar-alt text-gray-400"></i>
                </span>
            </div>
            <div class="relative w-full md:flex-1">
                <select class="w-full p-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white">
                    <option>Economy</option>
                </select>
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fas fa-couch text-gray-400 h-3 w-5"></i>
                </span>
            </div>
            <button class="w-full md:w-auto p-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition flex items-center justify-center transform hover:scale-105">
                <i class="fas fa-search h-5 w-5"></i>
            </button>
        </div>
    </div>
    
    <!-- Date List Section -->
    <div class="bg-white shadow-lg rounded-lg p-4 md:p-6 mb-6">
        <div class="relative">
            <div class="flex space-x-2 overflow-x-auto snap-x snap-mandatory scroll-smooth py-2 no-scrollbar">
                @foreach (range(0, 30) as $i)
                    <div class="p-4 border rounded-lg text-center min-w-[120px] bg-gray-100 hover:bg-gray-200 transition snap-center shadow-sm {{ $i == 0 ? 'active-date' : '' }}">
                        <p class="text-sm font-medium">{{ now()->setTimezone('Asia/Jakarta')->addDays($i)->format('d M') }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div> 
    
    <!-- Price Guarantee Section -->
    <div class="gradient-bg shadow-xl text-white p-4 rounded-lg mb-6 text-center font-semibold cursor-pointer" onclick="window.location.href='{{ route('booking.page') }}';">
        We're offering a <span class="font-bold">Special Promotional Discount</span> on some routes!
    </div>

    <!-- Flight Route Section -->
    @foreach ($booking as $book)
    <div class="bg-white shadow-lg rounded-lg p-4 md:p-6 mb-6 cursor-pointer transition-all duration-300 hover:shadow-xl hover:bg-gray-50" onclick="window.location.href='{{ route('booking.detail', $book->id) }}';">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('assets/img/transport_logo/' . $book->transport_logo) }}" alt="Batik Air" class="w-12 h-12 rounded-full">
                    <div>
                        <p class="font-semibold text-gray-800 text-lg pb-2">{{ $book->transport_name }}</p>
                        <div class="flex items-center space-x-2">
                            @foreach(explode(',', $book->class_facilities) as $class_facility)
                                <i class="{{ trim($class_facility) }} h-5 w-5 text-gray-500"></i>
                            @endforeach
                        </div>
                    </div>                    
                </div>
                <div class="flex flex-col items-end mt-4 md:mt-0">
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-800 font-bold text-2xl">IDR {{ number_format($book->price, 0, ',', '.') }}</span>                        
                        <span class="text-gray-500 text-sm">/pax</span>
                    </div>
                </div>
            </div>
        
            <div class="flex flex-col md:flex-row justify-between items-center mt-6">
                <div class="text-center">
                    <p class="text-2xl font-bold">{{ \Carbon\Carbon::createFromFormat('H:i:s', $book->departure_time)->format('H:i') }}</p>                    
                    <p class="text-sm text-gray-500">{{ strtoupper($book->departure_city) }}</p>
                </div>
                <div class="relative flex-1 mx-4 my-4 md:my-0">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center">
                        @php
                            $departure = \Carbon\Carbon::createFromFormat('H:i:s', $book->departure_time);
                            $arrival = \Carbon\Carbon::createFromFormat('H:i:s', $book->arrival_time);
                            $duration = $departure->diff($arrival);
                        @endphp
                        <span class="bg-white px-2 text-sm text-gray-500">
                            {{ $duration->h }}h {{ $duration->i }}m
                        </span>
                    </div>
                </div>                
                <div class="text-center">
                    <p class="text-2xl font-bold">{{ \Carbon\Carbon::createFromFormat('H:i:s', $book->arrival_time)->format('H:i') }}</p>
                    <p class="text-sm text-gray-500">{{ strtoupper($book->objective_city) }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

@push('scripts')
@endpush