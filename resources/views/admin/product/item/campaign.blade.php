@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Product
@endsection
@section('admin_css_content')
	<!-- DataTables -->
	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Campaign Offer</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Campaign Offer']);
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
    	<form action="{{ isset($campaign) ? route('productoffer.update',$campaign->id) : route('productoffer.store') }}" method="post" accept-charset="utf-8">
    		@csrf
    		@if(isset($campaign))
			@method('put')
			@endif
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
		                	<div class="row">
				                <div class="form-group col-md-4 col-sm-4">
				                    <label for="exampleInputEmail1">Name *</label>
				                    <input type="text"  class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ isset($campaign) ? $campaign->name : null}}" required>
				                </div>

				                <input type="hidden" name="offer_for" value="ecommerceproduct">
				                
				                <div class="form-group col-md-4 col-sm-4">
				                    <label for="exampleInputEmail1">Campaign Last Date Time *</label>
				                    <input type="date" value="{{ isset($campaign) ? \Illuminate\Support\Carbon::parse($campaign->last_date)->format("Y-m-d") : null }}" class="form-control" id="last_date" name="last_date" required>
				                </div>

				                <div class="form-group col-md-4 col-sm-4">
					                <label>Status *</label>
					                <select class="form-control" name="status" style="width: 100%;" required>
					                	@if(isset($campaign))
					                    <option value="1" {{$campaign->status == "1"  ? 'selected' : ''}}>Publish</option>
					                    <option value="0" {{$campaign->status == "0" ? 'selected' : ''}}>Unpublish</option>
					                    @else
					                    <option value="1" selected>Publish</option>
					                    <option value="0">Unpublish</option>
					                    @endif
					                </select>
				                </div>
		                	</div>
		                </div>
		                <!-- /.card-body -->
		                <div class="card-footer">
		                	<div class="card-footer">
			                  	<button type="submit" class="btn btn-primary">Save</button>
			                </div>
		                </div>
		                <!-- /.card-footer -->
		            </div>
		            <!-- /.card -->

		            

	          	</div>
	          	<!--/.col (left) -->
        	</div>
	        <!-- /.row -->
        </form>

        @if(!empty($campaign) && $campaign->status != false)
    	<div class="row">
    	
          	<!-- left column -->
          	<div class="col-md-12 col-sm-12">
	            <form action="{{route('product.add.campaign.offer',$campaign->id)}}" method="post" accept-charset="utf-8">
		    		@csrf
					@method('put')
		            <!-- general form elements -->
		            <div class="card card-default">
		                <div class="card-body">
		                	<div class="row">
		                		<div class="col-md-12 col-sm-12">
			                		<div class="form-group ">
					                  	<label>Product Added for Campaign</label>
						                <select class="form-control select2" name="product_id" style="width: 100%;">
						                	<option value="" selected>Select Product</option>}
						                	option
						                	@foreach($products as $product)
						                    	<option value="{{$product->id}}">{{$product->name}}</option>
						                    @endforeach
						                </select>
					                </div>
					                <!-- /.form-group -->
					            </div>
		                	</div>
		                </div>
		                <!-- /.card-body -->
		                <div class="card-footer">
		                	<div class="card-footer">
		                  		<button type="submit" class="btn btn-primary">Add to Campaign</button>
			                </div>
		                </div>
		                <!-- /.card-footer -->
		            </div>
		            <!-- /.card -->
		        </form>
	            <div class="card">
		            <!-- /.card-header -->
		            <div class="card-body">
		                <table id="example1" class="table table-bordered table-striped">
		                  	<thead>
				                <tr>
				                    <th>Image</th>
				                    <th>Name</th>
				                    <th>Price</th>
				                    <th>Status</th>
				                    <th>Actions</th>
				                </tr>
		                  	</thead>
		                  	<tbody>
		                  		@foreach($campaign->products as $item)
				                <tr>
				                	<td><img class="img-responsive" width="50" height="70" src="{{Storage::disk('local')->url($item->featured_image)}}" alt="Product Image {{$item->id}}"></td>
			                    	<td>{{$item->name}}</td>
			                    	<td>{{ isset($item->special_price) ? $item->special_price : $item->price}}</td>

			                    	<td align="center">
			                    		<div class="btn-group">
						                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">@if($item->pivot->status == 1) Publish @else Unpublish @endif 
						                    	<span class="sr-only">Toggle Dropdown</span>
						                    </button>
						                    <div class="dropdown-menu" role="menu">
						                    	<form action="{{route('product.campaign.status',$item->pivot->id)}}" method="post" id="disable-form-{{$item->pivot->id}}" style="display: none;">
			                              			@csrf
			                              			@method('put')
			                              			<input type="hidden" name="status" value="@if($item->pivot->status == true) 0 @else 1 @endif">
			                            		</form>
						                      	<a class="dropdown-item" href="#" onclick="
						                            if(confirm('Want to change status!'))
						                            {
						                                event.preventDefault();
						                                document.getElementById('disable-form-{{$item->pivot->id}}').submit();
						                            }
						                            else
						                            {
						                                event.preventDefault();
						                            }
						                        ">@if($item->pivot->status == 1) Unpublish @else Publish @endif</a>
						                    </div>
						                </div>
			                    	</td>
			                    	<td align="center">
			                            <form action="{{route('product.campaign.delete',$item->pivot->id)}}" method="post" id="delete-form-{{$item->pivot->id}}" style="display: none;">
			                              {{csrf_field()}}
			                              {{method_field('DELETE')}}
			                            </form>
			                            <a href="" class="btn btn-danger btn-sm" style=" font-size: 18px;" onclick="
			                            if(confirm('Are you Want to Uproot this!'))
			                            {
			                                event.preventDefault();
			                                document.getElementById('delete-form-{{$item->pivot->id}}').submit();
			                            }
			                            else
			                            {
			                                event.preventDefault();
			                            }
			                            "><i class="fas fa-trash-alt"></i></a>
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
          	<!--/.col (left) -->
    	</div>
        <!-- /.row -->
        @endif
        
        
    </div><!-- /.container-fluid -->
@endsection

@section('admin_js_content')

	<!-- DataTables  & Plugins -->
	<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{asset('admin/plugins/jszip/jszip.min.js')}}"></script>
	<script src="{{asset('admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
	<script src="{{asset('admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
	<!-- Page specific script -->
	<script>
		$(function () {
		    $("#example1").DataTable({
		      	"responsive": true, "lengthChange": false, "autoWidth": false,
		      	"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		    
		});
	</script>
@endsection