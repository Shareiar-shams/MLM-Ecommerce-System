<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{ __("You're logged in!") }}
                    <div class="row">
                        @if(!empty($user))
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title">{{$user->user->name}}</h5>
                            <p class="card-text">{{$user->user->email}}</p>
                            <p class="card-text">{{$user->user->phone}}</p>
                            
                          </div>
                          <div class="card-footer">
                            <p class="card-text">{{ URL::signedRoute('user.referrer', ['referrer' => Crypt::encrypt($user->id), 'type' => 'normal']) }}</p>
                                <a href="#" title="" class="btn btn-info">Copy</a>
                          </div>
                        </div>
                        @endif
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        @if(!empty($offers))
                            @foreach($offers as $offer)
                                <div class="col-sm-4">
                                    
                                    <div class="card" style="width: 18rem;">
                                        <img class="card-img-top" src="{{Storage::disk('local')->url($offer->digitalProduct->featured_image)}}" alt="">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$offer->digitalProduct->name}}</h5>
                                            <p class="card-text">{{$offer->digitalProduct->short_description}}</p>
                                        </div>
                                        <div class="card-footer">
                                            <p class="card-text">
                                            @if($offer->offer_type == 'special')
                                                {{ URL::signedRoute('offer.purchase', ['digitalproduct' => $offer->digitalProduct->id, 'offer' => $offer->id, 'type' => 'special', 'user' => Crypt::encrypt($user->id)]) }}
                                            @else
                                                {{ URL::signedRoute('offer.purchase', ['digitalproduct' => $offer->digitalProduct->id, 'offer' => $offer->id, 'type' => 'normal', 'user' => Crypt::encrypt($user->id)]) }}
                                            @endif
                                            </p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                </div>
                                
                            @endforeach
                        @endif
                    </div>
                    <br>
                    <br>
                    <div class="row">
                        <h2>All Child User</h2>
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                    @if($item->user->status == 1)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$item->user->name}}</td>
                                        <td>{{$item->user->email}}</td>
                                        <td>{{$item->user->phone}}</td>
                                          
                                        <td>
                                        @if($item->admin_activation == 1 && $item->parent_activation == 1)
                                            <label class="badge badge-success">Active</label>
                                            
                                        @elseif(isset($item->refferer_id) && $item->admin_activation == 0 && $item->parent_activation == 1)
                                            <label class="badge badge-warning">Unautorize By Admin</label>
                                        @elseif(isset($item->refferer_id) && $item->admin_activation == 1 && $item->parent_activation == 0)
                                            <label class="badge badge-warning">Unautorize By You</label>
                                        
                                        @endif
                                        </td>
                                       
                                        <td>
                                            @if(isset($item->refferer_id) && $item->parent_activation == 0)
                                                <a class="btn btn-primary" href="{{route('payforuser',$item->id)}}"><i class="fas fa-angle-double-right"></i>Activated User From You</a>
                                            @elseif(isset($item->refferer_id) && $item->admin_activation == 0)
                                                <a class="btn btn-primary" href="{{route('payforuser',$item->id)}}"><i class="fas fa-angle-double-right"></i>Pay to Admin</a>
                                            @else
                                                <label class="badge badge-success">Already Paid</label>
                                            @endif
                                               
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach 
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
