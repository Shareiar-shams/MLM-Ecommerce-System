@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Digita Product
@endsection
@section('admin_css_content')
	<!-- Select2 -->
  	<link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
  	<link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  	
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Add MLM User</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Add MLM User']);
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
    	<form action="{{route('productoffer.add.user',$data->id)}}" method="post" accept-charset="utf-8">
    		@csrf
			@method('put')
        	<div class="row">
        	
	          	<!-- left column -->
	          	<div class="col-md-12 col-sm-12">
		            
		            <!-- general form elements -->
		            <div class="card card-default">
		            	<div class="card-header">
		            		<div class="card-title">
		            			Add MLM User For This Offer
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
		                			<div class="form-group">
					                  	<label>MLM User</label>
						                <select class="select2bs4" multiple="multiple" data-placeholder="Select User Name" name="mlmUsers[]" style="width: 100%;">
						                	@foreach($users as $user)
							                    <option value="{{$user->id}}" @foreach($data->mlmUsers as $value){{$value->user_id == $user->id ? 'selected' : ''}} @endforeach>{{$user->user->username}}</option>
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
		                  		<button type="submit" class="btn btn-primary">Add</button>
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
	<script src="{{asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
	
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