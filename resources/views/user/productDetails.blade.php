@extends('user.layouts.layout')
@section('meta_property')
	<!-- SEO Meta Tags-->
    <meta name="keywords" content="@if($product->meta_keywords) @forelse(json_decode($product->meta_keywords) as $keyword) {{$keyword}}, @empty @endforelse @endif">
    <meta name="description" content="{{ isset($product->meta_descriptions) ? $product->meta_descriptions : ''}}">
@endsection
@section('user_title_content')
    Ahknoxo | Product Details
@endsection
@section('user_css_content')
	<style type="text/css" media="screen">
		.rating {
		  display: inline-block;
		  position: relative;
		  height: 50px;
		  line-height: 50px;
		  font-size: 50px;
		}

		.rating label {
		  position: absolute;
		  top: 0;
		  left: 0;
		  height: 100%;
		  cursor: pointer;
		}

		.rating label:last-child {
		  position: static;
		}

		.rating label:nth-child(1) {
		  z-index: 5;
		}

		.rating label:nth-child(2) {
		  z-index: 4;
		}

		.rating label:nth-child(3) {
		  z-index: 3;
		}

		.rating label:nth-child(4) {
		  z-index: 2;
		}

		.rating label:nth-child(5) {
		  z-index: 1;
		}

		.rating label input {
		  position: absolute;
		  top: 0;
		  left: 0;
		  opacity: 0;
		}

		.rating label .icon {
		  float: left;
		  font-size: 50px;
		  color: transparent;
		}

		.rating label:last-child .icon {
		  color: #000;
		}

		.rating:not(:hover) label input:checked ~ .icon,
		.rating:hover label:hover input ~ .icon {
		  color: #09f;
		}

		.rating label input:focus:not(:checked) ~ .icon:last-child {
		  color: #000;
		  text-shadow: 0 0 5px #09f;
		}

		.item:hover img {
		    transform: scale(1.1);
		    transition: 0.5s;
		}
		#hover-area {
		  	display: block;
		}
		#reveal {
			background: #fafafa;
			width: 100%;
			display: none;
			border-radius: 3px;
		  	box-shadow: 1px 1px 3px #555;
		  	padding: 25px;
		}
		.return_class {
			display: block;
			text-decoration: none;
			font-size: 1em;
			font-family: sans-serif;
			color: #3E0E0E;
			text-shadow: 0 1px 0 #888;
			-webkit-transition: all 300ms;
			-moz-transition: all 300ms;
			transition: all 300ms;
		}
		.return_class:hover {
			transition-timing-function: ease;
			color: #fafafa;
			text-shadow: 0 1px 0 #ccc, 0 2px 0 #c9c9c9, 0 3px 0 #bbb, 0 4px 0 #b9b9b9, 0 5px 0 #aaa, 0 6px 1px rgba(0,0,0,.1), 0 0 5px rgba(0,0,0,.1), 0 1px 3px rgba(0,0,0,.3), 0 3px 5px rgba(0,0,0,.2), 0 5px 10px rgba(0,0,0,.25), 0 10px 10px rgba(0,0,0,.2), 0 20px 20px rgba(0,0,0,.15);
		}

		.return_text_info {
		  text-align: left;
		}

		.privacy_link{
			color: blue;
		}
		.privacy_link:hover{
			color:blue;
		}

		.external_link{
			color: #159796;
		}
		.external_link:hover{
			color:#159796;
		}
	</style>
@endsection

