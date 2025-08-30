@extends("layouts.front_app")

@section("title",404 )
@section("master_content")

<main>
    <!-- ============abt-01 Section  Start============ -->

    <section class="abt-01">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading-wrapper">
                        <h3>404</h3>
                        <ol>
                            <li><a class="text-light" href="/">Home<i class="far fa-angle-double-right"></i></a></li>
                            <li>404</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-02">
        <h2 class="text-center">Page not found!</h2>
        <a href="/" class="btn btn-link text-center d-block">Back</a>
      </section>

</main>
@stop
