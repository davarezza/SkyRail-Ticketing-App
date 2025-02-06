@extends('layouts.main')

@section('title')
    <title>Profile | {{ config('app.name') }}</title>
@endsection

@php
    $dummyUser = [
        'name' => 'John Doe',
        'gender' => 'male',
        'phone' => '+62 812-3456-7890',
        'birth_date' => '1990-06-15',
        'avatar' => 'img/user/dava.jpg',
    ];
@endphp

@section('breadcrumb')
<nav aria-label="breadcrumb" class="py-3 px-3">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
        <li class="breadcrumb-item active" id="breadcrumb-custom-text">Profile Data</li>
    </ol>
</nav>
@endsection

@section('container')
<div class="container mx-auto p-4 max-w-4xl py-20">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid gap-6 md:grid-cols-2">
        <!-- Avatar Section -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-4 flex flex-col justify-center items-center">
                <h2 class="text-xl font-semibold mb-4">Profile Picture</h2>
                <div class="flex flex-col items-center my-12">
                    <div class="relative">
                        <div class="w-64 h-64 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                            @if($dummyUser['avatar'])
                                <img src="{{ asset('assets/' . $dummyUser['avatar']) }}" alt="Profile" class="w-full h-full object-cover object-center">
                            @else
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            @endif
                        </div>
                        <label for="avatar-upload" class="absolute bottom-0 right-0 p-2 bg-blue-500 rounded-full cursor-pointer hover:bg-blue-600 transition-colors">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </label>
                        <form id="avatar-form" action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input id="avatar-upload" type="file" name="avatar" class="hidden" accept="image/*" onchange="document.getElementById('avatar-form').submit()">
                        </form>
                    </div>
                    <p class="mt-8 text-base text-gray-500">Click the camera icon to change profile picture</p>
                </div>
            </div>
        </div>

        <!-- Personal Info Section -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-4">
                <h2 class="text-xl font-semibold mb-4">Personal Information</h2>
                <form action="#" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-base font-semibold text-gray-700">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $dummyUser['name']) }}" 
                            class="mt-2 block w-full px-3 py-2 text-base rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm hover:border-gray-400 transition-colors bg-white">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-base font-semibold text-gray-700">Gender</label>
                        <select name="gender" class="mt-2 block w-full px-3 py-2 text-base rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm hover:border-gray-400 transition-colors bg-white">
                            <option value="male" {{ old('gender', $dummyUser['gender']) == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $dummyUser['gender']) == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-base font-semibold text-gray-700">Phone Number</label>
                        <input type="tel" name="phone" value="{{ old('phone', $dummyUser['phone']) }}"
                            class="mt-2 block w-full px-3 py-2 text-base rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm hover:border-gray-400 transition-colors bg-white">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-base font-semibold text-gray-700">Birth Date</label>
                        <input type="date" name="birth_date" value="{{ old('birth_date', $dummyUser['birth_date']) }}"
                            class="mt-2 block w-full px-3 py-2 text-base rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm hover:border-gray-400 transition-colors bg-white">
                        @error('birth_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-all font-semibold text-base shadow-md hover:shadow-lg">
                        Save Changes
                    </button>
                </form>
            </div>
        </div>

        <!-- Password Change Section -->
        <div class="bg-white rounded-lg shadow-md md:col-span-2">
            <div class="p-4">
                <h2 class="text-xl font-semibold mb-4">Change Password</h2>
                <form action="#" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid gap-4 md:grid-cols-3">
                        <div>
                            <label class="block text-base font-semibold text-gray-700">Current Password</label>
                            <input type="password" name="current_password"
                                class="mt-2 block w-full px-3 py-2 text-base rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm hover:border-gray-400 transition-colors bg-white">
                            @error('current_password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-base font-semibold text-gray-700">New Password</label>
                            <input type="password" name="new_password"
                                class="mt-2 block w-full px-3 py-2 text-base rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm hover:border-gray-400 transition-colors bg-white">
                            @error('new_password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-base font-semibold text-gray-700">Confirm New Password</label>
                            <input type="password" name="confirm_password"
                                class="mt-2 block w-full px-3 py-2 text-base rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm hover:border-gray-400 transition-colors bg-white">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-all font-semibold text-base shadow-md hover:shadow-lg">
                        Update Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('avatar-upload').addEventListener('change', function() {
        if (this.files && this.files[0]) {
            document.getElementById('avatar-form').submit();
        }
    });
</script>
@endpush