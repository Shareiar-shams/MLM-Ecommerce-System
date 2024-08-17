@extends('user.dashboard.layouts')
@section('user_title_content')
    Ahknoxo | Weekly Sell Report
@endsection
@section('user_css_content')

	<!-- DataTables -->
  	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

@endsection

@section('dashboard_main_content')
	<div class="row row_section">
		<div class="card" style="width: 100%; margin-bottom: 5%;">
			<div class="card-header" style="display: revert; width: 100%;">
            	<h3 style="float: left;" class="card-title">Weekly Sells</h3>

          	</div>
          	<div class="card-body">
				<table id="example" class="table table-striped table-bordered" style="width:100%">
					<thead>
					    <tr>
						    <th class="th-sm">Name</th>
						    <th class="th-sm">Email</th>
						    <th class="th-sm">Phone</th>
						    <th class="th-sm">Status</th>
						    <th class="th-sm">Payment Status</th>
						    <th class="th-sm">Start date</th>
					      
					    </tr>
					</thead>
					<tbody>
						@if ($childrenLastSevenDays->count() > 0)
							@foreach ($totalSell as $child)
						    <tr>
						      <td>{{$child->user->name}}</td>
						      <td>{{$child->user->email}}</td>
						      <td>{{$child->user->phone}}</td>
						      <td>
						      	@if($child->admin_activation == 1 && $child->parent_activation == 1)
		                            	<label class="badge badge-success">Active</label>
		                            
		                        @elseif(isset($child->refferer_id) && $child->admin_activation == 0 && $child->parent_activation == 1)
		                        		<label class="badge badge-warning">Unautorize By Admin</label>
		                        @elseif(isset($child->refferer_id) && $child->admin_activation == 1 && $child->parent_activation == 0)
		                        		<label class="badge badge-warning">Unautorize By Parent</label>
		                        @elseif(isset($child->refferer_id) && $child->admin_activation == 0 && $child->parent_activation == 0)
		                        		<label class="badge badge-warning">Unautorize By Both</label>
		                        @elseif($child->admin_activation == 2)
		                        		<label class="badge badge-danger">Restricted User</label>
		                        @endif
						      </td>
						      <td>
						      	@if($child->transaction)
						      		<label class="badge badge-primary">Paid</label>
						      	@else
						      		<label class="badge badge-danger">Unpaid</label>
						      	@endif
						      </td>
						      <td>{{$child->created_at->isoFormat('D MMMM Y')}}</td>
						    </tr>
						    @endforeach
					    @endif
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