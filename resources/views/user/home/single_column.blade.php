<div class="container">
    @if(isset($single_banner))
    	<div class="banner_bg_img" style="background-image: url({{Storage::disk('local')->url($single_banner->bg_image)}});">

		    <div class="banner_content">

		       <div class="content_banner">

		          	<h4>{{$single_banner->heading}}</h4>

		          	<p>{{$single_banner->sub_heading}}</p>

		          	<a class="custom-btn btn_button" href="{{$single_banner->button_url}}">{{$single_banner->button_name}}</a>

		        </div>

		    </div>

	    </div>
	@else
    	{{-- <div class="banner_bg_img" style="background-image: url(../img/banner.jpg);">

		    <div class="banner_content">

		       <div class="content_banner">

		          	<h4>WOMEN TOPS</h4>

		          	<p>From world's top designer</p>

		          	<a class="custom-btn btn_button" href="#">Buy Now</a>

		        </div>

		    </div>

	    </div> --}}

    @endif

</div>