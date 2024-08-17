@extends('user.layouts.layout')
@section('user_title_content')
    Ahknoxo | Contact
@endsection
@section('meta_property')
	<!-- SEO Meta Tags-->
    <meta name="keywords" content="contact-us,contact,contactus,site-contact,ahknoxo-contact">
    <meta name="description" content="contact meta description">
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
						<h2>Contact Us</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
					</div>
				</div>
			</div>
		</div>
	</section> --}}
	<!-- end hero area about -->

	<section class="contact_text_section section-padding">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="contact_heading">
						<h2>{{$contact->title}}</h2>
					</div>
				</div>
				<div class="col-md-6">
					<div class="contact_title">
						<p>{{$contact->subtitle}}</p>
					</div>
				</div>
			</div>
			<!-- secoud row -->
			<div class="row contact_infomation">
				<div class="col-md-3">
					<div class="content_box">
						<a href="#" title=""><i class="fa fa-map-marker" aria-hidden="true"></i> <span>Address</span></a>
						<h4>{{$contact->address}}</h4>
					</div>
				</div>
				<div class="col-md-3">
					<div class="content_box">
						<a href="#" title=""><i class="fa fa-phone" aria-hidden="true"></i> <span>Call Us</span></a>
						<h4>@forelse(json_decode($contact->contact_number) as $number) {{$number}}<br> @empty @endforelse</h4>
					</div>
				</div>
				<div class="col-md-3">
					<div class="content_box">
						<a href="#" title=""><i class="fa fa-clock-o" aria-hidden="true"></i> <span>Openning</span></a>
						<h4>@forelse(json_decode($contact->time_schedule) as $time) {{$time}}  @empty @endforelse</h4>
					</div>
				</div>
				<div class="col-md-3">
					<div class="content_box">
						<a href="#" title=""><i class="fa fa-envelope-o" aria-hidden="true"></i> <span>Email</span></a>
						<h4>@forelse(json_decode($contact->email) as $email) {{$email}}  @empty @endforelse</h4>
					</div>
				</div>
			</div>
			<!-- row three -->
			<div class="row contact_form">
				<div class="col-md-6">
					<div class="contact_form_section">
						<h2>Get Any Questions?</h2>
						{{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod. </p> --}}
						<div class="cont_form_box">
							<form action="{{route('contact_email')}}" method="POST" accept-charset="utf-8">
								@csrf
							    <input type="text" id="name" name="name" placeholder="Name*">
							    <input type="text" id="email" name="email" placeholder="Email*">
							    <input type="text" id="subject" name="subject" placeholder="Subject*">
							    <textarea id="message" name="message" placeholder="Write something.."></textarea>
							    <input type="submit" value="Send Your Message">
							</form>
						</div>
						<div class="social_icon_box_contact">
							<ul>
								@forelse($icons as $icon)
				                	<li><a href="{{$icon->url}}">{!! $icon->icon !!}</a></li>
				                @empty
				                @endforelse
				            </ul>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="map_section">
						{!! $contact->location !!}
						
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Customization section -->
	<section class="custmoization_section section-padding">
	  	@include('user.home.recent-item')
	</section>
	<!-- end customization section -->
@endsection
@section('user_js_content')
@endsection