@extends('layouts.master')

@section('title')
    <title>Transport Class | {{ config('app.name') }}</title>
@endsection

@push('styles')
    <style>
        .tagify {
            width: 100% !important;
            max-width: 100%;
            min-height: calc(1.5em + 0.75rem + 2px);
            background-color: rgba(var(--bs-light-rgb), 0.6);
            border-radius: 0.375rem;
            border: 1px solid #ccc;
            padding: 0.5rem;
        }

        .tagify__input {
            font-size: 1rem;
            padding: 0.375rem 0;
        }

        .tagify__tag {
            background-color: rgba(13, 110, 253, 0.15);
            border-radius: 0.5rem;
            padding: 0.3rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            transition: all 0.2s ease-in-out;
        }
    </style>
@endpush

@section('breadcrumb')
<nav aria-label="breadcrumb" class="py-3 px-3">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
        <li class="breadcrumb-item active" id="breadcrumb-custom-text">Transport Class Data</li>
    </ol>
</nav>
@endsection

@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card modern-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Transport Class Data</h3>
                    <div class="d-flex gap-3 align-items-center">
                        <div class="position-relative">
                            <i class='bx bx-search position-absolute search-icon'></i>
                            <input type="text" id="searchTransportClass" class="form-control search-input" placeholder="Type to Search" />
                        </div>
                        <button type="button" class="btn btn-primary d-flex align-items-center" onclick="toggleAddTransportClass(true)">
                            <i class='bx bx-plus fs-5'></i>
                            <span>Add New</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="transport-class-table" class="table custom-table table-hover" style="min-width: 800px; width: auto;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Facilities</th>
                                    <th>Detail</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('master.transport-class.modal')
@endsection

@push('scripts')
    <script src="{!! asset('js/master/transport-class.js') !!}?v={{ time() }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script>
        let input = document.querySelector('input[name=transport-class-facilities]');
        let tagify = new Tagify(input, {
            transformTag: (tagData) => {
                if (tagData.value.includes('<i class="')) {
                    const match = tagData.value.match(/class="([^"]+)"/);
                    if (match) {
                        tagData.value = match[1];
                    }
                }
            },
            originalInputValueFormat: values => values.map(item => item.value).join(',')
        });

        let inputDetail = document.querySelector('input[name=transport-class-facilities-detail]');
        let tagifyDetail = new Tagify(inputDetail, {
            originalInputValueFormat: values => values.map(item => item.value).join(',')
        })
    </script>
@endpush