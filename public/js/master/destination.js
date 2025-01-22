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
    // await formValidationAddTravelRoute();
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
                        return full.image;
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
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-warning" onclick="editTravelRoute('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                    <i class="bx bx-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-icon btn-outline btn-outline-danger" onclick="deleteTravelRoute('${full.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
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