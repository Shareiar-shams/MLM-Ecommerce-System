@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Ticket Category
@endsection
@section('admin_css_content')
	<style type="text/css" media="screen">
		.cat-name {
			font-weight: bold; 
			font-size: 18px;
		}
		.child-button{
			float: right;
		}
		@media only screen and (max-width: 600px) {
			.button-group {
				float: right;
				display: flex;
				align-items: center;
			}
			.child-button{
				margin-top: -15px;
			}
		}	
	</style>
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Create Category</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Category']);
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

  	<div class="row">
        <div class="col-md-8">
          	<div class="card card-info">
          		<div class="card-header">
          			<h3>Categories</h3>
		            <div class="card-tools">
		              <button type="button" class="btn btn-tool" data-card-widget="collapse">
		                <i class="fas fa-minus"></i>
		              </button>
		              
		            </div>
		        </div>
	            <div class="card-body">
		            <ul class="list-group">
		                @foreach ($categories as $category)
		                  	<li class="list-group-item" style="width: 100%;">
			                    <div class="d-flex justify-content-between" style="margin-bottom: 10px;">
			                    	<div class="cat-name"> 
					                    {{ $category->name }}
					                </div>
			                      	<div class="button-group d-flex">
			                        	<button type="button" class="btn btn-sm btn-primary mr-1 edit-category col-lg-6 col-md-6 col-sm-6" data-toggle="modal" data-target="#editCategoryModal" data-id="{{ $category->id }}" data-name="{{ $category->name }}" data-slug="{{ $category->slug }}">Edit</button>

				                        <form class="mr-2" action="{{ route('categories.destroy', $category->id) }}" method="POST" id="delete-form-{{$category->id}}">
				                          	@csrf
				                          	@method('DELETE')

				                          	<button type="submit" class="btn btn-sm btn-danger" onclick="
				                            if(confirm('Are you Want to Uproot this!'))
				                            {
				                                event.preventDefault();
				                                document.getElementById('delete-form-{{$category->id}}').submit();
				                            }
				                            else
				                            {
				                                event.preventDefault();
				                            }
				                            ">Delete</button>
				                        </form>
			                      	</div>
			                    </div>

			                    @if ($category->children)
			                      	<ul class="list-group mt-2">
				                        @foreach ($category->children as $child)
					                        <li class="list-group-item" style="width: 100%">
					                            <div class="d-flex justify-content-between row">
					                            	<div class="col-lg-4" style="font-weight: bold;">
					                              		{{ $child->name }}
					                              	</div>
					                              	<div class="button-group d-flex col-lg-4 child-button">
					                                	<button type="button" class="btn btn-sm btn-primary mr-1 edit-category col-lg-4 col-md-3 col-sm-3" data-toggle="modal" data-target="#editCategoryModal" data-id="{{ $child->id }}" data-name="{{ $child->name }}" data-slug="{{ $child->slug }}" data-parentname ="{{$child->parent_id}}">Edit</button>

						                                <form class="col-lg-3 col-md-3 col-sm-3" action="{{ route('categories.destroy', $child->id) }}" method="POST" id="delete-form-{{$child->id}}">
							                                @csrf
							                                @method('DELETE')

							                                <button type="submit" class="btn btn-sm btn-danger" onclick="
								                            if(confirm('Are you Want to Uproot this!'))
								                            {
								                                event.preventDefault();
								                                document.getElementById('delete-form-{{$child->id}}').submit();
								                            }
								                            else
								                            {
								                                event.preventDefault();
								                            }
								                            ">Delete</button>
						                                </form>
					                              	</div>
					                            </div>
					                        </li>
				                        @endforeach
			                      	</ul>
			                    @endif
		                  	</li>
		                @endforeach
		            </ul>
	            </div>
          	</div>
        </div>

        <div class="col-md-4">
          	<div class="card card-warning">
	            <div class="card-header">
	              	<h3>Create Category</h3>
	              	<div class="card-tools">
		              <button type="button" class="btn btn-tool" data-card-widget="collapse">
		                <i class="fas fa-minus"></i>
		              </button>
		              
		            </div>
	            </div>

	            <div class="card-body">
	              	<form action="{{ route('categories.store') }}" method="POST">
	                	@csrf
		                <div class="form-group">
		                  	<select class="form-control" name="parent_id">
		                    	<option value="">Select Parent Category</option>
		                    	@foreach ($categories as $category)
		                      		<option value="{{ $category->id }}">{{ $category->name }}</option>
		                    	@endforeach
		                  	</select>
		                </div>
		                <div class="form-group">
		                  	<input type="text" name="name" class="form-control" value="{{ old('name') }}" onkeyup="listingslug(this.value)" id="name" placeholder="Category Name" required>
		                </div>
		                <div class="form-group">
		                  	<input type="text" name="slug" class="form-control" value="{{ old('slug') }}" id="slug" placeholder="Enter Slug" required>
		                </div>
		                <div class="form-group">
		                  	<button type="submit" class="btn btn-primary">Create</button>
		                </div>
	              	</form>
	            </div>
          	</div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="editCategoryModal">
	      	<div class="modal-dialog" role="document">
		        <div class="modal-content">
		          	<div class="modal-header">
			            <h5 class="modal-title">Edit Category</h5>

			            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			              	<span aria-hidden="true">&times;</span>
			            </button>
		          	</div>

			        <form action="" method="POST">
			            @csrf
			            @method('PUT')

			            <div class="modal-body">
			            	<p class="category_id"></p>
			            	<div class="form-group">
			                  	<select class="form-control" name="parent_id">
			                    	<option value="">Select Parent Category</option>
			                    	@foreach ($categories as $category)
			                      		<option value="{{ $category->id }}">{{ $category->name }}</option>
			                    	@endforeach
			                  	</select>
			                </div>
			              	<div class="form-group">
			                	<input type="text" name="name" class="form-control" value="" onkeyup="listingslugedit(this.value)" id="name" placeholder="Category Name" required>
			              	</div>

			              	<div class="form-group">
			                	<input type="text" name="slug" class="form-control" value="" id="slug-edit" placeholder="Category slug" required>
			              	</div>
			            </div>

		            	<div class="modal-footer">
			              	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			              	<button type="submit" class="btn btn-primary">Update</button>
		            	</div>
		          	</form>
		      	</div>
	      	</div>
		</div>
  	</div>
