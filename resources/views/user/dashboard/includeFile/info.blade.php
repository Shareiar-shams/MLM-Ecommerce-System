<div class="user_logo">

    <form action="{{route('image.update')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <p><input type="file" accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;" required></p>

        @if(Auth::user()->profile_image != null)
            <label for="file" style="cursor: pointer; display: inline;"><img src="{{Storage::disk('local')->url(Auth::user()->profile_image)}}" class="profile-user-img img-responsive img-circle" alt="User profile picture" id="output"></label>
        @else
            <label for="file" style="cursor: pointer; display: inline;"><img src="{{asset('viewport/img/blank-user.png')}}" class="profile-user-img img-responsive img-circle" alt="User profile picture" id="output"></label>
        @endif
        
        

        <input type="submit" class="btn btn-info btn-block" value="Change Profile Picture">
    </form>
    <h2>{{ Auth::user()->name }}</h2>
    <p>Joined {{ Auth::user()->created_at->isoFormat('D MMMM Y') }}</p>
    @if(isset(Auth::user()->mlmUser))
    <p><strong>Total Sell: </strong>{{ Auth::user()->mlmUser->refererchildren->count()}}</p>
    
    <div class="copy_link_bs">

        <input type="text" value="{{ URL::signedRoute('user.referrer', ['referrer' => Crypt::encrypt(Auth::user()->id), 'type' => 'normal']) }}" id="myInput" readonly>

        <button onclick="myFunction()">Copy</button>

    </div>
    @endif
</div>