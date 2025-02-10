$(() => {
    HELPER.api = {
        table: APP_URL + "master/destination/table",
        save: APP_URL + "master/destination/store",
        detail: APP_URL + "master/destination/detail",
        edit: APP_URL + "master/destination/edit",
        update: APP_URL + "master/destination/update",
        delete: APP_URL + "master/destination/delete",
    };

    init();
});

init = async () => {
    await HELPER.block();
    await initTableDestination();
    await formValidationAddDestination();
    await HELPER.unblock();
};

initTableDestination = () => {
    return new Promise((resolve, reject) => {
        var initTableDestination = HELPER.initTable({
            el: "destination-table",
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
                    data: "image",
                    searchable: true,
                    orderable: true,
                    className: "align-middle",
                },
                {
                    data: "name",
                    searchable: true,
                    orderable: true,
                    className: "align-middle",
                },
                {
                    data: "location",
                    searchable: true,
                    orderable: true,
                    className: "align-middle",
                },
                {
                    data: "link",
                    searchable: true,
                    orderable: false,
                    className: "align-middle",
                },
                {
                    data: "popularity",
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
                        return `<img src="/assets/img/destination/${full.image}" alt="Destination Image" width="120" height="auto" class="rounded">`;
                    },
                },                           
                {
                    targets: 2,
                    render: function (data, type, full, meta) {
                        return full.name;
                    },
                },             
                {
                    targets: 3,
                    render: function (data, type, full, meta) {
                        return full.location;
                    },
                },                                       
                {
                    targets: 4,
                    render: function (data, type, full, meta) {
                        return full.link;
                    },
                },             
                {
                    targets: 5,
                    render: function (data, type, full, meta) {
                        return full.popularity;
                    },
                },             
                {
                    targets: 6,
                    render: function (data, type, full, meta) {
                        var html = `
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-warning" onclick="editDestination('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    <i class="bx bx-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-danger" onclick="deleteDestination('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
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
                $("#searchDestination").on("input", function () {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(function () {
                        initTableDestination
                            .search($("#searchDestination").val())
                            .draw();
                    }, 300);
                });
                if (initTableDestination.state.loaded()) {
                    $("#searchDestination").val(
                        initTableDestination.state.loaded().search.search
                    );
                }
                resolve(true);
            },
        });
    });
}

toggleAddDestination = (show) => {
    if (show) {
        $("#modal-add-destination").modal("show");
        formValidationAddDestination();
    } else {
        $("#modal-add-destination").modal("hide");
        $('#destination-name').val('');
        $('#destination-location').val('');
        $('#destination-link').val('');
        $('#destination-popularity').val('');
        $('#destination-image').val('');
        $('#image-preview').attr('src', '#').addClass('d-none');
        $('#id').val('');
        $('#title-form-destination').text('Add Destination');
        if(validatorAddDestination){
            validatorAddDestination.resetForm();
        }
    }
}

var validatorAddDestination;

formValidationAddDestination = () => {
    const form = document.getElementById('form-add-destination');
    const submitButton = document.getElementById('btn-save-destination');

    if (!form) {
        console.error('Form #form-add-destination not found');
        return;
    }
    
    if (!submitButton) {
        console.error('Button #btn-save-destination not found');
        return;
    }

    if (validatorAddDestination) {
        validatorAddDestination.destroy();
    }

    validatorAddDestination = FormValidation.formValidation(
        form,
        {
            fields: {
                'destination-name': {
                    validators: {
                        notEmpty: {
                            message: 'Name is required'
                        }
                    }
                },
                'destination-location': {
                    validators: {
                        notEmpty: {
                            message: 'Location is required'
                        }
                    }
                },
                'destination-link': {
                    validators: {
                        notEmpty: {
                            message: 'Link is required'
                        }
                    }
                },
                'destination-popularity': {
                    validators: {
                        notEmpty: {
                            message: 'Priority is required'
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

    form.removeEventListener('submit', handleSubmitFormDestination);

    form.addEventListener('submit', handleSubmitFormDestination);
}

function handleSubmitFormDestination(e) {
    e.preventDefault();

    if (validatorAddDestination) {
        validatorAddDestination.validate().then(function (status) {
            if (status == 'Valid') {
                if($('#id').val() != '' && $('#id').val() != null){
                    updateDestination();
                } else {
                    saveDestination();
                }
            }
        });
    }
}

saveDestination = () => {
    var formData = new FormData();
    formData.append('name', $('#destination-name').val());
    formData.append('location', $('#destination-location').val());
    formData.append('link', $('#destination-link').val());
    formData.append('popularity', $('#destination-popularity').val());
    formData.append('image', $('#destination-image')[0].files[0]);
    formData.append('_token', $('[name="_token"]').val());

    $("#modal-add-destination").modal("hide");
    HELPER.confirm({
        title: 'Save Destination',
        message: 'Are you sure you want to save this destination?',
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
                        initTableDestination();
                        toggleAddDestination(false);
                        $('#destination-name').val('');
                        $('#destination-location').val('');
                        $('#destination-link').val('');
                        $('#destination-popularity').val('');
                        $('#destination-image').val('');
                        $('#image-preview').attr('src', '#').addClass('d-none');
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Destination has been saved'
                        });
                    },
                    error: (err) => {
                        toggleAddDestination(false);
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: false,
                            title: 'Failed',
                            message: 'System error, please contact the Administrator'
                        });
                    }
                });
            } else {
                $("#modal-add-destination").modal("show");
                formValidationAddDestination();
            }
        }
    });
}

editDestination = (id) => {
    HELPER.ajax({
        url: HELPER.api.edit,
        type: 'post',
        data: {
            id: id,
            _token: $('[name="_token"]').val()
        },
        success: (res) => {
            console.log(res)
            $('#title-form-destination').text('Edit Destination');
            $('#id').val(res.id);
            $('#destination-name').val(res.name);
            $('#destination-location').val(res.location);
            $('#destination-popularity').val(res.popularity);
            $('#destination-link').val(res.link);
            if (res.image) {
                const imageUrl = `/assets/img/destination/${res.image}`;
                $('#image-preview').attr('src', imageUrl).removeClass('d-none');
                $('#existing-image').val(res.image);
            } else {
                $('#image-preview').attr('src', '#').addClass('d-none');
                $('#existing-image').val('');
            }

            toggleAddDestination(true);
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

updateDestination = () => {
    var formData = new FormData();
    formData.append('name', $('#destination-name').val());
    formData.append('location', $('#destination-location').val());
    formData.append('link', $('#destination-link').val());
    formData.append('popularity', $('#destination-popularity').val());
    if ($('#destination-image')[0].files.length > 0) {
        formData.append('image', $('#destination-image')[0].files[0]);
    } else {
        formData.append('existing_image', $('#existing-image').val());
    }
    formData.append('_token', $('[name="_token"]').val());
    formData.append('id', $('#id').val());

    $("#modal-add-destination").modal("hide");
    HELPER.confirm({
        title: 'Update Destination',
        message: 'Are you sure you want to update this destination?',
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
                        initTableDestination();
                        toggleAddDestination(false);
                        $('#id').val('');
                        $('#destination-name').val('');
                        $('#destination-location').val('');
                        $('#destination-link').val('');
                        $('#destination-popularity').val('');
                        $('#image-preview').attr('src', '#').addClass('d-none');
                        $('#title-form-destination').text('Add Destination');
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Destination has been updated'
                        })
                    },
                    error: (err) => {
                        toggleAddDestination(false);
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: false,
                            title: 'Failed',
                            message: 'System error, please contact the Administrator'
                        });
                    }
                });
            } else {
                $("#modal-add-destination").modal("show");
                formValidationAddDestination();
            }
        }
    });
}

deleteDestination = (id) => {
    HELPER.confirm({
        title: 'Delete Destination',
        message: 'Are you sure you want to delete this destination?',
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
                        initTableDestination();
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Destination has been deleted'
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