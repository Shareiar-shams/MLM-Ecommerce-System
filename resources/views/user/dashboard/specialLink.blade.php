@extends('user.dashboard.layouts')
@section('user_title_content')
    Ahknoxo | Special Link
@endsection
@section('user_css_content')
@endsection

@section('dashboard_main_content')
	<div class="section_title_collections basic_title">

      <h2>Special Links</h2>

   </div>
   	<div class="row row_section">


      	@if(!empty($offers))
	         @foreach($offers as $offer)
	         @php
               $lastDate = Carbon\Carbon::parse($offer->last_date);
               $currentDate = Carbon\Carbon::now();
            @endphp
	           @if($offer->status == 1 && !$lastDate->isPast() && isset($offer->digitalProduct))
	           
               	<div class="col-md-4">

                  <div class="basic_link_box">

                     <img src="{{Storage::disk('local')->url($offer->digitalProduct->featured_image)}}">
                     <a href="{{route('offer.details.show',$offer->id)}}"><h5 class="card-title">{{$offer->digitalProduct->name}}</h5></a>
                     {{-- <p class="card-text">{{$offer->digitalProduct->short_description}}</p> --}}
                  </div>

                  <div class="copy_link_bs">

                     <input type="text" value="{{ URL::signedRoute('offer.purchase', ['digitalproduct' => $offer->digitalProduct->id, 'offer' => $offer->id, 'type' => $offer->offer_type, 'user' => Crypt::encrypt(Auth::user()->id)]) }}" id="myInputLink" readonly>

                     <button onclick="myFunctionLink()">Copy</button>

                  </div>

               	</div>
	        @else
	         	<p>No Offer Available For You.</p>
	      	@endif

	        @endforeach
      	@else
         	<p>No Offer Available For You.</p>
      	@endif

   	</div>
@endsection
@section('user_js_content')
@endsection