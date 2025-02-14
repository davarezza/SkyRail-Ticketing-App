$(() => {
    HELPER.api = {
        detailFacilities: APP_URL + "booking/detail-facilities",
    };

    init();
});

init = async () => {
    await HELPER.block();
    await HELPER.unblock();
};

toggleDetailFacilities = (show) => {
    const modal = document.getElementById("modal-detail-facilities");
    const modalContent = modal.querySelector("div.bg-white");

    if (show) {
        modal.classList.remove("hidden");
        modal.classList.add("flex");
        setTimeout(() => {
            modal.classList.remove("opacity-0");
            modal.classList.add("opacity-100");
            modalContent.classList.remove("scale-95");
            modalContent.classList.add("scale-100");
        }, 10);
    } else {
        modal.classList.add("opacity-0");
        modal.classList.remove("opacity-100");
        modalContent.classList.add("scale-95");
        modalContent.classList.remove("scale-100");

        setTimeout(() => {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
        }, 300);
    }
};

detailFacilities = (id) => {
    HELPER.ajax({
        url: HELPER.api.detailFacilities + '/' + id,
        type: 'get',
        data: {
            id: id,
            _token: $('[name="_token"]').val()
        },
        success: (response) => {
            $('#transport-name').text(response.detail.transport_name);
            $('#transport-code').text(response.detail.transport_code);
            $('#class-name').text(response.detail.class_name);

            const duration = moment(response.detail.arrival_time, 'HH:mm').diff(moment(response.detail.departure_time, 'HH:mm'));
            const hours = Math.floor(duration / (1000 * 60 * 60));
            const minutes = Math.floor((duration % (1000 * 60 * 60)) / (1000 * 60));
            $('#flight-duration').text(`${hours}h ${minutes}m`);

            $('#transport-logo').attr('src', '/assets/img/transport_logo/' + response.detail.transport_logo);
            const facilities = response.detail.class_facilities_detail.split(',');
            const facilitiesContainer = $('#facilities-container');
            facilitiesContainer.empty();

            facilities.forEach(facility => {
                const facilityHtml = `
                    <div class="flex items-start gap-3 my-3">
                        <i class="fas fa-check-circle text-green-400 mt-1.5"></i>
                        <div>
                            <div class="font-semibold">${facility.trim()}</div>
                        </div>
                    </div>
                `;
                facilitiesContainer.append(facilityHtml);
            });

            toggleDetailFacilities(true);
        },
        error: (err) => {
            console.error("AJAX error:", err);
            HELPER.showMessage({
                success: false,
                title: 'Failed',
                message: 'System error, please contact the Administrator'
            });
        }
    });
};

toggleDetailPrices = (show) => {
    const modal = document.getElementById("modal-detail-prices");
    const modalContent = modal.querySelector("div.bg-white");

    if (show) {
        modal.classList.remove("hidden");
        modal.classList.add("flex");
        setTimeout(() => {
            modal.classList.remove("opacity-0");
            modal.classList.add("opacity-100");
            modalContent.classList.remove("scale-95");
            modalContent.classList.add("scale-100");
        }, 10);
    } else {
        modal.classList.add("opacity-0");
        modal.classList.remove("opacity-100");
        modalContent.classList.add("scale-95");
        modalContent.classList.remove("scale-100");

        setTimeout(() => {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
        }, 300);
    }
};

detailPrices = (id) => {
    HELPER.ajax({
        url: HELPER.api.detailFacilities + '/' + id,
        type: 'get',
        data: {
            id: id,
            _token: $('[name="_token"]').val()
        },
        success: (response) => {
            console.log(response.detail);
            $('#all-city').text(`${response.detail.departure_city} → ${response.detail.objective_city}`);

            const price = response.detail.price;
            const taxRate = 0.11;
            const childDiscount = 0.75;
            const infantDiscount = 0.10;

            const adultTotal = counts.adult * price;
            const childTotal = counts.child * (price * childDiscount);
            const infantTotal = counts.infant * (price * infantDiscount);
            const subtotal = adultTotal + childTotal + infantTotal;
            const taxPrice = subtotal * taxRate;
            const totalPrice = subtotal + taxPrice;

            let passengerHTML = '';

            if (counts.adult > 0) {
                passengerHTML += `
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <span class="w-2 h-2 bg-gray-300 rounded-full"></span>
                            <span class="text-gray-700 text-base">Adult (x${counts.adult})</span>
                        </div>
                        <span class="text-gray-900 font-medium">IDR ${adultTotal.toLocaleString('id-ID')}</span>
                    </div>
                `;
            }

            if (counts.child > 0) {
                passengerHTML += `
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <span class="w-2 h-2 bg-gray-300 rounded-full"></span>
                            <span class="text-gray-700 text-base">Child (x${counts.child})</span>
                        </div>
                        <span class="text-gray-900 font-medium">IDR ${childTotal.toLocaleString('id-ID')}</span>
                    </div>
                `;
            }

            if (counts.infant > 0) {
                passengerHTML += `
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <span class="w-2 h-2 bg-gray-300 rounded-full"></span>
                            <span class="text-gray-700 text-base">Infant (x${counts.infant})</span>
                        </div>
                        <span class="text-gray-900 font-medium">IDR ${infantTotal.toLocaleString('id-ID')}</span>
                    </div>
                `;
            }

            $('#passenger-prices').html(passengerHTML);
            $('#tax-price').text(`IDR ${taxPrice.toLocaleString('id-ID')}`);
            $('#total-price-modal').text(`IDR ${totalPrice.toLocaleString('id-ID')}`);

            toggleDetailPrices(true);
        },
        error: (err) => {
            console.error("AJAX error:", err);
            HELPER.showMessage({
                success: false,
                title: 'Failed',
                message: 'System error, please contact the Administrator'
            });
        }
    });
};

