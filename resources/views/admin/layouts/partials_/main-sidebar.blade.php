<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(Auth::guard('admin')->user()->image != 'noimage.jpg')
                    <img src="{{Storage::disk('local')->url(Auth::guard('admin')->user()->image)}}" class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{asset('admin/dist/img/avatar4.png')}}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="{{route('admin.profile')}}" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <x-text-input class="form-control form-control-navbar" type="search" name="search" placeholder="Search" aria-label="Search" required autofocus autocomplete="search" />
                <div class="input-group-append">
                    <x-ad-nevigation-button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </x-ad-nevigation-button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('admin.layouts.partials_.sidebar-nav.dashboard')
                @include('admin.layouts.partials_.sidebar-nav.categories.manage')
                @include('admin.layouts.partials_.sidebar-nav.product-type.manage')
                @include('admin.layouts.partials_.sidebar-nav.product.manage')
                @include('admin.layouts.partials_.sidebar-nav.orders.manage')
                @include('admin.layouts.partials_.sidebar-nav.digital-product.manage')
                @include('admin.layouts.partials_.sidebar-nav.mlm-user.manage')
                @include('admin.layouts.partials_.sidebar-nav.transactions')
                @include('admin.layouts.partials_.sidebar-nav.ecommerce.manage')
                @include('admin.layouts.partials_.sidebar-nav.tickets.manage')
                @include('admin.layouts.partials_.sidebar-nav.site.manage')
                @include('admin.layouts.partials_.sidebar-nav.faqs.manage')
                @include('admin.layouts.partials_.sidebar-nav.pages')
                @include('admin.layouts.partials_.sidebar-nav.social-icon')
                @include('admin.layouts.partials_.sidebar-nav.customers-list')
                @include('admin.layouts.partials_.sidebar-nav.subscribers-list')
                @include('admin.layouts.partials_.sidebar-nav.email-lists')
                @include('admin.layouts.partials_.sidebar-nav.system-user.manage')
                @include('admin.layouts.partials_.sidebar-nav.cache-clear')
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>