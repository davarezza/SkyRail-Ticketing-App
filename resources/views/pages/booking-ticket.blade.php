@extends('layouts.main')

@section('title')
    <title>Booking Ticket | {{ config('app.name') }}</title>
@endsection

@push('styles')
<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
</style>
@endpush

@section('container')
<div class="min-h-[80vh] pt-16">
    <div class="max-w-5xl mx-auto p-4 md:p-6">
        <!-- Success Card -->
        <div class="bg-white rounded-2xl shadow-lg border-2 border-gray-200/50 backdrop-blur-sm p-8 mb-8 animate-slide-up">
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
                                <span class="text-gray-600">Departure City</span>
                                <span class="font-medium text-gray-800">{{ $booking->departure_city }}</span>
                            </div>
                            <div class="flex justify-between border-t border-blue-200/60 pt-3">
                                <span class="text-gray-600">Booker Name</span>
                                <span class="font-medium text-gray-800">{{ $booking->booker_name }}</span>
                            </div>
                            <div class="flex justify-between border-t border-blue-200/60 pt-3">
                                <span class="text-gray-600">Booking Date</span>
                                <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d F Y') }}</span>
                            </div>
                        </div>
                        <div class="space-y-3 md:border-l md:border-blue-200/60 md:pl-6">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Payment Status</span>
                                <span class="font-medium {{ $booking->status == 'paid' ? 'text-green-600' : 'text-blue-600' }}">{{ ucwords($booking->status) }}</span>
                            </div>
                            <div class="flex justify-between border-t border-blue-200/60 pt-3">
                                <span class="text-gray-600">Arrival City</span>
                                <span class="font-medium text-gray-800">{{ $booking->objective_city }}</span>
                            </div>
                            <div class="flex justify-between border-t border-blue-200/60 pt-3">
                                <span class="text-gray-600">Booker Telephone</span>
                                <span class="font-medium text-gray-800">{{ $booking->booker_telephone }}</span>
                            </div>
                            <div class="flex justify-between border-t border-blue-200/60 pt-3">
                                <span class="text-gray-600">Total Amount</span>
                                <span class="font-medium text-gray-800">IDR {{ number_format($booking->total_payment ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-10">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">E-Ticket</h3>

                @foreach($booking_passenger as $index => $passenger)
                <div class="relative bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-lg mb-6">
                    <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-blue-500 to-cyan-400"></div>

                    <div class="p-6">
                        <div class="flex items-center justify-between mb-8">
                            <div class="space-y-1">
                                <div class="text-4xl font-bold text-gray-800">{{ strtoupper(substr($booking->departure_city, 0, 3)) }}</div>
                                <div class="text-sm text-gray-500">{{ $booking->departure_city }}</div>
                            </div>

                            <div class="flex items-center space-x-4">
                                <div class="w-24 h-[2px] bg-gray-300"></div>
                                <i class="fas fa-plane text-blue-500 transform rotate-90 h-6 w-6"></i>
                                <div class="w-24 h-[2px] bg-gray-300"></div>
                            </div>

                            <div class="space-y-1 text-right">
                                <div class="text-4xl font-bold text-gray-800">{{ strtoupper(substr($booking->objective_city, 0, 3)) }}</div>
                                <div class="text-sm text-gray-500">{{ $booking->objective_city }}</div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                            <div>
                                <div class="text-sm text-gray-500">Passenger</div>
                                <div class="font-semibold text-gray-800">{{ $passenger->name }}</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">Flight Date</div>
                                <div class="font-semibold text-gray-800">{{ date('d M Y', strtotime($booking->departure_date)) }}</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">Departure</div>
                                <div class="font-semibold text-gray-800">{{ date('H:i', strtotime($route->departure_time)) }}</div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">Arrival</div>
                                <div class="font-semibold text-gray-800">{{ date('H:i', strtotime($route->arrival_time)) }}</div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-6 border-t border-dashed border-gray-200">
                            <div class="space-y-2">
                                <div class="text-sm text-gray-500">Booking Code</div>
                                <div class="text-xl font-bold text-gray-800">{{ $booking->code }}</div>
                                <div class="text-xs font-semibold text-gray-500">Seat {{ $passenger->seat_code }}</div>
                            </div>

                            <div class="w-24 h-24 bg-gray-100 rounded-lg flex items-center justify-center">
                                {!! QrCode::size(80)->generate($booking->code) !!}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="flex flex-col sm:flex-row justify-center gap-4 mt-10 pt-6 border-t border-gray-100">
                <a href="{{ route('dashboard-user.index') }}" class="inline-flex items-center justify-center px-8 py-3 rounded-xl text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200 font-medium">
                    <i class="fas fa-home mr-2"></i>
                    Go to Dashboard
                </a>
                <a href="{{ route('booking.download-ticket', $booking->id) }}" class="inline-flex items-center justify-center px-8 py-3 rounded-xl text-blue-600 bg-blue-50 hover:bg-blue-100 transition-colors duration-200 font-medium">
                    <i class="fas fa-download mr-2"></i>
                    Download All E-Tickets
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
