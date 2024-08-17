<div class="top_bar">

	<div class="container">

	    <div class="row">

		    <div class="col-md-6">

		        <div class="left_top_bar">

			        <ul>

			            <li><a title="Track Your Order" href="{{route('orderTrack')}}"><i class="fa fa-truck" aria-hidden="true"></i>Track Your Order</a></li>

			        </ul>

		        </div>

		    </div>

		    <div class="col-md-6">

		        <div class="right_top_bar">

			        <ul>

			            <li><a title="Shop" href="{{route('products')}}"><i class="fa fa-shopping-bag" aria-hidden="true"></i>Shop</a></li>
			            <li class="ment_plus">
			            	
				            @if (Route::has('login'))
			                    @auth
			                        <a href="{{ url('/dashboard') }}"><i class="fa fa-user-o" aria-hidden="true"></i>Dashboard</a>
			                    @else
			                        <a href="{{ route('login') }}"><i class="fa fa-user-o" aria-hidden="true"></i>Log in</a>

			                    @endauth
				            @endif
				        </li>

		            </ul>

		        </div>

		    </div>

	    </div>

	</div>

</div>