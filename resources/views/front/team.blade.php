@extends("layouts.front_app")

@section("title","Team")
@section("master_content")

<main>
    <!-- ============abt-01 Section  Start============ -->

    <section class="abt-01">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading-wrapper">
                        <h3>Team</h3>
                        <ol>
                            <li><a class="text-light" href="/">Home<i class="far fa-angle-double-right"></i></a></li>
                            <li>Team</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-04">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="heading">
                  <h2><a href="{{ route("teams") }}" class="text-dark">Meet Our Team</a></h2>
              </div>
            </div>

            <div class="main-team-card d-flex">
              @foreach ($teams as $team)
              <div class="team-setup">
                <div class="team-items">
                  <div class="team-user">
                    <img src="{{ $team->image }}">
                  </div>
                  <div class="team-user-social">
                    <ol>
                      <li><a href="{{ $team->fb }}" class="text-light"><i class="fab fa-facebook-f"></i></a></li>
                      {{-- <li><a href="{{ $team->fb }}" class="text-light"><i class="fa fa-phone"></i></a></li>
                      <li><i class="fab fa-google"></i></li>
                      <li><i class="fab fa-skype"></i></li> --}}
                    </ol>
                  </div>
                  <div class="team-name">
                    <h2>{{ $team->name }}</h2>
                    <b>{{ $team->designation }}</b>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
            {{ $teams->links() }}
          </div>
        </div>
      </section>
</main>
@stop
