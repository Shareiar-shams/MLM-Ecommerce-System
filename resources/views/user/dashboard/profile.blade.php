@extends('user.dashboard.layouts')
@section('user_title_content')
    Ahknoxo | Profile
@endsection
@section('user_css_content')
@endsection

@section('dashboard_main_content')
	<div class="row row_section tabs_profile">
       	<div class="tab">
          	<button class="tablinks" onclick="openCity(event, 'profile')" id="defaultOpen">Profile</button>
          	<button class="tablinks" onclick="openCity(event, 'change')">Change</button>
       	</div>
       	<div class="cont_form_box user_box_xon tabcontent" id="profile">
	        <form action="{{ route('profile.update') }}" method="post">
	        	@csrf
		        @method('patch')
		        <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name', $user->name)" placeholder="Name*" required autofocus autocomplete="name" />
	            <x-input-error class="mt-2" :messages="$errors->get('name')" />

	            <x-text-input id="phone" name="phone" type="text" class="form-control" :value="old('phone', $user->phone)" placeholder="Phone*" required autofocus autocomplete="phone" />
	            <x-input-error class="mt-2" :messages="$errors->get('phone')" />

	           	<x-text-input id="address" name="address" type="text" class="form-control" :value="old('address', $user->address)" placeholder="Street Line, City, Postal Code, Country" required autofocus autocomplete="address" />
	            <x-input-error class="mt-2" :messages="$errors->get('address')" />

	            <input type="hidden" name="email" value="{{$user->email}}">
	            

	            <button class="btn btn-info" type="submit"> Submit </button>
	        </form>
       	</div>
       	<div class="cont_form_box user_box_xon tabcontent" id="change">
          	<form method="post" action="{{ route('password.update') }}">
          		@csrf
		        @method('put')
		        
	            <x-text-input id="current_password" name="current_password" placeholder="Current Password" type="password"  autocomplete="current-password" />
	            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />

	            
	            <x-text-input id="password" name="password" placeholder="New Password" type="password" class="" autocomplete="new-password" />
	            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />


	            
	            <x-text-input id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" type="password" class="" autocomplete="new-password" />
	            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />

	            <button class="btn btn-info" type="submit"> Submit </button>
          	</form>
      	 </div>
    </div>
    <!-- end row -->

    @if( isset(Auth::user()->mlmUser) && Auth::user()->mlmUser->parent_activation == 1 && Auth::user()->mlmUser->admin_activation == 1)
    <div class="row row_section secoud_row_pay">
       	<div class="col-md-12">
	        <div class="payment_box_profile">
	             
	            {{-- <form action="/action_page.php">
	                <div class="col-md-12">
	                   <div class="card_des">
	                      <h2>Credit Card (Stripe) </h2>
	                   <label for="ccnum">Credit card number *</label>
	                   <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
	                   <div class="row">
	                      <div class="col-md-6">
	                         <label for="birthday">Expiry Date *</label>
	                         <input type="date" id="birthday" name="birthday">
	                      </div>
	                      <div class="col-md-6">
	                         <label for="code"> Card Code (CVC) *</label>
	                         <input type="text" id="zip" name="zip" placeholder="CVC">
	                      </div>
	                   </div>
	                   <input type="submit" value="Submit">
	                   </div>
	                   
	                </div>
	            </form> --}}
	            @php
				    // Decode the JSON data into an associative array

				    $decoded_data = isset(Auth::user()->mlmUser->others_documents) ? json_decode(Auth::user()->mlmUser->others_documents, true) : '';
				@endphp
	            <form method="post" action="{{route('bank.credential')}}">
	            	@csrf
	                <div class="col-md-12">
	                   	<div class="card_des">
		                   	<h2>Add Mobile Banking Credential</h2>
		                   	<label for="gatway_type">Banking Type *</label>
		                   	<select name="payment_gatway_type" class="custom-select">
		                        <option value="bKash" {{ isset($decoded_data['payment_gatway_type']) && $decoded_data['payment_gatway_type'] == 'bKash' ? 'selected' : '' }}>Bkash</option>
		                        <option value="nagad" {{ isset($decoded_data['payment_gatway_type']) && $decoded_data['payment_gatway_type'] == 'nagad' ? 'selected' : '' }}>Nagad</option>
		                        <option value="rocket" {{ isset($decoded_data['payment_gatway_type']) && $decoded_data['payment_gatway_type'] == 'rocket' ? 'selected' : '' }}>Rocket</option>
		                    </select>
	                   		
		                   	<div class="row">
		                      	<div class="col-md-6">
			                        <label for="number">Banking Number*</label>
			                        <input type="text" id="ccnum" name="number" value="{{ isset($decoded_data['number']) ? $decoded_data['number'] : ''}}" placeholder="01.........">
		                      	</div>
		                      	<div class="col-md-6">
		                          	<label for="zip">Account Type*</label>
		                          	<select name="type" class="custom-select">
		                          		<option value="personal" {{ isset($decoded_data['type']) && $decoded_data['type'] == 'personal' ? 'selected' : '' }}>Personal</option>
										
										<option value="agent" {{ isset($decoded_data['type']) && $decoded_data['type'] == 'agent' ? 'selected' : '' }}>Agent</option>

				                    </select>
		                      	</div>
		                   	</div>
		                   	<button type="submit" class="btn btn-info">Submit</button>
	                   	</div>
	                </div>
	            </form>
	        </div>
       	</div>
    </div>
    @endif
@endsection
@section('user_js_content')
@endsection