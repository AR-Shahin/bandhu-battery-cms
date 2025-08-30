@extends("layouts.front_app")

@section("title","Contact")
@section("master_content")
<main class="charity-01-main">

    <!-- ============abt-01 Section  Start============ -->

    <section class="abt-01">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading-wrapper">
                        <h3>Contact Us</h3>
                        <ol>
                            <li><a href="/" class="text-light">Home<i class="far fa-angle-double-right"></i></a></li>
                            <li>Contact Us</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

     <section class="bg-0-b">
         <div class="container">
             <div class="row">
                 <div class="main-card-contact d-flex">
                     <div class="sup-card-contact">
                         <div class="sup-content">
                             <div class="head-content">
                                 <h2>Leave A Message Here</h2>
                                 <p>If you have questions about our offerings, need help with an order, or have any other inquiries, we're here to help. Please provide your name, email address, and a brief message detailing your request. Thanks. </p>
                             </div>

                             <div class="contact-title">
                                 <h2>Contact Details</h2>
                                 <ol>
                                     <li><i class="far fa-map-marker-check"></i>{{ $website->address }}</li>
                                     <li><i class="fal fa-mobile"></i>{{ $website->phone }} </li>
                                     <li><i class="fal fa-envelope"></i>{{ $website->email }}</li>
                                     <li><i class="fal fa-clock"></i>Sat - Thu 8.00 - 18.00.</li>
                                 </ol>
                             </div>
                         </div>
                     </div>

                     <div class="sup-card-contact-0a">
                         <div class="contact-a1">
                            @if(session()->has("success"))
                            <span class="text-success">{{ session("success") }}</span>
                        @endif
                             <form method="POST" action="{{ route("contact_store") }}" enctype="multipart/form-data">
                                @csrf
                                @if ($errors->any())
                                 @foreach ($errors->all() as $error)
                                        <div class="text-danger">{{$error}}</div>
                                    @endforeach
                                @endif
                                 <div class="dived d-flex">
                                     <div class="form-group">
                                         <div class="form-sup">
                                             <div class="cal-01">
                                                 <input type="name" name="name" id="" class="form-control" placeholder="Enter Your Name" value="{{ old("name") }}">

                                                 <i class="fal fa-user-tie"></i>
                                             </div>

                                             <div class="cal-01">
                                                 <input type="phone" name="phone" id="" class="form-control" placeholder="Phone Number" value="{{ old("phone") }}">
                                                 <i class="fal fa-phone"></i>
                                             </div>
                                         </div>
                                     </div>

                                     <div class="form-group">
                                         <div class="form-sup">
                                             <div class="cal-01">
                                                 <input type="email" name="email" id="" class="form-control" placeholder="Enter Your Email" value="{{ old("email") }}">
                                                 <i class="fal fa-at"></i>
                                             </div>
                                             <div class="cal-01">
                                                <input type="file" name="image" id="" class="form-control" accept="jpg,png,jpeg">
                                                <i class="fal fa-image"></i>
                                            </div>
                                             <div class="cal-01">
                                                 <input  value="{{ old("subject") }}" type="text" name="subject" id="" class="form-control" placeholder="Enter Your Subject">
                                                 <i class="fal fa-envelope-open-text""></i>
                                             </div>
                                         </div>
                                     </div>

                                     <div class="ca-ool">
                                         <textarea cols="80" rows="6" class="form-control" placeholder="Message" name="message">{{ old("message") }}</textarea>
                                     </div>
                                     <div class="text-center mt-3">
                                        <button class="btn btn-sm text-light" style="background: #E40D1C">Submit</button>
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>

     <section class="mab-01">
         <iframe style="width:100%" src="{{ $website->map }}" height="450" frameborder="0" allowfullscreen=""></iframe>
     </section>
  </main>

@stop

