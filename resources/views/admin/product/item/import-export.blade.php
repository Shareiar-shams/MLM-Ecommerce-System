@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Bulk Product
@endsection
@section('admin_css_content')
	
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Product']);
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
	                	<h3 class="card-title">Product CSV Import & Export</h3>

	                	<div class="right-content" style="float: right;">
		                	<a href="{{route('item.index')}}" class="btn btn-primary" title=""><i class="fas fa-chevron-left"></i>Go Item</a>
	                	</div>
	              	</div>
	            </div>
	        </div>
		</div>
    	<form action="{{route('product.import')}}" method="post" enctype="multipart/form-data">
    		@csrf
        	<div class="row">

	          	<!-- left column -->
	          	<div class="col-md-12 col-sm-12">
		            <!-- general form elements -->
		            <div class="card card-default">
		            	<div class="container">
                            <div class="col-lg-12 mt-3">
                                <div class="text-left">
                                    <a class="btn btn-primary btn-sm" href="{{route('product.export')}}">Products CSV Export</a>
                                </div>
                                <div class="text-right">
                                    <a class="btn btn-info btn-sm" href="{{asset('asset/test.csv')}}" download>Simple Csv Download</a>
                                </div>
                            </div>
                        </div>
				        <!-- /.card-header -->
		                <div class="card-body">
		                	

			                <div class="row justify-content-center">
	                            <div class="col-lg-6">
	                                <div class="input-group position-relative ">
					                    <div class="custom-file">
					                        <input type="file" accept="csv" name="csv" class="custom-file-input" id="file" required>
					                        <label class="custom-file-label" for="exampleInputFile">Uplaod Your CSV File</label>
					                    </div>
				                    </div> 

	                                <div class="form-group d-flex justify-content-center mt-3">
			                            <button type="submit" class="btn btn-primary ">Submit</button>
			                        </div>
	                            </div>
	                        </div>

			                
		                </div>
		                <!-- /.card-body -->
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