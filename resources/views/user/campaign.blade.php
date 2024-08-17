@extends('user.layouts.layout')
@section('user_title_content')
    Ahknoxo | Campaign Product
@endsection
@section('user_css_content')
    @include('user.home.css')
@endsection

@section('user_main_content')

<div class="deal-of-day-section mt-20" style="margin-top: 5%; margin-bottom: 5%;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2 class="h3">{{ isset($campaign) ? $campaign->name : null}}</h2>
                    <div class="right-area">
                        <div class="countdown countdown-alt" id="countdown" data-date="{{ isset($campaign) ? \Illuminate\Support\Carbon::parse($campaign->last_date)->format("Y-m-d H:i:s") : null }} ">
                            <span id="days">00</span> <small>Day</small>
                            <span id="hours">00</span> <small>Hrs</small>
                            <span id="minutes">00</span> <small>Min</small>
                            <span id="seconds">00</span> <small>Sec</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3">
            @forelse($campaign->products as $product)
            <div class="col-gd product-item-element col-sm-6 col-md-6 col-lg-4" data-tag="beds" style="margin-bottom: 5%;">
                <!--Product Item-->
                <div class="product-card">
                    <div class="product-thumb cls_img_box">
                        <div class="product-badge bg-dark">
                            {{str_replace(['Product', 'product'],'',$product->type->name)}}
                        </div>

                        @if(isset($product->special_price))
                            <div class="product-badge product-badge2 bg-info"> 
                                -{{ round((($product->price - $product->special_price) / $product->price) * 100) }}%

                            </div>
                        @endif
                        @if (Str::startsWith($product->featured_image, 'https'))
                            <img src="{{$product->featured_image}}" alt="" width="100%" height="250">
                        @else
                            <img src="{{Storage::disk('local')->url($product->featured_image)}}" width="100%" height="250" alt="">
                        @endif
                        <div class="overlay_img">
                            <ul>
                                <li>
                                    <form id="wish-add-form-{{$product->id}}" method="POST" action="{{route('wishPost')}}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$product->id}}" />
                                    </form>

                                    <a rel="nofollow" onclick="document.getElementById('wish-add-form-{{$product->id}}').submit();" class="wishBtn"><i class="fa fa-heart-o" aria-hidden="true"></i></a>

                                </li>

                                <li>
                                    @if(isset($product->affiliate_link))
   

                                        <a href="{{$product->affiliate_link}}"><i class="fa fa-arrow-right"></i></a>
                                        
                                    @else
                                        <a rel="nofollow" onclick="addToCart({{$product->id}})"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                                    @endif

                                    <form id="cart-add-form-{{$product->id}}" method="POST" action="{{ route('cart.store') }}">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1" title="Qty" class="input-text qty text"/>
                                        <input type="hidden" name="id" value="{{$product->id}}" />
                                    </form>

                                </li>

                                <div class="product-button">
                                    
                                    <div class="favIcon">
                                        
                                    </div>
                                </div>

                            </ul>

                        </div>
                    </div>
                    <div class="product-card-body">
                        <div class="product-category">
                            <a href="{{route('shopcategory',$product->category->slug)}}">{{$product->category->name}}</a>
                        </div>
                        <h3 class="product-title">
                            <a href="{{route('productDetails',$product->slug)}}">
                                {{$product->name}}
                            </a>
                        </h3>
                        @php
                            $rateArray =[];
                            foreach ($product->reviews as $review)
                            {
                               $rateArray[]= $review['rating'];
                            }
                            $sum = array_sum($rateArray);
                            $result = $sum/5;
                        @endphp

                        <div class="star-rating" itemprop="reviewRating" itemscope=""
                        itemtype="http://schema.org/Rating" title="Rated 4 out of 5">
                            <span style="width: {{$result * 20}}%"></span>
                        </div>
                        <span class="review_count">({{count($product->reviews)}} reviews)</span>
                        <br>

                        <h4 class="product-price">
                            @if(!empty($product->special_price))
                                <del>&#2547;{{$product->price}}</del>
                                {{isset($product->special_price) ? $product->special_price : $product->price}}
                            @else
                                {{$product->price}}
                            @endif
                        </h4>

                    </div>
                </div>
                <!-- End Product Item-->
            </div>

            @empty
            @endforelse
        </div>
    </div>
</div>
@endsection
@section('user_js_content')
    {{-- <link rel="stylesheet" href="{{asset('viewport/js/deals_section.js')}}"> --}}
    <script src="https://cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
        // Get the end date from the data attribute
        var endDateTime = $('#countdown').data('date');

        // Start the countdown
        $('#countdown').countdown(endDateTime, function (event) {
                // Update the countdown elements with the remaining time
                $(this).html(event.strftime(
                    '<span>%D</span> <small>Day</small> ' +
                    '<span>%H</span> <small>Hrs</small> ' +
                    '<span>%M</span> <small>Min</small> ' +
                    '<span>%S</span> <small>Sec</small>'
                ));
            });
        });

    </script>
@endsection