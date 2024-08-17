@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Ticket Details
@endsection
@section('admin_css_content')
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Ticket Details</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Ticket Details']);
	@endphp
	<x-ad-breadcrumb :list="$list"/>
@endsection

@section('admin_main_content')
	<div class="container-fluid">
        <div class="row">
          	<div class="col-12">

          		<div class="card custom-card mb-2">
          			<div class="card-body">
          				<div class="d-flex align-items-center">
          					<div class="flex-shrink-0">
          						@if($data->user->profile_image)
          							<img class="border rounded-circle border-2" src="{{Storage::disk('local')->url($data->user->profile_image)}}" width="60" height="60">
          						@else
      								<img class="border rounded-circle border-2" src="https://demo.vironeer.com/fowtickets/images/avatars/default.png" width="60" height="60">
      							@endif
          					</div>
          					<div class="flex-grow-1 ms-3">
          						<a href="https://demo.vironeer.com/fowtickets/admin/users/381/edit" class="text-dark">
	          						<h5 class="mb-1"> {{$data->user->name}} </h5>
	          						<p class="mb-0 text-muted">{{$data->user->email}}</p>
          						</a>
          					</div>
          					<div class="flex-grow-3 ms-3">
          						<form action="{{route('ticket.close',$data->uuid)}}" method="post" id="close-form-{{$data->id}}" style="display: none;">
	                      			@csrf
	                      			@method('put')
	                      			<input type="hidden" name="status" value="close">
	                    		</form>
		                      	<a class="vironeer-link-confirm btn btn-danger" href="#" onclick="
		                            if(confirm('Want to Close this Ticket!'))
		                            {
		                                event.preventDefault();
		                                document.getElementById('close-form-{{$data->id}}').submit();
		                            }
		                            else
		                            {
		                                event.preventDefault();
		                            }
		                        ">Close ticket</a>
          					</div>
          				</div>
          			</div>
          		</div>
          		<!-- general form elements disabled -->
	            <div class="card card-info">
		            
	              	<div class="card-header">
		                <h3 class="card-title">Ticket Details</h3>

		                <a href="{{route('ticket.index')}}" class="btn btn-primary" style="float: right;" title="">Back</a>
		            </div>
		          	<div class="card-body">
		                <div class="form-group">
		                    <label>Created at:</label>
		                    <input type="text" class="form-control" value="{{ $data->created_at->diffForHumans() }}" disabled>
		                </div>

		                <div class="form-group">
		                    <label>Title:</label>
		                    <input type="text" class="form-control" value="{{$data->title}}" disabled>
		                </div>

		                <div class="form-group">
		                    <label>Content:</label>
		                    <input type="text" class="form-control" value="{{$data->message}}" disabled>
		                </div>

		                <div class="form-group">
		                    <label>Attachments:</label>
		                    @if($data->attachment)
			                    @php
			                        $explode = explode('.', $data->attachment);
			                        $allowedVideoExtensions = ['mp4', 'mov', 'ogg', 'webm'];
			                        $allowedDocExtensions = ['pdf', 'docx', 'webp'];
			                    @endphp
			                    @if(in_array($explode[1], $allowedVideoExtensions))
			                        <video width="100%" height="240" controls>
			    					    <source src="{{Storage::disk('local')->url($data->attachment)}}" type="video/mp4">
			    					</video>
			                    @elseif(in_array($explode[1], $allowedDocExtensions))
			                        <a href="{{Storage::disk('local')->url($data->attachment)}}" target="_blank">Open File</a>
			                    @else
			                        <img width="100%" height="240" src="{{Storage::disk('local')->url($data->attachment)}}">
			                    @endif
			                @else
			                	<input type="text" class="form-control" value="Null" disabled>
		                    @endif
		                </div>

		                <div class="form-group">
		                    <label>Status:</label>
		                    <input type="text" class="form-control" value="{{$data->status}}" disabled>
		                </div>

		                <div class="form-group">
		                    <label>Priority:</label>
		                    <input type="text" class="form-control" value="{{$data->priority}}" disabled>
		                </div>

		                <div class="form-group">
		                  	<label>Reply:</label>
		                  	@foreach($data->messages as $message)
		                  		<div class="card-body bg-dark">
		                  			<div class="d-flex justify-content-between">
		                  				<p class="text-muted small"><i class="far fa-clock me-1"></i>{{ $message->created_at->diffForHumans() }}</p>
		                  				{{-- <p class="fw-bold"> Demo Admin </p> --}}
		                  			</div>
		                  			<p class="mb-0"> {{$message->message}} </p>
		                  			<div class="attachments mt-3">
		                  				@if($message->attachment)
		                  				@php
					                        $explode = explode('.', $message->attachment);
					                        $allowedVideoExtensions = ['mp4', 'mov', 'ogg', 'webm'];
					                        $allowedDocExtensions = ['pdf', 'docx', 'webp'];
					                    @endphp
					                    @if(in_array($explode[1], $allowedVideoExtensions))
					                        <video width="100%" height="240" controls>
					    					    <source src="{{Storage::disk('local')->url($message->attachment)}}" type="video/mp4">
					    					</video>
					                    @elseif(in_array($explode[1], $allowedDocExtensions))
					                        <a href="{{Storage::disk('local')->url($message->attachment)}}" target="_blank" class="btn btn-dark btn-sm mb-2 me-1"><i class="fa fa-download me-1"></i>Attachment</a>
					                    @else
					                        <img width="300" height="240" src="{{Storage::disk('local')->url($message->attachment)}}">
					                    @endif
					                    @endif
		                  			</div>
		                  		</div>
		                  		<br>
		                    @endforeach
			            </div>
			            @if ($errors->any())                 
							@foreach ($errors->all() as $error)
								<div class="alert alert-danger alert-block">
							        <a type="button" class="close" data-dismiss="alert"></a> 
							        <strong>{{ $error }}</strong>
							    </div>
							@endforeach						                   
						@endif
						<form action="{{route('ticket.store')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
			    			@csrf
			    			<input type="hidden" name="ticket_id" value="{{$data->id}}">
				            <!-- general form elements -->
				            <div class="card card-default">
				            	<div class="card-header">

						            <div class="card-tools">
						              <button type="button" class="btn btn-tool" data-card-widget="collapse">
						                <i class="fas fa-minus"></i>
						              </button>
						              
						            </div>
						        </div>
						        <!-- /.card-header -->
				                <div class="card-body">
					                <div class="form-group">
					                    <label for="exampleInputEmail1">Reply Message *</label>
					                    <textarea name="message" class="form-control" placeholder="Enter Message" required></textarea>
					                </div>

					                <div class="form-group">
					                    <label for="exampleInputFile">Attachment</label>
					                    <div class="input-group">
					                      <div class="custom-file">
					                        <input type="file" name ="attachment" class="custom-file-input" id="exampleInputFile">
					                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
					                      </div>
					                    </div>
					                </div>
					                <div class="alert alert-warning mb-0">
					                	<strong>Supported types :</strong> JPG, JPEG, PNG, PDF, GIF, DOCX, MP4, MOV, OGG, WEBM
					                </div>
				                </div>
				                <!-- /.card-body -->
				                <div class="card-footer">
				                  	<button type="submit" class="btn btn-primary">Send</button>
				                  	
				                </div>
				                <!-- /.card-footer -->
				            </div>
				            <!-- /.card -->
				        </form>

		          	</div>
		          	<!-- /.card-body -->
	            </div>
	            <!-- /.card -->
          	</div>
        </div>
    </div>
@endsection

@section('admin_js_content')
@endsection