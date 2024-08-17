@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Subscriber List
@endsection
@section('admin_css_content')
  	<!-- DataTables -->
  	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Subscriber List</h1>
	</div><!-- /.col -->
	@php 
	  	$list = json_encode(['Home', 'Subscriber List']);
	@endphp
	<x-ad-breadcrumb :list="$list"/>
@endsection

@section('admin_main_content')
	<div class="container-fluid">
        <div class="row">
          	<div class="col-12">
            	<div class="card">
	              	<div class="card-header">
	                	<h3 class="card-title">Subscriber List</h3>
	                	<a class="btn btn-primary btn-sm" style="float: right;" href="{{route('subscriber_send_email')}}"><i class="far fa-envelope"></i> Send Email</a>
	              	</div>
		            <!-- /.card-header -->
		            <div class="card-body">
		                <table id="example1" class="table table-bordered table-striped">
		                  	<thead>
				                  <tr>
				                    <th>No</th>
				                    <th>Email</th>
				                    <th>Actions</th>
				                  </tr>
		                  	</thead>
		                  	<tbody>
		                  		@foreach($data as $user)
				                <tr>
				                	<td>{{$loop->index + 1}}</td>
			                    	<td>{{$user->email}}</td>
			                    	
			                    	<td>
			                    		<form action="{{route('subscribers.delete',$user->id)}}" method="post" id="delete-form-{{$user->id}}" style="display: none;">
			                              	@csrf
			                              	@method('delete')
			                            </form>
			                            <a href="" style="font-size: 18px; color: gray;" onclick="
			                            if(confirm('Are you Want to Uproot this!'))
			                            {
			                                event.preventDefault();
			                                document.getElementById('delete-form-{{$user->id}}').submit();
			                            }
			                            else
			                            {
			                                event.preventDefault();
			                            }
			                            "><i class="fas fa-trash"></i></a>
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