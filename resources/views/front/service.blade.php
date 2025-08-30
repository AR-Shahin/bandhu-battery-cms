@extends("layouts.front_app")

@section("title","Service")
@section("master_content")
<main>

    <!-- ============abt-01 Section  Start============ -->

    <section class="abt-01">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading-wrapper">
                        <h3>Services</h3>
                        <ol>
                            <li><a href="." class="text-light">Home <i class="far fa-angle-double-right"></i></a></li>
                            <li>Services</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ======================Bg-03 started====================== -->

    <section class="bg-03">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading">
                        <h2>OUR SERVICES</h2>
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

@stop

