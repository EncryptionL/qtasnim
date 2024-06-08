@extends('components.layout')

@section('content')
<main class="my-5">
    <div class="container">
        <div class="card shadow">
            <h4 class="card-header bg-primary text-white p-3">
                <div class="row justify-content-between align-items-center">
                    <div class="col">
                        Tabel Products Types
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('products.types.create') }}" class="btn btn-light rounded-circle text-primary shadow-sm">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </div>
                </div>
            </h4>
            <div class="card-body">
                <x-table-products-types />
            </div>
        </div>
    </div>
</main>
@endsection
