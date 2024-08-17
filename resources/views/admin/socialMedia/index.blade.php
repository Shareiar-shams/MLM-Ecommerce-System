@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Social Login
@endsection
@section('admin_css_content')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

  <style type="text/css" media="screen">
  	/* Basic Rules */
	.switch input { 
	    display:none;
	}
	.switch {
	    display:inline-block;
	    width:60px;
	    height:30px;
	    margin:8px;
	    transform:translateY(50%);
	    position:relative;
	}
	/* Style Wired */
	.slider {
	    position:absolute;
	    top:0;
	    bottom:0;
	    left:0;
	    right:0;
	    border-radius:30px;
	    box-shadow:0 0 0 2px #777, 0 0 4px #777;
	    cursor:pointer;
	    border:4px solid transparent;
	    overflow:hidden;
	     transition:.4s;
	}
	.slider:before {
	    position:absolute;
	    content:"";
	    width:100%;
	    height:100%;
	    background:#777;
	    border-radius:30px;
	    transform:translateX(-30px);
	    transition:.4s;
	}

	input:checked + .slider:before {
	    transform:translateX(30px);
	    background:limeGreen;
	}
	input:checked + .slider {
	    box-shadow:0 0 0 2px limeGreen,0 0 2px limeGreen;
	}
  </style>
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Social Login</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Social Media']);
	@endphp
	<x-ad-breadcrumb :list="$list"/>
@endsection

@section('admin_main_content')
	@if ($errors->any())                 
		@foreach ($errors->all() as $error)
			<div class="alert alert-danger alert-block">
		        <a type="button" class="close" data-dismiss="alert"></a> 
		        <strong>{{ $error }}</strong>
		    </div>
		@endforeach						                   
	@endif
	<div class="container-fluid">
		
	    <div class="row">

			<div class="col-xl-12 col-lg-12 col-md-12">

				<div class="card o-hidden border-0 shadow-lg">
					<div class="card-body ">
						<!-- Nested Row within Card Body -->
						<div class="row">
	                        <div class="col-4 col-md-3">
	                            <div class="nav flex-column m-3 nav-pills nav-secondary" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="">

	                                <a class="nav-link" data-toggle="pill" href="#facebook">Facebook</a>
	                                <a class="nav-link active show" data-toggle="pill" href="#google">Google</a>


	                            </div>
	                        </div>
							<div class="col-lg-9">
								<div class="p-5">
										
                                    <div class="container pl-0 pr-0 ml-0 mr-0 w-100 mw-100">
                                        <div id="tabs">

	                                        <!-- Tab panes -->
	                                        <div class="tab-content">

	                                          	<div id="facebook" class="container tab-pane">
	                                          		<br>

		                                            <div class="row justify-content-center">

		                                                <div class="col-lg-8">
		                                                	<form class="admin-form" action="{{route('media_data_update')}}" method="POST" enctype="multipart/form-data" id="facebookForm">

							                                    @csrf
							                                    @method('put')

							                                    <input type="hidden" value="{{ isset($facebook->id) ? $facebook->id : '' }}" name="id">
			                                                    {{-- <div class="switch-primary">
		                                                        	<label class="switch-primary">
		                                                        		<input type="checkbox" class="switch switch-bootstrap status radio-check facebookChecker" name="status" value="1" @if($facebook->status == 1)
													                      	{{'checked'}} 
													                    @endif>

														                <span class="switch-body"></span>
			                                                          	<span class="switch-text">Facebook Login</span>
			                                                        </label>
			                                                    </div> --}}

			                                                    <div class="form-group">
															        <label class="switch">
															            <input type="checkbox" name="status" class="facebookChecker" value="1" @if($facebook->status == 1)
													                      	{{'checked'}} 
													                    @endif>
															            <span class="slider"></span>
															        </label> Facebook Login
															    </div>

			                                                    <div class="radio-show facebookShow" @if($facebook->status != 1) style="display: none;" @endif>

			                                                        <div class="form-group ">
			                                                            <label for="facebook_client_id">App ID</label> <small>(From developers.facebook.com)</small>
			                                                            <input type="text" class="form-control" id="facebook_client_id" name="app_id" placeholder="Enter App ID" value="{{isset($facebook->app_id) ? $facebook->app_id : null}}" required>
			                                                        </div>

			                                                        <div class="form-group ">
			                                                            <label for="facebook_client_secret">App Secret</label> <small>(From developers.facebook.com)</small>
			                                                            <input type="text" class="form-control" id="facebook_client_secret" name="app_secret" placeholder="Enter App Secret" value="{{isset($facebook->app_secret) ? $facebook->app_secret : null}}" required>
			                                                        </div>

			                                                        <div class="form-group ">
			                                                            <label for="facebook_redirect">Redirect URL</label> <small>(Set this to your Valid OAuth Redirect URI in developers.facebook.com)</small>
			                                                            <input type="text" class="form-control" id="facebook_redirect" name="redirect_url" placeholder="Enter Redirect URL" value="{{isset($facebook->redirect_url) ? $facebook->redirect_url : null}}" readonly="" required>
			                                                        </div>

			                                                    </div>
			                                                </form>
			                                                <div class="form-group">
											                  	<button type="submit" onclick="updateFacebookData()" class="btn btn-primary">Submit</button>
											                </div>
		                                                </div>

		                                            </div>

	                                          	</div>

	                                          	<div id="google" class="container tab-pane active show">
	                                          		<br>

		                                            <div class="row justify-content-center">

		                                                <div class="col-lg-8">
		                                                	<form class="admin-form" action="{{route('media_data_update')}}" method="POST" enctype="multipart/form-data" id="googleForm">

							                                    @csrf
							                                    @method('put')

							                                    <input type="hidden" value="{{ isset($google->id) ? $google->id : '' }}" name="id">

			                                                    {{-- <div class="form-group">
			                                                        <label class="switch-primary">
			                                                        	<input type="checkbox" class="switch switch-bootstrap status radio-check googleChecker" name="status" value="1" @if($google->status == 1)
													                      	{{'checked'}} 
													                    @endif>

			                                                          	<span class="switch-body"></span>
			                                                          	<span class="switch-text">Google Login</span>
			                                                        </label>
			                                                    </div> --}}

			                                                    <div class="form-group">
															        <label class="switch">
															            <input type="checkbox" class="googleChecker" name="status" value="1" @if($google->status == 1)
													                      	{{'checked'}} 
													                    @endif>
															            <span class="slider"></span>
															        </label> Google Login
															    </div>

			                                                    <div class="radio-show googleShow" @if($google->status != 1) style="display: none;" @endif>

			                                                        <div class="form-group ">
			                                                            <label for="google_client_id">Client ID</label> <small>(From console.cloud.google.com)</small>
			                                                            <input type="text" class="form-control " id="google_client_id" name="app_id" placeholder="Enter Client ID"  value="{{isset($google->app_id) ? $google->app_id : null}}" required>
			                                                        </div>

			                                                        <div class="form-group ">
			                                                            <label for="google_client_secret">Client Secret</label> <small>(From console.cloud.google.com)</small>
			                                                            <input type="text" class="form-control " id="google_client_secret" name="app_secret" placeholder="Enter Client Secret" value="{{isset($google->app_secret) ? $google->app_secret : null}}" required>
			                                                        </div>

			                                                        <div class="form-group ">
			                                                            <label for="google_redirect">Redirect URL</label> <small>(Set this to your Redirect URL in console.cloud.google.com)</small>
			                                                            <input type="text" class="form-control " id="google_redirect" name="redirect_url" placeholder="Enter Redirect URL" value="{{isset($google->redirect_url) ? $google->redirect_url : null}}" readonly="" required>
			                                                        </div>

			                                                    </div>
			                                                </form>
			                                                <div class="form-group">
											                  	<button type="submit" onclick="updateGoogleData()" class="btn btn-primary">Submit</button>
											                </div>
		                                                </div>

		                                            </div>

	                                          	</div>

	                                        </div>

                                    	</div>

                                   	</div>

									
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>

		</div>
	</div>
  <!-- /.container-fluid -->
