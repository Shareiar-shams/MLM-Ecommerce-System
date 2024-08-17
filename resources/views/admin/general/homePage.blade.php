@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Home Page
@endsection
@section('admin_css_content')
  <link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.min.css')}}">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<style>
			
	    span.select2.select2-container.select2-container--classic{
	        width: 100% !important;
	    }
	</style>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('admin_content_header')
	<div class="col-sm-6">
		<h1 class="m-0">Home Page</h1>
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Information']);
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
        		<!-- /.row -->
		        <div class="card card-primary card-outline">
		          <div class="card-header">
		            <h3 class="card-title">
		              <i class="fas fa-edit"></i>
		              Home Page
		            </h3>
		          </div>
		          <div class="card-body">
		            <div class="row">
		              <div class="col-5 col-sm-3">
		                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
		                  <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Category product</a>
		                  <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Product Type</a>
		                  <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Single Column banner</a>
		                  <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false">Season Collection</a>

		                  <a class="nav-link" id="vert-tabs-slider-tab" data-toggle="pill" href="#vert-tabs-slider" role="tab" aria-controls="vert-tabs-slider" aria-selected="false">Slider Products</a>
		                </div>
		              </div>
		              <div class="col-7 col-sm-9">
		                <div class="tab-content" id="vert-tabs-tabContent">
		                  	<div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
		                     	<!-- general form elements -->
							            <div class="card card-success">
							              	<!-- form start -->
							              	<form action="{{ route('selected-categories.store') }}" method="post" accept-charset="utf-8">
							              		@csrf
								                <div class="card-body">
									                <div class="form-group">
									                    <label for="exampleInputEmail1">Section Title Name *</label>
									                    @forelse($indexDatas as $indexdata)
										                    @if($indexdata->mapping == 'category_selected')
										                    		<input type="text" class="form-control" id="exampleInputEmail1" value="{{$indexdata->title}}" name="section_title" placeholder="Enter Section Title *" required>
										                    @endif
									                    @empty
									                    		<input type="text" class="form-control" id="exampleInputEmail1" value="" name="section_title" placeholder="Enter Section Title *" required>
									                    @endforelse
									                </div>
							                  	<div class="line"></div>

							                  	<div class="card-header">
											                <h3 class="card-title" style="margin-left: -18px;">Category 1 :</h3>
											            </div>
									                <div class="form-group">
											                <label>Select Category *</label>
											                <select class="form-control select2bs4" name="category_id" id="category" style="width: 100%;" required>
											                    <option value="" selected="selected">Select One</option>
											                    @foreach ($categories as $category)
											                    	@if (!empty($selectedCategories) && count($selectedCategories) > 0 && $selectedCategories[0])

														            			<option value="{{ $category->id }}" {{ $category->id == $selectedCategories[0]->category->id ? 'selected' : '' }}>{{ $category->name }}</option>
														            		@else
														            			<option value="{{ $category->id }}" {{ $category->id === old('category_id') ? 'selected' : '' }}>{{ $category->name }}</option>
														            		@endif
																					@endforeach
											                </select>
									                </div>

										            	<div class="form-group">
										                <label>Select Sub Category</label>
										                <select class="form-control select2bs4" name="subcategory_id" id="subcategory" style="width: 100%;">
										                		@if($selectedCategories && !isset($selectedCategories[0]->subcategory->id))
										                    	<option value="" selected="selected">Select One</option>
										                    @endif
										                </select>
									                </div>


									                

									                <div class="line"></div>
							                  	<div class="card-header">
											                <h3 class="card-title"  style="margin-left: -18px;">Category 2 :</h3>
											            </div>
									                <div class="form-group">
											                <label>Select Category *</label>
											                <select class="form-control select2bs4" name="category_id2" id="category2" style="width: 100%;" required>
											                    <option value="" selected="selected">Select One</option>
											                    @foreach ($categories as $category)
												                    @if(!empty($selectedCategories) && count($selectedCategories) > 0 && $selectedCategories[1])
														            			<option value="{{ $category->id }}" {{ $category->id == $selectedCategories[1]->category->id ? 'selected' : '' }}>{{ $category->name }}</option>
														            		@else
														            			<option value="{{ $category->id }}" {{ $category->id === old('category_id2') ? 'selected' : '' }}>{{ $category->name }}</option>
														            		@endif
																					@endforeach
											                </select>
									                </div>

										            	<div class="form-group">
										                <label>Select Sub Category</label>
										                <select class="form-control select2bs4" name="subcategory_id2" id="subcategory2" style="width: 100%;">
										                		@if($selectedCategories && !isset($selectedCategories[1]->subcategory->id))
										                    	<option value="" selected="selected">Select One</option>
										                    @endif
										                </select>
									                </div>

									                <div class="line"></div>

						                  		<div class="card-header">
											                <h3 class="card-title"  style="margin-left: -18px;">Category 3 :</h3>
											            </div>
									                <div class="form-group">
											                <label>Select Category *</label>
											                <select class="form-control select2bs4" name="category_id3" id="category3" style="width: 100%;" required>
											                    <option value="" selected="selected">Select One</option>
											                    @foreach ($categories as $category)
												                    @if(!empty($selectedCategories) && count($selectedCategories) > 0 && $selectedCategories[2])
														            			<option value="{{ $category->id }}" {{ $category->id == $selectedCategories[2]->category->id ? 'selected' : '' }}>{{ $category->name }}</option>
														            		@else
														            			<option value="{{ $category->id }}" {{ $category->id === old('category_id3') ? 'selected' : '' }}>{{ $category->name }}</option>
														            		@endif
																					@endforeach
											                </select>
									                </div>

										            	<div class="form-group">
										                <label>Select Sub Category</label>
										                <select class="form-control select2bs4" name="subcategory_id3" id="subcategory3" style="width: 100%;">
										                		@if($selectedCategories && !isset($selectedCategories[2]->subcategory->id))
										                    	<option value="" selected="selected">Select One</option>
										                    @endif
										                </select>
									                </div>

								                	<div class="line"></div>

							                  	<div class="card-header">
										                <h3 class="card-title"  style="margin-left: -18px;">Category 4 :</h3>
										            	</div>
									                <div class="form-group">
											                <label>Select Category *</label>
											                <select class="form-control select2bs4" name="category_id4" id="category4" style="width: 100%;" required>
											                    <option value="" selected="selected">Select One</option>
											                    @foreach ($categories as $category)
												                    @if(!empty($selectedCategories) && count($selectedCategories) > 0 && $selectedCategories[3])
														            			<option value="{{ $category->id }}" {{ $category->id == $selectedCategories[3]->category->id ? 'selected' : '' }}>{{ $category->name }}</option>
														            		@else
														            			<option value="{{ $category->id }}" {{ $category->id === old('category_id4') ? 'selected' : '' }}>{{ $category->name }}</option>
														            		@endif
																					@endforeach
											                </select>
									                </div>

										            	<div class="form-group">
										                <label>Select Sub Category</label>
										                <select class="form-control select2bs4" name="subcategory_id4" id="subcategory4" style="width: 100%;">
										                		@if($selectedCategories && !isset($selectedCategories[3]->subcategory->id))
										                    	<option value="" selected="selected">Select One</option>
										                    @endif
										                </select>
									                </div>
								                </div>
								                <!-- /.card-body -->
								                <div class="card-footer">
								                  <button type="submit" class="btn btn-primary">Submit</button>
								                </div>
							              	</form>
							            </div>
							            <!-- /.card -->
		                  	</div>
		                  	<div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
		                  			<form action="{{route('single_carousal')}}" method="post" accept-charset="utf-8">
		                  				@csrf
											    		@method('put')
											    		<div class="form-group">
							                    <label for="exampleInputEmail1">Section Title Name *</label>
							                    @forelse($indexDatas as $indexdata)
								                    @if($indexdata->mapping == 'single_type')
								                    		<input type="text" class="form-control" id="exampleInputEmail1" value="{{$indexdata->title}}" name="section_title" placeholder="Enter Section Title *" required>
								                    @endif
							                    @empty
							                    		<input type="text" class="form-control" id="exampleInputEmail1" value="" name="section_title" placeholder="Enter Section Title *" required>
							                    @endforelse
							                </div>
							                <div class="form-group">
							                    <label>Select Type *</label>
									                <select class="form-control select2bs4" name="type_id" id="type" style="width: 100%;" required>
									                    <option selected="selected">Select One</option>
									                    @foreach($product_types as $type)
										                    <option value="{{$type->id}}" {{ $type->single_type == true ? 'selected' : ''}}>{{$type->name}}</option>
									                    @endforeach
									                </select>
									            </div>
							                <!-- /.card-body -->
							                <div class="card-footer">
							                  <button type="submit" class="btn btn-primary">Submit</button>
							                </div>
		                  			</form>
		                  	</div>
		                  	<div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
		                     	<div class="card-body">
			                     		<form action="{{route('single_column')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
				                  				@csrf
													    		@method('put')
													    		@if(isset($single_column))
															    		<img src="{{Storage::disk('local')->url($single_column->bg_image)}}" class="profile-user-img img-responsive" alt="Selected Banner Image" id="output">

															    		<input type="hidden" name="id" value="{{$single_column->id}}">
							                     		<div class="form-group">
										                    <label for="exampleInputFile">Background Image *</label>
										                    <div class="input-group">
											                    <div class="custom-file">
											                        <input type="file" accept="image/*" onchange="loadFile(event)" name="bg_image" class="custom-file-input" id="FeaturedImageInputFile">
											                        <label class="custom-file-label" for="exampleInputFile">Upload Image</label>
											                    </div>
										                    </div>
										                	</div>
									                    <small style="color: blue;">Image Size Should Be 440 x 289 px.</small>
												            	<div class="form-group">
											                    <label for="exampleInputEmail1">Title *</label>
											                    <input type="text" value="{{$single_column->heading}}" class="form-control" id="title" name="heading" placeholder="Enter Title" required>
											                </div>
											                <div class="form-group">
											                    <label for="exampleInputPassword1">Subtitle *</label>
											                    <input type="text" class="form-control" id="subtitle" value="{{$single_column->sub_heading}}" name="sub_heading" placeholder="Enter Sub Title" required>
											                </div>

											                <div class="form-group">
											                    <label for="exampleInputPassword1">Button Name *</label>
											                    <input type="text" class="form-control" id="button_name" value="{{$single_column->button_name}}" name="button_name" placeholder="Enter Button Name" required>
											                </div>

																			<div class="form-group">
											                    <label for="exampleInputPassword1">Button URL *</label>
											                    <input type="text" class="form-control" value="{{$single_column->button_url}}" id="button_url" name="button_url" placeholder="Enter URL" required>
											                </div>

											                <div class="form-group">
											                  	<button type="submit" class="btn btn-primary">Submit</button>
											                </div>
											            @else
											            		<img src="" class="profile-user-img img-responsive" alt="Selected Banner Image" id="output">

							                     		<div class="form-group">
										                    <label for="exampleInputFile">Background Image *</label>
										                    <div class="input-group">
											                    <div class="custom-file">
											                        <input type="file" accept="image/*" onchange="loadFile(event)" name="bg_image" class="custom-file-input" id="FeaturedImageInputFile" required>
											                        <label class="custom-file-label" for="exampleInputFile">Upload Image</label>
											                    </div>
										                    </div>
										                	</div>
									                    <small style="color: blue;">Image Size Should Be 440 x 289 px.</small>
												            	<div class="form-group">
											                    <label for="exampleInputEmail1">Title *</label>
											                    <input type="text"  class="form-control" id="title" name="heading" placeholder="Enter Title" required>
											                </div>
											                <div class="form-group">
											                    <label for="exampleInputPassword1">Subtitle *</label>
											                    <input type="text" class="form-control" id="subtitle" name="sub_heading" placeholder="Enter Sub Title" required>
											                </div>

																			<div class="form-group">
											                    <label for="exampleInputPassword1">Button Name *</label>
											                    <input type="text" class="form-control" id="button_name" name="button_name" placeholder="Enter Button Name" required>
											                </div>

																			<div class="form-group">
											                    <label for="exampleInputPassword1">Buton URL *</label>
											                    <input type="text" class="form-control" id="button_url" name="button_url" placeholder="Enter URL" required>
											                </div>

											                <div class="form-group">
											                  	<button type="submit" class="btn btn-primary">Submit</button>
											                </div>
											            @endif						                
								              </form>
						        			</div>
                				<!-- /.card-body -->
		                  	</div>
			                  <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
			                     <div class="card-body">
			                     		<form action="{{route('double_column')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
				                  				@csrf
													    		@method('put')
													    		<div class="form-group">
									                    <label for="exampleInputEmail1">Section Title Name *</label>
									                    @forelse($indexDatas as $indexdata)
										                    @if($indexdata->mapping == 'double_column_title')
										                    		<input type="text" class="form-control" id="exampleInputEmail1" value="{{$indexdata->title}}" name="section_title" placeholder="Enter Section Title *" required>
										                    @endif
									                    @empty
									                    		<input type="text" class="form-control" id="exampleInputEmail1" value="" name="section_title" placeholder="Enter Section Title *" required>
									                    @endforelse
									                </div>
							                  	<div class="line"></div>
							                  	
													    		@if(count($double_column) > 0)
															    		<img src="{{Storage::disk('local')->url($double_column[0]->bg_image)}}" class="profile-user-img img-responsive" alt="Selected Banner Image" id="output1">
															    		
															    		<input type="hidden" name="id_1" value="{{$double_column[0]->id}}">
							                     		<div class="form-group">
										                    <label for="exampleInputFile">Background Image *</label>
										                    <div class="input-group">
											                    <div class="custom-file">
											                        <input type="file" accept="image/*" onchange="loadFile1(event)" name="bg_image" class="custom-file-input" id="FeaturedImageInputFile1" required>
											                        <label class="custom-file-label" for="exampleInputFile">Upload Image</label>
											                    </div>
										                    </div>
										                	</div>
									                    <small style="color: blue;">Image Size Should Be 576 x 450 px.</small>
												            	<div class="form-group">
											                    <label for="exampleInputEmail1">Title *</label>
											                    <input type="text" value="{{$double_column[0]->heading}}" class="form-control" id="title" name="heading" placeholder="Enter Title" required>
											                </div>
											                <div class="form-group">
											                    <label for="exampleInputPassword1">Subtitle *</label>
											                    <input type="text" class="form-control" id="subtitle" value="{{$double_column[0]->sub_heading}}" name="sub_heading" placeholder="Enter Sub Title" required>
											                </div>

											                <div class="form-group">
											                    <label for="exampleInputPassword1">Button Name *</label>
											                    <input type="text" class="form-control" id="button_name" value="{{$double_column[0]->button_name}}" name="button_name" placeholder="Enter Button Name" required>
											                </div>

																			<div class="form-group">
											                    <label for="exampleInputPassword1">Button URL *</label>
											                    <input type="text" class="form-control" value="{{$double_column[0]->button_url}}" id="button_url" name="button_url" placeholder="Enter URL" required>
											                </div>

											                <div class="line"></div>
											                <hr>

											                <img src="{{Storage::disk('local')->url($double_column[1]->bg_image)}}" class="profile-user-img img-responsive" alt="Selected Banner Image" id="output2">
															    		
															    		<input type="hidden" name="id_2" value="{{$double_column[1]->id}}">
							                     		<div class="form-group">
										                    <label for="exampleInputFile">Background Image *</label>
										                    <div class="input-group">
											                    <div class="custom-file">
											                        <input type="file" accept="image/*" onchange="loadFile2(event)" name="bg_image1" class="custom-file-input" id="FeaturedImageInputFile2" required>
											                        <label class="custom-file-label" for="exampleInputFile">Upload Image</label>
											                    </div>
										                    </div>
										                	</div>
									                    <small style="color: blue;">Image Size Should Be 441 x 289 px.</small>
												            	<div class="form-group">
											                    <label for="exampleInputEmail1">Title *</label>
											                    <input type="text" value="{{$double_column[1]->heading}}" class="form-control" id="title" name="heading1" placeholder="Enter Title" required>
											                </div>
											                <div class="form-group">
											                    <label for="exampleInputPassword1">Subtitle *</label>
											                    <input type="text" class="form-control" id="subtitle" value="{{$double_column[1]->sub_heading}}" name="sub_heading1" placeholder="Enter Sub Title" required>
											                </div>

											                <div class="form-group">
											                    <label for="exampleInputPassword1">Button Name *</label>
											                    <input type="text" class="form-control" id="button_name" value="{{$double_column[1]->button_name}}" name="button_name1" placeholder="Enter Button Name" required>
											                </div>

																			<div class="form-group">
											                    <label for="exampleInputPassword1">Button URL *</label>
											                    <input type="text" class="form-control" value="{{$double_column[1]->button_url}}" id="button_url" name="button_url1" placeholder="Enter URL" required>
											                </div>

											                <div class="form-group">
											                  	<button type="submit" class="btn btn-primary">Submit</button>
											                </div>
											            @else
											            		<img src="" class="profile-user-img img-responsive" alt="Selected Banner Image" id="output1">

							                     		<div class="form-group">
										                    <label for="exampleInputFile">Background Image *</label>
										                    <div class="input-group">
											                    <div class="custom-file">
											                        <input type="file" accept="image/*" onchange="loadFile1(event)" name="bg_image" class="custom-file-input" id="FeaturedImageInputFile1" required>
											                        <label class="custom-file-label" for="exampleInputFile">Upload Image</label>
											                    </div>
										                    </div>
										                	</div>
									                    <small style="color: blue;">Image Size Should Be 576 x 450 px.</small>
												            	<div class="form-group">
											                    <label for="exampleInputEmail1">Title *</label>
											                    <input type="text"  class="form-control" id="title" name="heading" placeholder="Enter Title" required>
											                </div>
											                <div class="form-group">
											                    <label for="exampleInputPassword1">Subtitle *</label>
											                    <input type="text" class="form-control" id="subtitle" name="sub_heading" placeholder="Enter Sub Title" required>
											                </div>

																			<div class="form-group">
											                    <label for="exampleInputPassword1">Button Name *</label>
											                    <input type="text" class="form-control" id="button_name" name="button_name" placeholder="Enter Button Name" required>
											                </div>

																			<div class="form-group">
											                    <label for="exampleInputPassword1">Buton URL *</label>
											                    <input type="text" class="form-control" id="button_url" name="button_url" placeholder="Enter URL" required>
											                </div>

											                <div class="line"></div>
											                <hr>

											                <img src="" class="profile-user-img img-responsive" alt="Selected Banner Image" id="output2">

							                     		<div class="form-group">
										                    <label for="exampleInputFile">Background Image *</label>
										                    <div class="input-group">
											                    <div class="custom-file">
											                        <input type="file" accept="image/*" onchange="loadFile2(event)" name="bg_image1" class="custom-file-input" id="FeaturedImageInputFile2" required>
											                        <label class="custom-file-label" for="exampleInputFile">Upload Image</label>
											                    </div>
										                    </div>
										                	</div>
									                    <small style="color: blue;">Image Size Should Be 440 x 289 px.</small>
												            	<div class="form-group">
											                    <label for="exampleInputEmail1">Title *</label>
											                    <input type="text"  class="form-control" id="title" name="heading1" placeholder="Enter Title" required>
											                </div>
											                <div class="form-group">
											                    <label for="exampleInputPassword1">Subtitle *</label>
											                    <input type="text" class="form-control" id="subtitle" name="sub_heading1" placeholder="Enter Sub Title" required>
											                </div>

																			<div class="form-group">
											                    <label for="exampleInputPassword1">Button Name *</label>
											                    <input type="text" class="form-control" id="button_name" name="button_name1" placeholder="Enter Button Name" required>
											                </div>

																			<div class="form-group">
											                    <label for="exampleInputPassword1">Buton URL *</label>
											                    <input type="text" class="form-control" id="button_url" name="button_url1" placeholder="Enter URL" required>
											                </div>

											                <div class="form-group">
											                  	<button type="submit" class="btn btn-primary">Submit</button>
											                </div>
											            @endif						                
								              </form>
							        			</div>
	                				<!-- /.card-body -->
			                  </div>
			                  <div class="tab-pane fade" id="vert-tabs-slider" role="tabpanel" aria-labelledby="vert-tabs-slider-tab">
			                     <div class="card-body">
			                     		<form action="{{route('slider_products')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
				                  				@csrf
													    		@method('put')
													    			@if(isset($slider_products))
													    				<input type="hidden" name="id" value="{{$slider_products->id}}">
													    				<div class="form-group">
											                    <label for="exampleInputEmail1">Title *</label>
											                    <input type="text" value="{{$slider_products->heading}}" class="form-control" id="title" name="heading" placeholder="Enter Title" required>
											                </div>
											                <div class="form-group">
											                    <label for="exampleInputPassword1">Subtitle *</label>
											                    <input type="text" class="form-control" id="subtitle" name="sub_heading" value="{{$slider_products->sub_heading}}" placeholder="Enter Sub Title" required>
											                </div>

											                <div class="form-group">
											                		<img src="{{Storage::disk('local')->url($slider_products->bg_image)}}" class="profile-user-img img-responsive" alt="Selected Banner Image" id="output4">


											                    <label for="exampleInputFile">Thumbnail *</label>
											                    <div class="input-group">
												                    <div class="custom-file">
												                        <input type="file" accept="image/*" onchange="loadFile4(event)" name="bg_image" class="custom-file-input" id="FeaturedImageInputFile4" required>
												                        <label class="custom-file-label" for="exampleInputFile">Upload Image</label>
												                    </div>
											                    </div>
										                	</div>
										                  <small style="color: blue;">Image Size Should Be 
										                  400 x 785 px.</small>
											                <div class="form-group">
											                    <label for="exampleInputPassword1">Video Link *</label>
											                    <input type="text" class="form-control" id="video_url" name="button_url" value="{{$slider_products->button_url}}" placeholder="Enter Video Url" required>
											                </div>

											                <div class="form-group">
											                  	<button type="submit" class="btn btn-primary">Submit</button>
											                </div>
													    			@else
												            	<div class="form-group">
											                    <label for="exampleInputEmail1">Title *</label>
											                    <input type="text"  class="form-control" id="title" name="heading" placeholder="Enter Title" required>
											                </div>
											                <div class="form-group">
											                    <label for="exampleInputPassword1">Subtitle *</label>
											                    <input type="text" class="form-control" id="subtitle" name="sub_heading" placeholder="Enter Sub Title" required>
											                </div>

											                <div class="form-group">
											                		<img src="" class="profile-user-img img-responsive" alt="Selected Banner Image" id="output4">


											                    <label for="exampleInputFile">Thumbnail *</label>
											                    <div class="input-group">
												                    <div class="custom-file">
												                        <input type="file" accept="image/*" onchange="loadFile4(event)" name="bg_image" class="custom-file-input" id="FeaturedImageInputFile4" required>
												                        <label class="custom-file-label" for="exampleInputFile">Upload Image</label>
												                    </div>
											                    </div>
										                	</div>
										                  <small style="color: blue;">Image Size Should Be 
										                  400 x 785 px.</small>
											                <div class="form-group">
											                    <label for="exampleInputPassword1">Video Link *</label>
											                    <input type="text" class="form-control" id="video_url" name="button_url" placeholder="Enter Video Url" required>
											                </div>

											                <div class="form-group">
											                  	<button type="submit" class="btn btn-primary">Submit</button>
											                </div>

											            	@endif						                
								              </form>
							        			</div>
	                				<!-- /.card-body -->
			                  </div>
		                </div>
		              </div>
		            </div>
		          </div>
		          <!-- /.card -->
		        </div>
		        <!-- /.card -->
        	</div>
      </div>
  </div>
