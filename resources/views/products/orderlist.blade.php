@extends('user.layouts.master')

@section('content')
<div class="container">
    <h1>Products</h1>
    <table class="table mt-3 bg-light">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            @if($order->product)
            <tr>
                <td>{{ $order->product->name }}</td>
                <td>${{ $order->product->price }}</td>
                <td>
                    @if ($order->status == 'paid')
                        <span class="badge bg-success">{{ $order->status }}</span>
                    @elseif ($order->status == 'pending')
                        <span class="badge bg-warning">{{ $order->status }}</span>
                    @elseif ($order->status == 'failed')
                        <span class="badge bg-danger">{{ $order->status }}</span>
                    @else
                        <span class="badge bg-secondary">{{ $order->status }}</span>
                    @endif
                </td>
               
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection
