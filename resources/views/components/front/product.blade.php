@props(["product"])

<div class="wrapper card text-justify" style="overflow-y: scroll;height:320px">
    <a href="{{ route("single_product",$product->slug) }}">
       <figure>
          <img src="{{ asset( $product->image ) }}" alt="{{ $product->name}}" >
       </figure>
       <div class="bs text-justify">
          <h3>{{ $product->name }}</h3>
          <p>{{$product->short_des }}
          </p>
       </div>
    </a>
 </div>
