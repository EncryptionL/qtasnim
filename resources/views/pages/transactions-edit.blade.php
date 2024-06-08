@extends('components.layout')

@section('content')
<main class="mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="card shadow">
                    <h4 class="card-header bg-primary text-white p-3">Create new Transaction</h4>
                    <div class="card-body">
                        <form action="{{ route('transactions.update', $transactions->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="product_id" class="form-label">Product</label>
                                <select class="form-select" aria-label="Product Type" id="product_id" name="product_id" aria-describedby="product_id">
                                    <option value="0">Select product</option>
                                    @foreach ($products as $product)
                                    <option value="{{ $product->id }}" @if($transactions->product_id === $product->id) selected @endif>{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="sold" class="form-label">Sold</label>
                                <input class="form-control" type="number" min="0" name="sold" id="sold" aria-describedby="sold" value="{{ $transactions->sold }}">
                            </div>
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <a href="{{ route('transactions.index') }}" class="btn btn-primary">
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
