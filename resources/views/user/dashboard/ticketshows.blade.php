@extends('user.dashboard.layouts')
@section('user_title_content')
    Ahknoxo | Ticket Details
@endsection
@section('user_css_content')
	
@endsection

@section('dashboard_main_content')
	<div class="row row_section">
		<div class="card card-info" style="width: 100%; margin-bottom: 5%;">
			<div class="card-header" style="display: revert; width: 100%;">
                <h3 style="float: left;" class="card-title">Ticket Details</h3>

                <a href="{{route('ticket')}}" class="btn btn-info" style="float: right;" title="">Back</a>
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
                    <label>Comments:</label>
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

          	</div>
          	<!-- /.card-body -->
		</div>
	    
	</div>
@endsection
@section('user_js_content')
	
@endsection
