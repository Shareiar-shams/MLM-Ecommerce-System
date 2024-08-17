@extends('user.dashboard.layouts')
@section('user_title_content')
    Ahknoxo | Dashboard
@endsection
@section('user_css_content')
@endsection

@section('dashboard_main_content')
	<div class="row row_section">
	    <div class="col-md-6">
	        <a href="{{route('sell.report')}}">
	           	<div class="content_user">
	              	<i class="fa fa-shopping-bag" aria-hidden="true"></i>
		           	<h4>Home</h4>
		        </div>
	        </a>
	    </div>
	    <div class="col-md-6">
	        <a href="{{route('myproduct')}}">
	           	<div class="content_user">
	              	<i class="fa fa-shopping-bag" aria-hidden="true"></i>
		           	<h4>My Product</h4>
		        </div>
	        </a>
	    </div>
	    <div class="col-md-6">
	        <a href="{{route('total.active.child')}}">
	           	<div class="content_user">
	              	<i class="fa fa-shopping-bag" aria-hidden="true"></i>
	           		<h4>My Team</h4>
	        	</div>
	        </a>
	    </div>
	    <div class="col-md-6">
	        <a href="{{route('profile.edit')}}">
	           	<div class="content_user">
		            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
		           	<h4>Profile</h4>
		        </div>
	        </a>
	    </div>
	    <div class="col-md-6">
	        <a href="{{route('tools')}}">
	           	<div class="content_user">
	              	<i class="fa fa-shopping-bag" aria-hidden="true"></i>
		           	<h4>Tools</h4>
		        </div>
	        </a>
	    </div>
	    <div class="col-md-6">
	        <a href="{{route('user.pending')}}">
	           	<div class="content_user">
	              	<i class="fa fa-shopping-bag" aria-hidden="true"></i>
	           		<h4>Pending Request</h4>
	        	</div>
	        </a>
	    </div>
	   	<div class="col-md-6">
	        <a href="{{route('admin.pending')}}">
	           <div class="content_user">
	              	<i class="fa fa-shopping-bag" aria-hidden="true"></i>
		           	<h4>Pending From Admin</h4>
		        </div>
	        </a>
	   	</div>
	   	<div class="col-md-6">
	        <a href="{{route('product_sells')}}">
	           <div class="content_user">
	              	<i class="fa fa-shopping-bag" aria-hidden="true"></i>
		           	<h4>Product Sells</h4>
		        </div>
	        </a>
	   	</div>
	</div>
@endsection
@section('user_js_content')
@endsection
