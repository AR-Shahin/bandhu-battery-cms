@extends("layouts.front_app")

@section("title","Video Gallery")
@section("master_content")
<main class="charity-01-main">

    <!-- ============abt-01 Section  Start============ -->

    <section class="abt-01">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading-wrapper">
                        <h3>Video Gallery</h3>
                        <ol>
                            <li><a href="/" class="text-light">Home<i class="far fa-angle-double-right"></i></a></li>
                            <li>Video</li>
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
                         <h2>Video</h2>
                     </div>
                 </div>
             </div>
                <div class="row gx-2">
                    @foreach ($videos as $video)
                    <div class="col-6 col-md-4 col-lg-3 mb-2">
                         <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="{{ $video->youtube_embed_url }}" allowfullscreen></iframe>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $videos->links() }}
                    </div>
                </div>

         </div>
     </section>
  </main>

@stop


