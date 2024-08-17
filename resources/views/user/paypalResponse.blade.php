<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Paypal Payment Response</title>
	<style type="text/css" media="screen">
		._failed{ border-bottom: solid 4px red !important;}
		._failed i{  color:red !important;  }

		._success {
		    box-shadow: 0 15px 25px #00000019;
		    padding: 45px;
		    width: 50%;
		    text-align: center;
		    margin: 40px auto;
		    border-bottom: solid 4px #28a745;
		}
		@media (max-width: 992px) {
		    ._success {
			    box-shadow: 0 15px 25px #00000019;
			    padding: 45px;
			    width: 50%;
			    text-align: center;
			    margin: 30% auto;
			    border-bottom: solid 4px #28a745;
			}
		}
		._success i {
		    font-size: 55px;
		    color: #28a745;
		}

		._success h2 {
		    margin-bottom: 12px;
		    font-size: 40px;
		    font-weight: 500;
		    line-height: 1.2;
		    margin-top: 10px;
		}

		._success p {
		    margin-bottom: 0px;
		    font-size: 18px;
		    color: #495057;
		    font-weight: 500;
		}

		div.backBtn, div.backBtn2 {
		  	width: 100px;
		  	text-align: center;
		    margin: 0 20%;
		  	background-color: #f4f4f4;
		  	transition: all 0.4s ease;
		  	position: absolute;
		  	cursor: pointer;
		}

		span.line, span.line2{
		  bottom: auto;
		  right: auto;
		  top: auto;
		  left: auto;
		  background-color: #333;
		  border-radius: 10px;
		  width: 100%;
		  left: 0px;
		  height: 2px;
		  display: block;
		  position: absolute;
		  transition: width 0.2s ease 0.1s, left 0.2s ease, transform 0.2s ease 0.3s, background-color 0.2s ease;
		}

		span.tLine, span.tLine2 {
		  top: 0px;
		}

		span.mLine, span.mLine2 {
		  top: 13px;
		  opacity: 0;
		}

		span.bLine, span.bLine2 {
		  top: 26px;
		}

		.label, .label2 {
		  position: absolute;
		  left: 0px;
		  top: 5px;
		  width: 100%;
		  text-align: center;
		  transition: all 0.4s ease;
		  font-size: 1em;
		}

		div.backBtn:hover span.label, div.backBtn2:hover span.label2 {
		  left: 25px
		}

		div.backBtn:hover span.line, div.backBtn2:hover span.line2 {
		  left: -10px;
		  height: 5px;
		  background-color: #F76060;
		}

		div.backBtn:hover span.tLine, div.backBtn2:hover span.tLine2 {
		  width: 25px;
		  transform: rotate(-45deg);
		  left: -15px;
		  top: 6px;
		}

		div.backBtn:hover span.mLine, div.backBtn2:hover span.mLine2 {
		  opacity: 1;
		  width: 30px;
		}

		div.backBtn:hover span.bLine, div.backBtn2:hover span.bLine2 {
		  width: 25px;
		  transform: rotate(45deg);
		  left: -15px;
		  top: 20px;
		}
		
	</style>
</head>
<body>
	<div class="container">
		@if($type === 'success')
	        <div class="row justify-content-center">
	            <div class="col-md-5">
	                <div class="message-box _success">
	                    <i class="fa fa-check-circle" aria-hidden="true"></i>
	                    <h2> Your payment was successful </h2>
	                   	<p> Thank you for your payment. we will <br>
	                   	be in contact with more details shortly </p> 
	                   	<h6>Transection Id: {{isset($transectionId) ? $transectionId : ''}}</h6> 
	                   	<strong>Tracking ID:</strong><p>{{$tracking_id}}</p>
	                   	<div class="backBtn">
					      <span class="line tLine"></span>
					      <span class="line mLine"></span>
					      <span class="label"><a href="{{route('main')}}">Back</a></span>
					      <span class="line bLine"></span>
						</div>  
		            </div> 
		        </div> 
		    </div> 
	    <hr>
		@else
	  
	  	<div class="row justify-content-center">
            <div class="col-md-5">
                <div class="message-box _success _failed">
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                    <h2> Your payment failed </h2>
             		<p>  Try again later </p> 
	         		<div class="backBtn2" style="margin-top: 12px;">
				      <span class="line2 tLine2"></span>
				      <span class="line2 mLine2"></span>
				      <span class="label2"><a href="{{route('main')}}">Back</a></span>
				      <span class="line2 bLine2"></span>
					</div> 
	            </div> 
	        </div> 
	    </div> 
	    @endif
	</div> 
</body>
</html>