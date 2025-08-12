<li class="nav-item">
    <a href="{{ route('merchant.pages.buyer') }}"
        class="nav-link {{ request()->routeIs('merchant.pages.buyer', 'pages-create_buyer', 'pages-review_buyer') ? 'active' : '' }}">
        
        <i class="nav-icon fas fa-cart-shopping"></i>
        <p>
            Buyer
            @if ($unapprovedBuyerCount > 0)
                <span class="badge badge-danger right">
                    <ion-icon name="storefront-outline"></ion-icon> {{ $unapprovedBuyerCount }}
                </span>
            @endif
        </p>
    </a>
</li>