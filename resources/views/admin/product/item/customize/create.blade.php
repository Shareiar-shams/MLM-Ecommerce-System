@extends('admin.layouts.layout')
@section('admin_title_content')
    AHVision | Product
@endsection
@section('admin_css_content')
	<!-- summernote -->
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
		
	</div><!-- /.col -->
	@php 
	  $list = json_encode(['Home', 'Product', 'Create']);
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
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					<h5 class="m-0">Add Customize Product</h5>
				</div>
				<a style="float: right;" href="{{route('item.index')}}" class="btn btn-primary" title=""><i class="fas fa-chevron-left"></i>Back</a>
			</div>
		</div>
    	<form action="{{route('item.store')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    		{{csrf_field()}}
        	<div class="row">
        	
	          	<!-- left column -->
	          	<div class="col-md-8 col-sm-6">
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
			                    <label for="exampleInputEmail1">Name *</label>
			                    <input type="text"  class="form-control" onkeyup="listingslug(this.value)" id="name" name="name" placeholder="Enter Name" required>
			                </div>
			                <div class="form-group">
			                    <label for="exampleInputPassword1">Slug *</label>
			                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter Slug" required>
			                </div>
			                <input type="hidden" name="productType" value="customize">
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
		                	<img src="" class="profile-user-img img-responsive" alt="Selected Featured Image" id="output">
			                <div class="form-group">
			                    <label for="exampleInputFile">Featured Image *</label>
			                    <div class="input-group">
				                    <div class="custom-file">
				                        <input type="file" accept="image/*" onchange="loadFile(event)" name="featured_image" class="custom-file-input" id="FeaturedImageInputFile" required>
				                        <label class="custom-file-label" for="exampleInputFile">Upload Image</label>
				                    </div>
			                    </div>
			                </div>
		                    <small style="color: blue;">Image Size Should Be 800 x 800. or square size</small>
		                </div>
		                <!-- /.card-body -->
		            </div>
		            <!-- /.card -->

		            <!-- Input addon -->
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
		                	<div class="form-group" style="display: block; overflow: hidden; height: 100%;">
		                		<label for="exampleInputFile">Gallery Images</label>
					            <div id="filediv" class="row">
					            	<input name="gallery_image[]" class="form-control" type="file" id="file" multiple=""/>
					            	
					            </div>
						    </div>
				    		<input type="button" id="add_more" class="btn btn-primary" value="Add More Files"/>
				    		<br>
			                {{-- <div class="form-group">
			                    <label for="exampleInputFile">Gallery Images</label>
			                    <div class="input-group">
				                    <div class="custom-file">
				                        <input type="file" name ="gallery_image" class="custom-file-input" id="exampleInputFile">
				                        <label class="custom-file-label" for="exampleInputFile">Upload Image</label>
				                    </div>
			                    </div>
			                </div> --}}
			                <small style="color: blue;">Image Size Should Be 800 x 800. or square size</small>
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
			            	<div class="from-group">
				            	<label for="exampleInputEmail1">Short Description *</label>
				              	<textarea class="form-control" name="short_description" placeholder="Short Description"></textarea>
				            </div>
			              	<div class="from-group mt-3">
				            	<label for="exampleInputEmail1">Description *</label>
				              	<textarea id="summernote" name="description" placeholder="Description" required></textarea>
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

			            <div class="card-body">
			            	<div class="from-group">
			            		
				              	<label for="exampleInputEmail1">Product Tag</label>
				              	<select class="js-example-basic-single" multiple name="tags[]">
                                </select>
			            	</div>
			            	<div class="from-group">
				            	<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success mt-3">
			                      	<input type="checkbox" value="1" name="specifications" class="custom-control-input" id="customSwitch1">
			                      	<label class="custom-control-label" for="customSwitch1">Specifications</label>
			                    </div>
			                    <div id="specifications-section" class="specifications-section mt-3" style="display: none;">
			                        <div class="d-flex">

			                            <div class="flex-grow-1">
			                                <div class="form-group">
			                                    <input type="text" class="form-control" name="specification_name[]" placeholder="Specification Name" value="">
			                                </div>
			                            </div>
			                            <div class="flex-grow-1">
			                                <div class="form-group">
			                                    <input type="text" class="form-control" name="specification_description[]" placeholder="Specification description" value="">
			                                </div>
			                            </div>
			                            <div class="flex-btn">
			                                <button type="button" class="btn btn-success add-specification" data-text="Specification Name" data-text1="Specification Description"> <i class="fa fa-plus"></i> </button>
			                            </div>
			                        </div>
			            		</div>
			            		<div class="additional-specifications">
								  <!-- New input fields will be added here -->
								</div>
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

			            <div class="card-body">
			            	<div class="from-group">
			            		
				              	<label for="exampleInputEmail1">Meta Keywords</label>
				              	<select class="js-example-basic-single-meta" multiple name="meta_keywords[]">
                                </select>
			            	</div>

			            	<div class="from-group mt-2">
				            	<label for="exampleInputEmail1">Meta Description</label>
				              	<textarea name="meta_descriptions" class="form-control" placeholder="Enter Meta Descriptions"></textarea>
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

			            <div class="card-body">

			            	<div class="from-group">
				            	<label for="exampleInputEmail1">External Customize Charge</label>
				            	<input type="text" name="customize_charge" class="form-control" placeholder="Enter Customize Charge">
				            	
			            	</div>

			            </div>
		                <!-- /.card-body -->
		            </div>
		            <!-- /.card -->
	          	</div>
	          	<!--/.col (left) -->

		        <!-- right column -->
		        <div class="col-md-4 col-sm-6">
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
			              	<label for="exampleInputEmail1">Current Price *</label>
			            	<div class="input-group">
			                  <div class="input-group-prepend">
			                    <span class="input-group-text">
			                      <i class="fas fa-dollar-sign"></i>
			                    </span>
			                  </div>
			                  <input type="text" name="price" class="form-control" placeholder="Enter Current Price" required>
			                </div>

			            	<label for="exampleInputEmail1">Special Price</label>
		                    <div class="input-group">
			                  <div class="input-group-prepend">
			                    <span class="input-group-text">
			                      <i class="fas fa-dollar-sign"></i>
			                    </span>
			                  </div>
			                  <input type="text" name="special_price" class="form-control" placeholder="Enter Special Price">
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

			            <div class="card-body">
			              	<div class="form-group">
				                <label>Select Category *</label>
				                <select class="form-control select2bs4" name="category_id" id="category" style="width: 100%;" required>
				                    <option value="" selected="selected">Select One</option>
				                    @foreach ($categories as $category)
							            <option value="{{ $category->id }}" {{ $category->id === old('category_id') ? 'selected' : '' }}>{{ $category->name }}</option>
									@endforeach
				                </select>
			                </div>

			            	<div class="form-group">
				                <label>Select Sub Category</label>
				                <select class="form-control select2bs4" name="subcategory_id" id="subcategory" style="width: 100%;">
				                    <option value="" selected="selected">Select One</option>
				                    
				                </select>
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
		                	<div class="form-group">
			                    <label for="exampleInputEmail1">Total in stock *</label>
			                    <input type="text" name="stock" class="form-control" id="exampleInputEmail1" placeholder="Total in stock" required>
			                </div>
			                <div class="form-group">
				                <label>Select Type *</label>
				                <select class="form-control select2bs4" name="type_id" id="type" style="width: 100%;" required>
				                    <option value="" selected="selected">Select One</option>
				                    @foreach ($type as $type)
							            <option value="{{ $type->id }}" {{ $type->id === old('type_id') ? 'selected' : '' }}>{{ $type->name }}</option>
									@endforeach
				                </select>
			                </div>
		                  	<div class="form-group">
		                    	<label for="exampleInputEmail1">SKU *</label>
		                    	<input type="text" name="SKU" class="form-control" id="exampleInputEmail1" value="{{$sku}}" placeholder="Enter SKU" required>
		                  	</div>
			                <div class="form-group">
			                    <label for="exampleInputPassword1">Video Link</label>
			                    <input type="text" class="form-control" name="video_link" id="exampleInputPassword1" placeholder="Enter Video Link">
			                </div>
		                </div>
		                <!-- /.card-body -->
		            </div>
		            <!-- /.card -->

		            <!-- general form elements -->
		            <div class="card card-default">
		            	<!-- /.card-body -->
		                <div class="card-footer">
		                  	<button type="submit" class="btn btn-info">Save</button>
		                  	<a href="{{route('item.index')}}" class="btn btn-default float-right">Cancel</a>
		                </div>
		                <!-- /.card-footer -->
		            </div>
		            <!-- /.card -->
		        </div>
		        <!--/.col (right) -->
        	</div>
        </form>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection

