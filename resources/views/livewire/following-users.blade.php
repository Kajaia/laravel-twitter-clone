<div class="card border-0 shadow-sm rounded-5 mt-3">
    <div class="card-header bg-white border-light rounded-top-5">{{ ucfirst($model) }}</div>
    <div class="card-body pt-0 pb-1">
        @foreach($users as $user)
        <div class="my-2 pt-2 pb-3 border-bottom">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('profile', $user[$model]->slug) }}">
                        @if($user[$model]->pic)
                            <img class="rounded-3 cover" width="36" height="36" src="{{ '/storage/' . $user[$model]->pic }}" alt="{{ $user[$model]->name }}">
                        @else
                            <img class="rounded-3" width="36" height="36" src="{{ config('services.ui_avatar') . $user[$model]->name }}" alt="{{ $user[$model]->name }}">
                        @endif
                    </a>
                    <div>
                        <a href="{{ route('profile', $user[$model]->slug) }}" class="text-decoration-none text-dark">
                            <h6 class="mb-0 fw-bold">
                                {{ $user[$model]->name }}
                            </h6>
                        </a>
                        <small class="text-secondary">
                            {{ $user[$model]->followers->count() }} 
                            {{ $user[$model]->followers->count() > 1 ? 'followers' : 'follower' }}
                        </small>
                    </div>
                </div>
                <button wire:click="followUserList({{ $user[$model]->id }})" class="btn btn-sm @if(!in_array(auth()->user()->id, $user[$model]->followers->pluck('follower_id')->toArray())) btn-primary @else btn-secondary @endif px-3">
                    <i class="fas fa-sm @if(!in_array(auth()->user()->id, $user[$model]->followers->pluck('follower_id')->toArray())) fa-user-plus @else fa-user-minus @endif"></i>
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>