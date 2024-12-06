@extends('user.layouts.master')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0 text-center">Add New Product</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('owner.products.store') }}" method="POST">
                @csrf
                <!-- Business ID Field -->
                {{-- <div class="form-group mb-4">
                    <label for="business_id" class="form-label"><strong>Business ID:</strong></label>
                    <input 
                        type="number" 
                        name="business_id" 
                        id="business_id" 
                        class="form-control @error('business_id') is-invalid @enderror" 
                        placeholder="Enter your business ID" 
                        required
                    >
                    @error('business_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}

                <!-- Name Field -->
                <div class="form-group mb-4">
                    <label for="name" class="form-label"><strong>Product Name:</strong></label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        class="form-control @error('name') is-invalid @enderror" 
                        placeholder="Enter the product name" 
                        required
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Price Field -->
                <div class="form-group mb-4">
                    <label for="price" class="form-label"><strong>Price:</strong></label>
                    <input 
                        type="number" 
                        name="price" 
                        id="price" 
                        class="form-control @error('price') is-invalid @enderror" 
                        step="0.01" 
                        placeholder="Enter the price" 
                        required
                    >
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg px-5">
                        <i class="fas fa-save"></i> Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
