@extends('layouts.master')

@section('title')
    <title>Dashboard Admin | {{ config('app.name') }}</title>
@endsection

@section('container')
    <h4 class="mb-3">Admin Dashboard</h4>
    <div class="row">
        <div class="col-12 col-md-6 d-flex">
            <div class="card flex-fill border-0 illustration">
                <div class="card-body p-0 d-flex flex-fill">
                    <div class="row g-0 w-100">
                        <div class="col-6">
                            <div class="p-3 m-1">
                                <h4 class="text-capitalize">Welcome Back, Dava Rezza</h4>
                                <p class="mb-0 text-capitalize">Admin Dashboard, {{ config('app.name') }}</p>
                            </div>
                        </div>
                        <div class="col-6 align-self-end text-end">
                            <img src="{{ asset('assets/img/20.png') }}" alt="" class="img-fluid illustration-img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 d-flex">
            <div class="card flex-fill border-0">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h4 class="mb-2">20</h4>
                            <p class="mb-2">Banned Posts</p>
                            <div class="mb-0">
                                <span class="badge text-success me-2">+2</span>
                                <span class="text-muted">Since Last Month</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Table Element --}}
    <div class="card border-0">
        <div class="card-header">
            <h5 class="card-title">
                Basic Table
            </h5>
            <h6 class="card-subtitle text-muted">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. itaque!
            </h6>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </div>
@endsection