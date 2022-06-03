<li class="nav-item dropdown" onclick="event.stopImmediatePropagation();">
    <a class="nav-link dropdown-toggle cursor-pointer text-secondary tweet-dropdown" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-bell"></i>
        @if(auth()->user()->unreadNotifications->count())
            <sup class="bg-danger text-white rounded-pill px-1">{{ auth()->user()->unreadNotifications->count() }}</sup>
        @endif
    </a>
    <ul class="dropdown-menu dropdown-menu-end notifications-dropdown rounded-5 shadow border-0 mt-3" aria-labelledby="notificationDropdown">
        <div class="{{ auth()->user()->unreadNotifications->count() >= 1 ? 'text-end' : 'text-center' }}">
            @if(auth()->user()->unreadNotifications->count())
            <button wire:click="markAllAsRead" class="btn p-0 me-3">
                <small>Mark all as read</small>
            </button>
            @elseif(!auth()->user()->notifications->count())
                <p class="my-2">
                    You don't have notifications!
                </p>
            @endif
        </div>
        @foreach(auth()->user()->notifications as $notification)
            <li>
                <span class="dropdown-item d-flex align-items-center justify-content-between gap-3">
                    <a class="dropdown-item" href="{{ $notification->data['tweet_id'] ? route('specific.tweet', $notification->data['tweet_id']) : '#!' }}">
                        <div>
                            <small class="{{ $notification->read_at ? 'text-secondary' : 'fw-bold' }}">{{ $notification->data['content'] }}</small>
                            <div class="m-0 d-flex align-items-center justify-content-between">
                                <small class="{{ $notification->read_at ? 'text-secondary' : 'fw-bold' }}">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>
                            </div>
                        </div>
                    </a>
                    @if(!$notification->read_at)
                    <button wire:click="markAsRead('{{ $notification->id }}')" class="btn btn-sm btn-light rounded-pill">
                        <i class="fas fa-check fa-sm"></i>
                    </button>
                    @endif
                </span>
            </li>
        @endforeach
    </ul>
</li>