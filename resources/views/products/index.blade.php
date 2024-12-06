@extends('user.layouts.master')

@section('content')
<div class="container">
    <h1>Products</h1>
    <a href="{{ route('owner.products.create') }}" class="btn btn-primary">Add New Product</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Business ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->business_id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <a href="{{ route('owner.products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <a href="{{ route('owner.products.show', $product->id) }}" class="btn btn-sm btn-info">View</a>
                    <form action="{{ route('owner.products.destroy', $product->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
