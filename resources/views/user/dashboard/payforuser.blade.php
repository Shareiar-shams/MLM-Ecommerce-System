@extends('user.dashboard.layouts')
@section('user_title_content')
    Ahknoxo | Pay Admin
@endsection
@section('user_css_content')
@endsection

@section('dashboard_main_content')
	<div class="row row_section">
	    <div class="card mb-3">
	      <div class="card-header">
	      	{{($user->user->user_type == 'special') ? 'Special User' : 'Normal User'}}
	      </div>
	      <div class="card-body">
	        </a><h5 class="card-title">{{$user->user->name}}</h5>
	        <p class="card-text"><strong>Number: </strong> {{$user->user->phone}}</p>
		    <p class="card-text"><strong>Digital Product Name: </strong> {{$digitalproduct->name}}</p>
		    <p class="card-text"><strong>Referred By: </strong> {{$user->refferer_user->name}}</p>
		    <p class="card-text"><strong>Invoice: </strong>{{$user->invoice}}</p>
		    <p class="card-text"><strong>Status: </strong>{{($user->admin_activation == 1 && $user->parent_activation == 1) ? 'Active' : 'Inactive'}}</p>
		    <p class="card-text">Need Admin Autorization</p>
		    <p class="card-text"><strong>User Pay to You: </strong>&#2547;{{$actualPrice}}</p>
		    <p class="card-text"><strong>Pay To Admin: </strong>&#2547;{{$payAdmin}}</p>
		    <p class="card-text"><strong>You Will Keep: </strong>&#2547;{{isset($parentTake) ? $parentTake : '0'}}</p>

		    <form method="post" action="{{route('mlmuser.bkash.create.payment')}}">
				@csrf
		    	<input type="hidden" name="amount" value="{{$payAdmin}}">
		    	<input type="hidden" name="userId" value="{{$user->id}}">
		    	<input type="hidden" name="productId" value="{{$digitalproduct->id}}">
		    	<input type="hidden" name="transfer_user" value="{{$transfer_user}}">
		    	<input type="hidden" name="pay_transfer_parent" value="{{$pay_transfer_parent}}">
		    	<input type="hidden" name="invoice" value="{{$user->invoice}}">
		    	<input type="hidden" name="payerReference" value="{{Auth::user()->phone}}">
			    <button type="submit" class="btn btn-info">Pay Admin</button>
		    	
		    </form>
	      </div>
	    </div>
	</div>
@endsection
@section('user_js_content')
@endsection
