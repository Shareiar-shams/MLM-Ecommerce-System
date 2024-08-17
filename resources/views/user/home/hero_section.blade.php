
<section class="hero_area">

  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

    <div class="carousel-inner">
    	@forelse($sliders as $slider)
		    <div class="carousel-item {{ $slider->active_slide ? 'active' : '' }}">

		        <img src="{{Storage::disk('local')->url($slider->featured_image)}}" alt="{{$loop->index}} slide">

		        <div class="carousel-caption d-none d-md-block">

		          	{{-- <h5>{{$slider->title}}</h5>

		          	<h2>{{$slider->description}}</h2> --}}

		          	<a  href="{{ isset($slider->link) ? $slider->link : '#' }}">Buy Now</a>

		        </div>

		    </div>
		@empty
		    <div class="carousel-item active">

		        <img src="{{asset('viewport/img/banner/firstbanner.png')}}" alt="First slide">

		        <div class="carousel-caption d-none d-md-block">

		          	<!-- <h5>START A FREE TRIAL AND ENJOY</h5>

		          	<h2> 3 months of Shopify for $1/month</h2> -->

		          	<a  href="{{ isset($forbannerLink) ? route('mlmproduct', $forbannerLink->slug) : '#' }}">Buy Now</a>

		        </div>

		    </div>
	    @endforelse	

      

    </div>

    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">

      <span class="carousel-control-prev-icon" aria-hidden="true"></span>

      <span class="sr-only">Previous</span>

    </a>

    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">

      <span class="carousel-control-next-icon" aria-hidden="true"></span>

      <span class="sr-only">Next</span>

    </a>

  </div>

</section>
