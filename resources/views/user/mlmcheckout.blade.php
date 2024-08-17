@extends('user.layouts.layout')
@section('user_title_content')
    Ahknoxo | Checkout
@endsection
@section('user_css_content')
	
	<style type="text/css" media="screen">
		#payment-form .form-row{
		  display: flex;
		  margin: 32px 0;
		}
		#payment-form .form-row .input-data{
		  width: 100%;
		  height: 40px;
		  margin: 0 20px;
		  position: relative;
		  margin-bottom: 20px;
		}
		.input-data input
		{
		  display: block;
		  width: 100%;
		  height: 100%;
		  border: none;
		  font-size: 17px;
		  border-bottom: 2px solid rgba(0,0,0, 0.12);
		}
		.input-data .underline{
		  position: absolute;
		  bottom: 0;
		  height: 2px;
		  width: 100%;
		}
		.input-data .underline:before{
		  position: absolute;
		  content: "";
		  height: 2px;
		  width: 100%;
		  background: #3498db;
		  transform: scaleX(0);
		  transform-origin: center;
		  transition: transform 0.3s ease;
		}

		.gatewaySuccess h1 {
	        color: #88B04B;
	        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
	        font-weight: 900;
	        font-size: 40px;
	        margin-bottom: 10px;
	    }
	    .gatewaySuccess p {
	        color: #404F5E;
	        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
	        font-size:20px;
	        margin: 0;
	    }
	    .gatewaySuccess .checkmarkDiv{
	    	border-radius:200px; 
	    	height:200px; 
	    	width:200px; 
	    	background: #F8FAF5; 
	    	margin:0 auto;
	    }
	    .gatewaySuccess i {
	        color: #9ABC66;
	        font-size: 100px;
	        line-height: 200px;
            margin-left: 50px;
	    }
	    .gatewaySuccess {
	        background: white;
	        padding: 60px;
	        border-radius: 4px;
	        box-shadow: 0 2px 3px #C8D0D8;
	        display: inline-block;
	        margin: 0 auto;
	        width: 100%;
	    }

	    @media (max-width: 992px) {
		    .gatewaySuccess .checkmarkDiv{
		    	border-radius:200px; 
		    	height:200px; 
		    	width:200px; 
		    	background: #F8FAF5; 
		    	margin: 0 auto;
		    }
		}
	</style>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('user_main_content')
	<!-- Page Content Wraper -->
	<div class="page-content-wraper">
		<!-- Bread Crumb -->
		<section class="banner_section">
			<div class="container">
				<div class="row">
				    <div class="col-7">
				      	<h3 class="mb-0 text-capitalize">Checkout</h3>
				    </div>
				</div>
			</div>
		</section>
  		<!-- Bread Crumb -->
  		<!-- Page Content -->
		<section class="content-page payment_section">
		    <div class="container" id="exTab1">
		      <div class="widget-sidebar">
		        <ul class="widget-content widget-product-categories jq-accordian" id="filters">
		          
		          <li>
		            <a class="is-active" href="javascript:void(0)" data-toggle="portfilter" data-target="uncategorized">Review and pay</a>
		          </li>
		        </ul>
		      </div>
		      <div class="row tab-content clearfix" id="myTabContent">
		        
		        <!-- tabs 3 -->
		        <div class="col-md-12 tab-pane fade show active" data-tag="uncategorized">
		          <div class="row">
		            <div class="col-md-12 box_carding">
		              <h3 class="payment_title">Review Your Order :</h3>
		              <div class="row">
		                <div class="card">
		                  <div class="card-body">
		                    <hr>
		                    <div class="row padding-top-1x  mb-4">
		                      <div class="col-sm-6">
		                        <h6>Invoice address :</h6>
		                        <ul class="list-unstyled">
		                          <li>
		                            <span class="text-muted">Name: </span>{{ Auth::user()->name}}
		                          </li>
		                          <li>
		                            <span class="text-muted">Address: </span>{{ Auth::user()->address}}
		                          </li>
		                          <li>
		                            <span class="text-muted">Phone: </span>{{ Auth::user()->phone}}
		                          </li>
		                          <li>
		                            <span class="text-muted">Email: </span>{{ Auth::user()->email}}
		                          </li>
		                        </ul>
		                      </div>

		                      <div class="col-sm-6">
		                      	<table class="table">
					                <tbody>
					                    <tr>
					                      	<td>Product Name:</td>
					                    	<td class="text-gray-dark">{{$digital_product->name}}</td>
					                    </tr>
					                    <tr>
					                      	<td>Total:</td>
					                      	<td class="text-gray-dark">
						                      	@if(isset($offer) && strtotime($offer->last_date) > strtotime(now()->format('d-M-Y')))

										        	@php
													    $offerPercentage = $digital_product->offer->offer_percentage;
													    $currentPrice = isset($digital_product->special_price) ? $digital_product->special_price : $digital_product->price;
													    $discountedPrice = $currentPrice - ($currentPrice * ($offerPercentage / 100));
													@endphp

									            	{{ $discountedPrice }}
									        	@else
									            	{{ isset($digital_product->special_price) ? $digital_product->special_price : $digital_product->price }}
									        	@endif
					                      	</td>
					                    </tr>
					                   
					                </tbody>
				                </table>
		                      </div>
		                    </div>
		                    <h6>Pay with :</h6>
		                    <div class="row mt-4">
			                    <div class="col-12">
			                        <div class="payment-methods">
			                        	@php
					                		$inv = uniqid();
					                		
					                	@endphp
			                        	<div class="single-payment-method">
			                        		<button class="btn btn-info" href="#" data-toggle="modal" data-target="#payAdminModal">
				                              	Pay To Company
				                            </button>
			                        		
				                        </div>
				                        
				                        {{-- @if(isset(Auth::user()->referrer_id))
				                        <div class="single-payment-method">
				                        	<form id="payReferrerForm" method="post" action="{{route('pay.referrer')}}">
												@csrf
										    	<input type="hidden" name="invoice" value="{{$inv}}">
										    	<input type="hidden" name="productId" value="{{$digital_product->id}}">
										    	<input type="hidden" name="referrer_id" value="{{ isset(Auth::user()->referrer_id) ? Auth::user()->referrer_id : null }}">
											    <button type="submit" class="btn btn-info">Pay to Referrer</button>
										    	
										    </form>
				                        </div>
			                          	@endif --}}
			                        </div>
			                    </div>
		                    </div>
		                  </div>
		                </div>
		              </div>
		            </div>
		            {{-- <div class="col-md-4">
		              <div class="card widget widget-featured-posts widget-order-summary p-4">
		                <h3 class="widget-title">Order Summary</h3>
		                
		                <table class="table">
			                <tbody>
			                    <tr>
			                      	<td>Product Name:</td>
			                    	<td class="text-gray-dark">{{$digital_product->name}}</td>
			                    </tr>
			                    <tr>
			                      	<td>Total:</td>
			                      	<td class="text-gray-dark">
				                      	@if(isset($offer) && strtotime($offer->last_date) > strtotime(now()->format('d-M-Y')))

								        	@php
											    $offerPercentage = $digital_product->offer->offer_percentage;
											    $currentPrice = isset($digital_product->special_price) ? $digital_product->special_price : $digital_product->price;
											    $discountedPrice = $currentPrice - ($currentPrice * ($offerPercentage / 100));
											@endphp

							            	{{ $discountedPrice }}
							        	@else
							            	{{ isset($digital_product->special_price) ? $digital_product->special_price : $digital_product->price }}
							        	@endif
			                      	</td>
			                    </tr>
			                   
			                </tbody>
		                </table>
		              </div>
		            </div> --}}
		          </div>
		        </div>
		      </div>
		    </div>
		</section>
		<!-- End Page Content -->
		
		<!-- modal -->
  		<div class="modal_section">
		    <div class="modal fade" id="payAdminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
				    <div class="modal-content">
					    <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Pay To Company (KNOXO)</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					    </div>
				      	
				    	<div class="modal-body">
				        	<div class="row">
				        		@php
			                		$payAdmin = '';
			                		$inv = uniqid();
			                		if(isset($offer) && strtotime($offer->last_date) > strtotime(now()->format('d-M-Y'))){
									    $offerPercentage = $digital_product->offer->offer_percentage;
									    $currentPrice = isset($digital_product->special_price) ? $digital_product->special_price : $digital_product->price;
									    $payAdmin = $currentPrice - ($currentPrice * ($offerPercentage / 100));

							            $userPercentage = $digital_product->offer->offer_percentage;
							            $pay_transfer_parent = number_format($payAdmin * ($userPercentage / 100), 2);
						        	}else{
						            	$payAdmin = isset($digital_product->special_price) ? $digital_product->special_price : $digital_product->price;
						            	$userPercentage = 33.33;
						            	$pay_transfer_parent = number_format($payAdmin * ($userPercentage / 100), 2);
						        	}
			                	@endphp
			                	@forelse($gateways as $gateway)
			                		@if($gateway->slug == 'bkash')
				                		<div class="col-xs-4" style="margin: 10px;">
				                			<form method="post" action="{{route('user.bkash.create.payment')}}">
												@csrf
										    	<input type="hidden" name="amount" value="{{$payAdmin}}">
										    	<input type="hidden" name="invoice" value="{{$inv}}">
										    	<input type="hidden" name="productId" value="{{$digital_product->id}}">
										    	<input type="hidden" name="referrer_id" value="{{ isset(Auth::user()->referrer_id) ? Auth::user()->referrer_id : null }}">
										    	<input type="hidden" name="pay_transfer_parent" value="{{$pay_transfer_parent}}">
										    	<input type="hidden" name="payerReference" value="{{Auth::user()->phone}}">
											    <button type="submit"><img width="150" height="150" class="" src="{{Storage::disk('local')->url($gateway->image)}}" alt="{{$gateway->name}}" title="{{$gateway->name}}"></button>
										    	
										    </form>
										</div>
			                		@elseif($gateway->slug == 'stripe')
				                		<div class="col-xs-4" style="margin: 10px;">

				                			<button data-toggle="modal" data-target="#stripeModal">
				                              	<img width="150" height="150" class="" src="{{Storage::disk('local')->url($gateway->image)}}" alt="{{$gateway->name}}" title="{{$gateway->name}}">
				                            </button>

				                			
										</div>
									@elseif($gateway->slug == 'paypal')
				                		<div class="col-xs-4" style="margin: 10px;">
				                			<form method="post" action="{{route('processPaypalTransaction')}}">
												@csrf
										    	<input type="hidden" name="amount" value="{{$payAdmin}}">
										    	<input type="hidden" name="invoice" value="{{$inv}}">
										    	<input type="hidden" name="productId" value="{{$digital_product->id}}">
										    	<input type="hidden" name="referrer_id" value="{{ isset(Auth::user()->referrer_id) ? Auth::user()->referrer_id : null }}">
										    	<input type="hidden" name="pay_transfer_parent" value="{{$pay_transfer_parent}}">
										    	<input type="hidden" name="payerReference" value="{{Auth::user()->phone}}">
											    <button type="submit"><img width="150" height="150" class="" src="{{Storage::disk('local')->url($gateway->image)}}" alt="{{$gateway->name}}" title="{{$gateway->name}}"></button>
										    	
										    </form>
										</div>
									@elseif($gateway->slug == 'ssl')
				                		<div class="col-xs-4" style="margin: 10px;">
				                			<form method="post" action="{{route('user.bkash.create.payment')}}">
												@csrf
										    	<input type="hidden" name="amount" value="{{$payAdmin}}">
										    	<input type="hidden" name="invoice" value="{{$inv}}">
										    	<input type="hidden" name="productId" value="{{$digital_product->id}}">
										    	<input type="hidden" name="referrer_id" value="{{ isset(Auth::user()->referrer_id) ? Auth::user()->referrer_id : null }}">
										    	<input type="hidden" name="pay_transfer_parent" value="{{$pay_transfer_parent}}">
										    	<input type="hidden" name="payerReference" value="{{Auth::user()->phone}}">
											    <button type="submit"><img width="150" height="150" class="" src="{{Storage::disk('local')->url($gateway->image)}}" alt="{{$gateway->name}}" title="{{$gateway->name}}"></button>
										    	
										    </form>
										</div>
			                		@endif
			                	@empty
				        		
							    @endforelse
						    </div>
				      	</div>
				      
				    </div>
				</div>
			</div>

			<!-- The Modal -->
			<div class="modal fade" id="stripeModal">
			    <!-- Modal content goes here as shown in the previous response -->
			    <div class="modal-dialog modal-dialog-centered">
			        <div class="modal-content">
			            <!-- Modal Header -->
			            <div class="modal-header">
			                <h4 class="modal-title">Stripe Payment</h4>
			                <button type="button" class="close stripeClose" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
			            </div>

			            <form id="payment-form" method="post" action="{{ route('user.stripe.create.payment') }}">
					        @csrf

				            <!-- Modal Body -->
				            <div class="modal-body">
						        <input type="hidden" name="amount" id="stripeAmount" value="{{$payAdmin}}" id="amount">

							    <input type="hidden" name="invoice" id="stripeInvoice" value="{{$inv}}">
						    	<input type="hidden" name="productId" id="stripeProductId" value="{{$digital_product->id}}">
						    	<input type="hidden" name="referrer_id" id="stripeRefferrerId" value="{{ isset(Auth::user()->referrer_id) ? Auth::user()->referrer_id : null }}">
						    	<input type="hidden" name="pay_transfer_parent" id="stripeTransferParent" value="{{$pay_transfer_parent}}">
						    	<input type="hidden" name="payerReference" id="stripePayReference" value="{{Auth::user()->phone}}">
						    	<div class="form-row">
						            <div class="input-data">
						               <label class='card-holder-name'>Card Holder Name</label>
							            <input type="text" class="form-control" id="card-holder-name" name="card_holder_name" required>
						            </div>
						        </div>
						        <div class="form-row">
						            <div class="input-data">
						               <label for="card-number">Card Number</label>
						                <div class="card-number-element"></div>
						            </div>
						        </div>
						        <div class="form-row">
						        	<div class="input-data" style="display:inline-block; vertical-align: top;">
						        		<div class="form-group" style="float: left;">
				            		
							               	<label for="card-cvc">CVC</label>
							                <div class="card-cvc-element"></div>
						            	</div>
						        		<div class="form-group" style="float: right; margin-right: 40%;">
				            		
							               	<label for="card-expiry">Expiration</label>
							                <div class="card-expiry-element"></div>
						            	</div>
						        	</div>
						        </div>
				            </div>

				            <!-- Modal Footer -->
				            <div class="modal-footer">
				                <div class='form-row'>
							        <div class='col-md-12 form-group'>
							            <button class='form-control btn btn-info submit-button' type='submit' style="margin-top: 10px;">Confirm</button>
							        </div>
							    </div>
				            </div>
			            </form>
			        </div>
			    </div>
			</div>

			<!-- The Modal -->
			<div class="modal fade" id="referrerModal">
			    <!-- Modal content goes here as shown in the previous response -->
			    <div class="modal-dialog modal-dialog-centered">
			        <div class="modal-content">
			            <!-- Modal Header -->
			            <div class="modal-header">
			                <h4 class="modal-title">Pay to Referrer</h4>
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
			            </div>

			            <!-- Modal Body -->
			            <div class="modal-body">
			                <p>Please pay your referrer first, then wait at least 48 hours.</p>
			                <br>
			                <div id="modalContent"></div>
			            </div>

			            <!-- Modal Footer -->
			            <div class="modal-footer">
			                <a href="{{ route('main') }}" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
			            </div>
			        </div>
			    </div>
			</div>

			<!-- The Modal -->
			<div class="modal fade" id="errorReferrerModal">
			    <!-- Modal content goes here as shown in the previous response -->
			    <div class="modal-dialog modal-dialog-centered">
			        <div class="modal-content">
			            <!-- Modal Header -->
			            <div class="modal-header">
			                <h4 class="modal-title">Pay to Referrer</h4>
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
			            </div>

			            <!-- Modal Body -->
			            <div class="modal-body">
			                <p>Somethings went wrong here. Try again later! Eiter try access with referrer provide link.</p>
			            </div>

			            <!-- Modal Footer -->
			            <div class="modal-footer">
			                <a href="{{ route('main') }}" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
			            </div>
			        </div>
			    </div>
			</div>

			<!-- THe Payment Success Message Model -->
			<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header">
			                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
			            </div>
			            <div class="modal-body">
			                <div class="gatewaySuccess card">
						        <div class="checkmarkDiv">
						            <i class="checkmark">✓</i>
						        </div>
						        <h1>Success</h1>
						        <p>We received your purchase request; <br/> we'll be in touch shortly!</p>
						        <h3 id="transaction-id">Transaction ID: -</h3> 
				        	</div>
			            </div>
			        </div>
			    </div>
			</div>
  		</div>
		<!-- end modal -->
	</div>
