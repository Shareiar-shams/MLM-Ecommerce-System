@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Dashboard
@endsection
@section('admin_content_header')
  <div class="col-sm-6">
    <h1 class="m-0">Dashboard</h1>
  </div><!-- /.col -->
  @php 
    $list = json_encode(['Home', 'Dashboard']);
  @endphp
  <x-ad-breadcrumb :list="$list"/>
@endsection
@section('admin_css_content')
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{Vite::asset('resources/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{Vite::asset('resources/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{Vite::asset('resources/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{Vite::asset('resources/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{Vite::asset('resources/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{Vite::asset('resources/plugins/summernote/summernote-bs4.min.css')}}">
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
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">

	            <div class="card direct-chat direct-chat-primary">
	                <div class="card-header">
	                  	<h3 class="card-title">Chat With {{$mlmuser->user->name}}</span></h3>

		                <div class="card-tools">
		                    
		                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
		                      <i class="fas fa-minus"></i>
		                    </button>
		                    {{-- <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
		                      <i class="fas fa-comments"></i>
		                    </button> --}}
		                </div>
	                </div>
	                <!-- /.card-header -->
	                <div class="card-body">
	                  	<!-- Conversations are loaded here -->
	                  	<div class="direct-chat-messages" style="height: 100%">
		                	@foreach($messages as $message)
			                    <!-- Message. Default to the left -->
			                    <div class="direct-chat-msg @if($message->sender_type == 'admin') right @endif">
				                    <div class="direct-chat-infos clearfix">
				                        <span class="direct-chat-name @if($message->sender_type == 'admin') float-right @else float-left @endif">
				                        	@if($message->sender_type == 'admin')
				                        		Admin
				                        	@else
				                        		{{$mlmuser->user->name}}
				                        	@endif
				                        </span>
				                        <span class="direct-chat-timestamp @if($message->sender_type == 'admin') float-left @else float-right @endif">
				                        	{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $message->created_at)->format('j M g:i a') }}
				                        </span>
				                    </div>
				                    <!-- /.direct-chat-infos -->
				                    @if($message->sender_type == 'admin' && $admin->image != 'noimage.jpg')
						                <img class="direct-chat-img" src="{{Storage::disk('local')->url($admin->image)}}" alt="message user image">
				                    @elseif($message->sender_type == 'mlmuser' && isset($mlmuser->user->profile_image))
				                    	<img class="direct-chat-img" src="{{Storage::disk('local')->url($mlmuser->user->profile_image )}}" alt="message user image">
				                    @else
				                    	<img class="direct-chat-img" src="{{Vite::asset('resources/dist/img/noimage.jpg')}}" alt="message user image">
				                    @endif
				                    <!-- /.direct-chat-img -->
				                    <div class="direct-chat-text">
				                        {{$message->message}}
				                    </div>
				                    <!-- /.direct-chat-text -->
			                    </div>
			                    <!-- /.direct-chat-msg -->
			                @endforeach

			                    {{-- <!-- Message to the right -->
			                    <div class="direct-chat-msg right">
				                    <div class="direct-chat-infos clearfix">
				                        <span class="direct-chat-name float-right">Sarah Bullock</span>
				                        <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
				                    </div>
			                      	<!-- /.direct-chat-infos -->
			                      	<img class="direct-chat-img" src="{{Vite::asset('resources/dist/img/user3-128x128.jpg')}}" alt="message user image">
			                      	<!-- /.direct-chat-img -->
				                    <div class="direct-chat-text">
				                        You better believe it!
				                    </div>
				                    <!-- /.direct-chat-text -->
			                    </div>
			                    <!-- /.direct-chat-msg --> --}}

	                  	</div>
	                  	<!--/.direct-chat-messages-->
	                </div>
	                <!-- /.card-body -->
	                <div class="card-footer">
		                <form action="{{route('userchat.store')}}" method="post">
		                	@csrf
		                    <div class="input-group">
		                      <input type="text" name="message" placeholder="Type Message ..." class="form-control" id="messageInput">
		                      <input type="hidden" name="receiver_id" value={{$mlmuser->id}} class="form-control" id="receiverIdInput">
		                      <span class="input-group-append">
		                        <button type="submit" class="btn btn-primary">Send</button>
		                      </span>
		                    </div>
		                </form>
	                </div>
	                <!-- /.card-footer-->
	            </div>
	            <!--/.direct-chat -->
            </section>
        </div>
    </div>
@endsection

@section('admin_js_content')
<script>
    // Wait for the page to finish loading
    document.addEventListener('DOMContentLoaded', function() {
        // Scroll to the bottom of the page
        window.scrollTo(0, document.body.scrollHeight);
    });
</script>
<script>
    // function app() {
    //     return {
    //         messages: [],
    //         mlmuser: '',
    //         admin: '',
    //         newMessage: '',
    //         receiverId: '',

    //         init() {
	//             // Get the input elements
	//             const messageInput = document.getElementById('messageInput');
	//             const receiverIdInput = document.getElementById('receiverIdInput');

	//             // Add event listener to update the newMessage value
	//             messageInput.addEventListener('input', (event) => {
	//                 this.newMessage = event.target.value;
	//             });

	//             // Example of accessing the receiver ID value
	//             receiverIdInput.addEventListener('input', (event) => {
	//                 this.receiverId = event.target.value;
	//             });
	        
    //             this.fetchMessages();

    //             Echo.private('chat')
    //                 .listen('MessageSentEvent', function (e) {
    //                     this.messages.push({
    //                         message: e.message.message
    //                     });
    //                 }.bind(this));
    //         },

    //         fetchMessages() {
    //             axios.get('{{ route("userchat.index") }}').then(function (response) {
    //                 this.messages = response.data.messages;
    //                 this.mlmuser = response.data.mlmuser;
    //                 this.admin = response.data.admin;

    //             }.bind(this));
    //         },

    //         addMessage(message,receiver_id) {
    //             axios.post('{{ route("userchat.store") }}', { message }).then(function (response) {
    //                 this.messages.push({
    //                     message: response.data.message.message
    //                 });
    //             }.bind(this));
    //         },

    //         sendMessage() {
    //             this.addMessage(this.newMessage,this.receiverId);
    //             this.newMessage = '';
    //             this.receiverId = '';
    //         }
    //     };
    // }
</script>
@endsection