@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Permissions
@endsection
@section('admin_css_content')
	
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Create Permission</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Permission']);
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
    	<form action="{{route('permissions.store')}}" method="post" enctype="multipart/form-data">
          	@csrf
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
				        	<label for="message-text" class="col-form-label">Name:*</label>
				        	<input type="text" class="form-control" name="name" id="recipient-name" placeholder="Type Name" required>
				      	</div>

				      	{{-- <div class="form-group">
				        	<label for="message-text" class="col-form-label">Permission For:*</label>
				        	<input type="text" class="form-control" name="guard_name" id="recipient-name" placeholder="For" required>
				      	</div> --}}

	                </div>
	                <!-- /.card-body -->
                </div>
	            <!-- /.card -->
	            <!-- general form elements -->
	            <div class="card card-default">
	            	<!-- /.card-body -->
	                <div class="card-footer">
	                  	<button type="submit" class="btn btn-primary">Save</button>
	                  	<a href="{{route('permissions.index')}}" class="btn btn-default float-right">Back</a>
	                </div>
	                <!-- /.card-footer -->
	            </div>
	            <!-- /.card -->
	        </div>
        </form>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection

@section('admin_js_content')
	
@endsection