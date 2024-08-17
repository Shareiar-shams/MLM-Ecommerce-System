@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Coupon
@endsection
@section('admin_css_content')
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Create Coupon</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Coupon']);
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
					<h5 class="m-0">Update Coupon</h5>
				</div>
				<a style="float: right;" href="{{route('code.index')}}" class="btn btn-primary" title=""><i class="fas fa-chevron-left"></i>Back</a>
			</div>
		</div>

    	<form action="{{route('code.update',$coupon->id)}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    		@csrf
    		{{method_field('PUT')}}
        	<div class="row">
        	
	          	<!-- left column -->
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
			                    <label for="exampleInputEmail1">Title *</label>
			                    <input type="text"  class="form-control" id="title" value="{{$coupon->title}}" name="title" placeholder="Enter Title" required>
			                </div>

			                <div class="form-group">
			                    <label for="exampleInputEmail1">Code *</label>
			                    <input type="text"  class="form-control" id="code" value="{{$coupon->code}}" name="code" placeholder="Enter Code" required>
			                </div>

			                <div class="from-group">
				            	<label for="exampleInputEmail1">Number of Times *</label>
				              	<input type="text"  class="form-control" id="number_of_times" value="{{$coupon->number_of_times}}" name="number_of_times" placeholder="Enter Number Of Times" required>
				            </div>

				            <div class="form-group">
                                <label for="discount">Discount *</label>
                                <div class="input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <select name="discount_type" class="form-control">
										    <option value="percentage" {{ $coupon->discount_type == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
										    <option value="amount" {{ $coupon->discount_type == 'amount' ? 'selected' : '' }}>Amount ($)</option>
										</select>
                                        </span>
                                    </div>
                                    <input type="number" style="height: 60px;" id="discount" name="discount" class="form-control" placeholder="Enter Discount" min="0" step="0.1" value="{{$coupon->discount}}">
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
		                  	<a href="{{route('code.index')}}" class="btn btn-default float-right">Cancel</a>
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
	<script type="text/javascript">
		$('#output').hide();

		var loadFile = function(event) {
			$('#output').show();
			var image = document.getElementById('output');
			image.src = URL.createObjectURL(event.target.files[0]);
		};
	</script>
@endsection