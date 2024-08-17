@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Review
@endsection
@section('admin_css_content')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <style>
	.read {
	  color: orange;
	}
  </style>
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Review Lists</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Product', 'Review']);
	@endphp
	<x-ad-breadcrumb :list="$list"/>
@endsection

@section('admin_main_content')

	<div class="row">
		<div class="col-lg-12">
			<div class="box">
	            {{-- <div class="box-header">
	              	<h3 class="box-title">Review Lists</h3>
	            </div> --}}
	            <!-- /.box-header -->
	            <div class="box-body">
		            <table id="example1" class="table table-bordered table-striped">
		                <thead>
			                <tr>
				                <th>S.No</th>
				                <th>User Name</th>
				                <th>Product Name</th>
				                <th>Review</th>	                
				                <th>Rating</th>
				                <th>Delete</th>
			                </tr>
		                </thead>
		                <tbody>
		                	@foreach($reviews as $review)
				                <tr>
				                  	<td>{{$loop->index + 1}}</td>
		                  			<td>{{$review->user->name}}</td>
		                  			<td>{{$review->product->name}}</td>
				                  	<td>{{$review->review}}</td>
			                        <td>
			                        	@for ($i = 1; $i <= 5; $i++)
										    @if ($i <= $review->rating)
										        <span class="fa fa-star read"></span>
										    @else
										        <span class="fa fa-star"></span>
										    @endif
										@endfor
			                        <td>
			                            <form action="{{route('review.destroy',$review->id)}}" method="post" id="delete-form-{{$review->id}}" style="display: none;">
			                              {{csrf_field()}}
			                              {{method_field('DELETE')}}
			                            </form>
			                            <a href="" style=" font-size: 18px;" onclick="
			                            if(confirm('Want to remove this!'))
			                            {
			                                event.preventDefault();
			                                document.getElementById('delete-form-{{$review->id}}').submit();
			                            }
			                            else
			                            {
			                                event.preventDefault();
			                            }
			                            "><svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#000000" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></a>
			                        </td>
				                </tr>
				            @endforeach
		                </tbody>
		            </table>
	            </div>
	            <!-- /.box-body -->
	      	</div>
	      	<!-- /.box -->
		</div>
	</div>

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
