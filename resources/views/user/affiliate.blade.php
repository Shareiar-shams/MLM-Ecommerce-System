@extends('user.layouts.layout')
@section('user_title_content')
    Ahknoxo | Affiliate
@endsection
@section('user_css_content')
@endsection

@section('user_main_content')
	<!-- hero area about -->

	{{-- <section class="about_hero_area section-padding">

		<div class="container">

			<div class="row">

				<div class="col-md-12">

					<div class="about_hero_area_content">

						<h2>Affiliate Product</h2>


					</div>

				</div>

			</div>

		</div>

	</section> --}}

	<!-- end hero area about -->



    <!-- mml product section -->

    <section class="mml_product_section section-padding">

      <div class="container">
      	@if(isset($digital_products))
      	@foreach($digital_products as $product)
        <div class="row">

          <div class="col-md-6">

            <div class="image_mml">

              <img src="{{Storage::disk('local')->url($product->featured_image)}}">

            </div>

          </div>

          <div class="col-md-6 ">

            <div class="mml_product_content align-items-center">

              <h2>{{$product->name}}</h2>
              @if(isset($product->special_price) || ($product->offer && $product->offer->status == 1 && $product->offer->offer_type === 'normal' && strtotime($product->offer->last_date) > strtotime(now()->format('d-M-Y'))))

	            		<strike> &#2547;{{$product->price}}</strike> 

	            @endif
	            @if(isset($product->offer) && ($product->offer && $product->offer->status == 1 && $product->offer->offer_type === 'normal' && strtotime($product->offer->last_date) > strtotime(now()->format('d-M-Y'))))

	            	@php
								    $offerPercentage = $product->offer->offer_percentage;
								    $currentPrice = isset($product->special_price) ? $product->special_price : $product->price;
								    $discountedPrice = $currentPrice - ($currentPrice * ($offerPercentage / 100));
								@endphp

	            	<span>&#2547;{{ $discountedPrice }}</span> 
	            @else
	            	<span>&#2547;{{ isset($product->special_price) ? $product->special_price : $product->price }}</span> 
	            @endif
              <p>{{$product->short_description}}</p>

              <a class="custom-btn btn_button" href="{{route('mlmproduct', $product->slug)}}">Details</a>

            </div>

          </div>

        </div>
        @endforeach
        @endif

        <!-- end one row -->

        <!-- start tow row -->

        <div class="row">
        	@if(isset($upcoming_products))
	      	@foreach($upcoming_products as $product)
          <div class="col-md-6">

            <div class="mll_product_box">

              <img src="{{Storage::disk('local')->url($product->featured_image)}}" alt="" class="">

              <div class="overlay_mml">

                <div class="text_mml">

                  <h2>{{$product->name}}</h2>

                  <p>{{$product->short_description}}</p>
                  <h2>Upcoming Product</h2>
                  {{-- <a class="custom-btn btn_button" href="{{route('mlmproduct')}}">Buy Now</a> --}}

                </div>

              </div>

            </div>

          </div>
          @endforeach
	        @endif
	        {{-- <div class="col-md-6">

            <div class="mll_product_box">

              <img src="{{asset('viewport/img/mll-web.jpg')}}" alt="" class="">

              <div class="overlay_mml">

                <div class="text_mml">

                  <h2>Web Development</h2>

                  <p>services, or brands online. It encompasses a wide range of strategies and tactics that are designed to connect businesses with their target audience, increase brand awareness, drive website traffic, generate leads, and ultimately, achieve business objectives.</p>

                  <a class="custom-btn btn_button" href="{{route('mlmproduct')}}">Buy Now</a>

                </div>

              </div>

            </div>

          </div>
          <div class="col-md-6">

            <div class="mll_product_box">

              <img src="{{asset('viewport/img/bg.jpg')}}" alt="" class="">

              <div class="overlay_mml">

                <div class="text_mml">

                  <h2>Web Development</h2>

                  <p>services, or brands online. It encompasses a wide range of strategies and tactics that are designed to connect businesses with their target audience, increase brand awareness, drive website traffic, generate leads, and ultimately, achieve business objectives.</p>

                  <a class="custom-btn btn_button" href="{{route('mlmproduct')}}">Buy Now</a>

                </div>

              </div>

            </div>

          </div> --}}

        </div>

      </div>

    </section>

    <!-- end mml product section -->



	<!-- Customization section -->

	<section class="custmoization_section section-padding">

	  	@include('user.home.recent-item')

	</section>

	<!-- end customization section -->
@endsection
@section('user_js_content')
@endsection