<div class="container">

    <div class="section_title season_title">

        
        @forelse($indexDatas as $indexdata)
            @if($indexdata->mapping == 'double_column_title')
            	<h2>{{$indexdata->title}}</h2>
            @endif
        @empty
        	<h2>Season Collection</h2>
        @endforelse

    </div>

    <div class="row">


	    @forelse($double_column as $data)

	    	<div class="col-md-6">

		        <div class="season_collection_content">

		          	<div class="season_collection_img">

		            	<img src="{{Storage::disk('local')->url($data->bg_image)}}">

		          	</div>

		          	<div class="content_season">

			          	<h4>{{$data->heading}}</h4>

				        <p>{{$data->sub_heading}}</p>

				        <a class="custom-btn btn_button" href="{{$data->button_url}}">{{$data->button_name}}</a>

			        </div>

		        </div>

		    </div>
	    @empty
	    	<div class="col-md-6">

		        <div class="season_collection_content">

		          <div class="season_collection_img">

		            <img src="{{asset('viewport/img/season1.jpg')}}">

		          </div>

		          <div class="content_season">

		          <h4>Adventure's Fashion</h4>

		          <p>From world's top designer</p>

		          <a class="custom-btn btn_button" href="{{route('productDetails','dfsd')}}">Buy Now</a>

		        </div>

		        </div>

		    </div>
	    @endforelse

    </div>

</div>