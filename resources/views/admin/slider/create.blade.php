@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Slider
@endsection
@section('admin_css_content')
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Create Slider</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Slider']);
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
    	<form action="{{route('slider.store')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    		@csrf
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
			                    <label for="exampleInputEmail1">Title *</label>
			                    <input type="text"  class="form-control" id="title" name="title" placeholder="Enter Title" required>
			                </div>

			                <div class="form-group">
			                    <label for="exampleInputEmail1">Link *</label>
			                    <input type="text"  class="form-control" id="link" name="link" placeholder="Enter Link" required>
			                </div>

			                <div class="from-group">
				            	<label for="exampleInputEmail1">Details</label>
				              	<textarea class="form-control" name="description" placeholder="Details"></textarea>
				            </div>

				            <br>

				            <div class="from-group" style="margin-left: 25px;">
			                    <label class="form-check-label">
			                    	<input value="1" type="checkbox" name="active_slide" class="form-check-input">
				                    Want To make it first index?
			                    </label>
			              	</div> 
				            <br>
				            <img src="" class="profile-user-img img-responsive" alt="Selected Featured Image" id="output">
			                <div class="form-group">
			                    <label for="exampleInputFile">Set Slider Image *</label>
			                    <div class="input-group">
				                    <div class="custom-file">
				                        <input type="file" accept="image/*" onchange="loadFile(event)" name="featured_image" class="custom-file-input" id="FeaturedImageInputFile" required>
				                        <label class="custom-file-label" for="exampleInputFile">Upload Image</label>
				                    </div>
			                    </div>
			                </div>
		                    <small style="color: blue;">Image Size Should Be 800 x 800. or square size</small>
		                </div>
		                <!-- /.card-body -->
		            </div>
		            <!-- /.card -->

		            <!-- general form elements -->
		            <div class="card card-default">
		            	<!-- /.card-body -->
		                <div class="card-footer">
		                  	<button type="submit" class="btn btn-primary">Save</button>
		                  	<a href="{{route('slider.index')}}" class="btn btn-default float-right">Cancel</a>
		                </div>
		                <!-- /.card-footer -->
		            </div>
		            <!-- /.card -->
		        </div>
        	</div>
        </form>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('admin_js_content')
	<script type="text/javascript">
		$('#output').hide();

		var loadFile = function(event) {
			$('#output').show();
			var image = document.getElementById('output');
			image.src = URL.createObjectURL(event.target.files[0]);
		};
	</script>
@endsection