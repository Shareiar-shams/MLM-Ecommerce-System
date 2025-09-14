@extends('admin.layouts.main')
@section('admin_title_content')
    AHVision | Dashboard Profile
@endsection
@section('admin_content_header')
  <div class="col-sm-6">
    <h1 class="m-0">Profile</h1>
  </div><!-- /.col -->
  @php 
    $list = json_encode(['Home', 'Dashboard', 'Profile']);
  @endphp
  <x-ad-breadcrumb :list="$list"/>
@endsection

@section('admin_vendor_css')
@endsection

@section('admin_custom_css')
@endsection

@section('admin_main_content')
	@include('admin.validationError.error')
    <!-- container-fluid -->
	<div class="container-fluid">
        <div class="row">
	        <div class="col-md-3">
	            <!-- Profile Image -->
	            <div class="card card-primary card-outline">
		            <div class="card-body box-profile">
		                <div class="text-center">
		                  	<form action="{{route('admin.image.update', Auth::guard('admin')->user()->id)}}" method="post" enctype="multipart/form-data">
								@csrf
                                @method('PUT')
				            	<p><input type="file" accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;" required></p>

				            	@if(Auth::guard('admin')->user()->image != 'noimage.jpg')
					              	<label for="file" style="cursor: pointer; display: inline;"><img src="{{Storage::disk('local')->url(Auth::guard('admin')->user()->image)}}" class="profile-user-img img-responsive img-circle" alt="User profile picture" id="output"></label>
					            @else
					              	<label for="file" style="cursor: pointer; display: inline;"><img src="{{asset('admin/dist/img/avatar4.png')}}" class="profile-user-img img-responsive img-circle" alt="User profile picture" id="output"></label>
					            @endif

								<input type="submit" class="btn btn-primary btn-block" style="font-weight: bold;" value="Change Profile Picture">
							</form>
		                </div>
		                <h3 class="profile-username text-center">{{Auth::guard('admin')->user()->name}}</h3>

				        <p class="text-muted text-center">{{Auth::guard('admin')->user()->position}}</p>
				        <p class="text-muted text-center"> {{Auth::guard('admin')->user()->phone}}</p>

		            </div>
		            <!-- /.card-body -->
	            </div>
	            <!-- /.card -->

	            <!-- About Me Box -->
	            <div class="card card-primary">
		            <div class="card-header">
		                <h3 class="card-title">About Me</h3>
		            </div>
	              	<!-- /.card-header -->
	              	<div class="card-body">
	                	<strong><i class="fas fa-book mr-1"></i> Education</strong>

	                	<p class="text-muted">
	                  		B.S. in Computer Science from the University of Tennessee at Knoxville
	                	</p>

	                	<hr>

	                	<strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

		                <p class="text-muted">
		                  	<span class="tag tag-danger">UI Design</span>
		                  	<span class="tag tag-success">Coding</span>
		                  	<span class="tag tag-info">Javascript</span>
		                  	<span class="tag tag-warning">PHP</span>
		                  	<span class="tag tag-primary">Node.js</span>
		                </p>
                    </div>
	              	<!-- /.card-body -->
	            </div>
	            <!-- /.card -->
	        </div>
          	<!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Settings</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Change Password</a></li>
                            <li class="nav-item"><a class="nav-link" href="#preferences" data-toggle="tab">Preferences</a></li>
                            <li class="nav-item"><a class="nav-link" href="#delete_account" data-toggle="tab">Delete Account</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                @include('admin.profile.partials.settings')
                            </div>
                            <div class="tab-pane" id="settings">
                                @include('admin.profile.partials.change_password')
                            </div>
                            <div class="tab-pane" id="preferences">
                                @include('admin.profile.partials.preferences')
                            </div>
                            <div class="tab-pane" id="delete_account">
                                @include('admin.profile.partials.delete_account')
                            </div>
                        </div>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- Activity Log Section -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Recent Activity</h3>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Logged in from IP 192.168.1.10 - 5 mins ago</li>
                            <li class="list-group-item">Changed password - 2 days ago</li>
                            <li class="list-group-item">Updated profile picture - 1 week ago</li>
                            <li class="list-group-item">Deleted a blog post - 2 weeks ago</li>
                        </ul>
                    </div>
                </div>
                <!-- /.Activity Log Section -->
            </div>
          	<!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection

@section('admin_vendor_js')
	<script>
		var loadFile = function(event) {
			var image = document.getElementById('output');
			image.src = URL.createObjectURL(event.target.files[0]);
		};
	</script>
@endsection