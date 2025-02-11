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
        <!-- Flight Header -->
        <div class="mb-4">
            <div class="flex items-center gap-2">
                <h1 class="text-xl font-semibold">Jakarta → Surabaya</h1>
            </div>
            <p class="text-gray-600">1 Dewasa</p>
        </div>

        <!-- Flight Card -->
        <div class="rounded-lg shadow-lg p-4 mb-4 border-2 border-gray-200/50 backdrop-blur-sm">
            <div class="flex items-center mb-2">
                <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm shadow-sm">Pergi</span>
            </div>

            <div class="mb-4">
                <div class="text-lg font-medium">20:00</div>
                <div class="text-gray-600 text-sm">Sel, 11 Feb 2025</div>
                <div class="text-gray-600">Soekarno Hatta - Terminal 2D Domestik</div>
            </div>

            <!-- Flight Details -->
            <div class="bg-white/80 border-2 border-gray-200/50 rounded-lg p-4 mb-4 shadow-md">
                <div class="flex items-center gap-3 mb-4">
                    <img src="/api/placeholder/32/32" alt="Batik Air" class="w-8 h-8 shadow-sm"/>
                    <div>
                        <div class="font-medium">Batik Air Indonesia</div>
                        <div class="text-gray-500 text-sm">ID-6578 • Ekonomi • 1j 35m</div>
                    </div>
                </div>
                <hr class="border-gray-300 my-2"/>

                <!-- Included Features -->
                <div class="space-y-3">
                    <h3 class="font-medium text-gray-800">Tiket Sudah Termasuk</h3>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Kabin: 7 kg</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Bagasi: 20 kg</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Gratis makanan</span>
                    </div>
                </div>

                <button class="text-blue-600 mt-4 text-sm font-bold hover:text-blue-700 transition-colors">Lihat fasilitas lain</button>
            </div>

            <div class="mb-4">
                <div class="text-lg font-medium">21:35</div>
                <div class="text-gray-600 text-sm">Sel, 11 Feb 2025</div>
                <div class="text-gray-600">Juanda</div>
            </div>
            <hr class="border-gray-300"/>
            <!-- Benefits Section -->
            <div class="mt-4">
                <h3 class="font-medium text-gray-800 mb-2">Benefit Gratis buat Kamu</h3>
                <p class="text-gray-600">Penerbangan Langsung</p>
                <button class="text-blue-600 mt-2 text-sm font-bold hover:text-blue-700 transition-colors">Lihat Detail</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush