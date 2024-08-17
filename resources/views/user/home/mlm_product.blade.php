<!-- mml all product -->

<section class="mml_all_product section-padding">

  	<div class="container">
  		@forelse($digital_products as $product)
			<div class="row mll_product_box_ab">

			        <div class="col-md-6">

			          	<div class="mml_all_product_img">

			            	<img src="{{Storage::disk('local')->url($product->featured_image)}}">

			          	</div>

			        </div>

			        <div class="col-md-6">

				        <div class="mml_all_product_content">

				            <h2>{{$product->name}}</h2>

				            <p>{{$product->short_description}}</p>

				            <a class="custom-btn btn_button" href="{{route('mlmproduct', $product->slug)}}">Details</a>

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

				        </div>

			      	</div>

			</div>
		@empty
		  	<h2>Just Wait for Us. We add a course soon.</h2>
	    @endforelse

	    @forelse($upcoming_products as $product)
		    <div class="row mll_product_box_ab">

		        <div class="col-md-6">

		          <div class="mml_all_product_img">

		            <img src="{{Storage::disk('local')->url($product->featured_image)}}">

		          </div>

		        </div>

		        <div class="col-md-6">

		          <div class="mml_all_product_content">

		            <h2>{{$product->name}}</h2>

		            <p>{{$product->short_description}}</p>
		            <h2>Upcoming Product</h2>
		            {{-- <a class="custom-btn btn_button" href="{{route('mlmproduct')}}">Buy Now</a>

		            <span>$250</span>  --}}

		          </div>

		    </div>
		  @empty
	    @endforelse

		{{-- <div class="row mll_product_box_ab mll_digital_box">

	        <div class="col-md-6">

	          	<div class="mml_all_product_img">

	            	<img src="{{asset('viewport/img/digital-marketing.jpg')}}">

	          	</div>

	        </div>

	        <div class="col-md-6">

		        <div class="mml_all_product_content">

		            <h2>Digital Marketing</h2>

		            <p>services, or brands online. It encompasses a wide range of strategies and tactics that are designed to connect businesses with their target audience, increase brand awareness, drive website traffic, generate leads, and ultimately, achieve business objectives.</p>

		            <a class="custom-btn btn_button" href="{{route('mlmproduct')}}">Buy Now</a>

		            <span>$250</span> 

		        </div>

	      	</div>

	    </div> --}}

  	</div>

</section>

		<!-- end mml all product -->