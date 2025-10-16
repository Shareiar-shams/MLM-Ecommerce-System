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
		            		@include('admin.product.item.partials_.filter')
	                    </div>
		                <table id="example1" class="table table-bordered table-striped">
		                  	<thead>
				                <tr>
				                    <th>Serial</th>
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
	                  		@foreach($products as $key => $data)
				                <tr>
			                    	<td>{{serial($data, $key)}}</td>
			                    	<td>
			                    	@if (Str::startsWith($data->featured_image, 'https'))
	                                    <img class="img-responsive" width="50" height="70" src="{{$data->featured_image}}" alt="Product Image {{$data->id}}">
	                                @else
	                                    <img class="img-responsive" width="50" height="70" src="{{$data->feature_image}}" alt="Product Image {{$data->id}}">
	                                @endif
			                    	</td>
			                    	<td>{{$data->name}}</td>
			                    	<td>{{ isset($data->special_price) ? $data->special_price : $data->price}}</td>
			                    	
									<td>
										<div class="btn-group">
											<button type="button" class="btn {{$data->status == true ? 'btn-success' : 'btn-danger'}} dropdown-toggle" data-toggle="dropdown">@if($data->status == true) Publish @else Unpublish @endif 
												<span class="sr-only">Toggle Dropdown</span>
											</button>
											<div class="dropdown-menu" role="menu">
												<form action="{{route('admin.product.item.status',$data->id)}}" method="post" id="disable-form-product-status-{{$data->id}}" style="display: none;">
													@csrf
													@method('put')
													<input type="hidden" name="status" value="@if($data->status == true) 0 @else 1 @endif">
												</form>
												<a class="dropdown-item" href="#"
													onclick="confirmStatusChange('disable-form-product-status-{{ $data->id }}', '{{ $data->status ? 'unpublish' : 'publish' }} this product.')">
													{{ $data->status ? 'Unpublish' : 'Publish' }}
												</a>
											</div>
										</div>
									</td>
			                    	<td><label class="badge badge-primary">{{str_replace('Product', '', $data->type->name)}}</label></td>
			                    	<td>
			                    		@if($data->product_type == 'physical')
			                    			Normal
			                    		@elseif($data->product_type == 'affiliate')
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
						                    		
                                                <a class="dropdown-item" href="{{route('admin.product.item.edit',['product' => $data])}}"><i class="fas fa-angle-double-right"></i>Edit</a>
                                                
                                                <a class="dropdown-item" href="{{route('admin.product.item.show',['product' => $data])}}" target="_blank">
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
						                      	<a class="dropdown-item text-danger" href="#"
												onclick="event.preventDefault(); confirmDelete('delete-form-product-item-{{ $data->id }}')">
													<i class="fas fa-trash-alt"></i> Delete
												</a>

												<form id="delete-form-product-item-{{ $data->id }}" 
													action="{{ route('admin.product.item.destroy', $data->id) }}" 
													method="POST" style="display:none;">
													@csrf
													@method('DELETE')
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
