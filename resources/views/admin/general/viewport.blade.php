@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | General
@endsection
@section('admin_css_content')
  	<link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.min.css')}}">
  	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  	<!-- DataTables -->
  	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
	<style>
			
	    span.select2.select2-container.select2-container--classic{
	        width: 100% !important;
	    }
	</style>
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Basic Information</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Information']);
	@endphp
	<x-ad-breadcrumb :list="$list"/>
@endsection

@section('admin_main_content')
	<div class="container-fluid">
        <div class="row">
          	<div class="col-12">
          		<!-- /.row -->
			        <div class="card card-primary card-outline">
			          	<div class="card-header">
				            <h3 class="card-title">
				              	<i class="fas fa-edit"></i>
				              	Basic Information
				            </h3>
			          	</div>
				        <div class="card-body">
				            <div class="row">
					            <div class="col-5 col-sm-3">
					                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
					                  <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Basic Information</a>
					                  <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Media</a>
					                  <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Seo</a>
					                  <a class="nav-link" id="vert-tabs-menu-tab" data-toggle="pill" href="#vert-tabs-menu" role="tab" aria-controls="vert-tabs-menu" aria-selected="false">Menu</a>
					                  <a class="nav-link" id="vert-tabs-contact-tab" data-toggle="pill" href="#vert-tabs-contact" role="tab" aria-controls="vert-tabs-contact" aria-selected="false">Contact</a>
					                  <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false">Scripts</a>
					                  <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false">Shop & Checkout Page</a>
					                  <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false">Footer & Contact Page</a>
					                </div>
					            </div>
					            <div class="col-7 col-sm-9">
					                <div class="tab-content" id="vert-tabs-tabContent">
					                  	<div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
					                     	<!-- general form elements -->
								            <div class="card card-success">
								              	<div class="card-header">
								                	<h3 class="card-title">Informations</h3>
								              	</div>
								              	<!-- /.card-header -->
								              	<!-- form start -->
								              	<form action="{{route('app_name_customization')}}" method="post" accept-charset="utf-8">
								              		@csrf
								              		@method('put')
									                <div class="card-body">
									                	<input type="hidden" value="{{ isset($setting->id) ? $setting->id : '' }}" name="id">
										                <div class="form-group">
										                    <label for="exampleInputEmail1">App Name *</label>
										                    <input type="text" class="form-control" id="exampleInputEmail1" value="{{ isset($setting->app_name) ? $setting->app_name : ''}}" name="app_name" placeholder="Enter App Name" required>
										                </div>
										                <div class="form-group">
										                    <label for="exampleInputPassword1">Home Page Title *</label>
										                    <input type="text" class="form-control" id="exampleInputPassword1" name="home_page_title" value="{{ isset($setting->home_page_title) ? $setting->home_page_title : ''}}" placeholder="Home Page Title" required>
										                </div>
									                </div>
									                <!-- /.card-body -->

									                <div class="card-footer">
									                  	<button type="submit" class="btn btn-primary">Submit</button>
									                </div>
								              	</form>
								            </div>
								            <!-- /.card -->
					                  	</div>
					                  	<div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
					                     	<ul class="nav nav-pills nav-justified nav-secondary nav-pills-no-bd">
					                            <li class="nav-item">
					                                <a class="nav-link active" data-toggle="pill" href="#logo">Logo</a>
					                            </li>
					                            <li class="nav-item">
					                                <a class="nav-link" data-toggle="pill" href="#favicon">Favicon</a>
					                            </li>
					                            <li class="nav-item">
					                                <a class="nav-link" data-toggle="pill" href="#loader">Loader</a>
					                            </li>
			                          		</ul>
					                        <div class="tab-content">

				                                <div id="logo" class="container tab-pane active">
				                                	<br>
					                                <div class="row justify-content-center">
						                                <div class="col-lg-6">
						                                	<form action="{{ route("app_logo_customization") }}" method="POST" id="logoForm" accept-charset="utf-8" enctype="multipart/form-data">
								                  				@csrf
															    @method('put')
						                                    	
						                                        <div class="form-group">
						                                            <label for="name">Current Image</label>
						                                            <div class="col-lg-12 pb-1">
						                                                <img height="40" width="140" class="admin-setting-img" src="{{ isset($setting->logo) ? Storage::disk('local')->url($setting->logo) : asset('viewport/img/new-logo.png') }}" alt="Site Logo Image" id="output">
						                                            </div>
						                                            <span>Image Size Should Be 140 x 40.</span>
						                                        </div>

						                                        <div class="form-group">
						                                        	<input type="hidden" value="{{ isset($setting->id) ? $setting->id : '' }}" name="id">

												                    <div class="custom-file">
												                      	<input type="file" accept="image/*" onchange="loadFile(event)" class="custom-file-input" name="logo" id="customFile">
												                      	<label class="custom-file-label" for="customFile">Choose file</label>
												                    </div>
												                </div>
						                                	</form>
										                  	<div class="form-group">
											                  	<button type="submit" onclick="updateLogo()" class="btn btn-primary">Submit</button>
											                </div>
					                                    </div>
					                                </div>

					                                
				                                </div>

				                                <div id="favicon" class="container tab-pane">
				                                	<br>
				                                    <div class="row justify-content-center">

				                                        <div class="col-lg-6">
				                                        	<form action="{{ route("app_favicon_customization") }}" method="POST" id="faviconForm" accept-charset="utf-8" enctype="multipart/form-data">
								                  				@csrf
															    @method('put')

					                                            <div class="form-group">
							                                        <label for="name">Current Image</label>
						                                            <div class="col-lg-12 pb-1">
						                                                <img height="30" width="30" class="admin-setting-img" src="{{ isset($setting->favicon) ? Storage::disk('local')->url($setting->favicon) : asset('viewport/img/favicon.png') }}" alt="Site Favicon Image" id="output_fav">
						                                            </div>
						                                            <span>Image Size Should Be 16 x 16.</span>
							                                    </div>

						                                        <div class="form-group">
						                                        	<input type="hidden" value="{{ isset($setting->id) ? $setting->id : '' }}" name="id">

												                    <div class="custom-file">
												                      	<input type="file" accept="image/*" onchange="loadFile_fav(event)" class="custom-file-input" name="favicon" id="customFile">
												                      	<label class="custom-file-label" for="customFile">Choose file</label>
												                    </div>
												                </div>
															</form>
															<div class="form-group">
											                  	<button type="submit" onclick="updateFavicon()" class="btn btn-primary">Submit</button>
											                </div>

				                                        </div>

				                                    </div>
				                                </div>

				                                <div id="loader" class="container tab-pane">
				                                	<br>
				                                    <div class="row justify-content-center">

				                                        <div class="col-lg-6">
				                                        	<form action="{{ route("app_loader_customization") }}" method="POST" id="loaderForm" accept-charset="utf-8" enctype="multipart/form-data">
								                  				@csrf
															    @method('put')
					                                            <div class="form-group">
					                                                <label class="switch-primary">
					                                                
					                                                @if($setting->display_loader == 1)

						                                                <input value="1" type="checkbox" name="display_loader" class="switch switch-bootstrap "
													                      	@if($setting->display_loader == 1)
													                      		{{'checked'}} 
													                      	@endif
													                    >
													                @else
													                	<input type="checkbox" class="switch switch-bootstrap " name="display_loader" value="1">
													                @endif

					                                                <span class="switch-body"></span>

					                                                <span class="switch-text">Display Loader</span>
					                                                </label>
					                                            </div>
					                                            <div class="form-group">
					                                                <label for="name">Current Image</label>
					                                                <div class="col-lg-12 pb-1">
					                                                    <img class="admin-setting-img my-mw-100" src="{{ isset($setting->loader) ? Storage::disk('local')->url($setting->loader) : asset('viewport/img/loader.gif') }}" alt="No Image Found" width="100" height="100" id="output_load">
					                                                </div>
					                                            </div>
					                                            <div class="form-group position-relative ">
					                                            	<input type="hidden" value="{{ isset($setting->id) ? $setting->id : '' }}" name="id">

					                                                <label class="file">
					                                                    <input type="file" onchange="loadFile_load(event)" accept="image/*" class="upload-photo" name="loader" id="file" aria-label="File browser example">
					                                                    <span class="file-custom text-left">Upload Image...</span>
					                                                </label>
					                                            </div>
					                                        </form>

				                                            <div class="form-group">
											                  	<button type="submit" onclick="updateLoader()" class="btn btn-primary">Submit</button>
											                </div>

				                                        </div>
				                                    </div>

				                                </div>

				                            </div>
					                  	</div>
					                  	<div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
					                     	<div class="card-body">
						                  		<form action="{{ route("app_meta_customization") }}" method="POST" id="metaForm" accept-charset="utf-8" >
					                  				@csrf
												    @method('put')

												    <input type="hidden" value="{{ isset($setting->id) ? $setting->id : '' }}" name="id">

									            	<div class="from-group">
									            		<label for="exampleInputEmail1">Meta Keywords</label>

									            		@if(isset($setting->index_meta_keyword))
									            			<select class="js-example-basic-single-meta" multiple name="index_meta_keyword[]">
											              		@foreach(json_decode($setting->index_meta_keyword) as $keyword)
											              			<option value="{{$keyword}}" selected>{{$keyword}}</option>
											              		@endforeach
							                                </select>
									            		@else
										              	
											              	<select class="js-example-basic-single-meta" multiple name="index_meta_keyword[]"></select>
							                        	@endif

										              	
									            	</div>

									            	<div class="from-group mt-2">
										            	<label for="exampleInputEmail1">Meta Description</label>

										              	<textarea name="index_meta_description" class="form-control" placeholder="Enter Meta Descriptions">{{isset($setting->index_meta_description) ? $setting->index_meta_description : ''}}</textarea>
									            	</div>
									            </form>
									            <br>
									            <div class="form-group">
								                  	<button type="submit" onclick="updateMetaInformation()" class="btn btn-primary">Submit</button>
								                </div>

								            </div>
		                					<!-- /.card-body -->
					                  	</div>
						                <div class="tab-pane fade" id="vert-tabs-menu" role="tabpanel" aria-labelledby="vert-tabs-menu-tab">
						                    <div class="card-body">
						                    	<table id="example1" class="table table-bordered table-striped">
								                  	<thead>
										                <tr>
										                    <th>No</th>
										                    <th>Name</th>
										                    <th>Route</th>
										                    <th>Ordering</th>
										                    <th>Status</th>
										                    <th>Action</th>
										                </tr>
								                  	</thead>
								                  	<tbody>
								                  		@foreach($menus as $menu)
										                <tr>
									                    	<td>{{$loop->index + 1}}</td>
									                    	
									                    	<td>{{$menu->name}}</td>
									                    	<td>{{$menu->route}}</td>
									                    	<td>{{$menu->ordering}}</td>
									                    	
									                    	<td>
									                    		<div class="btn-group">
												                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">@if($menu->status == 1) Enable @else Disable @endif 
												                    	<span class="sr-only">Disable</span>
												                    </button>
												                    <div class="dropdown-menu" role="menu">
												                    	<form action="{{route('menu.status',$menu->id)}}" method="post" id="disable-form-{{$menu->id}}" style="display: none;">
									                              			@csrf
									                              			@method('put')
									                              			<input type="hidden" name="status" value="@if($menu->status == 1) 0 @else 1 @endif">
									                            		</form>
												                      	<a class="dropdown-item" href="#" onclick="
												                            if(confirm('Want to change this Menu status!'))
												                            {
												                                event.preventDefault();
												                                document.getElementById('disable-form-{{$menu->id}}').submit();
												                            }
												                            else
												                            {
												                                event.preventDefault();
												                            }
												                        ">@if($menu->status == 1) Disable @else Enable @endif</a>
												                    </div>
												                </div>
									                    	</td>
									                    	
									                    	<td>
									                    		<div class="btn-group">
												                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Options
												                      	<span class="sr-only">Toggle Dropdown</span>
												                    </button>
												                    <div class="dropdown-menu" role="menu">
												                    	<a class="dropdown-item" href="{{route('menu.edit',$menu->id)}}"><i class="fas fa-angle-double-right"></i>Edit</a>
												                      	
												                    </div>
												                </div>
									                    	</td>
										                </tr>
										                @endforeach
								                  	</tbody>
								                </table>
						                    </div>
						                    <!-- /.card-body -->
						                </div>
						                <div class="tab-pane fade" id="vert-tabs-contact" role="tabpanel" aria-labelledby="vert-tabs-contact-tab">
						                    <!-- general form elements -->
								            <div class="card card-success">
								              	<div class="card-header">
								                	<h3 class="card-title">Contact</h3>
								              	</div>
								              	<!-- /.card-header -->
								              	<!-- form start -->
								              	<form action="{{route('dyContact.update',$contact->id)}}" method="post" accept-charset="utf-8">
								              		@csrf
								              		@method('put')
									                <div class="card-body">
									                	
										                <div class="form-group">
										                    <label for="exampleInputEmail1">Title *</label>
										                    <input type="text" class="form-control" id="exampleInputEmail1" value="{{ isset($contact->title) ? $contact->title : ''}}" name="title" placeholder="Enter Title" required>
										                </div>
										                <div class="form-group">
										                    <label for="exampleInputPassword1">Subtitle </label>
										                    <textarea name="subtitle" class="form-control" placeholder="Enter Subtitle">{{isset($contact->subtitle) ? $contact->subtitle : ''}}</textarea>
										                </div>
										                <div class="form-group">
										                    <label for="exampleInputEmail1">Address *</label>
										                    <input type="text" class="form-control" id="exampleInputEmail1" value="{{ isset($contact->address) ? $contact->address : ''}}" name="address" placeholder="Enter Address" required>
										                </div>
										                <div class="from-group">
										            		<label for="exampleInputEmail1">Contact Numbers *</label>

										            		@if(isset($contact->contact_number))
										            			<select class="js-example-basic-single-meta" multiple name="contact_number[]">
												              		@foreach(json_decode($contact->contact_number) as $number)
												              			<option value="{{$number}}" selected>{{$number}}</option>
												              		@endforeach
								                                </select>
										            		@else
											              	
												              	<select class="js-example-basic-single-meta" multiple name="contact_number[]"></select>
								                        	@endif
										            	</div>
										            	<div class="from-group">
										            		<label for="exampleInputEmail1">Office Hours *</label>

										            		@if(isset($contact->time_schedule))
										            			<select class="js-example-basic-single-meta" multiple name="time_schedule[]">
												              		@foreach(json_decode($contact->time_schedule) as $time)
												              			<option value="{{$time}}" selected>{{$time}}</option>
												              		@endforeach
								                                </select>
										            		@else
											              	
												              	<select class="js-example-basic-single-meta" multiple name="time_schedule[]"></select>
								                        	@endif
										            	</div>
										            	<div class="from-group">
										            		<label for="exampleInputEmail1">Official Email *</label>

										            		@if(isset($contact->email))
										            			<select class="js-example-basic-single-meta" multiple name="email[]">
												              		@foreach(json_decode($contact->email) as $email)
												              			<option value="{{$email}}" selected>{{$email}}</option>
												              		@endforeach
								                                </select>
										            		@else
											              	
												              	<select class="js-example-basic-single-meta" multiple name="email[]"></select>
								                        	@endif
										            	</div>
										            	<div class="form-group">
										                    <label for="exampleInputPassword1">Location iFrame* </label>
										                    <textarea name="location" class="form-control" placeholder="Enter iFrame of Location">{{isset($contact->location) ? $contact->location : ''}}</textarea>
										                </div>
									                </div>
									                <!-- /.card-body -->

									                <div class="card-footer">
									                  	<button type="submit" class="btn btn-primary">Submit</button>
									                </div>
								              	</form>
								            </div>
								            <!-- /.card -->
						                </div>
					                  	<div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
						                     Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
					                  	</div>
					                </div>
					            </div>
				            </div>
				        </div>
			          	<!-- /.card -->
			        </div>
			        <!-- /.card -->
          	</div>
        </div>
    </div>
