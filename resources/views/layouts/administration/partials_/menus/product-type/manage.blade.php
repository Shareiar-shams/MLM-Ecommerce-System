<!-- File: resources/views/admin/layouts/partials_/sidebar-nav/categories/manage.blade.php -->
@php
    $isActive = Route::is('admin.product.type.index') || Route::is('admin.product.type.create');
@endphp

<li class="nav-item {{ $isActive ? 'menu-open' : '' }}">
    <x-ad-nav-link class="nav-link">
        <i  class='fas fa-list-alt'></i>
        <p class="pl-2">
            Manage Product Tag
            <i class="fas fa-angle-left right"></i>
        </p>
    </x-ad-nav-link>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.product.type.index') }}" class="nav-link {{ Route::is('admin.product.type.index') ? 'active' : '' }}">
            
                <i class="far fa-circle nav-icon"></i>
                <p>Product Tag List</p>
            </a>

            <a href="{{ route('admin.product.type.create') }}" class="nav-link {{ Route::is('admin.product.type.create') ? 'active' : '' }}">
            
                <i class="far fa-circle nav-icon"></i>
                <p>Create Product Tag</p>
            </a>
        </li>
    </ul>
</li>