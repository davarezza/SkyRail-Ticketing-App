@extends('layouts.auth')

@section('title')
    <title>{{ config('app.name') }} | Login</title>
@endsection

@section('content')
<div class="w-full lg:w-[45%] p-4 py-8">
    <div class="flex justify-center gap-2 mt-4">
        <a href="{{ route('login') }}" 
           class="font-medium px-6 py-1 rounded-full bg-[#21264D] text-white shadow-md hover:opacity-85 transition-opacity">
            Login
        </a>
        <a href="{{ route('register') }}" 
           class="font-medium px-6 py-1 rounded-full bg-white/20 text-white shadow-md hover:opacity-85 transition-opacity">
            Register
        </a>
    </div>

    <div class="flex flex-col items-center w-full px-4 md:px-[3vw] transition-all duration-300">
        <h2 class="my-4 text-white text-2xl font-semibold">Login</h2>
        
        <form action="{{ route('login') }}" method="POST" class="w-full space-y-2">
            @csrf
            <div class="relative pb-2">
                <input 
                    type="email" 
                    placeholder="Email" 
                    name="email" 
                    id="email" value="{{ old('email') }}"
                    class="w-full h-12 px-3 text-white bg-white/20 rounded-lg outline-none backdrop-blur-md shadow-md placeholder:text-white placeholder:text-sm"
                    autocomplete="off">
                <i class="bx bx-user absolute right-3 top-1/2 -translate-y-1/2 text-white"></i>
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
                    autocomplete="off">
                <i class="bx bx-hide absolute right-3 top-1/2 -translate-y-1/2 text-white cursor-pointer" 
                    id="togglePassword"></i>
                </div>
                @error('password')
                    <p class="text-xs text-red-600">{{ $message }}</p>
                @enderror
        
            <div class="flex justify-end p-2">
                <a href="#" class="text-white text-xs hover:underline">Forgot Password?</a>
            </div>
        
            <button 
                type="submit" 
                class="flex items-center justify-center gap-2 w-full h-12 px-3 text-white bg-[#21264D] rounded-lg shadow-md hover:gap-3 transition-all duration-300">
                <span>Login</span>
                <i class="bx bx-right-arrow-alt"></i>
            </button>
        </form>                

        <div class="flex items-center gap-2 px-4 py-2 mt-4 border rounded-full cursor-pointer shadow-md bg-black/20 hover:bg-black/30 hover:scale-105 transition-all duration-200">
            <div class="flex items-center justify-center h-8 w-8 text-white bg-black/40 rounded-full">
                <i class="bx bxl-google"></i>
            </div>
            <span class="text-white font-medium">Google</span>
        </div>                
    </div>
</div>
@endsection