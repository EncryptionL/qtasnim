@extends('components.layout')

@section('content')
<main class="pt-3">
    <div class="container">
        <div class="card shadow-sm">
            <h5 class="card-header bg-primary text-white">Tabel Products</h5>
            <div class="card-body">
                <x-table-transaction />
            </div>
        </div>
    </div>
</main>
@endsection
