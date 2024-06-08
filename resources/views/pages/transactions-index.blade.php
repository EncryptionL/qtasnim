@extends('components.layout')

@section('content')
<main class="my-5">
    <div class="container">
        <div class="row justify-content-center gy-5">
            <div class="col-12">
                <div class="card shadow">
                    <h4 class="card-header bg-primary text-white p-3">
                        <div class="row justify-content-between align-items-center">
                            <div class="col">
                                Tabel Transactions
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('transactions.typecomparison') }}" class="btn btn-success rounded-pill text-white">Type Comparison</a>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('transactions.create') }}" class="btn btn-light rounded-circle text-primary shadow-sm">
                                    <i class="fa-solid fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </h4>
                    <div class="card-body">
                        <x-table-transactions />
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
