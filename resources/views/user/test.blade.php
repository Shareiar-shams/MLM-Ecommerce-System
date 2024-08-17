
<html lang="en">
<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
</head>

<body>
  <div class="container">
    <div class='row'>
	    <div class='col-md-4'></div>
	    <div class='col-md-4'>
	        <form action="{{ route('user.stripe.create.payment') }}" method="post" id="payment-form">
					    @csrf
					    <div id="card-element"></div>
					    <button type="submit">Pay Now</button>
					</form>
	        {{-- <form accept-charset="UTF-8" action="{{route('user.stripe.create.payment')}}" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{env('STRIPE_KEY')}}" id="payment-form" method="post">
	          	@csrf
				        <div class='form-row'>
					        <div class='col-xs-12 form-group required'>
					            <label class='control-label'>Card Holder Name</label>
					            <input class='form-control' size='4' type='text' placeholder="Enter Card Holder Name">
					        </div>
					    </div>
					    <div class='form-row'>
						    <div class='col-xs-12 form-group card required'>
						        <label class='control-label'>Card Number</label>
						        <div class="card-number-element"></div>
						    </div>
						</div>
						<div class='form-row'>
						    <div class='col-xs-4 form-group cvc required'>
						        <label class='control-label'>CVC</label>
						        <div class="card-cvc-element"></div>
						    </div>
						    <div class='col-xs-4 form-group expiration required'>
						        <label class='control-label'>Expiration</label>
						        <div class="card-expiry-element"></div>
						    </div>
						</div>
					    <div class='form-row'>
					        <div class='col-md-12 form-group'>
					            <button class='form-control btn btn-primary submit-button' type='submit' style="margin-top: 10px;">Confirm</button>
					        </div>
					    </div>
			        <div class='form-row'>
			            <div class='col-md-12 error form-group hide'>
			              <div class='alert-danger alert'>Please correct the errors and try
			                again.</div>
			            </div>
			        </div>
	        </form>
	        @if ((Session::has('success-message')))
	        <div class="alert alert-success col-md-12">{{
	          Session::get('success-message') }}</div>
	        @endif @if ((Session::has('fail-message')))
	        <div class="alert alert-danger col-md-12">{{
	          Session::get('fail-message') }}</div>
	        @endif --}}
	    </div>
	    <div class='col-md-4'></div>
    </div>
  </div>
  	<!-- Stripe JS -->
		<script src="https://js.stripe.com/v3/"></script>
  	<script src="https://code.jquery.com/jquery-1.12.3.min.js"
    integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ="
    crossorigin="anonymous"></script>
  	<script
    src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
    integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
    crossorigin="anonymous"></script>

    <script>
			const stripe = Stripe('{{ env('STRIPE_KEY') }}'); // Replace with your Stripe Publishable Key

			const elements = stripe.elements();
			const cardElement = elements.create('card', {
			    style: {
			        baseColor: '#323232',
			        lineHeight: '1.8',
			        fontFamily: '"Helvetica Neue", Helvetica, Arial, sans-serif',
			        fontVariantNumeric: 'tabular-nums',
			    }
			});

			cardElement.mount('#card-element');

			const form = document.getElementById('payment-form');
			form.addEventListener('submit', (event) => {
			    event.preventDefault();

			    stripe.createToken(cardElement)
			        .then((result) => {
			            if (result.error) {
			                // Handle errors from Stripe.js
			                console.error(result.error.message);
			            } else {
			                // Send the token to your Laravel controller for processing
			                const token = result.token.id;
			                document.getElementById('payment-form').elements.stripeToken.value = token;
			                form.submit();
			            }
			        });
			});
	</script>

  	{{-- <script>
	    $(function() {
	        $('form.require-validation').bind('submit', function(e) {
	          var $form         = $(e.target).closest('form'),
	              inputSelector = ['input[type=email]', 'input[type=password]',
	                               'input[type=text]', 'input[type=file]',
	                               'textarea'].join(', '),
	              $inputs       = $form.find('.required').find(inputSelector),
	              $errorMessage = $form.find('div.error'),
	              valid         = true;

	          $errorMessage.addClass('hide');
	          $('.has-error').removeClass('has-error');
	          $inputs.each(function(i, el) {
	            var $input = $(el);
	            if ($input.val() === '') {
	              $input.parent().addClass('has-error');
	              $errorMessage.removeClass('hide');
	              e.preventDefault(); // cancel on first error
	            }
	          });
	        });
	    });

	    $(function() {

					// Create individual Elements for card number, card expiry, and card CVC
					// const cardNumberElement = elements.create('cardNumber');
					// const cardExpiryElement = elements.create('cardExpiry');
					// const cardCvcElement = elements.create('cardCvc');

					// Mount the Elements to their respective containers

					// cardNumberElement.mount('.card-number-element');
					// cardExpiryElement.mount('.card-expiry-element');
					// cardCvcElement.mount('.card-cvc-element');
			    const stripe = Stripe('{{ env('STRIPE_KEY') }}');
					const elements = stripe.elements({ mode: 'payment' });

					const paymentElement = elements.create('payment', {
						  elements: [
						    elements.create('cardNumber'),
						    elements.create('cardExpiry'),
						    elements.create('cardCvc'),
						  ]
					});

					paymentElement.mount('#payment-element-container'); // Replace with your container ID (single ID)

	        var $form = $("#payment-form");

	        $form.on('submit', function(e) {
			        if (!$form.data('cc-on-file')) {
			            e.preventDefault();
			            
			            stripe.createToken(paymentElement).then(function(result) {
				            if (result.error) {
				                $('.error')
				                  .removeClass('hide')
				                  .find('.alert')
				                  .text(result.error.message);
				            } else {
				                var token = result.token.id;
				                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
				                $form.get(0).submit();
				            }
				        });
			        }
	        });

	      // function stripeResponseHandler(status, response) {
		    //     if (response.error) {
		    //         $('.error')
		    //           .removeClass('hide')
		    //           .find('.alert')
		    //           .text(response.error.message);
		    //     } else {
		    //         // token contains id, last4, and card type
		    //         var token = response['id'];
		    //         // insert the token into the form so it gets submitted to the server
		    //         $form.find('input[type=text]').empty();
		    //         $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
		    //         console.log(token);
		    //         $form.get(0).submit();
		    //     }
	        // }
	    })
    </script> --}}
</body>
</html>