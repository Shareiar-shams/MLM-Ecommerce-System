@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Invoice
@endsection
@section('admin_css_content')
  

@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Invoice</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Invoice']);
	@endphp
	<x-ad-breadcrumb :list="$list"/>
@endsection

@section('admin_main_content')
	<div class="container-fluid">
		  <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                      <i class="fas fa-globe"></i> {{$order->name}}.
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
                                    $customizationData = json_decode($product->customize_attribute, true, 512, JSON_UNESCAPED_UNICODE);
                                @endphp
                                @if (is_array($attributes) || is_object($attributes))
                                    @foreach ($attributes as $attributeName => $attributeValue)
                                        {{-- Access both attribute name and value --}}
                                        {{ $attributeName }}: {{ $attributeValue }}<br>
                                    @endforeach
                                    <br>
                                @else
                                    <p>Product attributes are not available or invalid.</p>
                                    <br>
                                @endif
                                <hr>
                                @if (is_array($customizationData) || is_object($customizationData))
                                    <h5>Customization Details:</h5>
                                    @foreach ($customizationData as $option)
                                        <p>
                                            <strong>Option Name:</strong> {{ $option['option_name'] }}<br>
                                            <strong>Option Value:</strong> {{ $option['option_value'] }}<br>
                                            @if (isset($option['option_type'])) 
                                                <strong>Option Type:</strong> {{ $option['option_type'] }}<br>
                                            @endif
                                            @if (isset($option['option_image'])) 
                                                <strong>Option Image:</strong><br>
                                                <img src="{{Storage::disk('local')->url($option['option_image'])}}" alt="{{ $option['option_name'] }} Image" width="100">
                                            @endif
                                        </p>
                                    @endforeach
                                    <hr>
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
                  @if(!empty($order->order_comments))
                  <p class="lead"><strong>Note: </strong> {{$order->order_comments}} </p>
                  @endif
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

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="{{route('orders.print_invoice',$order->id)}}" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  {{-- <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button> --}}
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
      </div><!-- /.row -->
	</div>
@endsection

@section('admin_js_content')

@endsection