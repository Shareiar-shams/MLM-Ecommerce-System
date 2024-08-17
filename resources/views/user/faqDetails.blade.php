@extends('user.layouts.layout')
@section('meta_property')
	<!-- SEO Meta Tags-->
    <meta name="keywords" content="@forelse(json_decode($category->meta_keywords) as $keyword) {{$keyword}}, @empty @endforelse">
    <meta name="description" content="{{ isset($category->meta_descriptions) ? $category->meta_descriptions : ''}}">
@endsection
@section('user_title_content')
    Ahknoxo | FAQ
@endsection
@section('user_css_content')
	<style type="text/css" media="screen">
				
		.faq {
		  background-color: transparent;
		  border: 1px solid #9fa4a8;
		  border-radius: 10px;
		  margin: 20px 0;
		  overflow: hidden;
		  padding: 30px;
		  position: relative;
		  transition: 0.3s ease;
		}

		.faq.active {
		  background-color: #fff;
		  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1), 0 3px 6px rgba(0, 0, 0, 0.1);
		}

		.faq.active::before,
		.faq.active::after {
		  color: #2ecc71;
		  content: "\f075";
		  font-family: "Font Awesome 6 Free";
		  font-size: 7rem;
		  left: 20px;
		  opacity: 0.2;
		  position: absolute;
		  top: 20px;
		  z-index: 0;
		}

		.faq.active::before {
		  color: #3498db;
		  left: -30px;
		  top: -10px;
		  transform: rotateY(180deg);
		}

		.faq-title {
		  margin: 0 35px 0 0;
		}

		.faq-text {
		  display: none;
		  margin: 30px 0 0;
		}

		.faq.active .faq-text {
		  display: block;
		}

		.faq-toggle {
		  align-items: center;
		  background-color: transparent;
		  border: 0;
		  border-radius: 50%;
		  cursor: pointer;
		  display: flex;
		  font-size: 1rem;
		  height: 30px;
		  justify-content: center;
		  padding: 0;
		  position: absolute;
		  right: 30px;
		  top: 30px;
		  width: 30px;
		}
		.faq-toggle .fa-times,
		.faq.active .faq-toggle .fa-chevron-down {
		  display: none;
		}

		.faq.active .faq-toggle .fa-times {
		  color: #fff;
		  display: block;
		}

		.faq-toggle .fa-chevron-down {
		  display: block;
		}

		.faq.active .faq-toggle {
		  background-color: #9fa4a8;
		}
	</style>	
@endsection

@section('user_main_content')
		<!-- Page Content Wraper -->
    <div class="page-content-wraper">

        <!-- Page Content -->
        <section class="content-page">
        	<!-- Bread Crumb -->
	      	<div class="breadcrumb" style="background-color: transparent; margin-top: -60px;">
	         	<div class="container">
		            <div class="row">
		               	<div class="col-12">
		                  	<nav class="breadcrumb-link">
			                    <a href="{{route('main')}}">Home ></a>
			                    <a href="{{route('faq')}}"> FAQ ></a>
		                    	<span>Category Name</span>
		                  	</nav>
		               	</div>
		            </div>
	         	</div>
	      	</div>
      		<!-- Bread Crumb -->

          	<div class="container padding-bottom-1x mb-3">
		        <div class="faq-container">
		        	@forelse($category->faq as $faq)
						<div class="faq {{$loop->first ? 'active' : ''}}">
						    <h3 class="faq-title">{{$faq->title}}</h3>
						    <p class="faq-text">{{$faq->description}}</p>
						    <button class="faq-toggle">
						      <i class="fa fa-chevron-down"></i>
						      <i class="fa fa-times"></i>
						    </button>
						</div>
					@empty
					@endforelse
				</div>
	    	</div>
        </section>
        <!-- End Page Content -->


       	<!-- banner section -->

		<section class="banner_section section-padding">

	        @include('user.home.single_column')

	    </section>

		<!-- end banner section -->


		<!-- Customization section -->

		<section class="custmoization_section section-padding">

		  	@include('user.home.recent-item')

		</section>

			<!-- end customization section -->
	</div>
	<!-- End Page Content Wraper -->
@endsection
@section('user_js_content')
		<script type="text/javascript">
				const toggles = document.querySelectorAll(".faq-toggle");
				toggles.forEach((toggle) => {
					  toggle.addEventListener("click", () => {
					    	toggle.parentElement.classList.toggle("active");
					  });
				});
		</script>
@endsection