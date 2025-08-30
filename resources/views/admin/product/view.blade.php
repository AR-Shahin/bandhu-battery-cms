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
                $route = route("admin.product.index");
            @endphp

            <x-ui.card-top-back
            heading="View Product"
            permission="admin-create"
            :route="$route"
            :permissions="$permissions"
            />

        <hr>
        <table class="table table-sm table-bordered">
            <tr>
                <th>Name</th>
                <td>{{ $product->name }} Madonna Booth </td>
                <th>Model</th>
                <td>{{ ucwords($product->model) }}</td>
                <th>Category</th>
                <td>{{ ucwords($product->category->name) }}</td>
                <th>Sub Category</th>
                <td>{{ ucwords($product->sub_category->name) }}</td>
            </tr>
            <tr>
                <th>Brand</th>
                <td>{{ ucwords($product->brand->name) }}</td>
                <th>Status</th>
                <td> {!! $product->status_badge !!}</td>
                <th>Created</th>
                <td> {{ $product->created_at->format("Y-m-d") }}</td>
                <th>Order</th>
                <td>{{ $product->order }}</td>
                <th>Image</th>
                <td><img src="{{ asset($product->image) }}" alt="" width="100px"></td>
            </tr>
        </table>
        <hr>
        <label for="">Short Description</label>
        <p>{{ $product->short_des }}</p>
        <label for="">Description</label>
        <p>{!! $product->description !!}</p>
        <hr>
        <h5>Gallery</h5>
        <div class="row no-gutters">
            @foreach ($product->images as $img)
            <div class="col-md-3">
                <img src="{{ asset($img->image) }}" alt="" width="100%">
            </div>
            @endforeach
        </div>
        <h5>Vidoes</h5>
        <div class="row gx-0">
            @foreach ($product->videos as $video)
            <div class="col-md-3">
                <iframe class="youtube-player" type="text/html" width="100%" height="auto"
                src="http://www.youtube.com/embed/{{ $video->video }}?wmode=opaque&autohide=1&autoplay=1&enablejsapi=1"
                frameborder="0" allow="autoplay" id="homeVideoIframe"></iframe>
            </div>
            @endforeach
        </div>
            </div>
        </div>
    </div>
</div>

@stop


