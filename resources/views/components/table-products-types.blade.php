<table class="table table-striped table-hover" id="table-products-types">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Desc</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
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
        let table = new DataTable('#table-products-types', {
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('products.types.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'desc', name: 'desc' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        })
    })
</script>
@endpush
