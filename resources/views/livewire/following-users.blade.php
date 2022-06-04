@if($this->users->count())
<div class="card border-0 shadow-sm rounded-5 mt-3">
    <div class="card-header bg-white border-light rounded-top-5">{{ $model === 'following' ? 'Followers' : 'Following' }}</div>
    <div class="card-body pt-0 pb-1">
        @foreach($this->users as $user)
        <div class="my-2 pt-2 pb-3 border-bottom">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('profile', $user->slug) }}">
                        @if($user->pic)
                            <img class="rounded-3 cover" width="36" height="36" src="{{ '/storage/' . $user->pic }}" alt="{{ $user->name }}">
                        @else
                            <img class="rounded-3" width="36" height="36" src="{{ config('services.ui_avatar') . $user->name }}" alt="{{ $user->name }}">
                        @endif
                    </a>
                    <div>
                        <a href="{{ route('profile', $user->slug) }}" class="text-decoration-none text-dark">
                            <h6 class="mb-0 fw-bold">
                                {{ $user->name }}
                            </h6>
                        </a>
                        <small class="text-secondary">
                            {{ $user->followers->count() }} 
                            {{ $user->followers->count() > 1 ? 'followers' : 'follower' }}
                        </small>
                    </div>
                </div>
                @auth
                <button wire:click="followUserList({{ $user->id }})" class="btn btn-sm @if(!in_array(auth()->user()->id, $user->followers->pluck('follower_id')->toArray())) btn-primary @else btn-secondary @endif px-3">
                    <i class="fas fa-sm @if(!in_array(auth()->user()->id, $user->followers->pluck('follower_id')->toArray())) fa-user-plus @else fa-user-minus @endif"></i>
                </button>
                @endauth
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif