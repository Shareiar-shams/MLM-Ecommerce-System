@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Pay User
@endsection
@section('admin_css_content')
  
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Pay User</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Pay User']);
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
        	<div class="col-12">
        		<!-- general form elements disabled -->
	            <div class="card card-info">
		            <div class="card-header">
		            	Pay to User
		            </div>
		            <form action="{{ route('transections.update',$data->id) }}" method="post">
		            	@csrf
		            	@method('put')
		                <div class="card-body">
		                	@php
		                		if(isset($mlmuser->others_documents)){

			                		$json_data = json_decode($mlmuser->others_documents);
			                		$gateway_type = $json_data->payment_gatway_type;
			                		$account_number = $json_data->number;
			                		$account_type = $json_data->type;
		                		}

		                	@endphp
		                	<p><strong>User Name: </strong>{{$data->user->name}}</p>
		              		<p><strong>Pay to(Creditor): </strong>{{$mlmuser->user->name}}</p>
		              		<p><strong>Creditor Phone Number: </strong>{{$mlmuser->user->phone}}</p>
		              		<p><strong>Creditor Email: </strong>{{$mlmuser->user->email}}</p>
		              		<p><strong>Relation between User and Creditor:</strong> Parent User</p>
		              		@if(isset($mlmuser->others_documents))
		              			<p><strong>Creditor Bank Type: </strong>{{$gateway_type}}</p>
		              			<p><strong>Creditor Account Phone: </strong>{{$account_number}}</p>
		              			<p><strong>Creditor Account Type: </strong>{{$account_type}}</p>
		              		@else
		              			<p><strong>Creditor Bank Type: </strong>Creditors do not yet provide banking-related information.</p>
		              			<p><strong>Creditor Account Phone: </strong>Creditors do not yet provide banking-related information.</p>
		              			<p><strong>Creditor Account Type: </strong>Creditors do not yet provide banking-related information.</p>
		              		@endif
		              		<p><strong>Amount: </strong><small>{{$data->amount}}</small></p>
		              		<p><strong>Pay By: </strong><small>Admin</small></p>
			                <div class="form-group">
			                    <label for="exampleInputTransection">Transection Number</label>
			                    <input type="text" name="transaction_number" class="form-control" id="exampleInputTransection" placeholder="Enter Transection Number">
			                </div>
			                <div class="form-group">
		                        <label>Select</label>
		                        <select class="form-control" name="payment_type">
		                          	<option value="Bkash">Bkash</option>
		                          	<option value="nagad">Nagad</option>
		                          	<option value="rocket">Rocket</option>
		                        </select>
		                    </div>
		                </div>
		                <!-- /.card-body -->

		                <div class="card-footer">
		                  	<button type="submit" class="btn btn-primary">Submit</button>
		                   	<a href="{{route('transections.index')}}" class="btn btn-info">Back</a>
		                </div>
		            </form>
	            </div>
	            <!-- /.card -->
        	</div>
      	</div>
  	</div>
@endsection

@section('admin_js_content')
@endsection