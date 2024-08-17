<div class="slider-wrap">

    <div class="js-slider slider">
    	@foreach($slider_products as $product)
        <div class="slider_box">

            <div class="cls_img_box">
            	@if (Str::startsWith($product->featured_image, 'https'))
                    <img height="200" src="{{$product->featured_image}}" alt="Product Image" class="">
                @else

                    <img height="200" src="{{Storage::disk('local')->url($product->featured_image)}}" alt="Product Image" class="">
                @endif


                <div class="overlay_img">

                    <ul>

	                    {{-- <li>

	                        <a href="#"><i class="fa fa-user-o" aria-hidden="true"></i></a>

	                    </li> --}}

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

	                    </li>

                        <form id="cart-add-form-{{$product->id}}" method="POST" action="{{ route('cart.store') }}">
                            @csrf
                            <input type="hidden" name="quantity" value="1" title="Qty" class="input-text qty text"/>
                            <input type="hidden" name="id" value="{{$product->id}}" />
                        </form>
                        <div class="product-button">
                            
                            <div class="favIcon">
                                
                            </div>
                        </div>

                    </ul>

                </div>

            </div>

            <h4>{{$product->name}}</h4>
        </div>
        @endforeach
    </div>

    <div id="js-slider-arrows"></div>

</div>