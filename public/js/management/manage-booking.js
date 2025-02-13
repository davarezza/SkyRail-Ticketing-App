$(() => {
    HELPER.api = {
        table: APP_URL + "management/manage-booking/table",
        save: APP_URL + "management/manage-booking/store",
        detail: APP_URL + "management/manage-booking/detail",
        edit: APP_URL + "management/manage-booking/edit",
        update: APP_URL + "management/manage-booking/update",
        delete: APP_URL + "management/manage-booking/delete",
    };

    init();
});

init = async () => {
    await HELPER.block();
    await initTableManageBooking();
    await HELPER.unblock();
};

initTableManageBooking = () => {
    return new Promise((resolve, reject) => {
        var initTableManageBooking = HELPER.initTable({
            el: "manage-booking-table",
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
                    data: "code",
                    searchable: true,
                    orderable: true,
                    className: "align-middle",
                },
                {
                    data: "objective_city",
                    searchable: true,
                    orderable: true,
                    className: "align-middle",
                },
                {
                    data: "transport_name",
                    searchable: true,
                    orderable: true,
                    className: "align-middle",
                },
                {
                    data: "total_payment",
                    searchable: true,
                    orderable: false,
                    className: "align-middle",
                },
                {
                    data: "booking_date",
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
                        return full.code;
                    },
                },             
                {
                    targets: 2,
                    render: function (data, type, full, meta) {
                        return `${full.departure_city} → ${full.objective_city}`;
                    },
                },             
                {
                    targets: 3,
                    render: function (data, type, full, meta) {
                        return transport_name;
                    },
                },                                       
                {
                    targets: 4,
                    render: function (data, type, full, meta) {
                        return full.total_payment;
                    },
                },             
                {
                    targets: 5,
                    render: function (data, type, full, meta) {
                        var html = `
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-warning" onclick="editManageBooking('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    <i class="bx bx-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-info" onclick="detailManageBooking('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-danger" onclick="deleteManageBooking('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
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
                $("#searchManageBooking").on("input", function () {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(function () {
                        initTableManageBooking
                            .search($("#searchManageBooking").val())
                            .draw();
                    }, 300);
                });
                if (initTableManageBooking.state.loaded()) {
                    $("#searchManageBooking").val(
                        initTableManageBooking.state.loaded().search.search
                    );
                }
                resolve(true);
            },
        });
    });
}