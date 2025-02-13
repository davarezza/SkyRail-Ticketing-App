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
    {{-- Chart Element --}}
    
@endsection