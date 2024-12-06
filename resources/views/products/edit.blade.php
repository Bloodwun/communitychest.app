@extends('user.layouts.master')

@section('content')
<div class="container">
    <h1>Edit Product</h1>
    <form action="{{ route('owner.products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        {{-- <div class="form-group">
            <label for="business_id">Business ID:</label>
            <input type="number" name="business_id" class="form-control" value="{{ $product->business_id }}" required>
        </div> --}}
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" name="price" class="form-control" value="{{ $product->price }}" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
