@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Cookie Alert
@endsection
@section('admin_css_content')
 
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Cookie Alert</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Cookie Alert']);
	@endphp
	<x-ad-breadcrumb :list="$list"/>

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
						<div class="p-5">
								
                            <div class="container pl-0 pr-0 ml-0 mr-0 w-100 mw-100">
                                

                              	<div class="container">
                              		<br>

                                    <div class="row justify-content-center">

                                        <div class="col-lg-8">
                                        	<form class="admin-form" action="{{route('cookie_configaration_put')}}" method="POST" id="cookieForm">

			                                    @csrf
			                                    @method('put')

			                                    <input type="hidden" value="{{ isset($cookie->id) ? $cookie->id : '' }}" name="id">
                                                

                                                <div class="form-group">
											        <label class="switch">
											            <input type="checkbox" name="status" class="cookieChecker" value="1" @if($cookie->status == 1) {{'checked'}} @endif>
											            <span class="slider"></span>
											        </label> Cookie Alert
											    </div>

                                                <div class="radio-show cookieShow" @if($cookie->status != 1) style="display: none;" @endif>

                                                    <div class="form-group ">
                                                        <label for="cookie_text">Cookie Text *</label>
                                                        <input type="text" class="form-control" id="cookie_text" name="text" placeholder="Cookie Text" value="{{isset($cookie->text) ? $cookie->text : null}}" required>
                                                    </div>

                                                </div>
                                            </form>
                                            <div class="form-group">
							                  	<button type="submit" onclick="updateCookieData()" class="btn btn-primary">Submit</button>
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
	    function toggleCookieShow() {
	        var checkbox = document.querySelector('.cookieChecker');
	        var cookieShow = document.querySelector('.cookieShow');
	        if (checkbox.checked) {
	            cookieShow.style.display = 'block';
	        } else {
	            cookieShow.style.display = 'none';
	        }
	    }

	    // Call the function on page load and whenever checkbox state changes
	    window.onload = toggleCookieShow;
	    document.querySelector('.cookieChecker').addEventListener('change', toggleCookieShow);


	    function updateCookieData() {
	    	var form = document.getElementById('cookieForm');
            var formData = new FormData(form);

	        $.ajax({
	            url: form.action,
                method: form.method,
                data: formData,
                processData: false,
                contentType: false,
	            success: function(response) {
	                // Handle success response, e.g., show success message
	                toastr.success('Cookie updated successfully.');
	            },
	            error: function(error) {
	                // Handle error response, e.g., show error message
	                alert('Error updating cookie content.');
	            }
	        });
	    }
	</script>
	
@endsection