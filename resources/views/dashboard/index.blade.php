@extends('layouts.master')

@section('title')
    <title>Dashboard | {{ config('app.name') }}</title>
@endsection

@section('container')
    <div class="row">
        <div class="col-12 col-md-4 d-flex">
            <div class="card flex-fill border-0">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h4 class="mb-2">1,250</h4>
                            <p class="mb-2">Completed Payments</p>
                            <div class="mb-0">
                                <span class="badge text-success me-2">+150</span>
                                <span class="text-muted">Higher than last month</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 d-flex">
            <div class="card flex-fill border-0">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h4 class="mb-2">$125,000</h4>
                            <p class="mb-2">Revenue This Month</p>
                            <div class="mb-0">
                                <span class="badge text-success me-2">+$15,000</span>
                                <span class="text-muted">Since last month</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 d-flex">
            <div class="card flex-fill border-0">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h4 class="mb-2">85</h4>
                            <p class="mb-2">Pending Payments</p>
                            <div class="mb-0">
                                <span class="badge text-danger me-2">-10</span>
                                <span class="text-muted">Reduced from last week's peak</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
    <div class="row my-3">
        <div class="col-12 col-md-6 d-flex">
            <div class="card flex-fill border-0 w-100">
                <div class="card-body py-4">
                    <h5 class="mb-3">Total Revenue (Last 12 Months)</h5>
                    <div id="revenueChart" class="chart-container"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 d-flex">
            <div class="card flex-fill border-0 w-100">
                <div class="card-body py-4">
                    <h5 class="mb-3">Ticket Sales per Route</h5>
                    <div id="ticketSalesChart" class="chart-container"></div>
                </div>
            </div>
        </div>      
    </div>
    <div class="row">
        <div class="col-12 col-md-6 d-flex">
            <div class="card flex-fill border-0 w-100">
                <div class="card-body py-4">
                    <h5 class="mb-3">Ticket Class Distribution</h5>
                    <div id="ticketClassChart" class="chart-container"></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 d-flex">
            <div class="card flex-fill border-0 w-100">
                <div class="card-body py-4">
                    <h5 class="mb-3">Passenger Age Distribution</h5>
                    <div id="passengerAgeChart" class="chart-container"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{!! asset('js/management/dashboard.js') !!}?v={{ time() }}"></script>
@endpush