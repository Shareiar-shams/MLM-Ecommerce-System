@extends('user.layouts.layout')
@section('user_title_content')
    Ahknoxo | Checkout
@endsection
@section('meta_property')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('user_css_content')
	<style type="text/css" media="screen">
		.privacy_link{
			color:blue;
		}
		}
		.privacy_link:hover{
			color:blue;
		}

		.gatewaySuccess h1 {
	        color: #88B04B;
	        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
	        font-weight: 900;
	        font-size: 30px;
	        margin-bottom: 10px;
	    }
	    .gatewaySuccess p {
	        color: #404F5E;
	        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
	        font-size:12px;
	        margin: 0;
	    }
	    .gatewaySuccess .checkmarkDiv{
	    	border-radius:200px; 
	    	height:100px; 
	    	width:100px; 
	    	background: #F8FAF5; 
	    	margin:0px auto;
	    	margin-top: -30px;
	    }
	    .gatewaySuccess i {
	        color: #9ABC66;
	        font-size: 50px;
	        line-height: 80px;
            margin-left: 30px;
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
		    	height:100px; 
		    	width:100px; 
		    	background: #F8FAF5; 
		    	margin:0px auto;
		    	margin-top: -30px;
		    }
		}

		#ajax-loading-container img {
		  position: fixed;
		  width: 60%;
		  height: 60%;
		  top: 50%;
		  left: 50%; /* Center horizontally too (optional) */
		  transform: translate(-50%, -50%); /* Center vertically and horizontally */
		  z-index: 1;
		}
	</style>
@endsection

