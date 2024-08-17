
<!doctype html>

<html lang="en">

	<head>

	    <!-- Required meta tags -->

	    <meta charset="utf-8">

	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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

  	<body>
  		<!-- Topbar PART -->
  		@include('user.layouts.includeFile.topbar')
  		<!-- END Topbar PART -->
  		<!-- Header PART -->
  		@include('user.layouts.includeFile.header')
  		<!-- END Header PART -->
  		<!-- Main Content PART -->
  		<section class="user_section section-padding">
  			<div class="container">
  				<div class="menu-toggle">
			        <div class="menu-toggle__element"></div>
			        <div class="menu-toggle__element"></div>
			        <div class="menu-toggle__element"></div>
			    </div>
			    <div class="row display-table-row">
			    	<div class="col-md-4 left-menu js-menu" id="navigation">
		                <!-- user info PART -->
				  		@include('user.dashboard.includeFile.info')
				  		<!-- END user info PART -->
	                	<!-- Dashboard Sidebar PART -->
				  		@include('user.dashboard.includeFile.sidebar')
				  		<!-- END Dashboard Sidebar PART -->
		            </div>
		            <div class="col-md-8 col-sm-12">
		            	@if ($errors->any())                 
							@foreach ($errors->all() as $error)
								<div class="alert alert-danger alert-block">
							        <a type="button" class="close" data-dismiss="alert"></a> 
							        <strong>{{ $error }}</strong>
							    </div>
							@endforeach						                   
						@endif
                    	@section('dashboard_main_content')
			            @show
                    </div>
			    </div>
  			</div>
  		</section>
  		
  		<!-- End Main Content PART -->
  		<!-- Footer PART -->
  		@include('user.layouts.includeFile.footer')
  		<!-- END Footer PART -->
  		<!-- Javascripts PART -->
  		@include('user.layouts.includeFile.js')
  		<!-- END Javascripts PART -->

  		<script>
  			var loadFile = function(event) {
				var image = document.getElementById('output');
				image.src = URL.createObjectURL(event.target.files[0]);
			};
			function myProductIndividual() {
			  	// Get the text field
			  	var copyText = document.getElementById("myProductIndividualUrl");
			  	// console.log(copyText.value);
			  	// Select the text field
			  	copyText.select();
			  	copyText.setSelectionRange(0, 99999); // For mobile devices

			  	// Copy the text inside the text field
			  	navigator.clipboard.writeText(copyText.value);

			  	// Alert the copied text
			  	alert("Link Copied");
			}

			function mySHopFunction() {
			  	// Get the text field
			  	var copyText = document.getElementById("myShopInput");
			  	// console.log(copyText.value);
			  	// Select the text field
			  	copyText.select();
			  	copyText.setSelectionRange(0, 99999); // For mobile devices

			  	// Copy the text inside the text field
			  	navigator.clipboard.writeText(copyText.value);

			  	// Alert the copied text
			  	alert("Link Copied");
			}
			function myFunction() {

			  // Get the text field

			  var copyText = document.getElementById("myInput");



			  // Select the text field

			  copyText.select();

			  copyText.setSelectionRange(0, 99999); // For mobile devices



			  // Copy the text inside the text field

			  navigator.clipboard.writeText(copyText.value);

			  

			  // Alert the copied text

			  alert("Copied the text: " + copyText.value);

			}

			function myFunctionLink() {

			  // Get the text field

			  var copyText = document.getElementById("myInputLink");



			  // Select the text field

			  copyText.select();

			  copyText.setSelectionRange(0, 99999); // For mobile devices



			  // Copy the text inside the text field

			  navigator.clipboard.writeText(copyText.value);

			  

			  // Alert the copied text

			  alert("Copied the text: " + copyText.value);

			}

		</script>
	  	
  	</body>

</html>