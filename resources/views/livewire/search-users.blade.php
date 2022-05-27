<div class="card border-0 shadow-sm rounded-5 mb-3">
    <div class="card-header bg-white border-light rounded-top-5">Search</div>
    <div class="card-body pt-0 pb-1">
        <input type="text" class="form-control rounded-3 my-2" wire:model.debounce.500ms="search" placeholder="Ex: John Doe">
        @if(strlen($search) >= 3)
        <div>
            @foreach($this->users as $user)
            <div class="d-flex align-items-center gap-3 py-2 @if(!$loop->last) border-bottom @endif">
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
            @endforeach
        </div>
        @endif
        @if(!$this->users->count() && $search !== null)
            <p class="text-center mt-1">
                User with name <strong>{{ $search }}</strong> was not found!
            </p>
        @endif
    </div>
</div>