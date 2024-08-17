<div class="deal-of-day-section mt-20">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2 class="h3">{{ isset($campaign) ? $campaign->name : null}}</h2>
                    <div class="right-area">
                        

                        <div class="countdown countdown-alt" id="countdown" data-date="{{ isset($campaign) ? \Illuminate\Support\Carbon::parse($campaign->last_date)->format("Y-m-d H:i:s") : null }} ">
						    <span id="days">00</span> <small>Day</small>
						    <span id="hours">00</span> <small>Hrs</small>
						    <span id="minutes">00</span> <small>Min</small>
						    <span id="seconds">00</span> <small>Sec</small>
						</div>

                        <a class="right_link" href="{{route('campaign_product')}}">View All 
                        	<i class="fa fa-chevron-right"></i>
                        </a>

                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3">
			<div class="col-lg-12">
        		<div class="popular-category-slider owl-carousel owl-loaded owl-drag">
            		<div class="owl-stage-outer">
        				<div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2868px;">
        					@forelse($campaign->products as $product)
        						@if($product->pivot->id == true)
		    						<div class="owl-item {{ $loop->index == 0 ? 'active' : ($loop->index == 1 ? 'active' : '') }}" >
										<div class="slider-item">
			                            	<div class="product-card">
			                                	<div class="product-thumb cls_img_box">

			                                		<span class="product-badge bg-dark">{{str_replace(['Product', 'product'],'',$product->type->name)}}</span>

			                                		@if(isset($product->special_price))
		            								<div class="product-badge product-badge2 bg-info"> 
		            									-{{ round((($product->price - $product->special_price) / $product->price) * 100) }}%

		            								</div>
		            								@endif
		                            				<img alt="Product" src="{{Storage::disk('local')->url($product->featured_image)}}" style="">
		            								
		                          					<div class="overlay_img">

									                    <ul>

										                    <li>
										                    	<form id="wish-add-form-{{$product->id}}" method="POST" action="{{route('wishPost')}}">
									                                @csrf
									                                <input type="hidden" name="id" value="{{$product->id}}" />
									                            </form>

									                            <a rel="nofollow" onclick="document.getElementById('wish-add-form-{{$product->id}}').submit();" class="wishBtn"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

										                    </li>

										                    <li>
										                    	@if(isset($product->affiliate_link))
                               

									                                <a href="{{$product->affiliate_link}}"><i class="fa fa-arrow-right"></i></a>
									                                
									                            @else
									                                <a rel="nofollow" onclick="addToCart({{$product->id}})"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
									                            @endif

									                            <form id="cart-add-form-{{$product->id}}" method="POST" action="{{ route('cart.store') }}">
										                            @csrf
										                            <input type="hidden" name="quantity" value="1" title="Qty" class="input-text qty text"/>
										                            <input type="hidden" name="id" value="{{$product->id}}" />
										                        </form>

										                    </li>

									                        <div class="product-button">
									                            
									                            <div class="favIcon">
									                                
									                            </div>
									                        </div>

									                    </ul>

									                </div>
		        								</div>
			                                    <div class="product-card-body">

			                                        <div class="product-category">
			                                        	<a href="{{route('shopcategory',$product->category->slug)}}">{{$product->category->name}}</a>
			                                        </div>
			                                        <h3 class="product-title">
			                                        	<a href="{{route('productDetails',$product->slug)}}">
				                                            {{$product->name}}
			                                        	</a>
			                                        </h3>
			                                        @php
                                                        $rateArray =[];
                                                        foreach ($product->reviews as $review)
                                                        {
                                                           $rateArray[]= $review['rating'];
                                                        }
                                                        $sum = array_sum($rateArray);
                                                        $result = $sum/5;
                                                    @endphp
                                                    <div class="star-rating" itemprop="reviewRating" itemscope=""
                                                    itemtype="http://schema.org/Rating" title="Rated 4 out of 5">
                                                        <span style="width: {{$result * 20}}%"></span>
                                                    </div>
                                                    <span class="review_count">({{count($product->reviews)}} reviews)</span>
                                                    <br>

                                                    <h4 class="product-price">
                                                    	@if(!empty($product->special_price))
                                                        	<del>&#2547;{{$product->price}}</del>
                                                        	{{isset($product->special_price) ? $product->special_price : $product->price}}
                                                        @else
                                                        	{{$product->price}}
                                                        @endif
                                            		</h4>

			                                    </div>

		   		 							</div>
										</div>
		  							</div>
	  							@endif
		                    @empty
		                    @endforelse
      					</div>
        			</div>
                    
                    <div class="owl-dots disabled"></div>
                </div>
    		</div>
        </div>
    </div>
</div>
