@extends('user.layouts.layout')

@section('meta_property')
	<!-- SEO Meta Tags-->
    <meta name="keywords" content="@if($product->meta_keywords) @foreach(json_decode($product->meta_keyword) as $keyword) {{$keyword}}, @endforeach @endif">
    <meta name="description" content="{{ isset($product->meta_desc) ? $product->meta_desc : ''}}">
@endsection
@section('user_title_content')
    Ahknoxo | Affiliate Product
@endsection
@section('user_css_content')
@endsection

@section('user_main_content')
	<!-- hero area about -->

	<section class="about_hero_area section-padding">

		<div class="container">

			<div class="row">

				<div class="col-md-12">

					<div class="about_hero_area_content">

						<h2>{{$product->name}}</h2>

						<p>{{$product->short_description}}</p>

					</div>

				</div>

			</div>

		</div>

	</section>

	<!-- end hero area about -->

	<!-- video-section -->

	<section class="video_section_ml section-padding"> 

		<div class="container">
	  		<img style="width: 300px; height: 300px " src="{{Storage::disk('local')->url($product->gallery_image)}}" alt="">


		    <h2>{{$product->name}}</h2>

		    <p>{!!htmlspecialchars_decode($product->description)!!}</p>

		    @if(isset($product->special_price) || (isset($productOffer) && strtotime($productOffer->last_date) > strtotime(now()->format('d-M-Y'))))
			    <strike> &#2547;{{$product->price}}</strike>  
			@endif

            @if((isset($productOffer) && strtotime($productOffer->last_date) > strtotime(now()->format('d-M-Y'))))

		        @php
				    $offerPercentage = $product->offer->offer_percentage;
				    $currentPrice = isset($product->special_price) ? $product->special_price : $product->price;
				    $discountedPrice = $currentPrice - ($currentPrice * ($offerPercentage / 100));
				@endphp

	            <span>&#2547;{{ $discountedPrice }}</span> 
	        @else
	            <span>&#2547;{{ isset($product->special_price) ? $product->special_price : $product->price }}</span> 
	        @endif
            <br>
            <br>
            <form action="{{route('mlmcheckout')}}" method="get" accept-charset="utf-8">

            	<input type="hidden" name="digitalproductId" value="{{$product->id}}">
            	<input type="hidden" name="offerId" value="{{ isset($productOffer) ? $productOffer->id : null}}">
			    <button class="custom-btn btn_button" type="submit" >Buy Now</button>
            </form>

	    	<div class="row mb_vi">
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

			                  	{{-- <a class="custom-btn btn_button" href="single-mml-product.php">Buy Now</a> --}}

			                </div>

		              	</div>

		            </div>

	          	</div>

	          	@endforeach
		        @endif
	    	</div>

		</div>

	</section>



	<!-- Customization section -->

	<section class="custmoization_section section-padding">

	  	@include('user.home.recent-item')

	</section>

<!-- end customization section -->
@endsection
@section('user_js_content')
@endsection