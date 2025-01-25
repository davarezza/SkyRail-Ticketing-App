$(() => {
    HELPER.api = {
        table: APP_URL + "master/officer/table",
        save: APP_URL + "master/officer/store",
        detail: APP_URL + "master/officer/detail",
        edit: APP_URL + "master/officer/edit",
        update: APP_URL + "master/officer/update",
        delete: APP_URL + "master/officer/delete",
        // getDataSelect: APP_URL + "master/officer/get-data-select",
    };

    init();
});

init = async () => {
    await HELPER.block();
    // await getDataSelect();
    await initTableOfficer();
    // await formValidationAddOfficer();
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
                        return full.password;
                    },
                },                                       
                {
                    targets: 4,
                    render: function (data, type, full, meta) {
                        return full.email;
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