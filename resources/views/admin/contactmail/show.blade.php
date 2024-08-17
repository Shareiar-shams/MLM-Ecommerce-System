@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Mail List
@endsection
@section('admin_css_content')
	
	
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
			            <h3 class="card-title">Read Mail</h3>

			            {{-- <div class="card-tools">
			                <a href="#" class="btn btn-tool" title="Previous"><i class="fas fa-chevron-left"></i></a>
			                <a href="#" class="btn btn-tool" title="Next"><i class="fas fa-chevron-right"></i></a>
			            </div> --}}
		            </div>
		            <!-- /.card-header -->
		            <div class="card-body p-0">
			            <div class="mailbox-read-info">
			                <h5>{{$contact->subject}}</h5>
			                <h6>From: {{$contact->email}}
			                  <span class="mailbox-read-time float-right">{{$contact->created_at->diffForHumans()}}</span></h6>
			            </div>
			            <!-- /.mailbox-read-info -->
		              	<div class="mailbox-controls with-border text-center">
			                <div class="btn-group">
			                  	<form action="{{route('email.delete',$contact->id)}}" method="post" id="delete-form-{{$contact->id}}" style="display: none;">
	                              	@csrf
	                              	@method('delete')
	                            </form>
	                            <a href="" class="btn btn-default btn-sm" onclick="
	                            if(confirm('Are you Want to Uproot this!'))
	                            {
	                                event.preventDefault();
	                                document.getElementById('delete-form-{{$contact->id}}').submit();
	                            }
	                            else
	                            {
	                                event.preventDefault();
	                            }
	                            "><i class="far fa-trash-alt"></i></a>
			                </div>
		                
		              	</div>
		              	<!-- /.mailbox-controls -->
			            <div class="mailbox-read-message">
			                {!! $contact->message !!}
			            </div>
			            <!-- /.mailbox-read-message -->
		            </div>
		            
		            <!-- /.card-footer -->
		        </div>
		        <!-- /.card -->
	        </div>
	        <!-- /.col -->
	    </div>
      	<!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
@section('admin_js_content')
@endsection