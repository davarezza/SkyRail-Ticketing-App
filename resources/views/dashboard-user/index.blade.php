@extends('layouts.main')

@section('title')
    <title>Home | {{ config('app.name') }}</title>
@endsection

@push('styles')
<style>
    #toast-container {
        top: 1rem;
        opacity: 1;
    }
</style>
@endpush

@section('container')
    <section class="px-6 max-w-screen-lg mx-auto pt-24">
        <div class="flex items-center gap-2 mb-8">
            <h1 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h1>
            <i class="fa-solid fa-circle-check text-blue-500 text-xl"></i>
        </div>

        <div class="grid md:grid-cols-4 gap-6">
            @include('partials.sidebar-user')
            <div class="md:col-span-3">
                <div class="bg-white rounded-lg shadow-lg border-2 border-gray-200/50 backdrop-blur-sm p-6">
                    <div class="flex items-center gap-2 mb-6">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Blibli Tiket" class="h-12 rounded-full">
                        <h2 class="text-xl font-bold">Account Center</h2>
                    </div>

                    <p class="text-gray-600 mb-8">
                        To access your profile details and categories below, simply log in to your <span class="font-medium text-gray-800">Skyflight Account Center</span>.
                    </p>

                    <!-- Profile Card -->
                    <div class="bg-blue-50 p-6 rounded-lg">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center">
                                <span class="text-2xl text-white">😃</span>
                            </div>
                            <div class="space-y-1">
                                <h3 class="text-xl font-semibold">{{ $user->name }}</h3>
                                <p class="text-gray-600">{{ $user->telephone }}</p>
                                <p class="text-gray-600">{{ $user->email }}</p>
                            </div>
                        </div>
                        <a href="{{ route('management.profile.index') }}" class="text-blue-600 font-medium hover:text-blue-700">To Account Center</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush