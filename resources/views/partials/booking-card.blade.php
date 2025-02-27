<section class="max-w-7xl mx-auto p-4 md:p-6">
    <div class="bg-white/90 backdrop-blur-sm shadow-lg rounded-3xl border border-gray-100 overflow-hidden p-4 md:p-6 hover:shadow-2xl transition-all duration-300">
        <div class="text-center mb-4 md:mb-6">
            <h2 class="text-xl md:text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Find Your Next Adventure</h2>
        </div>
        <form id="search-form" action="{{ route('search.travel') }}" method="GET" class="rounded-lg shadow-lg p-4 mb-4 border-2 border-gray-200/50 backdrop-blur-sm">
            <div class="grid grid-cols-1 md:grid-cols-[1fr,auto,1fr,1fr,1fr,auto] md:gap-4 items-end space-y-4 md:space-y-0">
                <div class="relative w-full">
                    <label class="text-sm font-medium text-gray-700 mb-1 block">From</label>
                    <div class="relative">
                        <i class="fas fa-plane absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <select id="from" name="from" class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none bg-white">
                            <option value="" disabled selected>Select Departure City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city }}" {{ request('from') == $city ? 'selected' : '' }}>{{ $city }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="button" id="swap-button" class="h-12 w-12 flex items-center justify-center bg-gray-100 rounded-full hover:bg-gray-200 transition transform hover:scale-105 self-center">
                    <i class="fas fa-exchange-alt text-gray-600"></i>
                </button>

                <div class="relative w-full">
                    <label class="text-sm font-medium text-gray-700 mb-1 block">To</label>
                    <div class="relative">
                        <i class="fas fa-map-marker-alt absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <select id="to" name="to" class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none bg-white">
                            <option value="" disabled selected>Select Destination City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city }}" {{ request('to') == $city ? 'selected' : '' }}>{{ $city }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="relative w-full">
                    <label class="text-sm font-medium text-gray-700 mb-1 block">Departure</label>
                    <div class="relative">
                        <i class="fas fa-calendar absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="date" id="departure_date" name="departure_date" value="{{ request('departure_date', '') }}" class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none bg-white" />
                    </div>
                </div>

                <div class="relative w-full">
                    <label class="text-sm font-medium text-gray-700 mb-1 block">Flight Class</label>
                    <div class="relative">
                        <i class="fas fa-couch absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <select id="flight_class" name="flight_class" class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none bg-white">
                            <option value="" disabled selected>Select Flight Class</option>
                            @foreach ($flightClasses as $class)
                                <option value="{{ $class }}" {{ request('flight_class') == $class ? 'selected' : '' }}>
                                    {{ ucfirst($class) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button id="search-button" type="submit" class="h-12 w-12 md:self-end flex items-center justify-center bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed transition-all duration-300 ease-in-out" disabled>
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>

        <div class="mt-4 flex flex-wrap justify-center gap-2 md:gap-4">
            <a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition-colors duration-300">Popular Routes</a>
            <span class="text-gray-300 hidden md:inline">|</span>
            <a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition-colors duration-300">Last Minute Deals</a>
            <span class="text-gray-300 hidden md:inline">|</span>
            <a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition-colors duration-300">Special Offers</a>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        const $from = $("#from");
        const $to = $("#to");
        const $departureDate = $("#departure_date");
        const $flightClass = $("#flight_class");
        const $searchButton = $("#search-button");
        const $swapButton = $("#swap-button");

        $swapButton.on("click", function () {
            let fromValue = $from.val();
            let toValue = $to.val();

            $from.val(toValue).trigger("change");
            $to.val(fromValue).trigger("change");
        });

        function checkForm() {
            if ($from.val() && $to.val() && $departureDate.val() && $flightClass.val()) {
                $searchButton.prop("disabled", false);
                $searchButton.removeClass("bg-gray-300 text-gray-500 cursor-not-allowed");
                $searchButton.addClass("bg-blue-500 text-white hover:bg-blue-600 shadow-lg scale-105");
            } else {
                $searchButton.prop("disabled", true);
                $searchButton.removeClass("bg-blue-500 text-white hover:bg-blue-600 shadow-lg scale-105");
                $searchButton.addClass("bg-gray-300 text-gray-500 cursor-not-allowed");
            }
        }

        $from.on("change", checkForm);
        $to.on("change", checkForm);
        $departureDate.on("input", checkForm);
        $flightClass.on("change", checkForm);
    });
</script>
