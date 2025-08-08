<li class="nav-item">
    <a href="{{ route('merchant.pages.coop') }}"
        class="nav-link {{ request()->routeIs('merchant.pages.coop', 'pages-create_coop', 'pages-review_coop') ? 'active' : '' }}">
        
        <i class="nav-icon fas fa-store"></i>
        <p>
            Coop
            @if ($unapprovedCoopCount > 0)
            <span class="badge badge-info right">
                <ion-icon name="storefront-outline"></ion-icon> {{ $unapprovedCoopCount }}
            </span>
            @endif
        </p>
    </a>
</li>