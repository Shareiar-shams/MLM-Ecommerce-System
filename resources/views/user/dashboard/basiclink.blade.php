@extends('user.dashboard.layouts')
@section('user_title_content')
    Ahknoxo | Basic Link
@endsection
@section('user_css_content')
@endsection

@section('dashboard_main_content')
	<div class="section_title_collections basic_title">

      <h2>Basic Links</h2>

   </div>
   <div class="row row_section">


      <div class="col-md-4">

         <div class="basic_link_box">
            @if(Auth::user()->profile_image != null)
                  <img src="{{Storage::disk('local')->url(Auth::user()->profile_image)}}">
                  
            @else
                  <img src="{{asset('viewport/img/blank-user.png')}}">
                  
            @endif
            {{-- <p class="card-text">{{$offer->digitalProduct->short_description}}</p> --}}
         </div>

         <div class="copy_link_bs">

            <input type="text" value="{{ URL::signedRoute('user.referrer', ['referrer' => Crypt::encrypt(Auth::user()->id), 'type' => 'normal']) }}" id="myInput" readonly>

            <button onclick="myFunction()">Copy</button>

         </div>

      </div>
      

   </div>
@endsection
@section('user_js_content')
@endsection