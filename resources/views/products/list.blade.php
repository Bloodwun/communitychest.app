@extends('user.layouts.master')

@section('content')
<div class="container">
    <h1>Products</h1>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <a href="{{ route('business.products.buy', $product->id) }}" class="btn btn-sm btn-warning">Buy Product</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
