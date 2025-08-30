@extends("admin.layouts.master")

@section("title","Category")
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
                    <div><h3>Manage Category</h3></div>
                </div>

                <hr>
                <table class="table table-sm table-bordered data-table">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Order</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="col-md-4">
                <h3>Create Category</h3>
                <form action="{{ route('admin.sub-category.store') }}" method="POST">
                    @csrf
                    <x-form.select
                    label="Parent"
                    name="category_id"
                    id="category_id"
                    :items="$categories"

                    />
                    <x-form.input label="Name" type="text" name="name" placeholder="Enter Category name" id="name"/>
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
    initalizeDatatable("{{ route('admin.sub-category.index') }}",[
            { data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
            {data: 'name', name: 'name'},
            {data: 'category.name', name: 'category.name'},
            {data: 'order', name: 'order'},
            {data: 'actions', name: 'actions'},
        ]);

</script>
@endpush
