<div  class="newsletter-overlay">

	<div id="newsletter-popup" data-delay = {{$banner->delay_duration}}>
	    <a href="javascript:void(0)" class="popup-close">X</a>
	    <div id="announcement-modal" class="white-popup">
            <div class="announcement-with-content">
	            <div class="left-area">
	                <img width="300" height="400" src="{{Storage::disk('local')->url($banner->image)}}" alt="">
	            </div>
	            <div class="right-area">
	                <h3 class="">{{$banner->title}}</h3>
	                <p>{{$banner->description}}</p>
	                @if($banner->type == 'newletter')
		                <form class="subscriber-form" action="{{route('user_subscribe')}}" method="post">
		                    @csrf
	                        <div class="input-group">
		                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 
		                        <input class="form-control" type="email" name="email" placeholder="Enter your mail address" autocomplete="off" required />
		                        @error('email')
			                    <span class="text-danger">{{ $message}}</span>
			                    @enderror
		                    </div>
		                    
		                    <button class="btn btn-primary btn-block mt-2" type="submit">
		                        <span>Subscribe</span>
		                    </button>
		                </form>
		            @else
		            	<a class="btn btn-primary btn-block mt-2" href="{{$banner->url}}">
	                        <span>View</span>
	                    </a>
		            @endif
	            </div>
	        </div>
    
		</div>
	</div>
</div>