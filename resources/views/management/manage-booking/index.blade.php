@extends('layouts.master')

@section('title')
    <title>Manage Booking | {{ config('app.name') }}</title>
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb" class="py-3 px-3">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
        <li class="breadcrumb-item active" id="breadcrumb-custom-text">Manage Booking</li>
    </ol>
</nav>
@endsection

@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card modern-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Manage Booking</h3>
                    <div class="d-flex gap-3 align-items-center">
                        <div class="position-relative">
                            <i class='bx bx-search position-absolute search-icon'></i>
                            <input type="text" id="searchManageBooking" class="form-control search-input" placeholder="Type to Search" />
                        </div>
                        <button type="button" class="btn btn-primary d-flex align-items-center" onclick="toggleAddManageBooking(true)">
                            <i class='bx bx-plus fs-5'></i>
                            <span>Add New</span>
                        </button>
                        <a href="{{ route('management.manage-booking.export-excel') }}" id="exportExcel" class="btn btn-success d-flex align-items-center">
                            <i class='bx bxs-file fs-5 mx-1'></i>
                            <span> Generate Excel</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="manage-booking-table" class="table custom-table table-hover" style="min-width: 800px; width: auto;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Booking Code</th>
                                    <th>Route</th>
                                    <th>Transport Name</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
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
@endsection

@push('scripts')
    <script src="{!! asset('js/management/manage-booking.js') !!}?v={{ time() }}"></script>
    <script>
        const hasVerify        = @can('Verify Manage Booking') true @else false @endcan;
        const hasDelete        = @can('Delete Manage Booking') true @else false @endcan;
    </script>
@endpush
