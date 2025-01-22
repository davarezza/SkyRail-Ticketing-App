@extends('layouts.auth')

@section('title')
    <title>{{ config('app.name') }} | Reset Password</title>
@endsection

@section('content')
<div class="w-full lg:w-[45%] p-4 py-8">
    <div class="flex flex-col items-center w-full px-4 md:px-[3vw] transition-all duration-300">
        <h2 class="mb-2  text-white text-2xl font-semibold">Reset Password</h2>
        <h4 class="mb-2 text-gray-200 text-center text-2xl font-semibold">Enter your password below.</h4>
        
        <form action="{{ route('password.update') }}" method="POST" class="w-full space-y-2">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="relative py-2">
                <input 
                    type="email" 
                    name="email" 
                    value="{{ request('email', old('email')) }}" 
                    placeholder="Email"
                    class="w-full h-12 px-3 text-white bg-gray-600 rounded-lg"
                    autocomplete="off" readonly required>
                <i class="bx bx-envelope absolute right-3 top-1/2 -translate-y-1/2 text-white"></i>
            </div>

            <div class="relative py-2">
                <input 
                    type="password" 
                    placeholder="New Password" 
                    name="password" 
                    id="password" 
                    class="w-full h-12 px-3 text-white bg-white/20 rounded-lg outline-none backdrop-blur-md shadow-md placeholder:text-white placeholder:text-sm"
                    autocomplete="off" required>
                <i class="bx bx-hide absolute right-3 top-1/2 -translate-y-1/2 text-white cursor-pointer" 
                    id="togglePassword"></i>
            </div>

            <div class="relative py-2">
                <input 
                    type="password" 
                    placeholder="Confirm Password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    class="w-full h-12 px-3 text-white bg-white/20 rounded-lg outline-none backdrop-blur-md shadow-md placeholder:text-white placeholder:text-sm"
                    autocomplete="off" required>
                <i class="bx bx-hide absolute right-3 top-1/2 -translate-y-1/2 text-white cursor-pointer" 
                    id="togglePasswordConfirmation"></i>
            </div>

            <div class="flex justify-between gap-4">
                <button 
                    type="submit" 
                    class="flex items-center justify-center gap-2 w-full h-12 px-3 text-white bg-[#21264D] rounded-lg shadow-md hover:gap-3 transition-all duration-300">
                    <span>Reset</span>
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

<!-- SweetAlert2 Library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if($errors->has('email'))
        Swal.fire({
            icon: 'error',
            title: 'Invalid Email!',
            text: '{{ $errors->first("email") }}',
            confirmButtonText: 'Try Again'
        });
    @endif

    @if($errors->has('password'))
        Swal.fire({
            icon: 'error',
            title: 'Password Error!',
            text: '{{ $errors->first("password") }}',
            confirmButtonText: 'Try Again'
        });
    @endif

    @if($errors->has('token'))
        Swal.fire({
            icon: 'error',
            title: 'Token Expired!',
            text: '{{ $errors->first("token") }}',
            confirmButtonText: 'Try Again'
        });
    @endif
</script>
@endsection