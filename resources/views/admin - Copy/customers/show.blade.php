@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Customers List
@endsection
@section('admin_css_content')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{Vite::asset('resources/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{Vite::asset('resources/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{Vite::asset('resources/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Customers Details</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Customers List']);
	@endphp
	<x-ad-breadcrumb :list="$list"/>
@endsection

@section('admin_main_content')
	<div class="container-fluid">
      <div class="row">
        	<div class="col-12">
        		<!-- general form elements disabled -->
            <div class="card card-info">
	            
              	<div class="card-body">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" value="{{$data->name}}" disabled>
                    </div>

                    <div class="form-group">
                        <label>User Name:</label>
                        <input type="text" class="form-control" value="{{$data->username}}" disabled>
                    </div>

                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" value="{{$data->email}}" disabled>
                    </div>

                    <div class="form-group">
                        <label>Phone:</label>
                        <input type="email" class="form-control" value="{{$data->phone}}" disabled>
                    </div>

                    <div class="form-group">
                        <label>Status:</label>
                        <button class="btn @if($data->status == 1) btn-primary @else btn-warning @endif">@if($data->status == 1) Active @else Inactive @endif</button>
                    </div>


                    <div class="form-group">
		                  <label>Join Date:</label>
		                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
		                        <input type="text" class="form-control datetimepicker-input" value="{{ $data->created_at->diffForHumans() }}" data-target="#reservationdate" disabled>
		                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
		                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
		                        </div>
		                    </div>
		            </div>

              	</div>
              	<!-- /.card-body -->

              	<div class="card-footer">
                  <a href="{{route('customers.list')}}" class="btn btn-info">Back</a>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        	</div>
      </div>
  </div>
@endsection

@section('admin_js_content')
@endsection