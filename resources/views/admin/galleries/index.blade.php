@extends('admin.layouts.master')
@section('title', 'Gallery Management')
@section('master_content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>Gallery Images</h4>
                </div>
                <div class="card-body">
                    <div class="row gx-2">
                        @foreach($galleries as $gallery)
                        <div class="col-md-3 mb-2">
                            <div class="card">
                                <img src="{{ asset($gallery->image) }}" class="card-img-top" alt="Gallery Image">
                                <div class="card-body">
                                    <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-check mb-2">
                                            <input type="checkbox" class="form-check-input" name="is_front" value="1"
                                                {{ $gallery->is_front ? 'checked' : '' }}>
                                            <label class="form-check-label">Show on Front</label>
                                        </div>

                                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                                    </form>

                                    <form action="{{ route('admin.gallery.delete', $gallery) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Add New Gallery Image</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="is_front" name="is_front" value="1">
                            <label class="form-check-label" for="is_front">Show on Front</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Image</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
