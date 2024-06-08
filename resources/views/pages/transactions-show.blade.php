@extends('components.layout')

@section('content')
<main class="mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="card shadow">
                    <h4 class="card-header bg-info text-white p-3">Transaction Detail</h4>
                    <div class="card-body">
                        <form action="javascript:void(0)" method="post">
                            <div class="mb-3">
                                <label for="id" class="form-label">ID</label>
                                <input type="number" class="form-control" id="id" name="id" aria-describedby="id" value="{{ $transactions->id }}" disabled readonly>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" aria-describedby="name" value="{{ $transactions->product->name }}" disabled readonly>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <input type="text" class="form-control" id="type" name="type" aria-describedby="type" value="{{ $transactions->productType->name }}" disabled readonly>
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock" aria-describedby="stock" value="{{ $transactions->stock }}" disabled readonly>
                            </div>
                            <div class="mb-3">
                                <label for="sold" class="form-label">Sold</label>
                                <input type="number" class="form-control" id="sold" name="sold" aria-describedby="sold" value="{{ $transactions->sold }}" disabled readonly>
                            </div>
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <a href="{{ route('transactions.index') }}" class="btn btn-primary">
                                        <i class="fa-solid fa-chevron-left"></i> Go Back
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('transactions.edit', $transactions->id) }}" class="btn btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('transactions.destroy', $transactions->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
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
