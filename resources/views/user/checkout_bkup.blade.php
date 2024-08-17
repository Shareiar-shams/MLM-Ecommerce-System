@extends('user.layouts.layout')
@section('user_title_content')
    Ahknoxo | Checkout
@endsection
@section('user_css_content')
@endsection

@section('user_main_content')
	<!-- Page Content Wraper -->
	<div class="page-content-wraper">
		<!-- Bread Crumb -->
		<section class="banner_section">
			<div class="container">
				<div class="row">
				    <div class="col-7">
				      	<h3 class="mb-0 text-capitalize">Payment</h3>
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
		            <a class="is-active" href="javascript:void(0)" data-toggle="portfilter" data-target="crates">Billing Address:</a>
		          </li>
		          <li>
		            <a href="javascript:void(0)" data-toggle="portfilter" data-target="tick">Shipping Address:</a>
		          </li>
		          <li>
		            <a href="javascript:void(0)" data-toggle="portfilter" data-target="uncategorized">Review and pay</a>
		          </li>
		        </ul>
		      </div>
		      <div class="row tab-content clearfix" id="myTabContent">
		        <div class="col-md-12 tab-pane fade show active" id="new-arrivals" role="tabpanel" aria-labelledby="new-arrivals-tab">
		          <div class="row " data-tag="crates">
		            <div class="col-md-8">
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
		                <div class="form-field-wrapper form-center col-sm-12">
		                  	<label for="billing_company" class="left">Company name (optional)</label>
		                  	<input class="input-md form-full-width" name="billing_company" title="Company Name" value="" type="text">
		                </div>
		                <div class="form-field-wrapper form-center col-sm-12">
		                  	<label for="billing_country" class="left"> Country / Region <abbr class="form-required" title="required">*</abbr></label>
			                <select name="billing_country" id="billing_country" class="input-md form-full-width" autocomplete="country" tabindex="-1" aria-hidden="true" required="" aria-required="true">
			                    <option value="">Select a country�</option>
			                    <option value="AU">Australia</option>
			                    <option value="AT">Austria</option>
			                    <option value="AZ">Azerbaijan</option>
			                    <option value="BS">Bahamas</option>
			                    <option value="BH">Bahrain</option>
			                    <option value="BD">Bangladesh</option>
			                    <option value="BB">Barbados</option>
			                    <option value="BY">Belarus</option>
			                    <option value="PW">Belau</option>
			                    <option value="BE">Belgium</option>
			                    <option value="BZ">Belize</option>
			                    <option value="BJ">Benin</option>
			                    <option value="BM">Bermuda</option>
			                    <option value="BT">Bhutan</option>
			                    <option value="BO">Bolivia</option>
			                    <option value="BQ">Bonaire, Saint Eustatius and Saba</option>
			                    
			                </select>
		                </div>
		                <div class="form-field-wrapper form-center col-sm-12">
		                  	<label for="billing_address" class="left"> Street address <abbr class="form-required" title="required">*</abbr></label>
		                  	<input class="mb-3 input-md form-full-width mb-20" name="billing_address" title="Address" value="" placeholder="House number and street name" type="text" required="" aria-required="true">

		                  	<input class="input-md form-full-width" name="billing_address_op" title="Address" value="" placeholder="Apartment, suite, unit, etc. (optional)" type="text" required="" aria-required="true">
		                </div>
		                <div class="form-field-wrapper form-center col-sm-12">
		                  	<label for="billing_town_city" class="left"> Town / City <abbr class="form-required" title="required">*</abbr></label>
		                  	<input class="input-md form-full-width" name="billing_town_city" title="Town / City" value="" placeholder="" type="text" required="" aria-required="true">
		                </div>
		                <div class="form-field-wrapper form-center col-sm-12">
		                  	<label for="billing_state_county" class="left"> State <abbr class="form-required" title="required">*</abbr></label>
		                  	<input class="input-md form-full-width" name="billing_state_county" title="State" value="" placeholder="" type="text" required="" aria-required="true">
		                </div>
		                <div class="form-field-wrapper form-center col-sm-12">
		                  	<label for="country_state" class="left"> State <abbr class="form-required" title="required">*</abbr></label>
			                <select name="billing_country" id="billing_country" class="input-md form-full-width" autocomplete="country" tabindex="-1" aria-hidden="true" required="" aria-required="true">
			                    <option value="">Select a country�</option>
			                    <option value="AU">Australia</option>
			                    <option value="AT">Austria</option>
			                    <option value="AZ">Azerbaijan</option>
			                    <option value="BS">Bahamas</option>
			                    <option value="BH">Bahrain</option>
			                    <option value="BD">Bangladesh</option>
			                    <option value="BB">Barbados</option>
			                    <option value="BY">Belarus</option>
			                    <option value="PW">Belau</option>
			                    <option value="BE">Belgium</option>
			                    <option value="BZ">Belize</option>
			                    <option value="BJ">Benin</option>
			                    <option value="BM">Bermuda</option>
			                    <option value="BT">Bhutan</option>
			                    <option value="BO">Bolivia</option>
			                    <option value="BQ">Bonaire, Saint Eustatius and Saba</option>
			                    
			                </select>
		                </div>
		                <div class="form-field-wrapper form-center col-sm-6">
		                  <label for="billing_phone" class="left"> Phone <abbr class="form-required" title="required">*</abbr>
		                  </label>
		                  <input class="input-md form-full-width" name="billing_phone" title="phone" value="" placeholder="(+00) 123 456 7890" type="tel" required="" aria-required="true">
		                </div>
		                <div class="form-field-wrapper form-center col-sm-6">
		                  <label for="billing_email" class="left"> Email <abbr class="form-required" title="required">*</abbr>
		                  </label>
		                  <input class="input-md form-full-width" name="billing_email" title="Enter Email" value="" placeholder="Enter Email" type="email" required="" aria-required="true">
		                </div>
		                <div class="form-field-wrapper form-center col-sm-12">
		                  <label for="order_notes" class="left"> Order notes (optional) <abbr class="form-required" title="required">*</abbr>
		                  </label>
		                  <textarea style="height: 150px;" class="input-md w-100" name="order_notes" title="Enter Email" value="" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
		                </div>
		              </div>
		              <div class="form-groups">
		                <div class="custom-control custom-checkbox">
		                  <input class="custom-control-input" type="checkbox" id="same_address" name="same_ship_address">
		                  <label class="custom-control-label" for="same_address">Same as billing address</label>
		                </div>
		              </div>
		              <div class="form-groups">
		                <div class="custom-control custom-checkbox">
		                  <input class="custom-control-input" type="checkbox" id="trams__condition">
		                  <label class="custom-control-label" for="trams__condition">This site is protected by reCAPTCHA and the <a href="#" target="_blank">Privacy Policy</a> and <a href="#" target="_blank">Terms of Service</a> apply. </label>
		                </div>
		              </div>
		              <div class="d-flex justify-content-between paddin-top-1x mt-4">
		                <a class="btn btn-primary btn-sm" href="cart.php">
		                  <span class="">
		                    <i class="fa fa-arrow-left" aria-hidden="true"></i>Back To Cart </span>
		                </a>
		                <button disabled="" id="continue__button" class="btn btn-primary  btn-sm" type="button">
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
		          <div class="row  ">
		            <div class="col-md-8">
		              <h3 class="payment_title">Shipping Address:</h3>
		              <div class="row">
		                <div class="form-field-wrapper form-center col-sm-6">
		                  <label for="billing_first_name" class="left"> First name <abbr class="form-required" title="required">*</abbr>
		                  </label>
		                  <input class="input-md form-full-width" name="billing_first_name" title="First Name" value="" type="text" required="" aria-required="true">
		                </div>
		                <div class="form-field-wrapper form-center col-sm-6">
		                  <label for="billing_last_name" class="left"> Last name <abbr class="form-required" title="required">*</abbr>
		                  </label>
		                  <input class="input-md form-full-width" name="billing_last_name" title="Last Name" value="" type="text" required="" aria-required="true">
		                </div>
		                <div class="form-field-wrapper form-center col-sm-12">
		                  <label for="billing_company" class="left">Company name (optional)</label>
		                  <input class="input-md form-full-width" name="billing_company" title="Company Name" value="" type="text">
		                </div>
		                <div class="form-field-wrapper form-center col-sm-12">
		                  <label for="billing_country" class="left"> Country / Region <abbr class="form-required" title="required">*</abbr>
		                  </label>
		                  <select name="billing_country" id="billing_country" class="input-md form-full-width" autocomplete="country" tabindex="-1" aria-hidden="true" required="" aria-required="true">
		                    <option value="">Select a country�</option>
		                    <option value="AU">Australia</option>
		                    <option value="AT">Austria</option>
		                    <option value="AZ">Azerbaijan</option>
		                    <option value="BS">Bahamas</option>
		                    <option value="BH">Bahrain</option>
		                    <option value="BD">Bangladesh</option>
		                    <option value="BB">Barbados</option>
		                    <option value="BY">Belarus</option>
		                    <option value="PW">Belau</option>
		                    <option value="BE">Belgium</option>
		                    <option value="BZ">Belize</option>
		                    <option value="BJ">Benin</option>
		                    <option value="BM">Bermuda</option>
		                    <option value="BT">Bhutan</option>
		                    <option value="BO">Bolivia</option>
		                    <option value="BQ">Bonaire, Saint Eustatius and Saba</option>
		                    
		                  </select>
		                </div>
		                <div class="form-field-wrapper form-center col-sm-12">
		                  <label for="billing_address" class="left"> Street address <abbr class="form-required" title="required">*</abbr>
		                  </label>
		                  <input class="mb-3 input-md form-full-width mb-20" name="billing_address" title="Address" value="" placeholder="House number and street name" type="text" required="" aria-required="true">
		                  <input class="input-md form-full-width" name="billing_address_op" title="Address" value="" placeholder="Apartment, suite, unit, etc. (optional)" type="text" required="" aria-required="true">
		                </div>
		                <div class="form-field-wrapper form-center col-sm-12">
		                  <label for="billing_town_city" class="left"> Town / City <abbr class="form-required" title="required">*</abbr>
		                  </label>
		                  <input class="input-md form-full-width" name="billing_town_city" title="Town / City" value="" placeholder="" type="text" required="" aria-required="true">
		                </div>
		                <div class="form-field-wrapper form-center col-sm-12">
		                  <label for="billing_state_county" class="left"> State <abbr class="form-required" title="required">*</abbr>
		                  </label>
		                  <input class="input-md form-full-width" name="billing_state_county" title="State" value="" placeholder="" type="text" required="" aria-required="true">
		                </div>
		                <div class="form-field-wrapper form-center col-sm-12">
		                  <label for="country_state" class="left"> State <abbr class="form-required" title="required">*</abbr>
		                  </label>
		                  <select name="billing_country" id="billing_country" class="input-md form-full-width" autocomplete="country" tabindex="-1" aria-hidden="true" required="" aria-required="true">
		                    <option value="">Select a country�</option>
		                    <option value="AU">Australia</option>
		                    <option value="AT">Austria</option>
		                    <option value="AZ">Azerbaijan</option>
		                    <option value="BS">Bahamas</option>
		                    <option value="BH">Bahrain</option>
		                    <option value="BD">Bangladesh</option>
		                    <option value="BB">Barbados</option>
		                    <option value="BY">Belarus</option>
		                    <option value="PW">Belau</option>
		                    <option value="BE">Belgium</option>
		                    <option value="BZ">Belize</option>
		                    <option value="BJ">Benin</option>
		                    <option value="BM">Bermuda</option>
		                    <option value="BT">Bhutan</option>
		                    <option value="BO">Bolivia</option>
		                    <option value="BQ">Bonaire, Saint Eustatius and Saba</option>
		                    
		                  </select>
		                </div>
		                <div class="form-field-wrapper form-center col-sm-6">
		                  <label for="billing_phone" class="left"> Phone <abbr class="form-required" title="required">*</abbr>
		                  </label>
		                  <input class="input-md form-full-width" name="billing_phone" title="phone" value="" placeholder="(+00) 123 456 7890" type="tel" required="" aria-required="true">
		                </div>
		                <div class="form-field-wrapper form-center col-sm-6">
		                  <label for="billing_email" class="left"> Email <abbr class="form-required" title="required">*</abbr>
		                  </label>
		                  <input class="input-md form-full-width" name="billing_email" title="Enter Email" value="" placeholder="Enter Email" type="email" required="" aria-required="true">
		                </div>
		                <div class="form-field-wrapper form-center col-sm-12">
		                  <label for="order_notes" class="left"> Order notes (optional) <abbr class="form-required" title="required">*</abbr>
		                  </label>
		                  <textarea style="height: 150px;" class="input-md w-100" name="order_notes" title="Enter Email" value="" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
		                </div>
		              </div>
		              <div class="form-groups">
		                <div class="custom-control custom-checkbox">
		                  <input class="custom-control-input" type="checkbox" id="same_address" name="same_ship_address">
		                  <label class="custom-control-label" for="same_address">Same as billing address</label>
		                </div>
		              </div>
		              <div class="form-groups">
		                <div class="custom-control custom-checkbox">
		                  <input class="custom-control-input" type="checkbox" id="trams__condition">
		                  <label class="custom-control-label" for="trams__condition">This site is protected by reCAPTCHA and the <a href="#" target="_blank">Privacy Policy</a> and <a href="#" target="_blank">Terms of Service</a> apply. </label>
		                </div>
		              </div>
		              <div class="d-flex justify-content-between paddin-top-1x mt-4">
		                <a class="btn btn-primary btn-sm" href="cart.php">
		                  <span class="hidden-xs-down">
		                    <i class="fa fa-arrow-left" aria-hidden="true"></i>Back To Cart </span>
		                </a>
		                <button disabled="" id="continue__button" class="btn btn-primary  btn-sm" type="button">
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
		                      <div class="col-sm-6">
		                        <h6>Invoice address :</h6>
		                        <ul class="list-unstyled">
		                          <li>
		                            <span class="text-muted">Name: </span>Alamgir Ahmed
		                          </li>
		                          <li>
		                            <span class="text-muted">Address: </span>Habiganj, Bahubal
		                          </li>
		                          <li>
		                            <span class="text-muted">Phone: </span>01673140498
		                          </li>
		                        </ul>
		                      </div>
		                      <div class="col-sm-6">
		                        <h6>Shipping address :</h6>
		                        <ul class="list-unstyled">
		                          <li>
		                            <span class="text-muted">Name: </span>Alamgir Ahmed
		                          </li>
		                          <li>
		                            <span class="text-muted">Address: </span>Habiganj, Bahubal
		                          </li>
		                          <li>
		                            <span class="text-muted">Phone: </span>01673140498
		                          </li>
		                        </ul>
		                      </div>
		                    </div>
		                    <h6>Pay with :</h6>
		                    <div class="row mt-4">
		                      <div class="col-12">
		                        <div class="payment-methods">
		                          <div class="single-payment-method">
		                            <a class="text-decoration-none" href="#" data-toggle="modal" data-target="#exampleModal">
		                              <img class="" src="{{asset('viewportimg/cashon.png')}}" alt="Cash On Delivery" title="Cash On Delivery">
		                              <p>Cash On Delivery</p>
		                            </a>
		                          </div>
		                          <div class="single-payment-method">
		                            <a class="text-decoration-none" href="#" data-toggle="modal" data-target="#exampleModal-bkash">
		                              <img class="" src="{{asset('viewportimg/bkash-logo.png')}}" alt="bkash" title="bkash">
		                              <p>Bkash</p>
		                            </a>
		                          </div>
		                          <div class="single-payment-method">
		                            <a class="text-decoration-none" href="#" data-toggle="modal" data-target="#exampleModal-paypal">
		                              <img class="" src="{{asset('viewportimg/paypal-image.png')}}" alt="Paypal" title="Paypal">
		                              <p>Paypal</p>
		                            </a>
		                          </div>
		                          <div class="single-payment-method">
		                            <a class="text-decoration-none" href="#" data-toggle="modal" data-target="#exampleModal-mobile">
		                              <img class="" src="{{asset('viewportimg/mobile.jpeg')}}" alt="Mollie" title="Mollie">
		                              <p>Mollie</p>
		                            </a>
		                          </div>
		                        </div>
		                      </div>
		                    </div>
		                  </div>
		                </div>
		              </div>
		            </div>
		            @include('user.inc.bill')
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
				        <h5 class="modal-title" id="exampleModalLabel">Transaction Cash On Delivery</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        <p>Cash on Delivery basically means you will pay the amount of product while you get the item delivered to you.</p>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-primary" data-dismiss="modal"><span>Cancel</span></button>
				        <button type="button" class="btn btn-primary"><span>Cash On Delivery</span></button>
				      </div>
				    </div>
				</div>
			</div>
  		</div>
		<!-- end modal -->

 		<!-- modal -->
  		<div class="modal_section">
    		<div class="modal fade" id="exampleModal-paypal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
				    <div class="modal-content">
				      	<div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Transactions via PayPal</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          	<span aria-hidden="true">&times;</span>
					        </button>
				      	</div>
				      	<div class="modal-body">
				        	<p>PayPal is the faster & safer way to send money. Make an online payment via PayPal.</p>
				      	</div>
				      	<div class="modal-footer">
					        <button type="button" class="btn btn-primary" data-dismiss="modal"><span>Cancel</span></button>
					        <button type="button" class="btn btn-primary"><span>Checkout With PayPal</span></button>
				      	</div>
				    </div>
				</div>
			</div>
  		</div>
		<!-- end modal -->

		<!-- modal -->
  		<div class="modal_section">
    		<div class="modal fade" id="exampleModal-mobile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Transactions via Mollie</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        <p>Mollie is a Payment Provider for Belgium and the Netherlands, offering payment methods such as credit card, iDEAL, Bancontact/Mister cash, PayPal, SCT, SDD and others.</p>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-primary" data-dismiss="modal"><span>Cancel</span></button>
				        <button type="button" class="btn btn-primary"><span>Checkout With Mollie</span></button>
				      </div>
				    </div>
				  </div>
			</div>
  		</div>
		<!-- end modal -->

		<!-- modal -->
		<div class="modal_section">
			<div class="modal fade" id="exampleModal-bkash" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Transactions via Bkash</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="card-body">
					      	<div class="card-wrapper"></div>
					      		<form class="interactive-credit-card row" action="" method="POST">
					        		<input type="hidden" name="_token" value="n8vdX32njuVetle3FG20IaIMWvNDb3Slby1CszLv">                    
							        <div class="form-group col-sm-12">
							          	<input class="form-control" type="text" name="card" placeholder="Card Number" required="">
							        </div>
					     			<input type="hidden" name="payment_method" value="Stripe">
					     			<input type="hidden" name="state_id" value="" class="state_id_setup">
							        <div class="form-group col-sm-6">
							          	<input class="form-control" type="text" name="month" placeholder="Expitation Month" required="">
							        </div>
							        <div class="form-group col-sm-6">
							          	<input class="form-control" type="text" name="year" placeholder="Expitation Year" required="">
							        </div>
							        <div class="form-group col-sm-12">
							          	<input class="form-control" type="text" name="cvc" placeholder="CVV" required="">
							        </div>

					        		<p class="p-3">Stripe is the faster &amp; safer way to send money. Make an online payment via Bkash.</p>
					    		</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal"><span>Cancel</span></button>
							<button type="button" class="btn btn-primary"><span>Checkout With Bkash</span></button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end modal -->
	</div>
@endsection
@section('user_js_content')
@endsection