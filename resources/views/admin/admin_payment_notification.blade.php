<!DOCTYPE html>
<html>
<head>
    <title>Admin Pay you</title>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->

	<style type="text/css" media="screen">
		.invoice-title h2, .invoice-title h3 {
		    display: inline-block;
		}

	</style>
</head>
<body>
	<div class="container">
	    <div class="row">
	        <div class="col-xs-12">
	    		<div class="invoice-title">
	    			<h2>Hello {{ $userName }}, </h2>
	    		</div>
	    		<hr>
	    		<div class="row">
	    			<div class="col-xs-12">
	    				<p>Child user Name: {{ $childUser->name }},</p>

						<p>Admin has paid you {{ $amount }} TK for your child.</p>

						<p>Thank you!</p>
	    			</div>
	    		</div>
	    	</div>
	    </div>
	</div>
	
</body>
</html>