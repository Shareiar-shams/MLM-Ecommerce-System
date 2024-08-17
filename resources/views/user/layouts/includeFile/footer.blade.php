<!-- footer section -->

<section class="footer_section">

	<div class="container">

	    <div class="row">

		    <div class="col-md-4">

		        <div class="footer_content_frist">

		          	<h2>Let’s get in touch</h2>

		          	<p>Sign up for our newsletter and receive up to 10% off your</p>

		          	<div class="subscription">

			            <form action="{{route('user_subscribe')}}" method="post">
		                    @csrf

			                <input type="email" name="email" placeholder="Enter your mail address" autocomplete="off" required />
	                        @error('email')
		                    <span class="text-danger">{{ $message}}</span>
		                    @enderror
			                <input type="submit" value="Submit" />

			            </form>  

		            </div>

		            <div class="socila_link">

		              	<ul>
		              		@forelse($icons as $icon)
			                	<li><a href="{{$icon->url}}">{!! $icon->icon !!}</a></li>
			                @empty
			                @endforelse
		              	</ul>

		            </div>

		        </div>

		    </div>

		    <div class="col-md-4">

		        <div class="footer_content_frist secound_step">

		          	<h2>Quick links</h2>

			        <div class="quick_link">

			            <ul>

			              	<li><a href="{{route('faq')}}">FAQ</a></li>

			              	<li><a href="{{route('products')}}">Shop</a></li>

			              	<li><a href="{{route('cart.index')}}">Cart</a></li>

			              	<li><a href="{{route('wishlist')}}">Wishlist</a></li>

			            </ul>

			        </div>

		        </div>

		    </div>

		    <div class="col-md-4">

		        <div class="footer_content_frist">

		          	<h2>Usefull Links</h2>

			        <div class="quick_link">

			            <ul>
			            	@forelse($pages as $page)
				              	<li><a href="{{route('DynamicPageView',$page->slug)}}">{{$page->title}}</a></li>
			            	@empty
			            	@endforelse

			            </ul>

			        </div>
		          	<div class="payment_detels">
			        	<img class="d-block gateway_image" src="https://geniusdevs.com/codecanyon/omnimart40/assets/images/16305963101621960148credit-cards-footer.png">

			            {{-- <a href="#"><img src="{{asset('viewport/img/visa.png')}}" alt=""></a>

			            <a href="#"><img src="{{asset('viewport/img/payonner.png')}}" alt=""></a>

			            <a href="#"><img src="{{asset('viewport/img/paypal.png')}}" alt=""></a>

			            <a href="#"><img src="{{asset('viewport/img/master-card.png')}}" alt=""></a> --}}

		          	</div>

		        </div>

		    </div>

	    </div>

	</div>

</section>