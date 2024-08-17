@extends('user.layouts.layout')
@section('user_title_content')
    Ahknoxo | Wishlists
@endsection
@section('user_css_content')
@endsection

@section('user_main_content')
	<!-- Page Content Wraper -->
    <div class="page-content-wraper">
        

        <!-- Page Content -->
        <section class="content-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3 text-center">
                        <div class="section_title">
                            <h4>Wishlist</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <article class="post-8">
                            <div class="cart-product-table-wrap responsive-table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-remove"></th>
                                            <th class="product-thumbnail"></th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-subtotal">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($wishProduct) > 0)
                                            @foreach($wishProduct as $product)
                                            <tr>
                                                <td class="product-remove">

                                                    <form action="{{route('wishlistProductDelete',$product->id)}}" method="post" id="wishProduct-delete-form-{{$product->id}}" style="display: none;">
                                                      @csrf
                                                      {{method_field('DELETE')}}
                                                    </form>

                                                    <a href="" title="Remove this item" onclick="
                                                    if(confirm('Are you want to remove this item!'))
                                                    {
                                                        event.preventDefault();
                                                        document.getElementById('wishProduct-delete-form-{{$product->id}}').submit();
                                                    }
                                                    else
                                                    {
                                                        event.preventDefault();
                                                    }
                                                    ">
                                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                                <td class="product-thumbnail">
                                                    @if (Str::startsWith($product->featured_image, 'https'))
                                                        <img src="{{$product->featured_image}}" height="100" alt="">
                                                    @else
                                                        <img src="{{Storage::disk('local')->url($product->featured_image)}}" height="100" alt="">
                                                    @endif
                                                </td>
                                                <td class="product-name">
                                                    <h4><a href="{{route('productDetails',$product->slug)}}">{{$product->name}}</a></h4>
                                                    @if($product->productType == "physical")
                                                    <strong>Status: {{($product->stock == 0) ? 'Out Of Stock' : 'In Stock'}}</strong>
                                                    @endif
                                                </td>
                                                <td class="product-price">
                                                    @if(empty($product->special_price))
                                                        <span class="product-price-sub_totle amount"><span
                                                            class="currency-sign">&#2547;</span>{{$product->price}}</span>
                                                    @else
                                                        <span class="product-price-sub_totle amount"><span
                                                            class="currency-sign">&#2547;</span>{{$product->special_price}}</span>
                                                        <del><span class="product-price-sub_totle amount"><span
                                                            class="currency-sign">&#2547;</span>{{$product->price}}</span></del>
                                                    @endif
                                                </td>
                                                <td class="product-subtotal">
                                                    @if(isset($product->affiliate_link))
                                                        <a class="btn btn-md btn-gray-btn btn_up" href="{{$product->affiliate_link}}">Buy</a>
                                                        
                                                    @else
                                                        <a class="btn btn-md btn-gray-btn btn_up" rel="nofollow" >Add to cart</a>
                                                    @endif
                                                </td>

                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4"><h4>No product in Wishlist</h4></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="row cart-actions">
                                
                                <div class="col-md-3 ">
                                    <form action="{{route('clearWishList')}}" method="post" id="clear-wishlist-form" style="display: none;">
                                      @csrf
                                      {{method_field('DELETE')}}
                                    </form>

                                    <a class="btn btn-md btn-gray-btn btn_up"  onclick="
                                    if(confirm('Are you want to clear Wishlist!'))
                                    {
                                        event.preventDefault();
                                        document.getElementById('clear-wishlist-form').submit();
                                    }
                                    else
                                    {
                                        event.preventDefault();
                                    }
                                    ">
                                        Clear Wishlist
                                    </a>
                                </div>
                            </div>
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
@endsection