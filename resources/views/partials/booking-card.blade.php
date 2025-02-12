<section class="max-w-7xl mx-auto p-4 md:p-6">
    <div class="bg-white/90 backdrop-blur-sm shadow-2xl rounded-3xl border border-gray-100 overflow-hidden p-4 md:p-6 hover:shadow-xl transition-all duration-300">
        <!-- Header -->
        <div class="text-center mb-4 md:mb-6">
            <h2 class="text-xl md:text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Find Your Next Adventure</h2>
        </div>
        
        <!-- Booking Form -->
        <form>
            <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                <!-- Location Group - From & To -->
                <div class="col-span-1 md:col-span-2 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <div class="flex-1 group">
                        <label class="text-sm font-medium text-gray-700 mb-1 block">From</label>
                        <div class="relative">
                            <input type="text" placeholder="Departure" class="w-full pl-8 pr-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                            <i class="fas fa-plane absolute left-2 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>
                    <div class="flex-1 group">
                        <label class="text-sm font-medium text-gray-700 mb-1 block">To</label>
                        <div class="relative">
                            <input type="text" placeholder="Destination" class="w-full pl-8 pr-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                            <i class="fas fa-map-marker-alt absolute left-2 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Date Group -->
                <div class="col-span-1 md:col-span-2 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <div class="flex-1 group">
                        <label class="text-sm font-medium text-gray-700 mb-1 block">Departure</label>
                        <div class="relative">
                            <input type="date" class="w-full pl-8 pr-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                            <i class="fas fa-calendar absolute left-2 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>
                    <div class="flex-1 group">
                        <label class="text-sm font-medium text-gray-700 mb-1 block">Return</label>
                        <div class="relative">
                            <input type="date" class="w-full pl-8 pr-4 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                            <i class="fas fa-calendar absolute left-2 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Flight Class -->
                <div class="col-span-1 md:col-span-1">
                    <label class="text-sm font-medium text-gray-700 mb-1 block">Flight Class</label>
                    <div class="relative">
                        <select class="w-full pl-8 pr-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                            <option value="economy">Economy</option>
                        </select>
                        <i class="fas fa-couch absolute left-2 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <!-- Search Button -->
                <div class="col-span-1 md:col-span-1 flex items-end">
                    <button type="submit" class="w-full group relative flex items-center justify-center gap-2 px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-medium rounded-xl overflow-hidden transition-all duration-300 hover:scale-105">
                        <span class="relative z-10">Search</span>
                        <i class="fas fa-search transition-transform group-hover:translate-x-1" aria-hidden="true"></i>
                        <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </button>
                </div>
            </div>
        </form>

        <!-- Quick Links -->
        <div class="mt-4 flex flex-wrap justify-center gap-2 md:gap-4">
            <a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition-colors duration-300">Popular Routes</a>
            <span class="text-gray-300 hidden md:inline">|</span>
            <a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition-colors duration-300">Last Minute Deals</a>
            <span class="text-gray-300 hidden md:inline">|</span>
            <a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition-colors duration-300">Special Offers</a>
        </div>
    </div>
</section>