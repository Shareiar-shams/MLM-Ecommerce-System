<div class="container">

    <div class="row">

	    <div class="col-md-6">
	        @if(isset($slider_items))
		        <div class="slider_favorite">

		          <h4>{{$slider_items->heading}}</h4>

		          <h2>{{$slider_items->sub_heading}}</h2>

		        </div>
		    @else
		    	<div class="slider_favorite">

		          <h4>Favorite products</h4>

		          <h2>Shop this look</h2>

		        </div>
		    @endif

	        <div class="owl-carousel owl-theme">
	        	@foreach($categoriesProducts as $product)
			        <div class="item">

			            @if (Str::startsWith($product->featured_image, 'https'))
		                    <img height="200" src="{{$product->featured_image}}" alt="Product Image" class="">
		                @else

		                    <img height="200" src="{{Storage::disk('local')->url($product->featured_image)}}" alt="Product Image" class="">
		                @endif

			            <h4><a class="product-link" href="{{route('productDetails',$product->slug)}}">{{$product->name}}</a><br></h4>
			            @if(empty($product->special_price))
                            <span class="product-amount">&#2547;{{$product->price}}</span><br>
                        @else
                            <span class="product-amount">&#2547;{{$product->special_price}}</span>
                            <del><span class="product-amount">&#2547;{{$product->price}}</span></del><br>
                        @endif
			            {{-- <p>$360</p> --}}

			            <a class="custom-btn btn_button" href="{{route('productDetails',$product->id)}}">View</a>

			        </div>
		        @endforeach
		        

	        </div>

	    </div>

	    <div class="col-md-6">

	        <div class="imaga_fav">
	        	@if(isset($slider_items))
	        		<img src="{{Storage::disk('local')->url($slider_items->bg_image)}}">
	          	@else
	          		<img src="{{asset('viewport/img/pens.jpg')}}">

	          	@endif

	        </div>
	        <div class="wrapper_video">
	          	<div class="video-main">
		            <div class="promo-video">
			            <div class="waves-block">
			                <div class="waves wave-1"></div>
			                <div class="waves wave-2"></div>
			                <div class="waves wave-3"></div>
			            </div>
		            </div>
		            @if(isset($slider_items))
		        		
		        		<a href="{{$slider_items->button_url}}" class="video video-popup mfp-iframe" data-lity><i class="fa fa-play"></i></a>
		          	@else

		          		<a href="https://www.youtube.com/watch?v=BqI0Q7e4kbk" class="video video-popup mfp-iframe" data-lity><i class="fa fa-play"></i></a>

		          	@endif
	            
	          	</div>
	        </div>

	    </div>

    </div>

</div>