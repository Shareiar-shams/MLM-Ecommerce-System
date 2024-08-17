@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Tickets List
@endsection
@section('admin_css_content')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Tickets List</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Tickets List']);
	@endphp
	<x-ad-breadcrumb :list="$list"/>
@endsection

@section('admin_main_content')
	<div class="container-fluid">
        <div class="row">
          	<div class="col-12">
            	

            	<div class="card">
	              	<div class="card-header">
	                	<h3 class="card-title">Tickets List</h3>
	                	<a href="{{route('ticket.create')}}" class="btn btn-primary" style="float: right;" title="">Add</a>
	              	</div>
		            <!-- /.card-header -->
		            <div class="card-body">
		                <table id="example1" class="table table-bordered table-striped">
		                  	<thead>
				                <tr>
				                    <th>No</th>
				                    <th>Title</th>
				                    <th>Status</th>
				                    <th>Priority</th>
				                    <th>Category</th>
				                    <th>Author Name</th>
				                    <th>Author Email</th>
				                    <th>Action</th>
				                </tr>
		                  	</thead>
		                  	<tbody>
		                  		@foreach($tickets as $data)
					                <tr>
				                    	<td>{{$loop->index + 1}}</td>
				                    	<td>{{$data->title}}</td>
				                    	<td>
				                    		@if($data->status == "open")
					                    		<label class="badge badge-success">{{$data->status}}</label>
				                    		@else
				                    			<label class="badge badge-danger">{{$data->status}}</label>
				                    		@endif
				                    		
				                    	</td>
				                    	<td>
				                    		@if($data->priority == "high" || $data->priority == "High")
				                    			<label class="badge badge-danger">{{$data->priority}}</label>
				                    		@elseif($data->priority == "normal" || $data->priority == "Normal")
				                    		@else
					                    		<label class="badge badge-success">{{$data->priority}}</label>
				                    		@endif
				                    		
				                    	</td>
				                    	<td>
				                    		@foreach ($data->categories as $category)
																    {{ $category->name }}
																@endforeach
				                    	</td>
				                    	<td>{{$data->user->name}}</td>
				                    	<td>{{$data->user->email}}</td>
				                    	
				                    	<td>
				                    		<div class="btn-group">
							                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Options
							                      	<span class="sr-only">Toggle Dropdown</span>
							                    </button>
							                    <div class="dropdown-menu" role="menu">

							                      	<a class="dropdown-item" href="{{route('ticket.show',$data->uuid)}}"><i class="fas fa-angle-double-right"></i>Show</a>

							                      	{{-- <a class="dropdown-item" href="{{route('ticket-categories.edit',$data->id)}}"><i class="fas fa-angle-double-right"></i>Edit</a> --}}

							                      	<a class="dropdown-item" href="#" onclick="

				                            			if(confirm('Are you Want to Delete this!'))
							                            {

							                              event.preventDefault();

							                              document.getElementById('delete-form-{{$data->id}}').submit();

							                            }
							                            else
							                            {
							                              event.preventDefault();
							                            }
							                        "><i class="fas fa-angle-double-right"></i>
							                    			{{ __('Delete') }}
							                    		</a>
							                    		<form action="{{route('ticket.destroy',$data->id)}}" method="post" id="delete-form-{{$data->id}}" style="display: none;">
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
    </div>
    <!-- /.container-fluid -->
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