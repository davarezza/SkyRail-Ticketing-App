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

@section('container')
<div class="container mx-auto p-6 py-24">
    <!-- Search Section -->
    <div class="shadow-lg rounded-lg p-6 mb-6 bg-white">
        <div class="flex items-center space-x-4">
            <div class="relative flex-1">
                <input
                    type="text"
                    class="w-full p-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    placeholder="Kota Asal"
                    value="Jakarta, JKTC"
                />
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </span>
            </div>
            <button class="p-3 bg-gray-100 rounded-full hover:bg-gray-200 transition transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                </svg>
            </button>
            <div class="relative flex-1">
                <input
                    type="text"
                    class="w-full p-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    placeholder="Kota Tujuan"
                    value="Bandung, BDG"
                />
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </span>
            </div>
            <div class="relative flex-1">
                <input
                    type="date"
                    class="w-full p-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    value="2025-02-03"
                />
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </span>
            </div>
            <div class="relative flex-1">
                <select class="w-full p-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white">
                    <option>1 Penumpang, Ekonomi</option>
                </select>
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </span>
            </div>
            <button class="p-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition flex items-center justify-center transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
        </div>
    </div>
    
    <!-- Date List Section -->
    <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
        <div class="relative">
            <div class="flex space-x-2 overflow-x-auto snap-x snap-mandatory scroll-smooth py-2 no-scrollbar">
                @foreach (range(0, 30) as $i)
                    <div class="p-4 border rounded-lg text-center min-w-[120px] bg-gray-100 hover:bg-gray-200 transition snap-center shadow-sm {{ $i == 0 ? 'active-date' : '' }}">
                        <p class="text-sm font-medium">{{ now()->addDays($i)->format('d M') }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div> 
    
    <!-- Price Guarantee Section -->
    <div class="gradient-bg shadow-xl text-white p-4 rounded-lg mb-6 text-center font-semibold">
        We're offering a <span class="font-bold">Special Promotional Discount</span> on some routes!
    </div>

    <!-- Flight Route Section -->
    <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="/path-to-batik-logo.png" alt="Batik Air" class="w-12 h-12 rounded-full">
                <div>
                    <p class="font-semibold text-gray-800 text-lg">Batik Air Indonesia</p>
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="flex flex-col items-end">
                <div class="flex items-center space-x-2">
                    <span class="text-gray-800 font-bold text-2xl">IDR 952.574</span>
                    <span class="text-gray-500 text-sm">/pax</span>
                </div>
            </div>
        </div>
    
        <div class="flex justify-between items-center mt-6">
            <div class="text-center">
                <p class="text-2xl font-bold">15:10</p>
                <p class="text-sm text-gray-500">CGK</p>
            </div>
            <div class="relative flex-1 mx-4">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="bg-white px-2 text-sm text-gray-500">1j 30m</span>
                </div>
            </div>
            <div class="text-center">
                <p class="text-2xl font-bold">16:40</p>
                <p class="text-sm text-gray-500">SUB</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush