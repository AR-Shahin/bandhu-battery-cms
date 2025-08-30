@extends("admin.layouts.master")
@section("title","Product Edit")
@push(
"css"
)
<style>
   td,th{
   vertical-align: middle;
   }
</style>
@endpush
@section("master_content")
<div class="card">
   <div class="card-body">
      <div class="row">
         <div class="col-md-12">
            <div class="d-flex justify-content-between">
               <div>
                  <h3>Product Edit</h3>
               </div>
               <div>
                  @if (in_array("admin-create",$permissions))
                  <a href="{{ route("admin.product.index") }}" class="btn btn-sm btn-success"><i class="fa fa-angle-left"></i> Back</a>
                  @endif
               </div>
            </div>
            <hr>
            <form action="{{ route("admin.product.update",$product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
               <div class="col-md-6">
                  <x-form.input label="Name" type="text" name="name" :value="$product->name" id="name"/>
               </div>
               <div class="col-md-3">
                  <x-form.input label="Model" type="text" name="model" :value="$product->model" id="model"/>
               </div>
               <div class="col-md-3">
                  <x-form.input label="Order" type="number" name="order" :value="$product->order" id="order"/>
               </div>
               <div class="col-md-3">
                  <x-form.select
                     label="Category"
                     name="category_id"
                     id="category_id"
                     :items="$categories"
                     :value="$product->category->id"
                     />
               </div>
               <div class="col-md-3">
                  <x-form.select
                     label="Sub Category"
                     name="sub_category_id"
                     id="sub_category_id"
                     :items="$sub_categories"
                     :value="$product->sub_category->id"
                     />
               </div>
               <div class="col-md-3">
                  <x-form.select
                     label="Brand"
                     name="brand_id"
                     id="brand_id"
                     :items="$brands"
                     :value="$product->brand_id"
                     />
               </div>
               <div class="col-md-3 align-self-center">
                  <div class="form-group">
                     <label for="">Status</label>
                     <input type="checkbox" class="form-check-input ml-2" name="status" id="status" value="1"
                     @if ($product->status)
                     checked
                     @endif
                     >
                  </div>
               </div>
               <div class="col-md-6">
                  <label for="">Image : </label>
                  <input onchange="previewImage(event,'viewImage')" type="file" class="form-control imageUpload @error("image")
                  is-invalid
                  @enderror" accept="image/jpeg, image/png, image/jpg" name="image">
                  @error("image")
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
               <div class="col-md-6">
                  <img src="{{ asset($product->image) }}" alt="" id="viewImage" width="100px" class=" rounded img-thumbnail">
               </div>
               <div class="col-md-12">
                  <x-form.textarea label="Short Description" name="short_des" placeholder="Short Description" id="short_des" :value="$product->short_des" />
               </div>
               <div class="col-md-12">
                  <x-form.textarea label="Description" name="description" placeholder="Description" id="description" :summernote="true" :value="$product->description"/>
               </div>
               </table>
            </div>
            <x-form.submit text="Update"/>
            </form>
            <hr>
            <h4 >Gallery : </h4>
            <table class="table table-bordered table-sm text-center">
            @foreach ($product->images as $image)
            <form action="{{ route("admin.product.photo_gallery",$image->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <tr>
               <td width="30%">
                  <input onchange="previewImage(event,'imgShow')" type="file" class="form-control" name="image" accept="image/jpeg, image/png, image/jpg">
                  <img id="imgShow" src="{{ asset($image->image) }}" width="100px" class="mt-2">
               </td>
               <td width="50%"><input type="text" class="form-control" name="title" value="{{ $image->title }}"></td>
               <td width="20%"><input min="1" type="number" class="form-control" name="order"  value="{{ $image->order }}"></td>
               <td width="5%">
                  <button class="btn btn-sm btn-success" name="flag" value="update">Update</button>
                  <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger mt-1" name="flag" value="delete">Delete</button>
               </td>
            </tr>
            </form>
            @endforeach
            </table>
            <hr>
            <h4>Add More Gallery Images</h4>
            <form action="{{ route("admin.product.gallery_extra",$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <table class="table table-bordered table-sm text-center" id="dynamicTable">
                    <tr>
                        <td width="30%">
                            <input onchange="previewImage(event,'imgShow')" type="file" class="form-control" name="images[]" accept="image/jpeg, image/png, image/jpg">
                            <img id="imgShow" src="" width="100px" class="mt-2">
                        </td>
                        <td width="50%"><input type="text" class="form-control" name="titles[]" placeholder="Image title"></td>
                        <td width="20%"><input min="1" type="number" class="form-control" name="orders[]" placeholder="Order"></td>
                        <td><button id="addNewRow" class="btn btn-sm btn-success mt-1"><i class="fa fa-plus"></i></button></td>
                    </tr>
                </table>
                <x-form.submit text="Add More Images"/>
            </form>
            <hr>
            <h4 for="">Videos : </h4>
            @foreach ($product->videos as $video)
            <table class="table table-bordered table-sm text-center" id="dynamicVideoTable">
               <form action="{{ route("admin.product.video_gallery",$video->id) }}" method="POST">
               @csrf
               <tr>
                  <td width="30%">
                     <iframe class="youtube-player" type="text/html" width="100%" height="auto"
                        src="http://www.youtube.com/embed/{{ $video?->video }}?wmode=opaque&autohide=1&autoplay=1&enablejsapi=1"
                        frameborder="0" allow="autoplay" id="homeVideoIframe"></iframe>
                  </td>
                  <td width="30%">
                     <input type="text" class="form-control" name="video_id" value="{{ $video->video }}">
                  </td>
                  <td ><input type="text" class="form-control" name="video_title" value="{{ $video->title  }}"></td>
                  <td width="8%"><input min="1" type="number" class="form-control" name="video_order" value="{{ $video->order ?? 0 }}"></td>
                  <td width="5%">
                     <button class="btn btn-sm btn-success" name="flag" value="update">Update</button>
                     <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger mt-1" name="flag" value="delete">Delete</button>
                  </td>
               </tr>
               </form>
            </table>
            @endforeach
         </div>
      </div>
   </div>
