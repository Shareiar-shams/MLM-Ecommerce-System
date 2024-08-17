
<div class="row grid">

    @if(isset($Typeproduct[0]))
    <div class="col-sm-12 col-md-6 grid-item *">

            <a href="#">

                @if (Str::startsWith($Typeproduct[0]->featured_image, 'https'))
                    <img height="500" src="{{$Typeproduct[0]->featured_image}}" alt="Product Image">
                @else

                    <img height="500"  src="{{Storage::disk('local')->url($Typeproduct[0]->featured_image)}}" alt="Product Image" class="">
                @endif

            </a>

      	<div class="content_product_list">

          	<h4>{{$Typeproduct[0]->name}}</h4>

          	{{-- <p>From world's top designer</p> --}}

          	<a class="custom-btn btn_button" href="{{route('productDetails', $Typeproduct[0]->slug)}}">View</a>

        </div>

    </div>
    @endif
    @if(isset($Typeproduct[1]))
    <div class="col-sm-6 col-md-6 grid-item">

            <a href="#">

                @if (Str::startsWith($Typeproduct[1]->featured_image, 'https'))
                    <img height="400" src="{{$Typeproduct[1]->featured_image}}" alt="Product Image">
                @else

                    <img height="400" src="{{Storage::disk('local')->url($Typeproduct[1]->featured_image)}}" alt="Product Image" class="">
                @endif

            </a>

       	<div class="content_product_list">

          	<h4>{{$Typeproduct[1]->name}}</h4>

          	<a class="custom-btn btn_button" href="{{route('productDetails', $Typeproduct[1]->slug)}}">View</a>

        </div>

    </div>
    @endif
    
    @if(isset($Typeproduct[3]))
    <div class="col-sm-12 col-md-6 grid-item coffee armchairs">

        <a href="#">

            @if (Str::startsWith($Typeproduct[3]->featured_image, 'https'))
                <img height="500" src="{{$Typeproduct[3]->featured_image}}" alt="Product Image">
            @else

                <img height="500" src="{{Storage::disk('local')->url($Typeproduct[3]->featured_image)}}" alt="Product Image" class="">
            @endif

        </a>

       	<div class="content_product_list">

          	<h4>{{$Typeproduct[3]->name}}</h4>

          	

          	<a class="custom-btn btn_button" href="{{route('productDetails', $Typeproduct[3]->slug)}}">View</a>

        </div>

    </div>
    @endif

    @if(isset($Typeproduct[2]))
    <div class="col-sm-6 col-md-6 grid-item Sofas">

        <a href="#">
            @if (Str::startsWith($Typeproduct[2]->featured_image, 'https'))
                <img height="400" src="{{$Typeproduct[2]->featured_image}}" alt="Product Image">
            @else

                <img height="400" src="{{Storage::disk('local')->url($Typeproduct[2]->featured_image)}}" alt="Product Image" class="">
            @endif
            

        </a>

        <div class="content_product_list">

            <h4>{{$Typeproduct[2]->name}}</h4>

            

            <a class="custom-btn btn_button" href="{{route('productDetails', $Typeproduct[2]->slug)}}">View</a>

        </div>

    </div>
    @endif

</div>
