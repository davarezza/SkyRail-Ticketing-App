@extends('layouts.master')

@section('title')
    <title>Profile | {{ config('app.name') }}</title>
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb" class="py-3 px-3">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
        <li class="breadcrumb-item active" id="breadcrumb-custom-text">Profile Data</li>
    </ol>
</nav>
@endsection

@section('container')

@endsection

@push('scripts')
@endpush