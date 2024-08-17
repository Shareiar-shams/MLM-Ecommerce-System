@extends('user.layouts.layout')
@section('user_title_content')
    Ahknoxo | {{$about->title}}
@endsection
@section('meta_property')
	<!-- SEO Meta Tags-->
    <meta name="keywords" content="@forelse(json_decode($about->meta_keywords) as $keyword) {{$keyword}}, @empty @endforelse">
    <meta name="description" content="{{ isset($about->meta_descriptions) ? $about->meta_descriptions : ''}}">
@endsection
@section('user_css_content')
@endsection

@section('user_main_content')
	<!-- hero area about -->

	{{-- <section class="about_hero_area section-padding">

		<div class="container">

			<div class="row">

				<div class="col-md-12">

					<div class="about_hero_area_content">

						<h2>{{$about->title}}</h2>

					</div>

				</div>

			</div>

		</div>

	</section> --}}

	<!-- end hero area about -->

	<!-- about video area -->

	<section class="about_video_section section-padding">

		<div class="container">

			<div class="row">

				<div class="col-md-6">

					<div class="about_video_area">

						<img src="{{Storage::disk('local')->url($about->image)}}" alt="">

					</div>

				</div>

				<div class="col-md-6">

					<div class="about_video_text">

					<h2>{{$about->title}}</h2>

					<p>{!!htmlspecialchars_decode($about->description)!!}</p>

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