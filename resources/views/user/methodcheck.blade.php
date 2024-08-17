
<html lang="en">
<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
  	<div class="container">
	    <div class='row'>
		    <div class='col-md-4'></div>
		    <div class='col-md-4'>
            	<h5 class="payment_title">Shipping Options :</h5>
            	<div class="col-sm-6 mb-4">
					
                    <select name="shipping_id" class="form-control" id="shipping_id_select" required="">
                        <option selected="" disabled="">Select Shipping Method</option>
                        <option value="2" data-title="Delivery" data-cost="20" >Delivery (&#2547;20)</option>
                        <option value="3" data-title="Standard" data-cost="5" >Standard (&#2547;5)</option>
                    </select>

					<small class="text-primary shipping_message">Please select shipping method</small>

                </div>
		    </div>
		    <div class='col-md-4'></div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-1.12.3.min.js"
    integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ="
    crossorigin="anonymous"></script>

    <script type="text/javascript">
    	const shippingSelect = document.getElementById('shipping_id_select');

		shippingSelect.addEventListener('change', function(event) {
		    const selectedShippingId = event.target.value;
		    const selectedShippingTitle = event.target.selectedOptions[0].dataset.title; 
		    const selectedShippingCost = event.target.selectedOptions[0].dataset.cost;

		    $.ajax({
	            url: '{{route('shipping.method.option')}}',
                method: 'post',
                headers: {
			        'Content-Type': 'application/json',
			        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
			    },
                data: {
				    shipping_id: selectedShippingId,
				    shipping_title: selectedShippingTitle,
				    shipping_cost: selectedShippingCost, // Assuming you have this value
				},
				processData: false,
                contentType: false,
	            success: function(response) {
	            	console.log(response);
	                // Handle success response, e.g., show success message
	                toastr.success('Shipping Method Selected.');
	            },
	            error: function(error) {
	                // Handle error response, e.g., show error message
	                alert('Error updating Shipping Method Data.');
	            }
	        });

		});
    </script>
</body>
</html>
