@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Faqs
@endsection
@section('admin_css_content')
	
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		
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
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					<h5 class="m-0">Update Faq</h5>
				</div>
				<a style="float: right;" href="{{route('faq.index')}}" class="btn btn-primary" title=""><i class="fas fa-chevron-left"></i>Back</a>
			</div>
		</div>
    	<form action="{{route('faq.update',$faq->id)}}" method="post" accept-charset="utf-8">
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
			                    <input type="text"  class="form-control" name="title" value="{{$faq->title}}" placeholder="Enter Title" required>
			                </div>
			                <div class="form-group">
				                <label>Select Category *</label>
				                <select class="form-control select2bs4" name="category_id" id="category" style="width: 100%;" required>
				                	<option value="" selected="selected">Select One</option>
				                    @foreach ($categories as $category)
							            <option value="{{ $category->id }}" {{ $category->id === $faq->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
									@endforeach
				                </select>
			                </div>
			                <div class="from-group">
				            	<label for="exampleInputEmail1">Description *</label>
				              	<textarea class="form-control" name="description" placeholder="Text">{{$faq->description}}</textarea>
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
@endsection