@section('admin_js_content')
	<!-- Summernote -->
	<script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	
	<!-- Page specific script -->
	<script>
		$('#output').hide();

		var loadFile = function(event) {
			$('#output').show();
			var image = document.getElementById('output');
			image.src = URL.createObjectURL(event.target.files[0]);
		};
	  	$(function () {
	    	// Summernote
	    	$('#summernote').summernote()
	    
	  	})

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

			$('#customSwitch1').on('change', function() {
			    if ($(this).is(':checked')) {
			      	$('.specifications-section').show();
			    } else {
			      	$('.specifications-section').hide();
			    }
			});
		});
		$(document).ready(function() {
		  $('.add-specification').click(function() {
		    var specificationName = $(this).data('text');
		    var specificationDescription = $(this).data('text1');

		    var newSpecification = `
		      <div class="d-flex">
		        <div class="flex-grow-1">
		          <div class="form-group">
		            <input type="text" class="form-control" name="specification_name[]" placeholder="${specificationName}" value="">
		          </div>
		        </div>
		        <div class="flex-grow-1">
		          <div class="form-group">
		            <input type="text" class="form-control" name="specification_description[]" placeholder="${specificationDescription}" value="">
		          </div>
		        </div>
		        <div class="flex-btn">
		          <button type="button" class="btn btn-danger remove-specification">
		            <i class="fa fa-minus"></i>
		          </button>
		        </div>
		      </div>
		    `;

		    $('.additional-specifications').append(newSpecification);
		  });

		  $('.additional-specifications').on('click', '.remove-specification', function() {
		    $(this).closest('.d-flex').remove();
		  });
		});

		var abc = 0;
	    $('#add_more').click(function (){
			var newInput = $("<input/>", {
		        class: 'form-control',
		        name: 'gallery_image[]',
		        type: 'file',
		        id: 'file'
		    });
	        $('#filediv').fadeIn('slow').append(newInput);
	    });
	    $('.form-group').on('change', '#file', function (){
	        if (this.files && this.files[0]){
	            abc += 1; //increementing global variable by 1
	            
	            $(this).before("<div id='abcd" + abc + "' class='abcd col-lg-3'><img class = 'card-img-top' style='width:100%; height:100px;' id='previewimg" + abc + "' src=''/></div>");
	            var reader = new FileReader();
	            reader.onload = imageIsLoaded;
	            reader.readAsDataURL(this.files[0]);
	            $(this).hide();
	            $("#abcd" + abc).append($("<div/>", { class: 'card-body' })
			        .append($("<img/>", {
			            style: 'width:100px; height:50px;',
			            id: 'img',
			            src: '{{ asset('admin/dist/img/remove.jpg') }}',
			            alt: 'delete'
			        }).click(function () {
			            $(this).parent().parent().remove();
			        }))
			    );
	        }
	    });
	    //image preview
	    function imageIsLoaded(e)
	    {
	        $('#previewimg' + abc)
	            .attr('src', e.target.result);
	    };
	</script>
@endsection