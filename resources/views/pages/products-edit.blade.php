@extends('components.layout')

@section('content')
<main class="mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="card shadow">
                    <h4 class="card-header bg-warning text-white p-3">Update a Product</h4>
                    <div class="card-body">
                        <form action="{{ route('products.update', $product->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="id" class="form-label">ID</label>
                                <input type="number" class="form-control" id="id" name="id" aria-describedby="id" value="{{ $product->id }}" disabled readonly>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" aria-describedby="name" value="{{ $product->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock" aria-describedby="stock" min="0" value="{{ $product->stock }}">
                            </div>
                            <div class="mb-3">
                                <label for="product_type_id" class="form-label">Product Type</label>
                                <select class="form-select" aria-label="Product Type" id="product_type_id" name="product_type_id" aria-describedby="product_type_id">
                                    <option value="0">Select product type</option>
                                    @foreach ($productsTypes as $productsType)
                                    <option value="{{ $productsType->id }}" @if($product->productType->id === $productsType->id) selected @endif>{{ $productsType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <a href="{{ route('products.index') }}" class="btn btn-primary">
                                        <i class="fa-solid fa-chevron-left"></i> Go Back
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
