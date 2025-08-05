<li class="nav-item notification-badge " style="position: relative;"><a class="nav-link" href="#notification" data-toggle="tab">Notification</a>
    <ion-icon name="notification-outline" size="large"></ion-icon>
    @if($count > 0)
        <span class="badge badge-danger" style="position: absolute; top: -10px; right: -10px;">
            {{ 100 <= $count ? '99+' : $count }}
        </span>
    @endif
</li>

<script>
    window.addEventListener('start-notification-timer', function () {
        setInterval(() => {
            Livewire.dispatch('incrementCount');
        }, 5000); // Increment every 5 seconds
    });
</script>