@section('user_main_content')
	<!-- Page Content Wraper -->
	<div class="page-content-wraper">
   		<!-- Page Content -->
   		<section id="product-ID_XXXX" class="content-page single-product-content pt-5">
      		<!-- Bread Crumb -->
	      	<div class="breadcrumb" style="background-color: transparent;">
	         	<div class="container">
		            <div class="row">
		               	<div class="col-12">
		                  	<nav class="breadcrumb-link">
			                    <a href="{{route('products')}}">Product ></a>
			                    <a href="{{route('shopcategory',$product->category->slug)}}"> {{$product->category->name}} ></a>
		                    	<span>{{$product->name}}</span>
		                  	</nav>
		               	</div>
		            </div>
	         	</div>
	      	</div>
      		<!-- Bread Crumb -->
	      	<!-- Product -->
	      	<div id="product-detail" class="container">
		        <div class="row">
		            <!-- Product Image -->
		            <div class="col-lg-6 col-md-6 col-sm-12 mb-30">
			            <div class="product-page-image">
			                <!-- Slick Image Slider -->
			                <div class="product-image-slider product-image-gallery slider-for">

			                    <div class="item">
			                    	<span class="product-badge bg-dark">{{str_replace(['Product', 'product'],'',$product->type->name)}}</span>
			                        <a class="product-gallery-item">
			                        	@if (Str::startsWith($product->featured_image, 'https'))
		                                    <img src="{{$product->featured_image}}" alt="{{$product->name}}-featured-image">
		                                @else
		                                    <img src="{{Storage::disk('local')->url($product->featured_image)}}" alt="{{$product->name}}-featured-image">
		                                @endif
			                        </a>
			                    </div>

			                    

			                    @if(count($product->images) > 0)
			              			@foreach($product->images as $image)
					                    <div class="item">
					                    	<span class="product-badge bg-dark">{{str_replace(['Product', 'product'],'',$product->type->name)}}</span>
					                        <a class="product-gallery-item">
					                        	<img src="{{Storage::disk('local')->url($image->image_path)}}" alt="{{$product->name}}-image-{{$loop->index + 1}}" />
					                        </a>
					                    </div>
					                @endforeach
						        @endif
			                </div>
			                <!-- End Slick Image Slider -->
			            </div>
			            <!-- Slick Thumb Slider -->
			            <div class="product-image-slider-thumbnails slider-nav">
			                <div class="item">
		                  		@if (Str::startsWith($product->featured_image, 'https'))
                                    <img src="{{$product->featured_image}}" alt="{{$product->name}}-featured-image">
                                @else
                                    <img src="{{Storage::disk('local')->url($product->featured_image)}}" alt="{{$product->name}}-featured-image">
                                @endif
			                </div>
			                @if(count($product->images) > 0)
		              			@foreach($product->images as $image)
				                    <div class="item">
				                        <img src="{{Storage::disk('local')->url($image->image_path)}}" alt="{{$product->name}}-image-{{$loop->index + 1}}" />
				                    </div>
				                @endforeach
					        @endif
			            </div>
			            <!-- End Slick Thumb Slider -->
		            </div>
		            <!-- End Product Image -->
		            <!-- Product Content -->
		            <div class="col-lg-6 col-md-6 col-sm-12 mb-30">
		               	<div class="product-page-content">
		                  	<h2 class="product-title">{{$product->name}}</h2>
		                  	<h4 class="product_sub_title">SKU: {{$product->SKU}}</h4>
		                  	<div class="product-price">
			                  	<span>
				                  	<span class="product-price-sign">&#2547;</span>
				                  	@if(empty($product->special_price))
		                                <span class="product-price-text">{{$product->price}}</span><br>
		                            @else
		                                <span class="product-price-text">{{$product->special_price}}</span>
		                                <del><span class="product-amount">&#2547;{{$product->price}}</span></del><br>
		                            @endif
			                  	</span>
		                  	</div>
		                  	@php
		                  		$rateArray =[];
						        foreach ($product->reviews as $review)
						        {
						           $rateArray[]= $review['rating'];
						        }
						        $sum = array_sum($rateArray);
						        $result = $sum/5;
		                  	@endphp
		                  	<div class="mb-3">
			                  	<div class="product-rating">
			                     	<div class="star-rating" itemprop="reviewRating" itemscope=""
			                        itemtype="http://schema.org/Rating" title="Rated 4 out of 5">
			                        	<span style="width: {{$result * 20}}%"></span>
			                     	</div>
			                  	</div>
			                  	@if($product->stock != 0)
		                     		<span class="text-success  d-inline-block">In Stock</span>
		                     	@else
		                     		<span class="text-danger  d-inline-block">Out Of Stock</span>
		                     	@endif
		                    </div>
		                    <div id="hover-area">
								<p class="return_class"><i class="fa fa-undo" aria-hidden="true"></i> Free Return</p>
								
								<div id="reveal">
									<p class="return_text_info">
										3 Days Returns - Change of mind is not applicable as a Return Reason for this product <a class="privacy_link" href="{{ isset($return) ? route('DynamicPageView',$return->slug) : '#'}}" target="_blank">Read Return Policy</a> and <a class="privacy_link" href="{{ isset($terms) ? route('DynamicPageView',$terms->slug) : '#'}}" target="_blank">Terms of Service</a> apply.
									</p>
								</div>
						    </div>
		                  	<p class="product-description">{{$product->short_description}}</p>
		                  	@if(isset($product->affiliate_link))
		                  		<div class="single-add-to-wrap">
					                <a class="custom-btn btn_button" href="{{$product->affiliate_link}}">Buy</a>
		                  		</div>
			                @else
				                <form class="single-variation-wrap" method="POST" action="{{route('cart.store')}}">
				                	@csrf
				                	<table class="variations">
		                                <tbody>
		                                    <tr>

			                                    @if(isset($attributeOptions) && isset($attributes))
												    @foreach($attributes as $attribute)
												        <td class="label">
												            <label>{{$attribute->name}}: </label>
												        </td>
												        <input type="hidden" name="product_attribute[]" value="{{$attribute->name}}" />
												        <td class="value">
												            <select class="attribute-select" name="product_attribute_option[]">
												                <option disabled value="">Choose an option</option>
												                @foreach($attributeOptions as $option)
												                    @foreach($attribute->attributeOptions as $atOpt)
												                        @if($option->id == $atOpt->id)
												                            <option data-price="{{$option->price}}" value="{{$option->price}}&{{$option->value}}">{{$option->value}}</option>
												                        @endif
												                    @endforeach
												                @endforeach
												            </select>
												        </td>
												    @endforeach
												@endif
		                                    </tr>
		                                </tbody>
		                            </table>

		                            <!-- Price Display -->
									<p id="price_show"></p>

				                    <div class="product-quantity">
				                        <span data-value="+" class="quantity-btn quantityPlus"></span>
				                        <input class="quantity input-lg" step="1" min="1" max="100" name="quantity" value="1" title="Quantity" type="number" />
				                        <span data-value="-" class="quantity-btn quantityMinus"></span>
				                    </div>
				                    <input type="hidden" name="id" value="{{$product->id}}" />
				                    <input type="hidden" name="refferer_id" value="{{ isset($reffererId) ? $reffererId : ''}}" />
				                    <button style="margin-top: 10px;" type="submit" class="btn btn-lg btn-black">Add to cart</button>

				                    
				                </form>
			                @endif
			                <div class="single-add-to-wrap">
			                	<form id="wish-add-form-{{$product->id}}" method="POST" action="{{route('wishPost')}}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$product->id}}" />
                                </form>
                                <a rel="nofollow" onclick="document.getElementById('wish-add-form-{{$product->id}}').submit();" class="single-add-to-wishlist">
                                	<i class="fa fa-heart left" aria-hidden="true"></i>
			                        <span class="text-capitalize">Browse Wishlist</span>
                                </a>
			                    {{-- <a class="single-add-to-compare ">
			                    	<i class="fa fa-refresh left" aria-hidden="true"></i>
			                    	<span class="text-capitalize">Compare</span>
			                    </a> --}}
			                </div>
			                <div class="product-meta">
			                    <span>Categories: 
			                    	<span class="sku" itemprop="sku">
			                    		<a class="external_link" href="{{route('shopcategory',$product->category->slug)}}" title="category">{{$product->category->name}}</a> 
			                    		{{ isset($product->subCategory) ? '/ ' : ''}}
				                    	@if(isset($product->subCategory))
				                    		<a class="external_link" href="{{route('shopcategory',$product->subCategory->slug)}}" title="sub category">{{$product->subCategory->name}}</a>
				                    	@endif
				                    </span>
				                </span>
			                    @if($product->tags)
			                    	<span class="label label-default">New</span></h6>
			                    	<span> Tags:  
			                    	@forelse(json_decode($product->tags) as $tag) 
			                    		<a href="{{ route('products.byTag', ['tag' => $tag]) }}"><span class="badge badge-info">{{$tag}}</span></a>, 
			                    	@empty 
			                    	@endforelse 
			                    	</span>
			                    @endif

			                    {{-- <span>Tags: <span class="category" itemprop="category">
			                    	{{str_replace(['Product', 'product'],'',$product->type->name)}}</span></span> --}}
			                </div>
		               </div>
		            </div>
		        </div>
	      	</div>
	      	<!-- End Product -->
		    <!-- Product Content Tab -->
		    <div class="product-tabs-wrapper container">
		        <ul class="product-content-tabs nav nav-tabs" role="tablist">
		            <li class="nav-item">
		               	<a class="active" href="#tab_description" role="tab" data-toggle="tab">Descriptiont</a>
		            </li>
		            <li class="nav-item">
		               	<a class="" href="#tab_specification" role="tab" data-toggle="tab">Specifications</a>
		            </li>
		            <li class="nav-item">
		               	<a class="" href="#tab_reviews" role="tab" data-toggle="tab">Reviews (<span>{{count($product->reviews)}}</span>)</a>
		            </li>
		        </ul>
		        <div class="product-content-Tabs_wraper tab-content container">
		            <div id="tab_description" role="tabpanel" class="tab-pane fade in active">
		               	<!-- Accordian Title -->
		               	<h6 class="product-collapse-title" data-toggle="collapse"
		                  data-target="#tab_description-coll">Description</h6>
		               	<!-- End Accordian Title -->
		               	<!-- Accordian Content -->
		               	<div id="tab_description-coll" class="shop_description product-collapse collapse container">
			                <div class="row">
			                    <div class=" col-md-12">
			                        <p>{!!htmlspecialchars_decode($product->description)!!}</p>
			                    </div>
			                </div>
		               	</div>
		               <!-- End Accordian Content -->
		            </div>
		            <div id="tab_specification" role="tabpanel" class="tab-pane fade">
		            	<!-- Accordian Title -->
		               	<h6 class="product-collapse-title" data-toggle="collapse" data-target="#tab_specification-coll">Specifications</h6>
		                <!-- Accordian Content -->
		               	<div id="tab_specification-coll" class="shop_description product-collapse collapse container">
			            	<div class="comparison-table">
			                    <table class="table table-bordered">
			                        <thead class="bg-secondary">
			                        </thead>
				                     <tbody>
				                     	@php
										    $specification_names = json_decode($product->specification_name);
										    $specification_descriptions = json_decode($product->specification_description);
										@endphp
				                        <tr class="bg-secondary">
				                            <th class="text-uppercase">Specifications</th>
				                            <td><span class="text-medium">Descriptions</span></td>
				                        </tr>
				                        @forelse($specification_names as $specification_name)
					                        <tr>
					                            <th>{{$specification_name}}</th>
					                            <td>{{$specification_descriptions[$loop->index]}}</td>
					                        </tr>
				                        @empty
				                        @endforelse
				                    </tbody>
			                    </table>
			                </div>
			            </div>
		            </div>
		            <div id="tab_reviews" role="tabpanel" class="tab-pane fade">
		               	<!-- Accordian Title -->
		               	<h6 class="product-collapse-title" data-toggle="collapse" data-target="#tab_reviews-coll">
		                  	Reviews ({{count($product->reviews)}})
		               	</h6>
		               	<!-- End Accordian Title -->
		               	<!-- Accordian Content -->
		               	<div id="tab_reviews-coll" class=" product-collapse collapse container">
		                  	<div class="row">
			                    <div class="review-form-wrapper col-md-6">
			                        <h6 class="review-title">Add a Review </h6>
			                        @guest
			                        	<p class="comment-form-rating">
                                            <label>Please login first for add review</label>
                                        </p>
                                        <a class="custom-btn btn_button" href="{{route('login')}}">Login</a>

                                        
			                        @else
			                        	@if ($errors->any())     
                                            @foreach ($errors->all() as $error)
                                                <div class="alert alert-danger alert-block">
                                                    <a type="button" class="close" data-dismiss="alert"></a> 
                                                    <strong>{{ $error }}</strong>
                                                </div>
                                            @endforeach                                        
                                        @endif
                                        @if(session()->has('message_review'))
                                            <div class="alert alert-success alert-blo">
                                                <a type="button" class="close" data-dismiss="alert"></a> 
                                                <strong> {{ session()->get('message_review') }} </strong>
                                            </div>
                                        @endif
				                        <form class="comment-form" action="{{route('review.reviewstore', $product->slug)}}" method="GET">
				                        	@csrf
                                            {{method_field('PUT')}}
				                           	<div class="form-field-wrapper">
					                           	<label>Your Rating</label>
					                           	<p class="rating">
				                                 	<label>
													    <input type="radio" name="rating" value="1" />
													    <span class="icon">★</span>
													</label>
													<label>
													    <input type="radio" name="rating" value="2" />
													    <span class="icon">★</span>
													    <span class="icon">★</span>
													</label>
													<label>
													    <input type="radio" name="rating" value="3" />
													    <span class="icon">★</span>
													    <span class="icon">★</span>
													    <span class="icon">★</span>   
													</label>
													<label>
													    <input type="radio" name="rating" value="4" />
													    <span class="icon">★</span>
													    <span class="icon">★</span>
													    <span class="icon">★</span>
													    <span class="icon">★</span>
													</label>
													<label>
													    <input type="radio" name="rating" value="5" />
													    <span class="icon">★</span>
													    <span class="icon">★</span>
													    <span class="icon">★</span>
													    <span class="icon">★</span>
													    <span class="icon">★</span>
													</label>
					                            </p>
				                           	</div>
				                           	<div class="form-field-wrapper">
				                              	<label>Your Review <span class="required">*</span></label>
				                              	<textarea id="comment" class="form-full-width" name="review" cols="45" rows="8" aria-required="true" required=""></textarea>
				                           	</div>
				                           	<div class="form-field-wrapper">
				                              	<input name="submit" id="submit" class="submit btn btn-md btn-color" value="Submit" type="submit">
				                           </div>
				                        </form>
			                        @endguest
			                    </div>
			                    <div class="comments col-md-6">
			                        <h6 class="review-title">Customer Reviews</h6>
			                        <!--<p class="review-blank">There are no reviews yet.</p>-->
			                        <ul class="commentlist">
			                        	@foreach($product->reviews as $review)
			                           	<li id="comment-10{{$loop->index + 1}}" class="comment-10{{$loop->index + 1}}">
			                           		@if(isset($review->user->profile_image))
			                              		<img src="{{Storage::disk('local')->url($review->user->profile_image)}}" class="avatar" alt="author" />
			                              	@else
				                              	<img src="{{asset('viewport/img/avatar.jpg')}}" class="avatar" alt="author" />
			                              	@endif
			                              	<div class="comment-text">
			                                 	<div class="star-rating" itemprop="reviewRating" itemscope="" itemtype="http://schema.org/Rating" title="Rated 4 out of 5">
			                                    	<span style="width: {{$review->rating * 20}}%"></span>
			                                 	</div>
			                                 	<p class="meta">
			                                    	<strong itemprop="author">{{$review->user->name}}</strong>
			                                    	&nbsp;&mdash;&nbsp;
			                                    	<time itemprop="datePublished" datetime="">{{ Carbon\Carbon::parse($review->created_at)->format('M d, Y') }}</time>
			                                 	</p>
			                                 	<div class="description" itemprop="description">
			                                    <p>{{$review->review}}</p>
			                                 	</div>
			                              	</div>
			                           	</li>
			                           	@endforeach
			                           	
			                        </ul>
			                    </div>
		                  	</div>
		               	</div>
		               	<!-- End Accordian Content -->
		            </div>
		        </div>
		    </div>
		    <!-- End Product Content Tab -->
   		</section>
   		<!-- End Page Content -->
	   	<!-- about banner section -->
	   	<section class="banner_section section-padding">

		    @include('user.home.single_column')

		</section>
	   	<!-- end about banner section -->
	   	<!-- Customization section -->
	   	<section class="custmoization_section section-padding">
	      	@include('user.home.recent-item')
	   	</section>
	   	<!-- end customization section -->
	</div>
	<!-- End Page Content Wraper -->
