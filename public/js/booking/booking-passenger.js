$(document).ready(function () {
    let passengerContainer = $("#passenger-container");

    passengers.forEach((passenger, index) => {
        let birthDateInput = passenger.type.toLowerCase() === "adult" ? "" : `
            <div>
                <input type="date" name="passengers[${index}][birth_date]" id="birth_date_${index}" value="${passenger.birth_date || ''}"
                       placeholder="Birth Date" class="w-full px-4 py-2 mt-4 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all">
            </div>
        `;

        let passengerForm = `
            <div class="rounded-lg shadow-lg p-4 border-2 border-gray-200/50 backdrop-blur-sm">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-xl font-semibold">Passenger ${index + 1} (${passenger.type.charAt(0).toUpperCase() + passenger.type.slice(1)})</h2>
                </div>
                <hr class="border-gray-300 p-2">
                <input type="hidden" name="passengers[${index}][booking_passenger_id]" value="${passenger.id}">
                <input type="hidden" name="passengers[${index}][type]" id="type_${index}" value="${passenger.type}">
                <div>
                    <input type="text" name="passengers[${index}][name]" id="name_${index}" value="${passenger.name || ''}"
                           placeholder="Full Name" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all">
                </div>
                ${birthDateInput}
            </div>
        `;

        passengerContainer.append(passengerForm);
    });

    $("#bookingForm").on("submit", function (event) {
        let today = new Date();
        let errorMessage = null;
        let nameRegex = /^[a-zA-Z\s]+$/;

        for (let index = 0; index < passengers.length; index++) {
            let birthDateInput = $(`#birth_date_${index}`).val();
            let passengerType = $(`#type_${index}`).val();
            let passengerName = $(`#name_${index}`).val();

            if (!nameRegex.test(passengerName)) {
                errorMessage = `Passenger ${index + 1}: Name should only contain letters and spaces.`;
                break;
            }

            if (birthDateInput) {
                let birthDate = new Date(birthDateInput);
                let age = today.getFullYear() - birthDate.getFullYear();
                let monthDiff = today.getMonth() - birthDate.getMonth();

                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }

                if (passengerType === "child" && age >= 12) {
                    errorMessage = `Passenger ${index + 1}: Should be under 12 years old for child type.`;
                    break;
                } else if (passengerType === "infant" && age >= 2) {
                    errorMessage = `Passenger ${index + 1}: Should be under 2 years old for infant type.`;
                    break;
                }
            }
        }

        if (errorMessage) {
            event.preventDefault();

            let alpineErrorComponent = document.querySelector('[x-data]');
            alpineErrorComponent.__x.$data.message = errorMessage;
            alpineErrorComponent.__x.$data.show = true;

            return false;
        }
    });
});