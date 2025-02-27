$(() => {
    HELPER.api = {
        table: APP_URL + "master/travel-route/table",
        save: APP_URL + "master/travel-route/store",
        detail: APP_URL + "master/travel-route/detail",
        edit: APP_URL + "master/travel-route/edit",
        update: APP_URL + "master/travel-route/update",
        delete: APP_URL + "master/travel-route/delete",
        getDataSelect: APP_URL + "master/travel-route/get-data-select",
    };

    init();
});

init = async () => {
    await HELPER.block();
    await getDataSelect();
    await initTableTravelRoute();
    await formValidationAddTravelRoute();
    await HELPER.unblock();
};

initTableTravelRoute = () => {
    return new Promise((resolve, reject) => {
        var initTableTravelRoute = HELPER.initTable({
            el: "travel-route-table",
            url: HELPER.api.table,
            data: {
                _token: $('[name="_token"]').val(),
            },
            clickAble: false,
            index: 0,
            sorting: "desc",
            destroyAble: true,
            responsive: false,
            pageLength: 10,
            language: {
                paginate: {
                    previous: "<",
                    next: ">"
                }
            },
            columns: [
                {
                    data: "id",
                    searchable: false,
                    orderable: false,
                    className: "align-middle",
                },
                {
                    data: "objective_city",
                    searchable: true,
                    orderable: true,
                    className: "align-middle",
                },
                {
                    data: "departure_city",
                    searchable: true,
                    orderable: true,
                    className: "align-middle",
                },
                {
                    data: "price",
                    searchable: true,
                    orderable: true,
                    className: "align-middle",
                },
                {
                    data: "transport_name",
                    searchable: true,
                    orderable: false,
                    className: "align-middle",
                },
                {
                    data: "id",
                    searchable: false,
                    orderable: false,
                    className: "align-middle",
                },
            ],
            columnDefs: [
                {
                    orderable: true,
                    targets: [0, -1],
                },
                {
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return meta.row + 1;
                    },
                },
                {
                    targets: 1,
                    render: function (data, type, full, meta) {
                        return full.objective_city;
                    },
                },
                {
                    targets: 2,
                    render: function (data, type, full, meta) {
                        return full.departure_city;
                    },
                },
                {
                    targets: 3,
                    render: function (data, type, full, meta) {
                        return 'IDR ' + new Intl.NumberFormat('id-ID', { minimumFractionDigits: 0 }).format(full.price);
                    },
                },
                {
                    targets: 4,
                    render: function (data, type, full, meta) {
                        return full.transport_name;
                    },
                },
                {
                    targets: 5,
                    render: function (data, type, full, meta) {
                        var html = `
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-warning" onclick="editTravelRoute('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    <i class="bx bx-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-info" onclick="detailTravelRoute('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-danger" onclick="deleteTravelRoute('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </div>
                        `;
                        return html;
                    },
                }
            ],
            fnCreatedRow: function (nRow, aData, iDataIndex) {
                $(nRow).attr("id", aData[0]);
            },
            fnInitComplete: function (oSettings, data) {
                var debounceTimer;
                $("#searchTravelRoute").on("input", function () {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(function () {
                        initTableTravelRoute
                            .search($("#searchTravelRoute").val())
                            .draw();
                    }, 300);
                });
                if (initTableTravelRoute.state.loaded()) {
                    $("#searchTravelRoute").val(
                        initTableTravelRoute.state.loaded().search.search
                    );
                }
                resolve(true);
            },
        });
    });
}

getDataSelect = () => {
    HELPER.ajax({
        url: HELPER.api.getDataSelect,
        data: {
            _token: $('[name="_token"]').val()
        },
        type: 'POST',
        success: (response) => {
            HELPER.setDataMultipleCombo([{
                data: response.transport,
                el: 'transport-id',
                valueField: 'id_transportasi',
                displayField: 'nama',
                placeholder: 'Select Transport Name'
            },
        ]);
        },
        error: (err) => {
            HELPER.showMessage({
                success: false,
                title: 'Failed',
                message: 'System error, please contact the Administrator'
            });
        }
    })
}

toggleAddTravelRoute = (show) => {
    if (show) {
        $("#modal-add-travel-route").modal("show");
        formValidationAddTravelRoute();
    } else {
        $("#modal-add-travel-route").modal("hide");
        $('#travel-route-objective').val('');
        $('#travel-route-objective-airport').val('');
        $('#travel-route-first-route').val('');
        $('#travel-route-first-route-airport').val('');
        $('#transport-id').val('');
        $('#travel-route-price').val('');
        $('#travel-route-departure-date').val('');
        $('#travel-route-departure-time').val('');
        $('#travel-route-arrival-time').val('');
        $('#id').val('');
        $('#title-form-travel-route').text('Add Travel Route');
        if(validatorAddTravelRoute){
            validatorAddTravelRoute.resetForm();
        }
    }
}

