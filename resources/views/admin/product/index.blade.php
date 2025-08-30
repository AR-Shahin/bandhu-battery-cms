@extends("admin.layouts.master")

@section("title","Product")
@push(
    "css"
)
<x-utility.datatable-css/>
@endpush
@section("master_content")


<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                @php
                $route = route("admin.product.create");
            @endphp

            <x-ui.card-top-add
            heading="Manage Products"
            permission="admin-create"
            :route="$route"
            :permissions="$permissions"
            />


                <hr>
                <div class="table-responsive text-center">
                    <table class="table table-sm table-bordered data-table">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Brand</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop


@push("script")

<x-utility.datatable-js/>

<script>

initalizeDatatable("{{ route('admin.product.index') }}",[
            { data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
            {data: 'name', name: 'name'},
            {data: 'category.name', name: 'category.name'},
            {data: 'sub_category.name', name: 'sub_category.name'},
            {data: 'brand.name', name: 'brand.name'},
            {data: 'status', name: 'status'},
            {data: 'image', name: 'image'},
            {data: 'actions', name: 'actions'},
        ]);
</script>
@endpush
