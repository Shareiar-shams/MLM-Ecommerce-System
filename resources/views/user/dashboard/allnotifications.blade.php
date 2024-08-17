@extends('user.dashboard.layouts')
@section('user_title_content')
    Ahknoxo | Dashboard
@endsection
@section('user_css_content')
	<style type="text/css" media="screen">

		.notification-list {
			position: relative;
		}

		.notification-list::before {
			content: '';
			width: 0.5rem;
			height: 100%;
			position: absolute;
			top: 0;
			background: peachpuff;
			z-index: -1;
		}

		.notification-list li {
			padding: 0.5rem 1.5rem 1rem;
			border-radius: 1.5rem;
			background: peachpuff;
		}

		.notification-list li + li {
			margin-top: 1rem;
		}

		.notification-list ::marker {
			font-weight: 600;
			color: tomato;
			font-size: 1.8rem;
		}


	</style>
@endsection

@section('dashboard_main_content')
	<div class="row row_section">
		<div class="card" style="width: 100%; margin-bottom: 5%;">
			<div class="card-header">
				<h3>Notifications</h3>
			</div>
		</div>
	    <ol class="notification-list">
	    	@if(Auth::user()->mlmUser->offers)
	    		@foreach(Auth::user()->mlmUser->offers as $offer)
		    		<li>New Special Offer {{ $offer->name }} assign for you. Use this offer for add child under you.</li>
	    		@endforeach
	    	@endif

	    	@foreach($offers as $offer)
	    		<li>New Offer {{ $offer->name }} available for you all your.</li>
    		@endforeach
	    	@foreach($newUsers as $notification)
	    		<li>New User {{ $notification->user->name }} assign under you.</li>
	    	@endforeach
	    	@foreach($adminPaidTransactions as $notification)
	    		<li>Admin Pay &#2547;{{ $notification->amount }} TK to you for {{ $notification->user->name }}
	    		</li>
	    	@endforeach
	    </ol>
	</div>
@endsection
@section('user_js_content')
@endsection
