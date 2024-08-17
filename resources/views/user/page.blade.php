@extends('user.layouts.layout')
@section('user_title_content')
    Ahknoxo | {{$page->title}}
@endsection

@section('meta_property')
	<!-- SEO Meta Tags-->
    <meta name="keywords" content="@if($page->meta_keywords) @forelse(json_decode($page->meta_keywords) as $keyword) {{$keyword}}, @empty @endforelse @endif">
    <meta name="description" content="{{ isset($page->meta_descriptions) ? $page->meta_descriptions : ''}}">
@endsection

@section('user_css_content')
	<style type="text/css" media="screen">
		.section-title {
		    font-weight: 700;
		    text-transform: capitalize;
		    letter-spacing: 1px;
		}

		.section-subtitle {
		    letter-spacing: 0.4px;
		    line-height: 28px;
		    max-width: 550px;
		}
	</style>
@endsection

@section('user_main_content')
	<!-- hero area about -->

	{{-- <section class="about_hero_area section-padding">

		<div class="container">

			<div class="row">

				<div class="col-md-12">

					<div class="about_hero_area_content">

						<h2>{{$page->title}}</h2>

					</div>

				</div>

			</div>

		</div>

	</section> --}}

	<!-- end hero area about -->

	<!-- about video area -->

	<section class="content-page">

		<div class="container">

			<div class="row">

				<div class="col-lg-12">
	                <div class="card">
	                    <div class="card-body px-4 py-5">
	                    	<div class="section_title_all text-center">
                            	<h3 class="font-weight-bold">{{$page->title}}</h3>
                            	<p class="section_subtitle mx-auto text-muted">{!!htmlspecialchars_decode($page->description)!!}</p>
                            </div>

	                        {{-- <div class="d-page-content">
	                            <h4 class="d-block text-center"><b>{{$page->title}}</b></h4>
	                            {!!htmlspecialchars_decode($page->description)!!}
	                        </div> --}}
	                    </div>
	                </div>
	            </div>

			</div>

		</div>

	</section>

	<!-- end about Video section -->

	<!-- about banner section -->

	<section class="banner_section section-padding">

	    @include('user.home.single_column')

	</section>

	<!-- end about banner section -->

	<!-- Customization section -->

	<section class="custmoization_section section-padding">

	  	@include('user.home.recent-item')

	</section>

	<!-- end customization section -->
@endsection

@section('user_js_content')
@endsection