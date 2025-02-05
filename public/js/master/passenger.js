$(() => {
    HELPER.api = {
        table: APP_URL + "master/passenger/table",
        detail: APP_URL + "master/passenger/detail",
        delete: APP_URL + "master/passenger/delete",
    };

    init();
});

init = async () => {
    await HELPER.block();
    await initTablePassenger();
    await HELPER.unblock();
};

initTablePassenger = () => {
    return new Promise((resolve, reject) => {
        var initTablePassenger = HELPER.initTable({
            el: "passenger-table",
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
                    data: "email",
                    searchable: true,
                    orderable: true,
                    className: "align-middle",
                },
                {
                    data: "address",
                    searchable: true,
                    orderable: true,
                    className: "align-middle",
                },
                {
                    data: "telephone",
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
                        return full.email;
                    },
                },             
                {
                    targets: 3,
                    render: function (data, type, full, meta) {
                        return full.address;
                    },
                },                                       
                {
                    targets: 4,
                    render: function (data, type, full, meta) {
                        return full.telephone;
                    },
                },             
                {
                    targets: 5,
                    render: function (data, type, full, meta) {
                        var html = `
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-danger" onclick="deletePassenger('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
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
                $(nRow).on('click', function () {
                    detailPassenger(aData.id);
                });
            },
            fnInitComplete: function (oSettings, data) {
                var debounceTimer;
                $("#searchPassenger").on("input", function () {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(function () {
                        initTablePassenger
                            .search($("#searchPassenger").val())
                            .draw();
                    }, 300);
                });
                if (initTablePassenger.state.loaded()) {
                    $("#searchPassenger").val(
                        initTablePassenger.state.loaded().search.search
                    );
                }
                resolve(true);
            },
        });
    });
}

toggleDetailPassenger = (show) => {
    if (show) {
        $("#modal-detail-passenger").modal("show");
    } else {
        $("#modal-detail-passenger").modal("hide");
        $('#title-form-passenger').text('Detail Passenger');
    }
}

detailPassenger = (id) => {
    HELPER.ajax({
        url: HELPER.api.detail + '/' + id,
        type: 'get',
        data: {
            id: id,
            _token: $('[name="_token"]').val()
        },
        success: (response) => {
            $('#detail-name').text(response.detail.name);
            $('#detail-username').text(response.detail.username);
            $('#detail-email').text(response.detail.email);
            $('#detail-telephone').text(response.detail.telephone);
            $('#detail-address').text(response.detail.address);
            $('#detail-gender').text(response.detail.gender);
            $('#detail-birth-date').text(response.detail.birth_date);
            toggleDetailPassenger(true);
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

deletePassenger = (id) => {
    HELPER.confirm({
        title: 'Delete Passenger',
        message: 'Are you sure you want to delete this passenger?',
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
                        initTablePassenger();
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Passenger has been deleted'
                        })
                    },
                    error: (err) => {
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Passenger has been deleted',
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