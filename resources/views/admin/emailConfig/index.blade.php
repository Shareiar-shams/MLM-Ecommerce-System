@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Email Config
@endsection
@section('admin_css_content')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Email Config</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Email Config']);
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
		
	    <div class="row">
	    	<div class="col-xl-12 col-lg-12 col-md-12">

				<div class="card o-hidden border-0 shadow-lg">
					<div class="card-body ">
						<!-- Nested Row within Card Body -->
						<div class="p-5">
								
                            <div class="container pl-0 pr-0 ml-0 mr-0 w-100 mw-100">
                                <div id="tabs">

                                    <!-- Tab panes -->
                                    <div class="tab-content">

                                      	
                                      	<div id="google" class="container tab-pane active show">
                                      		<br>

                                            <div class="row justify-content-center">

                                                <div class="col-lg-8">
                                                	<form class="admin-form" action="{{route('email_configaration_put')}}" method="POST" enctype="multipart/form-data" id="googleForm">

					                                    @csrf
					                                    @method('put')

					                                    <input type="hidden" value="{{ isset($email->id) ? $email->id : '' }}" name="id">

	                                                    <div class="radio-show">

	                                                        <div class="form-group ">
	                                                            <label for="driver">Driver</label> 
	                                                            <small>(Your mail driver)</small>
	                                                            <input type="text" class="form-control " id="driver" name="driver" placeholder="Enter Mail Driver"  value="{{isset($email->driver) ? $email->driver : null}}" required>
	                                                        </div>

	                                                        <div class="form-group ">
	                                                            <label for="host">Host</label> 
	                                                            <small>(Mail Host)</small>
	                                                            <input type="text" class="form-control " id="host" name="host" placeholder="Enter Mail Host" value="{{isset($email->host) ? $email->host : null}}" required>
	                                                        </div>

	                                                        <div class="form-group ">
	                                                            <label for="port">Port *</label> 
	                                                            <small>(Mail Port)</small>
	                                                            <input type="number" class="form-control " id="port" name="port" placeholder="Enter Mail Port" value="{{isset($email->port) ? $email->port : null}}"  required>
	                                                        </div>

	                                                        <div class="form-group ">
	                                                            <label for="port">Encryption *</label> 
	                                                            <small>(Mail Encryption Like "SSL", "TSL")</small>
	                                                            <input type="text" class="form-control " id="encryption" name="encryption" placeholder="Enter Mail encryption" value="{{isset($email->encryption) ? $email->encryption : null}}"  required>
	                                                        </div>

	                                                        <div class="form-group ">
	                                                            <label for="port">User Name *</label> 
	                                                            <small>(Mail User Name)</small>
	                                                            <input type="text" class="form-control " id="username" name="username" placeholder="Enter Mail username" value="{{isset($email->username) ? $email->username : null}}"  required>
	                                                        </div>

	                                                        <div class="form-group ">
	                                                            <label for="port">Password *</label> 
	                                                            <small>(Mail Password)</small>
	                                                            <input type="password" class="form-control " id="password" name="password" placeholder="Enter Mail password" value="{{isset($email->password) ? $email->password : null}}" required>
	                                                        </div>

	                                                        <div class="form-group ">
	                                                            <label for="port">Sender Mail *</label> 

	                                                            <input type="text" class="form-control " id="sendermail" name="sendermail" placeholder="Enter Mail sendermail" value="{{isset($email->sendermail) ? $email->sendermail : null}}" required>
	                                                        </div>

	                                                    </div>
	                                                </form>
	                                                <div class="form-group">
									                  	<button type="submit" onclick="updateGoogleData()" class="btn btn-primary">Submit</button>
									                </div>
                                                </div>

                                            </div>

                                      	</div>

                                    </div>

                            	</div>

                           	</div>

							
						</div>
					</div>
				</div>
			</div>
			

		</div>
	</div>
  <!-- /.container-fluid -->
@endsection

@section('admin_js_content')

	<script type="text/javascript">
		
	    function updateGoogleData() {
	    	var form = document.getElementById('googleForm');
            var formData = new FormData(form);

	        $.ajax({
	            url: form.action,
                method: form.method,
                data: formData,
                processData: false,
                contentType: false,
	            success: function(response) {
	            	console.log(response);
	                // Handle success response, e.g., show success message
	                toastr.success('Email Configaration  updated successfully.');
	            },
	            error: function(error) {
	                // Handle error response, e.g., show error message
	                alert('Error updating Meta content.');
	            }
	        });
	    }
	</script>
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