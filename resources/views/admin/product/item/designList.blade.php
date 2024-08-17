@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Customize
@endsection
@section('admin_css_content')
  
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Product', 'Customize']);
	@endphp
	<x-ad-breadcrumb :list="$list"/>
@endsection

@section('admin_main_content')
	@if ($errors->any())                 
		@foreach ($errors->all() as $error)
			<div class="alert alert-danger alert-block">
		        <a type="button" class="close" data-dismiss="alert"></a> 
		        <strong>{{ $error }}</strong>
		    </div>
		@endforeach						                   
	@endif
	<div class="container-fluid">
        <div class="row">
          	<div class="col-12">
            	<div class="card">
	              	<div class="card-header">
	                	<h3 class="card-title">Customize Options</h3>

	                	<div class="right-content" style="float: right;">
		                	<a href="{{ route('item.index') }}" class="btn btn-primary" title=""><i class="fas fa-chevron-left"></i>Back</a>
		                	<a href="{{route('product.customize.design.create',$product->id)}}" class="btn btn-primary" title=""><i class="fas fa-plus"></i>Add</a>
	                	</div>
	              	</div>
		            <!-- /.card-header -->
		            <div class="card-body">
		                <table id="example1" class="table table-bordered table-striped">
		                  	<thead>
				                <tr>
				                	<th></th>
				                    <th>Type</th>
				                    <th>Name</th>
				                    <th>Image</th>
				                    <th>Action</th>
				                </tr>
		                  	</thead>
		                  	<tbody>
		                  		@if($product)
			                  		@foreach($product->customize_options as $options)
					                <tr>
					                	<td>{{$loop->index + 1}}</td>
				                    	<td>{{$options->option_type}}</td>
				                    	<td>{{$options->option_name}}</td>
				                    	<td><img class="img-responsive" width="50" height="70" src="{{Storage::disk('local')->url($options->image)}}" alt="Customize Design Image {{$options->option_name}}"></td>
				                    	<td>
				                    		<div class="btn-group">
							                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Options
							                      	<span class="sr-only">Toggle Dropdown</span>
							                    </button>
							                    <div class="dropdown-menu" role="menu">
							                    	<a class="dropdown-item" href="{{route('product.customize.design.edit',['productId' => $product->id, 'id' => $options->id])}}"><i class="fas fa-angle-double-right"></i>Edit</a>

							                      	<a class="dropdown-item" href="#" onclick="

				                            			if(confirm('Are you Want to Uproot this!'))

							                            {

							                                event.preventDefault();

							                                document.getElementById('delete-form-{{$options->id}}').submit();

							                            }

							                            else

							                            {

							                                event.preventDefault();

							                            }
							                        "><i class="fas fa-angle-double-right"></i>
							                    		{{ __('Delete') }}
							                    	</a>
							                    	<form action="{{route('product.customize.design.destroy',$options->id)}}" method="post" id="delete-form-{{$options->id}}" style="display: none;">
							                      		@csrf
												        @method('delete')
						                            </form>
							                      	
							                    </div>
							                </div>
				                    	</td>
					                </tr>
					                @endforeach
				                @endif
		                  	</tbody>
		                </table>
		            </div>
		            <!-- /.card-body -->
            	</div>
            	<!-- /.card -->
          	</div>
          	<!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection

@section('admin_js_content')
@endsection