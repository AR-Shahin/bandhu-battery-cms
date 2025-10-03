@extends("layouts.front_app")

@section("title","Gallery")
@section("master_content")
<main class="charity-01-main">

    <!-- ============abt-01 Section  Start============ -->

    <section class="abt-01">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading-wrapper">
                        <h3>Gallery</h3>
                        <ol>
                            <li><a href="/" class="text-light">Home<i class="far fa-angle-double-right"></i></a></li>
                            <li>Gallery</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

     <section class="bg-0-b">
         <div class="container">
             <div class="row">
                 <div class="col-12">
                     <div class="heading">
                         <h2>Gallery</h2>
                     </div>
                 </div>
             </div>
                <div class="row gx-2">
                    @foreach ($galleries as $gallery)
                    <div class="col-6 col-md-4 col-lg-3 mb-2">
                        <a href="{{ asset($gallery->image)}}" data-fancybox="gallery" data-caption="{{ $gallery->title }}">
                            <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->title }}" class="img-fluid hover_scale">
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $galleries->links() }}
                    </div>
                </div>

         </div>
     </section>
  </main>

@stop

