@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Digita Product
@endsection
@section('admin_css_content')
	
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Digital Product Offer</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Digital Product Offer']);
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
    	<form action="{{route('productoffer.add.description',$data->id)}}" method="post" accept-charset="utf-8">
    		@csrf
			@method('put')
        	<div class="row">
        	
	          	<!-- left column -->
	          	<div class="col-md-12 col-sm-12">
		            
		            <!-- general form elements -->
		            <div class="card card-default">
		            	<div class="card-header">
		            		<div class="card-title">
		            			Add Offer Description
		            		</div>
				            <div class="card-tools">
				              	<button type="button" class="btn btn-tool" data-card-widget="collapse">
				                <i class="fas fa-minus"></i>
				              	</button>
				              
				            </div>
				        </div>
				        <!-- /.card-header -->
		                <div class="card-body">
		                	<div class="row">
		                		<div class="form-group col-md-12 col-sm-12">
				                    <label for="exampleInputEmail1">Description</label>
				                    <textarea class="form-control" id="description" name="description" placeholder="{{$data->description}}">{{$data->description}}</textarea>
				                </div>
		                	</div>
		                </div>
		                <!-- /.card-body -->
		                <div class="card-footer">
		                	<div class="card-footer">
		                		@if(empty($data->description))
			                  		<button type="submit" class="btn btn-primary">Add</button>
			                  	@else
			                  		<button type="submit" class="btn btn-primary">Update</button>
			                  	@endif
			                  	<a href="{{route('productoffer.index')}}" class="btn btn-info">back</a>
			                </div>
		                </div>
		                <!-- /.card-footer -->
		            </div>
		            <!-- /.card -->

	          	</div>
	          	<!--/.col (left) -->
        	</div>
	        <!-- /.row -->
        </form>
    </div><!-- /.container-fluid -->
@endsection

@section('admin_js_content')
@endsection