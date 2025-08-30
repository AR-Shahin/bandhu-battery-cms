@extends("admin.layouts.master")

@section("title","Service Edit")
@push(
    "css"
)

@endpush
@section("master_content")
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <div><h3>Service Edit</h3></div>
                    <div>
                        @if (in_array("admin-create",$permissions))
                        <a href="{{ route("admin.services.index") }}" class="btn btn-sm btn-success"><i class="fa fa-angle-left"></i> Back</a>
                        @endif
                    </div>
                </div>
                <hr>
                <form action="{{ route("admin.services.update",$service->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <x-form.input label="Title" type="text" name="title" placeholder="Enter title" id="title" :value="$service->title"/>
                        </div>
                        <div class="col-md-6">
                            <x-form.input label="Icon" type="text" name="icon" placeholder="Enter icon" id="icon" :value="$service->icon"/>
                        </div>
                        <div class="col-md-6">
                            <x-form.input label="Order" type="number" name="order" placeholder="Order" id="order" :value="$service->order"/>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Status</label>
                            <input type="checkbox" class="form-check-input ml-2" name="status" id="status" value="1"   @if($service->status)
                            checked
                            @endif>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <x-form.textarea label="Description" name="description" placeholder="Description" id="description" :summernote="true" :value="$service->description" />
                        </div>
                    </div>
                    <x-form.submit/>

                </form>
            </div>
        </div>
    </div>
</div>

@stop


@push("script")

<x-utility.summernote/>

@endpush
