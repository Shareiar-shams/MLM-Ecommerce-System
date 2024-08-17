<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
    	
      	<img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      	<span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
	    <!-- Sidebar user panel (optional) -->
	    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
	        <div class="image">
	        	@if(Auth::guard('admin')->user()->image != 'noimage.jpg')

		            <img src="{{Storage::disk('local')->url(Auth::guard('admin')->user()->image)}}"  class="img-circle elevation-2" alt="User Image">
		        @else
	          		<img src="{{asset('admin/dist/img/avatar4.png')}}" class="img-circle elevation-2" alt="User Image">
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
		            {{-- <a href="pages/widgets.html" class="nav-link">
		              <i class="nav-icon fas fa-th"></i>
		              <p>
		                Widgets
		                <span class="right badge badge-danger">New</span>
		              </p>
		            </a> --}}
		            <x-ad-nav-link class="nav-link">
		            	<i  class='fas fa-list-alt'></i>
		              	<p class="pl-2">
		                	Manage Categories
		                	<i class="fas fa-angle-left right"></i>
		              	</p>
		            </x-ad-nav-link>
		            <ul class="nav nav-treeview">
		              	<li class="nav-item">
		              		<a href="{{route('categories.index')}}" class="nav-link {{ Route::currentRouteNamed( 'categories.index' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Categories</p>
		                	</a>
		              	</li>
		            </ul>
		        </li>

		        <li class="nav-item">
		            <x-ad-nav-link class="nav-link">
		            	<i  class='fas fa-list-alt'></i>
		              	<p class="pl-2">
		                	Manage Product Type
		                	<i class="fas fa-angle-left right"></i>
		              	</p>
		            </x-ad-nav-link>
		            <ul class="nav nav-treeview">
		              	<li class="nav-item">
		              		<a href="{{route('type.index')}}" class="nav-link {{ Route::currentRouteNamed( 'type.index' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Product Type List</p>
		                	</a>

		                	<a href="{{route('type.create')}}" class="nav-link {{ Route::currentRouteNamed( 'type.create' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Create Product Type</p>
		                	</a>
		              	</li>
		            </ul>
		        </li>

		        <li class="nav-item">
		            <x-ad-nav-link class="nav-link">
		            	<i  class='fab fa-product-hunt'></i>
		              	<p class="pl-2">
		                	Manage Product
		                	<i class="fas fa-angle-left right"></i>
		              	</p>
		            </x-ad-nav-link>
		            <ul class="nav nav-treeview">
		              	<li class="nav-item">
		              		<a href="{{route('item.add')}}" class="nav-link {{ Route::currentRouteNamed( 'item.add' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Add Product</p>
		                	</a>
		              	</li>

		              	<li class="nav-item">
		              		<a href="{{route('item.index')}}" class="nav-link {{ Route::currentRouteNamed( 'item.index' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>All Products</p>
		                	</a>
		              	</li>

		              	<li class="nav-item">
		              		<a href="{{route('product.stock.out')}}" class="nav-link {{ Route::currentRouteNamed( 'product.stock.out' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Stock Out Products</p>
		                	</a>
		              	</li>

		              	<li class="nav-item">
		              		<a href="{{route('product.campaign.offer')}}" class="nav-link {{ Route::currentRouteNamed( 'product.campaign.offer' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Campaign Offer</p>
		                	</a>
		              	</li>

		              	<li class="nav-item">
		              		<a href="{{route('product.import.export')}}" class="nav-link {{ Route::currentRouteNamed( 'product.import.export' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>CSV Import & Export</p>
		                	</a>
		              	</li>

		              	<li class="nav-item">
		              		<a href="{{route('review.index')}}" class="nav-link {{ Route::currentRouteNamed( 'review.index' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Product Reviews</p>
		                	</a>
		              	</li>
		            </ul>
		        </li>

		        <li class="nav-item">
		            <x-ad-nav-link class="nav-link">
		            	<i  class='fab fa-first-order'></i>
		              	<p class="pl-2">
		                	Manage Orders 
		                	<i class="fas fa-angle-left right"></i>
		              	</p>
		            </x-ad-nav-link>
		            <ul class="nav nav-treeview">
		              	<li class="nav-item">
		              		<a href="{{route('orders.index')}}" class="nav-link {{ Route::currentRouteNamed( 'orders.index' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>All Orders</p>
		                	</a>
		              	</li>

		              	<li class="nav-item">
		              		<a href="{{route('orders.type', ['type' => 'Pending'])}}" class="nav-link {{ Route::currentRouteNamed( 'orders.type', ['type' => 'Pending'] ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Pending Orders</p>
		                	</a>
		              	</li>

		              	<li class="nav-item">
		              		<a href="{{route('orders.type', ['type' => 'Processing_Order'])}}" class="nav-link {{ Route::currentRouteNamed( 'orders.type', ['type' => 'Processing_Order'] ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Progress Orders</p>
		                	</a>
		              	</li>

		              	<li class="nav-item">
		              		<a href="{{route('orders.type', ['type' => 'Delivery_in_progess'])}}" class="nav-link {{ Route::currentRouteNamed( 'orders.type', ['type' => 'Delivery_in_progess'] ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Delivered Orders</p>
		                	</a>
		              	</li>

		              	<li class="nav-item">
		              		<a href="{{route('orders.type', ['type' => 'Canceled'])}}" class="nav-link {{ Route::currentRouteNamed( 'orders.type', ['type' => 'Canceled'] ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Canceled Orders</p>
		                	</a>
		              	</li>

		              	<li class="nav-item">
		              		<a href="{{route('orders.type.customize_orders')}}" class="nav-link {{ Route::currentRouteNamed( 'orders.type.customize_orders') ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Customize Orders</p>
		                	</a>
		              	</li>
		            </ul>
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

		        <li class="nav-item">
		            <x-ad-nav-link class="nav-link">
		              	<i class="nav-icon fas fa-newspaper"></i>
		              	<p class="pl-2">
		                	Ecommerce
		                	<i class="fas fa-angle-left right"></i>
		              	</p>
		            </x-ad-nav-link>
		            <ul class="nav nav-treeview">
		              	<li class="nav-item">
		              		<a href="{{route('code.index')}}" class="nav-link {{ Route::currentRouteNamed( 'code.index' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Set Coupons</p>
		                	</a>
		              	</li>
		              	<li class="nav-item">
		              		<a href="{{route('shipping.index')}}" class="nav-link {{ Route::currentRouteNamed( 'shipping.index' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Shipping</p>
		                	</a>
		              	</li>
		              	{{-- <li class="nav-item">
		              		<a href="{{route('adminmlm.active')}}" class="nav-link {{ Route::currentRouteNamed( 'adminmlm.active' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>State</p>
		                	</a>
		              	</li>
		              	<li class="nav-item">
		              		<a href="{{route('adminmlm.inactivebyadmin')}}" class="nav-link {{ Route::currentRouteNamed( 'adminmlm.inactivebyadmin' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Tax</p>
		                	</a>
		              	</li> --}}
		              	<li class="nav-item">
		              		<a href="{{route('payment.index')}}" class="nav-link {{ Route::currentRouteNamed( 'payment.index' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Payment</p>
		                	</a>
		              	</li>
			            
		            </ul>
		        </li>
		        <li class="nav-item">
		            <x-ad-nav-link class="nav-link">
		            	<i class='nav-icon fas fa-ticket-alt'></i>
		              	<p class="pl-2">
		                	Tickets
		                	<i class="fas fa-angle-left right"></i>
		              	</p>
		            </x-ad-nav-link>
		            <ul class="nav nav-treeview">
		              	<li class="nav-item">
		              		<a href="{{route('ticket.index')}}" class="nav-link {{ Route::currentRouteNamed( 'ticket.index' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>All Tickets</p>
		                	</a>
		              	</li>
		              	<li class="nav-item">
		              		<a href="{{route('ticket.create')}}" class="nav-link {{ Route::currentRouteNamed( 'ticket.create' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Create Ticket</p>
		                	</a>
		              	</li>

		              	<li class="nav-item">
		              		<a href="{{route('ticket-categories.index')}}" class="nav-link {{ Route::currentRouteNamed( 'ticket-categories.index' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>All Tickets Category</p>
		                	</a>
		              	</li>
		              	<li class="nav-item">
		              		<a href="{{route('ticket-categories.create')}}" class="nav-link {{ Route::currentRouteNamed( 'ticket-categories.create' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Create Category</p>
		                	</a>
		              	</li>

		              	<li class="nav-item">
		              		<a href="{{route('ticket-labels.index')}}" class="nav-link {{ Route::currentRouteNamed( 'ticket-labels.index' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>All Tickets Labels</p>
		                	</a>
		              	</li>
		              	<li class="nav-item">
		              		<a href="{{route('ticket-labels.create')}}" class="nav-link {{ Route::currentRouteNamed( 'ticket-labels.create' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Create Lebel</p>
		                	</a>
		              	</li>
		            </ul>
		        </li>

		        <li class="nav-item">
		            <a href="#" class="nav-link">
			            <i class="nav-icon far fa-plus-square"></i>
			            <p>
			                Manage Site
			                <i class="fas fa-angle-left right"></i>
			            </p>
		            </a>
		            <ul class="nav nav-treeview">
			            <li class="nav-item">
		              		<a href="{{route('system.index')}}" class="nav-link {{ Route::currentRouteNamed( 'system.index' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>General Settings</p>
		                	</a>
		              	</li>
			            <li class="nav-item">
		              		<a href="{{route('home-page.index')}}" class="nav-link {{ Route::currentRouteNamed( 'home-page.index' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Home Page</p>
		                	</a>
		              	</li>
			            <li class="nav-item">
		              		<a href="{{route('slider.index')}}" class="nav-link {{ Route::currentRouteNamed( 'slider.index' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Sliders</p>
		                	</a>
		              	</li>
			            {{-- <li class="nav-item">
			                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
			                  <i class="far fa-circle nav-icon"></i>
			                  <p>Services</p>
			                </a>
			            </li>
			            <li class="nav-item">
			                <a href="pages/examples/language-menu.html" class="nav-link">
			                  <i class="far fa-circle nav-icon"></i>
			                  <p>Visibility</p>
			                </a>
			            </li> --}}
			            <li class="nav-item">
			                <a href="{{route('social.index')}}" class="nav-link {{ Route::currentRouteNamed( 'social.index' ) ?  'active' : '' }}">
			                  <i class="far fa-circle nav-icon"></i>
			                  <p>Social Login</p>
			                </a>
			            </li>
			            <li class="nav-item">
			                <a href="{{route('email_configuration')}}" class="nav-link {{ Route::currentRouteNamed( 'email_configuration' ) ?  'active' : '' }}">
			                  <i class="far fa-circle nav-icon"></i>
			                  <p>Email Settings</p>
			                </a>
			            </li>
			            {{-- <li class="nav-item">
			                <a href="#" class="nav-link">
			                  <i class="far fa-circle nav-icon"></i>
			                  <p>SMS Settings</p>
			                </a>
			            </li> --}}
			            <li class="nav-item">
			                <a href="{{route('announcement')}}" class="nav-link {{ Route::currentRouteNamed( 'announcement' ) ?  'active' : '' }}">
			                  <i class="far fa-circle nav-icon"></i>
			                  <p>Announcement</p>
			                </a>
			            </li>
			            <li class="nav-item">
			                <a href="{{route('cookie.show')}}" class="nav-link {{ Route::currentRouteNamed( 'cookie.show' ) ?  'active' : '' }}">
			                  <i class="far fa-circle nav-icon"></i>
			                  <p>Cookies Alert</p>
			                </a>
			            </li>
			            <li class="nav-item">
			                <a href="#" class="nav-link">
			                  <i class="far fa-circle nav-icon"></i>
			                  <p>Maintainance</p>
			                </a>
			            </li>
			            <li class="nav-item">
			                <a href="#" class="nav-link">
			                  <i class="far fa-circle nav-icon"></i>
			                  <p>Sitemap</p>
			                </a>
			            </li>
		            </ul>
		        </li>

		        <li class="nav-item">
		            <a href="#" class="nav-link">
			            <i class="nav-icon fas fa-question-circle"></i>
			            
			            <p>
			                Manage Faqs
			                <i class="fas fa-angle-left right"></i>
			            </p>
		            </a>
		            <ul class="nav nav-treeview">
			            <li class="nav-item">
		              		<a href="{{route('faqcategory.index')}}" class="nav-link {{ Route::currentRouteNamed( 'faqcategory.index' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Categories</p>
		                	</a>
		              	</li>
			            <li class="nav-item">
		              		<a href="{{route('faq.index')}}" class="nav-link {{ Route::currentRouteNamed( 'faq.index' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Faqs</p>
		                	</a>
		              	</li>
		            </ul>
		        </li>

		        <li class="nav-item">
		        	<x-ad-nav-link href="{{route('page.index')}}" class="nav-link {{ Route::currentRouteNamed( 'page.index' ) ?  'active' : '' }}">
		              
		              <i class="nav-icon fas fa-book"></i>
		              <p>
		                Manages Pages
		              </p>
		            </x-ad-nav-link>
		        </li>

		        <li class="nav-item">
		        	<x-ad-nav-link href="{{route('icon.index')}}" class="nav-link {{ Route::currentRouteNamed( 'icon.index' ) ?  'active' : '' }}">
		              
		              <i class="nav-icon fas fa-play"></i>
		              <p>
		                Manages Social Icon
		              </p>
		            </x-ad-nav-link>
		        </li>
		        
		        <li class="nav-item">
		        	<x-ad-nav-link href="{{route('customers.list')}}" class="nav-link {{ Route::currentRouteNamed( 'customers.list' ) ?  'active' : '' }}">
		              
		              <i class="nav-icon fas fa-users"></i>
		              <p>
		                Customers List
		              </p>
		            </x-ad-nav-link>
		        </li>

		        <li class="nav-item">
		        	<x-ad-nav-link href="{{route('subscribers.list')}}" class="nav-link {{ Route::currentRouteNamed( 'subscribers.list' ) ?  'active' : '' }}">
		              
		              <i class="nav-icon fab fa-telegram-plane"></i>
		              <p>
		                Subscribers List
		              </p>
		            </x-ad-nav-link>
		        </li>

		        <li class="nav-item">
		        	<x-ad-nav-link href="{{route('user.mail.list')}}" class="nav-link {{ Route::currentRouteNamed( 'user.mail.list' ) ?  'active' : '' }}">
		              	<i class="nav-icon fas fa-envelope"></i>
		              	<p>
		                	E-Mail Lists
		              	</p>
		            </x-ad-nav-link>
		        </li>


		        <li class="nav-item">
		            <a href="#" class="nav-link">
			            <i class="nav-icon fas fa-user"></i>
			            
			            <p>
			                System User
			                <i class="fas fa-angle-left right"></i>
			            </p>
		            </a>
		            <ul class="nav nav-treeview">
		            	<li class="nav-item">
		              		<a href="{{route('permissions.index')}}" class="nav-link {{ Route::currentRouteNamed( 'permissions.index' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Permission</p>
		                	</a>
		              	</li>
			            <li class="nav-item">
		              		<a href="{{route('roles.index')}}" class="nav-link {{ Route::currentRouteNamed( 'roles.index' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>Role</p>
		                	</a>
		              	</li>
			            <li class="nav-item">
		              		<a href="{{route('admins.index')}}" class="nav-link {{ Route::currentRouteNamed( 'admins.index' ) ?  'active' : '' }}">
		                	
		                  		<i class="far fa-circle nav-icon"></i>
		                  		<p>System User</p>
		                	</a>
		              	</li>
		            </ul>
		        </li>


		        <li class="nav-item">
		        	<x-ad-nav-link href="{{route('cache.clear')}}" class="nav-link {{ Route::currentRouteNamed( 'cache.clear' ) ?  'active' : '' }}">
		              	<i class="nav-icon fas fa-broom"></i>
		              	<p>
		                	Cache Clear
		              	</p>
		            </x-ad-nav-link>
		        </li>
	        </ul>
	    </nav>
	    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
