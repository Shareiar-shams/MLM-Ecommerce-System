@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Digita Product
@endsection
@section('admin_css_content')
	<!-- Select2 -->
  	<link rel="stylesheet" href="{{Vite::asset('resources/plugins/select2/css/select2.min.css')}}">
  	<link rel="stylesheet" href="{{Vite::asset('resources/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  	
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
    	<form action="{{route('productoffer.add.digitalproduct',$data->id)}}" method="post" accept-charset="utf-8">
    		@csrf
			@method('put')
        	<div class="row">
        	
	          	<!-- left column -->
	          	<div class="col-md-12 col-sm-12">
		            
		            <!-- general form elements -->
		            <div class="card card-default">
		            	<div class="card-header">
		            		<div class="card-title">
		            			Add Product For This Offer
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
		                		<div class="col-md-12 col-sm-12">
			                		<div class="form-group ">
					                  	<label>Digital Product</label>
						                <select class="form-control select2" name="digital_product_id" style="width: 100%;">
						                	@foreach($products as $product)
						                		@if(!isset($data->digital_product_id))
							                    	<option value="{{$product->id}}" @if ($loop->first) selected @endif>{{$product->name}}</option>
							                    @else
							                    	<option value="{{$product->id}}" {{$data->digital_product_id == $product->id ? 'selected' : ''}}>{{$product->name}}</option>
							                   	@endif
						                    @endforeach
						                </select>
					                </div>
					                <!-- /.form-group -->
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
	<!-- Select2 -->
	<script src="{{Vite::asset('resources/plugins/select2/js/select2.full.min.js')}}"></script>
	
	<!-- Page specific script -->
	<script>
		$(function () {
		    //Initialize Select2 Elements
		    $('.select2').select2()

		    //Initialize Select2 Elements
		    $('.select2bs4').select2({
		      theme: 'bootstrap4'
		    })
		})
	</script>
@endsection