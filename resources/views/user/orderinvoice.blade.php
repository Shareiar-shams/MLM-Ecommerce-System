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
	    			<h2>Order </h2><br><h3 class="pull-right">Invoice # {{$order->invoice}}</h3>
	    		</div>
	    		<hr>
	    		<div class="row">
	    			<div class="col-xs-6">
		    			<address>
		    				<strong>Billed To:</strong><br>
		    					{{$order->name}}<br>
		    					{{ isset($order->address) ? $order->address : null }}
		    			</address>
		    		</div>
		    		@php

					    $shipping_name = '';
					    $shipping_address = '';

					    if ($order->shipping_data) {
					        $data = json_decode($order->shipping_data, true);

					        $shipping_name = $data['shipping_name'];
					        $shipping_address = $data['shipping_address'];
					    }

					@endphp
		    		<div class="col-xs-6">
		    			<address>
		    				<strong>Shipped To:</strong><br>
		    					{{$shipping_name}}<br>
		    					{{ $shipping_address }}
		    			</address>
		    		</div>
	    		</div>
	    		<div class="row">
	    			<div class="col-xs-6">
	    				<address>
	    					<strong>Payment Method:</strong><br>
	    					{{$transection->payment_type}} Transaction Id: {{$transection->transaction_number}}<br>
	    					Tracking Id: {{$order->tracking_id}}
	    				</address>
	    			</div>
	    			<div class="col-xs-6 text-right">
	    				<address>
	    					<strong>Order Date:</strong><br>
	    					{{ $order->created_at->format('F j, Y') }}<br><br>
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
	                                </tr>
	    						</thead>
	    						<tbody>
	    							@foreach($order->orderproduct as $product)
	    							<tr>
	    								<td>{{$product->product_name}}</td>
	    								<td>{{$product->product_SKU}}</td>
	    								<td class="text-center">{{$product->product_price}}</td>
	    								<td class="text-center">{{$product->quantity}}</td>
	    							</tr>
	    							@endforeach
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