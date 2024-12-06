@extends('user.layouts.master')

@section('title') Promotional PDF @endsection

@section('content')

@component('user.components.breadcrumb')
@slot('li_1') Promotional PDFs @endslot
@slot('title') Create New Promotional PDF @endslot
@endcomponent

<div class="container">
    <h1>Create New Promotional PDF</h1>
    <form action="{{ route('promotional.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- Logo -->
            <div class="col-md-6 mb-3">
                <label for="logo" class="form-label">Logo</label>
                <input type="file" class="form-control" id="logo" name="logo">
            </div>

            <!-- Banner -->
            <div class="col-md-6 mb-3">
                <label for="banner" class="form-label">Banner</label>
                <input type="file" class="form-control" id="banner" name="banner">
            </div>
        </div>

        <div class="row">
            <!-- Promotional Detail -->
            <div class="col-md-6 mb-3">
                <label for="promotional_detail" class="form-label">Promotional Detail</label>
                <textarea class="form-control" id="promotional_detail" name="promotional_detail" rows="3"></textarea>
            </div>

            <!-- Terms & Conditions -->
            <div class="col-md-6 mb-3">
                <label for="term_n_conditions" class="form-label">Terms & Conditions</label>
                <textarea class="form-control" id="term_n_conditions" name="term_n_conditions" rows="3"></textarea>
            </div>
        </div>

        <div class="row">
            <!-- Coupon Code -->
            <div class="col-md-6 mb-3">
                <label for="coupon_code" class="form-label">Coupon Code</label>
                <input type="text" class="form-control" id="coupon_code" name="coupon_code">
            </div>

            <!-- Start Date -->
            <div class="col-md-3 mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date">
            </div>

            <!-- Expiration Date -->
            <div class="col-md-3 mb-3">
                <label for="expiration_date" class="form-label">Expiration Date</label>
                <input type="date" class="form-control" id="expiration_date" name="expiration_date">
            </div>
        </div>

        <div class="row">
            <!-- Layout -->
            <div class="col-md-6 mb-3">
                <label for="layout" class="form-label">Layout</label>
                <input type="text" class="form-control" id="layout" name="layout">
            </div>
        </div>

        <!-- Images (img1 to img10) -->
        <div class="row">
            @for ($i = 1; $i <= 10; $i++)
                <div class="col-md-3 mb-3">
                    <label for="img{{ $i }}" class="form-label">Image {{ $i }}</label>
                    <input type="file" class="form-control" id="img{{ $i }}" name="img{{ $i }}">
                </div>
            @endfor
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>

@endsection

@section('script')
<!-- apexcharts -->
<script src="{{ asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- dashboard init -->
<script src="{{ asset('/assets/js/pages/dashboard.init.js') }}"></script>
@endsection
