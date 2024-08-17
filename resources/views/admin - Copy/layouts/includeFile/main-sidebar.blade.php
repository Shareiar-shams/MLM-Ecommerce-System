<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
    	
      	<img src="{{Vite::asset('resources/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      	<span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
	    <!-- Sidebar user panel (optional) -->
	    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
	        <div class="image">
	        	@if(Auth::guard('admin')->user()->image != 'noimage.jpg')

		            <img src="{{Storage::disk('local')->url(Auth::guard('admin')->user()->image)}}"  class="img-circle elevation-2" alt="User Image">
		        @else
	          		<img src="{{Vite::asset('resources/dist/img/avatar4.png')}}" class="img-circle elevation-2" alt="User Image">
	          	@endif
	        </div>
	        <div class="info">
	          	<a href="{{route('admin.profile')}}" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
	        </div>
	    </div>

	    <!-- SidebarSearch Form -->
	    <div class="form-inline">
	        <div class="input-group" data-widget="sidebar-search">
	        	<x-text-input class="form-control form-control-navbar" type="search" name="search" placeholder="Search" aria-label="Search" required autofocus autocomplete="search" />

	          	<div class="input-group-append">
	          		<x-ad-nevigation-button class="btn btn-sidebar">
	                  	<i class="fas fa-search fa-fw"></i>
	                </x-ad-nevigation-button>
		        </div>
	        </div>
	    </div>

	    <!-- Sidebar Menu -->
	    <nav class="mt-2">
	        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
	          	<!-- Add icons to the links using the .nav-icon class
	               with font-awesome or any other icon font library -->

		        <li class="nav-item">
		        	<x-ad-nav-link href="{{route('admin.home')}}" class="nav-link {{ Route::currentRouteNamed( 'admin.home' ) ?  'active' : '' }}">
		              <i class="nav-icon fas fa-tachometer-alt"></i>
		              <p>
		                Dashboard
		              </p>
		            </x-ad-nav-link>
		        </li>
		        <li class="nav-item">
		            <a href="pages/widgets.html" class="nav-link">
		              <i class="nav-icon fas fa-th"></i>
		              <p>
		                Widgets
		                <span class="right badge badge-danger">New</span>
		              </p>
		            </a>
		        </li>
		        <li class="nav-item">
		            <x-ad-nav-link class="nav-link">
		              	<svg xmlns="http://www.w3.org/2000/svg" height="1.25em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ece4e4}</style><path d="M87 481.8h73.7v-73.6H87zM25.4 346.6v61.6H87v-61.6zm466.2-169.7c-23-74.2-82.4-133.3-156.6-156.6C164.9-32.8 8 93.7 8 255.9h95.8c0-101.8 101-180.5 208.1-141.7 39.7 14.3 71.5 46.1 85.8 85.7 39.1 107-39.7 207.8-141.4 208v.3h-.3V504c162.6 0 288.8-156.8 235.6-327.1zm-235.3 231v-95.3h-95.6v95.6H256v-.3z"/></svg>
		              	<p class="pl-2">
		                	Digital Product
		                	<i class="fas fa-angle-left right"></i>
		              	</p>
		            </x-ad-nav-link>
		            <ul class="nav nav-treeview">
		              	<li class="nav-item">
		              		<a href="{{route('digitalproduct.create')}}" class="nav-link {{ Route::currentRouteNamed( 'digitalproduct.create' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Add Digital Product</p>
		                	</a>
		              	</li>
			            <li class="nav-item">
			                <a href="{{route('digitalproduct.index')}}" class="nav-link {{ Route::currentRouteNamed( 'digitalproduct.index' ) ?  'active' : '' }}">
			                  	<i class="far fa-circle nav-icon"></i>
			                  	<p>All Digital Product</p>
			                </a>
			            </li>

			            <li class="nav-item">
			                <a href="{{route('productoffer.index')}}" class="nav-link {{ Route::currentRouteNamed( 'productoffer.index' ) ?  'active' : '' }}">
			                  	<i class="far fa-circle nav-icon"></i>
			                  	<p>Digital Product Offer</p>
			                </a>
			            </li>
		              	{{-- <li class="nav-item">
			                <x-ad-nav-link href="pages/layout/top-nav.html" class="nav-link">
			                  	<i class="far fa-circle nav-icon"></i>
			                  	<p>Campaign Offer</p>
			                </x-ad-nav-link>
		              	</li> --}}
		            </ul>
		        </li>

		        <li class="nav-item">
		            <x-ad-nav-link class="nav-link">
		              	<i class="nav-icon fas fa-users"></i>
		              	<p class="pl-2">
		                	MLM User
		                	<i class="fas fa-angle-left right"></i>
		              	</p>
		            </x-ad-nav-link>
		            <ul class="nav nav-treeview">
		              	<li class="nav-item">
		              		<a href="{{route('adminmlm.index')}}" class="nav-link {{ Route::currentRouteNamed( 'adminmlm.index' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>All MLM Users</p>
		                	</a>
		              	</li>
		              	<li class="nav-item">
		              		<a href="{{route('adminmlm.create')}}" class="nav-link {{ Route::currentRouteNamed( 'adminmlm.create' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Special MLM Users</p>
		                	</a>
		              	</li>
		              	<li class="nav-item">
		              		<a href="{{route('adminmlm.active')}}" class="nav-link {{ Route::currentRouteNamed( 'adminmlm.active' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Active MLM Users</p>
		                	</a>
		              	</li>
		              	<li class="nav-item">
		              		<a href="{{route('adminmlm.inactivebyadmin')}}" class="nav-link {{ Route::currentRouteNamed( 'adminmlm.inactivebyadmin' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Inactive By Admin MLM Users</p>
		                	</a>
		              	</li>
		              	<li class="nav-item">
		              		<a href="{{route('adminmlm.inactivebyparent')}}" class="nav-link {{ Route::currentRouteNamed( 'adminmlm.inactivebyparent' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Inactive By Parent MLM Users</p>
		                	</a>
		              	</li>
			            <li class="nav-item">
			                <a href="{{route('userchat.index')}}" class="nav-link {{ Route::currentRouteNamed( 'userchat.index' ) ?  'active' : '' }}">
			                  	<i class="far fa-circle nav-icon"></i>
			                  	<p>All Users Messages</p>
			                </a>
			            </li>
		              	{{-- <li class="nav-item">
			                <x-ad-nav-link href="pages/layout/top-nav.html" class="nav-link">
			                  	<i class="far fa-circle nav-icon"></i>
			                  	<p>Campaign Offer</p>
			                </x-ad-nav-link>
		              	</li> --}}
		            </ul>
		        </li>

		        <li class="nav-item">
		        	<x-ad-nav-link href="{{route('transections.index')}}" class="nav-link {{ Route::currentRouteNamed( 'transections.index' ) ?  'active' : '' }}">
		              
		              <i class="nav-icon fas fa-random"></i>
		              <p>
		                Transactions
		              </p>
		            </x-ad-nav-link>
		        </li>

		        {{-- <li class="nav-item">
		            <a href="#" class="nav-link">
		              <i class="nav-icon far fa-plus-square"></i>
		              <p>
		                Extras
		                <i class="fas fa-angle-left right"></i>
		              </p>
		            </a>
		            <ul class="nav nav-treeview">
		              <li class="nav-item">
		                <a href="#" class="nav-link">
		                  <i class="far fa-circle nav-icon"></i>
		                  <p>
		                    Login & Register v1
		                    <i class="fas fa-angle-left right"></i>
		                  </p>
		                </a>
		                <ul class="nav nav-treeview">
		                  <li class="nav-item">
		                    <a href="pages/examples/login.html" class="nav-link">
		                      <i class="far fa-circle nav-icon"></i>
		                      <p>Login v1</p>
		                    </a>
		                  </li>
		                  <li class="nav-item">
		                    <a href="pages/examples/register.html" class="nav-link">
		                      <i class="far fa-circle nav-icon"></i>
		                      <p>Register v1</p>
		                    </a>
		                  </li>
		                  <li class="nav-item">
		                    <a href="pages/examples/forgot-password.html" class="nav-link">
		                      <i class="far fa-circle nav-icon"></i>
		                      <p>Forgot Password v1</p>
		                    </a>
		                  </li>
		                  <li class="nav-item">
		                    <a href="pages/examples/recover-password.html" class="nav-link">
		                      <i class="far fa-circle nav-icon"></i>
		                      <p>Recover Password v1</p>
		                    </a>
		                  </li>
		                </ul>
		              </li>
		              <li class="nav-item">
		                <a href="#" class="nav-link">
		                  <i class="far fa-circle nav-icon"></i>
		                  <p>
		                    Login & Register v2
		                    <i class="fas fa-angle-left right"></i>
		                  </p>
		                </a>
		                <ul class="nav nav-treeview">
		                  <li class="nav-item">
		                    <a href="pages/examples/login-v2.html" class="nav-link">
		                      <i class="far fa-circle nav-icon"></i>
		                      <p>Login v2</p>
		                    </a>
		                  </li>
		                  <li class="nav-item">
		                    <a href="pages/examples/register-v2.html" class="nav-link">
		                      <i class="far fa-circle nav-icon"></i>
		                      <p>Register v2</p>
		                    </a>
		                  </li>
		                  <li class="nav-item">
		                    <a href="pages/examples/forgot-password-v2.html" class="nav-link">
		                      <i class="far fa-circle nav-icon"></i>
		                      <p>Forgot Password v2</p>
		                    </a>
		                  </li>
		                  <li class="nav-item">
		                    <a href="pages/examples/recover-password-v2.html" class="nav-link">
		                      <i class="far fa-circle nav-icon"></i>
		                      <p>Recover Password v2</p>
		                    </a>
		                  </li>
		                </ul>
		              </li>
		              <li class="nav-item">
		                <a href="pages/examples/lockscreen.html" class="nav-link">
		                  <i class="far fa-circle nav-icon"></i>
		                  <p>Lockscreen</p>
		                </a>
		              </li>
		              <li class="nav-item">
		                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
		                  <i class="far fa-circle nav-icon"></i>
		                  <p>Legacy User Menu</p>
		                </a>
		              </li>
		              <li class="nav-item">
		                <a href="pages/examples/language-menu.html" class="nav-link">
		                  <i class="far fa-circle nav-icon"></i>
		                  <p>Language Menu</p>
		                </a>
		              </li>
		              <li class="nav-item">
		                <a href="pages/examples/404.html" class="nav-link">
		                  <i class="far fa-circle nav-icon"></i>
		                  <p>Error 404</p>
		                </a>
		              </li>
		              <li class="nav-item">
		                <a href="pages/examples/500.html" class="nav-link">
		                  <i class="far fa-circle nav-icon"></i>
		                  <p>Error 500</p>
		                </a>
		              </li>
		              <li class="nav-item">
		                <a href="pages/examples/pace.html" class="nav-link">
		                  <i class="far fa-circle nav-icon"></i>
		                  <p>Pace</p>
		                </a>
		              </li>
		              <li class="nav-item">
		                <a href="pages/examples/blank.html" class="nav-link">
		                  <i class="far fa-circle nav-icon"></i>
		                  <p>Blank Page</p>
		                </a>
		              </li>
		              <li class="nav-item">
		                <a href="starter.html" class="nav-link">
		                  <i class="far fa-circle nav-icon"></i>
		                  <p>Starter Page</p>
		                </a>
		              </li>
		            </ul>
		        </li> --}}
		        <li class="nav-item">
		        	<x-ad-nav-link href="{{route('customers.list')}}" class="nav-link {{ Route::currentRouteNamed( 'customers.list' ) ?  'active' : '' }}">
		              
		              <i class="nav-icon fas fa-users"></i>
		              <p>
		                Customers List
		              </p>
		            </x-ad-nav-link>
		        </li>
	        </ul>
	    </nav>
	    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
