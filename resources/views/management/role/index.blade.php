@extends('layouts.master')

@section('title')
    <title>Role Access | {{ config('app.name') }}</title>
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb" class="py-3 px-3">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
        <li class="breadcrumb-item active" id="breadcrumb-custom-text">Role Access Data</li>
    </ol>
</nav>
@endsection

@push('styles')
    <link href="{!! asset('assets/plugins/custom/jstree/jstree.bundle.css') !!}" rel="stylesheet" type="text/css" />
    <style>
        .card {
            border: 2px solid #e4e6ef;
            background-color: #f9fafb;
        }

        .dt-control{
            cursor: pointer;
        }

        .dt-control:before {
            display: none;
        }

        table.dataTable td.dt-control:before {
            content: "";
        }

        table.dataTable tr.dt-hasChild td.dt-control:before {
            content: "";
        }
    </style>
@endpush

@section('container')
    <div class="row mb-8">
        <div class="col-12">
            <div class="card modern-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Role Access Data</h3>
                    <div class="d-flex gap-3 align-items-center">
                        <div class="position-relative">
                            <i class='bx bx-search position-absolute search-icon'></i>
                            <input type="text" id="searchRole" class="form-control search-input" placeholder="Type to Search" />
                        </div>
                        <button type="button" class="btn btn-primary d-flex align-items-center" onclick="toggleAddRole(true)">
                            <i class='bx bx-plus fs-5'></i>
                            <span>Add New</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="table-responsive w-100">
                                <table id="kt_datatable_list" class="table custom-table table-hover" style="min-width: 500px; width: auto;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-2" id="save" style="display: none">
                                <h4 class="mb-2">Access</h4>
                                <button class="btn btn-primary mt-3" id="save-button">Save</button>
                            </div>
                            <div id="kt_docs_jstree_checkable" class="mt-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('management.role.modal')
@endsection

@push('scripts')
    <script src="{!! asset('assets/plugins/custom/jstree/jstree.bundle.js') !!}"></script>
    <script src="{!! asset('js/management/role.js') !!}?v={{ time() }}"></script>
    <script>
        $(document).ready(function () {
            let selectedTexts;
            let roleId;

            $('#kt_datatable_list').on('click', '.showPermission', function () {
                roleId = $(this).data('role-id');
                $('#kt_docs_jstree_checkable').jstree("destroy");

                $.ajax({
                    url: APP_URL + "get-permission/" + roleId,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        $('#save').show();
                        $('#kt_docs_jstree_checkable').jstree({
                            'plugins': ["wholerow", "checkbox", "types"],
                            'core': {
                                "themes": {
                                    "responsive": false
                                },
                                'data': response,
                            },
                            "types": {
                                "default": {
                                    "icon": "ki-solid ki-folder text-warning"
                                },
                            },
                        });
                        $('#kt_docs_jstree_checkable').on('changed.jstree', function (e, data) {
                            selectedTexts = [];
                            var selectedNodes = data.instance.get_selected(true);

                            var uniqueTexts = new Set();

                            selectedNodes.forEach(function (node) {
                                var lastChildValue = getLastChildValue(node);
                                uniqueTexts.add(lastChildValue);
                            });

                            selectedTexts = Array.from(uniqueTexts);

                            function getLastChildValue(node) {
                                if (node.children.length > 0) {
                                    return getLastChildValue(data.instance.get_node(node.children[node.children.length - 1]));
                                } else {
                                    return node.text;
                                }
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching data:", error);
                    }
                });
            });

            $('#save-button').on('click', function () {
                $.ajax({
                    url: APP_URL + roleId + "/store-permission",
                    type: "POST",
                    data: {
                        selectedTexts: selectedTexts,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(response) {
                        HELPER.showMessage({
                            success: response.success,
                            title: 'Success',
                            message: response.message,
                            callback: function() {
                                location.reload(); 
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error sending data to the controller:", error);
                        HELPER.showMessage({
                            success: false,
                            title: 'Failed',
                            message: 'System error, please contact the Administrator'
                        });
                    }
                });
            });
        });
    </script>
@endpush