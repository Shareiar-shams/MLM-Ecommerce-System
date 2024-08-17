@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Announcement
@endsection
@section('admin_css_content')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <style type="text/css" media="screen">
  	/* Basic Rules */
	.switch input { 
	    display:none;
	}
	.switch {
	    display:inline-block;
	    width:60px;
	    height:30px;
	    margin:8px;
	    transform:translateY(50%);
	    position:relative;
	}
	/* Style Wired */
	.slider {
	    position:absolute;
	    top:0;
	    bottom:0;
	    left:0;
	    right:0;
	    border-radius:30px;
	    box-shadow:0 0 0 2px #777, 0 0 4px #777;
	    cursor:pointer;
	    border:4px solid transparent;
	    overflow:hidden;
	     transition:.4s;
	}
	.slider:before {
	    position:absolute;
	    content:"";
	    width:100%;
	    height:100%;
	    background:#777;
	    border-radius:30px;
	    transform:translateX(-30px);
	    transition:.4s;
	}

	input:checked + .slider:before {
	    transform:translateX(30px);
	    background:limeGreen;
	}
	input:checked + .slider {
	    box-shadow:0 0 0 2px limeGreen,0 0 2px limeGreen;
	}
  </style>
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Announcement</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Announcement']);
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
										<div class="row">
												<div class="col-lg-12">
														<div class="p-5">
																<div class="admin-form">

													
						                        <div class="row justify-content-center">

						                            <div class="col-lg-8">

						                                <form action="{{route('announcementupdate')}}" method="POST" enctype="multipart/form-data" id="announcementForm">

						                                  	@csrf
						                                    @method('put')
						                                    <input type="hidden" name="id" value="{{$announcement->id}}">
						                                    {{-- <div class="form-group">
						                                        <label class="switch-primary">
						                                          <input type="checkbox" class="switch switch-bootstrap status radio-check" name="is_announcement" value="1" checked="">
						                                          <span class="switch-body"></span>
						                                          <span class="switch-text">Announcement Banner</span>
						                                        </label>
						                                    </div> --}}

						                                    <div class="form-group">
																						        <label class="switch">
																						            <input type="checkbox" class="announcementChecker" name="status"value="1" @if($announcement->status == 1)
																		                      	{{'checked'}} 
																		                    @endif>
																						            <span class="slider"></span>
																						        </label> Announcement Banner
											    											</div>

						                                    <div class="form-group announcementDropDown">
						                                        <label for="announcement_type">Select Type *</label>
						                                        <select name="type" id="announcement_type" class="form-control">
						                                            <option value="banner" {{$announcement->type == 'banner' ? 'selected' : ''}}>Announcement</option>
						                                            <option value="newletter" {{$announcement->type == 'newletter' ? 'selected' : ''}}>Newsletter Popup</option>
						                                        </select>
						                                    </div>

						                                    <div class="image-show ">

						                                        <div class="form-group">
						                                            <label for="name">Image</label>
						                                            <div class="col-lg-12 pb-1">
						                                                <img height="180" width="150" class="admin-img lg" src="{{Storage::disk('local')->url($announcement->image)}}" alt="No Image Found" id="output">
						                                            </div>
						                                            <span>Image Size Should Be 520 x 529. For Announcement Popuop</span> <br>
						                                            <span>Image Size Should Be 300 x 400. For Newsletter Popuop</span>
						                                        </div>

						                                        <div class="form-group position-relative ">
						                                            <label class="file">
						                                                <input type="file" value="{{$announcement->image}}" accept="image/*" onchange="loadFile(event)" class="upload-photo" name="image" id="file" aria-label="File browser example">
						                                                <span class="file-custom text-left">Upload Image...</span>
						                                            </label>
						                                        </div>

						                                        <div class="form-group">
						                                            <label for="delay_duration">Announcement Delay (secend) *</label>
						                                            <input type="text" name="delay_duration" class="form-control" id="delay_duration" placeholder="Announcement Delay" value="{{$announcement->delay_duration}}">
						                                        </div>

						                                        <div class="form-group">
						                                            <label for="announcement_title">Newsletter Title *</label>
						                                            <input type="text" name="title" class="form-control" id="announcement_title" placeholder="Popup Title" value="{{$announcement->title}}">
						                                        </div>
						                                        <div class="form-group">
						                                            <label for="announcement_details">Newsletter Text *</label>
						                                            <textarea name="description" class="form-control" id="announcement_details">{{$announcement->description}}</textarea>
						                                        </div>

						                                        <div class="form-group">
						                                            <label for="announcement_link">Announcement Link *</label>
						                                            <input type="text" name="url" class="form-control" id="announcement_link" placeholder="Link" value="{{$announcement->url}}">
						                                        </div>

						                                    </div>

						                                </form>
						                                <div class="form-group d-flex justify-content-center">
							                  								<button type="submit" onclick="updateAnnouncementData()" class="btn btn-primary">Submit</button>
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

		var loadFile = function(event) {
			$('#output').show();
			var image = document.getElementById('output');
			image.src = URL.createObjectURL(event.target.files[0]);
		};


		// Function to toggle visibility based on checkbox state
	    function toggleAnnouncementShow() {
	        var announcementChecker = document.querySelector('.announcementChecker');
	        var announcementDropDown = document.querySelector('.announcementDropDown');
	        if (announcementChecker.checked) {
	            announcementDropDown.style.display = 'block';
	        } else {
	            announcementDropDown.style.display = 'none';
	        }
	    }

	    // Call the function on page load and whenever announcementChecker state changes
	    window.onload = toggleAnnouncementShow;
	    document.querySelector('.announcementChecker').addEventListener('change', toggleAnnouncementShow);


	    function updateAnnouncementData() {
	    	var form = document.getElementById('announcementForm');
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
	                toastr.success('Announcement updated successfully.');
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