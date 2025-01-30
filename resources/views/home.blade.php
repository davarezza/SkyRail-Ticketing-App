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

    <section class="py-8 px-8 relative xl:mr-0 lg:mr-5 mr-0">
        @include('partials.home-about')
    </section><br><br>

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