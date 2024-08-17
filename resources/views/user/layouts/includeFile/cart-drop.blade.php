<a href="#">
    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
</a>
<span class="count CartCount">{{ \Cart::session(Session::getId())->getTotalQuantity()}}</span>
<div class="toolbar-dropdown cart-dropdown widget-cart  cart_view_header" id="header_cart_load" data-target="">
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
				            @foreach ($item->attributes->attributes as $attributeName => $attributeOptionFirst)
					            @foreach ($item->attributes->attributes_value as $attributeOption => $attributePrice)
					            	@if($attributeOptionFirst == $attributeOption)
								    <small class="entry-meta" style="font-size: 8px;">
								        {{$attributeName}} : 	{{ $attributeOption }} (&#2547; {{ $attributePrice }})
								    </small>
								    @endif
								@endforeach
							@endforeach
				        </div>
				    </th>
				    <th>
		                <a href="" title="Remove this item" onclick="
		                if(confirm('Are you want to remove this item!'))
		                {
		                    event.preventDefault();
		                    document.getElementById('delete-form-{{$item->id}}').submit();
		                }
		                else
		                {
		                    event.preventDefault();
		                }
		                "><i class="fa fa-times" aria-hidden="true"></i></a>

			            <form action="{{route('cart.destroy',$item->id)}}" method="post" id="delete-form-{{$item->id}}" style="display: none;">
			              @csrf
			              {{method_field('DELETE')}}
			            </form>
				    </th>
		        </tr>
		        
		    @empty
		    	<h4 class="entry-title">Your Cart is Empty</h4>
	        @endforelse
		    </tbody>
	    </table>
   	</div>
    <div class="text-right">
        <p class="text-gray-dark py-2 mb-0"><span class="text-muted">Subtotal:</span> &#2547;{{ \Cart::session(Session::getId())->getSubtotal() }}</p>
    </div>
    <div class="d-flex justify-content-between">
        <div class="w-50 d-block">
        	<a class="btn btn-primary btn-sm  mb-0" href="{{route('cart.index')}}">
        		<span>Cart</span>
        	</a>
        </div>
        <div class="w-50 d-block text-end">
        	<a class="btn btn-primary btn-sm  mb-0" href="{{route('checkout')}}">
        		<span>Checkout</span>
        	</a>
        </div>
    </div>
</div>