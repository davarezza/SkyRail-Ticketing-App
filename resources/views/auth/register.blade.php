@extends('layouts.auth')

@section('title')
    <title>{{ config('app.name') }} | Register</title>
@endsection

@section('content')
<div class="w-full lg:w-[45%] p-4 py-8">
    <div class="flex justify-center gap-2 mt-4">
        <a href="{{ route('login') }}" 
           class="font-medium px-6 py-1 rounded-full bg-white/20 text-white shadow-md hover:opacity-85 transition-opacity">
            Login
        </a>
        <a href="{{ route('register') }}" 
           class="font-medium px-6 py-1 rounded-full bg-[#21264D] text-white shadow-md hover:opacity-85 transition-opacity">
            Register
        </a>
    </div>

    <div class="flex flex-col items-center w-full px-4 md:px-[3vw] transition-all duration-300">
        <h2 class="my-4 text-white text-2xl font-semibold">Register</h2>
        
        <form action="{{ route('register.authenticate') }}" method="POST" class="w-full space-y-2">
            @csrf
            <div class="relative">
                <input 
                    type="text" 
                    placeholder="Full Name" 
                    name="name" 
                    id="name" 
                    class="w-full h-12 px-3 text-white bg-white/20 rounded-lg outline-none backdrop-blur-md shadow-md placeholder:text-white placeholder:text-sm"
                    required autocomplete="off">
                <i class="bx bx-user absolute right-3 top-1/2 -translate-y-1/2 text-white"></i>
            </div>
            @error('name')
                <p class="text-xs text-red-600">{{ $message }}</p>
            @enderror
        
            <div class="relative py-2">
                <input 
                    type="email" 
                    placeholder="Email" 
                    name="email" 
                    id="email" 
                    class="w-full h-12 px-3 text-white bg-white/20 rounded-lg outline-none backdrop-blur-md shadow-md placeholder:text-white placeholder:text-sm"
                    required autocomplete="off">
                <i class="bx bx-envelope absolute right-3 top-1/2 -translate-y-1/2 text-white"></i>
            </div>
            @error('email')
                <p class="text-xs text-red-600">{{ $message }}</p>
            @enderror
        
            <div class="relative">
                <input 
                    type="password" 
                    placeholder="Password" 
                    name="password" 
                    id="password" 
                    class="w-full h-12 px-3 text-white bg-white/20 rounded-lg outline-none backdrop-blur-md shadow-md placeholder:text-white placeholder:text-sm"
                    required autocomplete="off">
                <i class="bx bx-hide absolute right-3 top-1/2 -translate-y-1/2 text-white cursor-pointer" id="togglePassword"></i>
            </div><br>
            @error('email')
                <p class="text-xs text-red-600">{{ $password }}</p>
            @enderror
        
            <button 
                type="submit" 
                class="flex items-center justify-center gap-2 w-full h-12 px-3 text-white bg-[#21264D] rounded-lg shadow-md hover:gap-3 transition-all duration-300">
                <span>Register</span>
                <i class="bx bx-right-arrow-alt"></i>
            </button>
        </form>                
    </div>
</div>
@endsection