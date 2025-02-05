$(() => {
    HELPER.api = {
        table: APP_URL + "master/transportation/table",
        save: APP_URL + "master/transportation/store",
        detail: APP_URL + "master/transportation/detail",
        edit: APP_URL + "master/transportation/edit",
        update: APP_URL + "master/transportation/update",
        delete: APP_URL + "master/transportation/delete",
        getDataSelect: APP_URL + "master/transportation/get-data-select",

        tableTransportType: APP_URL + "master/transport-type/table",
        saveTransportType: APP_URL + "master/transport-type/store",
        detailTransportType: APP_URL + "master/transport-type/detail",
        editTransportType: APP_URL + "master/transport-type/edit",
        updateTransportType: APP_URL + "master/transport-type/update",
        deleteTransportType: APP_URL + "master/transport-type/delete",
    };

    init();
});

init = async () => {
    await HELPER.block();
    await getDataSelect();
    await initTableTransportation();
    await formValidationAddTransport();
    await HELPER.unblock();
};

initTableTransportation = () => {
    return new Promise((resolve, reject) => {
        var initTableTransportation = HELPER.initTable({
            el: "transportation-table",
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
                    data: "kode",
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
                    data: "type_name",
                    searchable: true,
                    orderable: true,
                    className: "align-middle",
                },
                {
                    data: "keterangan",
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
                        return full.kode;
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
                        return full.type_name;
                    },
                },             
                {
                    targets: 4,
                    render: function (data, type, full, meta) {
                        return full.keterangan.length > 40 ? full.keterangan.substring(0, 40) + '...' : full.keterangan;
                    },
                },             
                {
                    targets: 5,
                    render: function (data, type, full, meta) {
                        var html = `
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-warning" onclick="editTransport('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    <i class="bx bx-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-info" onclick="detailTransport('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-danger" onclick="deleteTransport('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
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
                $("#searchTransportation").on("input", function () {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(function () {
                        initTableTransportation
                            .search($("#searchTransportation").val())
                            .draw();
                    }, 300);
                });
                if (initTableTransportation.state.loaded()) {
                    $("#searchTransportation").val(
                        initTableTransportation.state.loaded().search.search
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
                data: response.transport_type,
                el: 'transport-type',
                valueField: 'id_type_transportasi',
                displayField: 'nama_type_transportasi',
                placeholder: 'Select Transport Type'
            },
            {
                data: response.transport_class,
                el: 'transport-class',
                valueField: 'id',
                displayField: 'name',
                placeholder: 'Select Transport Class'
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

toggleAddTransport = (show) => {
    if (show) {
        $("#modal-add-transport").modal("show");
        formValidationAddTransport();
    } else {
        $("#modal-add-transport").modal("hide");
        $('#transport-name').val('');
        $('#transport-code').val('');
        $('#transport-type').val('');
        $('#transport-class').val('');
        $('#transport-description').val('');
        $('#total-seat').val('');
        $('#id').val('');
        $('#title-form-transport').text('Add Transportation');
        if(validatorAddTransport){
            validatorAddTransport.resetForm();
        }
    }
}

toggleDetailTransport = (show) => {
    if (show) {
        $("#modal-detail-transport").modal("show");
    } else {
        $("#modal-detail-transport").modal("hide");
        $('#title-form-transport').text('Add Transportation');
    }
}

var validatorAddTransport;

formValidationAddTransport = () => {
    const form = document.getElementById('form-add-transport');
    const submitButton = document.getElementById('btn-save-transport');

    if (!form) {
        console.error('Form #form-add-transport not found');
        return;
    }
    
    if (!submitButton) {
        console.error('Button #btn-save-transport not found');
        return;
    }

    if (validatorAddTransport) {
        validatorAddTransport.destroy();
    }

    validatorAddTransport = FormValidation.formValidation(
        form,
        {
            fields: {
                'transport-name': {
                    validators: {
                        notEmpty: {
                            message: 'Name is required'
                        }
                    }
                },
                'transport-code': {
                    validators: {
                        notEmpty: {
                            message: 'Code is required'
                        }
                    }
                },
                'transport-type': {
                    validators: {
                        notEmpty: {
                            message: 'Transport Type is required'
                        }
                    }
                },
                'transport-class': {
                    validators: {
                        notEmpty: {
                            message: 'Transport Class is required'
                        }
                    }
                },
                'total-seat': {
                    validators: {
                        notEmpty: {
                            message: 'Total Seat is required'
                        },
                        integer: {
                            message: 'This field must be Number'
                        }
                    }
                },
                'transport-description': {
                    validators: {
                        notEmpty: {
                            message: 'Description is required'
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

    form.removeEventListener('submit', handleSubmitFormTransport);

    form.addEventListener('submit', handleSubmitFormTransport);
}

function handleSubmitFormTransport(e) {
    e.preventDefault();

    if (validatorAddTransport) {
        validatorAddTransport.validate().then(function (status) {
            if (status == 'Valid') {
                if($('#id').val() != '' && $('#id').val() != null){
                    updateTransport();
                } else {
                    saveTransport();
                }
            }
        });
    }
}

saveTransport = () => {
    var formData = new FormData();
    formData.append('name', $('#transport-name').val());
    formData.append('kode', $('#transport-code').val());
    formData.append('id_type_transportasi', $('#transport-type').val());
    formData.append('class_id', $('#transport-class').val());
    formData.append('jumlah_kursi', $('#total-seat').val());
    formData.append('keterangan', $('#transport-description').val());
    formData.append('_token', $('[name="_token"]').val());

    $("#modal-add-transport").modal("hide");
    HELPER.confirm({
        title: 'Save Transportation',
        message: 'Are you sure you want to save this transport?',
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
                        initTableTransportation();
                        toggleAddTransport(false);
                        $('#transport-name').val('');
                        $('#transport-code').val('');
                        $('#transport-type').val('');
                        $('#transport-class').val('');
                        $('#total-seat').val('');
                        $('#transport-description').val('');
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Transportation has been saved'
                        });
                    },
                    error: (err) => {
                        toggleAddTransport(false);
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: false,
                            title: 'Failed',
                            message: 'System error, please contact the Administrator'
                        });
                    }
                });
            } else {
                $("#modal-add-transport").modal("show");
                formValidationAddTransport();
            }
        }
    });
}

detailTransport = (id) => {
    HELPER.ajax({
        url: HELPER.api.detail + '/' + id,
        type: 'get',
        data: {
            id: id,
            _token: $('[name="_token"]').val()
        },
        success: (response) => {
            $('#detail-name').text(response.detail.name);
            $('#detail-code').text(response.detail.kode);
            $('#detail-type').text(response.detail.type_name);
            $('#detail-class').text(response.detail.class_name);
            $('#detail-total-seat').text(response.detail.jumlah_kursi);
            $('#detail-description').text(response.detail.keterangan);
            toggleDetailTransport(true);
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

editTransport = (id) => {
    HELPER.ajax({
        url: HELPER.api.edit,
        type: 'post',
        data: {
            id: id,
            _token: $('[name="_token"]').val()
        },
        success: (res) => {
            console.log(res)
            $('#title-form-transport').text('Edit Transportation');
            $('#id').val(res.id_transportasi);
            $('#transport-name').val(res.nama);
            $('#transport-code').val(res.kode);
            $('#transport-description').val(res.keterangan);
            $('#total-seat').val(res.jumlah_kursi);
            $('#transport-type').val(res.id_type_transportasi).trigger('change');
            $('#transport-class').val(res.class_id).trigger('change');
            toggleAddTransport(true);
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

updateTransport = () => {
    var formData = new FormData();
    formData.append('name', $('#transport-name').val());
    formData.append('kode', $('#transport-code').val());
    formData.append('id_type_transportasi', $('#transport-type').val());
    formData.append('class_id', $('#transport-class').val());
    formData.append('jumlah_kursi', $('#total-seat').val());
    formData.append('keterangan', $('#transport-description').val());
    formData.append('id_transportasi', $('#id').val());
    formData.append('_token', $('[name="_token"]').val());

    $("#modal-add-transport").modal("hide");
    HELPER.confirm({
        title: 'Update Transportation',
        message: 'Are you sure you want to update this transport?',
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
                        initTableTransportation();
                        toggleAddTransport(false);
                        $('#transport-name').val('');
                        $('#transport-code').val('');
                        $('#transport-type').val('');
                        $('#transport-class').val('');
                        $('#total-seat').val('');
                        $('#transport-description').val('');
                        $('#title-form-transport').text('Add Transportation');
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Transportation has been updated'
                        })
                    },
                    error: (err) => {
                        toggleAddTransport(false);
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: false,
                            title: 'Failed',
                            message: 'System error, please contact the Administrator'
                        });
                    }
                });
            } else {
                $("#modal-add-transport").modal("show");
                formValidationAddTransport();
            }
        }
    });
}

deleteTransport = (id) => {
    HELPER.confirm({
        title: 'Delete Transportation',
        message: 'Are you sure you want to delete this transportation?',
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
                        initTableTransportation();
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Transportation has been deleted'
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

toggleModalAddTransportType = (show) => {
    if (show) {
        $("#modal-add-transport").modal("hide");
        $("#modal-add-transport").on("hidden.bs.modal", function () {
            $("#modal-add-transport-type").modal("show");
            formValidationAddTransportType();
            initTableTransportType();
            $(this).off("hidden.bs.modal");
        });
    } else {
        $("#modal-add-transport-type").modal("hide");
        $("#modal-title").text("Add Transportation Type");
        $('#transport-type-name').val('');
        $('#transport-type-description').val('');
        if (validatorAddTransportType) {
            validatorAddTransportType.resetForm();
        }
    }
};

toggleDetailTransportType = (show) => {
    if (show) {
        $("#modal-detail-type-transport").modal("show");
    } else {
        $("#modal-detail-type-transport").modal("hide");
        $('#title-form-type-transport').text('Add Transportation Type');
    }
}

var validatorAddTransportType;

formValidationAddTransportType = () => {
    const form = document.getElementById('form-add-transport-type');
    const submitButton = document.getElementById('btn-save-transport-type');

    if (validatorAddTransportType) {
        validatorAddTransportType.destroy();
    }

    validatorAddTransportType = FormValidation.formValidation(
        form,
        {
            fields: {
                'transport-type-name': {
                    validators: {
                        notEmpty: {
                            message: 'Name is required'
                        }
                    }
                },
                'transport-type-description': {
                    validators: {
                        notEmpty: {
                            message: 'Name is required'
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

    submitButton.removeEventListener('click', handleSubmitFormTransportType);

    submitButton.addEventListener('click', handleSubmitFormTransportType);
}

function handleSubmitFormTransportType(e) {
    e.preventDefault();

    if (validatorAddTransportType) {
        validatorAddTransportType.validate().then(function (status) {
            if (status == 'Valid') {
                if($('#id_transport_type').val() != '' && $('#id_transport_type').val() != null){
                    updateTransportType();
                } else {
                    saveTransportType();
                }
            }
        });
    }
}

saveTransportType = () => {
    var formData = new FormData();
    formData.append('name', $('#transport-type-name').val());
    formData.append('keterangan', $('#transport-type-description').val());
    formData.append('_token', $('[name="_token"]').val());

    $("#modal-add-transport-type").modal("hide");
    HELPER.confirm({
        title: 'Save Transportation Type',
        message: 'Are you sure you want to save this transport type?',
        callback: function (result) {
            if (result) {
                HELPER.block();
                HELPER.ajax({
                    url: HELPER.api.saveTransportType,
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: (res) => {
                        getDataSelect();
                        toggleModalAddTransportType(true);
                        initTableTransportType();
                        initTableTransportation();
                        $('#transport-type-name').val('');
                        $('#transport-type-description').val('');
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Transportation Type has been saved'
                        })
                    },
                    error: (err) => {
                        toggleModalAddTransportType(false);
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: false,
                            title: 'Failed',
                            message: 'System error, please contact the Administrator'
                        });
                    }
                });
            } else {
                $("#modal-add-transport-type").modal("show");
                formValidationAddTransportType();
            }
        }
    });
}

initTableTransportType = () => {
    return new Promise((resolve, reject) => {
        var initTableTransportType = HELPER.initTable({
            el: "transport-type-table",
            url: HELPER.api.tableTransportType,
            data: {
                _token: $('[name="_token"]').val()
            },
            clickAble: false,
            index: 0,
            sorting: "desc",
            destroyAble: true,
            responsive: false,
            pageLength: 5,
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
                    width: "5%",
                },
                {
                    data: "name",
                    searchable: true,
                    orderable: true,
                },
                {
                    data: "id",
                    searchable: false,
                    orderable: false,
                },
            ],
            columnDefs: [
                {
                    orderable: true,
                    targets: [0, 2],
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
                        return `
                            <div>
                                <div>${full.name}</div>
                            </div>
                        `;
                    },
                },                
                {
                    targets: 2,
                    render: function (data, type, full, meta) {
                        var html = `
                            <button type="button" class="btn btn-sm btn-icon btn-outline btn-outline-warning" onclick="EditTransportType('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Transportation Type">
                                <i class="ki-outline ki-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-icon btn-outline btn-outline-info" onclick="detailTransportType('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-icon btn-outline btn-outline-danger" onclick="deleteTransportType('${full.id}')">
                                <i class="ki-outline ki-trash"></i>
                            </button>
                        `

                        return html;
                    },
                },
            ],
            fnCreatedRow: function (nRow, aData, iDataIndex) {
                $(nRow).attr("id", aData[0]);
            },
            fnInitComplete: function (oSettings, data) {
                var debounceTimer;
                $("#searchTransportType").on("input", function () {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(function () {
                        initTableTransportType
                            .search($("#searchTransportType").val())
                            .draw();
                    }, 300);
                });
                if (initTableTransportType.state.loaded()) {
                    $("#searchTransportType").val(
                        initTableTransportType.state.loaded().search.search
                    );
                }
                resolve(true);
            },
        });
    });
}

detailTransportType = (id) => {
    HELPER.ajax({
        url: HELPER.api.detailTransportType + '/' + id,
        type: 'get',
        data: {
            id: id,
            _token: $('[name="_token"]').val()
        },
        success: (response) => {
            $('#detail-type-name').text(response.detail.name);
            $('#detail-type-description').text(response.detail.description);
            toggleDetailTransportType(true);
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

EditTransportType = (id) => {
    HELPER.ajax({
        url: HELPER.api.editTransportType,
        type: 'post',
        data: {
            id: id,
            _token: $('[name="_token"]').val()
        },
        success: (res) => {
            $('#modal-title').text('Edit Transportation Type');
            $('#id_transport_type').val(res.id_type_transportasi);
            $('#transport-type-name').val(res.nama_type_transportasi);
            $('#transport-type-description').val(res.keterangan);
            toggleModalAddTransportType(true);
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

updateTransportType = () => {
    var formData = new FormData();
    formData.append('name', $('#transport-type-name').val());
    formData.append('keterangan', $('#transport-type-description').val());
    formData.append('id', $('#id_transport_type').val());
    formData.append('_token', $('[name="_token"]').val());

    $("#modal-add-transport-type").modal("hide");
    HELPER.confirm({
        title: 'Update Transportation Type',
        message: 'Are you sure you want to update this transport type?',
        callback: function (result) {
            if (result) {
                HELPER.block();
                HELPER.ajax({
                    url: HELPER.api.updateTransportType,
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: (res) => {
                        getDataSelect();
                        toggleModalAddTransportType(true);
                        initTableTransportType();
                        initTableTransportation();
                        $('#id_transport_type').val('');
                        $('#transport-type-name').val('');
                        $('#transport-type-description').val('');
                        $('#modal-title').text('Add Transportation Type');
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Transportation Type has been updated'
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
            } else {
                $("#modal-add-transport-type").modal("show");
                formValidationAddTransportType();
            }
        }
    });
}

deleteTransportType = (id) => {
    $("#modal-add-transport-type").modal("hide");
    HELPER.confirm({
        title: 'Delete Transportation Type',
        message: 'Are you sure you want to delete this transport type?',
        callback: function (result) {
            if (result) {
                HELPER.block();
                HELPER.ajax({
                    url: HELPER.api.deleteTransportType,
                    type: 'post',
                    data: {
                        id: id,
                        _token: $('[name="_token"]').val()
                    },
                    success: (res) => {
                        getDataSelect();
                        toggleModalAddTransportType(true);
                        initTableTransportType();
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Transportation Type has been deleted'
                        });
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
            } else {
                $("#modal-add-transport-type").modal("show");
                formValidationAddTransportType();
            }
        }
    });
}