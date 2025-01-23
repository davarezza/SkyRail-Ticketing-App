@extends('layouts.main')

@section('title')
    <title>Home | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@push('styles')
<style>
    #toast-container {
        top: 1rem;
        opacity: 1;
    }

    .multiple-text {
        display: inline-block; 
        line-height: normal;
        vertical-align: middle; 
        font-size: inherit;
    }
  </style>
@endpush

@section('container')
    <header class="max-w-screen-lg mx-auto py-20 px-4">
        <h1 class="text-center text-4xl sm:text-3xl leading-18 font-semibold text-text-dark">
            Discover and Book<br /><span class="multiple-text"></span>
        </h1>
        <img src="{{ asset('assets/img/header.jpg') }}" alt="header" class="w-full" />
    </header>

    @include('partials.booking')

    <section class="px-6 max-w-screen-lg mx-auto pt-8">
        <h2 class="text-3xl md:text-4xl font-semibold text-center mb-8">Best Destination</h2>
        @include('partials.destination-card')
    </section>

    <section class="bg-extra-light py-12 memories my-8">
        <div class="max-w-screen-lg mx-auto px-6 memories__container">
            <div class="flex flex-col md:flex-row items-center justify-between gap-8 memories__header">
                <h2 class="text-3xl md:text-4xl lg:text-5xl leading-tight max-w-xl font-semibold section__header">
                    Travel to make memories all around the world
                </h2>
                <button
                    class="px-6 md:px-8 py-2 md:py-3 text-sm md:text-base font-medium text-text-dark border border-text-light rounded-full shadow-md hover:bg-text-light hover:text-white view__all">
                    View All
                </button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 mt-16 memories__grid">
                <div class="p-8 text-center bg-white rounded-[50px] shadow-lg memories__card">
                    <span class="inline-block p-6 mb-8 text-4xl text-white bg-primary rounded-full">
                        <i class="ri-calendar-2-line"></i>
                    </span>
                    <h4 class="text-xl font-semibold text-text-dark mb-4">Book & relax</h4>
                    <p class="text-text-light leading-relaxed">
                        With "Book and Relax," you can sit back, unwind, and enjoy the journey while we take care of
                        everything else.
                    </p>
                </div>
                <div class="p-8 text-center bg-white rounded-[50px] shadow-lg memories__card">
                    <span class="inline-block p-6 mb-8 text-4xl text-white bg-orange-400 rounded-full">
                        <i class="ri-shield-check-line"></i>
                    </span>
                    <h4 class="text-xl font-semibold text-text-dark mb-4">Smart Checklist</h4>
                    <p class="text-text-light leading-relaxed">
                        Introducing Smart Checklist with us, the innovative solution revolutionizing the way you travel with
                        our airline.
                    </p>
                </div>
                <div class="p-8 text-center bg-white rounded-[50px] shadow-lg memories__card">
                    <span class="inline-block p-6 mb-8 text-4xl text-white bg-yellow-300 rounded-full">
                        <i class="ri-bookmark-2-line"></i>
                    </span>
                    <h4 class="text-xl font-semibold text-text-dark mb-4">Save More</h4>
                    <p class="text-text-light leading-relaxed">
                        From discounted ticket prices to exclusive promotions and deals, we prioritize affordability without
                        compromising on quality.
                    </p>
                </div>
            </div>
        </div>
    </section>

    @include('partials.card')

    @include('partials.footer')
@endsection

@push('scripts')
    <script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>
    <script>
    const typed = new Typed('.multiple-text', {
        strings: ['Your Next Adventure Today', 'Ultimate Travel Experience', 'Unique Exploration Today'],
        typeSpeed: 80,
        backSpeed: 80,
        backDelay: 80,
        loop: true
        });
    </script>
@endpush