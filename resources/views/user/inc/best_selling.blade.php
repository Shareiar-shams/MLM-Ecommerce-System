<h6 class="widget-title">Best Selling Products</h6>
<ul class="widget-content">
	@forelse($bestSellers as $item)
		@if($item->productType != 'customize')
	    	<!--Item-->
			<li>

			    <a class="product-img" href="#">
					@if (Str::startsWith($item->featured_image, 'https'))
		              	<img height="50" src="{{$item->featured_image}}" alt="Product Image">
		          	@else

		              <img height="50" src="{{Storage::disk('local')->url($item->featured_image)}}" alt="Product Image">
		          	@endif
			    </a>
			    <div class="product-content">
			        <a class="product-link" href="{{route('productDetails',$item->slug)}}">{!! Str::limit($item->name, 25) !!}</a>

			        @if(empty($item->special_price))
	                  	<span class="product-amount">&#2547;{{$item->price}}</span><br>
	              	@else
	                  <span class="product-amount">&#2547;{{$item->special_price}}</span>
	              	@endif

	              	@php
	                      $rateArray =[];
	                      foreach ($item->product->reviews as $review)
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
	                <span class="review_count">({{count($item->product->reviews)}} reviews)</span>

			    </div>
			</li>
		@endif
    @empty
    @endforelse

</ul>