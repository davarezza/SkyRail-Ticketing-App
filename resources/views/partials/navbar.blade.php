<nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-white shadow-md" id="navbar">
    <div class="max-w-screen-lg mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <div class="text-2xl font-semibold text-black" id="logo">{{ config('app.name') }}</div>

            <ul class="hidden md:flex items-center gap-8">
                <li><a href="#" class="font-medium text-gray-800 hover:text-blue-600 transition-colors duration-300">Home</a></li>
                <li><a href="#" class="font-medium text-gray-800 hover:text-blue-600 transition-colors duration-300">About</a></li>
                <li><a href="#" class="font-medium text-gray-800 hover:text-blue-600 transition-colors duration-300">Offers</a></li>
                <li><a href="#" class="font-medium text-gray-800 hover:text-blue-600 transition-colors duration-300">Seats</a></li>
                <li><a href="#" class="font-medium text-gray-800 hover:text-blue-600 transition-colors duration-300">Destinations</a></li>
            </ul>

            <div class="hidden md:block">
                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition duration-300">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition duration-300">Login</a>
                @endauth
            </div>

            <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="md:hidden transition-all duration-300 ease-in-out max-h-0 opacity-0 overflow-hidden">
            <div class="py-4 space-y-4">
                <a href="#" class="block font-medium text-gray-800 hover:text-blue-600 transition-colors duration-300">Home</a>
                <a href="#" class="block font-medium text-gray-800 hover:text-blue-600 transition-colors duration-300">About</a>
                <a href="#" class="block font-medium text-gray-800 hover:text-blue-600 transition-colors duration-300">Offers</a>
                <a href="#" class="block font-medium text-gray-800 hover:text-blue-600 transition-colors duration-300">Seats</a>
                <a href="#" class="block font-medium text-gray-800 hover:text-blue-600 transition-colors duration-300">Destinations</a>
                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full mt-6 px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition duration-300">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block w-full mt-6 px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition duration-300">Login</a>
                @endauth
            </div>
        </div>        
    </div>
</nav>

<script>
    const navbar = document.getElementById('navbar');
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = mobileMenuButton.querySelector('svg');

    mobileMenuButton.addEventListener('click', () => {
        const isHidden = mobileMenu.classList.contains('max-h-0');

        if (isHidden) {
            mobileMenu.classList.remove('max-h-0', 'opacity-0');
            mobileMenu.classList.add('max-h-screen', 'opacity-100');
            menuIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            `;
        } else {
            mobileMenu.classList.add('max-h-0', 'opacity-0');
            mobileMenu.classList.remove('max-h-screen', 'opacity-100');
            menuIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            `;
        }
    });

    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('shadow-md');
        } else {
            navbar.classList.remove('shadow-md');
        }
    });
</script>
