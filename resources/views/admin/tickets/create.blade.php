@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Ticket Create
@endsection
@section('admin_css_content')
	<!-- summernote -->
  	<link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.min.css')}}">
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Create Ticket</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Ticket']);
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

	<form action="{{route('ticketStore')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		@csrf
    	<div class="row">
    	
          	<!-- left column -->
          	<div class="col-md-12 col-sm-12">
	            <!-- general form elements -->
	            <div class="card card-default">
	            	<div class="card-header">
	            		<h3>Add Ticket</h3>
			            {{-- <div class="card-tools">
			              <button type="button" class="btn btn-tool" data-card-widget="collapse">
			                <i class="fas fa-minus"></i>
			              </button>
			              
			            </div> --}}
			        </div>
			        <!-- /.card-header -->
	                <div class="card-body">
		                <div class="form-group">
		                    <label for="exampleInputEmail1">Title *</label>
		                    <input type="text"  class="form-control" name="title" placeholder="Enter Title" required>
		                </div>
		                <div class="form-group">
		                    <label for="exampleInputPassword1">Message *</label>
		                    <textarea class="form-control" name="message" placeholder="Enter Message" required></textarea>
		                </div>
	                </div>
	                <!-- /.card-body -->
	            </div>
	            <!-- /.card -->

	            <!-- general form elements -->
	            <div class="card card-default">
	                <div class="card-body">
		                <div class="form-group">
		                    <label>Labels *</label>
			                <select class="form-control select2bs4" name="labels" id="display_type" style="width: 100%;" required>
			                	@foreach($labels as $label)
			                    	<option value="{{$label->slug}}">{{$label->name}}</option>
			                    @endforeach
			                </select>
		                </div>
		                <div class="form-group">
		                    <label>Categories *</label>
			                <select class="form-control select2bs4" name="categories" id="display_type" style="width: 100%;" required>
			                	@foreach($categories as $category)
			                    	<option value="{{$category->slug}}">{{$category->name}}</option>
			                    @endforeach
			                </select>
		                </div>

		                <div class="form-group">
		                    <label>Priority *</label>
			                <select class="form-control select2bs4" name="priority" id="display_type" style="width: 100%;" required>
			                    <option value="High" selected="selected">High</option>
			                    <option value="Normal">Normal</option>
			                    <option value="Low">Low</option>
			                </select>
		                </div>
	                </div>
	                <!-- /.card-body -->
	            </div>
	            <!-- /.card -->

	            <!-- general form elements -->
	            <div class="card card-default">
	                <div class="card-body">
		                <div class="form-group">
		                    <label for="exampleInputFile">Attachment</label>
		                    <div class="input-group">
		                      <div class="custom-file">
		                        <input type="file" name ="attachment" class="custom-file-input" id="exampleInputFile">
		                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
		                      </div>
		                    </div>
		                </div>
		                <div class="alert alert-warning mb-0">
		                	<strong>Supported types :</strong> JPG, JPEG, PNG, PDF, GIF, DOCX, MP4, MOV, OGG, WEBM
		                </div>
	                </div>
	                <!-- /.card-body -->
	            </div>
	            <!-- /.card -->

	            <!-- general form elements -->
	            <div class="card card-default">
	            	<!-- /.card-body -->
	                <div class="card-footer">
	                  	<button type="submit" class="btn btn-info">Save</button>
	                  	<a href="{{route('ticket')}}" class="btn btn-default float-right">Cancel</a>
	                </div>
	                <!-- /.card-footer -->
	            </div>
	            <!-- /.card -->
	        </div>
	        <!--/.col (right) -->
    	</div>
    </form>
	        <!-- /.row -->
@endsection

@section('admin_js_content')
	<!-- Summernote -->
	<script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
	<!-- Page specific script -->
	
@endsection