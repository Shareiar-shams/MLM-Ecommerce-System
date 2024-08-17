@extends('user.dashboard.layouts')
@section('user_title_content')
    Ahknoxo | Tools
@endsection
@section('user_css_content')
@endsection

@section('dashboard_main_content')
   <div class="row row_section">
         <div class="col-md-6">
            <a href="{{route('basic.links')}}">
               <div class="content_user">
                  <i class="fa fa-shopping-bag" aria-hidden="true"></i>
               <h4>Basic Links</h4>
            </div>
            </a>
         </div>
         <div class="col-md-6">
            <a href="{{route('normal.links')}}">
               <div class="content_user">
                  <i class="fa fa-shopping-bag" aria-hidden="true"></i>
               <h4>Offer Links</h4>
            </div>
            </a>
         </div>
         <div class="col-md-6">
            <a href="{{route('special.links')}}">
               <div class="content_user">
                  <i class="fa fa-shopping-bag" aria-hidden="true"></i>
               <h4>Special Links</h4>
            </div>
            </a>
         </div>
   
    </div>
@endsection
@section('user_js_content')
@endsection