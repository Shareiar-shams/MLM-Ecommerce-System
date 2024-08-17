<div class="row">
	@forelse($customize_products as $product)
    <div class="col-md-4">
       	<a href="{{route('user.customize.product',$product->slug)}}">
	        <div class="img_custmoization custmoization_se">

	        	@if (Str::startsWith($product->featured_image, 'https'))
                  	<img height="200" src="{{$product->featured_image}}" alt="Product Image" class="">
             	@else

                  	<img height="200" src="{{Storage::disk('local')->url($product->featured_image)}}" alt="Product Image" class="">
              	@endif

	        </div>

	        <div class="content_custom custmoization_se_content">

	          	<h4>{{$product->name}}</h4>

	          	<p>{{ Str::limit($product->short_description, 250, $end = '... (see more)') }}</p>

	        </div>
       	</a>
    </div>
    @empty
    @endforelse

    {{-- <div class="col-md-4">
       	<a href="{{route('user.customize.product')}}">
	        <div class="img_custmoization custmoization_se">

	          	<img src="{{asset('viewport/img/customization2.png')}}">

	        </div>

	        <div class="content_custom custmoization_se_content">

	         	<h4>Member Shop</h4>

	          	<p>Shop Member-exclusive styles.</p>

	        </div>
       	</a>
    </div>

  	<div class="col-md-4">
      	<a href="{{route('user.customize.product')}}">
        <div class="img_custmoization custmoization_se">

          <img src="{{asset('viewport/img/customization3.png')}}">

        </div>

        <div class="content_custom custmoization_se_content">

          <h4>Member Shop</h4>

          <p>Shop Member-exclusive styles.</p>

        </div>
      	</a>
  	</div> --}}

</div>