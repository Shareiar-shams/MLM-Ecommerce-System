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
    	<form action="{{route('productoffer.update',$data->id)}}" method="post" accept-charset="utf-8">
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
		                	<div class="row">
				                <div class="form-group col-md-4 col-sm-4">
				                    <label for="exampleInputEmail1">Name *</label>
				                    <input type="text"  class="form-control" id="name" name="name" placeholder="Enter Name" value="{{$data->name}}" required>
				                </div>

				                <div class="form-group col-md-4 col-sm-4">
					                <label>Offer For *</label>
					                <select class="form-control" id="offer_for" name="offer_for" style="width: 100%;" required>
					                    <option value="digitalproduct" {{$data->offer_for == "digitalproduct"  ? 'selected' : ''}}>Digital Product</option>
					                    <option value="ecommerceproduct" {{$data->offer_for == "ecommerceproduct"  ? 'selected' : ''}}>E-Commerce Product</option>
					                </select>
				                </div>
		                		<div class="form-group col-md-4 col-sm-4" id="offer_type">
					                <label>Offer Type</label>
					                <select class="form-control" name="offer_type" style="width: 100%;">
					                    <option value="normal" {{$data->offer_type == "normal"  ? 'selected' : ''}}>Normal Offer</option>
					                    <option value="special" {{$data->offer_type == "special"  ? 'selected' : ''}}>Special Offer</option>
					                </select>
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
				        <!-- /.card-header -->
		                <div class="card-body">
		                	<div class="row">
		                		<div class="form-group col-md-3 col-sm-3">
				                    <label for="exampleInputEmail1">Percentage Rate *</label>
				                    <input type="text" class="form-control" id="offer_percentage" name="offer_percentage" value="{{$data->offer_percentage}}" placeholder="Enter Percentage for Offer" required>
				                </div>

				                <div class="form-group col-md-3 col-sm-3">
				                    <label for="exampleInputEmail1">User Percentage Rate</label>
				                    <input type="text" placeholder="Enter User Percentage From this offer" value="{{$data->user_percentage}}" class="form-control" id="user_percentage" name="user_percentage">
				                </div>

				                <div class="form-group col-md-3 col-sm-3">
				                    <label for="exampleInputEmail1">Offer Last Date *</label>
				                    <input type="date" value="{{ \Illuminate\Support\Carbon::parse($data->last_date)->format("Y-m-d")}}" class="form-control" id="last_date" name="last_date" required>
				                </div>

				                <div class="form-group col-md-3 col-sm-3">
					                <label>Status *</label>
					                <select class="form-control" name="status" style="width: 100%;" required>
					                    <option value="1" {{$data->status == "1"  ? 'selected' : ''}}>Publish</option>
					                    <option value="0" {{$data->status == "0"  ? 'selected' : ''}}>Unpublish</option>
					                </select>
				                </div>
		                	</div>
		                </div>
		                <!-- /.card-body -->
		                <div class="card-footer">
		                	<div class="card-footer">
			                  	<button type="submit" class="btn btn-primary">Update</button>
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