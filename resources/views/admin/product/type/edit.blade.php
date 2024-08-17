@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Product Type
@endsection
@section('admin_css_content')
	<!-- summernote -->
  <link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.min.css')}}">
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Update Product Type</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Product', 'Type']);
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
    	<form action="{{route('type.update',$data->id)}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    		@csrf
    		@method('put')
        	<div class="row">
        	
	          	<!-- left column -->
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
			                    <label for="exampleInputEmail1">Name *</label>
			                    <input type="text"  class="form-control" onkeyup="listingslug(this.value)" id="name" value="{{$data->name}}" name="name" placeholder="Enter Name" required>
			                </div>
			                <div class="form-group">
			                    <label for="exampleInputPassword1">Slug *</label>
			                    <input type="text" class="form-control" id="slug" value="{{$data->slug}}" name="slug" placeholder="Enter Slug" required>
			                </div>
		                </div>
		                <!-- /.card-body -->
		            </div>
		            <!-- /.card -->


		            <!-- general form elements -->
		            <div class="card card-default">
		            	<!-- /.card-body -->
		                <div class="card-footer">
		                  	<button type="submit" class="btn btn-info">Update</button>
		                  	<a href="{{route('type.index')}}" class="btn btn-default float-right">Cancel</a>
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