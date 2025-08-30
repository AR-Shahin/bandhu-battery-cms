@extends("layouts.front_app")

@section("title","Product")
@push("css")
<style>
    .form-group,.form-control{
        border: 1px solid #E40D1C;
        border-radius: 5px;
        padding: 10px!important;
        margin : 0 2px;
    }
    .form-control{
        padding: 12px!important;
        border: 1px solid #E40D1C;
        border-radius: 5px;
    }
    .btn_custom{
        padding: 10px 25px!important;
    }
</style>
@endpush
@section("master_content")
<main class="charity-01-main">

    <!-- ============abt-01 Section  Start============ -->

    <section class="abt-01">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading-wrapper">
                        <h3>Product</h3>
                        <ol>
                            <li><a href="/" class="text-light">Home<i class="far fa-angle-double-right"></i></a></li>
                            <li>Product</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-02">
        <div class="container">
           <div class="row">
              <div class="col-12 mb-2">
                 <div class="heading">
                    <h2><a href="" class="text-dark">Our Product</a></h2>
                    <p>Currently, we have a total of <b style="color: #E40D1C">{{ $products->total() }}</b> products.</p>
                 </div>
              </div>
              <div class="col-12 mb-2">
                <form action="{{ route("product") }}" class="my-2">
                    <div class="row no-gutters">
                        <div class="col-md-2">
                            <x-form.select
                            label=""
                            name="category"
                            id="category_id"
                            :items="$categories"
                            :value="request()->category"
                            />
                        </div>
                        <div class="col-md-2">
                            <x-form.select
                            label=""
                            name="sub_category"
                            id="sub_category"
                            :items="$sub_categories"
                            :value="request()->sub_category"
                            />
                        </div>
                        <div class="col-md-2">
                            <x-form.select
                            label=""
                            name="brand"
                            id="brand_id"
                            :items="$brands"
                            :value="request()->brand"
                            />
                        </div>
                        <div class="col-md-4">
                            <div class="e">
                                <input name="search_key" type="text" class="form-control" placeholder="Type Anything" value="{{ request()->search_key }}">
                            </div>
                        </div>
                        <div class="col-md-2 align-self-center text-center">
                            <div class="d-flex text-center">
                            <button type="submit" class="btn btn_custom btn-success ml-3">Search</button>
                            <a href="{{ route("product") }}" class="btn btn_custom btn-warning ml-2">Clear</a>
                            </div>
                        </div>
                    </div>
                </form>
             </div>

              @forelse ($products as $product)
              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
               <x-front.product :product="$product"/>
              </div>
              @empty
              <h4 style="color: #e40d1c">The product is unavailable for the following query.!</h4>
              @endforelse
           </div>
           @if($products->count())
            {{ $products->links() }}
           @endif
        </div>
     </section>

  </main>

@stop

