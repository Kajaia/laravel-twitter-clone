<div>
    <!-- Tweet component -->
    <div class="card rounded-5 border-0 @auth my-3 @else mt-2 mb-3 @endauth shadow-sm">
        <div class="card-body">
            <!-- User -->
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <img class="rounded-3" width="36" height="36" src="{{ config('services.ui_avatar') . $tweet->user->name }}" alt="{{ $tweet->user->name }}">
                    <div>
                        <h6 class="mb-0">{{ $tweet->user->name }}</h6>
                        <small class="text-secondary">{{ \Carbon\Carbon::parse($tweet->created_at)->diffForHumans() }}</small>
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
            <!-- /Like -->
            <hr class="bg-secondary">
            @auth
            <!-- Reply -->
            <form wire:submit.prevent="storeReply" class="d-flex gap-3">
                <img class="rounded-3" width="36" height="36" src="{{ config('services.ui_avatar') . auth()->user()->name }}" alt="{{ auth()->user()->name }}">
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
            <!-- /Reply -->
            @endauth
            @foreach($replies as $reply)
            <!-- Replies list -->
            <div class="d-flex gap-3 @if(!$loop->last) my-3 @else mt-3 mb-0 @endif">
                <img class="rounded-3" width="36" height="36" src="{{ config('services.ui_avatar') . $reply->user->name }}" alt="{{ $reply->user->name }}">
                <div class="bg-light rounded-3 py-2 px-3 w-100">
                    <div class="d-flex align-items-center gap-3">
                        <h6 class="fw-bold mt-1">{{ $reply->user->name }}</h6>
                        <small class="text-secondary">{{ \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}</small>
                    </div>
                    <p class="mb-0">{!! $reply->content !!}</p>
                </div>
            </div>
            <!-- /Replies list -->
            @endforeach
            @if($repliesCount > 3)
            <p class="mt-2 mb-0 text-center">
                <a href="#!" class="text-decoration-none">
                    More replies
                </a>
            </p>
            @endif
        </div>
    </div>
    <!-- /Tweet component -->
</div>