@endsection

@section('admin_js_content')
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<script type="text/javascript">
		var loadFile = function(event) {
			$('#output').show();
			var image = document.getElementById('output');
			image.src = URL.createObjectURL(event.target.files[0]);
		};

		var loadFile_fav = function(event) {
			$('#output_fav').show();
			var image = document.getElementById('output_fav');
			image.src = URL.createObjectURL(event.target.files[0]);
		};


		var loadFile_load = function(event) {
			$('#output_load').show();
			var image = document.getElementById('output_load');
			image.src = URL.createObjectURL(event.target.files[0]);
		};

		$('.js-example-basic-single').select2({
	        theme: "classic",
	        tags: true
	    });

	    $('.js-example-basic-single-meta').select2({
	        theme: "classic",
	        tags: true
	    });

	    function updateLogo() {
	    	var form = document.getElementById('logoForm');
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
	                toastr.success('Logo updated successfully.');
	            },
	            error: function(error) {
	                // Handle error response, e.g., show error message
	                alert('Error updating logo.');
	            }
	        });
	    }

	    function updateFavicon() {
	    	var form = document.getElementById('faviconForm');
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
	                toastr.success('Favicon updated successfully.');
	            },
	            error: function(error) {
	                // Handle error response, e.g., show error message
	                alert('Error updating Favicon.');
	            }
	        });
	    }

	    function updateLoader() {
	    	var form = document.getElementById('loaderForm');
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
	                toastr.success('Loader updated successfully.');
	            },
	            error: function(error) {
	                // Handle error response, e.g., show error message
	                alert('Error updating loader.');
	            }
	        });
	    }


	    function updateMetaInformation() {
	    	var form = document.getElementById('metaForm');
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
	                toastr.success('Meta Content updated successfully.');
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