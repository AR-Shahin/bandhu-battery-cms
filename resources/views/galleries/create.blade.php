@extends("admin.layouts.master")

@section("title","Video Gallery")
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
                    <div><h3>Manage Video Gallery</h3></div>
                </div>

                <hr>
                <table class="table table-sm table-bordered data-table">
                    <thead class="text-center">
                        <tr>
                            <th>ID</th>
                            <th>Thumbnail</th>
                            <th>Title</th>
                            <th>Video ID</th>
                            <th>Status</th>
                            <th>Frontend</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="col-md-4">
                <h3>Add New Video</h3>
                <form action="{{ route('admin.video-gallery.store') }}" method="POST">
                    @csrf
                    <x-form.input label="Title" type="text" name="title" placeholder="Enter video title" id="title" required/>
                    <x-form.input label="YouTube Video ID" type="text" name="video_id" placeholder="e.g., dQw4w9WgXcQ" id="video_id" required/>
                    <small class="text-muted mb-3 d-block">Enter the YouTube video ID from the URL (e.g., dQw4w9WgXcQ from https://www.youtube.com/watch?v=dQw4w9WgXcQ)</small>

                    <x-form.input label="Custom Thumbnail URL (Optional)" type="url" name="thumb" placeholder="https://example.com/image.jpg" id="thumb"/>
                    <small class="text-muted mb-3 d-block">Leave blank to use YouTube auto-generated thumbnail</small>

                    <div class="form-group">
                        <label for="status"><b>Status</b></label>
                        <select name="status" class="form-control" id="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="is_front" id="is_front">
                            <label class="form-check-label" for="is_front">
                                Show on Frontend
                            </label>
                        </div>
                    </div>

                    <x-form.submit :is_block="true" value="Add Video"/>
                </form>
            </div>
        </div>
    </div>
</div>

@stop


@push("script")

<x-utility.datatable-js/>

<script>
    initalizeDatatable("{{ route('admin.video-gallery.index') }}",[
            { data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
            {data: 'thumbnail', name: 'thumbnail', 'orderable': false},
            {data: 'title', name: 'title'},
            {data: 'video_id', name: 'video_id'},
            {data: 'status', name: 'status'},
            {data: 'is_front', name: 'is_front'},
            {data: 'actions', name: 'actions', 'orderable': false, 'searchable': false},
        ]);

</script>
@endpush
