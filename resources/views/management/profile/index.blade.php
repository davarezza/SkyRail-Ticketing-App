@extends('layouts.main')

@section('title')
    <title>Profile | {{ config('app.name') }}</title>
@endsection

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
    <div class="grid gap-6 md:grid-cols-2">
        <!-- Avatar Section -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-4 flex flex-col justify-center items-center">
                <h2 class="text-xl font-semibold mb-4">Profile Picture</h2>
                <div class="flex flex-col items-center my-12">
                    <div class="relative">
                        <div class="w-64 h-64 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                            @if($image)
                                <img src="{{ asset('assets/img/user/' . $image) }}" alt="Profile" class="w-full h-full object-cover object-center">
                            @else
                            <img src="{{ asset('assets/img/user/dava.jpg') }}" alt="Profile" class="w-full h-full object-cover object-center">
                            @endif
                        </div>
                        <label for="imageInput" class="absolute bottom-0 right-0 p-2 bg-blue-500 rounded-full cursor-pointer hover:bg-blue-600 transition-colors">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </label>
                        <form action="{{ route('management.profile.changeImage') }}" method="POST" enctype="multipart/form-data" id="imageForm">
                            @csrf
                            @method('PATCH')
                            <input id="imageInput" type="file" name="image" class="hidden" accept="image/jpeg,image/png,image/svg+xml" onchange="document.getElementById('imageForm').submit()">
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
                        <input type="text" name="name" id="name" value="{{ old('name') }}" 
                            class="mt-2 block w-full px-3 py-2 text-base rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm hover:border-gray-400 transition-colors bg-white">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-base font-semibold text-gray-700">Username</label>
                        <input type="text" name="username" id="username" value="{{ old('username') }}" 
                            class="mt-2 block w-full px-3 py-2 text-base rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm hover:border-gray-400 transition-colors bg-white">
                        @error('username')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-base font-semibold text-gray-700">Gender</label>
                        <select name="gender" id="gender" class="mt-2 block w-full px-3 py-2 text-base rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm hover:border-gray-400 transition-colors bg-white">
                            <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Male</option>
                            <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-base font-semibold text-gray-700">Phone Number</label>
                        <input type="tel" name="telephone" id="telephone" value="{{ old('telephone') }}"
                            class="mt-2 block w-full px-3 py-2 text-base rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm hover:border-gray-400 transition-colors bg-white">
                        @error('telephone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-base font-semibold text-gray-700">Birth Date</label>
                        <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') }}"
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
                            <input type="password" name="current_password" id="current_password"
                                class="mt-2 block w-full px-3 py-2 text-base rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm hover:border-gray-400 transition-colors bg-white">
                            @error('current_password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-base font-semibold text-gray-700">New Password</label>
                            <input type="password" name="new_password" id="new_password"
                                class="mt-2 block w-full px-3 py-2 text-base rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm hover:border-gray-400 transition-colors bg-white">
                            @error('new_password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-base font-semibold text-gray-700">Confirm New Password</label>
                            <input type="password" name="confirm_password" id="confirm_password"
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
<script src="{!! asset('js/management/profile.js') !!}?v={{ time() }}"></script>
<script>
    $(document).ready(function() {
        const imageInput = $('#imageInput');
        const imageForm = $('#imageForm');

        imageInput.on('change', function() {
            imageForm.submit();
        });
    });
</script>
@endpush