const counts = {
    adult: 1,
    child: 0,
    infant: 0
};

const limits = {
    adult: { min: 1, max: 3 },
    child: { min: 0, max: 1 },
    infant: { min: 0, max: 1 }
};

function updatePassengerSummary() {
    const adultCount = counts['adult'];
    const childCount = counts['child'];
    const infantCount = counts['infant'];

    let summary = [];

    if (adultCount > 0) {
        summary.push(`${adultCount} Adult${adultCount > 1 ? 's' : ''}`);
    }
    if (childCount > 0) {
        summary.push(`${childCount} Child${childCount > 1 ? 'ren' : ''}`);
    }
    if (infantCount > 0) {
        summary.push(`${infantCount} Infant${infantCount > 1 ? 's' : ''}`);
    }

    document.getElementById('passenger-summary').textContent = summary.join(', ');
}

function updateTotalPrice() {
    const priceData = document.getElementById('price-data');
    const basePrice = parseFloat(priceData.getAttribute('data-price'));
    const taxRate = parseFloat(priceData.getAttribute('data-tax-rate'));
    const childDiscount = parseFloat(priceData.getAttribute('data-child-discount'));
    const infantDiscount = parseFloat(priceData.getAttribute('data-infant-discount'));

    const adultTotal = counts.adult * basePrice;
    const childTotal = counts.child * (basePrice * childDiscount);
    const infantTotal = counts.infant * (basePrice * infantDiscount);

    const subtotal = adultTotal + childTotal + infantTotal;
    const tax = subtotal * taxRate;
    const total = subtotal + tax;

    document.getElementById('total-price').textContent = `IDR ${total.toLocaleString()}`;
    document.getElementById('total_price_input').value = total;
}

function updateCount(type, action) {
    const currentCount = counts[type];
    const { min, max } = limits[type];

    if (action === 'increase' && currentCount < max) {
        counts[type]++;
    } else if (action === 'decrease' && currentCount > min) {
        counts[type]--;
    }

    document.getElementById(`${type}-count`).textContent = counts[type];
    updateTotalPrice();

    const decreaseBtn = document.querySelector(`button[onclick="updateCount('${type}', 'decrease')"]`);
    const increaseBtn = document.querySelector(`button[onclick="updateCount('${type}', 'increase')"]`);

    const isMin = counts[type] <= min;
    const isMax = counts[type] >= max;

    decreaseBtn.disabled = isMin;
    increaseBtn.disabled = isMax;

    decreaseBtn.classList.toggle('opacity-50', isMin);
    decreaseBtn.classList.toggle('cursor-not-allowed', isMin);
    decreaseBtn.classList.toggle('bg-gray-200', isMin);
    decreaseBtn.classList.toggle('text-gray-500', isMin);
    decreaseBtn.classList.toggle('border-gray-400', isMin);
    decreaseBtn.classList.toggle('hover:bg-blue-50', !isMin);

    increaseBtn.classList.toggle('opacity-50', isMax);
    increaseBtn.classList.toggle('cursor-not-allowed', isMax);
    increaseBtn.classList.toggle('bg-gray-200', isMax);
    increaseBtn.classList.toggle('text-gray-500', isMax);
    increaseBtn.classList.toggle('border-gray-400', isMax);
    increaseBtn.classList.toggle('hover:bg-blue-50', !isMax);

    updatePassengerSummary();
}

['adult', 'child', 'infant'].forEach(type => {
    document.getElementById(`${type}-count`).textContent = counts[type];
    updateCount(type, '');
});

document.addEventListener('DOMContentLoaded', updateTotalPrice);