<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->

	<style type="text/css" media="screen">
		.invoice-title h2, .invoice-title h3 {
		    display: inline-block;
		}

		.table > tbody > tr > .no-line {
		    border-top: none;
		}

		.table > thead > tr > .no-line {
		    border-bottom: none;
		}

		.table > tbody > tr > .thick-line {
		    border-top: 2px solid;
		}
	</style>
</head>
<body>
	<div class="container">
	    <div class="row">
	        <div class="col-xs-12">
	    		<div class="invoice-title">
	    			<h2>{{$title}} </h2><br><h3 class="pull-right">Invoice # {{$invoiceNo}}</h3>
	    		</div>
	    		<hr>
	    		<div class="row">
	    			<address>
	    				<strong>Billed To:</strong><br>
	    					{{$name}}<br>
	    					{{ isset($address) ? $address : null }}
	    			</address>
	    		</div>
	    		<div class="row">
	    			<div class="col-xs-6">
	    				<address>
	    					<strong>Payment Method:</strong><br>
	    					{{$paymentMethod}} Transaction Id: {{$transection_id}}<br>
	    					{{$email}}
	    				</address>
	    			</div>
	    			<div class="col-xs-6 text-right">
	    				<address>
	    					<strong>Order Date:</strong><br>
	    					{{ date('F j, Y') }}<br><br>
	    				</address>
	    			</div>
	    		</div>
	    	</div>
	    </div>
	    
	    <div class="row">
	    	<div class="col-md-12">
	    		<div class="panel panel-default">
	    			<div class="panel-heading">
	    				<h3 class="panel-title"><strong>Order summary</strong></h3>
	    			</div>
	    			<div class="panel-body">
	    				<div class="table-responsive">
	    					<table class="table table-condensed">
	    						<thead>
	                                <tr>
	        							<td><strong>Item</strong></td>
	        							<td><strong>SKU</strong></td>
	        							<td class="text-center"><strong>Price</strong></td>
	        							<td class="text-center"><strong>Quantity</strong></td>
	        							<td class="text-right"><strong>Totals</strong></td>
	                                </tr>
	    						</thead>
	    						<tbody>
	    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
	    							<tr>
	    								<td>{{$productName}}</td>
	    								<td>{{$productSKU}}</td>
	    								<td class="text-center">{{$amount}}</td>
	    								<td class="text-center">1</td>
	    								<td class="text-right">{{$amount}}</td>
	    							</tr>
	    						</tbody>
	    					</table>
	    				</div>
	    			</div>
	    		</div>
	    	</div>
	    </div>
	</div>
	
</body>
</html>