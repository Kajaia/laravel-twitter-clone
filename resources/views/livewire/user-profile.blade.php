<div class="card border-0 rounded-5 shadow-sm">
    <div class="card-body profile-card d-flex gap-3">
        @if($user->pic)
            <img class="rounded-3 cover" width="128" height="128" src="{{ '/storage/' . $user->pic }}" alt="{{ $user->name }}">
        @else
            <img class="rounded-3" width="128" height="128" src="{{ config('services.ui_avatar') . $user->name }}" alt="{{ $user->name }}">
        @endif
        <div class="w-100">
            <div class="d-flex gap-3 profile-name">
                <div>
                    <h1 class="fw-bold fs-4 mb-0">
                        {{ $user->name }}
                        @auth
                            @if($user->id === auth()->user()->id)
                            <a href="{{ route('profile', [$user->slug, 'tab' => 'edit']) }}" class="btn py-0 px-1" title="Edit user profile">
                                <i class="fas fa-pen fa-sm text-secondary"></i>
                            </a>
                            @endif
                        @endauth
                    </h1>
                    <small class="text-secondary">
                        {{ '@' . $user->slug }}
                    </small>
                    <div>
                        <small class="text-secondary">
                            <strong>{{ $this->user->tweets->count() }}</strong>
                            @if($this->user->tweets->count() > 1)
                                Tweets
                            @else
                                Tweet
                            @endif
                        </small>
                        <p class="mt-2 mb-0">
                            {{ $user->bio }}
                        </p>
                    </div>
                </div>
                <div class="profile-follow">
                    @auth
                        @if($user->id !== auth()->user()->id)
                        <button wire:click="profileUserFollow" class="mb-2 btn btn-sm @if(!in_array(auth()->user()->id, $this->user->followers->pluck('follower_id')->toArray())) btn-primary @else btn-secondary @endif px-3">
                            <i class="fas fa-sm me-1 @if(!in_array(auth()->user()->id, $this->user->followers->pluck('follower_id')->toArray())) fa-user-plus @else fa-user-minus @endif"></i>
                            @if(!in_array(auth()->user()->id, $this->user->followers->pluck('follower_id')->toArray()))
                                Follow
                            @else
                                Unfollow
                            @endif
                        </button>
                        @endif
                    @endauth
                    <div class="d-flex align-items-start justify-content-between gap-3">
                        <a class="text-decoration-none text-secondary mb-0" href="{{ route('profile', [$user->slug, 'tab' => 'following']) }}">
                            <strong>{{ $this->user->following->count() }}</strong> Following
                        </a>
                        <a class="text-decoration-none text-secondary mb-0" href="{{ route('profile', [$user->slug, 'tab' => 'followers']) }}">
                            <strong>{{ $this->user->followers->count() }}</strong> 
                            @if($this->user->followers->count() > 1)
                                Followers
                            @else
                                Follower
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>