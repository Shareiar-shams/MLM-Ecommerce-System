@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Orders
@endsection
@section('admin_css_content')
  	<!-- DataTables -->
  	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  	<!-- daterange picker -->
	<link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}">

	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="{{asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">

	
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Orders</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Orders']);
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
		<form action="{{route('orders.type', $type)}}" method="GET">
			@csrf
			@method('get')
	        <div class="row mb-4 justify-content-center">
	            <div class="col-md-6 col-sm-6 col-lg-4">
	            	<div class="form-group">
	                  	<label>Start Date *</label>
	                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
	                        <input type="text" name="start_date" class="form-control datetimepicker-input" data-target="#reservationdate" placeholder="Start Date" value="" />
	                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
	                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-6 col-sm-6 col-lg-4">
	            	<div class="form-group">
	                  	<label>End Date *</label>
	                    <div class="input-group date" id="reservationdate2" data-target-input="nearest">
	                        <input type="text" name="end_date" class="form-control datetimepicker-input" data-target="#reservationdate2" placeholder="End Date" value="" />
	                        <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
	                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-lg-12 text-center mt-3">
	                <button type="submit" class="btn btn-success py-1 mr-2">Filter</button>
	                <button type="reset" class="btn btn-info py-1">Reset</button>
	            </div>
	        </div>
	    </form>
      	<div class="row">
        	<div class="col-12">
          	

	          	<div class="card">
	              	<div class="card-header">
	                	<h3 class="card-title">Orders</h3>
	              	</div>
		            <!-- /.card-header -->
		            <div class="card-body">
		                <table id="example1" class="table table-bordered table-striped">
		                  	<thead>
				                <tr>
				                	<th></th>
				                    <th>Tracking ID</th>
				                    <th>User</th>
				                    <th>Total Amount</th>
				                    <th>Payment Status</th>
				                    <th>Order Status</th>
				                    <th>Action</th>
				                </tr>
		                  	</thead>
		                  	<tbody>
		                  		@forelse($orders as $order)
					                <tr>
					                	<td> {{$loop->index+1}}</td>
				                    	<td>{{$order->tracking_id}}</td>
				                    	<td>{{$order->user->name}}</td>
				                    	<td>{{$order->total}}</td>
				                    	
				                    	<td>
			                    			<div class="btn-group">
							                    <button type="button" @if($order->payment_status == 'Paid') class="btn btn-success dropdown-toggle" @else class="btn btn-danger dropdown-toggle" @endif data-toggle="dropdown">@if($order->payment_status == 'Paid') Paid @else Unpaid @endif 
							                    	<span class="sr-only">Toggle Dropdown</span>
							                    </button>
							                    <div class="dropdown-menu" role="menu">
								                    <form action="{{route('orders.payment_status',$order->id)}}" method="post" id="disable-form-{{$order->id}}" style="display: none;">
			                              				@csrf
			                              				@method('put')
			                              				<input type="hidden" name="payment_status" value="@if($order->payment_status == 'Paid') Unpaid @else Paid @endif">
					                            	</form>
							                      	<a class="dropdown-item" href="#" onclick="
							                            if(confirm('Want to change this order payment status!'))
							                            {
							                                event.preventDefault();
							                                document.getElementById('disable-form-{{$order->id}}').submit();
							                            }
							                            else
							                            {
							                                event.preventDefault();
							                            }
							                        ">@if($order->payment_status == 'Paid') Unpaid @else Paid @endif</a>
							                    </div>
						                	</div>
				                    	</td>
				                    	
				                    	<td>
						                	<div class="btn btn-info dropdown">
									            <button class="btn {{ $order->order_status }}  btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									              	{{$order->order_status}}
									            </button>
									            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
									              <a class="dropdown-item" id="update-status-link" data-toggle="modal" data-target="#statusModal" href="javascript:;" data-href="{{route('orders.type_status',['id' => $order->id, 'type' => 'Pending'])}}">Pending</a>
									              <a class="dropdown-item" id="update-status-link" data-toggle="modal" data-target="#statusModal" href="javascript:;" data-href="{{route('orders.type_status',['id' => $order->id, 'type' => 'Processing_Order'])}}">In Progress</a>
									              <a class="dropdown-item" id="update-status-link" data-toggle="modal" data-target="#statusModal" href="javascript:;" data-href="{{route('orders.type_status',['id' => $order->id, 'type' => 'Delivery_in_progess'])}}">Delivered</a>
									              <a class="dropdown-item" id="update-status-link" data-toggle="modal" data-target="#statusModal" href="javascript:;" data-href="{{route('orders.type_status',['id' => $order->id, 'type' => 'Canceled'])}}">Canceled</a>
									            </div>
									        </div>
				                    	</td>

				                    	<td>
				                    		<div class="btn-group">
							                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Options
							                      	<span class="sr-only">Toggle Dropdown</span>
							                    </button>
							                    <div class="dropdown-menu" role="menu">
							                    	<a class="dropdown-item" href="{{route('orders.show',$order->id)}}"><i class="fas fa-angle-double-right"></i>View Order</a>
							                    		
							                      	<a class="dropdown-item" href="#" onclick="

				                            			if(confirm('Are you Want to Uproot this!'))

							                            {

							                                event.preventDefault();

							                                document.getElementById('delete-form-{{$order->id}}').submit();

							                            }

							                            else

							                            {

							                                event.preventDefault();

							                            }
								                        "><i class="fas fa-angle-double-right"></i>
								                    	{{ __('Delete') }}
								                    </a>
								                    <form action="{{route('orders.destroy',$order->id)}}" method="post" id="delete-form-{{$order->id}}" style="display: none;">
								                      	@csrf
														@method('delete')
							                        </form>
							                    </div>
							               	</div>
				                    	</td>
					                </tr>
				                @empty
				                	
				                @endforelse
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

      	<div class="modal fade show" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalModalLabel">
		    <div class="modal-dialog" role="document">
			    <div class="modal-content">

					<!-- Modal Header -->
			        <div class="modal-header">
			          	<h5 class="modal-title" id="exampleModalLabel">Update Status?</h5>
			          	<button class="close" type="button" data-dismiss="modal" aria-label="Close">
			            	<span aria-hidden="true">×</span>
			          	</button>
					</div>

					<!-- Modal Body -->
			        <div class="modal-body" id="model-body">
						You are going to update the status. Do you want proceed?
					</div>

					<!-- Modal footer -->
			        <div class="modal-footer">
			            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			            <a href="" id="link" class="btn btn-ok btn-success">Update</a>
					</div>

			    </div>
		    </div>
		</div>
  	</div>
  <!-- /.container-fluid -->
