@extends('user.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="alert alert-success text-center" role="alert">
        <h1 class="display-4">Payment Successful!</h1>
        <p class="lead">Thank you for your purchase. Your payment has been processed successfully.</p>
        <hr>
        <p>If you have any questions, feel free to <a href="" class="alert-link">contact us</a>.</p>
        <a href="{{ route('index') }}" class="btn btn-primary mt-4">Go to Homepage</a>
    </div>
</div>
@endsection
