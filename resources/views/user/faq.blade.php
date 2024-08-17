@extends('user.layouts.layout')
@section('meta_property')
	<!-- SEO Meta Tags-->
    <meta name="keywords" content="faq, ahknoxofaq, faqs, site faw">
    <meta name="description" content="faqs meta description">
@endsection
@section('user_title_content')
    Ahknoxo | FAQ
@endsection
@section('user_css_content')
	<style type="text/css" media="screen">
		
		.faq-box:hover {
		  	animation: shake 0.82s cubic-bezier(.36,.07,.19,.97) both;
		  	transform: translate3d(0, 0, 0);
		  	perspective: 1000px;
		}

		@keyframes shake {
		  10%, 90% {
		    transform: translate3d(-1px, 0, 0);
		  }
		  20%, 80% {
		    transform: translate3d(2px, 0, 0);
		  }
		  
		  30%, 50%, 70% {
		    transform: translate3d(-2px, 0, 0);
		  }
		  40%, 60% {
		    transform: translate3d(2px, 0, 0);
		}
	</style>
@endsection

@section('user_main_content')
	<!-- Page Content Wraper -->
    <div class="page-content-wraper">

        <!-- Page Content -->
        <section class="content-page">
            <div class="container">
                <div class="row">
                	@forelse($categories as $category)
	                    <div class="col-lg-4 col-md-6">
			                <a href="{{route('faq_catalog',$category->slug)}}" class="card mb-4 faq-box">
			                    <div class="card-body">
			                        <h4 class="card-title">{{$category->name}}</h4>
			                        <p class="card-text">{{$category->text}}</p>
			                        <span class="text-sm text-muted link">View Details <i class="icon-chevron-right"></i></span>
			                    </div>
			                </a>
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
@endsection