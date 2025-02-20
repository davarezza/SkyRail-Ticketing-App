@extends('layouts.master')

@section('title')
    <title>Travel Route | {{ config('app.name') }}</title>
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb" class="py-3 px-3">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
        <li class="breadcrumb-item active" id="breadcrumb-custom-text">Travel Route Data</li>
    </ol>
</nav>
@endsection

@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card modern-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Travel Route Data</h3>
                    <div class="d-flex gap-3 align-items-center">
                        <div class="position-relative">
                            <i class='bx bx-search position-absolute search-icon'></i>
                            <input type="text" id="searchTravelRoute" class="form-control search-input" placeholder="Type to Search" />
                        </div>
                        <button type="button" class="btn btn-primary d-flex align-items-center" onclick="toggleAddTravelRoute(true)">
                            <i class='bx bx-plus fs-5'></i>
                            <span>Add New</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="travel-route-table" class="table custom-table table-hover" style="min-width: 800px; width: auto;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Objective City</th>
                                    <th>Departure City</th>
                                    <th>Price</th>
                                    <th>Transport Name</th>
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
    @include('master.travel-route.modal')
@endsection

@push('scripts')
    <script src="{!! asset('js/master/travel-route.js') !!}?v={{ time() }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let idr_input = document.getElementById('travel-route-price');

            if (idr_input) {
                idr_input.addEventListener('keyup', function(e) {
                    let formatted = formatRupiah(this.value, 'IDR ');
                    this.value = formatted;
                });
            }
        });

        function formatRupiah(amount, prefix) {
            let number_string = amount.replace(/[^,\d]/g, '').toString(),
                split         = number_string.split(','),
                remainder     = split[0].length % 3,
                rupiah        = split[0].substr(0, remainder),
                thousands     = split[0].substr(remainder).match(/\d{3}/gi);

            if (thousands) {
                let separator = remainder ? '.' : '';
                rupiah += separator + thousands.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix + rupiah;
        }
    </script>
@endpush
