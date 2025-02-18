$(document).ready(function() {
    const seats = $('.seat-btn:not([disabled])');
    let selectedSeats = [];
    const maxSeats = seatPassenger;
    let passengerContainer = $("#passenger-container");
    let continueBtn = $("button[type='submit']");

    continueBtn.prop('disabled', true)
        .addClass('opacity-50 cursor-not-allowed bg-stone-600 text-gray-400')
        .removeClass('bg-blue-600 text-white hover:bg-blue-700');

    passengers.forEach((passenger, index) => {
        let passengerForm = `
            <div class="hidden rounded-lg shadow-lg p-4 border-2 border-gray-200/50 backdrop-blur-sm">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-xl font-semibold">Passenger ${index + 1} (${passenger.type.charAt(0).toUpperCase() + passenger.type.slice(1)})</h2>
                </div>
                <hr class="border-gray-300 p-2">
                <input type="hidden" name="passengers[${index}][booking_passenger_id]" value="${passenger.id}">
                <input type="text" name="passengers[${index}][booking_passenger_seat_code]" id="seat_${index}" readonly class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
        `;
        passengerContainer.append(passengerForm);
    });

    seats.click(function() {
        const seat = $(this).data('seat');

        if ($(this).hasClass('bg-blue-500')) {
            $(this).removeClass('bg-blue-500 text-white').addClass('bg-white');
            selectedSeats = selectedSeats.filter(s => s !== seat);
        } else {
            if (selectedSeats.length < maxSeats) {
                $(this).removeClass('bg-white').addClass('bg-blue-500 text-white');
                selectedSeats.push(seat);
            }
        }

        passengers.forEach((passenger, index) => {
            let seatField = $(`#seat_${index}`);
            seatField.val(selectedSeats[index] || '');
        });

        // Cek apakah jumlah kursi sudah sesuai dengan jumlah penumpang
        if (selectedSeats.length === maxSeats) {
            continueBtn.prop('disabled', false)
                .removeClass('opacity-50 cursor-not-allowed bg-stone-600 text-gray-400')
                .addClass('bg-blue-600 text-white hover:bg-blue-700');
            seats.not('.bg-blue-500').prop('disabled', true);
        } else {
            continueBtn.prop('disabled', true)
                .addClass('opacity-50 cursor-not-allowed bg-stone-600 text-gray-400')
                .removeClass('bg-blue-600 text-white hover:bg-blue-700');
            seats.prop('disabled', false);
        }
    });
});