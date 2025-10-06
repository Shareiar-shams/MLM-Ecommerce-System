<!-- File: resources/views/admin/layouts/partials_/sidebar-nav/categories/manage.blade.php -->
@php
    $isActive = Route::is('admin.product.categories') || Route::is('admin.product.category.create');
@endphp
<div class="nav-item {{ $isActive ? 'menu-open' : '' }}">
    <x-ad-nav-link class="nav-link {{ $isActive ? 'active' : '' }}">
        <i class="nav-icon fas fa-list-alt"></i>
        <p class="pl-2">
            Manage Categories
            <i class="fas fa-angle-left right"></i>
        </p>
    </x-ad-nav-link>
    <ul class="nav nav-treeview" style="display: {{ $isActive ? 'block' : 'none' }}">
        <li class="nav-item">
            <x-ad-nav-link href="{{ route('admin.product.categories') }}" class="nav-link {{ Route::is('admin.product.categories') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Categories List</p>
            </x-ad-nav-link>
        </li>
        <li class="nav-item">
            <x-ad-nav-link href="{{ route('admin.categories.create') }}" class="nav-link {{ Route::is('admin.product.category.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Create Category</p>
            </x-ad-nav-link>
        </li>
    </ul>
</div>