
<li class="nav-item">
    <a class="nav-link" href="{{ route('merchant-dashboard') }}#account-timeline" > 
        <i class="nav-icon ion ion-person-add"></i>                       
        <p>
            {{ __('Timeline') }}
        </p>
        @if ($monthlyUserCount > 0)
        <ion-icon name="notification-outline" size="large"></ion-icon>
            <span class="badge badge-danger right">
                <ion-icon name="person-add-outline"></ion-icon> {{ $monthlyUserCount }}
            </span>
        @endif
    </a>
</li>