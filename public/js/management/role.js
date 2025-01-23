$(() => {
    HELPER.api = {
        table: APP_URL + "management/role/table",
        save: APP_URL + "management/role/store",
        edit: APP_URL + "management/role/edit",
        update: APP_URL + "management/role/update",
        delete: APP_URL + "management/role/delete",
    };

    init();
});
init = async () => {
    HELPER.block();
    await initTableRole();
    await HELPER.unblock(500);
};

initTableRole = () => {
    return new Promise((resolve, reject) => {
        var initTableActivityLog = HELPER.initTable({
            el: "kt_datatable_list",
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
                    width: "20%",
                },
                {
                    data: "name",
                    searchable: true,
                    orderable: true,
                    className: "align-middle",
                    width: "65%",
                },
                {
                    data: "id",
                    searchable: false,
                    orderable: false,
                    className: "align-middle",
                    width: "45%",
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
                        var html = `
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-warning" onclick="editRole('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    <i class="bx bx-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-danger" onclick="deleteRole('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                    <i class="bx bx-trash"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-primary showPermission" data-role-id="${full.id}" data-bs-toggle="tooltip" data-bs-placement="top" title="Access">
                                    <i class='bx bx-right-arrow-alt'></i>
                                </button>
                            </div>
                        `;
                        return html;
                    },
                },
            ],
            fnCreatedRow: function (nRow, aData, iDataIndex) {
                $(nRow).attr("id", aData[0]);
            },
            fnInitComplete: function (oSettings, data) {
                var debounceTimer;
                $("#searchRole").on("input", function () {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(function () {
                        initTableActivityLog
                            .search($("#searchRole").val())
                            .draw();
                    }, 300);
                });
                if (initTableActivityLog.state.loaded()) {
                    $("#searchRole").val(
                        initTableActivityLog.state.loaded().search.search
                    );
                }
                resolve(true);
            },
        });
    });
};

deleteRole = (id) => {
    HELPER.confirm({
        title: 'Delete Role',
        message: 'Are you sure you want to delete this role?',
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
                        initTableRole();
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Role has been deleted'
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
            }
        }
    });
}

toggleAddRole = (show) => {
    if (show) {
        $("#modalHakAkses").modal("show");
        formValidationAddRole();
    } else {
        $("#modalHakAkses").modal("hide");
        $('#name-role').val('');
        $('#id').val('');
        $('#title-form-role').text('Tambah Role');
        if(validatorAddRole){
            validatorAddRole.resetForm();
        }
    }
}

var validatorAddRole;

formValidationAddRole = () => {
    const form = document.getElementById('form-add-role');
    const submitButton = document.getElementById('btn-save-role');

    if (validatorAddRole) {
        validatorAddRole.destroy();
    }

    validatorAddRole = FormValidation.formValidation(
        form,
        {
            fields: {
                'name-role': {
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

    submitButton.removeEventListener('click', handleSubmitFormRole);

    submitButton.addEventListener('click', handleSubmitFormRole);
}

function handleSubmitFormRole(e) {
    e.preventDefault();

    if (validatorAddRole) {
        validatorAddRole.validate().then(function (status) {
            if (status == 'Valid') {
                if($('#id').val() != '' && $('#id').val() != null){
                    updateRole();
                } else {
                    saveRole();
                }
            }
        });
    }
}

saveRole = () => {
    var formData = new FormData();
    formData.append('name', $('#name-role').val());
    formData.append('_token', $('[name="_token"]').val());

    $("#modalHakAkses").modal("hide");
    HELPER.confirm({
        title: 'Save Role',
        message: 'Are you sure you want to save this role?',
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
                        initTableRole();
                        toggleAddRole(false);
                        $('#name-role').val('');
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Role has been saved'
                        })
                    },
                    error: (err) => {
                        toggleAddRole(false);
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
                $("#modalHakAkses").modal("show");
                formValidationAddRole();
            }
        }
    });
}

editRole = (id) => {
    HELPER.ajax({
        url: HELPER.api.edit,
        type: 'post',
        data: {
            id: id,
            _token: $('[name="_token"]').val()
        },
        success: (res) => {
            console.log(res)
            $('#title-form-role').text('Edit Role');
            $('#id').val(id);
            $('#name-role').val(res.name);
            toggleAddRole(true);
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

updateRole = () => {
    var formData = new FormData();
    formData.append('name', $('#name-role').val());
    formData.append('id', $('#id').val());
    formData.append('_token', $('[name="_token"]').val());

    $("#modal-add-role").modal("hide");
    HELPER.confirm({
        title: 'Update Role',
        message: 'Are you sure you want to update this role?',
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
                        toggleAddRole(false);
                        initTableRole();
                        $('#name-role').val('');
                        $('#title-form-role').text('Tambah Role');
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Role has been updated'
                        })
                    },
                    error: (err) => {
                        toggleAddRole(false);
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
                $("#modal-add-role").modal("show");
                formValidationAddRole();
            }
        }
    });
}