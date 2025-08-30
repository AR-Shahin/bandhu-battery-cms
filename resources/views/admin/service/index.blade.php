@extends("admin.layouts.master")

@section("title","Service")
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
                $route = route("admin.services.create");
            @endphp

            <x-ui.card-top-add
            heading="Manage Services"
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
                                <th>Title</th>
                                <th>Order</th>
                                <th>Icon</th>
                                <th>Status</th>
                                <th>Description</th>
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

initalizeDatatable("{{ route('admin.services.index') }}",[
            { data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
            {data: 'title', name: 'title'},
            {data: 'order', name: 'order'},
            {data: 'icon', name: 'icon'},
            {data: 'status', name: 'status'},
            {data: 'description', name: 'description'},
            {data: 'actions', name: 'actions'},
        ]);
</script>
@endpush
