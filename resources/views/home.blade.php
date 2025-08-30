@extends("layouts.front_app")
@section("title","Home")
@section("master_content")
<!-- ======================Banner started====================== -->
<section class="banner">
   <div class="wrapper">
      <h1 >{{ $website->name }}</h1>
      <p>{{ $website->title }}</p>
      <ol>
         <li><a href="{{ route("contact") }}">Join with us</a></li>
         <li><a href="{{ route("product") }}">Products</a></li>
      </ol>
   </div>
</section>
<section class="bg-03">
   <div class="container">
      <div class="row">
         <div class="col-12 ">
            <div class="heading text-center">
               <h2><a href="{{ route("services") }}" class="text-dark">ABOUT US</a></h2>
            </div>
         </div>
      </div>
      <div class="text-justify" style="line-height: 1.9">
         {!! $single->about !!}
      </div>
   </div>
</section>
<section class="bg-03">
   <div class="container">
      <div class="row">
         <div class="col-12 ">
            <div class="heading text-center">
               <h2><a href="{{ route("services") }}" class="text-dark">OUR SERVICES</a></h2>
            </div>
         </div>
      </div>
      <div class="row">
         @foreach ($services as $service)
         <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="wrapper">
               <div class="content">
                  <ol>
                     <li>
                        {!! $service->icon !!}
                        <h3>{{ $service->title }}</h3>
                        <p>{{ show_in_html($service->description) }}</p>
                     </li>
                  </ol>
               </div>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</section>

<section class="bg-02">
   <div class="container">
      <div class="row">
         <div class="col-12 mb-3">
            <div class="heading">
               <h2><a href="" class="text-dark">Latest Product</a></h2>
               <p>Latest Innovations: Discover Our Newest Products!</p>
            </div>
         </div>
         @foreach ($products as $product)
         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <x-front.product :product="$product"/>
         </div>
         @endforeach
      </div>
   </div>
</section>
<section class="bg-02 p-0">
    <div class="container">
       <div class="row justify-content-center">
          <div class="col-md-12">
            <img src="{{ asset("frontend/assets/images/client.jpg") }}" alt="">
          </div>
       </div>
    </div>
 </section>
@stop
