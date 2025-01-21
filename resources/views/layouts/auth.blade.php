<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @keyframes scale-up {
            to { transform: scale(1.05); }
        }
        @keyframes scale-down {
            to { transform: scale(0.95); }
        }
        @keyframes left-right {
            to { transform: translateX(10px); }
        }
        @keyframes up-down {
            to { transform: translateY(10px); }
        }
        @keyframes up-down-plane {
            0% {
                transform: translateX(-50%) translateY(0);
            }
            100% {
                transform: translateX(-50%) translateY(10px);
            }
        }
        .animate-scale-up {
            animation: scale-up 3s ease-in-out alternate infinite;
        }
        .animate-scale-down {
            animation: scale-down 3s ease-in-out alternate infinite;
        }
        .animate-left-right {
            animation: left-right 3s ease-in-out alternate infinite;
        }
        .animate-up-down {
            animation: up-down 3s ease-in-out alternate infinite;
        }
        .animate-up-down-plane {
            animation: up-down-plane 3s ease-in-out alternate infinite;
        }
    </style>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex items-center justify-center p-5 bg-cover bg-center bg-no-repeat bg-fixed" style="background-image: url({{ asset('assets/img/cloud-bg.jpg') }})">
    <!-- Form Container -->
    <div class="flex w-full max-w-[900px] h-auto md:h-[500px] border-2 border-white/30 rounded-3xl backdrop-blur-lg">
        <!-- Left Column - Hidden on mobile -->
        <div class="hidden lg:flex lg:flex-col lg:items-center lg:justify-center lg:w-[55%] bg-white/30 backdrop-blur-xl rounded-r-[25%] rounded-l-[4.5%] transition-all duration-300">
            <div class="relative w-[350px] h-[350px]">
                <!-- Layered images -->
                <img src="{{ asset('assets/img/dots.png') }}" 
                     class="absolute top-0 left-0 w-full h-full animate-scale-up" 
                     alt="">
                <img src="{{ asset('assets/img/coin.png') }}" 
                     class="absolute top-[12%] left-[8%] w-full h-full animate-scale-down" 
                     alt="">
                <img src="{{ asset('assets/img/spring.png') }}" 
                     class="absolute top-0 left-[-12%] w-full h-full animate-scale-down" 
                     alt="">
                <img src="{{ asset('assets/img/plane.png') }}" 
                     class="absolute top-[30%] left-[45%] -translate-x-1/2 -translate-y-1/5 w-[200px] h-[200px] animate-up-down-plane" 
                     alt="">
                <img src="{{ asset('assets/img/cloud.png') }}" 
                     class="absolute top-0 left-0 w-full h-full animate-left-right" 
                     alt="">
                <img src="{{ asset('assets/img/stars.png') }}" 
                     class="absolute top-0 left-0 w-full h-full animate-scale-up" 
                     alt="">
            </div>
            <p class="text-center text-white w-[300px] mt-4">
                Fly with <span class="font-semibold text-[#21264D]">SkyFlight</span> - Your happiness, our priority!
            </p>
        </div>

        @yield('content')
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('js/auth/auth.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    @if (Session::has('success'))
    toastr.options = {
        "positionClass": "toast-top-right",
    };
    toastr.success("{{ Session::get('success') }}");
    @endif

    @if (Session::has('loginError'))
    toastr.options = {
        "positionClass": "toast-top-right",
    };
    toastr.error("{{ Session::get('loginError') }}");
    @endif
    
    const togglePassword = document.getElementById('togglePassword');
    const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        this.classList.toggle('bx-hide');
        this.classList.toggle('bx-show');
    });

    togglePasswordConfirmation.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        this.classList.toggle('bx-hide');
        this.classList.toggle('bx-show');
    });
</script>