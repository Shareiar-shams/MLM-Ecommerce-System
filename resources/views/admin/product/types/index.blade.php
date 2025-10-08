@extends('layouts.administration.app')
@section('admin_title_content')
    AHVision | Product Types
@endsection
@section('admin_content_header')
    <div class="col-sm-6">
        <h1 class="m-0">{{___('Product Types')}}</h1>
    </div><!-- /.col -->
    <!-- breadcrumb -->
    <x-ad-breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.home')],
        ['label' => 'Types', 'url' => route('admin.product.type.index')]
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
                        <h3 class="card-title">{{ ___("Types") }}</h3>
                        <a href="{{ route('admin.product.type.create') }}" class="btn btn-primary btn-sm float-right">{{ ___('Add New Type') }}</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($types as $type)
                                    <tr>
                                        <td>{{ $type->name }}</td>
                                        <td>{{ $type->slug }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn {{$type->status == true ? 'btn-success' : 'btn-danger'}} dropdown-toggle" data-toggle="dropdown">@if($type->status == true) Publish @else Unpublish @endif 
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    <form action="{{route('admin.product.categories.status',$type->id)}}" method="post" id="disable-form-type-status-{{$type->id}}" style="display: none;">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="status" value="@if($type->status == true) 0 @else 1 @endif">
                                                    </form>
                                                    <a class="dropdown-item" href="#"
                                                        onclick="confirmStatusChange('disable-form-type-status-{{ $type->id }}', '{{ $type->status ? 'unpublish' : 'publish' }} this type')">
                                                        {{ $type->status ? 'Unpublish' : 'Publish' }}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Options
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    <a class="dropdown-item" href="{{route('admin.categories.edit',$type->id)}}"><i class="fas fa-edit"></i> Edit</a>

                                                    <a class="dropdown-item text-danger" href="#"
                                                    onclick="event.preventDefault(); confirmDelete('delete-form-product-type-{{ $type->id }}')">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </a>

                                                    <form id="delete-form-product-type-{{ $type->id }}" 
                                                        action="{{ route('admin.categories.destroy', $type->id) }}" 
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
                                        <td colspan="5" class="text-center">No types found.</td>
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
