@extends("admin.layouts.master")

@section("title","Brand")
@push(
    "css"
)
<x-utility.datatable-css/>
@endpush
@section("master_content")


<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="d-flex justify-content-between">
                    <div><h3>Manage Brand</h3></div>
                </div>

                <hr>
                <table class="table table-sm table-bordered data-table">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Order</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="col-md-4">
                <h3>Create Brand</h3>
                <form action="{{ route('admin.brand.store') }}" method="POST">
                    @csrf
                    <x-form.input label="Name" type="text" name="name" placeholder="Enter brand name" id="name"/>
                    <x-form.input label="Order" type="number" name="order" placeholder="Order " id="name"/>
                    <x-form.submit :is_block="true"/>
                </form>
            </div>
        </div>
    </div>
</div>

@stop


@push("script")

<x-utility.datatable-js/>

<script>
    initalizeDatatable("{{ route('admin.brand.index') }}",[
            { data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
            {data: 'name', name: 'name'},
            {data: 'order', name: 'order'},
            {data: 'actions', name: 'actions'},
        ]);

</script>
@endpush
