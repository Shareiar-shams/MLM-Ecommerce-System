@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Mlm User profile
@endsection
@section('admin_css_content')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{Vite::asset('resources/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{Vite::asset('resources/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{Vite::asset('resources/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Dashboard</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Mlm User profile']);
	@endphp
	<x-ad-breadcrumb :list="$list"/>
@endsection
@section('admin_main_content')
	{{-- @if ($errors->any())                 
		@foreach ($errors->all() as $error)
			<div class="alert alert-danger alert-block">
		        <a type="button" class="close" data-dismiss="alert"></a> 
		        <strong>{{ $error }}</strong>
		    </div>
		@endforeach						                   
	@endif --}}
	<div class="container-fluid">
        <div class="row">
	        <div class="col-md-3">

	            <!-- Profile Image -->
	            <div class="card card-primary card-outline">
		            <div class="card-body box-profile">
		                <div class="text-center">

			            	@if($data->user->profile_image != null)
				              	<label for="file" style="cursor: pointer; display: inline;"><img src="{{Storage::disk('local')->url($data->user->profile_image)}}" class="profile-user-img img-responsive img-circle" alt="User profile picture" id="output"></label>
				            @else
				              	<label for="file" style="cursor: pointer; display: inline;"><img src="{{Vite::asset('resources/dist/img/noimage.jpg')}}" class="profile-user-img img-responsive img-circle" alt="User profile picture" id="output"></label>
				            @endif
		                </div>
		                <h3 class="profile-username text-center">{{$data->user->name}}</h3>

				        <p class="text-muted text-center">{{$data->user->email}}</p>
				        <p class="text-muted text-center"> {{$data->user->phone}}</p>
				        <ul class="list-group list-group-unbordered mb-3">
		                  <li class="list-group-item">
		                    <b>Total Child</b> <a href="{{route('adminmlm.show',$data->id)}}"class="float-right">{{$data->children->count()}}</a>
		                  </li>
		                  <li class="list-group-item">
		                    <b>Active Child</b> <a href="{{route('adminmlm.show',['adminmlm' => $data->id, 'status' => 'activechild'])}}" class="float-right">{{$activeChildCount->count()}}</a>
		                  </li>
		                  <li class="list-group-item">
		                    <b>Inactive Child</b> <a href="{{route('adminmlm.show',['adminmlm' => $data->id, 'status' => 'inactivechild'])}}" class="float-right">{{$data->children->count() - $activeChildCount->count()}}</a>
		                  </li>
		                </ul>

		            </div>
		            <!-- /.card-body -->
	            </div>
	            <!-- /.card -->

	            <!-- About Me Box -->
	            <div class="card card-primary">
		            <div class="card-header">
		                <h3 class="card-title">About User</h3>
		            </div>
	              	<!-- /.card-header -->
	              	<div class="card-body">
	              		<strong><i class="fas fa-user mr-1"></i> User Type </strong>
	              		<p class="text-muted">@if(isset($data->refferer_id) && empty($data->parent_id)) Special User @else {{!isset($data->parent_id) ? 'Root User' : 'Child User'}}
                		@endif </p>
	              		<hr>
	                	<strong><i class="fas fa-wallet mr-1"></i> Trade Details </strong>
	                	@if(isset($data->others_documents))
	                	@php
										    $othersDocuments = json_decode($data->others_documents, true);
										    $keyMappings = [
										        'account_gatway' => 'payment_gatway_type',
										        'account_number' => 'number',
										        'account_type' => 'type',
										    ];
										@endphp
	                	<p class="text-muted"><strong>Account Gatway:</strong>
	                  		{{ $othersDocuments[$keyMappings['account_gatway']] }}
	                	</p>

	                	<p class="text-muted"><strong>Account Number:</strong>
	                  		{{ $othersDocuments[$keyMappings['account_number']] }}
	                	</p>

	                	<p class="text-muted"><strong>Account Type:</strong>
	                  		{{ $othersDocuments[$keyMappings['account_type']] }}
	                	</p>
	                	@endif

	                	<hr>
	                	@if(isset($data->parent_id))
	                	<strong><i class="fas fa-user-plus mr-1"></i> Parent Details</strong>

	                	<p class="text-muted"><strong>Parent Name:</strong> 
	                		<a href="{{route('adminmlm.show',$data->parent_id)}}" >{{$data->parent_user->name}}</a>
	                	</p>
	                	<p class="text-muted"><strong>Parent Email:</strong> 
	                		{{$data->parent_user->email}}
	                	</p>

	                	<p class="text-muted"><strong>Parent Phone:</strong> 
	                		{{$data->parent_user->phone}}
	                	</p>
	                	@endif
	                	<hr>
	                	@if(isset($data->refferer_id))
	                	<strong><i class="fas fa-pencil-alt mr-1"></i> Reffer Details</strong>

		                <p class="text-muted"><strong>Reffer Name:</strong> 
	                		<a href="{{route('adminmlm.show',$data->refferer_id)}}" >{{$data->refferer_user->name}}</a>
	                	</p>
	                	<p class="text-muted"><strong>Reffer Email:</strong> 
	                		{{$data->refferer_user->email}}
	                	</p>

	                	<p class="text-muted"><strong>Reffer Phone:</strong> 
	                		{{$data->refferer_user->phone}}
	                	</p>
	                	@endif
	                	<hr>

	                	{{-- <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

	               		<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p> --}}
	              	</div>
	              	<!-- /.card-body -->
	            </div>
	            <!-- /.card -->
	        </div>
          	<!-- /.col -->
          	<div class="col-md-9">
          		<div class="card">
	              	<div class="card-header">
	                	<h3 class="card-title">User Child Lists</h3>
	              	</div>
		            <!-- /.card-header -->
		            <div class="card-body">
		                <table id="example1" class="table table-bordered table-striped">
		                  	<thead>
				                  <tr>
				                    <th>Name</th>
				                    <th>Email</th>
				                    <th>Phone</th>
				                    <th>Status</th>
				                    <th>Payment Status</th>
				                  </tr>
		                  	</thead>
		                  	<tbody>
		                  		@foreach($childUsers as $item)
					                <tr>
				                    	<td><a href="{{route('adminmlm.show',$item->user->id)}}" >{{$item->user->name}}</a></td>
				                    	<td>{{$item->user->email}}</td>
				                    	<td>{{$item->user->phone}}</td>
				                    	<td>
				                    		@if((!isset($item->refferer_id) && $item->admin_activation == 1) || (isset($item->refferer_id) && $item->admin_activation == 1 && $item->parent_activation == 1))
				                            	<label class="badge badge-success">Active</label>
				                            
				                            @elseif(isset($item->refferer_id) && $item->admin_activation == 0 && $item->parent_activation == 1)
				                            	<label class="badge badge-warning">Unautorize By Admin</label>
				                            @elseif(isset($item->refferer_id) && $item->admin_activation == 1 && $item->parent_activation == 0)
				                            	<label class="badge badge-warning">Unautorize By Parent</label>
				                            @elseif($item->admin_activation == 2)
				                            	<label class="badge badge-danger">Restricted User</label>
				                            @endif
				                    	</td>
				                    	<td>@if(isset($item->transaction->amount))
				                    			<label class="badge badge-primary">Paid</label>
				                    		@else
				                    			<label class="badge badge-warning">UnPaid</label>
				                    		@endif
				                    	</td>
					                </tr>
					                @endforeach
		                  	</tbody>
		                </table>
		            </div>
		            <!-- /.card-body -->
            	</div>
          	</div>
          	<!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
@endsection

@section('admin_js_content')
	<!-- DataTables  & Plugins -->
	<script src="{{Vite::asset('resources/plugins/datatables/jquery.dataTables.min.js')}}"></script>
	<script src="{{Vite::asset('resources/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{Vite::asset('resources/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{Vite::asset('resources/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
	<script src="{{Vite::asset('resources/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{Vite::asset('resources/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{Vite::asset('resources/plugins/jszip/jszip.min.js')}}"></script>
	<script src="{{Vite::asset('resources/plugins/pdfmake/pdfmake.min.js')}}"></script>
	<script src="{{Vite::asset('resources/plugins/pdfmake/vfs_fonts.js')}}"></script>
	<script src="{{Vite::asset('resources/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
	<script src="{{Vite::asset('resources/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
	<script src="{{Vite::asset('resources/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
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