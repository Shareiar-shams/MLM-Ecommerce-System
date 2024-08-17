@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Update Customize Option
@endsection
@section('admin_css_content')
	
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Update Customize Option</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Product', 'Customize']);
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
			<div class="col-12">
            	<div class="card">
	              	<div class="card-header">
	                	<h3 class="card-title">Customize Option</h3>

	                	<div class="right-content" style="float: right;">
		                	<a href="{{ route('product.customize.design',$product->id) }}" class="btn btn-primary" title=""><i class="fas fa-chevron-left"></i>Back</a>
	                	</div>
	              	</div>
	            </div>
	        </div>
		</div>
    	<form action="{{route('product.customize.design.update',['productId' => $product->id, 'id' => $design_option->id])}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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
			                    <label for="exampleInputEmail1">Option Name *</label>
			                    <input type="text"  class="form-control" onkeyup="listingslug(this.value)" id="name" value="{{$design_option->option_name}}" name="option_name" placeholder="Enter Name" required>
			                </div>
			                <div class="form-group">
			                    <label for="exampleInputPassword1">Option Value *</label>
			                    <input type="text" class="form-control" id="slug" value="{{$design_option->option_value}}" name="option_value" placeholder="Enter Value" required>
			                </div>
			                <div class="form-group">
			                    <label for="exampleInputEmail1">Option Type *</label>
			                    <input type="text"  class="form-control" id="type" value="{{$design_option->option_type}}" name="option_type" placeholder="Enter Type" required>
			                </div>
			                
			                <br><br>
			                <img src="{{Storage::disk('local')->url($design_option->image)}}" class="profile-user-img img-responsive" alt="Selected Customize Option Image" id="output">
			                <div class="form-group">
			                    <label for="exampleInputFile">Option Image *</label>
			                    <div class="input-group">
				                    <div class="custom-file">
				                        <input type="file" value="{{$design_option->image}}" accept="image/*" onchange="loadFile(event)" name="image" class="custom-file-input" id="FeaturedImageInputFile">
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
		                  	<button type="submit" class="btn btn-primary">Update</button>
		                  	
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


		var loadFile = function(event) {
			$('#output').show();
			var image = document.getElementById('output');
			image.src = URL.createObjectURL(event.target.files[0]);
		};

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