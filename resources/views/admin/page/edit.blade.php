@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Pages
@endsection
@section('admin_css_content')
	<!-- summernote -->
  	<link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.min.css')}}">
  	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<style>
			
	    span.select2.select2-container.select2-container--classic{
	        width: 100% !important;
	    }
	</style>
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Page']);
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
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					<h5 class="m-0">Update Page</h5>
				</div>
				<a style="float: right;" href="{{route('page.index')}}" class="btn btn-primary" title=""><i class="fas fa-chevron-left"></i>Back</a>
			</div>
		</div>
    	<form action="{{route('page.update',$page->id)}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    		@csrf
    		@method('put')
        	<div class="row">
        	
	          	<!-- column -->
	          	<div class="col-md-12 col-sm-12">
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
			                    <label for="exampleInputEmail1">Title *</label>
			                    <input type="text"  class="form-control" onkeyup="listingslug(this.value)" id="name" name="title" value="{{$page->title}}" placeholder="Enter Title" required>
			                </div>
			                @if(strpos($page->slug, 'about') !== false)
				                <div class="card-body">

				                	<img src="{{Storage::disk('local')->url($page->image)}}" class="profile-user-img img-responsive" alt="Selected Featured Image" id="output">
					                <div class="form-group">
					                    <label for="exampleInputFile">Image *</label>
					                    <div class="input-group">
						                    <div class="custom-file">
						                        <input type="file" value="{{$page->image}}" accept="image/*" onchange="loadFile(event)" name="image" class="custom-file-input" id="FeaturedImageInputFile">
						                        <label class="custom-file-label" for="exampleInputFile">Upload Image</label>
						                    </div>
					                    </div>
					                </div>
				                    <small style="color: blue;">Image Size Should Be (width) 640 px x (height)960 px</small>
				                </div>
				                <input type="hidden" name="slug" value="{{$page->slug}}">
			                @else
				                <div class="form-group">
				                    <label for="exampleInputPassword1">Slug *</label>
				                    <input type="text" class="form-control" id="slug" name="slug" value="{{$page->slug}}" placeholder="Enter Slug" required>
				                </div>
			                @endif
			                <div class="from-group mt-3">
				            	<label for="exampleInputEmail1">Description *</label>
				              	<textarea id="summernote" name="description" placeholder="Description" required>{{$page->description}}</textarea>
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
			            	<div class="from-group">
			            		
				              	<label for="exampleInputEmail1">Meta Keywords</label>
				              	<select class="js-example-basic-single-meta" multiple name="meta_keywords[]">
				              		@if(isset($page->meta_keywords))
				              		@foreach(json_decode($page->meta_keywords) as $keyword)
				              			<option value="{{$keyword}}" selected>{{$keyword}}</option>
				              		@endforeach
				              		@endif
                                </select>
			            	</div>

			            	<div class="from-group mt-2">
				            	<label for="exampleInputEmail1">Meta Description</label>
				              	<textarea name="meta_descriptions" class="form-control" placeholder="Enter Meta Descriptions">{{$page->meta_descriptions}}</textarea>
			            	</div>

			            </div>
		                <!-- /.card-body -->
		            </div>
		            <!-- /.card -->

		            <!-- general form elements -->
		            <div class="card card-default">
		            	<!-- /.card-body -->
		                <div class="card-footer">
		                  	<button type="submit" class="btn btn-primary">Update</button>
		                </div>
		                <!-- /.card-footer -->
		            </div>
		            <!-- /.card -->
	          	</div>
	          	<!--/.col -->

        	</div>
        </form>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('admin_js_content')
	<!-- Summernote -->
	<script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script type="text/javascript">
		var loadFile = function(event) {
			$('#output').show();
			var image = document.getElementById('output');
			image.src = URL.createObjectURL(event.target.files[0]);
		};

		$(function () {
	    	// Summernote
	    	$('#summernote').summernote()
	    
	  	});

		$('.js-example-basic-single').select2({
	        theme: "classic",
	        tags: true
	    });

	    $('.js-example-basic-single-meta').select2({
	        theme: "classic",
	        tags: true
	    });

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
	</script>
@endsection