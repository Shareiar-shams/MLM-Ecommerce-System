@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Digita Product
@endsection
@section('admin_css_content')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{Vite::asset('resources/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{Vite::asset('resources/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{Vite::asset('resources/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Show Digital Product</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Digital Product']);
	@endphp
	<x-ad-breadcrumb :list="$list"/>
@endsection

@section('admin_main_content')
	<div class="container-fluid">
        <div class="row">
          	<div class="col-12">
            	

            	<div class="card">
	              	<div class="card-header">
	                	<h3 class="card-title">Digital Product List</h3>
	              	</div>
		            <!-- /.card-header -->
		            <div class="card-body">
		                <table id="example1" class="table table-bordered table-striped">
		                  	<thead>
				                  <tr>
				                    <th>Image</th>
				                    <th>Name</th>
				                    <th>Price</th>
				                    <th>Status</th>
				                    <th>SKU</th>
				                    <th>Actions</th>
				                  </tr>
		                  	</thead>
		                  	<tbody>
		                  		@foreach($data as $item)
							                <tr>
						                    	<td>
						                    		@if($item->display_image != 'noimage.jpg')

							                  			<img class="profile-user-img img-responsive" src="{{Storage::disk('local')->url($item->featured_image)}}" alt="Digital Product Image {{$item->id}}">

							                  		@else

							                  			No image

							                  		@endif
							                  	</td>
						                    	<td>{{$item->name}}</td>
						                    	<td>
						                    		@if(isset($item->special_price)) {{$item->special_price}} @else {{$item->price}} @endif
						                    	</td>
						                    	<td>
						                    		<div class="btn-group">
									                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">@if($item->status == 1) Publish @else Unpublish @endif 
									                    	<span class="sr-only">Toggle Dropdown</span>
									                    </button>
									                    <div class="dropdown-menu" role="menu">
									                    	<form action="{{route('digital.product.status',$item->id)}}" method="post" id="disable-form-{{$item->id}}" style="display: none;">
						                              			@csrf
						                              			@method('put')
						                              			<input type="hidden" name="status" value="@if($item->status == 1) 0 @else 1 @endif">
						                            		</form>
									                      	<a class="dropdown-item" href="#" onclick="
									                            if(confirm('Want to change this product status!'))
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
						                    	<td>{{$item->SKU}}</td>
						                    	<td>
						                    		<div class="btn-group">
									                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Options
									                      	<span class="sr-only">Toggle Dropdown</span>
									                    </button>
									                    <div class="dropdown-menu" role="menu">
									                      	<a class="dropdown-item" href="{{route('digitalproduct.edit',$item->id)}}"><i class="fas fa-angle-double-right"></i>Edit</a>
									                      	<a class="dropdown-item" href="#"><i class="fas fa-angle-double-right"></i>View</a>
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
									                      	<form action="{{route('digitalproduct.destroy',$item->id)}}" method="post" id="delete-form-{{$item->id}}" style="display: none;">
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