@endsection

@section('admin_js_content')

	<script type="text/javascript">
		// Function to toggle visibility based on checkbox state
	    function toggleFacebookShow() {
	        var checkbox = document.querySelector('.facebookChecker');
	        var facebookShow = document.querySelector('.facebookShow');
	        if (checkbox.checked) {
	            facebookShow.style.display = 'block';
	        } else {
	            facebookShow.style.display = 'none';
	        }
	    }

	    // Call the function on page load and whenever checkbox state changes
	    window.onload = toggleFacebookShow;
	    document.querySelector('.facebookChecker').addEventListener('change', toggleFacebookShow);


	    // Function to toggle visibility based on checkbox state
	    function toggleGoogleShow() {
	        var checkbox = document.querySelector('.googleChecker');
	        var googleShow = document.querySelector('.googleShow');
	        if (checkbox.checked) {
	            googleShow.style.display = 'block';
	        } else {
	            googleShow.style.display = 'none';
	        }
	    }

	    // Call the function on page load and whenever checkbox state changes
	    window.onload = toggleGoogleShow;
	    document.querySelector('.googleChecker').addEventListener('change', toggleGoogleShow);

	    

		function updateFacebookData() {
	    	var form = document.getElementById('facebookForm');
            var formData = new FormData(form);

	        $.ajax({
	            url: form.action,
                method: form.method,
                data: formData,
                processData: false,
                contentType: false,
	            success: function(response) {
	            	console.log(response);
	                // Handle success response, e.g., show success message
	                toastr.success('Facebook Data updated successfully.');
	            },
	            error: function(error) {
	                // Handle error response, e.g., show error message
	                alert('Error updating loader.');
	            }
	        });
	    }


	    function updateGoogleData() {
	    	var form = document.getElementById('googleForm');
            var formData = new FormData(form);

	        $.ajax({
	            url: form.action,
                method: form.method,
                data: formData,
                processData: false,
                contentType: false,
	            success: function(response) {
	            	console.log(response);
	                // Handle success response, e.g., show success message
	                toastr.success('Google Data updated successfully.');
	            },
	            error: function(error) {
	                // Handle error response, e.g., show error message
	                alert('Error updating Meta content.');
	            }
	        });
	    }
	</script>
	<!-- DataTables  & Plugins -->
	<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{asset('admin/plugins/jszip/jszip.min.js')}}"></script>
	<script src="{{asset('admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
	<script src="{{asset('admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
	<!-- Page specific script -->
	<script>
		$(function () {
		    $("#example1").DataTable({
		      	"responsive": true, "lengthChange": false, "autoWidth": false,
		      	"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		    
		});
	</script>
@endsection