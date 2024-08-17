<div class="deal-of-day-section  mt-20">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title" style=" display: flex; justify-content: space-between; align-items: center;">
                    <h2>Top Rated Products</h2>
                    <div class="right-area" style="display: flex; align-items: center;">                        
                        <a class="right_link" style="float: right; text-decoration: none; color: inherit; padding: 0.5em 1em;" href="{{route('product.top_product')}}">View All 
                          <i class="fa fa-chevron-right"></i>
                        </a>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @forelse($topRatedProducts as $product)
              <div class="col-md-4">

                <div class="img_custmoization">
                  @if (Str::startsWith($product->featured_image, 'https'))
                      <img height="200" src="{{$product->featured_image}}" alt="Product Image" class="">
                  @else

                      <img height="200" src="{{Storage::disk('local')->url($product->featured_image)}}" alt="Product Image" class="">
                  @endif

                </div>

                <div class="content_custom">

                  <h4><a class="product-link" href="{{route('productDetails',$product->slug)}}">{{$product->name}}</a><br></h4>

                  @if(empty($product->special_price))
                      <span class="product-amount">&#2547;{{$product->price}}</span><br>
                  @else
                      <span class="product-amount">&#2547;{{$product->special_price}}</span>
                      <del><span class="product-amount">&#2547;{{$product->price}}</span></del><br>
                  @endif

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
            @empty
            @endforelse

        </div>

    </div>
</div>
