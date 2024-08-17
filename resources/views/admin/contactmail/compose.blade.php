@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Mail List
@endsection
@section('admin_css_content')
	<!-- summernote -->
  	<link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.min.css')}}">
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Email</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Email']);
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
	        <div class="col-md-3">
	            <a href="{{route('user.mail.list')}}" class="btn btn-primary btn-block mb-3">Back to Inbox</a>

	            <div class="card">
		            <div class="card-header">
		                <h3 class="card-title">Folders</h3>

		                <div class="card-tools">
		                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
		                    <i class="fas fa-minus"></i>
		                  </button>
		                </div>
		            </div>
	              	<div class="card-body p-0">
		                <ul class="nav nav-pills flex-column">
			                <li class="nav-item active">
			                    <a href="{{route('user.mail.list')}}" class="nav-link">
			                      <i class="fas fa-inbox"></i> Inbox
			                      {{-- <span class="badge bg-primary float-right">12</span> --}}
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a href="{{route('user.mail.sent.list')}}" class="nav-link">
			                      <i class="far fa-envelope"></i> Sent
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a href="#" class="nav-link">
			                      <i class="fas fa-filter"></i> Junk
			                      <span class="badge bg-warning float-right">65</span>
			                    </a>
			                </li>
			                <li class="nav-item">
			                    <a href="#" class="nav-link">
			                      <i class="far fa-trash-alt"></i> Trash
			                    </a>
			                </li>
		                </ul>
	              	</div>
	              	<!-- /.card-body -->
	            </div>
	            <!-- /.card -->
	        </div>
	        <!-- /.col -->
	        <div class="col-md-9">
	            <div class="card card-primary card-outline">
		            <div class="card-header">
		                <h3 class="card-title">Compose New Message</h3>
		            </div>
		            <form action="{{route('user.mail.send')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		            	@csrf
		            
			            <!-- /.card-header -->
			            <div class="card-body">
			                <div class="form-group">
			                  	<input class="form-control" name="to" placeholder="To:">
			                </div>
			                <div class="form-group">
			                  	<input class="form-control" name="subject" placeholder="Subject:">
			                </div>
			                <div class="form-group">
			                    <textarea id="compose-textarea" name="message" class="form-control" style="height: 300px">
			                      
			                    </textarea>
			                </div>
			                <div class="form-group">
				                <div class="btn btn-default btn-file">
				                    <i class="fas fa-paperclip"></i> Attachment
				                    <input type="file" name="attachment">
				                </div>
				                <p class="help-block">Max. 32MB</p>
			                </div>
			            </div>
			            <!-- /.card-body -->
			            <div class="card-footer">
			                <div class="float-right">
			                  	<button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
			                </div>
			                <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
			            </div>
			            <!-- /.card-footer -->
		            </form>
	            </div>
	            <!-- /.card -->
	        </div>
	        <!-- /.col -->
	    </div>
	</div>
@endsection
@section('admin_js_content')
	<!-- Summernote -->
	<script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
	<script>
		$(function () {
			//Add text editor
			$('#compose-textarea').summernote()
		})
	</script>
@endsection