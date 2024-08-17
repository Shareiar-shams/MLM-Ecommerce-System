@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Product
@endsection
@section('admin_css_content')
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Add Product</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Product']);
	@endphp
	<x-ad-breadcrumb :list="$list"/>
@endsection
@section('admin_main_content')

	<div class="card card-solid" style="height: 100%;">
		<div class="card-body pb-0">
			<div class="row">
		        <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch flex-column">
	              	<a href="{{route('physical.product.create')}}" class="card bg-light d-flex flex-fill" style="display: flex;justify-content: center; align-items: center; height: 250px;">
		                <div class="card-body pt-0">
		                	
		                    <div class="text-center py-3">
		                        <div class="d-inline-block" style="display: inline-block !important;">
		                            <div class="icon-big">
		                                <img src="{{asset('admin/dist/img/productp.png')}}" height="100" width="100" alt="" class="img-circle img-fluid">
		                            </div>
		                        </div>
                                <div class="d-block mt-3">
		                            <div class="numbers">
		                                <h2 class="card-title"><b>Add Physical Product</b></h2>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </a>
		        </div>
		        
		        <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch flex-column">
	              	<a href="{{route('affiliate.product.create')}}" class="card bg-light d-flex flex-fill" style="display: flex;justify-content: center; align-items: center; height: 250px;">
		                <div class="card-body pt-0">
		                    <div class="text-center py-3">
		                        <div class="d-inline-block">
		                            <div class="icon-big">
		                            	<img src="{{asset('admin/dist/img/affiliatetheme.svg')}}" height="100" width="100" alt="" class="img-circle img-fluid">
		                            </div>
		                        </div>
		                        <div class="d-block mt-3">
		                            <div class="numbers">
		                                <h2 class="card-title"><b>Add Affiliate Product</b></h2>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </a>
		        </div>

		        <div class="col-12 col-sm-6 col-md-6 d-flex align-items-stretch flex-column">
	              	<a href="{{route('customize.product.create')}}" class="card bg-light d-flex flex-fill" style="display: flex;justify-content: center; align-items: center; height: 250px;">
		                <div class="card-body pt-0">
		                	
		                    <div class="text-center py-3">
		                        <div class="d-inline-block" style="display: inline-block !important;">
		                            <div class="icon-big">
		                                <img src="{{asset('admin/dist/img/productp.png')}}" height="100" width="100" alt="" class="img-circle img-fluid">
		                            </div>
		                        </div>
                                <div class="d-block mt-3">
		                            <div class="numbers">
		                                <h2 class="card-title"><b>Add Customize Product</b></h2>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </a>
		        </div>
		    </div>
		</div>
    </div>
@endsection

@section('admin_js_content')
@endsection