<!DOCTYPE html>
<html>
<head>
    <title>Order Information</title>
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
	    					{{$order->transactions->payment_type}} Transaction Id: {{$order->transactions->transaction_number}}<br>
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
	    				<h3 class="panel-title"><strong>Order Information</strong></h3>
	    			</div>
	    			<div class="panel-body">
	    				@if($order->order_status === 'Pending')
		    				<p>Your order (#{{$order->tracking_id}}) is Pending! You can track its progress using this link: {{route('orderTrack')}}</p>
	    				@elseif($order->order_status === 'Processing_Order')
		    				<p>Your order (#{{$order->tracking_id}}) is on its way! You can track its progress using this link: {{route('orderTrack')}}</p>

	    				@elseif($order->order_status === 'Delivery_in_progess')
	    					<p><strong>Congratulatory:</strong> "Hooray! Your order (#{{$order->tracking_id}}) has been delivered. We hope you enjoy it!"</p>
	    				@elseif($order->order_status === 'Canceled')
	    					<p><strong>Apology:</strong> "We're sorry to hear that you canceled your order (#{{$order->tracking_id}}). We hope to see you again soon!"</p>
	    				@endif
	    			</div>
	    		</div>
	    	</div>
	    </div>
	</div>
	
</body>
</html>