@section('user_main_content')

	<div id="ajax-loading-container" style="display: none; text-align: center;">
		<img src="{{asset('viewport/img/spinner.gif')}}" alt="Loading....">
  	</div>
	<!-- Page Content Wraper -->
	<div class="page-content-wraper">
		<!-- Bread Crumb -->
		{{-- <section class="banner_section">
			<div class="container">
				<div class="row">
				    <div class="col-7">
				      	<h3 class="mb-0 text-capitalize">Payment</h3>
				    </div>
				</div>
			</div>
		</section> --}}
  		<!-- Bread Crumb -->
  		<!-- Page Content -->
		<section class="content-page payment_section">
		    <div class="container" id="exTab1">
		      	<div class="widget-sidebar">
			        <ul class="widget-content widget-product-categories jq-accordian" id="filters">
				        <li>
				            <a class="is-active" href="javascript:void(0)" data-toggle="portfilter" data-target="crates">Billing Address:</a>
				       	</li>
				        <li>
				            <a href="javascript:void(0)" id="shipping_tab" >Shipping Address:</a>
				        </li>
				        <li>
				            <a href="javascript:void(0)" id="review_tab">Review and pay</a>
				        </li>
			        </ul>
		      	</div>
		      	<div class="row tab-content clearfix" id="myTabContent">
			        <div class="col-md-12 tab-pane fade show active" id="new-arrivals" role="tabpanel" aria-labelledby="new-arrivals-tab">
				        <div class="row" data-tag="crates">
				            <div class="col-md-8">
				            	<form action="{{route('billing.form-data')}}" id="billing_form" method="post" accept-charset="utf-8">
				            		@csrf
					            	
					              	<h3 class="payment_title">Billing details</h3>
					              	<div class="row">
						                <div class="form-field-wrapper form-center col-sm-6">
						                  	<label for="billing_first_name" class="left"> First name <abbr class="form-required" title="required">*</abbr></label>
						                  	<input class="input-md form-full-width" name="billing_first_name" title="First Name" value="" type="text" required="" aria-required="true">
						                </div>
						                <div class="form-field-wrapper form-center col-sm-6">
						                  	<label for="billing_last_name" class="left"> Last name <abbr class="form-required" title="required">*</abbr></label>
						                  	<input class="input-md form-full-width" name="billing_last_name" title="Last Name" value="" type="text" required="" aria-required="true">
						                </div>
						                <div class="form-field-wrapper form-center col-sm-6">
						                  	<label for="billing_email" class="left"> Email <abbr class="form-required" title="required">*</abbr>
						                  	</label>
						                  	<input class="input-md form-full-width" name="billing_email" title="Enter Email" value="" placeholder="Enter Email" type="email" required="" aria-required="true">
						                </div>
						                <div class="form-field-wrapper form-center col-sm-6">
						                  	<label for="billing_phone" class="left"> Phone <abbr class="form-required" title="required">*</abbr>
						                  	</label>
						                  	<input class="input-md form-full-width" name="billing_phone" title="phone" value="" placeholder="(+00) 123 456 7890" type="tel" required="" aria-required="true">
						                </div>
						                <div class="form-field-wrapper form-center col-sm-12">
						                  	<label for="billing_company" class="left">Company name (optional)</label>
						                  	<input class="input-md form-full-width" name="billing_company" title="Company Name" value="" type="text">
						                </div>
						                <div class="form-field-wrapper form-center col-sm-12">
						                  	<label for="billing_address" class="left"> Street address <abbr class="form-required" title="required">*</abbr></label>

						                  	<input class="mb-3 input-md form-full-width mb-20" name="billing_address" title="Address" value="" placeholder="House number and street name" type="text" required="" aria-required="true">

						                  	<input class="input-md form-full-width" name="billing_address_op" title="Address" value="" placeholder="Apartment, suite, unit, etc. (optional)" type="text" aria-required="true">

						                </div>
						                <div class="form-field-wrapper form-center col-sm-6">
						                  	<label for="billing_town_city" class="left"> Town / City <abbr class="form-required" title="required">*</abbr></label>
						                  	<input class="input-md form-full-width" name="billing_town_city" title="Town / City" value="" placeholder="" type="text" required="" aria-required="true">
						                </div>
						                <div class="form-field-wrapper form-center col-sm-6">
						                  	<label for="postal_code" class="left"> Zip <abbr class="form-required" title="required">*</abbr></label>
						                  	<input class="input-md form-full-width" name="postal_code" title="Town / City" value="" placeholder="" type="text" required="" aria-required="true">
						                </div>

						                <div class="form-field-wrapper form-center col-sm-12">
						                  	<label for="order_notes" class="left"> Order notes (optional)
						                  	</label>
						                  	<textarea style="height: 150px;" class="input-md w-100" name="order_notes" title="Enter Email" value="" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
						                </div>
					              	</div>
						            <div class="form-groups">
						                <div class="custom-control custom-checkbox">
						                  	<input class="custom-control-input" type="checkbox" id="same_address" value="1" name="same_ship_address">
						                  	<label class="custom-control-label" for="same_address">Same as billing address</label>
						                </div>
						            </div>
						            <div class="form-groups">
						                <div class="custom-control custom-checkbox">
						                  	<input class="custom-control-input" value="1" type="checkbox" id="trams__condition">
						                  	<label class="custom-control-label" for="trams__condition">This site is protected by reCAPTCHA and the <a class="privacy_link" href="{{ isset($privacy) ? route('DynamicPageView',$privacy->slug) : '#'}}" target="_blank">Privacy Policy</a> and <a class="privacy_link" href="{{ isset($terms) ? route('DynamicPageView',$terms->slug) : '#'}}" target="_blank">Terms of Service</a> apply. </label>
						                </div>
						            </div>
						        
					            </form>
					            <div class="d-flex justify-content-between paddin-top-1x mt-4">
					                <a class="btn btn-primary btn-sm" href="{{route('cart.index')}}">
					                  	<span>
					                    	<i class="fa fa-arrow-left" aria-hidden="true"></i>Back To Cart 
					                    </span>
					                </a>
					                <button disabled="" onclick="updateBillingData()" id="continue__button" class="btn btn-primary  btn-sm" type="submit">
					                  	<span class="">Continue</span>
					                  	<i class="fa fa-arrow-right" aria-hidden="true"></i>
					                </button>
					            </div>
						        
				            </div>
				            @include('user.inc.bill')
				        </div>
			        </div>
			        <!-- tabs 2 -->
			        <div class="col-md-12 tab-pane" data-tag="tick">
				        <div class="row">
				            <div class="col-md-8">
				            	<form action="{{route('shipping.form-data')}}" id="shipping_form" method="post" accept-charset="utf-8">
				            		@csrf
				            	
						            <h3 class="payment_title">Shipping Address:</h3>
						            <div class="row">
						                <div class="form-field-wrapper form-center col-sm-6">
							                <label for="shipping_first_name" class="left"> First name <abbr class="form-required" title="required">*</abbr>
							                </label>
						                  	<input class="input-md form-full-width" name="shipping_first_name" title="First Name" value="" type="text" required="" aria-required="true">
						                </div>
						                <div class="form-field-wrapper form-center col-sm-6">
						                  	<label for="shipping_last_name" class="left"> Last name <abbr class="form-required" title="required">*</abbr>
						                  	</label>
						                  	<input class="input-md form-full-width" name="shipping_last_name" title="Last Name" value="" type="text" required="" aria-required="true">
						                </div>
						                <div class="form-field-wrapper form-center col-sm-6">
						                  	<label for="shipping_email" class="left"> Email <abbr class="form-required" title="required">*</abbr>
						                  	</label>
						                  	<input class="input-md form-full-width" name="shipping_email" title="Enter Email" value="" placeholder="Enter Email" type="email" required="" aria-required="true">
						                </div>
						                <div class="form-field-wrapper form-center col-sm-6">
						                  	<label for="shipping_phone" class="left"> Phone <abbr class="form-required" title="required">*</abbr>
						                  	</label>
						                  	<input class="input-md form-full-width" name="shipping_phone" title="phone" value="" placeholder="(+00) 123 456 7890" type="tel" required="" aria-required="true">
						                </div>
						                
						                <div class="form-field-wrapper form-center col-sm-12">
						                  	<label for="shipping_company" class="left">Company name (optional)</label>
						                  	<input class="input-md form-full-width" name="shipping_company" title="Company Name" value="" type="text">
						                </div>
						                <div class="form-field-wrapper form-center col-sm-12">
						                  	<label for="shipping_address" class="left"> Street address 
						                  		<abbr class="form-required" title="required">*</abbr>
						                  	</label>
						                  	<input class="mb-3 input-md form-full-width mb-20" name="shipping_address" title="Address" value="" placeholder="House number and street name" type="text" required="" aria-required="true">
						                  	<input class="input-md form-full-width" name="shipping_address_op" title="Address" value="" placeholder="Apartment, suite, unit, etc. (optional)" type="text" aria-required="true">
						                </div>
						                <div class="form-field-wrapper form-center col-sm-6">
						                  	<label for="shipping_town_city" class="left"> Town / City <abbr class="form-required" title="required">*</abbr>
						                  	</label>
						                  	<input class="input-md form-full-width" name="shipping_town_city" title="Town / City" value="" placeholder="" type="text" required="" aria-required="true">
						                </div>
						                <div class="form-field-wrapper form-center col-sm-6">
						                  	<label for="shipping_postal_code" class="left"> Zip <abbr class="form-required" title="required">*</abbr>
						                  	</label>
						                  	<input class="input-md form-full-width" name="shipping_postal_code" title="Zip" value="" placeholder="" type="text" required="" aria-required="true">
						                </div>
						                
						            </div>
						        </form>
					            <div class="d-flex justify-content-between paddin-top-1x mt-4">
					                <a class="btn btn-primary btn-sm" href="{{route('cart.index')}}">
					                  	<span>
					                    	<i class="fa fa-arrow-left" aria-hidden="true"></i>Back To Cart 
					                    </span>
					                </a>
					                <button disabled="" onclick="updateShippingData()" id="continue__button_second" class="btn btn-primary  btn-sm" type="submit">
					                  <span class="hidden-xs-down">Continue</span>
					                  <i class="fa fa-arrow-right" aria-hidden="true"></i>
					                </button>
					            </div>
				            </div>
				            @include('user.inc.bill')
				        </div>
			        </div>
			        <!-- tabs 3 -->
			        <div class="col-md-12 tab-pane" data-tag="uncategorized">
				        <div class="row">
				            <div class="col-md-8 box_carding">
					            <h3 class="payment_title">Review Your Order :</h3>
					            <div class="row">
					                <div class="card">
						                <div class="card-body">
						                    <hr>
						                    <div class="row padding-top-1x  mb-4">

										    <?php
										        $orderData = session('order_data');
										    ?>
						                    @if (isset($orderData) && !empty($orderData))
											    <div class="col-sm-6">
							                        <h6>Invoice address :</h6>
							                        <ul class="list-unstyled">
							                          	<li>
							                            	<span class="text-muted">Name: </span><p id="billing_name"></p>
							                          	</li>
							                          	<li>
							                            	<span class="text-muted">Address: </span><p id="billing_address"></p>
							                          	</li>
							                          	<li>
							                            	<span class="text-muted">Phone: </span><p id="billing_phone"></p>
							                          	</li>
							                        </ul>
							                    </div>

							                    <div class="col-sm-6">
							                        <h6>Shipping address :</h6>
							                        <ul class="list-unstyled">
							                          	<li>
							                            	<span class="text-muted">Name: </span><p id="shipping_name"></p>
							                          	</li>
							                          	<li>
							                            	<span class="text-muted">Address: </span><p id="shipping_address"></p>
							                          	</li>
							                          	<li>
							                            	<span class="text-muted">Phone: </span><p id="shipping_phone"></p>
							                          	</li>
							                        </ul>
							                    </div>
											@endif
						                    
							                    <div class="col-sm-12">
							                    	<h5 class="payment_title">Shipping Options * :</h5>
							                    	<div class="col-sm-6 mb-4">
                                    					
					                                    <select name="shipping_id" class="form-control" id="shipping_id_select" required="">
					                                        <option selected="" disabled="">Select Shipping Method</option>
					                                        @foreach($shippings as $shipping)
					                                        <option value="{{$shipping->id}}" data-title="{{$shipping->title}}" data-cost="{{$shipping->cost}}">{{$shipping->title}} (&#2547;{{$shipping->cost}})</option>
					                                        @endforeach
					                                    </select>

                                    					<small class="text-primary shipping_message">Please select shipping method (Required)</small>
                                    
                                                    </div>
							                    </div>
						                    </div>
						                    <h6>Pay with :</h6>
						                    <div class="row mt-4">
							                    <div class="col-12">
							                        <div id="gatewayDisplayDiv" class="payment-methods" style="display: none;">
							                        	@foreach($gateways as $gateway)

							                        		<div class="single-payment-method">
									                            <a class="text-decoration-none" href="#" data-toggle="modal" data-target="#exampleModal" data-details="{{$gateway->text}}" data-title="{{$gateway->name}}" data-slug="{{$gateway->slug}}">
									                            	<img class=""  src="{{Storage::disk('local')->url($gateway->image)}}" alt="{{$gateway->name}}" title="{{$gateway->name}}">
									                              	<p>{{$gateway->name}}</p>
									                            </a>
									                        </div>
								                        	
									                    @endforeach
							                        </div>
							                    </div>
						                    </div>
						                </div>
					                </div>
					            </div>
				            </div>
				            @include('user.inc.lastStageBill')
				        </div>
			        </div>
		      	</div>
		    </div>
		</section>
		<!-- End Page Content -->

  		<!-- modal -->
  		<div class="modal_section">
		    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
				    <div class="modal-content">
					    <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel"></h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          	<span aria-hidden="true">&times;</span>
					        </button>
					    </div>
					    <div class="modal-body">
					        <p id="model-details"></p>
					    </div>
					    <div class="modal-footer">
					        <button type="button" class="btn btn-primary" data-dismiss="modal"><span>Cancel</span></button>
					        @php
		                		$inv = uniqid();
		                	@endphp
					        <form action="" id="checkoutPaymentForm" method="post" accept-charset="utf-8">
					        	@csrf
					        	<input type="hidden" name="invoice" value="{{$inv}}">
					        </form>
				        	<button type="submit" id="model-button" style="color: white;" class="btn btn-info"><span>Checkout</span></button>
					    </div>
				    </div>
				</div>
			</div>
  		</div>
		<!-- end modal -->
		<!-- Stripe Model -->
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

			            <form id="payment-form" method="post" action="{{route('stripePayment.store')}}">
					        @csrf

				            <!-- Modal Body -->
				            <div class="modal-body">
				            	<p id="stripe-model-details"></p>
						        @php
			                		$inv = uniqid();
			                	@endphp

							    <input type="hidden" name="invoice" id="stripeInvoice" value="{{$inv}}">
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
		<!-- End Stripe Model -->
		<!-- THe Payment Success Message Model -->
		<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
		    <div class="modal-dialog" style="height:600px;">
		        <div class="modal-content" >
		            <div class="modal-header">
		                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
		            </div>
		            <div class="modal-body">
		                <div class="gatewaySuccess">
					        <div class="checkmarkDiv">
					            <i class="checkmark">✓</i>
					        </div>
					        <h1>Success</h1>
					        <p>We received your purchase request; <br/> we'll be in touch shortly!</p>
					        <h3 id="transaction-id">Transaction ID: -</h3>
					        <strong>Tracking ID:</strong><p id="tracking_id"></p> 
			        	</div>
		            </div>

		            <div class="modal-footer">
				        <a href="{{route('main')}}" class="btn btn-primary" data-dismiss="modal"><span>Go Back</span></a>
				    </div>
		        </div>
		    </div>
		</div>
	</div>
@endsection
@section('user_js_content')
	<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	

	<script type="text/javascript">
        const stripe = Stripe('{{ env('STRIPE_KEY') }}'); 

        const stripecheckoutloader = document.getElementById('ajax-loading-container');
		const stripetransactionIdElement = document.getElementById('transaction-id');
		const stripeTrackingId = document.getElementById('tracking_id');
        const elements = stripe.elements();

        const cardNumberElement = elements.create('cardNumber');
        const cardExpiryElement = elements.create('cardExpiry');
        const cardCvcElement = elements.create('cardCvc');

        cardNumberElement.mount('.card-number-element');
        cardExpiryElement.mount('.card-expiry-element');
        cardCvcElement.mount('.card-cvc-element');

        const form = document.getElementById('payment-form');

        form.addEventListener('submit', (event) => {
            event.preventDefault();

            stripe.createToken(cardNumberElement, {
                name: document.getElementById('card-holder-name').value
            }).then((result) => {
                if (result.error) {
                    console.error(result.error.message);
                    return;
                }

                const token = result.token.id; // Access the token ID
                const formAction = form.getAttribute('action'); 
                const formData = {
                    stripeToken: token,
                    card_holder_name: document.getElementById('card-holder-name').value,
                    invoice: document.getElementById('stripeInvoice').value
                };

                const closeStripeButton = document.querySelector('.stripeClose'); 
			    if (closeStripeButton) {
			        closeStripeButton.click();
			    }  else {
			        console.warn("Close button with classes 'stripeClose' not found.");
			    }

                stripecheckoutloader.style.display = '';
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
                    stripecheckoutloader.style.display = 'none';
                    return response.json();
                })
                .then(data => {
					stripecheckoutloader.style.display = 'none';

                    // **Update transaction ID:**
                    const transactionId = data.transectionId; 
                    stripetransactionIdElement.textContent = `Transaction ID: ${transactionId}`;
                    const trackingId = data.trackingId;
                    stripeTrackingId.textContent = `Transaction ID: ${trackingId}`;

				    // Show the success modal
					const successModal = new bootstrap.Modal(document.getElementById('successModal'));
					successModal.show();


                    form.reset();
                })
                .catch(error => {
                    console.error('Error submitting payment:', error);
                    stripecheckoutloader.style.display = 'none';
                });
                
            });
        });

    </script>


	<script type="text/javascript">

		const firstNameInput = document.querySelector('input[name="billing_first_name"]');
		const lastNameInput = document.querySelector('input[name="billing_last_name"]');
		const emailInput = document.querySelector('input[name="billing_email"]');
		const phoneInput = document.querySelector('input[name="billing_phone"]');
		const streetInput = document.querySelector('input[name="billing_address"]');
		const townCityInput = document.querySelector('input[name="billing_town_city"]');
		const zipInput = document.querySelector('input[name="postal_code"]'); // Assuming zip code is in billing address field
		const termsCheckbox = document.querySelector('#trams__condition');
		const continueButton = document.querySelector('#continue__button');

		const billingTab = document.querySelector('#new-arrivals');
		const shippingTab = document.querySelector('#shipping_tab');
		const reviewTab = document.querySelector('#review_tab');

		const sameAddressCheckbox = document.getElementById('same_address');

		function areFieldsFilled() {
			return (
			    firstNameInput.value !== '' &&
			    lastNameInput.value !== '' &&
			    emailInput.value !== '' &&
			    phoneInput.value !== '' &&
			    streetInput.value !== '' &&
			    townCityInput.value !== '' &&
			    zipInput.value !== ''
			);
		}

		function updateButtonState() {
		  	const allFilled = areFieldsFilled();
		  	continueButton.disabled = !allFilled || !termsCheckbox.checked;
		}
		// Event listener for changes in any required field
		[firstNameInput, lastNameInput, emailInput, phoneInput, townCityInput, zipInput].forEach(input => {
		  	input.addEventListener('keyup', updateButtonState);
		});

		// Event listener for checkbox change
		termsCheckbox.addEventListener('change', updateButtonState);
		
		// Call updateButtonState initially to set the button state based on the initial page load
		updateButtonState();

		// continueButton.addEventListener('click', function() {
		// 	var form = document.getElementById('billing_form');
        //     var formData = new FormData(form);
        //     console.log(formData);
	    //     $.ajax({
	    //         url: '{{route('billing.form-data')}}',
        //         method: 'post',
        //         data: formData,
        //         processData: false,
        //         contentType: false,
	    //         success: function(response) {
	    //         	console.log(response);
	    //         	if (sameAddressCheckbox.checked) {
		// 		  		// Optional: Hide the review tab if needed
		// 		    	billingTab.classList.remove('is-active');
		// 		    	shippingTab.classList.remove('is-active'); // Or use another method to hide the tab

		// 		  		reviewTab.classList.add('is-active');
		// 		    	reviewTab.dataset.toggle = 'portfilter';
		// 		    	reviewTab.dataset.target = 'uncategorized';
		// 		    	reviewTab.click();
		// 		  	} else {

		// 		  		billingTab.classList.remove('is-active');
		// 		  		reviewTab.classList.remove('is-active'); // Or use another method to hide the tab

		// 		  		shippingTab.classList.add('is-active');
		// 		    	shippingTab.dataset.toggle = 'portfilter';
		// 		    	shippingTab.dataset.target = 'tick';
		// 		    	shippingTab.click();
		// 		    	// Optional: Hide the review tab if needed
				    	
				    	

		// 		  	}
	    //             // Handle success response, e.g., show success message
	    //             toastr.success('Billing Data Add successfully.');
	    //         },
	    //         error: function(error) {
	    //             // Handle error response, e.g., show error message
	    //             alert('Error updating billing data.');
	    //         }
	    //     });
		// });

		function updateBillingData() {
	    	var form = document.getElementById('billing_form');
            var formData = new FormData(form);

	        $.ajax({
	            url: form.action,
                method: form.method,
                data: formData,
                processData: false,
                contentType: false,
	            success: function(response) {
	            	if (sameAddressCheckbox.checked) {
				  		// Optional: Hide the review tab if needed
				    	billingTab.classList.remove('is-active');
				    	shippingTab.classList.remove('is-active'); // Or use another method to hide the tab

				  		reviewTab.classList.add('is-active');
				    	reviewTab.dataset.toggle = 'portfilter';
				    	reviewTab.dataset.target = 'uncategorized';
				    	reviewTab.click();

				    	fetchOrderData();
				  	} else {

				  		billingTab.classList.remove('is-active');
				  		reviewTab.classList.remove('is-active'); // Or use another method to hide the tab

				  		shippingTab.classList.add('is-active');
				    	shippingTab.dataset.toggle = 'portfilter';
				    	shippingTab.dataset.target = 'tick';
				    	shippingTab.click();
				    	// Optional: Hide the review tab if needed
				    	
				    	

				  	}
	                // Handle success response, e.g., show success message
	                // toastr.success('Billing Data Add successfully.');
	            },
	            error: function(error) {
	                // Handle error response, e.g., show error message
	                alert('Error updating Billing Data.');
	            }
	        });
	    }


		const shippingfirstNameInput = document.querySelector('input[name="shipping_first_name"]');
		const shippinglastNameInput = document.querySelector('input[name="shipping_last_name"]');
		const shippingemailInput = document.querySelector('input[name="shipping_email"]');
		const shippingphoneInput = document.querySelector('input[name="shipping_phone"]');
		const shippingstreetInput = document.querySelector('input[name="shipping_address"]');
		const shippingtownCityInput = document.querySelector('input[name="shipping_town_city"]');
		const shippingzipInput = document.querySelector('input[name="shipping_postal_code"]'); // Assuming zip code is in billing address field
		const shippingcontinueButton = document.querySelector('#continue__button_second');

		function shippingareFieldsFilled() {
			return (
			    shippingfirstNameInput.value !== '' &&
			    shippinglastNameInput.value !== '' &&
			    shippingemailInput.value !== '' &&
			    shippingphoneInput.value !== '' &&
			    shippingstreetInput.value !== '' &&
			    shippingtownCityInput.value !== '' &&
			    shippingzipInput.value !== ''
			);
		}

		function shippingupdateButtonState() {
		  	const shippingallFilled = shippingareFieldsFilled();
		  	shippingcontinueButton.disabled = !shippingallFilled;
		}
		// Event listener for changes in any required field
		[shippingfirstNameInput, shippinglastNameInput, shippingemailInput, shippingphoneInput, shippingtownCityInput, shippingzipInput].forEach(input => {
		  	input.addEventListener('keyup', shippingupdateButtonState);
		});
		
		shippingupdateButtonState();

		function updateShippingData() {
	    	var form = document.getElementById('shipping_form');
            var formData = new FormData(form);

	        $.ajax({
	            url: form.action,
                method: form.method,
                data: formData,
                processData: false,
                contentType: false,
	            success: function(response) {
	            	billingTab.classList.remove('is-active');
				  	shippingTab.classList.remove('is-active');
			  		reviewTab.classList.add('is-active');
			    	reviewTab.dataset.toggle = 'portfilter';
			    	reviewTab.dataset.target = 'uncategorized';
			    	reviewTab.click();

			    	fetchOrderData();
	                // Handle success response, e.g., show success message
	                // toastr.success('Shipping Data Add successfully.');
	            },
	            error: function(error) {
	                // Handle error response, e.g., show error message
	                alert('Error updating Shipping Data.');
	            }
	        });
	    }
	    const shippingSelect = document.getElementById('shipping_id_select');
	    const gatewayDisplayDiv = document.getElementById('gatewayDisplayDiv');

		shippingSelect.addEventListener('change', function(event) {
		    const selectedShippingId = event.target.value;
		    const selectedShippingTitle = event.target.selectedOptions[0].dataset.title; 
		    const selectedShippingCost = event.target.selectedOptions[0].dataset.cost;
		    $.ajax({
	            url: '{{route('shipping.method.option')}}',
                method: 'post',
                headers: {
			        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
			    },
                data: {
				    shipping_id: selectedShippingId,
				    shipping_title: selectedShippingTitle,
				    shipping_cost: selectedShippingCost, // Assuming you have this value
				},
	            success: function(response) {
	            	const shippingCostShow = document.getElementById('shipping_cost_show');
	            	const shippingMethodTex = document.getElementById('shippingMethodTex');
	            	const cartTotal = document.getElementById('cartTotal');
	            	// console.log(response);

            		shippingMethodTex.innerHTML =  ' ৳ ' + response.shipping_method_cost;
            		cartTotal.textContent = '৳ ' + response.total;

			      	shippingCostShow.style.display = '';
			      	gatewayDisplayDiv.style.display = '';
				    
	                // toastr.success('Shipping Method Selected.');
	            },
	            error: function(error) {
	                // Handle error response, e.g., show error message
	                alert('Error updating Shipping Method Data.');
	            }
	        });

		});

		const paymentMethods = document.querySelectorAll('.single-payment-method');
		const modelButton = document.getElementById('model-button');
    	const PaymentForm = document.getElementById('checkoutPaymentForm');
    	const transactionIdElement = document.getElementById('transaction-id');
    	const trackingIDElement = document.getElementById('tracking_id');
    	// Function to set the form action
		function setFormAction(newAction) {
		  	PaymentForm.action = newAction;
		}

		paymentMethods.forEach(paymentMethod => {
		  	const paymentMethodLink = paymentMethod.querySelector('a.text-decoration-none');

		  	paymentMethodLink.addEventListener('click', function(event) {
		   		event.preventDefault(); // Prevent default anchor tag behavior (navigation)

		    	const modalTitle = document.getElementById('exampleModalLabel'); // Get the modal title element
		    	const modalBody = document.getElementById('model-details'); // Get the modal body element
		    	

		    	modalTitle.textContent = paymentMethodLink.dataset.title; // Set modal title from data-title attribute
		    	modalBody.innerHTML = paymentMethodLink.dataset.details; // Set modal body 
		    	const slug = paymentMethodLink.dataset.slug;
		    	modelButton.setAttribute('data-slug', slug);
			  	let newAction;

				switch (slug) {
				    case 'bkash':
				      	newAction = '{{route('bkashPayment.store')}}';
				      	break;
				    case 'stripe':
				      	newAction = '{{route('stripePayment.index')}}';
				      	break;
				    case 'paypal':
				      	newAction = '{{route('paypalPayment.store')}}';
				      	break;
				    default:
				      	newAction = '{{route('codPayment.store')}}'; 
				}

				setFormAction(newAction);
				
		  	});

		  	
		});

		modelButton.addEventListener('click', function(event) {
			const slug = modelButton.dataset.slug; 
			const closeButton = document.querySelector('.close');
			const checkoutloader = document.getElementById('ajax-loading-container');

			if (slug === 'bkash') {
			    checkoutPaymentForm.submit(); // Page reload for bkash
			}else if (slug === 'paypal') {
			    checkoutPaymentForm.submit(); // Page reload for bkash
			} else if(slug === 'stripe'){
				event.preventDefault(); // Prevent default form submission

			    // checkoutloader.style.display = '';

			    const form = document.getElementById('checkoutPaymentForm');
			    const formData = new FormData(form);

			    const anchor = document.createElement('a');
			    anchor.style.display = 'none'; // Ensure anchor is hidden
			    anchor.href = form.action; 
			    // anchor.target = "_blank";

			    const queryString = new URLSearchParams(formData); 
			    anchor.search = queryString.toString();

			    document.body.appendChild(anchor); 

			    anchor.click();
			    setTimeout(function() {
			      document.body.removeChild(anchor);
			    }, 100); // Adjust delay if needed
			} else {
			    event.preventDefault();
			    
			    if (closeButton) {
			        closeButton.click();
			    } else {
			        console.warn("Close button with classes 'close' not found.");
			    }
			    checkoutloader.style.display = '';

			    var form = document.getElementById('checkoutPaymentForm');
			    var formData = new FormData(form);

		        $.ajax({
		            url: form.action,
	                method: form.method,
	                data: formData,
	                processData: false,
	                contentType: false,
		            success: function(response) {

		            	const transactionId = response.transectionId; 
	                    transactionIdElement.textContent = `Transaction ID: ${transactionId}`;
	                    const tracking_id = response.trackingId;
	                    trackingIDElement.textContent = tracking_id;
		            	// Show the success modal
						const successModal = new bootstrap.Modal(document.getElementById('successModal'));
						successModal.show();

						// Clear the form fields (optional)
	                    form.reset();
	                    checkoutloader.style.display = 'none';
		                // Handle success response, e.g., show success message
		                // toastr.success('Meta Content updated successfully.');
		            },
		            error: function(error) {
		            	checkoutloader.style.display = 'none';
		                // Handle error response, e.g., show error message
		                alert('Error Checkout Form Submission.');

		            }
		        });
			}
		});

		function fetchOrderData() {
			$.ajax({
			    url: '{{route('checkout.session_data')}}', // Replace with your actual route
			    method: 'GET',
			    success: function(response) {
			      	if (response.success) {
			        	// Update billing data using data object
					  	const billingName = document.querySelector('#billing_name');
					  	const billingAddress = document.querySelector('#billing_address');
					  	const billingPhone = document.querySelector('#billing_phone');
					  	billingName.textContent = response.data.billing_first_name + ' ' + response.data.billing_last_name;
					  	billingAddress.textContent = response.data.billing_address;
					  	billingPhone.textContent = response.data.billing_phone;

					  	// Update Shipping data using data object
					  	const shippingName = document.querySelector('#shipping_name');
					  	const shippingAddress = document.querySelector('#shipping_address');
					  	const shippingPhone = document.querySelector('#shipping_phone');
					  	shippingName.textContent = response.data.shipping_first_name + ' ' + response.data.shipping_last_name;
					  	shippingAddress.textContent = response.data.shipping_address;
					  	shippingPhone.textContent = response.data.shipping_phone;
			      	} else {
			        	// Handle error case (optional)
			        	// console.error('Error fetching order data:', response.message);
			      	}
			    },
			    error: function(error) {
			      	console.error('Error:', error);
			    }
			});
		}

	</script>
@endsection