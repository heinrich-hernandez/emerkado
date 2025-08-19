<!-- get current url/page/route name-->
@php
$current_route=request()->route()->getName(); 
@endphp

<!-- Left Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/coop/dashboard" class="brand-link">
            <img src="{{ asset('images/eMerkado.icon.png') }}" width="128" height="114" alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">e-Merkado</span>
        </a>
        
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Auth::user()->profile_picture ? URL::to('/storage') . '/' . Auth::user()->profile_picture : asset('images/guest.jpg') }}" alt="Profile" class="img-circle elevation-2" onerror="this.onerror=null;this.src='{{ asset('images/guest.jpg') }}">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->authorized_representative }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if(Auth::user()->review_status == 'Approved')
                <li class="nav-item">
                    <a href="{{ route('coop-dashboard') }}" class="nav-link {{ $current_route=='coop-dashboard'?'active':'' }}"> {{-- route('coop-dashboard') is the name route in web.php --}}
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Dashboard') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link {{ $current_route=='coop-products'?'active':'' }}"> {{-- route('coop-dashboard') is the name route in web.php --}}
                        <i class="nav-icon fas fa-basket-shopping"></i>
                        <p>
                            {{ __('Products Page') }}
                        </p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

</aside>