@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Roles
@endsection
@section('admin_css_content')
	
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Create Role</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Role']);
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
    	<form action="{{route('roles.store')}}" method="post" enctype="multipart/form-data">
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

				    	<div class="from-group">
				    		
			            	<strong>Permission *</strong>
			            	<br/>
			            	<label>
							  	<input type="checkbox" id="all_permission" name="all_permission" value="all_permission" class="name"> All permission
							</label>
			            	<br/>
			              	<div id="permission_checkboxes">
								@foreach($permission as $value)
								    <label>
								      <input type="checkbox" id="permissions_{{ $value->id }}" name="permission[]" value="{{ $value->name }}" class="name">
								      {{ $value->name }}
								    </label>
								    <br/>
								@endforeach
							</div>
		            	</div>
	                </div>
	                <!-- /.card-body -->
                </div>
	            <!-- /.card -->
	            <!-- general form elements -->
	            <div class="card card-default">
	            	<!-- /.card-body -->
	                <div class="card-footer">
	                  	<button type="submit" class="btn btn-primary">Save</button>
	                  	<a href="{{route('roles.index')}}" class="btn btn-default float-right">Back</a>
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
	<script>
		$(document).ready(function() {
		  $('#all_permission').on('click', function() {
		    if ($(this).is(':checked')) {
		      // Check all other permission checkboxes
		      $('#permission_checkboxes input[type="checkbox"]').prop('checked', true);
		    } else {
		      // Uncheck all other permission checkboxes
		      $('#permission_checkboxes input[type="checkbox"]').prop('checked', false);
		    }
		  });
		});
	</script>
@endsection