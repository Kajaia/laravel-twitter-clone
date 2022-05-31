<div class="card rounded-5 border-0 @auth my-3 @else mt-2 mb-3 @endauth shadow-sm">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('profile', $tweet->user->slug) }}">
                    @if($tweet->user->pic)
                        <img class="rounded-3 cover" width="36" height="36" src="{{ '/storage/' . $tweet->user->pic }}" alt="{{ $tweet->user->name }}">
                    @else
                        <img class="rounded-3" width="36" height="36" src="{{ config('services.ui_avatar') . $tweet->user->name }}" alt="{{ $tweet->user->name }}">
                    @endif
                </a>
                <div>
                    <a href="{{ route('profile', $tweet->user->slug) }}" class="text-decoration-none text-dark">
                        <h6 class="mb-0 fw-bold">
                            {{ $tweet->user->name }}
                        </h6>
                    </a>
                    <small class="text-secondary">
                        {{ \Carbon\Carbon::parse($tweet->created_at)->diffForHumans() }} 
                        @if($tweet->category_id)
                        in {{ $tweet->category->title }}
                        @endif
                    </small>
                </div>
            </div>
            <div class="dropdown">
                <button class="btn text-secondary py-1 px-2 dropdown-toggle tweet-dropdown" type="button" id="{{ 'tweetDropdown' . $tweet->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                    <ul class="dropdown-menu dropdown-menu-end rounded-5 mt-2 border-0 shadow" aria-labelledby="{{ 'tweetDropdown' . $tweet->id }}">
                        <li><a class="dropdown-item" href="{{ route('specific.tweet', $tweet->id) }}">View</a></li>
                        @auth
                            @if($tweet->user->id === auth()->user()->id)
                            <li><a class="dropdown-item cursor-pointer" wire:click="deleteTweet">Delete</a></li>
                            @endif
                        @endauth
                    </ul>
                </div>
        </div>
        <p class="mt-3 mb-0 text-secondary fst-italic">
            @if($tweet->tweet_id)
                Replied on 
                <a href="{{ route('profile', $tweet->reply->user->slug) }}" class="text-decoration-none">{{ '@' . $tweet->reply->user->name }}</a>'s 
                <a href="{{ route('specific.tweet', $tweet->reply->id) }}" class="text-decoration-none">tweet</a>
            @endif
            <p class="m-0">{!! $tweet->content !!}</p>
        </p>
        <div class="mt-3 d-flex align-items-center justify-content-between">
            @auth
                <div>
                    <button type="submit" wire:click="likeTweet" class="btn btn-link text-decoration-none p-0 m-0 @if(in_array(auth()->user()->id, $this->tweet->likes->pluck('user_id')->toArray())) text-danger @else text-dark @endif">
                        <i class="fa-heart fa-sm @if(in_array(auth()->user()->id, $this->tweet->likes->pluck('user_id')->toArray())) fas text-danger @else far text-dark @endif"></i>
                        <small>
                            @if(in_array(auth()->user()->id, $this->tweet->likes->pluck('user_id')->toArray()))
                                Liked
                            @else
                                Like
                            @endif
                        </small>
                    </button>
                    @if($tweet->user->id !== auth()->user()->id)
                    <button type="submit" wire:click="addToFavourites" class="btn btn-link ms-1 text-decoration-none p-0 m-0 @if(in_array(auth()->user()->id, $this->tweet->favourites->pluck('user_id')->toArray())) text-success @else text-dark @endif">
                        <i class="fa-bookmark fa-sm @if(in_array(auth()->user()->id, $this->tweet->favourites->pluck('user_id')->toArray())) fas text-success @else far text-dark @endif"></i>
                        <small>
                            @if(in_array(auth()->user()->id, $this->tweet->favourites->pluck('user_id')->toArray()))
                                Saved
                            @else
                                Save
                            @endif
                        </small>
                    </button>
                    @endif
                </div>
            @endauth
            <small class="text-secondary d-flex align-items-center gap-3">
                <span>
                    {{ $this->tweet->likes->count() }}
                    {{ $this->tweet->likes->count() > 1 ? 'Likes' : 'Like' }}
                </span>
                <span>
                    {{ $this->tweet->replies->count() }}
                    {{ $this->tweet->replies->count() > 1 ? 'Replies' : 'Reply' }}
                </span>
            </small>
        </div>
        <hr class="bg-secondary">
        @auth
        <form wire:submit.prevent="storeReply" class="d-flex gap-3">
            <a href="{{ route('profile', auth()->user()->slug) }}">
                @if(auth()->user()->pic)
                    <img class="rounded-3 cover" width="36" height="36" src="{{ '/storage/' . auth()->user()->pic }}" alt="{{ auth()->user()->name }}">
                @else
                    <img class="rounded-3" width="36" height="36" src="{{ config('services.ui_avatar') . auth()->user()->name }}" alt="{{ auth()->user()->name }}">
                @endif
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
        @foreach($this->replies as $reply)
        <div class="d-flex gap-3 @if(!$loop->last) my-3 @else mt-3 mb-0 @endif">
            <a href="{{ route('profile', $reply->user->slug) }}">
                @if($reply->user->pic)
                    <img class="rounded-3 cover" width="36" height="36" src="{{ '/storage/' . $reply->user->pic }}" alt="{{ $reply->user->name }}">
                @else
                    <img class="rounded-3" width="36" height="36" src="{{ config('services.ui_avatar') . $reply->user->name }}" alt="{{ $reply->user->name }}">
                @endif
            </a>
            <div class="bg-light rounded-3 pt-1 pb-2 px-3 w-100">
                <div class="d-flex align-items-center justify-content-between gap-3 py-1">
                    <a href="{{ route('profile', $reply->user->slug) }}" class="text-decoration-none text-dark">
                        <h6 class="fw-bold m-0">
                            {{ $reply->user->name }}
                        </h6>
                    </a>
                    <div class="d-flex align-items-center gap-2">
                        <small class="text-secondary m-0">{{ \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}</small>
                        @auth
                            @if($reply->user->id === auth()->user()->id)
                            <div class="dropdown">
                                <button class="btn text-secondary p-0 dropdown-toggle tweet-dropdown" type="button" id="{{ 'repyDropdown' . $reply->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end rounded-5 mt-2 border-0 shadow" aria-labelledby="{{ 'repyDropdown' . $reply->id }}">
                                    <li><a class="dropdown-item cursor-pointer" wire:click="deleteReply({{ $reply->id }})">Delete</a></li>
                                </ul>
                            </div>
                            @endif
                        @endauth
                    </div>
                </div>
                <p class="mb-0">{!! $reply->content !!}</p>
            </div>
        </div>
        @endforeach
        @if($this->tweet->replies->count() > $perPageReplies)
        <div class="mt-2 mb-0 text-center">
            <a class="btn btn-link text-decoration-none cursor-pointer" wire:click="perPageRepliesIncrease">
                More replies
            </a>
        </div>
        @endif
    </div>
</div>