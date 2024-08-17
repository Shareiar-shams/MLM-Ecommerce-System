<div class="col-md-4">
    <div class="card widget widget-featured-posts widget-order-summary p-4">
        <h3 class="widget-title">Order Summary</h3>
        {{-- <p class="free-shippin-aa">
          <em>Free Shipping Ater order $1,000.00</em>
        </p> --}}
        <table class="table">
          <tbody>
          	<p class="free-shippin-aa">
          		<em>Free Shipping After Order &#2547;{{$shipping_fixed->cost}}</em>
          	</p>
            <tr>
              <td>Cart Subtotal:</td>
              <td class="text-gray-dark"> &#2547; {{ \Cart::session(Session::getId())->getSubtotal() }}</td>
            </tr>
            {{-- <tr>
              <td>Estimated tax:</td>
              <td class="text-gray-dark">$1.94</td>
            </tr> --}}
        	<tr>
                @forelse(\Cart::session(Session::getId())->getConditions() as $condition)
                    @if($condition->getType() == 'coupon')
                    	<td>Coupon Discount</th>
                        <td class="text-gray-dark">-&#2547;{{ number_format((float)\Cart::session(Session::getId())->getCondition($condition->getName())->getCalculatedValue(\Cart::session(Session::getId())->getSubTotal()), 2, '.', '') }}</td>
                    @endif
                @empty
                @endforelse
            </tr>
            <tr>
              <td class="text-lg text-primary">Order total</td>
              <td class="text-lg text-primary grand_total_set">&#2547; {{ number_format((float)\Cart::session(Session::getId())->getTotal(), 2, '.', '') }}</td>
            </tr>
          </tbody>
        </table>
    </div>
    <div class="card widget widget-featured-posts widget-featured-products p-4">
        <h3 class="widget-title">Items In Your Cart</h3>
    	<div class="entry">
	   		<table class="table">
	   			<tbody>
				@forelse(\Cart::session(Session::getId())->getContent() as $item)
					<tr>
						<th>
					        <div class="entry-thumb">
					        	<a href="{{route('productDetails',$item->attributes->slug)}}">
					        		<img height="60" width="50" src="{{Storage::disk('local')->url($item->attributes->image)}}" alt="Product">
					        	</a>
					        </div>
					    </th>
					    <th>
					        <div class="entry-content">
					            <h4 class="entry-title" >
					            	<a href="{{route('productDetails',$item->attributes->slug)}}" style="font-size: 12px;">
					            		{!! Str::limit($item->name, 25) !!}
					                </a>
					            </h4>
					            <span class="entry-meta" style="font-size: 10px;">{{$item->quantity}} x &#2547;{{$item->price}}</span>
			                    @foreach ($item->attributes->attributes_value as $attributeOption => $attributePrice)
								    <span class="entry-meta">
								        <b>{{ $attributeOption }}</b>: &#2547; {{ $attributePrice }}
								    </span>
								@endforeach
					        </div>
					    </th>
			        </tr>
			        
			    @empty
			    	<h4 class="entry-title">Your Cart is Empty</h4>
		        @endforelse
			    </tbody>
		    </table>
	   	</div>
    </div>
</div>