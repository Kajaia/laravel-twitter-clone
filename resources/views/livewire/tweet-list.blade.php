<div class="card rounded-5 border-0 @auth my-3 @else mt-2 mb-3 @endauth shadow-sm">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('profile', $tweet->user->slug) }}">
                    <img class="rounded-3" width="36" height="36" src="{{ config('services.ui_avatar') . $tweet->user->name }}" alt="{{ $tweet->user->name }}">
                </a>
                <div>
                    <a href="{{ route('profile', $tweet->user->slug) }}" class="text-decoration-none text-dark">
                        <h6 class="mb-0 fw-bold">
                            {{ $tweet->user->name }}
                        </h6>
                    </a>
                    <small class="text-secondary">{{ \Carbon\Carbon::parse($tweet->created_at)->diffForHumans() }}</small>
                </div>
            </div>
        </div>
        <p class="mt-3 mb-0">{!! $tweet->content !!}</p>
        <div class="mt-3 d-flex align-items-center justify-content-between">
            @auth
            <form wire:submit.prevent="likeTweet" class="cursor-pointer">
                <button type="submit" class="btn btn-link text-decoration-none p-0 m-0 @if(in_array(auth()->user()->id, $likes->pluck('user_id')->toArray())) text-danger @else text-dark @endif">
                    <i class="fa-heart fa-sm @if(in_array(auth()->user()->id, $likes->pluck('user_id')->toArray())) fas text-danger @else far text-dark @endif"></i>
                    <small>
                        @if(in_array(auth()->user()->id, $likes->pluck('user_id')->toArray()))
                            Liked
                        @else
                            Like
                        @endif
                    </small>
                </button>
            </form>
            @endauth
            <small class="text-secondary d-flex align-items-center gap-3">
                <span>
                    {{ $likes->count() }}
                    {{ $likes->count() > 1 ? 'Likes' : 'Like' }}
                </span>
                <span>
                    {{ $repliesCount }}
                    {{ $repliesCount > 1 ? 'Replies' : 'Reply' }}
                </span>
            </small>
        </div>
        <hr class="bg-secondary">
        @auth
        <form wire:submit.prevent="storeReply" class="d-flex gap-3">
            <a href="{{ route('profile', $tweet->user->slug) }}">
                <img class="rounded-3" width="36" height="36" src="{{ config('services.ui_avatar') . auth()->user()->name }}" alt="{{ auth()->user()->name }}">
            </a>
            <div class="w-100">
                <input type="text" class="form-control bg-light @error('content') is-invalid @enderror" wire:model.debounce.500ms="content" cols="30" rows="1" placeholder="Tweet your reply">
                
                @error('content')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </form>
        <hr class="bg-secondary">
        @endauth
        @foreach($replies as $reply)
        <div class="d-flex gap-3 @if(!$loop->last) my-3 @else mt-3 mb-0 @endif">
            <a href="{{ route('profile', $reply->user->slug) }}">
                <img class="rounded-3" width="36" height="36" src="{{ config('services.ui_avatar') . $reply->user->name }}" alt="{{ $reply->user->name }}">
            </a>
            <div class="bg-light rounded-3 py-2 px-3 w-100">
                <div class="d-flex align-items-center justify-content-between gap-3 py-1">
                    <a href="{{ route('profile', $reply->user->slug) }}" class="text-decoration-none text-dark">
                        <h6 class="fw-bold m-0">
                            {{ $reply->user->name }}
                        </h6>
                    </a>
                    <small class="text-secondary m-0">{{ \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}</small>
                </div>
                <p class="mb-0">{!! $reply->content !!}</p>
            </div>
        </div>
        @endforeach
        @if($repliesCount > 3)
        <div class="mt-2 mb-0 text-center">
            <a class="text-decoration-none cursor-pointer" wire:click="perPageRepliesIncrease">
                More replies
            </a>
        </div>
        @endif
    </div>
</div>