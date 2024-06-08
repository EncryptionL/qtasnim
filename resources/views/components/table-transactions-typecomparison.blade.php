<table class="table table-striped table-hover" id="table-transactions-typecomparison">
    <thead>
        <tr>
            <th scope="col">Product Type</th>
            <th scope="col">Lowest Sold</th>
            <th scope="col">Highest Sold</th>
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
        let table = new DataTable('#table-transactions-typecomparison', {
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('transactions.typecomparison', ['startDate' => request()->input('startDate'), 'endDate' => request()->input('endDate')]) }}",
            columns: [
                { data: 'PTName', name: 'PTName' },
                { data: '_min', name: '_min' },
                { data: '_max', name: '_max' },
            ]
        })
    })
</script>
@endpush
