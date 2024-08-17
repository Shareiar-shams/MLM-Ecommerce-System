
<!doctype html>

<html lang="en">

	<head>

	    <!-- Required meta tags -->

	    <meta charset="utf-8">

	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	    
	    @section('meta_property')
	    	@show
	    	
		<meta name="author" content="Knoxo">
		<meta name="distribution" content="web">
		<!-- Mobile Specific Meta Tag-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Favicon Icons-->
		<link rel="icon" type="image/png" href="{{$favicon}}">
		<link rel="apple-touch-icon" href="{{$favicon}}">
		<link rel="apple-touch-icon" sizes="152x152" href="{{$favicon}}">
		<link rel="apple-touch-icon" sizes="180x180" href="{{$favicon}}">
		<link rel="apple-touch-icon" sizes="167x167" href="{{$favicon}}">
		<!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->

	    <!-- site title -->

	    <title>
	    	@section('user_title_content')
	      	@show
	    </title>

	    <!-- end site title -->

	    <!-- CSS PART -->
	    @include('user.layouts.includeFile.css')
	    <!-- END CSS PART -->
	    

	</head>

  	<body id="preloader">
  		@if($display_loader)
  		<div id="loader" style="position: fixed; width: 100%; height: 100vh; z-index: 1; overflow: visible; background: #fff url({{$loader}}) no-repeat center center;"></div>
  		@endif
  		@if($banner && $banner->status == true)
  		<!-- Auto Popup PART -->
  		@include('user.layouts.includeFile.popup')
  		@endif
  		<!-- Topbar PART -->
  		@include('user.layouts.includeFile.topbar')
  		<!-- END Topbar PART -->
  		<!-- Header PART -->
  		@include('user.layouts.includeFile.header')
  		<!-- END Header PART -->
  		@if ($errors->any())                 
			@foreach ($errors->all() as $error)
				<div class="alert alert-danger alert-block">
			        <a type="button" class="close" data-dismiss="alert"></a> 
			        <strong>{{ $error }}</strong>
			    </div>
			@endforeach						                   
		@endif
  		<!-- Main Content PART -->
  		@section('user_main_content')
            @show
  		<!-- End Main Content PART -->
  		<!-- Footer PART -->
  		@include('user.layouts.includeFile.footer')
  		<!-- END Footer PART -->
  		<!-- Javascripts PART -->
  		@include('user.layouts.includeFile.js')
  		<!-- END Javascripts PART -->
	  	
  	</body>

</html>