<nav class="max-w-screen-lg mx-auto py-4 flex items-center justify-between gap-4">
    <div class="text-2xl font-semibold text-text-dark">{{ config('app.name') }}</div>
    <ul class="flex items-center gap-8">
        <li><a href="#" class="font-medium text-text-light hover:text-text-dark transition duration-300">Home</a>
        </li>
        <li><a href="#" class="font-medium text-text-light hover:text-text-dark transition duration-300">About</a>
        </li>
        <li><a href="#" class="font-medium text-text-light hover:text-text-dark transition duration-300">Offers</a>
        </li>
        <li><a href="#" class="font-medium text-text-light hover:text-text-dark transition duration-300">Seats</a>
        </li>
        <li><a href="#"
                class="font-medium text-text-light hover:text-text-dark transition duration-300">Destinations</a></li>
    </ul>
    <a href="{{ route('login') }}" class="px-8 py-3 text-white bg-blue-600 rounded-lg font-bold hover:bg-blue-700 transition duration-300">Login</a>
</nav>
