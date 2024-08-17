@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Digita Product
@endsection
@section('admin_css_content')
	<!-- summernote -->
  	<link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.min.css')}}">
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Create Digital Product</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Digital Product']);
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
    	<form action="{{route('digitalproduct.store')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    		{{csrf_field()}}
        	<div class="row">
        	
	          	<!-- left column -->
	          	<div class="col-md-8 col-sm-6">
		            <!-- general form elements -->
		            <div class="card card-default">
		            	<div class="card-header">

				            <div class="card-tools">
				              <button type="button" class="btn btn-tool" data-card-widget="collapse">
				                <i class="fas fa-minus"></i>
				              </button>
				              
				            </div>
				        </div>
				        <!-- /.card-header -->
		                <div class="card-body">
			                <div class="form-group">
			                    <label for="exampleInputEmail1">Name *</label>
			                    <input type="text"  class="form-control" onkeyup="listingslug(this.value)" id="name" name="name" placeholder="Enter Name" required>
			                </div>
			                <div class="form-group">
			                    <label for="exampleInputPassword1">Slug *</label>
			                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter Slug" required>
			                </div>
		                </div>
		                <!-- /.card-body -->
		            </div>
		            <!-- /.card -->

		            <!-- general form elements -->
		            <div class="card card-default">
		            	<div class="card-header">

				            <div class="card-tools">
				              <button type="button" class="btn btn-tool" data-card-widget="collapse">
				                <i class="fas fa-minus"></i>
				              </button>
				              
				            </div>
				        </div>
				        <!-- /.card-header -->
		                <div class="card-body">
		                	<img src="" class="profile-user-img img-responsive" alt="Selected Featured Image" id="output">
			                <div class="form-group">
			                    <label for="exampleInputFile">Featured Image *</label>
			                    <div class="input-group">
				                    <div class="custom-file">
				                        <input type="file" accept="image/*" onchange="loadFile(event)" name="featured_image" class="custom-file-input" id="FeaturedImageInputFile" required>
				                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
				                    </div>
			                    </div>
			                </div>
		                </div>
		                <!-- /.card-body -->
		            </div>
		            <!-- /.card -->

		            <!-- Input addon -->
		            <div class="card card-default">
		            	<div class="card-header">

				            <div class="card-tools">
				              <button type="button" class="btn btn-tool" data-card-widget="collapse">
				                <i class="fas fa-minus"></i>
				              </button>
				              
				            </div>
				        </div>
				        <!-- /.card-header -->
		                <div class="card-body">
		                  <div class="form-group">
		                    <label for="exampleInputFile">Gallery Images</label>
		                    <div class="input-group">
		                      <div class="custom-file">
		                        <input type="file" name ="gallery_image" class="custom-file-input" id="exampleInputFile">
		                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
		                      </div>
		                    </div>
		                  </div>
		                </div>
		                <!-- /.card-body -->
		            </div>
		            <!-- /.card -->

		            <!-- Horizontal Form -->
		            <div class="card card-default">
		            	<div class="card-header">

				            <div class="card-tools">
				              <button type="button" class="btn btn-tool" data-card-widget="collapse">
				                <i class="fas fa-minus"></i>
				              </button>
				              
				            </div>
				        </div>
				        <!-- /.card-header -->
			            <div class="card-body">

			                <div class="form-group">
				                <label>Select Type *</label>
				                <select class="form-control select2bs4" name="delivery_type" id="display_type" style="width: 100%;" required>
				                    <option value="Link" selected="selected">Youtube Playlist Link</option>
				                    <option value="File">File</option>
				                </select>
			                </div>

			                <div class="form-group type-link">
			                    <label for="exampleInputPassword1">Youtube Playlist Link *</label>
			                    <input type="text" class="form-control" name="delivery_link" placeholder="Enter Link">
			                </div>
			                <div class="form-group type-file">
			                    <label for="exampleInputFile">File *</label>
			                    <div class="input-group">
				                    <div class="custom-file">
				                        <input type="file" name="delivery_file" class="custom-file-input" id="exampleInputFile">
				                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
				                    </div>
			                    </div>
			                </div>
			            </div>
		              	<!-- /.card-body -->
		            </div>
		            <!-- /.card -->

		            <!-- general form elements -->
		            <div class="card card-default">
		            	<div class="card-header">

				            <div class="card-tools">
				              <button type="button" class="btn btn-tool" data-card-widget="collapse">
				                <i class="fas fa-minus"></i>
				              </button>
				              
				            </div>
				        </div>

			            <div class="card-body">
			            	<label for="exampleInputEmail1">Short Description *</label>
			              	<textarea class="form-control" name="short_description" placeholder="Short Description"></textarea>

			            	<label for="exampleInputEmail1">Description *</label>
			              	<textarea id="summernote" name="description" placeholder="Description" required>
			                	
			              	</textarea>
			            </div>
		                <!-- /.card-body -->
		            </div>
		            <!-- /.card -->

		            <!-- general form elements -->
		            <div class="card card-default">
		            	<div class="card-header">

				            <div class="card-tools">
				              <button type="button" class="btn btn-tool" data-card-widget="collapse">
				                <i class="fas fa-minus"></i>
				              </button>
				              
				            </div>
				        </div>

			            <div class="card-body">
			              	<label for="exampleInputEmail1">Meta Keywords</label>
		                    <input type="text" name="meta_keyword" class="form-control" id="exampleInputEmail1" placeholder="Enter Meta Keywords">

			            	<label for="exampleInputEmail1">Meta Description</label>
			              	<textarea name="meta_desc" class="form-control" placeholder="Enter Meta Descriptions"></textarea>
			            </div>
		                <!-- /.card-body -->
		            </div>
		            <!-- /.card -->
	          	</div>
	          	<!--/.col (left) -->

		        <!-- right column -->
		        <div class="col-md-4 col-sm-6">
		            <!-- general form elements -->
		            <div class="card card-default">
		            	<div class="card-header">

				            <div class="card-tools">
				              <button type="button" class="btn btn-tool" data-card-widget="collapse">
				                <i class="fas fa-minus"></i>
				              </button>
				              
				            </div>
				        </div>

			            <div class="card-body">
			              	<label for="exampleInputEmail1">Current Price *</label>
			            	<div class="input-group">
			                  <div class="input-group-prepend">
			                    <span class="input-group-text">
			                      <i class="fas fa-dollar-sign"></i>
			                    </span>
			                  </div>
			                  <input type="text" name="price" class="form-control" placeholder="Enter Current Price" required>
			                </div>

			            	<label for="exampleInputEmail1">Special Price</label>
		                    <div class="input-group">
			                  <div class="input-group-prepend">
			                    <span class="input-group-text">
			                      <i class="fas fa-dollar-sign"></i>
			                    </span>
			                  </div>
			                  <input type="text" name="special_price" class="form-control" placeholder="Enter Special Price">
			                </div>
			            </div>
		                <!-- /.card-body -->
		            </div>
		            <!-- /.card -->

		            <!-- general form elements -->
		            <div class="card card-default">
		            	<div class="card-header">

				            <div class="card-tools">
				              <button type="button" class="btn btn-tool" data-card-widget="collapse">
				                <i class="fas fa-minus"></i>
				              </button>
				              
				            </div>
				        </div>
				        <!-- /.card-header -->
		                <div class="card-body">
		                  <div class="form-group">
		                    <label for="exampleInputEmail1">SKU *</label>
		                    <input type="text" name="SKU" class="form-control" id="exampleInputEmail1" value="{{$sku}}" placeholder="Enter SKU" required>
		                  </div>
		                  {{-- <div class="form-group">
		                    <label for="exampleInputPassword1">Video Link</label>
		                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter Video Link">
		                  </div> --}}
		                </div>
		                <!-- /.card-body -->
		            </div>
		            <!-- /.card -->

		            <!-- general form elements -->
		            <div class="card card-default">
		            	<!-- /.card-body -->
		                <div class="card-footer">
		                  	<button type="submit" class="btn btn-info">Save</button>
		                  	<a href="{{route('digitalproduct.index')}}" class="btn btn-default float-right">Cancel</a>
		                </div>
		                <!-- /.card-footer -->
		            </div>
		            <!-- /.card -->
		        </div>
		        <!--/.col (right) -->
        	</div>
        </form>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('admin_js_content')
	<!-- Summernote -->
	<script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
	<!-- Page specific script -->
	<script>
		$('.type-file').hide();
		$('#output').hide();
		var loadFile = function(event) {
			$('#output').show();
			var image = document.getElementById('output');
			image.src = URL.createObjectURL(event.target.files[0]);
		};
	  	$(function () {
	    	// Summernote
	    	$('#summernote').summernote()
	    
	  	})

	  	function slugify(text) {
		  	return text
		    .toString()                     // Cast to string
		    .toLowerCase()                  // Convert the string to lowercase letters
		    .normalize('NFD')       // The normalize() method returns the Unicode Normalization Form of a given string.
		    .replace(/\s+/g, '-')           // Replace spaces with -
		    .replace(/[^\w\-]+/g, '-')       // Remove all non-word chars
		    .replace(/\-\-+/g, '-')        // Replace multiple - with single -
		    .replace(/\&\&+/g, '-')        // Replace multiple & with single -
		    .replace(/\_\_+/g, '-')        // Replace multiple & with single -
		    
		    .trim();                         // Remove whitespace from both sides of a string
		}

		function listingslug(text) {
		 	document.getElementById("slug").value = slugify(text); 
		}

		$(function() {
			$('#display_type').on('change', function() {
				if(this.value === 'File') {
				  	$('.type-link').hide();
				  	$('.type-file').show();
				}else{
					$('.type-file').hide();
				  	$('.type-link').show();
				}
			});
		});
	</script>
@endsection