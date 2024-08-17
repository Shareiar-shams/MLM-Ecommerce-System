@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Update Role
@endsection
@section('admin_css_content')
	
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Update Role']);
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
					<h5 class="m-0">Update Role</h5>
				</div>
				<a style="float: right;" href="{{route('roles.index')}}" class="btn btn-primary" title=""><i class="fas fa-chevron-left"></i>Back</a>
			</div>
		</div>
    	<form action="{{route('roles.update',$role->id)}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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
					        	<label for="message-text" class="col-form-label">Name:*</label>
					        	<input type="text" class="form-control" name="name" id="recipient-name" placeholder="Type Name" value="{{$role->name}}" required>
					      	</div>
					      	

					      	<div class="form-group">
								<strong>Permission *</strong>
								<br/>

					            @foreach($permission as $value)
					            	<label>
									    <input type="checkbox" name="permission[]" value="{{ $value->name }}" class="name" {{ (in_array($value->id, $rolePermissions)) ? 'checked' : '' }}>
									    {{ $value->name }}
									</label>

					            <br/>

					            @endforeach
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

        	</div>
        </form>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('admin_js_content')
	
@endsection