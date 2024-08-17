@extends('user.dashboard.layouts')
@section('user_title_content')
    Ahknoxo | Dashboard
@endsection
@section('user_css_content')
@endsection

@section('dashboard_main_content')
	<div class="row row_section">
		@if($product->delivery_type == "Link")
		<iframe width="100%" height="450" src="{{$product->delivery_entity}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
		@else
		<a href="{{Storage::disk('local')->url($product->delivery_entity)}}" download>Download Zip File</a>
		@endif
		
		<div class="card mb-3 mt-4">
	      <img class="card-img-top" src="{{Storage::disk('local')->url($product->featured_image)}}" alt="Card image cap">
	      <div class="card-body">
	        <h5 class="card-title">{{$product->name}}</h5>
	        <p class="card-text">{!!htmlspecialchars_decode($product->description)!!}</p>
	      </div>
	    </div>
	</div>
@endsection
@section('user_js_content')
@endsection