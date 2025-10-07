@extends('layouts.administration.app')
@section('admin_title_content')
    AHVision | Product Categories
@endsection
@section('admin_content_header')
    <div class="col-sm-6">
        <h1 class="m-0">{{___('Product Categories')}}</h1>
    </div><!-- /.col -->
    <!-- breadcrumb -->
    <x-ad-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.home')],
        ['label' => 'Categories', 'url' => route('admin.product.categories')]
    ]" />
@endsection

@section('admin_vendor_css')
    @include('admin.additionalObject.datatable-css')
@endsection

@section('admin_page_css')
@endsection


@section('admin_main_content')

    <div class="container-fluid">
        <div class="row">
        	<div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ ___("Categories") }}</h3>
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm float-right">{{ ___('Add New Category') }}</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Parent Id</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->parent->name ?? 'No Parent' }}</td>
                                        <td>
                                            @if($category->image)
                                                <img src="{{ $category->image_url }}" alt="{{ $category->name }}" width="50" height="50" style="object-fit: cover; border-radius: 8px;">
                                            @else
                                                {{ ('No Image') }}
                                            @endif
                                        </td>
                                        <td>{!! Str::limit(htmlspecialchars_decode($category->description), 150) !!}</td>
                                        <td>
			                    		<div class="btn-group">
						                    <button type="button" class="btn {{$category->status == true ? 'btn-success' : 'btn-danger'}} dropdown-toggle" data-toggle="dropdown">@if($category->status == true) Publish @else Unpublish @endif 
						                    	<span class="sr-only">Toggle Dropdown</span>
						                    </button>
						                    <div class="dropdown-menu" role="menu">
						                    	<form action="{{route('admin.product.categories.status',$category->id)}}" method="post" id="disable-form-category-status-{{$category->id}}" style="display: none;">
			                              			@csrf
			                              			@method('put')
			                              			<input type="hidden" name="status" value="@if($category->status == true) 0 @else 1 @endif">
			                            		</form>
						                      	<a class="dropdown-item" href="#"
                                                    onclick="confirmStatusChange('disable-form-category-status-{{ $category->id }}', '{{ $category->status ? 'unpublish' : 'publish' }} this category')">
                                                    {{ $category->status ? 'Unpublish' : 'Publish' }}
                                                </a>
						                    </div>
						                </div>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Options
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    <a class="dropdown-item" href="{{route('admin.categories.edit',$category->id)}}"><i class="fas fa-edit"></i> Edit</a>

                                                    <a class="dropdown-item text-danger" href="#"
                                                    onclick="event.preventDefault(); confirmDelete('delete-form-product-category-{{ $category->id }}')">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </a>

                                                    <form id="delete-form-product-category-{{ $category->id }}" 
                                                        action="{{ route('admin.categories.destroy', $category->id) }}" 
                                                        method="POST" style="display:none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No categories found.</td>
                                    </tr>
                                @endforelse
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
    </div><!-- /.container-fluid -->
    
@endsection

@section('admin_page_js')
    @include('admin.additionalObject.datatable-js')
@endsection
