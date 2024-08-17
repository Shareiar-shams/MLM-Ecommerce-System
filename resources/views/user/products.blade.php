@extends('user.layouts.layout')
@section('user_title_content')
    Ahknoxo | products
@endsection
@section('user_css_content')

    <style type="text/css">
        .dash-navbar-left {
          width: 250px;
          padding-top: 5px;
          -webkit-transition: left 300ms;
          -o-transition: left 300ms;
          transition: left 300ms;
          margin-bottom: 20%;
        }
        .dash-navbar-left .nb-nav {
          padding-left: 0;
          list-style: none;
        }
        .dash-navbar-left .nb-nav ul {
          padding-left: 0;
          list-style: none;
        }
        .dash-navbar-left .nb-nav li {
          position: relative;
        }
        .dash-navbar-left .nb-nav li a {
          display: block;
          outline: 0;
          padding: 8px 25px 7px;
          font-size: 13px;
          color: #2A2D35;
        }
        .dash-navbar-left .nb-nav li a:hover,
        .dash-navbar-left .nb-nav li a:focus {
          color: #2E2A2A;
          text-decoration: none;
          background-color: rgba(255,152,0,0.1);
          -webkit-box-shadow: inset 3px 0 0 orange;
          box-shadow: inset 3px 0 0 orange;
        }
        .dash-navbar-left .nb-nav li a:hover .badge,
        .dash-navbar-left .nb-nav li a:focus .badge {
          color: #EEE;
        }
        .dash-navbar-left .nb-nav li a > .nb-link-icon {
          padding-right: 8px;
        }
        .dash-navbar-left .nb-nav li a > .nb-btn-sub-collapse {
          position: absolute;
          right: 25px;
          top: 10px;
        }
        .dash-navbar-left .nb-nav li a > .badge {
          position: absolute;
          right: 24px;
          top: 6px;
          padding: 3px 10px;
          color: #a7a9ac;
          background-color: transparent;
          border: 1px solid #4f4a65;
        }
        .dash-navbar-left .nb-nav li a.collapsed .nb-btn-sub-collapse {
          -webkit-transform: rotate(180deg);
          -ms-transform: rotate(180deg);
          -o-transform: rotate(180deg);
          transform: rotate(180deg);
        }
        .dash-navbar-left .nb-nav li.active > a {
          background-color: rgba(255,152,0,0.1);
          -webkit-box-shadow: inset 3px 0 0 orange;
          box-shadow: inset 3px 0 0 orange;
        }
        .dash-navbar-left .nb-nav li .nb-sub-one {
          background-color: #15141b;
        }
        .dash-navbar-left .nb-nav li .nb-sub-one li {
          border-top: 1px solid #1c1b24;
        }
        .dash-navbar-left .nb-nav li .nb-sub-one li a {
          display: block;
          color: #a7a9ac;
        }
        .dash-navbar-left .nb-nav li .nb-sub-one li a:hover,
        .dash-navbar-left .nb-nav li .nb-sub-one li a:focus {
          color: #eeeeee;
          background-color: #1c1b24;
          -webkit-box-shadow: inset 3px 0 0 #1c1b24;
          box-shadow: inset 3px 0 0 #1c1b24;
        }
        .dash-navbar-left .nb-nav li .nb-sub-one li a > .nb-link-icon {
          padding-right: 8px;
        }
        .dash-navbar-left .nb-nav li .nb-sub-one li a > .badge {
          color: #2E2A2A;
          background-color: #4C2929;
          border: 1px solid #211f2a;
        }
        .dash-navbar-left .nb-nav li .nb-sub-one li.active > a {
          background-color: #1c1b24;
          -webkit-box-shadow: inset 3px 0 0 #1c1b24;
          box-shadow: inset 3px 0 0 #1c1b24;
        }
        .dash-navbar-left .nb-nav li .nb-sub-two {
          background-color: #211f2a;
        }
        .dash-navbar-left .nb-nav li .nb-sub-two li {
          border-top-color: 1px solid #282533;
        }
        .dash-navbar-left .nb-nav li .nb-sub-two li a {
          color: #a7a9ac;
        }
        .dash-navbar-left .nb-nav li .nb-sub-two li a:hover,
        .dash-navbar-left .nb-nav li .nb-sub-two li a:focus {
          color: #eeeeee;
          background-color: #282533;
          -webkit-box-shadow: inset 3px 0 0 #282533;
          box-shadow: inset 3px 0 0 #282533;
        }
        .dash-navbar-left .nb-nav li .nb-sub-two li a > .badge {
          color: #2E2A2A;
          background-color: #4C2929;
          border: 1px solid #211f2a;
        }
        .dash-navbar-left .nb-nav li .nb-sub-two li.active > a {
          background-color: #1c1b24;
          -webkit-box-shadow: inset 3px 0 0 #1c1b24;
          box-shadow: inset 3px 0 0 #1c1b24;
        }
    </style>
