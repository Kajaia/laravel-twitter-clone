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
                    </h1>
                    <small class="text-secondary">
                        {{ '@' . $user->slug }}
                    </small>
                    <div>
                        <small class="text-secondary">
                            <strong>{{ $tweetsCount }}</strong>
                            @if($tweetsCount > 1)
                                Tweets
                            @else
                                Tweet
                            @endif
                        </small>
                    </div>
                </div>
                <div class="profile-follow">
                    @auth
                        @if($user->id !== auth()->user()->id)
                        <button wire:click="profileUserFollow" class="mb-2 btn btn-sm @if(!in_array(auth()->user()->id, $followers->pluck('follower_id')->toArray())) btn-primary @else btn-secondary @endif px-3">
                            <i class="fas fa-sm me-1 @if(!in_array(auth()->user()->id, $followers->pluck('follower_id')->toArray())) fa-user-plus @else fa-user-minus @endif"></i>
                            @if(!in_array(auth()->user()->id, $followers->pluck('follower_id')->toArray()))
                                Follow
                            @else
                                Unfollow
                            @endif
                        </button>
                        @endif
                    @endauth
                    <div class="d-flex align-items-start justify-content-between gap-3">
                        <p class="text-secondary mb-0">
                            <strong>{{ $following->count() }}</strong> Following
                        </p>
                        <p class="text-secondary mb-0">
                            <strong>{{ $followers->count() }}</strong> Followers
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>