toggleDetailTravelRoute = (show) => {
    if (show) {
        $("#modal-detail-travel-route").modal("show");
    } else {
        $("#modal-detail-travel-route").modal("hide");
        $('#title-form-travel-route').text('Add Travel Route');
    }
}

var validatorAddTravelRoute;

formValidationAddTravelRoute = () => {
    const form = document.getElementById('form-add-travel-route');
    const submitButton = document.getElementById('btn-save-travel-route');

    if (!form) {
        console.error('Form #form-add-travel-route not found');
        return;
    }

    if (!submitButton) {
        console.error('Button #btn-save-travel-route not found');
        return;
    }

    if (validatorAddTravelRoute) {
        validatorAddTravelRoute.destroy();
    }

    validatorAddTravelRoute = FormValidation.formValidation(
        form,
        {
            fields: {
                'travel-route-objective': {
                    validators: {
                        notEmpty: {
                            message: 'Objective City is required'
                        }
                    }
                },
                'travel-route-objective-airport': {
                    validators: {
                        notEmpty: {
                            message: 'Objective Airport is required'
                        }
                    }
                },
                'travel-route-first-route': {
                    validators: {
                        notEmpty: {
                            message: 'Departure City is required'
                        }
                    }
                },
                'travel-route-first-route-airport': {
                    validators: {
                        notEmpty: {
                            message: 'Departure Airport is required'
                        }
                    }
                },
                'transport-id': {
                    validators: {
                        notEmpty: {
                            message: 'Transport is required'
                        }
                    }
                },
                'travel-route-price': {
                    validators: {
                        notEmpty: {
                            message: 'Price is required'
                        }
                    }
                },
                'travel-route-departure-date': {
                    validators: {
                        notEmpty: {
                            message: 'Departure Date is required'
                        }
                    }
                },
                'travel-route-departure-time': {
                    validators: {
                        notEmpty: {
                            message: 'Departure Time is required'
                        }
                    }
                },
                'travel-route-arrival-time': {
                    validators: {
                        notEmpty: {
                            message: 'Arrival Time is required'
                        }
                    }
                },
            },

            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: '.fv-row',
                    eleInvalidClass: '',
                    eleValidClass: ''
                })
            }
        }
    );

    form.removeEventListener('submit', handleSubmitFormTravelRoute);

    form.addEventListener('submit', handleSubmitFormTravelRoute);
}

function handleSubmitFormTravelRoute(e) {
    e.preventDefault();

    if (validatorAddTravelRoute) {
        validatorAddTravelRoute.validate().then(function (status) {
            if (status == 'Valid') {
                if($('#id').val() != '' && $('#id').val() != null){
                    updateTravelRoute();
                } else {
                    saveTravelRoute();
                }
            }
        });
    }
}

saveTravelRoute = () => {
    var formData = new FormData();
    formData.append('objective', $('#travel-route-objective').val());
    formData.append('objective_airport', $('#travel-route-objective-airport').val());
    formData.append('departure_city', $('#travel-route-first-route').val());
    formData.append('departure_airport', $('#travel-route-first-route-airport').val());
    formData.append('id_transportasi', $('#transport-id').val());
    formData.append('price', $('#travel-route-price').val());
    formData.append('departure_date', $('#travel-route-departure-date').val());
    formData.append('departure_time', $('#travel-route-departure-time').val());
    formData.append('arrival_time', $('#travel-route-arrival-time').val());
    formData.append('_token', $('[name="_token"]').val());

    $("#modal-add-travel-route").modal("hide");
    HELPER.confirm({
        title: 'Save Travel Route',
        message: 'Are you sure you want to save this travel route?',
        callback: function (result) {
            if (result) {
                HELPER.block();
                HELPER.ajax({
                    url: HELPER.api.save,
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: (res) => {
                        initTableTravelRoute();
                        toggleAddTravelRoute(false);
                        $('#travel-route-objective').val('');
                        $('#travel-route-objective-airport').val('');
                        $('#travel-route-first-route').val('');
                        $('#travel-route-first-route-airport').val('');
                        $('#transport-id').val('');
                        $('#travel-route-price').val('');
                        $('#travel-route-departure-date').val('');
                        $('#travel-route-departure-time').val('');
                        $('#travel-route-arrival-time').val('');
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Travel Route has been saved'
                        });
                    },
                    error: (err) => {
                        toggleAddTravelRoute(false);
                        HELPER.unblock();
                        let errorMessage = err.responseJSON && err.responseJSON.message
                            ? err.responseJSON.message
                            : 'System error, please contact the Administrator';

                        HELPER.showMessage({
                            success: false,
                            title: 'Failed',
                            message: errorMessage
                        });
                    }
                });
            } else {
                $("#modal-add-travel-route").modal("show");
                formValidationAddTravelRoute();
            }
        }
    });
}

detailTravelRoute = (id) => {
    HELPER.ajax({
        url: HELPER.api.detail + '/' + id,
        type: 'get',
        data: {
            id: id,
            _token: $('[name="_token"]').val()
        },
        success: (response) => {
            $('#detail-objective').text(response.detail.objective_city);
            $('#detail-objective-airport').text(response.detail.objective_airport);
            $('#detail-first-route').text(response.detail.departure_city);
            $('#detail-first-route-airport').text(response.detail.departure_airport);
            $('#detail-departure-date').text(moment(response.detail.departure_date).format('DD MMMM YYYY'));
            $('#detail-departure-time').text(moment(response.detail.departure_time, 'HH:mm').format('hh:mm a'));
            $('#detail-arrival-time').text(moment(response.detail.arrival_time, 'HH:mm').format('hh:mm a'));
            $('#detail-price').text(`IDR. ${parseInt(response.detail.price).toLocaleString('id-ID')}`);
            toggleDetailTravelRoute(true);
        },
        error: (err) => {
            HELPER.showMessage({
                success: false,
                title: 'Failed',
                message: 'System error, please contact the Administrator'
            });
        }
    });
}

editTravelRoute = (id) => {
    HELPER.ajax({
        url: HELPER.api.edit,
        type: 'post',
        data: {
            id: id,
            _token: $('[name="_token"]').val()
        },
        success: (res) => {
            console.log(res)
            $('#title-form-travel-route').text('Edit Travel Route');
            $('#id').val(res.id_rute);
            $('#travel-route-objective').val(res.tujuan);
            $('#travel-route-objective-airport').val(res.tujuan_bandara);
            $('#travel-route-first-route').val(res.rute_awal);
            $('#travel-route-first-route-airport').val(res.rute_awal_bandara);
            $('#travel-route-price').val(res.harga);
            $('#travel-route-departure-date').val(res.tanggal_berangkat);
            $('#travel-route-departure-time').val(res.jam_berangkat);
            $('#travel-route-arrival-time').val(res.jam_tiba);
            $('#transport-id').val(res.id_transportasi).trigger('change');
            toggleAddTravelRoute(true);
        },
        error: (err) => {
            HELPER.showMessage({
                success: false,
                title: 'Failed',
                message: 'System error, please contact the Administrator'
            });
        }
    });
}

updateTravelRoute = () => {
    var formData = new FormData();
    formData.append('objective', $('#travel-route-objective').val());
    formData.append('objective_airport', $('#travel-route-objective-airport').val());
    formData.append('departure_city', $('#travel-route-first-route').val());
    formData.append('departure_airport', $('#travel-route-first-route-airport').val());
    formData.append('id_transportasi', $('#transport-id').val());
    formData.append('price', $('#travel-route-price').val());
    formData.append('departure_date', $('#travel-route-departure-date').val());
    formData.append('departure_time', $('#travel-route-departure-time').val());
    formData.append('arrival_time', $('#travel-route-arrival-time').val());
    formData.append('_token', $('[name="_token"]').val());
    formData.append('id_rute', $('#id').val());

    $("#modal-add-travel-route").modal("hide");
    HELPER.confirm({
        title: 'Update Travel Route',
        message: 'Are you sure you want to update this travel route?',
        callback: function (result) {
            if (result) {
                HELPER.block();
                HELPER.ajax({
                    url: HELPER.api.update,
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: (res) => {
                        initTableTravelRoute();
                        toggleAddTravelRoute(false);
                        $('#id').val('');
                        $('#travel-route-objective').val('');
                        $('#travel-route-objective-airport').val('');
                        $('#travel-route-first-route').val('');
                        $('#travel-route-first-route-airport').val('');
                        $('#transport-id').val('');
                        $('#travel-route-price').val('');
                        $('#travel-route-departure-date').val('');
                        $('#travel-route-departure-time').val('');
                        $('#travel-route-arrival-time').val('');
                        $('#title-form-travel-route').text('Add Travel Route');
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Travel Route has been updated'
                        })
                    },
                    error: (err) => {
                        toggleAddTravelRoute(false);
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: false,
                            title: 'Failed',
                            message: 'System error, please contact the Administrator'
                        });
                    }
                });
            } else {
                $("#modal-add-travel-route").modal("show");
                formValidationAddTravelRoute();
            }
        }
    });
}

deleteTravelRoute = (id) => {
    HELPER.confirm({
        title: 'Delete Travel Route',
        message: 'Are you sure you want to delete this travel route?',
        callback: function (result) {
            if (result) {
                HELPER.block();
                HELPER.ajax({
                    url: HELPER.api.delete,
                    type: 'post',
                    data: {
                        id: id,
                        _token: $('[name="_token"]').val()
                    },
                    success: (res) => {
                        initTableTravelRoute();
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Travel Route has been deleted'
                        })
                    },
                    error: (err) => {
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: false,
                            title: 'Failed',
                            message: 'System error, please contact the Administrator'
                        });
                    }
                });
            }
        }
    });
}
