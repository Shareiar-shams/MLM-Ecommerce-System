@extends('user.dashboard.layouts')
@section('user_title_content')
    Ahknoxo | Orders
@endsection
@section('user_css_content')
	<!-- DataTables -->
  	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('dashboard_main_content')
   <div class="row row_section">
   		@if ($errors->any())                 
			@foreach ($errors->all() as $error)
				<div class="alert alert-danger alert-block">
			        <a type="button" class="close" data-dismiss="alert"></a> 
			        <strong>{{ $error }}</strong>
			    </div>
			@endforeach						                   
		@endif
         <div class="card" style="width: 100%; margin-bottom: 5%;">
			<div class="card-header" style="display: revert; width: 100%;">
            	<h3 style="float: left;" class="card-title">Orders</h3>

          	</div>
          	<div class="card-body">
			    <table id="example" class="table table-striped table-bordered" style="width:100%">
					<thead>
					    <tr>
					    	<th></th>
		                    <th>Tracking ID</th>
		                    <th>Total Amount</th>
		                    <th>Payment Status</th>
		                    <th>Order Status</th>
		                    <th>Action</th>
					    </tr>
					</thead>
					<tbody>
						@forelse ($orders as $order)
					    <tr>
					      	<td> {{$loop->index+1}}</td>
	                    	<td>{{$order->tracking_id}}</td>
	                    	<td>{{$order->total}}</td>
					      	<td>
					      		@if($order->payment_status == 'Paid')
	                        		<span class="badge badge-primary">Paid</span>
	                        	@else
	                        		<span class="badge badge-danger">Unpaid</span>
	                        	@endif
	                    	</td>
	                    	
	                    	<td>
			                	@if($order->order_status == 'Pending')
	                        		<span class="badge badge-primary">Pending</span>
	                        	@elseif($order->order_status == 'Processing_Order')
	                        		<span class="badge badge-secondary">Processing</span>
	                        	@elseif($order->order_status == 'Delivery_in_progess')
	                        		<span class="badge badge-success">Delivered</span>
	                        	@elseif($order->order_status == 'Canceled')
	                        		<span class="badge badge-danger">Canceled</span>
	                        	@else
	                        		<span class="badge badge-dark">Returned</span>
	                        	@endif
	                    	</td>
						    <td>
						    	<a href="{{route('order_details',$order->id)}}" class="btn btn-info btn-sm" style="background: gray;">Details</a>
						    </td>
					    </tr>
					    @empty
					    	<td colspan="5" rowspan="" headers="">No Orders available</td>
					    @endforelse
					</tbody>
				  
				</table>
			</div>
		</div>
   
    </div>
@endsection
@section('user_js_content')
	<!-- DataTables  & Plugins -->
	<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>

	<script>
		$(function () {
		    $("#example").DataTable({
		      	"responsive": true, "lengthChange": false, "autoWidth": false,
		      	"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		    
		});
	</script>
@endsection