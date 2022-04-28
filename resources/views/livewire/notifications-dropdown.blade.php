<li class="nav-item dropdown" onclick="event.stopImmediatePropagation();">
    <a class="nav-link dropdown-toggle cursor-pointer text-secondary tweet-dropdown" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-bell"></i>
        @if(auth()->user()->unreadNotifications->count())
            <sup class="bg-danger text-white rounded-pill px-1">{{ auth()->user()->unreadNotifications->count() }}</sup>
        @endif
    </a>
    <ul class="dropdown-menu dropdown-menu-end notifications-dropdown rounded-5 shadow border-0 mt-3" aria-labelledby="notificationDropdown">
        <div class="{{ auth()->user()->unreadNotifications->count() > 1 ? 'text-end' : 'text-center' }}">
            @if(auth()->user()->unreadNotifications->count())
            <a wire:click="markAllAsRead" class="text-decoration-none cursor-pointer me-3 mb-3">
                <small>Mark all as read</small>
            </a>
            @else
                <p class="my-2">
                    You don't have notifications!
                </p>
            @endif
        </div>
        @foreach(auth()->user()->unreadNotifications as $notification)
            <li>
                <a class="dropdown-item cursor-pointer">
                    <small>{{ $notification->data['content'] }}</small>
                    <div class="m-0 d-flex align-items-center justify-content-between">
                        <small class="text-secondary">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
</li>