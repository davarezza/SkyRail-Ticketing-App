@extends('layouts.auth')

@section('title')
    <title>{{ config('app.name') }} | Forgot Password</title>
@endsection

@section('content')
<div class="w-full lg:w-[45%] p-4 py-8">
    <div class="flex flex-col items-center w-full px-4 md:px-[3vw] transition-all duration-300">
        <h2 class="my-6 text-white text-2xl font-semibold">Forgot Password?</h2>
        <h4 class="mb-4 mt-12 text-gray-200 text-center text-2xl font-semibold">Enter your email to reset your password.?</h4>
        
        <form action="{{ route('password.email') }}" method="POST" class="w-full space-y-2">
            @csrf
            <div class="relative py-2">
                <input 
                    type="email" 
                    placeholder="Email" 
                    name="email" 
                    id="email" value="{{ old('email') }}"
                    class="w-full h-12 px-3 text-white bg-white/20 rounded-lg outline-none backdrop-blur-md shadow-md placeholder:text-white placeholder:text-sm"
                    autocomplete="off">
                <i class="bx bx-envelope absolute right-3 top-1/2 -translate-y-1/2 text-white"></i>
            </div>
            @error('email')
                <p class="text-xs text-red-600">{{ $message }}</p>
            @enderror
        
            <div class="flex justify-between gap-4">
                <button 
                    type="submit" 
                    class="flex items-center justify-center gap-2 w-full h-12 px-3 text-white bg-[#21264D] rounded-lg shadow-md hover:gap-3 transition-all duration-300">
                    <span>Submit</span>
                    <i class="bx bx-right-arrow-alt"></i>
                </button>
                <a href="{{ route('login') }}" 
                    class="flex items-center justify-center gap-2 w-full h-12 px-3 text-black bg-white rounded-lg shadow-md hover:gap-3 transition-all duration-300">
                    <span>Cancel</span>
                </a>
            </div>
        </form>       
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('status'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session("status") }}',
            confirmButtonText: 'OK'
        });
    @endif

    @if($errors->has('email'))
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: '{{ $errors->first("email") }}',
            confirmButtonText: 'Try Again'
        });
    @endif
</script>
@endsection