<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ahknoxo Payment</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://js.stripe.com/v3/"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    <style type="text/css" media="screen">
        .row {
          margin: 0 auto; /* Center the row horizontally */
          margin-top: 10%;
          justify-content: center; /* Horizontally center content within the row */
          align-items: center; /* Vertically center content within the row (optional) */
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
</head>
<body>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <button type="button" style="display: none;" id="Successbutton" data-toggle="modal" data-target="#successModal">
        Launch demo modal
    </button>

    <button type="button" style="display: none;" id="Errorbutton" data-toggle="modal" data-target="#errorModal">
        Launch demo modal
    </button>

    <div id="ajax-loading-container" style="display: none; text-align: center;">
        <img src="{{asset('viewport/img/spinner.gif')}}" alt="Loading....">
    </div>
    <div class="row">
        <div class="col-sm-12">

            <form id="payment-form" method="post" action="{{ route('stripePayment.store') }}">
                @csrf
                <input type="hidden" id="stripeInvoice" value="{{ request()->query('invoice') }}" name="invoice">
                <div class='form-row'>
                    <div class='col-xs-12 form-group required'>
                        <label class='card-holder-name'>Card Holder Name</label>
                        <input type="text" class="form-control" id="card-holder-name" name="card_holder_name" required>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='col-xs-12 form-group'>
                        <label for="card-number">Card Number</label>
                        <div class="card-number-element"></div>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='col-xs-4 form-group cvc required'>
                        <label for="card-cvc">CVC</label>
                        <div class="card-cvc-element"></div>
                    </div>
                    <div class='col-xs-4 form-group expiration required'>
                        <label for="card-expiry">Expiration</label>
                        <div class="card-expiry-element"></div>
                    </div>
                </div>
                <div class='form-row'>
                    <div class='col-md-6 form-group'>
                        <button class='form-control btn btn-primary submit-button' type='submit' style="margin-top: 10px;">Confirm</button>
                    </div>
                    <div class='col-md-6 form-group'>
                        <a class='form-control btn btn-info' href="{{route('checkout')}}" style="margin-top: 10px;">Go Back</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="height:600px;">
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <div class="gatewaySuccess">
                        <div class="checkmarkDiv">
                            <i class="checkmark">✓</i>
                        </div>
                        <h1>Success</h1>
                        <p>We received your purchase request; <br/> we'll be in touch shortly!</p>
                        <h3 id="transaction-id">Transaction ID: </h3>
                        <strong>Tracking ID:</strong><p id="tracking_id"></p>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="{{route('main')}}" class="btn btn-primary" data-dismiss="modal"><span>Go Back</span></a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="height:600px;">
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <h1>Error</h1>
                        
                        <h3 id="error">Message: -</h3> 
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="{{route('main')}}" class="btn btn-primary" data-dismiss="modal"><span>Go Back</span></a>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">


        const stripe = Stripe('{{ env('STRIPE_KEY') }}'); // Replace with secure key fetching on server-side
        const stripecheckoutloader = document.getElementById('ajax-loading-container');
        const stripeErrorElement = document.getElementById('error');
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
            stripecheckoutloader.style.display = '';
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
                    if (data.error) {
                        stripecheckoutloader.style.display = 'none';
                        console.error('Error submitting payment:', data.error);
                        // **Update error message:**
                        const errorbutton = document.getElementById('Errorbutton');
                        const errorMessage = data.error; 
                        stripeErrorElement.textContent = `Message: ${errorMessage}`;

                        // Show the error modal
                        errorbutton.click();
                    } else {
                        const successbutton = document.getElementById('Successbutton');
                        console.log(data);
                        stripecheckoutloader.style.display = 'none';

                        const stripetransactionIdElement = document.getElementById('transaction-id');
                        const transactionId = data.transectionId; 
                        stripetransactionIdElement.textContent = `Transaction ID: ${transactionId}`;

                        const stripetrackingIdElement = document.getElementById('tracking_id');
                        const trackingId = data.trackingId;
                        stripetrackingIdElement.textContent = trackingId;

                        successbutton.click();


                        form.reset();
                    }
                })
                .catch(error => {
                    stripecheckoutloader.style.display = 'none';
                    console.error('Error submitting payment:', error);
                    // **Update transaction ID:**
                    const errorMessage = error; 
                    const errorbutton = document.getElementById('Errorbutton');
                    stripeErrorElement.textContent = `Message: ${errorMessage}`;

                    // Show the success modal
                    errorbutton.click();
                });
                
            });
        });

    </script>

</body>
</html>
