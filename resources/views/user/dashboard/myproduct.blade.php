@extends('user.dashboard.layouts')
@section('user_title_content')
    Ahknoxo | Dashboard
@endsection
@section('user_css_content')
@endsection

@section('dashboard_main_content')
	<div class="row row_section">
		<div class="card mb-3">
	      <img class="card-img-top" src="{{Storage::disk('local')->url($product->featured_image)}}" alt="Card image cap">
	      <div class="card-body">
	        </a><h5 class="card-title">{{$product->name}}</h5>
	        <p class="card-text">{{$product->short_description}}</p>
	        <p class="card-text"><small class="text-muted">Purchased this product {{ $product->created_at->diffForHumans() }}.</small></p>
	        <a href="{{route('course.details')}}" class="btn btn-info">Start Course</a>
	      </div>
	    </div>
	</div>
@endsection
@section('user_js_content')
@endsection