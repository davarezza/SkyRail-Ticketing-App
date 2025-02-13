<div id="modal-detail-facilities" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 transition-opacity duration-300 opacity-0">
    <div class="bg-white rounded-lg w-full max-w-2xl mx-4 relative max-h-[90vh] flex flex-col transform scale-95 transition-all duration-300">
        <div class="px-6 py-4 flex-shrink-0">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Flight Facilities</h2>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 cursor-pointer transition duration-300 hover:scale-110" onclick="toggleDetailFacilities(false)">
                    <i class="ki-outline ki-cross text-3xl"></i>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 overflow-y-auto flex-grow">
            <div class="flex items-center gap-3 mb-4">
                <img src="" id="transport-logo" class="w-12 h-12 rounded-full">
                <div class="flex flex-col items-start gap-1">
                    <div class="font-medium" id="transport-name"></div>
                    <div class="text-gray-500">
                        <span id="transport-code"></span>
                        <span>•</span>
                        <span id="class-name"></span>
                        <span>•</span>
                        <span id="flight-duration"></span>
                    </div>
                </div>
            </div> <hr class="bg-gray-300 my-2">

            <div class="space-y-4">
                <h3 class="font-semibold text-gray-800 mb-4">Ticket Includes</h3>
                <div class="space-y-2">
                    <div id="facilities-container">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-detail-prices" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 transition-opacity duration-300 opacity-0">
    <div class="bg-white rounded-xl w-full max-w-2xl mx-4 relative max-h-[90vh] flex flex-col transform scale-95 transition-all duration-300">
        <div class="px-8 py-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Price Details</h2>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 cursor-pointer transition duration-300 hover:scale-110" onclick="toggleDetailPrices(false)">
                    <i class="ki-outline ki-cross text-3xl"></i>
                </div>
            </div>
            <div class="my-4">
                <h1 id="all-city" class="text-xl font-bold text-gray-900">Jakarta → Surabaya</h1>
            </div>
            <div class="mb-6 space-y-4">
                <h2 class="text-base font-semibold text-gray-800">Price</h2>
                <div class="space-y-3" id="passenger-prices">

                </div>                
            </div>
            <hr class="border-gray-300 my-2">
    
            <div class="mb-6 space-y-4">
                <h2 class="text-base font-semibold text-gray-800">Other Charges</h2>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <span class="w-2 h-2 bg-gray-300 rounded-full"></span>
                            <span class="text-gray-700 text-base">Tax (11%)</span>
                        </div>
                        <span id="tax-price" class="text-gray-900 font-medium"></span>
                    </div>
                </div>
            </div>
    
            <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                <div class="space-y-1">
                    <h2 class="text-base font-medium text-gray-600">Total</h2>
                    <div id="total-price-modal" class="text-xl font-bold text-gray-900"></div>
                </div>
                <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold mt-2.5 py-2.5 px-6 rounded-lg transition duration-300 text-base" onclick="toggleDetailPrices(false)">
                    Choose Ticket
                </button>
            </div>
        </div>
    </div>
</div>