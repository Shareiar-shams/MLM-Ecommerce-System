@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Create Attribute
@endsection
@section('admin_css_content')
	
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Create Attribute</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Product', 'Attribute']);
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
	                	<h3 class="card-title">Attributes</h3>

	                	<div class="right-content" style="float: right;">
		                	<a href="{{ route('product.attribute',$id) }}" class="btn btn-primary" title=""><i class="fas fa-chevron-left"></i>Back</a>
	                	</div>
	              	</div>
	            </div>
	        </div>
		</div>
    	<form action="{{route('product.attribute.update',['productId' => $productId, 'id' => $attribute->id])}}" method="post" >
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
			                    <label for="exampleInputEmail1">Name *</label>
			                    <input type="text"  class="form-control" value="{{$attribute->name}}" id="name" name="name" placeholder="Enter Name" required>
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
        	</div>
        </form>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('admin_js_content')
@endsection