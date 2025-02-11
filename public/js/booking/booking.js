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

    if (show) {
        modal.classList.remove("hidden");
        modal.classList.add("flex");
    } else {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
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
            console.log("Response received:", response);
            $('#facilities-id').text(response.detail.id);

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