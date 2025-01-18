@extends('layouts.main')

@section('title')
    <title>Home | {{ config('app.name') }}</title>
@endsection

@section('container')
    <header class="max-w-screen-lg mx-auto py-20 px-4">
        <h1 class="text-center text-4xl leading-16 font-semibold text-text-dark">
            Find And Book<br />A Great Experience
        </h1>
        <img src="{{ asset('assets/img/header.jpg') }}" alt="header" class="w-full" />
    </header>

    @include('partials.booking')

    <section class="px-6 max-w-screen-lg mx-auto pt-8 travellers__container">
        <h2 class="text-3xl md:text-4xl font-semibold text-center section__header">Best Destination</h2>
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
