@extends("layouts.front_app")

@section("title",ucfirst($type) )
@section("master_content")

<main>
    <!-- ============abt-01 Section  Start============ -->

    <section class="abt-01">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading-wrapper">
                        <h3>Activity</h3>
                        <ol>
                            <li><a class="text-light" href="/">Home<i class="far fa-angle-double-right"></i></a></li>
                            <li>{{ ucfirst($type) }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-02">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="heading">
                <h2>Recent {{ ucfirst($type) }}</h2>
              </div>
            </div>

            @foreach ($activities as $act)
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="wrapper">
              <a href="{{ route("single",$act->slug) }}">
                  <figure>
                    <img src="{{ asset( $act->image ) }}" alt="{{ $act->title}}" loading="lazy">
                  </figure>
                  <div class="bs">
                    <h3>{{ $act->title }}</h3>
                    <p>{{ show_in_html($act->description,12) }}
                      </p>
                      <ol class="text-dark">
                        <li><i class="fal fa-signal"></i>Goal: TK {{ $act->estimate }}</li>
                        <li><i class="fal fa-thumbs-up"></i>Raised: TK {{ $act->collect }}</li>
                      </ol>
                  </div>
              </a>
              </div>
            </div>
            @endforeach

            {{ $activities->links() }}
          </div>
        </div>
      </section>

</main>
@stop