@endsection

@section('admin_js_content')
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<script type="text/javascript">

			// $('#output').hide();

			var loadFile = function(event) {
				$('#output').show();
				var image = document.getElementById('output');
				image.src = URL.createObjectURL(event.target.files[0]);
			};

			var loadFile1 = function(event) {
				$('#output1').show();
				var image = document.getElementById('output1');
				image.src = URL.createObjectURL(event.target.files[0]);
			};

			var loadFile2 = function(event) {
				$('#output2').show();
				var image = document.getElementById('output2');
				image.src = URL.createObjectURL(event.target.files[0]);
			};

			var loadFile4 = function(event) {
				$('#output4').show();
				var image = document.getElementById('output4');
				image.src = URL.createObjectURL(event.target.files[0]);
			};

			$('.js-example-basic-single').select2({
	        theme: "classic",
	        tags: true
	    });

	    $('.js-example-basic-single-meta').select2({
	        theme: "classic",
	        tags: true
	    });

	    $.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$(document).ready(function() {
			    function populateSubcategories(catId) {
			        $.ajax({
			            url: "{{ route('subcat') }}",
			            type: "POST",
			            data: {
			                parent_id: catId
			            },
			            success: function(data) {
			                $('#subcategory').find('option:not(:first)').remove();
			                $.each(data.subcategories, function(index, subcategory) {
			                    $('#subcategory').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
			                });
			            }
			        });
			    }

			    // Trigger the AJAX call initially based on the selected category
			    populateSubcategories($('#category').val());

			    // Trigger the AJAX call when the category dropdown changes
			    $('#category').on('change', function(e) {
			        populateSubcategories(e.target.value);
			    });

			    // Pre-select the subcategory option based on product's subcategory_id
			    var selectedSubcategoryId = '{{ $product->subcategory_id ?? '' }}';
			    $('#subcategory option[value="' + selectedSubcategoryId + '"]').attr('selected', 'selected');
			});
			$(document).ready(function() {
			    function populateSubcategories2(catId) {
			        $.ajax({
			            url: "{{ route('subcat') }}",
			            type: "POST",
			            data: {
			                parent_id: catId
			            },
			            success: function(data) {
			                $('#subcategory2').find('option:not(:first)').remove();
			                $.each(data.subcategories, function(index, subcategory) {
			                    $('#subcategory2').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
			                });
			            }
			        });
			    }

			    // Trigger the AJAX call initially based on the selected category
			    populateSubcategories2($('#category2').val());

			    // Trigger the AJAX call when the category dropdown changes
			    $('#category2').on('change', function(e) {
			        populateSubcategories2(e.target.value);
			    });

			    // Pre-select the subcategory option based on product's subcategory_id
			    var selectedSubcategoryId = '{{ $product->subcategory_id ?? '' }}';
			    $('#subcategory2 option[value="' + selectedSubcategoryId + '"]').attr('selected', 'selected');
			});

			$(document).ready(function() {
			    function populateSubcategories3(catId) {
			        $.ajax({
			            url: "{{ route('subcat') }}",
			            type: "POST",
			            data: {
			                parent_id: catId
			            },
			            success: function(data) {
			                $('#subcategory3').find('option:not(:first)').remove();
			                $.each(data.subcategories, function(index, subcategory) {
			                    $('#subcategory3').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
			                });
			            }
			        });
			    }

			    // Trigger the AJAX call initially based on the selected category
			    populateSubcategories3($('#category3').val());

			    // Trigger the AJAX call when the category dropdown changes
			    $('#category3').on('change', function(e) {
			        populateSubcategories3(e.target.value);
			    });

			    // Pre-select the subcategory option based on product's subcategory_id
			    var selectedSubcategoryId = '{{ $product->subcategory_id ?? '' }}';
			    $('#subcategory3 option[value="' + selectedSubcategoryId + '"]').attr('selected', 'selected');
			});

			$(document).ready(function() {
			    function populateSubcategories4(catId) {
			        $.ajax({
			            url: "{{ route('subcat') }}",
			            type: "POST",
			            data: {
			                parent_id: catId
			            },
			            success: function(data) {
			                $('#subcategory4').find('option:not(:first)').remove();
			                $.each(data.subcategories, function(index, subcategory) {
			                    $('#subcategory4').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
			                });
			            }
			        });
			    }

			    // Trigger the AJAX call initially based on the selected category
			    populateSubcategories4($('#category4').val());

			    // Trigger the AJAX call when the category dropdown changes
			    $('#category4').on('change', function(e) {
			        populateSubcategories4(e.target.value);
			    });

			    // Pre-select the subcategory option based on product's subcategory_id
			    var selectedSubcategoryId = '{{ $product->subcategory_id ?? '' }}';
			    $('#subcategory4 option[value="' + selectedSubcategoryId + '"]').attr('selected', 'selected');
			});
	    $(document).ready(function() {

		    	$('#category').on('change',function(e) {
						var cat_id = e.target.value;
						$.ajax({
							url:"{{ route('subcat') }}",
							type:"POST",
							data: {
								parent_id: cat_id
							},
							success:function (data) {
								$('#subcategory').find('option:not(:first)').remove();
								// console.log(data);
								$.each(data.subcategories,function(index,subcategory){
									$('#subcategory').append('<option value="'+subcategory.id+'">'+subcategory.name+'</option>');
								})
							}
						})
					});

					$('#category2').on('change',function(e) {
						var cat_id = e.target.value;
						$.ajax({
							url:"{{ route('subcat') }}",
							type:"POST",
							data: {
								parent_id: cat_id
							},
							success:function (data) {
								$('#subcategory2').find('option:not(:first)').remove();
								// console.log(data);
								$.each(data.subcategories,function(index,subcategory){
									$('#subcategory2').append('<option value="'+subcategory.id+'">'+subcategory.name+'</option>');
								})
							}
						})
					});

					$('#category3').on('change',function(e) {
						var cat_id = e.target.value;
						$.ajax({
							url:"{{ route('subcat') }}",
							type:"POST",
							data: {
								parent_id: cat_id
							},
							success:function (data) {
								$('#subcategory3').find('option:not(:first)').remove();
								// console.log(data);
								$.each(data.subcategories,function(index,subcategory){
									$('#subcategory3').append('<option value="'+subcategory.id+'">'+subcategory.name+'</option>');
								})
							}
						})
					});

					$('#category4').on('change',function(e) {
						var cat_id = e.target.value;
						$.ajax({
							url:"{{ route('subcat') }}",
							type:"POST",
							data: {
								parent_id: cat_id
							},
							success:function (data) {
								$('#subcategory4').find('option:not(:first)').remove();
								// console.log(data);
								$.each(data.subcategories,function(index,subcategory){
									$('#subcategory4').append('<option value="'+subcategory.id+'">'+subcategory.name+'</option>');
								})
							}
						})
					});
			});
	</script>
@endsection