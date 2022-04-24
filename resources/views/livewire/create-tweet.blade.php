<form wire:submit.prevent="submit" class="card border-0 rounded-5 shadow-sm">
    <div class="card-header border-light rounded-top-5 bg-white">Tweet something</div>
    <div class="card-body d-flex align-items-start gap-2">
        <a href="{{ route('profile', auth()->user()->slug) }}">
            @if(auth()->user()->pic)
                <img class="rounded-3 cover" width="36" height="36" src="{{ '/storage/' . auth()->user()->pic }}" alt="{{ auth()->user()->name }}">
            @else
                <img class="rounded-3" width="36" height="36" src="{{ config('services.ui_avatar') . auth()->user()->name }}" alt="{{ auth()->user()->name }}">
            @endif
        </a>
        <div class="w-100">
            <textarea class="form-control bg-light @error('content') is-invalid @enderror" wire:model.debounce.500ms="content" cols="30" rows="3" placeholder="What's happening?"></textarea>

            @error('content')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="card-footer rounded-bottom-5 bg-white border-0 text-end">
        <button type="submit" class="btn btn-primary px-4 py-1">Tweet</button>
    </div>
</form>