@endsection

@section('user_main_content')
	<!-- Page Content Wraper -->
    <div class="page-content-wraper">


        <!-- Page Content -->
        <section class="content-page">
            <div class="container">
                <div class="menu-toggle">
                     <div class="menu-toggle__element"></div>
                     <div class="menu-toggle__element"></div>
                     <div class="menu-toggle__element"></div>
                </div>
                <div class="row">
                    <!-- Sidebar -->
                    <div class="sidebar-container col-md-3 deshtop_view">
               
                        <!-- Categories -->
                        <div class="widget-sidebar left-menu  js-menu">
                            <h3>Product</h3>
                            <h6 class="widget-title">Product Categories</h6>
                            <div class="dash-navbar-left nb-visible">
                                <ul class="nb-nav">
                                    @php
                                        $url = request()->url();
                                        $segments = explode('/', $url);
                                        $categorySlug = end($segments);
                                    @endphp

                                    <li class="{{ ($categorySlug == "all" || $categorySlug == "products") ? 'active' : ''}}">
                                        <a href="{{ route('shopcategory', 'all') }}">
                                            <span class="glyphicon glyphicon-folder-open nb-link-icon"></span>
                                            <span class="nb-link-text">ALL</span>
                                        </a>
                                    </li>
                                    @forelse ($categories as $category)
                                        @if(count($category->children) != 0)
                                            <li class="{{ ($categorySlug == $category->slug || in_array($categorySlug, $category->children->pluck('slug')->toArray())) ? 'active' : '' }}">
                                                <a class="collapsed" data-toggle="collapse" href="#collapse{{$loop->index}}" aria-expanded="false" aria-controls="collapse{{$loop->index}}">
                                                    <span class="glyphicon glyphicon-stats nb-link-icon"></span>
                                                    <span class="nb-link-text">{{ $category->name }}</span>
                                                    
                                                    <span class="fa fa-angle-up nb-btn-sub-collapse"></span>
                                                    
                                                </a>

                                                <!-- Dropdown level one -->
                                                <ul class="nb-sub-one collapse" id="collapse{{$loop->index}}">
                                                    @foreach ($category->children as $child)
                                                        <li class="{{ ($categorySlug == $child->slug) ? 'active' : ''}}">
                                                            <a href="{{route('shopcategory',$child->slug)}}">
                                                                <span class="fa fa-circle-o nb-link-icon"></span>
                                                                <span class="nb-link-text">{{ $child->name }}</span>
                                                                <span class="badge" style="color: #eeeeee;">{{ $child->chindrenproducts->count() }}</span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li class="{{ ($categorySlug == $category->slug) ? 'active' : ''}}">
                                                <a href="{{route('shopcategory',$category->slug)}}">
                                                    <span class="glyphicon glyphicon-comment nb-link-icon"></span>
                                                    <span class="nb-link-text">{{ $category->name }}</span>
                                                    <span class="badge" style="color: #1C1919;">{{ $category->products->count() }}</span>
                                                </a>
                                            </li>
                                        @endif
                                        
                                        
                                    </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                            {{-- <ul class="widget-content widget-product-categories jq-accordian" id="filters">
                                <li>
                                    <a href="javascript:void(0)" data-toggle="portfilter" data-target="*">All <span>(20)</span></a>
                                </li>
                                
                                <li>
                                    <a href="javascript:void(0)" data-toggle="portfilter" data-target="bowls">Bowls <span>(3)</span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" data-toggle="portfilter" data-target="cloth">Clothings <span>(3)</span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" data-toggle="portfilter" data-target="crates">Crates <span>(3)</span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" data-toggle="portfilter" data-target="tick">Flea & Tick <span>(3)</span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" data-toggle="portfilter" data-target="uncategorized">Uncategorized <span>(5)</span></a>
                                </li>
                            </ul> --}}
                        </div> 

                        <!-- Filter By Price -->
                        <div class="widget-sidebar widget-price-range">
                            <h6 class="widget-title">Filter By Price</h6>
                            <form action="{{route('price_range_category', $categorySlug)}}" class="widget-content" method="GET">
                                {{csrf_field()}}
                                <div class="price-range-slider"></div>
                                <div class="price-range-amount">
                                    <input id="price_range_min" style="display: none;" type="text" name="min_price" value="" data-min="10" step="1" oninput="this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);var children = this.parentNode.childNodes[1].childNodes;children[1].style.width=value+'%';children[5].style.left=value+'%';children[7].style.left=value+'%';children[11].style.left=value+'%';children[11].childNodes[1].innerHTML=this.value;" />
                     
                                    <input id="price_range_max" style="display: none;" type="text"  name="max_price" value="" data-max="2000" step="1" oninput="this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);var children = this.parentNode.childNodes[1].childNodes;children[3].style.width=(100-value)+'%';children[5].style.right=(100-value)+'%';children[9].style.left=value+'%';children[13].style.left=value+'%';children[13].childNodes[1].innerHTML=this.value;" />
                                   
                                    <div id="price-range-from-to">
                                    </div>
                                    <br>
                                    <button type="submit" class="custom-btn btn_button">Filter</button>
                                    
                                    <input type="hidden" name="filter_color" value="black-de">
                                </div>
                            </form>
                        </div>
                        <!-- Widget Product -->
                        <div class="widget-sidebar widget-product">
                            @include('user.inc.best_selling')
                        </div>

                        {{-- <div class="widget-sidebar widget-banner">
                            <a href="#" class="banner-image-wrap">
                                <img src="{{asset('viewport/img/banner/banner_115146.jpg')}}" alt="" />
                            </a>
                        </div> --}}

                    </div>
                    <!-- End Sidebar -->
                    <!-- Product Content -->
                    <div class="col-md-9">
                        <div class="shop-control-bar">
                            <form action="{{route('pagination_category', $categorySlug)}}" class="woocommerce-ordering" method="GET">
                            
                                <select name="orderby" class="orderby" onchange="this.form.submit()" >
                                    <option value="menu_order"  selected='selected'>Default sorting</option>
                                    {{-- <option value="popularity" >Sort by popularity</option>
                                    <option value="rating" >Sort by average rating</option> --}}
                                    <option value="asc" >Sort by oldness</option>
                                    <option value="price" >Sort by price: low to high</option>
                                    <option value="price-desc" >Sort by price: high to low</option>
                                </select>
                            </form>

                            <form action="{{route('pagination_category', $categorySlug)}}" class="form-electro-wc-ppp" method="GET">

                                {{csrf_field()}}
                                <select class="electro-wc-wppp-select c-select" onchange="this.form.submit()" name="ppp">
                                    <option selected="selected" value="15">Show 15</option>
                                    <option value="30">Show 30</option>
                                    <option value="60">Show 60</option>
                                </select>
                            </form>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <form class="navbar-search" method="get" action="{{route('product_search',$categorySlug)}}">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" class="form-control" aria-label="Recipient's username"
                                            aria-describedby="basic-addon2" value="" name="search" placeholder="Search by product name" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </li>
                            @forelse($types as $type)
                                <li class="nav-item">
                                    <a class="nav-link" id="new-arrivals-tab"
                                        href="{{route('product_show_type', $type->slug)}}">
                                        {{str_replace(['Product', 'product'],'',$type->name)}}
                                    </a>
                                </li>
                            @empty
                            @endforelse
                        </ul>


                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="new-arrivals" role="tabpanel"
                                aria-labelledby="new-arrivals-tab">
                                <!-- Product Grid -->
                                <div class="row product-list-item">
                                    @forelse($products as $product)
                                        <div class="product-item-element col-sm-6 col-md-6 col-lg-4" data-tag="beds">
                                            <!--Product Item-->
                                            <div class="product-item">
                                                <div class="product-badge bg-dark">
                                                    {{str_replace(['Product', 'product'],'',$product->type->name)}}
                                                </div>
                                                <div class="product-item-inner">
                                                    <div class="product-img-wrap">
                                                        @if ($product->subCategory)
                                                            <h5><a href="{{route('shopcategory',$product->subCategory->slug)}}">{{$product->subCategory->name}}</a></h5>
                                                        @else
                                                            <h5><a href="{{route('shopcategory',$product->category->slug)}}">{{$product->category->name}}</a></h5>
                                                        @endif
                                                        @if (Str::startsWith($product->featured_image, 'https'))
                                                            <img src="{{$product->featured_image}}" alt="" height="250">
                                                        @else
                                                            <img src="{{Storage::disk('local')->url($product->featured_image)}}" height="250" alt="">
                                                        @endif
                                                    </div>
                                                    <form id="cart-add-form-{{$product->id}}" method="POST" action="{{ route('cart.store') }}">
                                                        @csrf
                                                        <input type="hidden" name="quantity" value="1" title="Qty" class="input-text qty text"/>
                                                        <input type="hidden" name="id" value="{{$product->id}}" />
                                                        <input type="hidden" name="refferer_id" value="{{ isset($referrer_details) ? $referrer_details->id : ''}}" />
                                                    </form>
                                                    <div class="product-button">
                                                        @if(isset($product->affiliate_link))
                                                            <a class="productBuyBtn" href="{{$product->affiliate_link}}">Buy</a>
                                                            
                                                        @else
                                                            <a class="productBuyBtn" rel="nofollow" onclick="addToCart({{$product->id}})">Add to cart</a>
                                                        @endif
                                                        <div class="favIcon">
                                                            <form id="wish-add-form-{{$product->id}}" method="POST" action="{{route('wishPost')}}">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{$product->id}}" />
                                                            </form>
                                                            <a rel="nofollow" onclick="document.getElementById('wish-add-form-{{$product->id}}').submit();" class="wishBtn"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    @if(empty($product->special_price))
                                                        <span class="product-amount">&#2547;{{$product->price}}</span><br>
                                                    @else
                                                        <span class="product-amount">&#2547;{{$product->special_price}}</span>
                                                        <del><span class="product-amount">&#2547;{{$product->price}}</span></del><br>
                                                    @endif
                                                    <a class="product-link" href="{{route('productDetails',$product->slug)}}">{{$product->name}}</a><br>
                                                    
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
                                                </div>
                                            </div>
                                            <!-- End Product Item-->
                                        </div>
                                    @empty
                                    <h1 style="text-align: center;">No Product available</h1>
                                    @endforelse
                                    
                                </div>
                                <!-- End Product Grid -->
                            </div>
                            
                        </div>


                        <div class="sidebar-container col-md-12 mobile_view">

                            <!-- Categories -->

                            <!-- Filter By Price -->
                            <div class="widget-sidebar widget-price-range">
                                <h6 class="widget-title">Filter By Price</h6>
                                <form action="{{route('price_range_category', $categorySlug)}}" class="widget-content" method="GET">
                                    {{csrf_field()}}
                                    <div class="price-range-slider"></div>
                                    <div class="price-range-amount">
                                        <input id="price_range_min" style="display: none;" type="text" name="min_price" value="" data-min="10" step="1" oninput="this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);var children = this.parentNode.childNodes[1].childNodes;children[1].style.width=value+'%';children[5].style.left=value+'%';children[7].style.left=value+'%';children[11].style.left=value+'%';children[11].childNodes[1].innerHTML=this.value;" />
                         
                                        <input id="price_range_max" style="display: none;" type="text"  name="max_price" value="" data-max="2000" step="1" oninput="this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);var children = this.parentNode.childNodes[1].childNodes;children[3].style.width=(100-value)+'%';children[5].style.right=(100-value)+'%';children[9].style.left=value+'%';children[13].style.left=value+'%';children[13].childNodes[1].innerHTML=this.value;" />
                                       
                                        <div id="price-range-from-to">
                                        </div>
                                        <br>
                                        <button type="submit" class="custom-btn btn_button">Filter</button>
                                        
                                        <input type="hidden" name="filter_color" value="black-de">
                                    </div>
                                </form>
                            </div>
                            <!-- Widget Product -->
                            <div class="widget-sidebar widget-product">
                                @include('user.inc.best_selling')
                            </div>

                            {{-- <div class="widget-sidebar widget-banner">
                                <a href="#" class="banner-image-wrap">
                                    <img src="{{asset('viewport/img/banner/banner_115146.jpg')}}" alt="" />
                                </a>
                            </div> --}}

                        </div>

                        {{-- <p class="woocommerce-result-count">Showing 1&ndash;{{count($products)}} of {{$products->total()}} results</p> --}}
                        

                        <div class="pagination-wraper">
                            <div class="pagination">
                                <ul class="pagination-numbers">
                                    <li>
                                        <spzan class="page-numbers">{!! $products->links() !!}</span>
                                    </li>
                                </ul>
                                
                            </div>
                        </div>

                    </div>
                    <!-- End Product Content -->

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