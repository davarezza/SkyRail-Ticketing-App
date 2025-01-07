@extends('layouts.master')

@section('title')
    <title>Transportation Data | {{ config('app.name') }}</title>
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb" class="py-3 px-3">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
        <li class="breadcrumb-item active" id="breadcrumb-custom-text">Transportation Data</li>
    </ol>
</nav>
@endsection

@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card modern-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Transportation Data</h3>
                    <div class="d-flex gap-3 align-items-center">
                        <div class="position-relative">
                            <i class='bx bx-search position-absolute search-icon'></i>
                            <input type="text" id="searchTransportation" class="form-control search-input" placeholder="Type to Search" />
                        </div>
                        <button type="button" class="btn btn-modern btn-primary d-flex align-items-center gap-2" onclick="toggleAddTransport(true)">
                            <i class='bx bx-plus fs-5'></i>
                            <span>Tambah Transportasi</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="transportation-table" class="table custom-table table-hover" style="min-width: 800px; width: auto;">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">No</th>
                                    <th style="width: 150px;">Kode</th>
                                    <th style="width: 250px;">Name</th>
                                    <th style="width: 150px;">Transportation Type</th>
                                    <th style="width: 250px;">Keterangan</th>
                                    <th class="text-center" style="width: 100px;">Action</th>
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
    <script src="{!! asset('js/master/transportasi.js') !!}?v={{ time() }}"></script>
@endpush