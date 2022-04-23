<div class="my-2 pt-2 pb-3 border-bottom">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('profile', $user->slug) }}">
                <img class="rounded-3" width="36" height="36" src="{{ config('services.ui_avatar') . $user->name }}" alt="{{ $user->name }}">
            </a>
            <div>
                <a href="{{ route('profile', $user->slug) }}" class="text-decoration-none text-dark">
                    <h6 class="mb-0 fw-bold">
                        {{ $user->name }}
                    </h6>
                </a>
                <small class="text-secondary">
                    {{ $followers->count() }} 
                    {{ $followers->count() > 1 ? 'followers' : 'follower' }}
                </small>
            </div>
        </div>
        <button wire:click="followUser" class="btn btn-sm @if(!in_array(auth()->user()->id, $followers->pluck('follower_id')->toArray())) btn-primary @else btn-secondary @endif px-3">
            <i class="fas fa-sm @if(!in_array(auth()->user()->id, $followers->pluck('follower_id')->toArray())) fa-user-plus @else fa-user-minus @endif"></i>
        </button>
    </div>
</div>