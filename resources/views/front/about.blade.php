@extends("layouts.front_app")

@section("title","About")
@section("master_content")

<main>
    <!-- ============abt-01 Section  Start============ -->

    <section class="abt-01">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading-wrapper">
                        <h3>About Us</h3>
                        <ol>
                            <li><a class="text-light" href="/">Home<i class="far fa-angle-double-right"></i></a></li>
                            <li>About Us</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-001">
      <div class="container">
          <div class="row" style="text-align: justify;line-height:1.8">
              <div class="text-part col-md-6">
                  <h2>About Us</h2>
                 {!! $data->about !!}

                 @if ($data->mission)
                 <div class="text-part ">
                   <h2>Our Mission</h2>
                   {!! $data->mission !!}
                </div>
                @endif
                @if ($data->vision)
                 <div class="text-part ">
                    <h2>Our Vission</h2>
                   {!! $data->vision !!}
                </div>
                @endauth
              </div>

              <div class="image-part col-md-6">
                  <div class="about-quick-box row">
                      <div class="col-md-6">
                          <div class="about-qcard">
                             <a href="{{ route("contact") }}" style="color: #111">
                                <i class="fas fa-phone"></i>
                                <p>Get in Touch</p>
                             </a>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="about-qcard ">
                            <a href="{{ route("product") }}" style="color: #111">
                              <i class="fas fa-inventory red"></i>
                              <p>Our Products</p>
                            </a>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="about-qcard ">
                              <i class="fas fa-donate yell"></i>
                              <p>Revenue</p>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="about-qcard ">
                            <a href="{{ route("services") }}" style="color: #111">
                              <i class="fas fa-hands-helping blu"></i>
                              <p>Services</p>
                            </a>
                          </div>
                      </div>

                      @if ($data->goal)
                      <div class="text-part ">
                          <h2>Our Goal</h2>
                         {!! $data->goal !!}
                      </div>
                      @endif
                  </div>
              </div>
          </div>
      </div>
    </section>


</main>
@stop
