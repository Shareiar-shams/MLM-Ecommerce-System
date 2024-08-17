@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Send Email
@endsection
@section('admin_css_content')
  	
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Send Email</h1>
	</div><!-- /.col -->
	@php 
	  	$list = json_encode(['Home', 'Send Mail']);
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
    	<form action="{{route('subscriber_send_email_submit')}}" method="post" accept-charset="utf-8">
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
			                    <label for="exampleInputEmail1">Subject *</label>
			                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject" required>
			                </div>
			                <div class="from-group mt-3">
				            	<label for="exampleInputEmail1">Details *</label>
				              	<textarea class="form-control" name="message" placeholder="Enter Details" required></textarea>
				            </div>
		                </div>
		            </div>
		            <!-- /.card -->

		            <!-- general form elements -->
		            <div class="card card-default">
		            	<!-- /.card-body -->
		                <div class="card-footer">
		                  	<button type="submit" class="btn btn-primary">Send</button>
		                  	<a href="{{route('subscribers.list')}}" class="btn btn-default float-right">Back</a>
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