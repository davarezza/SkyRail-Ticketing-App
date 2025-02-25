@extends('layouts.main')

@section('title')
    <title>Access Denied | {{ config('app.name') }}</title>
@endsection

@push('styles')
<style>
    @keyframes float {
        0% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-15px);
        }
        100% {
            transform: translateY(0px);
        }
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.03);
        }
        100% {
            transform: scale(1);
        }
    }

    @keyframes shake {
        0%, 100% {
            transform: translateX(0);
        }
        10%, 30%, 50%, 70%, 90% {
            transform: translateX(-5px);
        }
        20%, 40%, 60%, 80% {
            transform: translateX(5px);
        }
    }

    .animated-image {
        animation: float 3s ease-in-out infinite, pulse 4s ease-in-out infinite;
    }

    .animated-image:hover {
        animation: shake 0.8s ease-in-out;
    }

    @media (min-width: 768px) {
        .md\:w-96 {
            width: 24rem;
        }
        .md\:h-96 {
            height: 24rem;
        }
    }
</style>
@endpush

@section('container')
<div class="container mx-auto p-2 md:p-4">
    <div class="flex flex-col items-center justify-center min-h-[90vh] text-center">
        <div class="mb-0">
            <img src="{{ asset('assets/img/error/403.jpg') }}" alt="Access Denied" class="w-60 h-60 md:w-96 md:h-96 object-contain animated-image">
        </div>

        <h1 class="text-3xl md:text-4xl font-bold text-red-600 -mt-4 mb-1">403</h1>
        <h2 class="text-xl md:text-2xl font-semibold text-gray-800 mb-2">Access Denied</h2>
        <p class="text-base text-gray-600 mb-4 max-w-md">Sorry, you don't have permission to access this page.</p>

        <a href="{{ route('home') }}" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-300 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Home
        </a>
    </div>
</div>
@endsection
