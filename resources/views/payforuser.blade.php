<x-app-layout>
	@section('css_content')
	  	
	@endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                	<div class="card">
					  <div class="card-header">
					    {{($user->user->user_type == 'special') ? 'Special User' : 'Normal User'}}
					  </div>
					  <div class="card-body">
					    <h2 class="card-title">{{$user->user->name}}</h2>
					    <p class="card-text"><strong>Number: </strong> {{$user->user->phone}}</p>
					    <p class="card-text"><strong>Digital Product Name: </strong> {{$digitalproduct->name}}</p>
					    <p class="card-text"><strong>Referred By: </strong> {{$user->refferer_user->name}}</p>
					    <p class="card-text"><strong>Invoice: </strong>{{$user->invoice}}</p>
					    <p class="card-text"><strong>Status: </strong>{{($user->admin_activation == 1 && $user->parent_activation == 1) ? 'Active' : 'Inactive'}}</p>
					    <p class="card-text">Need Admin Autorization</p>
					    <p class="card-text"><strong>User Pay to You: </strong>&#2547;{{$actualPrice}}</p>
					    <p class="card-text"><strong>Pay To Admin: </strong>&#2547;{{$payAdmin}}</p>
					    <p class="card-text"><strong>You Will Keep: </strong>&#2547;{{isset($parentTake) ? $parentTake : '0'}}</p>
					    <a href="{{route('bkash-create-payment')}}" class="btn btn-info" title=""> Pay Admin</a>
					    {{-- <form method="get" accept="{{route('bkash-create-payment')}}">
					    	
					        @method('get')
					    	<input type="hidden" name="amount" value="{{$payAdmin}}">
					    	<input type="hidden" name="invoice" value="{{$user->invoice}}">
					    	<input type="hidden" name="payerReference" value="{{$user->user->phone}}">
						    <button type="submit" class="btn btn-primary">Pay Admin</button>
					    	
					    </form> --}}
					  </div>
					</div>
                </div>
            </div>
        </div>
    </div>

    {{-- @section('js_content')
	  	<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-1.8.3.min.js"
		        integrity="sha256-YcbK69I5IXQftf/mYD8WY0/KmEDCv1asggHpJk1trM8=" crossorigin="anonymous"></script>

		<script id="myScript"
        src="https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js"></script>

        <script>
		    var accessToken = '';

		    $(document).ready(function () {
		        $.ajaxSetup({
		            headers: {
		                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		            }
		        });

		        $.ajax({
		            url: "{!! route('token') !!}",
		            type: 'POST',
		            contentType: 'application/json',
		            success: function (data) {
		                console.log('got data from token  ..');
		                console.log(JSON.stringify(data));

		                accessToken = JSON.stringify(data);
		            },
		            error: function () {
		                console.log('error');

		            }
		        }); 
		       	var paymentConfig = {
		            createCheckoutURL: "{!! route('createpayment') !!}",
		            executeCheckoutURL: "{!! route('executepayment') !!}"
		        };


		        var paymentRequest;
		        paymentRequest = {amount: $('.amount').text(), intent: 'sale', invoice: $('.invoice').text(), payerReference:$('.payerReference').text()};

		        console.log(JSON.stringify(paymentRequest));
		        var callbackURL = "{!! route('dashboard') !!}";
		        var userId = "{{ $user->id }}";
		        bKash.init({
		            paymentMode: 'checkout',
		            paymentRequest: paymentRequest,
		            createRequest: function (request) {
		                $.ajax({
		                    url: paymentConfig.createCheckoutURL + "?amount=" + paymentRequest.amount + "&invoice=" + paymentRequest.invoice + "&payerReference=" + paymentRequest.invoice +"&callbackURL=" + callbackURL,
		                    type: 'GET',
		                    contentType: 'application/json',
		                    success: function (data) {
		                        console.log('got data from create  ..');
		                        console.log('data ::=>');
		                        console.log(JSON.stringify(data));

		                        var obj = JSON.parse(data);
		                        if (data && obj.paymentID != null) {
		                            paymentID = obj.paymentID;
		                            bKash.create().onSuccess(obj);
		                        }
		                        else {
		                            console.log('success-error');
		                            bKash.create().onError();
		                        }
		                    },
		                    error: function () {
		                        console.log('error');
		                        bKash.create().onError();
		                    }
		                });
		            },

		            executeRequestOnAuthorization: function () {
		                console.log('=> executeRequestOnAuthorization');
		                $.ajax({
		                    url: paymentConfig.executeCheckoutURL + "?paymentID=" + paymentID + "&userID=" + userId,
		                    type: 'GET',
		                    contentType: 'application/json',
		                    success: function (data) {
		                        console.log('got data from execute  ..');
		                        console.log('data ::=>');
		                        console.log(JSON.stringify(data));

		                        data = JSON.parse(data);
		                        if (data && data.paymentID != null) {
		                            alert('[SUCCESS] data : ' + JSON.stringify(data));
		                            window.location.href = "{!! route('dashboard') !!}";
		                        }
		                        else {
		                            bKash.execute().onError();
		                        }
		                    },
		                    error: function () {
		                        bKash.execute().onError();
		                    }
		                });
		            }
		        });

	        	// console.log("Right after init ");
		    });

		    function callReconfigure(val) {
		        bKash.reconfigure(val);
		    }

		    function clickPayButton() {
		        $("#bKash_button").trigger('click');
		    }


		    
		</script>
	@endsection --}}
</x-app-layout>
