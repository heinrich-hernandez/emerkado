<!-- get current url/page/route name-->
@php
$current_route=request()->route()->getName(); 
@endphp

<!-- Left Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/admin/dashboard" class="brand-link">
            <img src="{{ asset('images/eMerkado.icon.png') }}" width="128" height="114"') }}" alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">e-Merkado</span>
        </a>
        
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin-dashboard') }}" class="nav-link {{ $current_route=='admin-dashboard'?'active':'' }}"> {{-- route('admin-dashboard') is the name route in web.php --}}
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Dashboard') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item {{ in_array($current_route, ['admin.pages.coop', 'admin.pages.buyer', 'admin.pages.merchant', 'admin.pages.create_merchant', 'admin.pages.create_coop', 'admin.pages.review_coop', 'admin.pages.create_buyer', 'admin.pages.review_buyer' ]) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ in_array($current_route, ['admin.pages.coop', 'admin.pages.buyer', 'admin.pages.merchant', 'admin.pages.create_merchant', 'admin.pages.create_coop', 'admin.pages.review_coop', 'admin.pages.create_buyer', 'admin.pages.review_buyer']) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users nav-icon"></i>
                        <p>
                            {{ __('Users Management') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.pages.coop') }}" class="nav-link {{ $current_route=='admin.pages.coop' || $current_route == 'admin.pages.create_coop' || $current_route == 'admin.pages.review_coop' ? 'active':'' }}">
                                <i class="nav-icon fas fa-store"></i>
                                <p>Coop</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.pages.merchant') }}" class="nav-link {{ $current_route == 'admin.pages.merchant' || $current_route == 'admin.pages.create_merchant' ? 'active':'' }}">
                                <i class="nav-icon fas fa-comments-dollar"></i>
                                <p>Merchant</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.pages.buyer') }}" class="nav-link {{ $current_route=='admin.pages.buyer' || $current_route == 'admin.pages.create_buyer' || $current_route == 'admin.pages.review_buyer' ? 'active':'' }}">
                                <i class="nav-icon fas fa-cart-shopping"></i> 
                                <p>Buyer</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

</aside>