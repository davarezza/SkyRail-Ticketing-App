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
        
    </div>
@endsection

@push('scripts')
<script>let passengers = @json($booking_passenger);</script>
@endpush