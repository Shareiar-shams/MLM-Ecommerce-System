@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Mail List
@endsection
@section('admin_css_content')
	
	<!-- icheck bootstrap -->
  	<link rel="stylesheet" href="{{asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Email List</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Email List']);
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
	<div class="row">
        <div class="col-md-3">
	        <a href="{{route('user.mail.compose')}}" class="btn btn-primary btn-block mb-3">Compose</a>

	        <div class="card">
	            <div class="card-header">
	              	<h3 class="card-title">Folders</h3>

		            <div class="card-tools">
		                <button type="button" class="btn btn-tool" data-card-widget="collapse">
		                  	<i class="fas fa-minus"></i>
		                </button>
		            </div>
	            </div>
	            <div class="card-body p-0">
		            <ul class="nav nav-pills flex-column">
		                <li class="nav-item active">
			                <a href="{{route('user.mail.list')}}" class="nav-link">
			                    <i class="fas fa-inbox"></i> Inbox
			                    {{-- <span class="badge bg-primary float-right">12</span> --}}
			                </a>
		                </li>
		                <li class="nav-item">
			                <a href="{{route('user.mail.sent.list')}}" class="nav-link">
			                    <i class="far fa-envelope"></i> Sent
			                </a>
		                </li>
		                <li class="nav-item">
			                <a href="#" class="nav-link">
			                    <i class="fas fa-filter"></i> Junk
			                    <span class="badge bg-warning float-right">65</span>
			                </a>
		                </li>
		                <li class="nav-item">
			                <a href="#" class="nav-link">
			                    <i class="far fa-trash-alt"></i> Trash
			                </a>
		                </li>
		            </ul>
	            </div>
	            <!-- /.card-body -->
	        </div>
	        <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
	        <div class="card card-primary card-outline">
	            <div class="card-header">
	              	<h3 class="card-title">Inbox</h3>

		            {{-- <div class="card-tools">
		                <div class="input-group input-group-sm">
		                  	<input type="text" class="form-control" id="myInput" placeholder="Search Mail">
			                <div class="input-group-append">
			                    <div class="btn btn-primary">
			                      <i class="fas fa-search"></i>
			                    </div>
			                </div>
		                </div>
		            </div> --}}
		            <!-- /.card-tools -->
	            </div>
	            <!-- /.card-header -->
	            <div class="card-body p-0">
	              	<div class="mailbox-controls">
	                	<!-- Check all button -->
		                <button type="button" class="btn btn-default btn-sm checkbox-toggle">
		                	<i class="far fa-square"></i>
		                </button>
		                <div class="btn-group">
			                <button type="button" class="btn btn-default btn-sm delete_all">
			                    <i class="far fa-trash-alt"></i>
			                </button>
			                <button type="button" class="btn btn-default btn-sm">
			                    <i class="fas fa-reply"></i>
			                </button>
			                <button type="button" class="btn btn-default btn-sm">
			                    <i class="fas fa-share"></i>
			                </button>
		                </div>
		                <!-- /.btn-group -->
		                <button type="button" class="btn btn-default btn-sm">
		                 	<i class="fas fa-sync-alt"></i>
		                </button>
		                <div class="float-right">
			                {!! $contacts->appends(['sort' => 'id'])->links() !!}
			                {{-- <div class="btn-group">
			                    <button type="button" class="btn btn-default btn-sm">
			                      	<i class="fas fa-chevron-left"></i>
			                    </button>
			                    <button type="button" class="btn btn-default btn-sm">
			                      	<i class="fas fa-chevron-right"></i>
			                    </button>
			                </div> --}}
			                <!-- /.btn-group -->
		                </div>
		                <!-- /.float-right -->
	              	</div>
		            <div class="table-responsive mailbox-messages">
		                <table id="example1" class="table table-hover table-striped">
			                <tbody>
			                	@foreach($contacts as $contact)
				                <tr>
				                	<td>
				                      	<div class="icheck-primary">
				                        	<input type="checkbox" value="" id="check{{$loop->index+1}}" data-id="{{$contact->id}}">
				                        	<label for="check{{$loop->index+1}}"></label>
				                      	</div>
				                    </td>
				                    
				                    <td class="mailbox-name"><a href="{{route('user.mail.show',$contact->id)}}">{{$contact->name}}</a></td>
				                    <td class="mailbox-subject">{!! Str::limit($contact->message, 50) !!}
				                    </td>
				                    <td class="mailbox-date">{{$contact->created_at->diffForHumans()}}</td>
				                    <td class="mailbox-attachment">
			                            <form action="{{route('email.delete',$contact->id)}}" method="post" id="delete-form-{{$contact->id}}" style="display: none;">
			                              	@csrf
			                              	@method('delete')
			                            </form>
			                            <a href="" style="font-size: 18px; color: gray;" onclick="
			                            if(confirm('Are you Want to Uproot this!'))
			                            {
			                                event.preventDefault();
			                                document.getElementById('delete-form-{{$contact->id}}').submit();
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
		                <!-- /.table -->
		            </div>
		            <!-- /.mail-box-messages -->
	            </div>
	            <!-- /.card-body -->
	            
	        </div>
	        <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
@endsection
@section('admin_js_content')
	<!-- Page specific script -->

	<script>
		
		$(function () {
		    // Enable check and uncheck all functionality
		    $('.checkbox-toggle').click(function () {
		        var clicks = $(this).data('clicks');
		        if (clicks) {
		            // Uncheck all checkboxes
		            $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false);
		            $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square');
		        } else {
		            // Check all checkboxes
		            $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true);
		            $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square');
		        }
		        $(this).data('clicks', !clicks);
		    });

		    // Delete selected mailbox items
		    $('.delete_all').click(function () {
		        var selectedIds = [];
		        // Get IDs of selected items
		        $('.mailbox-messages input[type=\'checkbox\']:checked').each(function () {
		            selectedIds.push($(this).data('id'));
		        });
		        if (selectedIds.length > 0) {
		            if (confirm('Are you sure you want to delete selected items?')) {
		                $.ajax({
		                	url: '{{ route('email.alldelete','type') }}',
		                    method: 'POST',
		                    processData: false,
						    contentType: false,
		                    headers: {
		                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		                    },
		                    data: JSON.stringify({
			                    ids: selectedIds
			                }),
			                contentType: 'application/json',
		                    success: function (response) {
		                    	// console.log(response);
		                    	// Handle the success response
				                toastr.success('Mail Delete successfully!');
		                        // Refresh mailbox or handle success message
		                        location.reload(); // For example, you can reload the page
		                    },
		                    error: function (xhr, status, error) {
		                        console.error(xhr.responseText);
		                        // Handle error message
		                        alert('An error occurred while deleting items.');
		                    }
		                });
		            }
		        } else {
		            alert('Please select at least one item to delete.');
		        }
		    });
		});


	</script>

@endsection