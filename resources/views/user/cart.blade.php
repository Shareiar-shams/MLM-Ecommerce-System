@extends('user.layouts.layout')
@section('user_title_content')
    Ahknoxo | Cart
@endsection
@section('user_css_content')
@endsection

@section('user_main_content')
	<!-- Page Content Wraper -->
    <div class="page-content-wraper">
        <!-- Bread Crumb -->
        {{-- <section class="banner_section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    <div class="about_hero_area_content">
                        <h2>Cart</h2>
                        
                    </div>
                </div>
                </div>
            </div>
        </section> --}}
        <!-- Bread Crumb -->

        <!-- Page Content -->
        <section class="content-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3 text-center">
                        <div class="section_title">
                            <h4>Cart</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <article class="post-8">
                            @if(\Cart::session(Session::getId())->getTotalQuantity()>0)
                                
                                <div class="cart-product-table-wrap responsive-table">

                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-remove text-center">
                                                    <a class="btn btn-sm btn-warning" title="clear Cart" onclick="
                                                    if(confirm('Do you actually want to clean the cart?'))
                                                    {
                                                        event.preventDefault();
                                                        document.getElementById('delete-cart-form').submit();
                                                    }
                                                    else
                                                    {
                                                        event.preventDefault();
                                                    }
                                                    ">
                                                        <span>Clear Cart</span>
                                                    </a>
                                                    <form action="{{route('cartDestroy')}}" method="post" id="delete-cart-form" style="display: none;">
                                                        @csrf
                                                        {{method_field('DELETE')}}
                                                    </form>
                                                </th>

                                                <th class="product-thumbnail"></th>
                                                <th class="product-name">Product</th>
                                                <th class="product-price">Price</th>
                                                <th class="product-quantity">Quantity</th>
                                                <th class="product-subtotal">Total</th>
                                                <th class="product-action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(\Cart::session(Session::getId())->getContent() as $item)
                                                <tr>
                                                    <td class="product-remove">
                                                        <a href="" title="Remove this item" onclick="
                                                        if(confirm('Are you want to remove this item!'))
                                                        {
                                                            event.preventDefault();
                                                            document.getElementById('delete-form-{{$item->id}}').submit();
                                                        }
                                                        else
                                                        {
                                                            event.preventDefault();
                                                        }
                                                        "><i class="fa fa-times-circle" aria-hidden="true"></i></a>

                                                        <form action="{{route('cart.destroy',$item->id)}}" method="post" id="delete-form-{{$item->id}}" style="display: none;">
                                                          @csrf
                                                          {{method_field('DELETE')}}
                                                        </form>
                                                    </td>
                                                    <td class="product-thumbnail">
                                                        <a>
                                                            <img src="{{Storage::disk('local')->url($item->attributes->image)}}" alt="{{$item->slug}}" /></a>
                                                    </td>
                                                    <td class="product-name" >
                                                        <a>{{$item->name}}</a>
                                                    </td>
                                                    <td class="product-price">
                                                        <span class="product-price-amount amount"><span class="currency-sign">&#2547;</span>{{$item->price}}</span>
                                                    </td>
                                                    <form action="{{route('cart.update',$item->id)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    {{method_field('PUT')}}
                                                        <td class="product-quantities">
                                                            <div class="product-quantity">
                                                                <span data-value="+" class="quantity-btn quantityPlus"></span>
                                                                {{-- <input id="quantity_{{$item->id}}" class="quantity input-lg" step="1" min="1" max="9"  name="quantity" value="{{ $item->quantity }}" title="Quantity" type="number" data-item-id="{{$item->id}}"/> --}}
                                                                <input id="quantity" class="quantity input-lg" step="1" min="1" max="9"  name="quantity" value="{{ $item->quantity }}" title="Quantity" type="number"/>
                                                                <span data-value="-" class="quantity-btn quantityMinus"></span>
                                                            </div>
                                                        </td>
                                                        <td class="product-subtotal">
                                                            <span class="product-price-sub_total amount">
                                                                <span class="currency-sign">&#2547;</span>{{ \Cart::get($item->id)->getPriceSum() }}
                                                            </span>
                                                        </td>

                                                        <td>
                                                            <button type="submit" class="btn btn-secondary btn-sm" style="margin-right: 25px;"><i class="fa fa-edit"></i></button>
                                                        </td>
                                                    </form>
                                                </tr>
                                            
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <div class="row cart-actions">
                                    <div class="col-md-6">
                                        <div class="coupon">
                                            <form id="couponForm" action="{{ route('coupon_applied') }}" method="get" accept-charset="utf-8">
                                                @csrf
                                                <input class="input-md" id="coupon_code" name="code" title="Coupon Code"  placeholder="Enter Code" type="text">
                                                <input class="btn btn-md btn-black" value="Apply Coupon" type="submit" />
                                            </form> 
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        {{-- <input class="btn btn-md btn-gray-btn " name="update_cart" value="Update cart"
                                            disabled="" type="submit"> --}}
                                        <p id="coupon_showing" style="display: none;"></p>
                                        @if ($conditions = \Cart::session(Session::getId())->getConditions())
                                            @foreach ($conditions as $condition)
                                                <p> Discount ({{ $condition->getName() }}): {{ $condition->getAttributes()['discount'] }} </p>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-md-3 ">
                                        <a href="{{route('checkout')}}" class="btn btn-md btn-gray-btn btn_up" type="submit">Proceed to checkout</a>
                                    </div>
                                </div>
                                <div class="cart-collateral">
                                    <div class="cart_totals">
                                        
                                        <div class="responsive-table">
                                            <table>
                                                <tbody>
                                                    <th class="title_card_page">
                                                        <h3>Cart Totals</h3>
                                                    </th>
                                                    <tr class="cart-subtotal">
                                                        <th>Subtotal</th>
                                                        <td><span class="product-price-amount amount"><span
                                                                    class="currency-sign">&#2547;</span>{{ \Cart::session(Session::getId())->getSubtotal() }}</span></td>
                                                    </tr>
                                                    {{-- <tr class="shipping">
                                                        
                                                        <td>
                                                            <ul id="shipping_method">
                                                                <li>
                                                                    <label for="shipping_method_0_legacy_flat_rate">Shipping</label>
                                                                </li>
                                                                <li>
                                                                    <label for="shipping_method_0_legacy_flat_rate">Flat
                                                                        Rate:</label>
                                                                </li>
                                                                <li>
                                                                    <label for="shipping_method_0_legacy_flat_rate">Shipping to CA.</label>
                                                                </li>
                                                                <li>
                                                                    <label for="shipping_method_0_legacy_flat_rate">Change address.</label>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                        <th class="spping_card_se">$50.00</th>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th>Total</th>
                                                        <td>
                                                            <span class="product-price-amount amount">
                                                                <span class="currency-sign">$</span>1009.00
                                                            </span>

                                                        </td>
                                                    </tr> --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <h4 class="entry-title">Your Cart is Empty</h4>
                                </br>
                                <div class="card text-center">
                                    <div class="card-body padding-top-2x">
                                        <h3 class="card-title">Your shopping cart is empty.</h3>
                                        <a class="btn btn-outline-primary m-4" href="{{route('products')}}">
                                            <i class="icon-package pr-2"></i>View our products
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </article>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Page Content -->


       	<!-- banner section -->

		<section class="banner_section section-padding">

            @include('user.home.single_column')

        </section>

		<!-- end banner section -->


		<!-- Customization section -->

		<section class="custmoization_section section-padding">

		    @include('user.home.recent-item')

		</section>

		<!-- end customization section -->

    </div>
    <!-- End Page Content Wraper -->
@endsection
@section('user_js_content')

    <script type="text/javascript">
        
        // document.querySelectorAll('.quantity').forEach(function(input) {
        //     input.addEventListener('change', function() {
        //         var itemId = this.dataset.itemId;
        //         var quantity = parseInt(this.value);
        //         var subtotalSpan = document.querySelector('.product-price-sub_total[data-item-id="' + itemId + '"]');
        //         var price = parseFloat(subtotalSpan.textContent.replace(/[^\d.]/g, ''));
        //         var newSubtotal = price * quantity;
        //         subtotalSpan.textContent = '৳' + newSubtotal.toFixed(2); // Update the subtotal
        //         updateCart(itemId, quantity);
        //     });
        // });

        // document.querySelectorAll('.quantity-btn').forEach(function(btn) {
        //     btn.addEventListener('click', function() {

        //         var input = this.parentElement.querySelector('.quantity');
        //         var quantity = parseInt(input.value);
        //         var itemId = input.dataset.itemId;
        //         var subtotalSpan = document.querySelector('.product-price-sub_total[data-item-id="' + itemId + '"]');
        //         var price = parseFloat(subtotalSpan.textContent.replace(/[^\d.]/g, ''));
        //         var newSubtotal = price * quantity;
        //         subtotalSpan.textContent = '৳' + newSubtotal.toFixed(2); // Update the subtotal
        //         updateCart(itemId, quantity);
        //     });
        // });

        // // Function to update the cart
        // function updateCart(itemId, quantity) {
        //     var url = "{{ route('cart.update', ':id') }}";
        //     url = url.replace(':id', itemId);

        //     // Send AJAX request to update cart
        //     $.ajax({
        //         url: url,
        //         type: 'PUT',
        //         data: {
        //             quantity: quantity
        //         },
        //         success: function(response) {
        //             toastr.success('Cart Updated!');
        //             // Update total product price
        //             var subtotal = price * quantity;
        //             $('.product-price-sub_total').text('<span class="currency-sign">&#2547;</span>' + subtotal.toFixed(2));
        //         },
        //         error: function(xhr, status, error) {
        //             console.error(error);
        //         }
        //     });
        // }

        // Submit form with Ajax


        // document.getElementById('couponForm').addEventListener('submit', function(event) {
        //     event.preventDefault(); // Prevent the default form submission
        //     var formData = new FormData(this); // Create FormData object from the form

        //     // Send Ajax request
        //     $.ajax({
        //         url: this.action,
        //         method: this.method,
        //         data: { code: code },,
        //         processData: false,
        //         contentType: false,
        //         success: function(response) {
        //             // toastr.success('Product added to cart successfully!');
        //             // Update page content if coupon is valid
        //             document.getElementById('coupon_showing').innerText = response.title;
        //             document.getElementById('coupon_showing').style.display = 'block'; // Show the coupon title

        //         },
        //         error: function(error) {
        //             toastr.error(error);
        //             console.error('Error applying coupon:', error);
        //         }
        //     });
        // });

        // Add event listener to the form submission
        document.getElementById('couponForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission behavior

            // Get the coupon code from the form
            var couponCode = document.getElementById('coupon_code').value;

            // AJAX request to submit the form data
            $.ajax({
                url: this.action,
                method: this.method,
                data: { code: couponCode },
                dataType: 'json', // Expect JSON response from server
                success: function(response) {
                    // Check if a matching coupon was found
                    if (response.success) {
                        // Construct the coupon details text
                        var discountText = response.discount_type == 'amount' ? '৳' + response.discount : response.discount + '%';
                        var couponDetails = 'Discount (' + response.title + '): ' + discountText;

                        // Update the content of the <p> tag
                        document.getElementById('coupon_showing').textContent = couponDetails;
                        document.getElementById('coupon_showing').style.display = 'block'; // Show the <p> tag
                    } else {
                        // Show an error message if no matching coupon was found
                        toastr.error(response.error);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle AJAX errors
                    console.error(error);
                    alert('An error occurred while processing the request.');
                    toastr.error(error);
                }
            });
        });

    </script>


@endsection