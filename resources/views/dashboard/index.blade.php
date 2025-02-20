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
                            <h4 class="mb-2">{{ number_format($completed_payments) }}</h4>
                            <p class="mb-2">Completed Payments</p>
                            <div class="mb-0">
                                @if ($payment_difference > 0)
                                    <span class="badge text-success me-2">+{{ number_format($payment_difference) }}</span>
                                    <span class="text-muted">Higher than last month</span>
                                @elseif ($payment_difference < 0)
                                    <span class="badge text-danger me-2">{{ number_format($payment_difference) }}</span>
                                    <span class="text-muted">Lower than last month</span>
                                @else
                                    <span class="text-muted">Same as last month</span>
                                @endif
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
                            <h4 class="mb-2">IDR {{ number_format($monthly_revenue, 0, ',', '.') }}</h4>
                            <p class="mb-2">Monthly Revenue</p>
                            <div class="mb-0">
                                @if ($revenue_difference > 0)
                                    <span class="badge text-success me-2">+IDR {{ number_format($revenue_difference, 0, ',', '.') }}</span>
                                    <span class="text-muted">Higher than last month</span>
                                @elseif ($revenue_difference < 0)
                                    <span class="badge text-danger me-2">IDR {{ number_format($revenue_difference, 0, ',', '.') }}</span>
                                    <span class="text-muted">Lower than last month</span>
                                @else
                                    <span class="text-muted">Same as last month</span>
                                @endif
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
                            <h4 class="mb-2">IDR {{ number_format($average_transaction_value, 0, ',', '.') }}</h4>
                            <p class="mb-2">Average Transaction Value</p>
                            <div class="mb-0">
                                @if ($average_transaction_difference > 0)
                                    <span class="badge text-success me-2">+IDR {{ number_format($average_transaction_difference, 0, ',', '.') }}</span>
                                    <span class="text-muted">Higher than last month</span>
                                @elseif ($average_transaction_difference < 0)
                                    <span class="badge text-danger me-2">IDR {{ number_format(abs($average_transaction_difference), 0, ',', '.') }}</span>
                                    <span class="text-muted">Lower than last month</span>
                                @else
                                    <span class="text-muted">Same as last month</span>
                                @endif
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
                    <h5 class="mb-3">Revenue (Last 12 Months)</h5>
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
