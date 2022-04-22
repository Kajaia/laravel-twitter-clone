<!-- Tweet component -->
<div class="card rounded-5 border-0 @auth my-3 @else mt-2 mb-3 @endauth shadow-sm">
    <div class="card-body">
        <!-- User -->
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <img class="rounded-3" width="36" height="36" src="{{ config('services.ui_avatar') . $tweet->user->name }}" alt="{{ $tweet->user->name }}">
                <div>
                    <h6 class="mb-0">{{ $tweet->user->name }}</h6>
                    <small class="text-secondary">{{ \Carbon\Carbon::parse($tweet->created_at)->format('d M Y, H:i') }}</small>
                </div>
            </div>
        </div>
        <!-- /User -->
        <!-- Content -->
        <p class="mt-3 mb-0">{!! $tweet->content !!}</p>
        <!-- /Content -->
        <!-- Like -->
        <div class="mt-3 d-flex align-items-center justify-content-between">
            @auth
            <div class="cursor-pointer">
                <i class="far fa-heart fa-sm"></i>
                <small>Like</small>
            </div>
            @endauth
            <small class="text-secondary d-flex align-items-center gap-3">
                <span>
                    {{ $tweet->likes->count() }}
                    {{ $tweet->likes->count() > 1 ? 'Likes' : 'Like' }}
                </span>
                <span>
                    {{ $tweet->replies->count() }}
                    {{ $tweet->replies->count() > 1 ? 'Replies' : 'Reply' }}
                </span>
            </small>
        </div>
        <!-- /Like -->
        <hr class="bg-secondary">
        @auth
        <!-- Reply -->
        <form action="{{ route('reply.tweet') }}" method="post" class="d-flex gap-3">
            @csrf
            <img class="rounded-3" width="36" height="36" src="{{ config('services.ui_avatar') . auth()->user()->name }}" alt="{{ auth()->user()->name }}">
            <div class="w-100">
                <input type="text" class="form-control bg-light" name="content" cols="30" rows="1" placeholder="Tweet your reply" required>
                <input type="hidden" name="tweet_id" value="{{ $tweet->id }}">
            </div>
        </form>
        <hr class="bg-secondary">
        <!-- /Reply -->
        @endauth
        @foreach($tweet->replies as $reply)
        <!-- Replies list -->
        <div class="d-flex gap-3 @if(!$loop->last) my-3 @else mt-3 mb-0 @endif">
            <img class="rounded-3" width="36" height="36" src="{{ config('services.ui_avatar') . $reply->user->name }}" alt="{{ $reply->user->name }}">
            <div class="bg-light rounded-3 py-2 px-3 w-100">
                <div class="d-flex align-items-center gap-3">
                    <h6 class="fw-bold mt-1">{{ $reply->user->name }}</h6>
                    <small class="text-secondary">{{ \Carbon\Carbon::parse($reply->created_at)->format('d M Y, H:i') }}</small>
                </div>
                <p class="mb-0">{!! $reply->content !!}</p>
            </div>
        </div>
        @if($loop->first)
            @if($tweet->replies->count() > 1)
            <p class="mb-0 text-center">
                <a href="#!" class="text-decoration-none">
                    More replies
                </a>
            </p>
            @endif
            @break
        @endif
        <!-- /Replies list -->
        @endforeach
    </div>
</div>
<!-- /Tweet component -->