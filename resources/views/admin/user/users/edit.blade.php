@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | System Users
@endsection
@section('admin_css_content')
	
  	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<style>
			
	    span.select2.select2-container.select2-container--classic{
	        width: 100% !important;
	    }
	</style>
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'System Users']);
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
					<h5 class="m-0">Update System Users</h5>
				</div>
				<a style="float: right;" href="{{route('admins.index')}}" class="btn btn-primary" title=""><i class="fas fa-chevron-left"></i>Back</a>
			</div>
		</div>
    	<form action="{{route('admins.update',$user->id)}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
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
					        	<input type="text" class="form-control" name="name" id="recipient-name" placeholder="Type Name" value="{{$user->name}}" required>
					      	</div>

					      	<div class="form-group">
					        	<label for="message-text" class="col-form-label">Email:*</label>
					        	<input type="email" class="form-control" name="email" id="recipient-name" placeholder="Type Email" value="{{$user->email}}" required>
					      	</div>

					      	<div class="form-group">
					        	<label for="message-text" class="col-form-label">Position:</label>
					        	<input type="text" class="form-control" name="position" id="recipient-name" value="{{$user->position}}" placeholder="Type Position">
					      	</div>

					      	<div class="form-group">
					        	<label for="message-text" class="col-form-label">Phone No*:</label>
					        	<input type="number" class="form-control" name="phone" id="recipient-name" value="{{$user->phone}}" placeholder="Type Phone" required>
					      	</div>

					      	{{-- <input type="hidden" name="image" value="noimage.jpg"> --}}
					      	<div class="form-group">
					        	<label for="message-text" class="col-form-label">Password:*</label>
					        	<input type="password" class="form-control" name="password" id="recipient-name" placeholder="Type Password [Example: admin@123User]">
					      	</div>

					      	<div class="form-group">
					        	<label for="message-text" class="col-form-label">Confirm Password:</label>
					        	<input type="password" class="form-control" name="c_password" placeholder="Retype Password">
					      	</div>

					      	<div class="form-group">
					      		<label for="">Roles</label>
	                            <select name="roles[]" class="js-example-basic-single-meta" multiple>
	                                <option value="">Select Role</option>
	                                @foreach ($roles as $role)
	                                <option
	                                    value="{{ $role }}"
	                                    {{ in_array($role, $userRoles) ? 'selected':'' }}
	                                >
	                                    {{ $role }}
	                                </option>
	                                @endforeach
	                            </select>
	                            @error('roles') <span class="text-danger">{{ $message }}</span> @enderror

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
	
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script type="text/javascript">

		$('.js-example-basic-single').select2({
	        theme: "classic",
	        tags: true
	    });

	    $('.js-example-basic-single-meta').select2({
	        theme: "classic",
	        tags: true
	    });

	</script>
@endsection