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
            $('#price').text(`IDR ${price.toLocaleString('id-ID')}`);
            const taxPrice = price * 0.11;
            $('#tax-price').text(`IDR ${taxPrice.toLocaleString('id-ID')}`);
            $('#total-price').text(`IDR ${(price + taxPrice).toLocaleString('id-ID')}`);

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