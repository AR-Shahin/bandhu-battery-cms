@extends("admin.layouts.master")

@section("title","Unit")
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
                    <div><h3>Manage Unit</h3></div>
                </div>

                <hr>
                <table class="table table-sm table-bordered data-table">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Name (English)</th>
                            <th>Name (Bengali)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="col-md-4">
                <h3>Create Unit</h3>
                <form action="{{ route('admin.unit.store') }}" method="POST">
                    @csrf
                    <x-form.input label="Name (English)" type="text" name="name_en" placeholder="Enter unit name in English" id="name_en" required/>
                    <x-form.input label="Name (Bengali)" type="text" name="name_bn" placeholder="Enter unit name in Bengali" id="name_bn" required/>
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
    initalizeDatatable("{{ route('admin.unit.index') }}",[
            { data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
            {data: 'name_en', name: 'name_en'},
            {data: 'name_bn', name: 'name_bn'},
            {data: 'actions', name: 'actions'},
        ]);

</script>
@endpush
