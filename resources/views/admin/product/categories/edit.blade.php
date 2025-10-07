@extends('layouts.administration.app')
@section('admin_title_content')
    AHVision | Product Categories
@endsection
@section('admin_content_header')
    <div class="col-sm-6">
        <h1 class="m-0">{{___('Product Categories Edit')}}</h1>
    </div><!-- /.col -->
    <!-- breadcrumb -->
    <x-ad-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.home')],
        ['label' => 'Categories', 'url' => route('admin.product.categories')]
    ]" />
@endsection
@section('admin_vendor_css')
	<!-- summernote -->
  	<link rel="stylesheet" href="{{asset('admin/assets/plugins/summernote/summernote-bs4.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('admin/assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('admin_page_css')
@endsection

@section('admin_main_content')
	<!-- Display Validation Error -->
	@include('admin.validationError.error')
    <!-- container-fluid -->
	<div class="container-fluid">
        <div class="card">
			<div class="card-header">
				<a class="btn btn-primary btn-sm float-right" href="{{ route('admin.product.categories') }}"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back</a>
			</div>
		</div>
    	<form action="{{route('admin.categories.update', ['category' => $category->id])}}" method="post" enctype="multipart/form-data">
    		@csrf
            @method('PUT')
        	<div class="row">
	          	<div class="col-md-12 col-sm-12">
		            <!-- general form elements -->
		            <div class="card card-default">
		            	<div class="card-header">

				            <div class="card-tools">
				              <button type="button" class="btn btn-tool" data-card-widget="collapse">
				                <i class="fas fa-minus"></i>
				              </button>
				              
				            </div>
				        </div>
				        <!-- /.card-header -->
		                <div class="card-body">
			                <div class="form-group">
								<select class="form-control select2bs4" name="parent_id">
									<option value="">Select a category</option>
									@foreach ($categories as $objcategory)
										<option value="{{ $objcategory->id }}" 
											{{ $objcategory->id == $category->parent_id ? 'selected' : '' }}>
											{{ $objcategory->name }}
										</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<input type="text" name="name" class="form-control" value="{{ $category->name }}" onkeyup="listingslug(this.value)" id="name" placeholder="Category Name" required>
							</div>
							<div class="form-group">
								<input type="text" name="slug" class="form-control" value="{{ $category->slug }}" id="slug" placeholder="Enter Slug" required>
							</div>
		                </div>
		                <!-- /.card-body -->
		            </div>
		            <!-- /.card -->

					<!-- general form elements -->
		            <div class="card card-default">
		            	<div class="card-header">

				            <div class="card-tools">
				              <button type="button" class="btn btn-tool" data-card-widget="collapse">
				                <i class="fas fa-minus"></i>
				              </button>
				              
				            </div>
				        </div>
				        <!-- /.card-header -->
		                <div class="card-body">
		                	<img src="{{ $category->image_url }}" class="profile-user-img img-responsive" alt="Selected  Image" id="output">
			                <div class="form-group">
			                    <label for="exampleInputFile">Image </label>
			                    <div class="input-group">
				                    <div class="custom-file">
				                        <input type="file" accept="image/*" onchange="loadFile(event)" name="image" class="custom-file-input" id="ImageInputFile">
				                        <label class="custom-file-label" for="exampleInputFile">Upload Image</label>
				                    </div>
			                    </div>
			                </div>
		                    <small style="color: blue;">Image Size Should Be 800 x 800. or square size (This field is Optional)</small>
		                </div>
		                <!-- /.card-body -->
		            </div>
		            <!-- /.card -->

					<!-- general form elements -->
		            <div class="card card-default">
		            	<div class="card-header">

				            <div class="card-tools">
				              <button type="button" class="btn btn-tool" data-card-widget="collapse">
				                <i class="fas fa-minus"></i>
				              </button>
				              
				            </div>
				        </div>

			            <div class="card-body">
			              	<div class="from-group mt-3">
				            	<label for="exampleInputEmail1">Description *</label>
				              	<textarea id="summernote" name="description" placeholder="Description" required>{{ $category->description }}</textarea>
				            </div>

			            </div>
		                <!-- /.card-body -->
		            </div>
		            <!-- /.card -->

		            <!-- general form elements -->
		            <div class="card card-default">
		            	<!-- /.card-body -->
		                <div class="card-footer">
		                  	<button type="submit" class="btn btn-primary">Save</button>
		                  	<a href="{{route('admin.product.categories')}}" class="btn btn-default float-right">Cancel</a>
		                </div>
		                <!-- /.card-footer -->
		            </div>
		            <!-- /.card -->
		        </div>
        	</div>
        </form>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('admin_page_js')
	@include('admin.additionalObject.createDocumentScript')
@endsection