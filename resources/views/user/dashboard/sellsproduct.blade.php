@extends('user.dashboard.layouts')
@section('user_title_content')
    Ahknoxo | Dashboard
@endsection
@section('user_css_content')
	<!-- DataTables -->
  	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  	<link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  	<style>
		.productCard {
		  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
		  max-width: 300px;
		  margin: auto;
		  padding: 10px;
		  margin-bottom: 20px;
		  text-align: center;
		  font-family: arial;
		}

		.price {
		  color: grey;
		}
		.item-price{
			color: grey;
			font-size: 16px;
			margin-bottom: 15px;
		}
		.productCard button {
		  border: none;
		  outline: 0;
		  padding: 12px;
		  color: white;
		  background-color: #000;
		  text-align: center;
		  cursor: pointer;
		  width: 100%;
		  font-size: 18px;
		}
		.productCard button:hover {
		  opacity: 0.7;
		}
		
	</style>
@endsection

@section('dashboard_main_content')
	<div class="row row_section">
		<div class="card" style="width: 100%; margin-bottom: 5%;">
			<div class="card-header" style="display: revert; width: 100%;">
            	<h3 style="float: left;" class="card-title">Your Products List</h3>

            	<input type="text" style="display: none;" value="{{ URL::signedRoute('user.shop', ['referrer' => Crypt::encrypt(Auth::user()->mlmuser->id)]) }}" id="myShopInput" readonly>

		        <button class="btn btn-info" style="float: right;" onclick="mySHopFunction()"><i class="fa fa-cart-plus"></i> Your Shop URL</button>
          	</div>
			@if(isset(Auth::user()->mlmUser))
				
		        <form action="{{route('add_product')}}" method="post" accept-charset="utf-8">
		    		@csrf
	                <div class="card-body">
	                	<div class="row">
	                		<div class="col-md-12 col-sm-12">
		                		<div class="form-group ">
				                  	<label>Product Add To List</label>
					                <select class="form-control select2" name="product_id" style="width: 100%;" required>
					                	<option value="" selected>Select Product</option>}
					                	option
					                	@foreach($products as $product)
					                    	<option value="{{$product->id}}">{{$product->name}}</option>
					                    @endforeach
					                </select>
				                </div>
				                <!-- /.form-group -->
				            </div>
	                	</div>
	                </div>
	                <!-- /.card-body -->
	                <div class="card-footer">
	                	<div class="card-footer">
	                  		<button type="submit" class="btn btn-info">Add to List</button>
		                </div>
	                </div>
	                <!-- /.card-footer -->
		        </form>
			    <div class="row">
			    	@forelse(Auth::user()->mlmUser->products as $item)
					    <div class="col-lg-4 col-md-4 col-sm-4">
					     	<div class="card productCard">
					     		@if (Str::startsWith($item->featured_image, 'https'))
                                    <img src="{{$item->featured_image}}" alt="{{$item->name}}" style="width:100%" height="200">
                                @else
                                    <img src="{{Storage::disk('local')->url($item->featured_image)}}" alt="{{$item->name}}" style="width:100%" height="200">
                                @endif
							  	
							  	<h5>{{ Str::limit($item->name, 18) }}</h5>
							  	@if(empty($item->special_price))
                                    <p class="price">&#2547;{{$item->price}}</p>
                                @else
                                	<div class="item-price">
                                        <del style="margin-right: 5px">&#2547;{{$item->price}}</del><span class="special_price">&#2547;{{$item->special_price}}</span>
		                            </div>
                                @endif
							  	<p>
							        <input type="text" style="display: none;" value="{{ URL::signedRoute('product.referrer', ['slug' => $item->slug,'referrer' => Crypt::encrypt(Auth::user()->mlmuser->id)]) }}" id="myProductIndividualUrl" readonly>

							        <button onclick="myProductIndividual()">Copy URL</button>
							  	</p>
							</div>  
					    </div>
				    @empty
				    @endforelse
				    {{-- <div class="col-lg-4 col-md-4 col-sm-4">
				     	<div class="card productCard">
						  	<img src="{{asset('viewport/img/blank-user.png')}}" alt="Denim Jeans" style="width:100%" height="200">
						  	<h4>Tailored Jeans</h4>
						  	<p class="price">$19.99</p>
						  	<p><button>Add to Cart</button></p>
						</div>  
				    </div>
				    <div class="col-lg-4 col-md-4 col-sm-4">
				     	<div class="card productCard">
						  	<img src="{{asset('viewport/img/blank-user.png')}}" alt="Denim Jeans" style="width:100%" height="200">
						  	<h4>Tailored Jeans</h4>
						  	<p class="price">$19.99</p>
						  	<p><button>Add to Cart</button></p>
						</div>  
				    </div>
				    <div class="col-lg-4 col-md-4 col-sm-4">
				     	<div class="card productCard">
						  	<img src="{{asset('viewport/img/blank-user.png')}}" alt="Denim Jeans" style="width:100%" height="200">
						  	<h4>Tailored Jeans</h4>
						  	<p class="price">$19.99</p>
						  	<p><button>Add to Cart</button></p>
						</div>  
				    </div>
				    <div class="col-lg-4 col-md-4 col-sm-4">
				     	<div class="card productCard">
						  	<img src="{{asset('viewport/img/blank-user.png')}}" alt="Denim Jeans" style="width:100%" height="200">
						  	<h4>Tailored Jeans</h4>
						  	<p class="price">$19.99</p>
						  	<p><button>Add to Cart</button></p>
						</div>  
				    </div>
				    <div class="col-lg-4 col-md-4 col-sm-4">
				     	<div class="card productCard">
						  	<img src="{{asset('viewport/img/blank-user.png')}}" alt="Denim Jeans" style="width:100%" height="200">
						  	<h4>Tailored Jeans</h4>
						  	<p class="price">$19.99</p>
						  	<p><button>Add to Cart</button></p>
						</div>  
				    </div> --}}
				</div>

				 
			@endif
          	
		</div>
	</div>
@endsection
@section('user_js_content')
	<!-- DataTables  & Plugins -->
	<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>

	<script>
		$(function () {
		    $("#example").DataTable({
		      	"responsive": true, "lengthChange": false, "autoWidth": false,
		      	"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		    
		});
	</script>
@endsection
