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

<div id="modal-payment" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 transition-opacity duration-300 opacity-0">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl mx-4 relative max-h-[90vh] flex flex-col transform scale-95 transition-all duration-300 p-6">
        <div id="selected-payment-display" class="flex items-center space-x-3 bg-gray-100 p-3 rounded-lg mb-4">
            <img id="selected-payment-logo" src="" class="w-10 h-10" alt="">
            <span id="selected-payment-name" class="text-lg font-medium text-gray-800"></span>
        </div>

        <div x-data="{ show: false, message: '' }" x-show="show" x-cloak
            class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 my-4 rounded-md shadow-md flex justify-between items-center">
            <span x-text="message"></span>
            <button type="button" @click="show = false" class="text-red-700 hover:text-red-900">
                <i class="fas fa-times h-5 w-5"></i>
            </button>
        </div>

        <h2 class="text-2xl font-bold mb-4">Enter Payment Amount</h2>
        <input type="text" name="total_amount" id="total-amount" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Enter amount" min="1">
        <input type="hidden" name="total_amount_input" id="total-amount-input">
        <div class="flex justify-end mt-4 space-x-4">
            <button type="button" id="cancel-modal" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-lg text-gray-700 transition-colors duration-200">Cancel</button>
            <button type="button" id="confirm-payment" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">Confirm</button>
        </div>
    </div>
</div>
