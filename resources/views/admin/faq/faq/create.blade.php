@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Faqs
@endsection
@section('admin_css_content')
	
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Create Faq</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Faq']);
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
    	<form action="{{route('faq.store')}}" method="post" accept-charset="utf-8">
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
			                    <input type="text"  class="form-control" id="title" name="title" placeholder="Enter title" required>
			                </div>

			                <div class="form-group">
				                <label>Select Category *</label>
				                <select class="form-control select2bs4" name="category_id" id="category" style="width: 100%;" required>
				                    <option value="" selected="selected">Select One</option>
				                    @foreach ($categories as $category)
							            <option value="{{ $category->id }}" {{ $category->id === old('category_id') ? 'selected' : '' }}>{{ $category->name }}</option>
									@endforeach
				                </select>
			                </div>
			                
			                <div class="from-group">
				            	<label for="exampleInputEmail1">Description *</label>
				              	<textarea class="form-control" name="description" placeholder="Text"></textarea>
				            </div>
		                </div>
		            </div>
		            <!-- /.card -->

		            <!-- general form elements -->
		            <div class="card card-default">
		            	<!-- /.card-body -->
		                <div class="card-footer">
		                  	<button type="submit" class="btn btn-primary">Save</button>
		                  	<a href="{{route('faq.index')}}" class="btn btn-default float-right">Back</a>
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