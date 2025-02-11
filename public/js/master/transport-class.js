$(() => {
    HELPER.api = {
        table: APP_URL + "master/transport-class/table",
        save: APP_URL + "master/transport-class/store",
        edit: APP_URL + "master/transport-class/edit",
        update: APP_URL + "master/transport-class/update",
        delete: APP_URL + "master/transport-class/delete",
    };

    init();
});

init = async () => {
    await HELPER.block();
    await initTableTransportClass();
    await formValidationAddTransportClass();
    await HELPER.unblock();
};

initTableTransportClass = () => {
    return new Promise((resolve, reject) => {
        var initTableTransportClass = HELPER.initTable({
            el: "transport-class-table",
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
                    data: "name",
                    searchable: true,
                    orderable: true,
                    className: "align-middle",
                },
                {
                    data: "facilities",
                    searchable: true,
                    orderable: true,
                    className: "align-middle",
                },
                {
                    data: "facilities_detail",
                    searchable: true,
                    orderable: true,
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
                        return full.name;
                    },
                },             
                {
                    targets: 2,
                    render: function (data, type, full, meta) {
                        if (!data) return '-';
                        
                        return data.split(',').map(iconClass => `<i class="${iconClass.trim()} mx-1"></i>`).join('');
                    },
                },                                  
                {
                    targets: 3,
                    render: function (data, type, full, meta) {
                        return full.facilities_detail;
                    },
                },                                  
                {
                    targets: 4,
                    render: function (data, type, full, meta) {
                        var html = `
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-warning" onclick="editTransportClass('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    <i class="bx bx-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-danger" onclick="deleteTransportClass('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
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
                $("#searchTransportClass").on("input", function () {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(function () {
                        initTableTransportClass
                            .search($("#searchTransportClass").val())
                            .draw();
                    }, 300);
                });
                if (initTableTransportClass.state.loaded()) {
                    $("#searchTransportClass").val(
                        initTableTransportClass.state.loaded().search.search
                    );
                }
                resolve(true);
            },
        });
    });
}

toggleAddTransportClass = (show) => {
    if (show) {
        $("#modal-add-transport-class").modal("show");
        formValidationAddTransportClass();
    } else {
        $("#modal-add-transport-class").modal("hide");
        $('#transport-class-name').val('');
        $('#transport-class-facilities').val('');
        $('#transport-class-facilities-detail').val('');
        $('#id').val('');
        $('#title-form-transport-class').text('Add Transport Class');
        if(validatorAddTransportClass){
            validatorAddTransportClass.resetForm();
        }
    }
}

var validatorAddTransportClass;

formValidationAddTransportClass = () => {
    const form = document.getElementById('form-add-transport-class');
    const submitButton = document.getElementById('btn-save-transport-class');

    if (!form) {
        console.error('Form #form-add-transport-class not found');
        return;
    }
    
    if (!submitButton) {
        console.error('Button #btn-save-transport-class not found');
        return;
    }

    if (validatorAddTransportClass) {
        validatorAddTransportClass.destroy();
    }

    validatorAddTransportClass = FormValidation.formValidation(
        form,
        {
            fields: {
                'transport-class-name': {
                    validators: {
                        notEmpty: {
                            message: 'Name is required'
                        }
                    }
                },
                'transport-class-facilities': {
                    validators: {
                        notEmpty: {
                            message: 'Facilities is required'
                        }
                    }
                },
                'transport-class-facilities-detail': {
                    validators: {
                        notEmpty: {
                            message: 'Facilities detail is required'
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

    form.removeEventListener('submit', handleSubmitFormTransportClass);

    form.addEventListener('submit', handleSubmitFormTransportClass);
}

function handleSubmitFormTransportClass(e) {
    e.preventDefault();

    if (validatorAddTransportClass) {
        validatorAddTransportClass.validate().then(function (status) {
            if (status == 'Valid') {
                if($('#id').val() != '' && $('#id').val() != null){
                    updateTransportClass();
                } else {
                    saveTransportClass();
                }
            }
        });
    }
}

saveTransportClass = () => {
    var formData = new FormData();
    formData.append('name', $('#transport-class-name').val());
    formData.append('facilities', $('#transport-class-facilities').val());
    formData.append('facilities_detail', $('#transport-class-facilities-detail').val());
    formData.append('_token', $('[name="_token"]').val());

    $("#modal-add-transport-class").modal("hide");
    HELPER.confirm({
        title: 'Save Transport Class',
        message: 'Are you sure you want to save this transport class?',
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
                        initTableTransportClass();
                        toggleAddTransportClass(false);
                        $('#transport-class-name').val('');
                        $('#transport-class-facilities').val('');
                        $('#transport-class-facilities-detail').val('');
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Transport Class has been saved'
                        });
                    },
                    error: (err) => {
                        toggleAddTransportClass(false);
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: false,
                            title: 'Failed',
                            message: 'System error, please contact the Administrator'
                        });
                    }
                });
            } else {
                $("#modal-add-transport-class").modal("show");
                formValidationAddTransportClass();
            }
        }
    });
}

editTransportClass = (id) => {
    HELPER.ajax({
        url: HELPER.api.edit,
        type: 'post',
        data: {
            id: id,
            _token: $('[name="_token"]').val()
        },
        success: (res) => {
            console.log(res)
            $('#title-form-transport-class').text('Edit Transport Class');
            $('#id').val(res.id);
            $('#transport-class-name').val(res.name);
            $('#transport-class-facilities').val(res.facilities);
            $('#transport-class-facilities-detail').val(res.facilities_detail);
            toggleAddTransportClass(true);
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

updateTransportClass = () => {
    var formData = new FormData();
    formData.append('name', $('#transport-class-name').val());
    formData.append('facilities', $('#transport-class-facilities').val());
    formData.append('facilities_detail', $('#transport-class-facilities-detail').val());
    formData.append('_token', $('[name="_token"]').val());
    formData.append('id', $('#id').val());

    $("#modal-add-transport-class").modal("hide");
    HELPER.confirm({
        title: 'Update Transport Class',
        message: 'Are you sure you want to update this transport class?',
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
                        initTableTransportClass();
                        toggleAddTransportClass(false);
                        $('#id').val('');
                        $('#transport-class-name').val('');
                        $('#transport-class-facilities').val('');
                        $('#transport-class-facilities-detail').val('');
                        $('#title-form-transport-class').text('Add Transport Class');
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Transport Class has been updated'
                        })
                    },
                    error: (err) => {
                        toggleAddTransportClass(false);
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: false,
                            title: 'Failed',
                            message: 'System error, please contact the Administrator'
                        });
                    }
                });
            } else {
                $("#modal-add-transport-class").modal("show");
                formValidationAddTransportClass();
            }
        }
    });
}

deleteTransportClass = (id) => {
    HELPER.confirm({
        title: 'Delete Transport Class',
        message: 'Are you sure you want to delete this transport class?',
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
                        initTableTransportClass();
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Transport Class has been deleted'
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