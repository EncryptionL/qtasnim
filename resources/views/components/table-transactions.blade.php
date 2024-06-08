<table class="table table-striped table-hover" id="table-transactions">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Product Name</th>
            <th scope="col">Stock</th>
            <th scope="col">Sold</th>
            <th scope="col">Transaction Date</th>
            <th scope="col">Product Type</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

@push('styles')
<style>
    table > thead > tr > th, table > tbody > tr > td {
        text-align: center !important;
        vertical-align: middle !important;
    }
</style>
@endpush

@push('scripts')
<script type="module">
    document.addEventListener('DOMContentLoaded', () => {
        let table = new DataTable('#table-transactions', {
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('transactions.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'product.name', name: 'product.name' },
                { data: 'stock', name: 'stock' },
                { data: 'sold', name: 'sold' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'product_type.name', name: 'product_type.name' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        })
    })
</script>
@endpush
