@extends("admin.layouts.master")

@section("title","Single Content")

@section("master_content")

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h4>Single Content</h4>
                <hr>
                <form action="{{ route('admin.single-content.update',$data->id) }}" method="POST">
                    @csrf
                    <table class="table table-sm table-bordered">
                        <tr>
                            <td>
                                <x-form.textarea label="About Us" name="about" id="about" :summernote="true" :value="$data->about" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <x-form.textarea label="Mission" name="mission" id="mission" :summernote="true" :value="$data->mission" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <x-form.textarea label="Vision" name="vision" id="vision" :summernote="true" :value="$data->vision" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <x-form.textarea label="Goal" name="goal" id="goal" :summernote="true" :value="$data->goal" />
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
