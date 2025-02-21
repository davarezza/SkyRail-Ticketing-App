$(() => {
    HELPER.api = {
        table: APP_URL + "management/manage-booking/table",
        save: APP_URL + "management/manage-booking/store",
        detail: APP_URL + "management/manage-booking/detail",
        delete: APP_URL + "management/manage-booking/delete",
        verify: APP_URL + "management/manage-booking/verify",
        exportExcel: APP_URL + "management/manage-booking/export-excel",
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
                        return full.transport_name;
                    },
                },
                {
                    targets: 4,
                    render: function (data, type, full, meta) {
                        return 'IDR ' + new Intl.NumberFormat('id-ID', { minimumFractionDigits: 0 }).format(full.total_payment);
                    },
                },
                {
                    targets: 5,
                    render: function (data, type, full, meta) {
                        let statusText = "";
                        let badgeClass = "";

                        switch (full.status) {
                            case "draft":
                                statusText = "Draft";
                                badgeClass = "text-secondary border border-secondary bg-secondary bg-opacity-10 px-3 py-1 rounded-pill";
                                break;
                            case "select_seat":
                                statusText = "Select Seat";
                                badgeClass = "text-info border border-info bg-info bg-opacity-10 px-3 py-1 rounded-pill";
                                break;
                            case "waiting_payment":
                                statusText = "Waiting Payment";
                                badgeClass = "text-warning border border-warning bg-warning bg-opacity-10 px-3 py-1 rounded-pill";
                                break;
                            case "paid":
                                statusText = "Paid";
                                badgeClass = "text-success border border-success bg-success bg-opacity-10 px-3 py-1 rounded-pill";
                                break;
                            case "verified":
                                statusText = "Verified";
                                badgeClass = "text-primary border border-primary bg-primary bg-opacity-10 px-2 py-1 rounded-pill";
                                break;
                            case "expired":
                                statusText = "Expired";
                                badgeClass = "text-danger border border-danger bg-danger bg-opacity-10 px-3 py-1 rounded-pill";
                                break;
                            default:
                                statusText = "Unknown";
                                badgeClass = "text-danger border border-danger bg-danger bg-opacity-10 px-3 py-1 rounded-pill";
                        }

                        return `<span class="${badgeClass}">${statusText}</span>`;
                    },
                },
                {
                    targets: 6,
                    render: function (data, type, full, meta) {
                        let verifyButton = (hasVerify && full.status === "paid")
                            ? `
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-success"
                                        onclick="verifyManageBooking('${full.id}')"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Verify">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                            `
                            : '';

                        let deleteButton = (full.status === "expired")
                            ? `
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-danger"
                                        onclick="deleteManageBooking('${full.id}')"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            `
                            : '';

                        let html = `
                            <div class="d-flex justify-content-center gap-2">
                                ${verifyButton}
                                <a class="btn btn-sm btn-icon btn-outline btn-outline-info"
                                    href="${APP_URL}management/manage-booking/detail/${full.id}"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                ${deleteButton}
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

deleteManageBooking = (id) => {
    HELPER.confirm({
        title: 'Delete Booking',
        message: 'Are you sure you want to delete this booking?',
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
                        initTableManageBooking();
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Booking has been deleted'
                        })
                    },
                    error: (err) => {
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Booking has been deleted',
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

verifyManageBooking = (id) => {
    HELPER.confirm({
        title: 'Verify Manage Booking',
        message: 'Are you sure you want to verify this booking? Please check the booking detail first.',
        callback: function (result) {
            if (result) {
                HELPER.block();
                HELPER.ajax({
                    url: HELPER.api.verify,
                    type: 'post',
                    data: {
                        id: id,
                        _token: $('[name="_token"]').val()
                    },
                    success: (res) => {
                        initTableManageBooking();
                        HELPER.unblock();
                        HELPER.showMessage({
                            success: true,
                            title: 'Success',
                            message: 'Manage booking has been deleted'
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

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function exportToExcel() {
        $.ajax({
            url: HELPER.api.exportExcel,
            method: 'POST',
            xhrFields: {
                responseType: 'blob'
            },
            success: function(response) {
                const blob = new Blob([response], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });

                let fileName = "Booking_Report.xlsx";

                const link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = fileName;
                link.click();
            },
            error: function(response) {
                console.log('Error generating Excel file', response);
            }
        });
    }

    $('#exportExcel').on('click', function(e) {
        e.preventDefault();
        exportToExcel();
    });
});
