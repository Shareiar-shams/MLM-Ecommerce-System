@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Shipping
@endsection
@section('admin_css_content')
	
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Shipping']);
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
					<h5 class="m-0">Update Shipping</h5>
				</div>
				<a style="float: right;" href="{{route('shipping.index')}}" class="btn btn-primary" title=""><i class="fas fa-chevron-left"></i>Back</a>
			</div>
		</div>
    	<form action="{{route('shipping.update',$shipping->id)}}" method="post" accept-charset="utf-8">
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
			                    <input type="text"  class="form-control" id="title" name="title" value="{{$shipping->title}}" placeholder="Enter Title" required>
			                </div>
			                <div class="form-group">
			                    <label for="exampleInputEmail1">Cost *</label>
				                <div class="input-group">
				                    <div class="input-group-prepend">
					                    <span class="input-group-text">&#2547;</span>
					                </div>
				                    <input type="text" class="form-control" id="cost" name="cost" value="{{$shipping->cost}}" placeholder="Enter cost" required>
				                </div>
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
	
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" rossorigin="anonymous"></script>
	
@endsection