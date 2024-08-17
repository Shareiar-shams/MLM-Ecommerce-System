@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Digita Product
@endsection
@section('admin_css_content')
	<!-- DataTables -->
	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Digital Product Offer</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Digital Product Offer']);
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
    	<form action="{{route('productoffer.store')}}" method="post" accept-charset="utf-8">
    		{{csrf_field()}}
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
				                    <input type="text"  class="form-control" id="name" name="name" placeholder="Enter Name" required>
				                </div>

				                <div class="form-group col-md-4 col-sm-4">
					                <label>Offer For *</label>
					                <select class="form-control selected" id="offer_for" name="offer_for" style="width: 100%;" required>
					                    <option value="digitalproduct" selected="selected">Digital Product</option>
					                    <option value="ecommerceproduct">E-Commerce Product</option>
					                </select>
				                </div>
		                		<div class="form-group col-md-4 col-sm-4" id="offer_type">
					                <label>Offer Type</label>
					                <select class="form-control" name="offer_type" style="width: 100%;">
					                    <option value="normal" selected="selected">Normal Offer</option>
					                    <option value="special">Special Offer</option>
					                </select>
				                </div>
		                	</div>
		                </div>
		                <!-- /.card-body -->
		            </div>
		            <!-- /.card -->

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
		                		<div class="form-group col-md-3 col-sm-3">
				                    <label for="exampleInputEmail1">Percentage Rate *</label>
				                    <input type="text" class="form-control" id="offer_percentage" name="offer_percentage" placeholder="Enter Percentage for Offer" required>
				                </div>

				                <div class="form-group col-md-3 col-sm-3">
				                    <label for="exampleInputEmail1">User Percentage Rate</label>
				                    <input type="text" placeholder="Enter User Percentage From this offer" class="form-control" id="user_percentage" name="user_percentage">
				                </div>

				                <div class="form-group col-md-3 col-sm-3">
				                    <label for="exampleInputEmail1">Offer Last Date *</label>
				                    <input type="date"  class="form-control" id="last_date" name="last_date" required>
				                </div>

				                <div class="form-group col-md-3 col-sm-3">
					                <label>Status *</label>
					                <select class="form-control selected" name="status" style="width: 100%;" required>
					                    <option value="1" selected="selected">Publish</option>
					                    <option value="0">Unpublish</option>
					                </select>
				                </div>
		                	</div>
		                </div>
		                <!-- /.card-body -->
		                <div class="card-footer">
		                	<div class="card-footer">
			                  	<button type="submit" class="btn btn-primary">Save</button>
			                  	<button type="reset" class="btn btn-info">Reset</button>
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

        <div class="row">
          	<div class="col-12">
            	

            	<div class="card">
	              	<div class="card-header">
	                	<h3 class="card-title">Digital Product Offer List</h3>
	              	</div>
		            <!-- /.card-header -->
		            <div class="card-body">
		                <table id="example1" class="table table-bordered table-striped">
		                  	<thead>
				                  <tr>
				                    <th>Offer Name</th>
				                    <th>Offer For</th>
				                    <th>Offer Type</th>
				                    <th>Offer Product</th>
				                    <th>Offer Percentage</th>
				                    <th>Status</th>
				                    <th>Actions</th>
				                  </tr>
		                  	</thead>
		                  	<tbody>
		                  		@foreach($data as $item)
				                <tr>
			                    	<td>{{$item->name}}</td>
			                    	<td>{{$item->offer_for}}</td>
			                    	<td>{{$item->offer_type}}</td>
			                    	<td>
			                    		{{!isset($item->digital_product_id) ? 'Null' : $item->digitalProduct->name}}
			                    	</td>
			                    	<td>{{$item->offer_percentage}}%</td>
			                    	<td>
			                    		<div class="btn-group">
						                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">@if($item->status == 1) Publish @else Unpublish @endif 
						                    	<span class="sr-only">Toggle Dropdown</span>
						                    </button>
						                    <div class="dropdown-menu" role="menu">
						                    	<form action="{{route('offer.status',$item->id)}}" method="post" id="disable-form-{{$item->id}}" style="display: none;">
			                              			@csrf
			                              			@method('put')
			                              			<input type="hidden" name="status" value="@if($item->status == 1) 0 @else 1 @endif">
			                            		</form>
						                      	<a class="dropdown-item" href="#" onclick="
						                            if(confirm('Want to change this offer status!'))
						                            {
						                                event.preventDefault();
						                                document.getElementById('disable-form-{{$item->id}}').submit();
						                            }
						                            else
						                            {
						                                event.preventDefault();
						                            }
						                        ">@if($item->status == 1) Unpublish @else Publish @endif</a>
						                    </div>
						                </div>
			                    	</td>
			                    	<td>
			                    		<div class="btn-group">
						                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Options
						                      	<span class="sr-only">Toggle Dropdown</span>
						                    </button>
						                    <div class="dropdown-menu" role="menu">
						                      	<a class="dropdown-item" href="{{route('productoffer.edit',$item->id)}}"><i class="fas fa-angle-double-right"></i>Edit</a>
						                      	<a class="dropdown-item" href="{{route('productoffer.show',$item->id)}}"><i class="fas fa-angle-double-right"></i>Add Description</a>
						                      	<a class="dropdown-item" href="{{route('productoffer.digitalproduct',$item->id)}}"><i class="fas fa-angle-double-right"></i>Add Digital Product</a>
						                      	@if($item->offer_type == "special")
						                      	<a class="dropdown-item" href="{{route('productoffer.user',$item->id)}}"><i class="fas fa-angle-double-right"></i>Add MLM user</a>
						                      	@endif
						                      	<a class="dropdown-item" href="#" onclick="

			                            			if(confirm('Are you Want to Uproot this!'))

						                            {

						                                event.preventDefault();

						                                document.getElementById('delete-form-{{$item->id}}').submit();

						                            }

						                            else

						                            {

						                                event.preventDefault();

						                            }
						                        "><i class="fas fa-angle-double-right"></i>
						                    		{{ __('Delete') }}
						                    	</a>
						                      	<form action="{{route('productoffer.destroy',$item->id)}}" method="post" id="delete-form-{{$item->id}}" style="display: none;">
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

@section('admin_js_content')
	
	<!-- Page specific script -->
	<script>
		$('#offer_type').show();
		$(function() {
			$('#offer_for').on('change', function() {
				if(this.value === 'ecommerceproduct') {
				  	$('#offer_type').hide();
				}else{
					$('#offer_type').show();
				}
			});
		});

	</script>

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