</div>
@stop
@push("script")
<x-utility.summernote/>
<script>
   let counter = 1;
          $("#addNewRow").click(function(e){
           let temp =  counter ++;
           e.preventDefault();
               let html = ` <tr>
                       <td width="30%"><input onchange="previewImage(event,'imgShow_${temp}')"
                            type="file" class="form-control" name="images[]" accept="image/jpeg, image/png, image/jpg">
                            <img id="imgShow_${temp}" src="" class= "mt-2" width="100px" >
                       <td width="50%"><input type="text" class="form-control" name="titles[]" placeholder="Image title"></td>
                       <td width="20%"><input min="1" type="number" class="form-control" name="orders[]" placeholder="Order"></td>
                       <td class="text-center"><button class="btn btn-sm btn-danger deleteRow"><i class="fa fa-minus"></i></button></td>
                       </tr>
                   </tr>`;
               $(this).closest("table").append(html)
           });

           $("body").on("click",".deleteRow",function(e){
               e.preventDefault();

               $(this).closest("tr").remove()
           });



           $("#category_id").on("change",async function (){
           $('#sub_category_id').html("");
           if($(this).val()){
               let url = `${window.location.origin}/sub-category-by-main-category/${$(this).val()}`;
               const res = await axios.get(url);
               $('#sub_category_id').append(res.data);
           }
       });



           function previewImage(event,id) {
               var input = event.target;

               if (input.files && input.files[0]) {

                   var fileSize = input.files[0].size; // in bytes
                   var maxSize = 1024 * 1024; // 1 MB

                   if (fileSize > maxSize) {
                       alert('File size exceeds 1 MB. Please choose a smaller file.');
                       input.value = ""
                   }else{
                       var reader = new FileReader();

                       reader.onload = function (e) {
                           var preview = document.getElementById(id);
                           preview.src = e.target.result;
                       }

                       reader.readAsDataURL(input.files[0]);
                   }
               }
           }
</script>
@endpush
