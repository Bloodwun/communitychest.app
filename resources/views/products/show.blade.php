@extends('user.layouts.master')

@section('content')
<div class="container">
    <h1>Product Details</h1>
    <ul>
        <li><strong>ID:</strong> {{ $product->id }}</li>
        <li><strong>Business ID:</strong> {{ $product->business_id }}</li>
        <li><strong>Name:</strong> {{ $product->name }}</li>
        <li><strong>Price:</strong> {{ $product->price }}</li>
    </ul>
    <a href="{{ route('owner.products.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
