@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Payment
@endsection
@section('admin_css_content')

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
		<h1 class="m-0">Payment</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Payment Gateway']);
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

	                                <a class="nav-link  active show" data-toggle="pill" href="#cod">Cash On Delivery</a>
	                                <a class="nav-link" data-toggle="pill" href="#stripe">Stripe</a>
	                                <a class="nav-link" data-toggle="pill" href="#paypal">Paypal</a>
	                                <a class="nav-link" data-toggle="pill" href="#bkash">BKash</a>
	                                <a class="nav-link" data-toggle="pill" href="#ssl_commerz">SSL commerz</a>


	                            </div>
	                        </div>
							<div class="col-lg-9">
								<div class="p-5">
										
                                    <div class="container pl-0 pr-0 ml-0 mr-0 w-100 mw-100">
                                        <div id="tabs">

	                                        <!-- Tab panes -->
	                                        <div class="tab-content">

	                                          	<div id="cod" class="container tab-pane active show">
	                                          		<br>

		                                            <div class="row justify-content-center">

		                                                <div class="col-lg-8">
		                                                	<form class="admin-form" action="{{route('payment.store')}}" method="POST" enctype="multipart/form-data" id="codForm">

							                                    @csrf
							                                    
							                                    <input type="hidden" value="{{ isset($cod->id) ? $cod->id : '' }}" name="id">

			                                                    <div class="form-group">
															        <label class="switch">
															            <input type="checkbox" name="status" class="codChecker" value="1" @if($cod->status == 1) {{'checked'}} @endif>
															            <span class="slider"></span>
															        </label> Display {{isset($cod->name) ? $cod->name : 'Cash On Delivery'}}
															    </div>

			                                                    <div class="radio-show codShow"  @if($cod->status != 1) style="display: none;" @endif>

			                                                        <div class="form-group ">
			                                                            <label for="name">Enter Name *</label>
			                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{isset($cod->name) ? $cod->name : ''}}" required>
			                                                        </div>
			                                                        <div class="line"></div>

			                                                        <img src="{{Storage::disk('local')->url($cod->image)}}" class="profile-user-img img-responsive" alt="{{$cod->name}}" id="codImageoutput">

										                     		<div class="form-group">
													                    <label for="exampleInputFile">Current Image</label>
													                    <div class="input-group">
														                    <div class="custom-file">
														                        <input type="file" accept="image/*" onchange="loadCodFile(event)" name="image" class="custom-file-input" id="ImageInputFile">
														                        <label class="custom-file-label" for="exampleInputFile">Upload Image</label>
														                    </div>
													                    </div>
													                </div>
												                    <small style="color: blue;">Image Size Should Be 52 x 35.</small>

			                                                        <div class="form-group ">
			                                                            <label for="cod_text">Text *</label>
			                                                            <textarea name="text" class="form-control" placeholder="Enter Text" required>{{$cod->text}}</textarea>
			                                                        </div>

			                                                    </div>
			                                                </form>
			                                                <div class="form-group">
											                  	<button type="submit" onclick="updateCoodData()" class="btn btn-primary">Submit</button>
											                </div>
		                                                </div>

		                                            </div>

	                                          	</div>

	                                          	<div id="stripe" class="container tab-pane">
	                                          		<br>

		                                            <div class="row justify-content-center">

		                                                <div class="col-lg-8">
		                                                	@php
															    // Decode the JSON data into an associative array

															    $data = isset($stripe->data) ? json_decode($stripe->data, true) : '';
															@endphp
		                                                	<form class="admin-form" action="{{route('payment.store')}}" method="POST" enctype="multipart/form-data" id="stripeForm">

							                                    @csrf
							                                    
							                                    <input type="hidden" value="{{ isset($stripe->id) ? $stripe->id : '' }}" name="id">

			                                                    <div class="form-group">
															        <label class="switch">
															            <input type="checkbox" name="status" class="stripeChecker" value="1" @if($stripe->status == 1) {{'checked'}} @endif>
															            <span class="slider"></span>
															        </label> Display {{isset($stripe->name) ? $stripe->name : 'Cash On Delivery'}}
															    </div>

			                                                    <div class="radio-show stripeShow"  @if($stripe->status != 1) style="display: none;" @endif>

			                                                        <img src="{{Storage::disk('local')->url($stripe->image)}}" class="profile-user-img img-responsive" alt="{{$stripe->name}}" id="stripeImageoutput">

										                     		<div class="form-group">
													                    <label for="exampleInputFile">Current Image</label>
													                    <div class="input-group">
														                    <div class="custom-file">
														                        <input type="file" accept="image/*" onchange="loadStripeFile(event)" name="image" class="custom-file-input" id="ImageInputFile">
														                        <label class="custom-file-label" for="exampleInputFile">Upload Image</label>
														                    </div>
													                    </div>
													                </div>
												                    <small style="color: blue;">Image Size Should Be 52 x 35.</small>

			                                                        <div class="line"></div>

			                                                        <div class="form-group ">
			                                                            <label for="name">Enter Name *</label>
			                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{isset($stripe->name) ? $stripe->name : ''}}" required>
			                                                        </div>

			                                                        <div class="form-group ">
			                                                            <label for="stripe_key">Stripe Key *</label>
			                                                            <input type="text" class="form-control" id="key" name="data[key]" placeholder="Enter Stripe Key" value="{{isset($data['key']) ? $data['key'] : ''}}" required>
			                                                        </div>

			                                                        <div class="form-group ">
			                                                            <label for="stripe_secret">Stripe Secret *</label>
			                                                            <input type="text" class="form-control" id="secret" name="data[secret]" placeholder="Stripe Secret" value="{{isset($data['secret']) ? $data['secret'] : ''}}" required>
			                                                        </div>

			                                                        <div class="form-group ">
			                                                            <label for="cod_text">Text *</label>
			                                                            <textarea name="text" class="form-control" placeholder="Enter Text" required>{{$stripe->text}}</textarea>
			                                                        </div>

			                                                    </div>
			                                                </form>
			                                                <div class="form-group">
											                  	<button type="submit" onclick="updateStripeData()" class="btn btn-primary">Submit</button>
											                </div>
		                                                </div>

		                                            </div>

	                                          	</div>

	                                          	<div id="paypal" class="container tab-pane">
	                                          		<br>

		                                            <div class="row justify-content-center">

		                                                <div class="col-lg-8">
		                                                	@php
															    // Decode the JSON data into an associative array

															    $data = isset($paypal->data) ? json_decode($paypal->data, true) : '';
															@endphp
		                                                	<form class="admin-form" action="{{route('payment.store')}}" method="POST" enctype="multipart/form-data" id="paypalForm">

							                                    @csrf
							                                    
							                                    <input type="hidden" value="{{ isset($paypal->id) ? $paypal->id : '' }}" name="id">

			                                                    <div class="form-group">
															        <label class="switch">
															            <input type="checkbox" name="status" class="paypalChecker" value="1" @if($paypal->status == 1) {{'checked'}} @endif>
															            <span class="slider"></span>
															        </label> Display {{isset($paypal->name) ? $paypal->name : 'Cash On Delivery'}}
															    </div>

			                                                    <div class="radio-show paypalShow"  @if($paypal->status != 1) style="display: none;" @endif>

			                                                        <img src="{{Storage::disk('local')->url($paypal->image)}}" class="profile-user-img img-responsive" alt="{{$paypal->name}}" id="paypalImageoutput">

										                     		<div class="form-group">
													                    <label for="exampleInputFile">Current Image</label>
													                    <div class="input-group">
														                    <div class="custom-file">
														                        <input type="file" accept="image/*" onchange="loadPaypalFile(event)" name="image" class="custom-file-input" id="ImageInputFile">
														                        <label class="custom-file-label" for="exampleInputFile">Upload Image</label>
														                    </div>
													                    </div>
													                </div>
												                    <small style="color: blue;">Image Size Should Be 52 x 35.</small>

			                                                        <div class="line"></div>

			                                                        <div class="form-group ">
			                                                            <label for="name">Enter Name *</label>
			                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{isset($paypal->name) ? $paypal->name : ''}}" required>
			                                                        </div>

			                                                        <div class="form-group ">
			                                                            <label for="client_id">Paypal Client Id *</label>
			                                                            <input type="text" class="form-control" id="client_id" name="data[client_id]" placeholder="Enter Client Id" value="{{isset($data['client_id']) ? $data['client_id'] : ''}}" required>
			                                                        </div>

			                                                        <div class="form-group ">
			                                                            <label for="client_secret">Paypal Client Secret *</label>
			                                                            <input type="text" class="form-control" id="client_secret" name="data[client_secret]" placeholder="Client Secret" value="{{isset($data['client_secret']) ? $data['client_secret'] : ''}}" required>
			                                                        </div>

			                                                        <input type="checkbox" id="sandbox" name="sandbox" value="1" @if($paypal->sandbox == 1) {{'checked'}} @endif>
																	<label for="sandbox"> Paypal Check Sandbox</label><br>


			                                                        <div class="form-group ">
			                                                            <label for="cod_text">Text *</label>
			                                                            <textarea name="text" class="form-control" placeholder="Enter Text" required>{{$paypal->text}}</textarea>
			                                                        </div>

			                                                    </div>
			                                                </form>
			                                                <div class="form-group">
											                  	<button type="submit" onclick="updatePaypalData()" class="btn btn-primary">Submit</button>
											                </div>
		                                                </div>


		                                            </div>

	                                          	</div>

	                                          	<div id="bkash" class="container tab-pane">
	                                          		<br>

		                                            <div class="row justify-content-center">

		                                                <div class="col-lg-8">
		                                                	@php
															    // Decode the JSON data into an associative array

															    $data = isset($bkash->data) ? json_decode($bkash->data, true) : '';
															@endphp
		                                                	<form class="admin-form" action="{{route('payment.store')}}" method="POST" enctype="multipart/form-data" id="bkashForm">

							                                    @csrf
							                                    
							                                    <input type="hidden" value="{{ isset($bkash->id) ? $bkash->id : '' }}" name="id">

			                                                    <div class="form-group">
															        <label class="switch">
															            <input type="checkbox" name="status" class="bkashChecker" value="1" @if($bkash->status == 1) {{'checked'}} @endif>
															            <span class="slider"></span>
															        </label> Display {{isset($bkash->name) ? $bkash->name : 'Cash On Delivery'}}
															    </div>

			                                                    <div class="radio-show bkashShow"  @if($bkash->status != 1) style="display: none;" @endif>

			                                                    	 <div class="form-group ">
			                                                            <label for="name">Enter Name *</label>
			                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{isset($bkash->name) ? $bkash->name : ''}}" required>
			                                                        </div>


			                                                        <img src="{{Storage::disk('local')->url($bkash->image)}}" class="profile-user-img img-responsive" alt="{{$bkash->name}}" id="bkashImageoutput">

										                     		<div class="form-group">
													                    <label for="exampleInputFile">Current Image</label>
													                    <div class="input-group">
														                    <div class="custom-file">
														                        <input type="file" accept="image/*" onchange="loadBkashFile(event)" name="image" class="custom-file-input" id="ImageInputFile">
														                        <label class="custom-file-label" for="exampleInputFile">Upload Image</label>
														                    </div>
													                    </div>
													                </div>
												                    <small style="color: blue;">Image Size Should Be 52 x 35.</small>

			                                                        <div class="line"></div>

			                                                        <div class="form-group ">
			                                                            <label for="app_key">Bkash App key *</label>
			                                                            <input type="text" class="form-control" id="app_key" name="data[app_key]" placeholder="Enter Client Id" value="{{isset($data['app_key']) ? $data['app_key'] : ''}}" required>
			                                                        </div>

			                                                        <div class="form-group ">
			                                                            <label for="app_secret">Bkash App Secret *</label>
			                                                            <input type="text" class="form-control" id="app_secret" name="data[app_secret]" placeholder="Client Secret" value="{{isset($data['app_secret']) ? $data['app_secret'] : ''}}" required>
			                                                        </div>

			                                                        <div class="form-group ">
			                                                            <label for="username">Username *</label>
			                                                            <input type="text" class="form-control" id="username" name="data[username]" placeholder="Client Secret" value="{{isset($data['username']) ? $data['username'] : ''}}" required>
			                                                        </div>

			                                                        <div class="form-group ">
			                                                            <label for="password">Password *</label>
			                                                            <input type="text" class="form-control" id="password" name="data[password]" placeholder="Client Secret" value="{{isset($data['password']) ? $data['password'] : ''}}" required>
			                                                        </div>

			                                                        <div class="form-group ">
			                                                            <label for="callback_url">Bkash Callback URL *</label>
			                                                            <input type="text" class="form-control" id="callback_url" name="data[callback_url]" placeholder="Client Secret" value="{{isset($data['callback_url']) ? $data['callback_url'] : ''}}"  readonly>
			                                                        </div>

			                                                        <input type="checkbox" id="sandbox" name="sandbox" value="1" @if($bkash->sandbox == 1) {{'checked'}} @endif>
																	<label for="sandbox"> Bkash Check Sandbox</label><br>

			                                                        <div class="form-group ">
			                                                            <label for="cod_text">Text *</label>
			                                                            <textarea name="text" class="form-control" placeholder="Enter Text" required>{{$bkash->text}}</textarea>
			                                                        </div>

			                                                    </div>
			                                                </form>
			                                                <div class="form-group">
											                  	<button type="submit" onclick="updateBkashData()" class="btn btn-primary">Submit</button>
											                </div>
		                                                </div>

		                                            </div>

	                                          	</div>

	                                          	<div id="ssl_commerz" class="container tab-pane">
	                                          		<br>

		                                            <div class="row justify-content-center">

		                                                <div class="col-lg-8">
		                                                	@php
															    // Decode the JSON data into an associative array

															    $data = isset($ssl->data) ? json_decode($ssl->data, true) : '';
															@endphp
		                                                	<form class="admin-form" action="{{route('payment.store')}}" method="POST" enctype="multipart/form-data" id="sslForm">

							                                    @csrf
							                                    
							                                    <input type="hidden" value="{{ isset($ssl->id) ? $ssl->id : '' }}" name="id">

			                                                    <div class="form-group">
															        <label class="switch">
															            <input type="checkbox" name="status" class="sslChecker" value="1" @if($ssl->status == 1) {{'checked'}} @endif>
															            <span class="slider"></span>
															        </label> Display {{isset($ssl->name) ? $ssl->name : 'Cash On Delivery'}}
															    </div>

			                                                    <div class="radio-show sslShow"  @if($ssl->status != 1) style="display: none;" @endif>

			                                                        <img src="{{Storage::disk('local')->url($ssl->image)}}" class="profile-user-img img-responsive" alt="{{$ssl->name}}" id="sslImageoutput">

										                     		<div class="form-group">
													                    <label for="exampleInputFile">Current Image</label>
													                    <div class="input-group">
														                    <div class="custom-file">
														                        <input type="file" accept="image/*" onchange="loadSSLFile(event)" name="image" class="custom-file-input" id="ImageInputFile">
														                        <label class="custom-file-label" for="exampleInputFile">Upload Image</label>
														                    </div>
													                    </div>
													                </div>
												                    <small style="color: blue;">Image Size Should Be 52 x 35.</small>

			                                                        <div class="line"></div>

			                                                        <div class="form-group ">
			                                                            <label for="name">Enter Name *</label>
			                                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{isset($ssl->name) ? $ssl->name : ''}}" required>
			                                                        </div>


			                                                        <div class="form-group ">
			                                                            <label for="store_id">SSLCommerz Store Id *</label>
			                                                            <input type="text" class="form-control" id="store_id" name="data[store_id]" placeholder="Enter Client Id" value="{{isset($data['store_id']) ? $data['store_id'] : ''}}" required>
			                                                        </div>

			                                                        <div class="form-group ">
			                                                            <label for="store_password">SSLCommerz Store Password *</label>
			                                                            <input type="text" class="form-control" id="store_password" name="data[store_password]" placeholder="Client Secret" value="{{isset($data['store_password']) ? $data['store_password'] : ''}}" required>
			                                                        </div>

			                                                        <input type="checkbox" id="sandbox" name="sandbox" value="1" @if($ssl->sandbox == 1) {{'checked'}} @endif>
																	<label for="sandbox"> SSLCommerz Check Sandbox</label><br>

			                                                        <div class="form-group ">
			                                                            <label for="cod_text">Text *</label>
			                                                            <textarea name="text" class="form-control" placeholder="Enter Text" required>{{$ssl->text}}</textarea>
			                                                        </div>

			                                                    </div>
			                                                </form>
			                                                <div class="form-group">
											                  	<button type="submit" onclick="updateSSLData()" class="btn btn-primary">Submit</button>
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
		var loadCodFile = function(event) {
			$('#codImageoutput').show();
			var image = document.getElementById('codImageoutput');
			image.src = URL.createObjectURL(event.target.files[0]);
		};

		var loadStripeFile = function(event) {
			$('#stripeImageoutput').show();
			var image = document.getElementById('stripeImageoutput');
			image.src = URL.createObjectURL(event.target.files[0]);
		};

		var loadPaypalFile = function(event) {
			$('#paypalImageoutput').show();
			var image = document.getElementById('paypalImageoutput');
			image.src = URL.createObjectURL(event.target.files[0]);
		};

		var loadBkashFile = function(event) {
			$('#bkashImageoutput').show();
			var image = document.getElementById('bkashImageoutput');
			image.src = URL.createObjectURL(event.target.files[0]);
		};

		var loadSSLFile = function(event) {
			$('#sslImageoutput').show();
			var image = document.getElementById('sslImageoutput');
			image.src = URL.createObjectURL(event.target.files[0]);
		};

		// Function to toggle visibility based on checkbox state
	    function toggleCodShow() {
	        var checkbox = document.querySelector('.codChecker');
	        var codShow = document.querySelector('.codShow');
	        if (checkbox.checked) {
	            codShow.style.display = 'block';
	        } else {
	            codShow.style.display = 'none';
	        }
	    }

	    // Call the function on page load and whenever checkbox state changes
	    window.onload = toggleCodShow;
	    document.querySelector('.codChecker').addEventListener('change', toggleCodShow);


	    // Function to toggle visibility based on checkbox state
	    function toggleStripeShow() {
	        var checkbox = document.querySelector('.stripeChecker');
	        var stripeShow = document.querySelector('.stripeShow');
	        if (checkbox.checked) {
	            stripeShow.style.display = 'block';
	        } else {
	            stripeShow.style.display = 'none';
	        }
	    }

	    // Call the function on page load and whenever checkbox state changes
	    window.onload = toggleStripeShow;
	    document.querySelector('.stripeChecker').addEventListener('change', toggleStripeShow);


	    // Function to toggle visibility based on checkbox state
	    function togglePaypalShow() {
	        var checkbox = document.querySelector('.paypalChecker');
	        var paypalShow = document.querySelector('.paypalShow');
	        if (checkbox.checked) {
	            paypalShow.style.display = 'block';
	        } else {
	            paypalShow.style.display = 'none';
	        }
	    }

	    // Call the function on page load and whenever checkbox state changes
	    window.onload = togglePaypalShow;
	    document.querySelector('.paypalChecker').addEventListener('change', togglePaypalShow);


	    // Function to toggle visibility based on checkbox state
	    function toggleBkashShow() {
	        var checkbox = document.querySelector('.bkashChecker');
	        var bkashShow = document.querySelector('.bkashShow');
	        if (checkbox.checked) {
	            bkashShow.style.display = 'block';
	        } else {
	            bkashShow.style.display = 'none';
	        }
	    }

	    // Call the function on page load and whenever checkbox state changes
	    window.onload = toggleBkashShow;
	    document.querySelector('.bkashChecker').addEventListener('change', toggleBkashShow);


	    // Function to toggle visibility based on checkbox state
	    function toggleSSLShow() {
	        var checkbox = document.querySelector('.sslChecker');
	        var sslShow = document.querySelector('.sslShow');
	        if (checkbox.checked) {
	            sslShow.style.display = 'block';
	        } else {
	            sslShow.style.display = 'none';
	        }
	    }

	    // Call the function on page load and whenever checkbox state changes
	    window.onload = toggleSSLShow;
	    document.querySelector('.sslChecker').addEventListener('change', toggleSSLShow);
	    

		function updateCoodData() {
	    	var form = document.getElementById('codForm');
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
	                toastr.success('Gateway Content update successfully.');
	            },
	            error: function(error) {
	                // Handle error response, e.g., show error message
	                alert('Error updating loader.');
	            }
	        });
	    }

	    function updateStripeData() {
	    	var form = document.getElementById('stripeForm');
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
	                toastr.success('Gateway Content update successfully.');
	            },
	            error: function(error) {
	                // Handle error response, e.g., show error message
	                alert('Error updating loader.');
	            }
	        });
	    }

	    function updatePaypalData() {
	    	var form = document.getElementById('paypalForm');
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
	                toastr.success('Gateway Content update successfully.');
	            },
	            error: function(error) {
	                // Handle error response, e.g., show error message
	                alert('Error updating loader.');
	            }
	        });
	    }

	    function updateBkashData() {
	    	var form = document.getElementById('bkashForm');
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
	                toastr.success('Gateway Content update successfully.');
	            },
	            error: function(error) {
	                // Handle error response, e.g., show error message
	                alert('Error updating loader.');
	            }
	        });
	    }

	    function updateSSLData() {
	    	var form = document.getElementById('sslForm');
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
	                toastr.success('Gateway Content update successfully.');
	            },
	            error: function(error) {
	                // Handle error response, e.g., show error message
	                alert('Error updating loader.');
	            }
	        });
	    }

	</script>
	
@endsection