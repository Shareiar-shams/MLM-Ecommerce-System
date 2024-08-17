<nav x-data="{ open: false }" class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Primary Navigation Menu -->
    <!-- Left navbar links -->
    <ul class="navbar-nav">
	    <li class="nav-item">
	        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
	    </li>
      	<li class="nav-item d-none d-sm-inline-block">
        	<a href="{{ route('admin.home') }}" class="nav-link">Home</a>
      	</li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      	<!-- Navbar Search -->
      	<li class="nav-item">
      		<x-ad-nav-link data-widget="navbar-search"  role="button">
                <i class="fas fa-search"></i>
            </x-ad-nav-link>

	        <div class="navbar-search-block">
		        <form class="form-inline">
		            <div class="input-group input-group-sm">
		            	<x-text-input class="form-control form-control-navbar" type="search" name="search" placeholder="Search" aria-label="Search" required autofocus autocomplete="search" />

			            <div class="input-group-append">
			                <x-ad-nevigation-button>
			                  	<i class="fas fa-search"></i>
			                </x-ad-nevigation-button>
			                <x-ad-nevigation-button data-widget="navbar-search">
			                  	<i class="fas fa-times"></i>
			                </x-ad-nevigation-button>
			            </div>
		            </div>
		        </form>
	        </div>
      	</li>

	    <!-- Messages Dropdown Menu -->
	    <li class="nav-item dropdown">
	    	<x-ad-nav-link data-toggle="dropdown">
                <i class="far fa-comments"></i>
	          <span class="badge badge-danger navbar-badge">{{$notifications->count()}}</span>
            </x-ad-nav-link>

	        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
	        	@foreach($notifications as $notification)
		        <a href="{{route('userchat.show',$notification->sender_id)}}" class="dropdown-item">
		            <!-- Message Start -->
		            <div class="media">
		              	<img @if(isset($notification->mlmuser->user->profile_image))src="{{Storage::disk('local')->url($notification->mlmuser->user->profile_image)}}" @else src="{{Vite::asset('resources/dist/img/noimage.jpg')}}" @endif alt="User Avatar" class="img-size-50 mr-3 img-circle">
			            <div class="media-body">
			                <h3 class="dropdown-item-title">
			                  	{{$notification->mlmuser->user->name}}
			                  	<span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
			                </h3>
			                <p class="text-sm">{{ getLastMessage($notification) }}</p>
			                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $notification->created_at)->format('j M g:i a') }}</p>
			            </div>
		            </div>
		            <!-- Message End -->
		        </a>
		        @endforeach
	          	<div class="dropdown-divider"></div>
	          	<a href="{{route('userchat.index')}}" class="dropdown-item dropdown-footer">See All Messages</a>
	        </div>
	    </li>
      	<!-- Notifications Dropdown Menu -->
	    <li class="nav-item dropdown">

	        <a class="nav-link" data-toggle="dropdown" href="#">
	          	<i class="far fa-bell"></i>
	          	<span class="badge badge-warning navbar-badge">15</span>
	        </a>
	        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
	          	<span class="dropdown-item dropdown-header">15 Notifications</span>
	          	<div class="dropdown-divider"></div>
		        <a href="#" class="dropdown-item">
		            <i class="fas fa-envelope mr-2"></i> 4 new messages
		            <span class="float-right text-muted text-sm">3 mins</span>
		        </a>
	          	<div class="dropdown-divider"></div>
		        <a href="#" class="dropdown-item">
		            <i class="fas fa-users mr-2"></i> 8 friend requests
		            <span class="float-right text-muted text-sm">12 hours</span>
		        </a>
	          
	          	<div class="dropdown-divider"></div>
	          	<a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
	        </div>
	    </li>
	    <li class="nav-item">
	    	<x-ad-nav-link data-widget="fullscreen" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </x-ad-nav-link>
	    </li>
	    <li class="nav-item">
	    	<x-ad-nav-link data-widget="control-sidebar" data-controlsidebar-slide="true" role="button">
                <i class="fas fa-th-large"></i>
            </x-ad-nav-link>
	    </li>

	    <li class="pt-2 nav-item dropdown user user-menu">
          	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
	            @if(Auth::guard('admin')->user()->image != 'noimage.jpg')
	                <img src="{{Storage::disk('local')->url(Auth::guard('admin')->user()->image)}}" class="user-image" alt="User Image">
	            @else
	                <img src="{{Vite::asset('resources/dist/img/avatar4.png')}}" class="user-image" alt="User Image">
	            @endif
          	</a>
            <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                    @if(Auth::guard('admin')->user()->image != 'noimage.jpg')
                        <img src="{{Storage::disk('local')->url(Auth::guard('admin')->user()->image)}}" class="img-circle" alt="User Image">
                    @else
                        <img src="{{Vite::asset('resources/dist/img/avatar4.png')}}" class="img-circle" alt="User Image">
                    @endif
                    <p>
                      	{{ Auth::guard('admin')->user()->name }} - {{Auth::guard('admin')->user()->position}}
                    </p>
                </li>
                <li class="user-footer flex row ml-1">
                    <div class="pull-left">
                    	<x-ad-nav-link href="{{route('admin.profile')}}" class="btn btn-default btn-flat">
			                Profile
			            </x-ad-nav-link>
                    </div>
                    <div class="pull-right ml-5">
                    	<!-- Authentication -->
                    	<div class="btn btn-default btn-flat">
                    		
			                <form method="POST" action="{{ route('admin.logout') }}">
			                    @csrf

			                    <x-responsive-nav-link :href="route('admin.logout')"
			                            onclick="event.preventDefault();
			                                        this.closest('form').submit();">
			                        {{ __('Log Out') }}
			                    </x-responsive-nav-link>
			                </form>
                    	</div>

                    </div>
                </li>
            </ul>
        </li>
    </ul>

</nav>
