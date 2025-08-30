@extends("admin.layouts.master")

@section("title","Website Content")
@push('css')
    <style>
        tr td{
            width: 50%!important;
        }
    </style>
@endpush
@section("master_content")

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h4>Website Content</h4>
                <hr>
                <form action="{{ route('admin.website.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-sm table-bordered">
                        <tr>
                            <td>
                                <x-form.input label="Name" type="text" name="name" id="name" :value="$data->name"/>
                            </td>
                            <td>
                                <x-form.input label="Title" type="text" name="title" id="title" :value="$data->title"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <x-form.input label="Meta" type="text" name="meta" id="Meta" :value="$data->meta"/>
                            </td>
                            <td>
                                <x-form.input label="Tags" type="text" name="tags" id="tags" :value="$data->tags"/>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <x-form.input label="Email" type="text" name="email" id="email" :value="$data->email"/>
                            </td>
                            <td>
                                <x-form.input label="Phone" type="text" name="phone" id="phone" :value="$data->phone"/>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <x-form.input label="Facebook Link" type="text" name="fb" id="fb" :value="$data->fb"/>
                            </td>
                            <td>
                                <x-form.input label="Youtube Link" type="text" name="youtube" id="youtube" :value="$data->youtube"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <x-form.input label="Linkedin Link" type="text" name="linkedin" id="linkedin" :value="$data->linkedin"/>
                            </td>
                            <td>
                                <x-form.textarea label="Address" name="address" id="address" :value="$data->address" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <x-form.textarea label="Map" name="map" id="map" :value="$data->map" />
                            </td>

                            <td>
                                <label for="">Image</label>

                                <input onchange="previewImage(event,'viewImage')" type="file" class="form-control imageUpload @error("logo")
                                is-invalid
                            @enderror" accept="image/jpeg, image/png, image/jpg" name="logo">
                            <img src="{{ asset($data->logo) }}" alt="" id="viewImage" width="100px" class=" rounded img-thumbnail">
                                @error("image")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </td>
                        </tr>
                    </table>
                    <x-form.submit text="Update"/>
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@push("script")

<x-utility.summernote/>

@endpush
