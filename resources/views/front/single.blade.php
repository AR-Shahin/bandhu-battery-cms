@extends("layouts.front_app")

@section("title","Product")
@push("css")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
@endpush
@section("master_content")
<main>

    <!-- ============abt-01 Section  Start============ -->

    <section class="abt-01">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading-wrapper">
                        <h3>{{ $product->name }}</h3>
                        <ol>
                            <li><a href="/" class="text-light">Home <i class="far fa-angle-double-right"></i></a></li>
                            <li><a href="" class="text-light">Product</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ======================Bg-03 started====================== -->

    <section class="bg-03">
        <div class="container">
            <h2>{{ $product->name }}</h2>
            <p><b>Uploaded : {{ $product->created_at->format("Y-m-d") }}</b></p>
            <div class="text-center my-2">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-50 text-center my-2">
            </div>
            <p class="text-justify">{{ $product->short_des }}</p>
            <hr>
            <p class="text-justify">{!! $product->description !!}</p>
            <hr>


            @if ($product->images->count())
            <h5 class="my-2"><b>Gallery</b></h5>

            <div class="row no-gutters gallery">
                @foreach ($product->images as $image)
                <div class="col-md-3">
                    <a  data-caption="{{ $image->title }}" data-fancybox="gallery" href="{{ asset($image->image) }}"><img src="{{ asset($image->image) }}" alt="{{ $image->title }}"></a>
                </div>
                @endforeach
            </div>
            @endif

            @if ($product->videos->count())
            <h5 class="my-2"><b>Video</b></h5>

            <div class="row no-gutters">
                @foreach ($product->videos as $video)
                <div class="col-md-3">
                    <iframe class="youtube-player" type="text/html" width="100%" height="auto"
                    src="http://www.youtube.com/embed/{{ $video?->video }}?wmode=opaque&autohide=1&autoplay=1&enablejsapi=1"
                    frameborder="0" allow="autoplay" id="homeVideoIframe"></iframe>
                </div>
                @endforeach
            </div>
            @endif

            <a href="{{ route("contact") }}" class="btn btn-sm btn-warning">Feel free to contact us for questions about this product</a>
        </div>
    </section>
  </main>
@stop


@push("js")
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script>
    $(document).ready(function() {
      $('[data-fancybox="gallery"]').fancybox({
        loop: true,
      });
    });
    </script>
@endpush
