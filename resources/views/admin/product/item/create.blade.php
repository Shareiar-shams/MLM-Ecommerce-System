@extends('layouts.administration.app')
@section('admin_title_content')
    AHVision | Product Create
@endsection
@section('admin_content_header')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Products') }}</h1>
    </div><!-- /.col -->
    <!-- breadcrumb -->
    <x-ad-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.home')],
        ['label' => 'Products', 'url' => route('admin.product.item.index')],
        ['label' => 'Create New Product']
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
    <style>
        #filediv {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .preview-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            background: #f9f9f9;
            transition: all 0.3s ease;
        }

        .preview-item:hover {
            transform: scale(1.05);
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .preview-item img {
            border-radius: 6px;
        }

    </style>
@endsection


@section('admin_main_content')
    @include('admin.validationError.error')
    <div class="container-fluid">
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					<h5 class="m-0">Add Product</h5>
				</div>
				<a style="float: right;" href="{{route('admin.product.item.index')}}" class="btn btn-primary" title=""><i class="fas fa-chevron-left"></i>Back</a>
			</div>
		</div>
    	<form action="{{route('admin.product.item.store')}}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
    		@csrf
        	<div class="row">
        	
	          	<!-- left column -->
	          	<div class="col-md-8 col-sm-6">
		            <!-- general form elements -->
                    {{-- BASIC INFO --}}
		            <div class="card card-default">
		            	<div class="card-header">
                            <h6 class="mb-0">Basic Information</h6>
				            <div class="card-tools">
				              <button type="button" class="btn btn-tool" data-card-widget="collapse">
				                <i class="fas fa-minus"></i>
				              </button>
				              
				            </div>
				        </div>
				        <!-- /.card-header -->
		                <div class="card-body">
                            <div class="form-group">
                                <label>Product Type *</label>
                                <select name="productType" id="productType" class="form-control select2tagf" required>
                                    <option value="physical">Physical</option>
                                    <option value="affiliate">Affiliate</option>
                                </select>
                            </div>
			                <div class="form-group">
			                    <label for="exampleInputEmail1">Name *</label>
			                    <input type="text"  class="form-control" onkeyup="listingslug(this.value)" id="name" name="name" placeholder="Enter Name" required>
			                </div>
			                <div class="form-group">
			                    <label for="exampleInputPassword1">Slug *</label>
			                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter Slug" required>
			                </div>

                            {{-- Only show affiliate link if affiliate type --}}
                            <div class="form-group affiliate-only d-none">
                                <label>Affiliate Link *</label>
                                <input type="text" class="form-control" name="affiliate_link" id="affiliate_link" placeholder="Affiliate Link">
                            </div>
		                </div>
		                <!-- /.card-body -->
		            </div>
		            <!-- /.card -->

		            <!-- general form elements -->
                    {{-- FEATURED IMAGE --}}
		            <div class="card card-default">
		            	<div class="card-header">
                            <h6 class="mb-0">Featured Image</h6>
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
                    {{-- GALLERY IMAGES --}}
		            <div class="card card-default">
		            	<div class="card-header">
                            <h6 class="mb-0">Gallery Images</h6>
				            <div class="card-tools">
				              <button type="button" class="btn btn-tool" data-card-widget="collapse">
				                <i class="fas fa-minus"></i>
				              </button>
				              
				            </div>
				        </div>
				        <!-- /.card-header -->
		                <div class="card-body">
                            <div class="form-group" style="display: block; overflow: hidden; height: 100%;">
                                
                                <!-- This container will hold all preview images -->
                                <div id="filediv" class="row"></div>

                                <!-- Hidden file input -->
                                <input name="gallery_image[]" class="form-control d-none" type="file" id="file" multiple />
                            </div>

                            <!-- Add more button -->
                            <input type="button" id="add_more" class="btn btn-primary mt-2" value="Add File" />
                            <small style="color: blue;">Image Size Should Be 800 x 800 or square size.</small>
                        </div>

		                <!-- /.card-body -->
		            </div>
		            <!-- /.card -->

		            <!-- general form elements -->
                    {{-- DESCRIPTIONS --}}
		            <div class="card card-default">
		            	<div class="card-header">
                            <h6 class="mb-0">Description</h6>
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
                    {{-- TAGS + SPECIFICATIONS --}}
		            <div class="card card-default">
		            	<div class="card-header">
                            <h6 class="mb-0">Tags & Specifications</h6>
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
                    {{-- META --}}
		            <div class="card card-default">
		            	<div class="card-header">
                            <h6 class="mb-0">Meta Information</h6>
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
	          	</div>
	          	<!--/.col (left) -->

		        <!-- right column -->
		        <div class="col-md-4 col-sm-6">
		            <!-- general form elements -->
                    {{-- PRICE INFO --}}
		            <div class="card card-default">
		            	<div class="card-header">
                            <h6 class="mb-0">Pricing</h6>
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
                    {{-- CATEGORY --}}
		            <div class="card card-default">
		            	<div class="card-header">
                            <h6 class="mb-0">Category</h6>
				            <div class="card-tools">
				              <button type="button" class="btn btn-tool" data-card-widget="collapse">
				                <i class="fas fa-minus"></i>
				              </button>
				              
				            </div>
				        </div>

			            <div class="card-body">
			              	<div class="form-group">
				                <label>Select Category *</label>
				                <select class="form-control select2tagf" name="category_id" id="category" style="width: 100%;" required>
				                    <option value="" selected="selected">Select One</option>
				                    @foreach ($categories as $category)
							            <option value="{{ $category->id }}" {{ $category->id === old('category_id') ? 'selected' : '' }}>{{ $category->name }}</option>
									@endforeach
				                </select>
			                </div>

			            	<div class="form-group">
				                <label>Select Sub Category</label>
				                <select class="form-control select2tagf" name="subcategory_id" id="subcategory" style="width: 100%;">
				                    <option value="" selected="selected">Select One</option>
				                    
				                </select>
			                </div>
			            </div>
		                <!-- /.card-body -->
		            </div>
		            <!-- /.card -->

		            <!-- general form elements -->
                    {{-- STOCK + TYPE --}}
		            <div class="card card-default">
		            	<div class="card-header">
                            <h6 class="mb-0">Inventory (Physical Only)</h6>
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
				                    @foreach ($types as $type)
							            <option value="{{ $type->id }}" {{ $type->id === old('type_id') ? 'selected' : '' }}>{{ $type->name }}</option>
									@endforeach
				                </select>
			                </div>
		                  	<div class="form-group">
		                    	<label for="exampleInputEmail1">SKU *</label>
		                    	<input type="text" name="sku" class="form-control" id="exampleInputEmail1" value="{{ Str::random(10) }}" placeholder="Enter SKU" required>
		                  	</div>
			                <div class="form-group">
			                    <label for="exampleInputPassword1">Video Link</label>
			                    <input type="text" class="form-control" name="video_link" id="exampleInputPassword1" placeholder="Enter Video Link">
			                </div>
		                </div>
		                <!-- /.card-body -->
		            </div>
		            <!-- /.card -->

                    {{-- VIDEO --}}
                    <div class="card card-default">
                        <div class="card-header">
                            <h6 class="mb-0">Video</h6>
                            <div class="card-tools">
				              <button type="button" class="btn btn-tool" data-card-widget="collapse">
				                <i class="fas fa-minus"></i>
				              </button>
				              
				            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Video Link</label>
                                <input type="text" name="video_link" class="form-control" placeholder="Enter Video Link">
                            </div>
                        </div>
                    </div>
                    
		            <!-- general form elements -->
		            <div class="card card-default">
		            	<!-- /.card-body -->
		                <div class="card-footer">
		                  	<button type="submit" class="btn btn-info">Save</button>
		                  	<a href="{{route('admin.product.item.index')}}" class="btn btn-default float-right">Cancel</a>
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
@section('admin_vendor_js')
@endsection
@section('admin_page_js')
    <script>
        $('#output').hide();
    </script>
    @include('admin.additionalObject.createDocumentScript')
    <!-- Page specific script -->
	<script>
    // Global AJAX setup with CSRF Token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /* Initialize Select2 Elements */
    $('.js-example-basic-single').select2({
        theme: "bootstrap4",
        tags: true,
		width: '100%',
    });

    $('.js-example-basic-single-meta').select2({
        theme: "bootstrap4",
        tags: true,
		width: '100%',
    });
    
    $(document).ready(function() {
        // Toggle product type fields
        $('#productType').on('change', function () {
            const type = $(this).val();
            if (type === 'affiliate') {
                $('.affiliate-only').removeClass('d-none');
                $('.physical-only').addClass('d-none');
            } else {
                $('.affiliate-only').addClass('d-none');
                $('.physical-only').removeClass('d-none');
            }
        }).trigger('change');

        /* -----------------------------
         * Dynamic Subcategory Loader
         * ----------------------------- */
        $('#category').on('change', function() {
            const cat_id = $(this).val();

            $.post("{{ route('admin.product.subcategories') }}", { parent_id: cat_id }, function(data) {
                const $subcategory = $('#subcategory');
                $subcategory.find('option:not(:first)').remove();

                $.each(data.subcategories, function(_, subcategory) {
                    $subcategory.append(`<option value="${subcategory.id}">${subcategory.name}</option>`);
                });
            });
        });


        /* -----------------------------
         * Toggle Specifications Section
         * ----------------------------- */
        $('#customSwitch1').on('change', function() {
            $('.specifications-section').toggle($(this).is(':checked'));
        });


        /* -----------------------------
         * Dynamic Specifications Fields
         * ----------------------------- */
        $('.add-specification').on('click', function() {
            const specName = $(this).data('text');
            const specDesc = $(this).data('text1');

            const newSpec = `
                <div class="d-flex align-items-start gap-2 mb-2 specification-item">
                    <div class="flex-grow-1">
                        <input type="text" class="form-control" name="specification_name[]" placeholder="${specName}">
                    </div>
                    <div class="flex-grow-1">
                        <input type="text" class="form-control" name="specification_description[]" placeholder="${specDesc}">
                    </div>
                    <button type="button" class="btn btn-danger remove-specification">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            `;

            $('.additional-specifications').append(newSpec);
        });

        // Remove specification field
        $('.additional-specifications').on('click', '.remove-specification', function() {
            $(this).closest('.specification-item').remove();
        });


        /* -----------------------------
         * Dynamic Gallery Image Upload
         * ----------------------------- */
        let imageCounter = 0;

        // When "Add More" is clicked, trigger the hidden file input
        $('#add_more').on('click', function() {
            $('#file').click();
        });

        // Handle file input change event
        $('#file').on('change', function() {
            const files = this.files;

            Array.from(files).forEach(file => {
                imageCounter++;
                const reader = new FileReader();

                const previewContainer = $(`
                    <div id="abcd${imageCounter}" class="col-md-3 col-sm-4 mb-3 text-center">
                        <div class="card shadow-sm">
                            <img id="previewimg${imageCounter}" 
                                class="card-img-top" 
                                style="width:100%; height:150px; object-fit:cover; border-radius:8px;" />
                            <button type="button" class="btn btn-sm btn-danger mt-2 delete-image">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                `);

                reader.onload = function(e) {
                    previewContainer.find('img').attr('src', e.target.result);
                };

                reader.readAsDataURL(file);
                $('#filediv').append(previewContainer);
            });

            // After adding first image, change button text to "Add More"
            if ($('#filediv').children().length > 0) {
                $('#add_more').val('Add More');
            }

            // Clear input value to allow re-selection of same files
            $(this).val('');
        });

        // Handle delete
        $(document).on('click', '.delete-image', function() {
            $(this).closest('.col-md-3').remove();

            // If all images are deleted, change button back to "Add File"
            if ($('#filediv').children().length === 0) {
                $('#add_more').val('Add File');
            }
        });

    });
</script>

@endsection