$(document).ready(function() {
    const seats = $('.seat-btn:not([disabled])');
    const selectedSeatDisplay = $('#selectedSeatDisplay');
    const seatNumber = $('#seatNumber');
    let selectedSeats = [];
    const maxSeats = seatPassenger;

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

        selectedSeatDisplay.removeClass('hidden');
        seatNumber.text(selectedSeats.join(', '));

        if (selectedSeats.length === maxSeats) {
            seats.not('.bg-blue-500').prop('disabled', true);
        } else {
            seats.prop('disabled', false);
        }
    });
});