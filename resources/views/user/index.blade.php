@extends('user.layouts.layout')
@section('meta_property')
		<!-- SEO Meta Tags-->
	    <meta name="keywords" content="@if(isset($site_setting->index_meta_keyword)) @forelse(json_decode($site_setting->index_meta_keyword) as $keyword) {{$keyword}}, @empty @endforelse @endif">
	    <meta name="description" content="{{ isset($site_setting->index_meta_description) ? $site_setting->index_meta_description : ''}}">
@endsection

@section('user_title_content')
    {{$home_page_title}}
@endsection

@section('user_css_content')
	@include('user.home.css')
	
@endsection
@section('user_main_content')
	<!-- hero area -->
	@include('user.home.hero_section')

  <!-- mml all product -->

	@include('user.home.mlm_product')

	<!-- end mml all product -->

	<!-- deal of day section list -->
	@if(!empty($campaign) && $campaign->status != false && (! \Illuminate\Support\Carbon::parse($campaign->last_date)->isPast()))
	@include('user.home.deals')
   	@endif

    <!-- end deal of day section list -->
    <!-- product list -->

    <section class="product_list section-padding">

      	<div class="container">

	        <div class="section_title_collections Pt">
	        	@forelse($indexDatas as $indexdata)
                    @if($indexdata->mapping == 'category_selected')
                    	<h2>{{$indexdata->title}}</h2>
                    @endif
                @empty
                	<h2>Recent Product</h2>
                @endforelse
	          	

	        </div>

	        <div class="filters button-group" value-group="color">
			    <button data-name="*" class="button typeProduct is-checked">All</button>
			    @forelse($selectedCategories as $selectedCategories)
			        <button class="button typeProduct" data-name="{{ isset($selectedCategories->subcategory_id) ? $selectedCategories->subcategory->slug : $selectedCategories->category->slug}}">

			        	{{ isset($selectedCategories->subcategory_id) ? $selectedCategories->subcategory->name : $selectedCategories->category->name}}
			        </button>
			    @empty
			    @endforelse
			</div>
			<div class="tz-gallery" id="recentProduct">
		        @include('user.home.group_type_product')
		    </div>
		    <a id="viewAllButton" style="float: right;" class="custom-btn btn_button" href="{{route('products')}}">View All <i class="fa-solid fas-chevron-right"></i></a>
      	</div>

    </section>

    <!-- end product list -->

    <!-- new arrivals section -->

    <!-- slider section -->

	<section class="slider_section section-padding" id="slider_section">
		<div class="container">

		    <div class="section_title slider_title ">
		    	@forelse($indexDatas as $indexdata)
	                @if($indexdata->mapping == 'single_type')
	                	<h2>{{$indexdata->title}}</h2>
	                @endif
	            @empty
	            	<h2>NEW ARRIVALS</h2>
	            @endforelse
		        

		    </div>
   			@include('user.home.slider_selection')
   		</div>

	</section>

	<!-- slider section -->

	<!-- banner section -->

	<section class="banner_section section-padding">

		@include('user.home.single_column')

	</section>

	<!-- end banner section -->

	<!-- season collection -->

	<section class="season_collection section-padding">

		@include('user.home.double_column')

	</section>

	<!-- end season collection -->

	<!-- favorite products -->

	<section class="favorite_products section-padding">
		@include('user.home.favourite_products')
		

	</section>

	<!-- end favorite products section -->

	<!-- Customization section -->

	<section class="custmoization_section section-padding">

		<div class="container">

		    <div class="section_title season_title">

		        <h2>Customization</h2>

		    </div>

		    @include('user.home.customize')

		</div>

	</section>

	<!-- end customization section -->
@endsection

@section('user_js_content')
	{{-- <link rel="stylesheet" href="{{asset('viewport/js/deals_section.js')}}"> --}}
	<script src="https://cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function () {
        // Get the end date from the data attribute
        var endDateTime = $('#countdown').data('date');

        // Start the countdown
        $('#countdown').countdown(endDateTime, function (event) {
	            // Update the countdown elements with the remaining time
	            $(this).html(event.strftime(
	                '<span>%D</span> <small>Day</small> ' +
	                '<span>%H</span> <small>Hrs</small> ' +
	                '<span>%M</span> <small>Min</small> ' +
	                '<span>%S</span> <small>Sec</small>'
	            ));
	        });
	    });

	</script>

	<script type="text/javascript">

		$(document).ready(function() {
		    $(".typeProduct").on('click', function() {
		        var productName = $(this).data('name');
		        console.log(productName);
		        if (productName === '*') {
			        $.ajax({
		                url: '{{ route("getAllRecentProductDisplay") }}',
		                method: 'GET',
		                success: function (response) {
		                    // Update cart session display field with updated cart information
		                    $('#recentProduct').html(response);
		                },
		                error: function (error) {
		                    console.log('Error fetching Recent Product information');
		                }
		            });

		            // Generate the route dynamically
		            var route = '{{ route('products') }}';
		            // Update the href attribute of the anchor tag
		            document.getElementById('viewAllButton').setAttribute('href', route);

			    } else {
			        // Handle other buttons
			        var routeUrl = '{{ route("getRecentProductDisplay", ":slug") }}';
		            routeUrl = routeUrl.replace(':slug', productName);
			        $.ajax({
				    	url: routeUrl,
		                method: 'GET',
		                
		                success: function (response) {
		                	console.log(response);
		                    // Update cart session display field with updated cart information
		                    $('#recentProduct').html(response);
		                },
		                error: function (error) {
		                    console.log('Error fetching Recent Product information');
		                }
			        });

		            // Generate the route dynamically
		            var route = "{{ route('shopcategory', ':slug') }}".replace(':slug', productName);
		            // Update the href attribute of the anchor tag
		            document.getElementById('viewAllButton').setAttribute('href', route);
			    }
		    });
		});

		

	</script>


@endsection