@endsection

@section('admin_js_content')
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" rossorigin="anonymous"></script>

    <script type="text/javascript">

        $('.edit-category').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var slug = $(this).data('slug');
            var parentname = $(this).data('parentname');
            var url = "{{ route('categories.update', ['category' => ':id']) }}";
			url = url.replace(':id', id);
            $('#editCategoryModal form').attr('action', url);
            $('#editCategoryModal form input[name="name"]').val(name);
            
            $('#editCategoryModal form input[name="slug"]').val(slug);
            $('#editCategoryModal form select[name="parent_id"]').val(parentname);

            $('#editCategoryModal .category_id').text('Category ID: ' + id);
        });

        function slugify(text) {
		  	return text
		    .toString()                     // Cast to string
		    .toLowerCase()                  // Convert the string to lowercase letters
		    .normalize('NFD')       // The normalize() method returns the Unicode Normalization Form of a given string.
		    .replace(/\s+/g, '-')           // Replace spaces with -
		    .replace(/[^\w\-]+/g, '-')       // Remove all non-word chars
		    .replace(/\-\-+/g, '-')        // Replace multiple - with single -
		    .replace(/\&\&+/g, '-')        // Replace multiple & with single -
		    .replace(/\_\_+/g, '-')        // Replace multiple & with single -
		    
		    .trim();                         // Remove whitespace from both sides of a string
		}

		function listingslug(text) {
		 	document.getElementById("slug").value = slugify(text); 
		}

		function listingslugedit(text) {
		 	document.getElementById("slug-edit").value = slugify(text); 
		}
    </script>
@endsection