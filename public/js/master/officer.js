$(() => {
    HELPER.api = {
        table: APP_URL + "master/officer/table",
        save: APP_URL + "master/officer/store",
        detail: APP_URL + "master/officer/detail",
        edit: APP_URL + "master/officer/edit",
        update: APP_URL + "master/officer/update",
        delete: APP_URL + "master/officer/delete",
        getDataSelect: APP_URL + "master/officer/get-data-select",
    };

    init();
});

init = async () => {
    await HELPER.block();
    await getDataSelect();
    await initTableOfficer();
    await formValidationAddOfficer();
    await HELPER.unblock();
};

initTableOfficer = () => {
    return new Promise((resolve, reject) => {
        var initTableOfficer = HELPER.initTable({
            el: "officer-table",
            url: HELPER.api.table,
            data: {
                _token: $('[name="_token"]').val(),
            },
            clickAble: true,
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
                    data: "username",
                    searchable: true,
                    orderable: true,
                    className: "align-middle",
                },
                {
                    data: "password",
                    searchable: true,
                    orderable: true,
                    className: "align-middle",
                },
                {
                    data: "email",
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
                        return full.name;
                    },
                },             
                {
                    targets: 2,
                    render: function (data, type, full, meta) {
                        return full.username;
                    },
                },             
                {
                    targets: 3,
                    render: function (data, type, full, meta) {
                        return full.email;
                    },
                },                                       
                {
                    targets: 4,
                    render: function (data, type, full, meta) {
                        return full.password;
                    },
                },             
                {
                    targets: 5,
                    render: function (data, type, full, meta) {
                        var html = `
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-warning" onclick="editOfficer('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    <i class="bx bx-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-danger" onclick="deleteOfficer('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
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
                $("#searchOfficer").on("input", function () {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(function () {
                        initTableOfficer
                            .search($("#searchOfficer").val())
                            .draw();
                    }, 300);
                });
                if (initTableOfficer.state.loaded()) {
                    $("#searchOfficer").val(
                        initTableOfficer.state.loaded().search.search
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
                data: response.role,
                el: 'role-id',
                valueField: 'id',
                displayField: 'name',
                placeholder: 'Select Level'
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

toggleAddOfficer = (show) => {
    if (show) {
        $("#modal-add-officer").modal("show");
        formValidationAddOfficer();
    } else {
        $("#modal-add-officer").modal("hide");
        $('#officer-name').val('');
        $('#officer-email').val('');
        $('#role-id').val('');
        $('#id').val('');
        $('#title-form-officer').text('Add Officer');
        if(validatorAddOfficer){
            validatorAddOfficer.resetForm();
        }
    }
}

var validatorAddOfficer;

formValidationAddOfficer = () => {
    const form = document.getElementById('form-add-officer');
    const submitButton = document.getElementById('btn-save-officer');

    if (!form) {
        console.error('Form #form-add-officer not found');
        return;
    }
    
    if (!submitButton) {
        console.error('Button #btn-save-officer not found');
        return;
    }

    if (validatorAddOfficer) {
        validatorAddOfficer.destroy();
    }

    validatorAddOfficer = FormValidation.formValidation(
        form,
        {
            fields: {
                'officer-name': {
                    validators: {
                        notEmpty: {
                            message: 'Name is required'
                        }
                    }
                },
                'officer-email': {
                    validators: {
                        notEmpty: {
                            message: 'Email is required'
                        },
                        emailAddress: {
                            message: 'The value is not a valid email address'
                        }
                    }
                },
                'role-id': {
                    validators: {
                        notEmpty: {
                            message: 'Transport is required'
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

    form.removeEventListener('submit', handleSubmitFormOfficer);

    form.addEventListener('submit', handleSubmitFormOfficer);
}

function handleSubmitFormOfficer(e) {
    e.preventDefault();

    if (validatorAddOfficer) {
        validatorAddOfficer.validate().then(function (status) {
            if (status == 'Valid') {
                if($('#id').val() != '' && $('#id').val() != null){
                    updateOfficer();
                } else {
                    saveOfficer();
                }
            }
        });
    }
}

saveOfficer = () => {
    var formData = new FormData();
    formData.append('nama_petugas', $('#officer-name').val());
    formData.append('email', $('#officer-email').val());
    formData.append('role_id', $('#role-id').val());
    formData.append('_token', $('[name="_token"]').val());

    $("#modal-add-officer").modal("hide");
    HELPER.confirm({
        title: 'Save Officer',
        message: 'Are you sure you want to save this officer?',
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
                        initTableOfficer();
                        toggleAddOfficer(false);
                        $('#officer-name').val('');
                        $('#officer-email').val('');
                        $('#role-id').val('');
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Officer has been saved'
                        });
                    },
                    error: (err) => {
                        toggleAddOfficer(false);
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: false,
                            title: 'Failed',
                            message: 'System error, please contact the Administrator'
                        });
                    }
                });
            } else {
                $("#modal-add-officer").modal("show");
                formValidationAddOfficer();
            }
        }
    });
}

editOfficer = (id) => {
    HELPER.ajax({
        url: HELPER.api.edit,
        type: 'post',
        data: {
            id: id,
            _token: $('[name="_token"]').val()
        },
        success: (res) => {
            console.log(res)
            $('#title-form-officer').text('Edit Officer');
            $('#id').val(res.id_petugas);
            $('#officer-name').val(res.nama_petugas);
            $('#officer-email').val(res.email);
            $('#role-id').val(res.role_id).trigger('change');
            toggleAddOfficer(true);
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

updateOfficer = () => {
    var formData = new FormData();
    formData.append('nama_petugas', $('#officer-name').val());
    formData.append('email', $('#officer-email').val());
    formData.append('role_id', $('#role-id').val());
    formData.append('_token', $('[name="_token"]').val());
    formData.append('id_petugas', $('#id').val());
    formData.append('_token', $('[name="_token"]').val());

    $("#modal-add-officer").modal("hide");
    HELPER.confirm({
        title: 'Update Officer',
        message: 'Are you sure you want to update this officer?',
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
                        initTableOfficer();
                        toggleAddOfficer(false);
                        $('#id').val('');
                        $('#officer-name').val('');
                        $('#officer-email').val('');
                        $('#role-id').val('');
                        $('#title-form-officer').text('Add Officer');
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Officer has been updated'
                        })
                    },
                    error: (err) => {
                        toggleAddOfficer(false);
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: false,
                            title: 'Failed',
                            message: 'System error, please contact the Administrator'
                        });
                    }
                });
            } else {
                $("#modal-add-officer").modal("show");
                formValidationAddOfficer();
            }
        }
    });
}

deleteOfficer = (id) => {
    HELPER.confirm({
        title: 'Delete Officer',
        message: 'Are you sure you want to delete this officer?',
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
                        initTableOfficer();
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Officer has been deleted'
                        })
                    },
                    error: (err) => {
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Officer has been deleted',
                            callback: function () {
                                location.reload();
                            }
                        });
                    }
                });
            }
        }
    });
}