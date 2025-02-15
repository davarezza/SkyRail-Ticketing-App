$(document).ready(function () {
    let passengerContainer = $("#passenger-container");

    passengers.forEach((passenger, index) => {
        let passengerForm = `
            <div class="rounded-lg shadow-lg p-4 border-2 border-gray-200/50 backdrop-blur-sm">
                <form class="space-y-4">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold">Passenger ${index + 1} (${passenger.type.charAt(0).toUpperCase() + passenger.type.slice(1)})</h2>
                    </div>
                    <hr class="border-gray-300 p-2">
                    <div>
                        <input type="text" name="passengers[${index}][full_name]" value="${passenger.full_name || ''}"
                               placeholder="Full Name" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all">
                    </div>
                    <div>
                        <input type="date" name="passengers[${index}][birth_date]" value="${passenger.birth_date || ''}"
                               placeholder="Birth Date" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all">
                    </div>
                </form>
            </div>
        `;
        passengerContainer.append(passengerForm);
    });
});