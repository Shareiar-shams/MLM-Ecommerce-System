@extends('user.dashboard.layouts')
@section('user_title_content')
    Ahknoxo | Sell Report
@endsection
@section('user_css_content')
@endsection

@section('dashboard_main_content')
	<div class="row row_section">
        <div class="col-md-6">
            <a href="{{route('today.sell.report')}}">
               <div class="content_user">
                  <i class="fa fa-shopping-bag" aria-hidden="true"></i>
               <h4>Today Seal</h4>
               <small>{{ isset($childrenToday) ? $childrenToday->count() : ''}}</small>
            </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{route('weekly.sell.report')}}">
               	<div class="content_user">
                  	<i class="fa fa-shopping-bag" aria-hidden="true"></i>
               		<h4>Weekly Seal</h4>
               		<small>{{ isset($childrenLastSevenDays) ? $childrenLastSevenDays->count() : ''}}</small>
            	</div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{route('total.active.child')}}">
               <div class="content_user">
                  	<i class="fa fa-shopping-bag" aria-hidden="true"></i>
               		<h4>Total Active Child</h4>
               		<small>{{ isset($totalChild) ? $totalChild->count() : ''}}</small>
            	</div>
            </a>
        </div>

        <div class="col-md-6">
            <a href="{{route('total.sell')}}">
               <div class="content_user">
                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                    <h4>Total Sell</h4>
                    <small>{{ isset($totalSell) ? $totalSell->count() : ''}}</small>
                </div>
            </a>
        </div>
         <!--<div class="col-md-6">-->
         <!--   <a href="#">-->
         <!--      <div class="content_user">-->
         <!--         <i class="fa fa-shopping-bag" aria-hidden="true"></i>-->
         <!--      <h4>Task Box</h4>-->
         <!--   </div>-->
         <!--   </a>-->
         <!--</div>-->
    </div>
@endsection
@section('user_js_content')
@endsection