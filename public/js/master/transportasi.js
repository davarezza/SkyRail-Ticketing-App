$(() => {
    HELPER.api = {
        table: APP_URL + "master/transportation/table",
        save: APP_URL + "master/transportation/store",
        edit: APP_URL + "master/transportation/edit",
        update: APP_URL + "master/transportation/update",
        delete: APP_URL + "master/transportation/delete",
    };

    init();
});

init = async () => {
    await HELPER.block();
    await initTableTransportation();
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
                        return full.kode;
                    },
                },             
                {
                    targets: 2,
                    render: function (data, type, full, meta) {
                        return "Nama Pesawat";
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
                        return full.keterangan;
                    },
                },             
                {
                    targets: 5,
                    render: function (data, type, full, meta) {
                        var html = `
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-warning" onclick="editSubsidiary('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    <i class="bx bx-pencil"></i>
                                </button>
                                <a class="btn btn-sm btn-icon btn-outline btn-outline-primary" href="${APP_URL}master/subsidiary/detail/${full.id}" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail">
                                    <i class="bx bx-show"></i>
                                </a>
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-danger" onclick="deleteSubsidiary('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
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