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
                                Tabel Transactions Type Comparison
                            </div>
                        </div>
                    </h4>
                    <div class="card-body">
                        <form action="{{ route('transactions.typecomparison') }}" method="get" class="mb-5">
                            <div class="row align-items-end">
                                <div class="col">
                                    <label for="startDate">Start Date</label>
                                    <input type="date" name="startDate" id="startDate" class="form-control" value="{{ request()->input('startDate') }}">
                                </div>
                                <div class="col">
                                    <label for="endDate">End Date</label>
                                    <input type="date" name="endDate" id="endDate" class="form-control" value="{{ request()->input('endDate') }}">
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Set Date</button>
                                </div>
                            </div>
                        </form>
                        <x-table-transactions-typecomparison />
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
