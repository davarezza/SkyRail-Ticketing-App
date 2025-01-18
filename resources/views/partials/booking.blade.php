<section class="max-w-7xl mx-auto p-6">
    <div class="bg-white/90 backdrop-blur-sm shadow-2xl rounded-3xl border border-gray-100 overflow-hidden p-6 hover:shadow-xl transition-all duration-300">
        <!-- Header -->
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Find Your Next Adventure</h2>
        </div>
        
        <!-- Booking Form -->
        <form class="grid grid-cols-6 gap-4">
            <!-- Location Group - From & To -->
            <div class="col-span-2 flex space-x-4">
                <div class="flex-1 group">
                    <label class="text-sm font-medium text-gray-700 mb-1 block">From</label>
                    <div class="relative">
                        <input type="text" placeholder="Departure" class="w-full pl-8 pr-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-2 top-1/2 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </div>
                </div>
                <div class="flex-1 group">
                    <label class="text-sm font-medium text-gray-700 mb-1 block">To</label>
                    <div class="relative">
                        <input type="text" placeholder="Destination" class="w-full pl-8 pr-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-2 top-1/2 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Date Group -->
            <div class="col-span-2 flex space-x-4">
                <div class="flex-1 group">
                    <label class="text-sm font-medium text-gray-700 mb-1 block">Departure</label>
                    <div class="relative">
                        <input type="date" class="w-full pl-8 pr-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-2 top-1/2 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex-1 group">
                    <label class="text-sm font-medium text-gray-700 mb-1 block">Return</label>
                    <div class="relative">
                        <input type="date" class="w-full pl-8 pr-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-2 top-1/2 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Passengers & Class -->
            <div class="col-span-1 group">
                <label class="text-sm font-medium text-gray-700 mb-1 block">Passengers</label>
                <div class="relative">
                    <input type="number" min="1" max="10" placeholder="Guests" class="w-full pl-8 pr-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-2 top-1/2 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Search Button -->
            <div class="col-span-1 flex items-end">
                <button class="w-full group relative flex items-center justify-center gap-2 px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-medium rounded-xl overflow-hidden transition-all duration-300 hover:scale-105">
                    <span class="relative z-10">Search</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </button>
            </div>
        </form>

        <!-- Quick Links -->
        <div class="mt-4 flex justify-center space-x-4">
            <a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition-colors duration-300">Popular Routes</a>
            <span class="text-gray-300">|</span>
            <a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition-colors duration-300">Last Minute Deals</a>
            <span class="text-gray-300">|</span>
            <a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition-colors duration-300">Special Offers</a>
        </div>
    </div>
</section>