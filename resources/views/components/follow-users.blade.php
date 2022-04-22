@if($users->count())
    <!-- Who to follow -->
    <div class="card border-0 shadow-sm rounded-5">
        <div class="card-header bg-white border-light rounded-top-5">Who to follow</div>
        <div class="card-body">
            @foreach($users as $user)
            <!-- User -->
            <div class="@if(!$loop->first) mt-3 @endif @if(!$loop->last) border-bottom pb-3 @endif">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <img class="rounded-3 d-none d-lg-flex" width="36" height="36" src="{{ config('services.ui_avatar') . $user->name }}" alt="{{ $user->name }}">
                        <div>
                            <h6 class="mb-0">{{ $user->name }}</h6>
                            <small class="text-secondary">
                                {{ $user->followers->count() }} 
                                {{ $user->followers->count() > 1 ? 'followers' : 'follower' }}
                            </small>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-primary px-3 py-1">
                        <i class="fas fa-user-plus fa-sm me-1"></i>
                        Follow
                    </button>
                </div>
            </div>
            <!-- /User -->
            @endforeach
        </div>
    </div>
    <!-- /Who to follow -->
    @endif