@endsection

@section('admin_js_content')

	<script>
		// Add an event listener to all elements with the class "update-status-link"
		const updateStatusLinks = document.querySelectorAll('#update-status-link');

		updateStatusLinks.forEach(link => {
		    link.addEventListener('click', function(event) {
		        event.preventDefault(); // Prevent default form submission

		        const modalUpdateLink = document.querySelector('#link');
		        modalUpdateLink.href = this.dataset.href; // Add type parameter

		        // Optionally, you can display the selected status in the modal body
		        const modalBody = document.querySelector('#model-body');
		        modalBody.textContent = `Are you sure you want to update the order status to "${this.textContent}"?`;
		    });
		});
	</script>

	<!-- InputMask -->
	<script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>
	<!-- date-range-picker -->
	<script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>

	<!-- Tempusdominus Bootstrap 4 -->
	<script src="{{asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>


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
	<!-- page specific script -->
	<script>
		//Date picker
	    $('#reservationdate').datetimepicker({
	        format: 'L'
	    });

	    //Date picker
	    $('#reservationdate2').datetimepicker({
	        format: 'L'
	    });

		$(function () {
		    $("#example1").DataTable({
		      	"responsive": true, "lengthChange": false, "autoWidth": false,
		      	"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		    
		});
	</script>
@endsection