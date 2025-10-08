@extends('layouts.administration.app')
@section('admin_title_content')
    AHVision | Products
@endsection
@section('admin_content_header')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Products') }}</h1>
    </div><!-- /.col -->
    <!-- breadcrumb -->
    <x-ad-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.home')],
        ['label' => 'Products', 'url' => route('admin.product.item.index')]
    ]" />
@endsection

@section('admin_vendor_css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}">
    
    @include('admin.additionalObject.datatable-css')
@endsection

@section('admin_page_css')
@endsection


@section('admin_main_content')
    @include('admin.validationError.error')
    <div class="container-fluid">
        <div class="row">
        	<div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Products') }}</h3>
                        <a href="{{ route('admin.product.item.create') }}" class="btn btn-primary btn-sm float-right">{{ __('Add New Product') }}</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
		            	<div class="col-md-12">
		            		<form action="{{ route('admin.product.item.index') }}" method="GET">
		                        <div class="row">
		                            <div class="col-3">
		                                <div class="form-group">
		                                    <label>Product Type :</label>
		                                    <select class="select2" name="productType" style="width: 100%;">
		                                        <option value="" selected>All Product</option>
		                                        <option value="physical">Physical Product</option>
		                                        <option value="affiliate">Affiliate Product</option>
		                                        <option value="customize">Customize Product</option>
		                                    </select>
		                                </div>
		                            </div>
		                            <div class="col-3">
		                                <div class="form-group">
		                                    <label>Tags:</label>
		                                    <select class="select2" name="is_type" style="width: 100%;">
		                                        <option value="" selected>All Tags</option>
		                                        @foreach($types as $type)
			                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
		                                        @endforeach
		                                    </select>
		                                </div>
		                            </div>
		                            <div class="col-3">
		                                <div class="form-group">
		                                    <label>Categories:</label>
		                                    <select class="select2" name="category" style="width: 100%;">
		                                        <option value="" selected>All Categories</option>
		                                        @foreach ($categories as $category)
									                <option value="{{ $category->id }}">{{ $category->name }}</option>
									            @endforeach
		                                    </select>
		                                </div>
		                            </div>
		                            <div class="col-3">
		                                <div class="form-group">
		                                    <label>Order By:</label>
		                                    <select class="select2" name="orderby" style="width: 100%;">
		                                        <option selected value="ASC">Ascending Order</option>
		                                        <option value="DESC">Descending Order</option>
		                                    </select>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <button type="submit" class="btn btn-primary">Filter Product</button>
		                        </div>
		                    </form>
	                    </div>
		                <table id="example1" class="table table-bordered table-striped">
		                  	<thead>
				                <tr>
				                    <th>No</th>
				                    <th>Image</th>
				                    <th>Name</th>
				                    <th>Price</th>
				                    <th>Status</th>
				                    <th>Type</th>
				                    <th>Item Type</th>
				                    <th>Action</th>
				                </tr>
		                  	</thead>
		                  	<tbody>
	                  		@foreach($products as $data)
				                <tr>
			                    	<td>{{$loop->index + 1}}</td>
			                    	<td>
			                    	@if (Str::startsWith($data->featured_image, 'https'))
	                                    <img class="img-responsive" width="50" height="70" src="{{$data->featured_image}}" alt="Product Image {{$data->id}}">
	                                @else
	                                    <img class="img-responsive" width="50" height="70" src="{{$data->avater}}" alt="Product Image {{$data->id}}">
	                                @endif
			                    	</td>
			                    	<td>{{$data->name}}</td>
			                    	<td>{{ isset($data->special_price) ? $data->special_price : $data->price}}</td>
			                    	
			                    	<td>
			                    		<div class="btn-group">
						                    <button type="button" @if($data->status == true) class="btn btn-success dropdown-toggle" @else class="btn btn-danger dropdown-toggle" @endif data-toggle="dropdown">@if($data->status == true) Publish @else Unpublish @endif 
						                    	<span class="sr-only">Toggle Dropdown</span>
						                    </button>
						                    <div class="dropdown-menu" role="menu">
						                    	<form action="{{route('admin.product.item.status',$data->id)}}" method="post" id="disable-form-{{$data->id}}" style="display: none;">
			                              			@csrf
			                              			@method('put')
			                              			<input type="hidden" name="status" value="@if($data->status == true) 0 @else 1 @endif">
			                            		</form>
						                      	<a class="dropdown-item" href="#" onclick="
						                            if(confirm('Want to change this type status!'))
						                            {
						                                event.preventDefault();
						                                document.getElementById('disable-form-{{$data->id}}').submit();
						                            }
						                            else
						                            {
						                                event.preventDefault();
						                            }
						                        ">@if($data->status == true) Unpublish @else Publish @endif</a>
						                    </div>
						                </div>
			                    	</td>
			                    	<td><label class="badge badge-primary">{{str_replace('Product', '', $data->type->name)}}</label></td>
			                    	<td>
			                    		@if($data->productType == 'physical')
			                    			Normal
			                    		@elseif($data->productType == 'affiliate')
			                    			Affiliate
			                    		@else
			                    			Customize
			                    		@endif
			                    	</td>
			                    	<td>
			                    		<div class="btn-group">
						                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Options
						                      	<span class="sr-only">Toggle Dropdown</span>
						                    </button>
						                    <div class="dropdown-menu" role="menu">
						                    		
                                                <a class="dropdown-item" href="{{route('admin.product.item.edit',$data->id)}}"><i class="fas fa-angle-double-right"></i>Edit</a>
                                                
                                                <a class="dropdown-item" href="" target="_blank">
                                                    <i class="fas fa-angle-double-right"></i> View
                                                </a>
                                                @if(!empty($data->productType) && $data->productType == "physical")
                                                    <a class="dropdown-item" href=""><i class="fas fa-angle-double-right"></i>Attributes</a>
                                                    <a class="dropdown-item" href=""><i class="fas fa-angle-double-right"></i>Attributes Options</a>
                                                    
                                                @elseif(!empty($data->productType) && $data->productType == "customize")
                                                    <a class="dropdown-item" href=""><i class="fas fa-angle-double-right"></i>Attributes</a>
                                                    <a class="dropdown-item" href=""><i class="fas fa-angle-double-right"></i>Attributes Options</a>

                                                    <a class="dropdown-item" href=""><i class="fas fa-angle-double-right"></i>External Design Options</a>

                                                @endif
						                      	<a class="dropdown-item" href="#" onclick="

			                            			if(confirm('Are you Want to Uproot this!'))
						                            {
						                                event.preventDefault();
						                                document.getElementById('delete-form-{{$data->id}}').submit();
						                            }
						                            else
						                            {
						                                event.preventDefault();
						                            }
						                        ">
                                                    <i class="fas fa-angle-double-right"></i>
                                                    {{ __('Delete') }}
                                                </a>
							                    <form action="{{route('admin.product.item.destroy',$data->id)}}" method="post" id="delete-form-{{$data->id}}" style="display: none;">
                                                    @csrf
                                                    @method('delete')
						                        </form>
						                    </div>
						                </div>
			                    	</td>
				                </tr>
				            @endforeach
		                  	</tbody>
		                </table>
		            </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
        	</div>
        	<!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    
@endsection

@section('admin_page_js')
    <!-- Select2 -->
    @include('admin.additionalObject.datatable-js')
    <!-- Select2 -->
	<script src="{{asset('admin/assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
		$(function () {
	      	$('.select2').select2()
	    });
	</script>
@endsection
