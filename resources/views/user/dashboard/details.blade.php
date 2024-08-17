@extends('user.dashboard.layouts')
@section('user_title_content')
    Ahknoxo | Details
@endsection
@section('user_css_content')
	<style type="text/css">
		@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);
	</style>
@endsection

@section('dashboard_main_content')
   <div class="row row_section">
   		<div class="card  card-info">
   			
	        <div class="col-12">
	            <!-- Main content -->
	            <div class="invoice p-3 mb-3">
	              <!-- title row -->
	              <div class="row">
	                <div class="col-12">
	                  <h4>
	                      <i class="fa fa-globe"></i> {{$order->name}}.
	                    <small class="float-right">Date: {{ $order->created_at->format('m/d/Y') }}</small>
	                  </h4>
	                </div>
	                <!-- /.col -->
	              </div>
	              <!-- info row -->
	              <div class="row invoice-info">
	                <div class="col-sm-4 invoice-col">
	                  From
	                  <address>
	                    <strong>{{$order->name}}</strong><br>
	                    {{$order->billing_address}}<br>
	                    {{$order->billing_town}}, {{$order->billing_postal_code}}<br>
	                    Phone: {{$order->phone}}<br>
	                    Email: {{$order->email}}
	                  </address>
	                </div>
	                <!-- /.col -->
	                <div class="col-sm-4 invoice-col">
	                  To
	                  @php
	                      $shipping_data =  json_decode($order->shipping_data) ;
	                  @endphp
	                  <address>
	                    <strong>{{$shipping_data->shipping_name}}</strong><br>
	                    {{$shipping_data->shipping_address}}<br>
	                    Phone: {{$shipping_data->shipping_phone}}<br>
	                    Email: {{$shipping_data->shipping_email}}
	                  </address>
	                </div>
	                <!-- /.col -->
	                <div class="col-sm-4 invoice-col">
	                  <b>Invoice #{{$order->invoice}}</b><br>
	                  <br>
	                  <b>Tracking ID:</b> {{$order->tracking_id}}<br>
	                  <b>Payment Status:</b> {{$order->payment_status}}<br>
	                  <b>Payment Method:</b> {{$order->transactions->payment_type}}
	                </div>
	                <!-- /.col -->
	              </div>
	              <!-- /.row -->

	              <!-- Table row -->
	              <div class="row">
	                <div class="col-12 table-responsive">
	                  <table class="table table-striped">
	                    <thead>
	                    <tr>
	                      <th>Qty</th>
	                      <th>Product</th>
	                      <th>SKU #</th>
	                      <th>Price</th>
	                      <th>Attribute</th>
	                      <th>Category</th>
	                      <th>SubCategory</th>
	                      <th>Referrer</th>
	                    </tr>
	                    </thead>
	                    <tbody>
	                    @foreach($order->orderproduct as $product)
	                        <tr>
	                          <td>{{$product->quantity}}</td>
	                          <td>{{$product->product_name}}</td>
	                          <td>{{$product->product_SKU}}</td>
	                          <td>{{$product->product_price}}</td>
	                          <td>
	                                @php
	                                    $attributes = json_decode($product->product_attributes);
	                                @endphp

	                                @if (is_array($attributes) || is_object($attributes))
	                                    @foreach ($attributes as $attributeName => $attributeValue)
	                                        {{-- Access both attribute name and value --}}
	                                        {{ $attributeName }}: {{ $attributeValue }}<br>
	                                    @endforeach
	                                @else
	                                    <p>Product attributes are not available or invalid.</p>
	                                @endif
	                          </td>
	                          <td>{{$product->product_category}}</td>
	                          <td>{{ isset($product->product_subcategory) ? $product->product_subcategory : 'null'}}</td>
	                          <td>{{isset($product->product_refferer) ? $product->product_refferer : 'null'}}</td>
	                        </tr>
	                    @endforeach
	                    </tbody>
	                  </table>
	                </div>
	                <!-- /.col -->
	              </div>
	              <!-- /.row -->

	              <div class="row">
	                <div class="col-12">
	                  <p class="lead">Order Status: {{$order->order_status}}</p>

	                  <div class="table-responsive">
	                    <table class="table">
	                      <tr>
	                        <th style="width:50%">Subtotal:</th>
	                        <td>{{$order->subtotal}}</td>
	                      </tr>
	                      @if($order->coupon)
	                          @php
	                              $couponData = json_decode($order->coupon, true); // Decode as associative array
	                          @endphp
	                          <tr>
	                            <th>Coupon ({{ $couponData['name'] }})</th>
	                            <td>{{ $couponData['value'] }}</td>
	                          </tr>
	                      @endif
	                      <tr>
	                        <th>Shipping ({{$order->shipping_title}}):</th>
	                        <td>{{$order->shipping_cost}}</td>
	                      </tr>
	                      <tr>
	                        <th>Total:</th>
	                        <td>{{ $order->total }}</td>
	                      </tr>
	                    </table>
	                  </div>
	                </div>
	                <!-- /.col -->
	              </div>
	              <!-- /.row -->

	            </div>
	            <!-- /.invoice -->
	        </div><!-- /.col -->
   		</div>
	</div>
@endsection
@section('user_js_content')
@endsection