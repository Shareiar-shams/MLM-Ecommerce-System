@php
    $url = request()->url();
    $segments = explode('/', $url);
    $categorySlug = end($segments);
@endphp
<section class="header_section">

	<nav class="navbar navbar-expand-lg navbar-light bg-light">

	    <div class="container">

		    <a class="navbar-brand" href="{{route('main')}}">

		        <img src="{{$logoPath}}">

		    </a>

	      	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">

	        	<span class="navbar-toggler-icon"></span>

	      	</button>
	      	<!-- Menu PART -->
		    @include('user.layouts.includeFile.menu')
		    <!-- END Menu PART -->
	      	

	      	<div class="navbar-right">

		        <ul>

		          	<li>

		           		<form action="{{route('product_search',$categorySlug)}}" method="get" accept-charset="utf-8">
		           			@csrf
				           	<div class="search">
			           			
				              	<input type="text" name="search" class="searchTerm searchT" placeholder="Search by product name">
				              	<div style="display: none;" id="seachResult" class="serch-result">
					           		<div class="s-r-inner">
									    <div class="product-card p-col">
									    	
									        		
									    </div>
									    
									</div>
									<div class="bottom-area">
										
									    <button type="submit">View all result</button>
									</div>
								</div>
				              	<button type="submit" class="searchButton icon">
				                	<i class="fa fa-search"></i>
				             	</button>
				           	</div>

				           	
		           		</form>

		           		
			          	<div class="search_box">
			            	<div id="search-menu">
					            <div class="wrapper">
					            	<form action="{{route('product_search',$categorySlug)}}" method="get" accept-charset="utf-8">
					           			@csrf
						                <input id="popup-search" type="text" name="search" placeholder="Search for a user" class="searchT" />
						                <div style="margin-top: 30px;" style="display: none;" id="seachResult" class="serch-result">
							           		<div class="s-r-inner">
											    <div class="product-card p-col">
											    	
											        		
											    </div>
											    
											</div>
											
										</div>
						                <button id="popup-search-button"  type="submit" name="search"><i class="fa fa-search"></i></button>

						            </form>
					            </div>
			          		</div>
			          		<i class="fa fa-search" id="search-icon"></i>
			          	</div>

			          	
		          	</li>
		          	{{-- @if(Auth::check()) --}}
			        {{-- <li class="toolbar-item">
			            <a href="#">
			            	<i class="fa fa-bell"></i>
		                </a>
		                <span class="count CartCount">{{count($adminPaidTransactions) + count($newUsers)}}</span>
		                <div class="toolbar-dropdown cart-dropdown widget-cart  cart_view_header" id="header_cart_load" data-target="">
		                	@foreach($newUsers as $notification)
	                       	<div class="entry">
		                        <div class="entry-content">
		                            <h4 class="entry-title">
	                                	New User {{ $notification->user->name }} assign under you.
		                            </h4>
		                        </div>
	                       	</div>
	                       	@endforeach
	                       	
		                	@foreach($adminPaidTransactions as $notification)
	                       	<div class="entry">
		                        <div class="entry-content">
		                            <h4 class="entry-title">
	                                	Admin Pay &#2547;{{ $notification->amount }} TK to you for {{ $notification->user->name }}
		                            </h4>
		                        </div>
	                       	</div>
	                       	@endforeach
	                       	
		                    <div class="d-flex justify-content-between">
		                        <div class="d-block">
		                        	<a class="btn btn-primary btn-sm  mb-0" href="#">
		                        		<span>View All Notifications</span>
		                        	</a>
		                        </div>
		                    </div>
		                </div>

			        </li> --}}
			        {{-- @endif --}}
			        <li>
			        </li>

			        <li>

			            <a href="{{route('wishlist')}}">

			              	<i class="fa fa-heart-o" aria-hidden="true"></i>

			            </a>

			        </li>
			        
		          	<li class="toolbar-item" id="cart-session-display">
		                {{-- <a href="#">
		                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
		                </a> --}}
		                @include('user.layouts.includeFile.cart-drop')
		                
		            </li>

		        </ul>

	      	</div>

	    </div>

	</nav>

</section>