@endsection
@section('user_js_content')
	<script>
		$(document).ready(function(){
	      	$('.slider-for').slick({
			  slidesToShow: 1,
			  slidesToScroll: 1,
			  arrows: false,
			  fade: true,
			  asNavFor: '.slider-nav'
			});
			$('.slider-nav').slick({
			  slidesToShow: 3,
			  slidesToScroll: 1,
			  asNavFor: '.slider-for',
			  dots: true,
			  centerMode: true,
			  focusOnSelect: true
			});
	    });

		$(document).ready(function(){
		  $("#hover-area").click(function(){
		    $("#reveal").slideToggle(300);
		  });
		});
	    // Add event listeners to all select elements with the class "attribute-select"
	    var selectElements = document.querySelectorAll('.attribute-select');
	    selectElements.forEach(function(select) {
	        select.addEventListener('change', function() {
	            // Get the selected option
	            var selectedOption = this.options[this.selectedIndex];

	            // Extract price and value from the selected option
	            var priceAndValue = selectedOption.value.split('&');
	            var price = parseFloat(priceAndValue[0]);
	            var value = priceAndValue[1];

	            // Update the price display if the price is greater than 0
	            var priceDisplay = document.getElementById('price_show');
	            if (price > 0) {
	                priceDisplay.textContent = "You must pay extra " + price + " for " + value;
	            } else {
	                // If the price is 0 or not specified, clear the price display
	                priceDisplay.textContent = "";
	            }
	        });
	    });
	</script>
@endsection