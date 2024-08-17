@extends('user.dashboard.layouts')
@section('user_title_content')
    Ahknoxo | Ticket
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
            	<h3 style="float: left;" class="card-title">All Tickets</h3>

            	<a href="{{route('ticketCreate')}}" class="btn btn-info" style="float: right;" title="">Add New</a>
          	</div>
          	<div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  	<thead>
		                <tr>
		                    <th>No</th>
		                    <th>Title</th>
		                    <th>Status</th>
		                    <th>Last message</th>
		                    <th>Action</th>
		                </tr>
                  	</thead>
                  	<tbody>
                  		@foreach($tickets as $data)
		                <tr>
	                    	<td>{{$loop->index + 1}}</td>
	                    	<td>{{$data->title}}</td>
	                    	<td>{{$data->status}}</td>
	                    	<td>{{ optional($data->messages->last())->message }}</td>
	                    	
	                    	<td>
	                    		<div class="btn-group">
				                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Options
				                      	<span class="sr-only">Toggle Dropdown</span>
				                    </button>
				                    <div class="dropdown-menu" role="menu">

				                      	<a class="dropdown-item" href="{{route('tickets.show',$data->uuid)}}"><i class="fa fa-angle-double-right"></i>Show</a>
				                      	
				                    </div>
				                </div>
	                    	</td>
		                </tr>
		                @endforeach
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
		    $("#example1").DataTable({
		      	"responsive": true, "lengthChange": false, "autoWidth": false,
		      	"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		    
		});
	</script>
@endsection
