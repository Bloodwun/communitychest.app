@extends('user.layouts.master')
@section('content')
<div class="container mt-5">
    <div class="alert alert-danger text-center" role="alert">
        <h1 class="display-4">Payment Failed!</h1>
        <p class="lead">Unfortunately, your payment could not be processed at this time.</p>
        <hr>
        <p>Please try again later or <a href="" class="alert-link">contact support</a> for assistance.</p>
        <a href="{{ route('index') }}" class="btn btn-secondary mt-4">Go to Homepage</a>
    </div>
</div>
@endsection
