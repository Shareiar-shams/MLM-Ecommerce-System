@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Show Role
@endsection
@section('admin_css_content')
	
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Show Role']);
	@endphp
	<x-ad-breadcrumb :list="$list"/>
@endsection

@section('admin_main_content')
	
	<div class="container-fluid">
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					<h5 class="m-0">Show Role</h5>
				</div>
				<a style="float: right;" href="{{route('roles.index')}}" class="btn btn-primary" title=""><i class="fas fa-chevron-left"></i>Back</a>
			</div>
		</div>
		<div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>
		            {{ $role->name }}
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Permissions:</strong>
		            @if(!empty($rolePermissions))
		                @foreach($rolePermissions as $v)
		                    <label class="label label-success">{{ $v->name }},</label>
		                @endforeach
		            @endif
		        </div>
		    </div>
		</div>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('admin_js_content')
	
@endsection