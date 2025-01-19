<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkyFlight | Login</title>
    <!-- BOXICONS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
        <!-- Left Column -->
        <div class="hidden lg:flex lg:flex-col lg:items-center lg:justify-center lg:w-[55%] bg-white/30 backdrop-blur-xl rounded-r-[25%] transition-all duration-300">
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

        <!-- Right Column -->
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
                <h2 class="my-8 text-white text-2xl font-semibold">Login</h2>
                
                <div class="w-full space-y-2">
                    <div class="relative">
                        <input type="text" 
                               placeholder="Email" name="email" id="email" 
                               class="w-full h-12 px-3 text-white bg-white/20 rounded-lg outline-none backdrop-blur-md shadow-md placeholder:text-white placeholder:text-sm"
                               required>
                        <i class="bx bx-user absolute right-3 top-1/2 -translate-y-1/2 text-white"></i>
                    </div>

                    <div class="relative">
                        <input type="password" placeholder="Password" name="password" id="password"
                            class="w-full h-12 px-3 text-white bg-white/20 rounded-lg outline-none backdrop-blur-md shadow-md placeholder:text-white placeholder:text-sm"
                            required>
                        <i class="bx bx-hide absolute right-3 top-1/2 -translate-y-1/2 text-white cursor-pointer" 
                            id="togglePassword"></i>
                    </div>

                    <div class="flex justify-end p-2">
                        <a href="#" class="text-white text-xs hover:underline">Forgot Password?</a>
                    </div>

                    <button class="flex items-center justify-center gap-2 w-full h-12 px-3 text-white bg-[#21264D] rounded-lg shadow-md hover:gap-3 transition-all duration-300">
                        <span>Login</span>
                        <i class="bx bx-right-arrow-alt"></i>
                    </button>
                </div>

                <div class="flex gap-4 mt-4">
                    <div class="flex items-center justify-center h-8 w-8 text-white bg-black/20 rounded-full cursor-pointer shadow-md hover:bg-black/30 hover:scale-110 transition-all duration-200">
                        <i class="bx bxl-google"></i>
                    </div>
                    <div class="flex items-center justify-center h-8 w-8 text-white bg-black/20 rounded-full cursor-pointer shadow-md hover:bg-black/30 hover:scale-110 transition-all duration-200">
                        <i class="bx bxl-twitter"></i>
                    </div>
                    <div class="flex items-center justify-center h-8 w-8 text-white bg-black/20 rounded-full cursor-pointer shadow-md hover:bg-black/30 hover:scale-110 transition-all duration-200">
                        <i class="bx bxl-facebook"></i>
                    </div>
                    <div class="flex items-center justify-center h-8 w-8 text-white bg-black/20 rounded-full cursor-pointer shadow-md hover:bg-black/30 hover:scale-110 transition-all duration-200">
                        <i class="bx bxl-github"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('js/auth/auth.js') }}"></script>
</body>
</html>
<script>
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        this.classList.toggle('bx-hide');
        this.classList.toggle('bx-show');
    });
</script>