@extends('user.dashboard.layouts')
@section('user_title_content')
    Ahknoxo | Basic Link
@endsection
@section('user_css_content')
@endsection

@section('dashboard_main_content')
	<div class="section_title_collections basic_title">

      <h2>Offer Details</h2>

   	</div>
   	<div class="row row_section">
      	<div class="card mb-3">
          <img class="card-img-top" src="{{Storage::disk('local')->url($offer->digitalProduct->featured_image)}}" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">{{$offer->digitalProduct->name}}</h5>
            <p><strong>Offer Name:</strong> {{$offer->name}}</p>
            <p><strong>Offer Type:</strong> {{$offer->offer_type}}</p>
            <p><strong>Discount Offer:</strong> {{$offer->offer_percentage}}%</p>
            <p><strong>Your Percentage From this product:</strong> {{$offer->user_percentage}}%</p>
            <p><strong>Last Date:</strong> {{$offer->last_date}}</p>
            <p class="card-text">{{$offer->description}}</p>
          </div>
        </div>

   	</div>
@endsection
@section('user_js_content')
@endsection