@endsection
@section('user_js_content')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<!-- Stripe JS -->
	<script src="https://js.stripe.com/v3/"></script>
	<script type="text/javascript">
        const stripe = Stripe('{{ env('STRIPE_KEY') }}'); // Replace with secure key fetching on server-side

        const successMessage = document.getElementById('success-message');
		const transactionIdElement = document.getElementById('transaction-id');
        const elements = stripe.elements();

        const cardNumberElement = elements.create('cardNumber');
        const cardExpiryElement = elements.create('cardExpiry');
        const cardCvcElement = elements.create('cardCvc');

        cardNumberElement.mount('.card-number-element');
        cardExpiryElement.mount('.card-expiry-element');
        cardCvcElement.mount('.card-cvc-element');

        const form = document.getElementById('payment-form');

        // form.addEventListener('submit', (event) => {
        //     event.preventDefault();

        //     stripe.createToken(cardNumberElement, {
        //         name: document.getElementById('card-holder-name').value
        //     }).then((result) => {
        //         if (result.error) {
        //             // Display error message to user
        //             console.error(result.error.message);
        //             return;
        //         }

        //         const token = result.token.id;
        //         const hiddenInput = document.createElement('input');
        //         hiddenInput.type = 'hidden';
        //         hiddenInput.name = 'stripeToken';
        //         hiddenInput.value = token;
        //         form.appendChild(hiddenInput);

        //         form.submit();
        //     });
        // });
        form.addEventListener('submit', (event) => {
            event.preventDefault();

            stripe.createToken(cardNumberElement, {
                name: document.getElementById('card-holder-name').value
            }).then((result) => {
                if (result.error) {
                    // Display error message to user
                    console.error(result.error.message);
                    return;
                }

                // const token = result.token.id;
                // const hiddenInput = document.createElement('input');
                // hiddenInput.type = 'hidden';
                // hiddenInput.name = 'stripeToken';
                // hiddenInput.value = token;
                // form.appendChild(hiddenInput);

                // form.submit();

                const token = result.token.id; // Access the token ID
                const formAction = form.getAttribute('action'); // Get the original form action
                // **Collect form data:**
                const formData = {
                    stripeToken: token,
                    card_holder_name: document.getElementById('card-holder-name').value,
                    amount: document.getElementById('stripeAmount').value,
                    invoice: document.getElementById('stripeInvoice').value,
                    productId: document.getElementById('stripeProductId').value,
                    referrer_id: document.getElementById('stripeRefferrerId').value,
                    pay_transfer_parent: document.getElementById('stripeTransferParent').value,
                    payerReference: document.getElementById('stripePayReference').value
                };

                // Send AJAX request with the token and additional data to the server-side endpoint
                fetch(formAction, {
                    method: 'POST',
                    headers: {
				        'Content-Type': 'application/json',
				        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
				    },
                    body: JSON.stringify(formData)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Server responded with status ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    // Handle successful response from the server
                    console.log('Payment processed successfully:', data);
                    // **Update transaction ID:**
                    const transactionId = data.transectionId; 
                    transactionIdElement.textContent = `Transaction ID: ${transactionId}`;

                    const closeStripeButton = document.querySelector('.stripeClose'); 
				    if (closeStripeButton) {
				        closeStripeButton.click();
				    }  else {
				        console.warn("Close button with classes 'stripeClose' not found.");
				    }

                	const closeButton = document.querySelector('.close'); 
				    if (closeButton) {
				        closeButton.click();
				    } else {
				        console.warn("Close button with classes 'close' not found.");
				    }

				    // Show the success modal
					const successModal = new bootstrap.Modal(document.getElementById('successModal'));
					successModal.show();

                    // Display success message
                    // successMessage.style.display = 'block';

                    // Clear the form fields (optional)
                    form.reset();
                })
                .catch(error => {
                    console.error('Error submitting payment:', error);
                    alert('An error occurred while processing your payment. Please try again.');
                });
                
            });
        });

    </script>
	<script type="text/javascript">

		
		// Use jQuery.noConflict() to release the $ alias
	    jQuery.noConflict();

		$(document).ready(function() {
	        // Handle form submission
	        $("#payReferrerForm").submit(function(event) {
	            // Prevent the default form submission
	            event.preventDefault();

	            // Submit the form using AJAX
	            $.ajax({
	                type: "POST",
	                url: $(this).attr('action'),
	                data: $(this).serialize(),
	                success: function(response) {
	                    // Show the success popup when the form submission is successful
	                    // showSuccessPopup();
	                    $("#referrerModal").modal("show");

	                    if (response.gatewayType && response.gatewayNumber && response.accountType) {
		                    var modalContent = `
		                        Mobile Banking Type: ${response.gatewayType}<br>
		                        Number: ${response.gatewayNumber}<br>
		                        Account Type: ${response.accountType}
		                    `;
		                    $("#modalContent").html(modalContent);
		                }
	                    // Display the received data in the modal

		                // $("#gatewayType").text(response.gatewayType);
		                // $("#gatewayNumber").text(response.gatewayNumber);
		                // $("#accountType").text(response.accountType);

	                    // Optionally, you can handle the response data here
	                    // window.location.href = "{{ route('main') }}";

	                    console.log(response);
	                },
	                error: function(error) {
	                	$("#errorReferrerModal").modal("show");
	                    // Handle the error if needed
	                    console.log(error);
	                }
	            });
	        });
	    });

	    // Function to show the success popup
	    // function showSuccessPopup() {
	    //     $("#referrerModal").modal("show");
	    // }
	</script>
@endsection