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
            <div class="heading">
               <h2><a href="{{ route("services") }}" class="text-dark">ABOUT US</a></h2>
            </div>
         </div>
      </div>
      <div class="row">
        <div class="col-md-6 align-self-wcenter">
                <div class="text-justify" style="line-height: 1.9">
                {!! $single->about !!}
            </div>
        </div>
        <div class="col-md-6">
            <img class="w-100" src="https://scontent.fdac189-1.fna.fbcdn.net/v/t39.30808-6/271182682_101625825746584_7312389497501977560_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=gShDtJidrdEQ7kNvwFcINyr&_nc_oc=Admb6Ln9Z_Yx1Qs8MrGh-hdl1-BaQAbkYzzcnhgz5xEmWRO4DZMEsZnrQz4eTY3wYqU&_nc_zt=23&_nc_ht=scontent.fdac189-1.fna&_nc_gid=w8tfYrBC4AgiTU1g0Gp2rQ&oh=00_AfUhtikIjd3D2a-i5CcCWHNdKf1sGqAzpUoUGGz1H_PDdA&oe=68BA2EFC" alt="">
        </div>
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

 <section class="bg-02 p-0">
        <div class="container-fluid">
                <div class="heading text-center">
                 <h2><a href="" class="text-dark">Gallery</a></h2>
                 <p>Our Memorable Moments</p>
        </div>
       <div class="row justify-content-center no-gutters">

            @for ($i = 1; $i <= 12; $i++)
            <div class="col-6 col-md-2">
                <a data-fancybox href="{{ asset("bandhu_battery.png") }}">
                    <img src="{{ asset("bandhu_battery.png") }}" alt="Thumbnail" class="w-100 hover_scale">
                </a>
            </div>
            @endfor

       </div>
    </div>
 </section>
@stop
