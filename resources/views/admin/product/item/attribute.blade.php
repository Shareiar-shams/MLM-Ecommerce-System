@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Attributes
@endsection
@section('admin_css_content')
  
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Product', 'Attribute']);
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
	                	<h3 class="card-title">Attributes</h3>

	                	<div class="right-content" style="float: right;">
		                	<a href="{{ route('item.index') }}" class="btn btn-primary" title=""><i class="fas fa-chevron-left"></i>Back</a>
		                	<a href="{{route('product.attribute.create',$id)}}" class="btn btn-primary" title=""><i class="fas fa-plus"></i>Add</a>
	                	</div>
	              	</div>
		            <!-- /.card-header -->
		            <div class="card-body">
		                <table id="example1" class="table table-bordered table-striped">
		                  	<thead>
				                <tr>
				                    <th>Name</th>
				                    <th>Action</th>
				                </tr>
		                  	</thead>
		                  	<tbody>
		                  		@foreach($attributes as $attribute)
				                <tr>
			                    	<td>{{$attribute->name}}</td>
			                    	<td>
			                    		<div class="btn-group">
						                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Options
						                      	<span class="sr-only">Toggle Dropdown</span>
						                    </button>
						                    <div class="dropdown-menu" role="menu">
						                    	<a class="dropdown-item" href="{{route('product.attribute.edit',['productId' => $id, 'id' => $attribute->id])}}"><i class="fas fa-angle-double-right"></i>Edit</a>

						                      	<a class="dropdown-item" href="#" onclick="

			                            			if(confirm('Are you Want to Uproot this!'))

						                            {

						                                event.preventDefault();

						                                document.getElementById('delete-form-{{$attribute->id}}').submit();

						                            }

						                            else

						                            {

						                                event.preventDefault();

						                            }
						                        "><i class="fas fa-angle-double-right"></i>
						                    		{{ __('Delete') }}
						                    	</a>
						                    	<form action="{{route('attribute.destroy',$attribute->id)}}" method="post" id="delete-form-{{$attribute->id}}" style="display: none;">
						                      		@csrf
											        @method('delete')
					                            </form>
						                      	
						                    </div>
						                </div>
			                    	</td>
				                </tr>
				                @endforeach
				                @if(count($attributes) > 0)
				                <tr class="text-center">
								    <td colspan="3">
								        <a class="btn btn-primary btn-sm " href="{{route('product.attribute.option',$id)}}">
								        <i class="fas fa-tasks"></i> Manage Options
								    </a>
								    </td>
								</tr>
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