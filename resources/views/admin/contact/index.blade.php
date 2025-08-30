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
                $route = "";
            @endphp

            <x-ui.card-top-add
            heading="Manage Contact"
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
                                <th>Subject</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Message</th>
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

initalizeDatatable("{{ route('admin.contacts.index') }}",[
            { data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
            {data: 'name', name: 'name'},
            {data: 'subject', name: 'subject'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'status', name: 'status'},
            {data: 'message', name: 'message'},
            {data: 'image', name: 'image'},
            {data: 'actions', name: 'actions'},
        ]);
</script>
@endpush
