@extends('layouts.main')

@section('title')
    <title>Booking Successfully | {{ config('app.name') }}</title>
@endsection

@push('styles')
<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    @keyframes slideUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .animate-slide-up {
        animation: slideUp 0.5s ease-out forwards;
    }
</style>
@endpush

@section('container')
<div class="min-h-[80vh] pt-16">
    <div class="max-w-5xl mx-auto p-4 md:p-6">
        <!-- Success Card -->
        <div class="bg-white rounded-2xl shadow-lg border-2 border-gray-200/50 backdrop-blur-sm p-8 mb-8 animate-slide-up">
            <!-- Success Icon -->
            <div class="flex justify-center mb-6">
                <div class="w-24 h-24 rounded-full bg-blue-50 flex items-center justify-center">
                    <svg class="w-14 h-14 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>

            <!-- Success Message -->
            <div class="text-center mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">Payment Successful!</h1>
                <p class="text-lg text-gray-600">Your booking has been confirmed and processed successfully.</p>
            </div>

            <!-- Booking Summary -->
            <div class="mb-10">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Booking Summary</h3>
                <div class="bg-blue-50 p-6 rounded-xl border border-blue-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Booking Code</span>
                                <span class="font-medium text-gray-800">{{ $booking->code ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between border-t border-blue-200/60 pt-3">
                                <span class="text-gray-600">Payment Date</span>
                                <span class="font-medium text-gray-800">{{ date('d M Y') }}</span>
                            </div>
                        </div>
                        <div class="space-y-3 md:border-l md:border-blue-200/60 md:pl-6">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Payment Status</span>
                                <span class="font-medium text-green-600">Paid</span>
                            </div>
                            <div class="flex justify-between border-t border-blue-200/60 pt-3">
                                <span class="text-gray-600">Total Amount</span>
                                <span class="font-medium text-gray-800">Rp {{ number_format($booking->total_payment ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-center gap-4 mt-10 pt-6 border-t border-gray-100">
                <a href="{{ route('dashboard-user.index') }}" class="inline-flex items-center justify-center px-8 py-3 rounded-xl text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200 font-medium">
                    <i class="fas fa-home mr-2"></i>
                    Go to Dashboard
                </a>
                <a href="{{ route('booking.check-ticket', $booking->id) }}" class="inline-flex items-center justify-center px-8 py-3 rounded-xl text-blue-600 bg-blue-50 hover:bg-blue-100 transition-colors duration-200 font-medium">
                    <i class="fas fa-ticket-alt mr-2"></i>
                    View E-Ticket
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let passengers = @json($booking_passenger);
</script>
@endpush
