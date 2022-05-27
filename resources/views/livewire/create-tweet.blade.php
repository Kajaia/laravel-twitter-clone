<div>
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
                <div class="mt-1">
                    @if($this->categories->count())
                    Choose category:
                    @endif
                    <div class="d-flex align-items-center flex-wrap gap-2">
                        @foreach($this->categories as $category)
                        <div class="form-check">
                            <label class="form-check-label cursor-pointer" for="category-{{ $category->id }}">
                                <input class="form-check-input" type="radio" wire:model="category_id" name="category_id" value="{{ $category->id }}" id="category-{{ $category->id }}">
                                <small>{{ $category->title }}</small>
                            </label>
                            <i wire:click="removeCategory('{{ $category->id }}')" class="fas fa-times fa-xs cursor-pointer text-secondary"></i>
                        </div>
                        @endforeach
                        <button type="button" class="btn btn-sm btn-link text-decoration-none px-1 py-0" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                            <i class="fas fa-plus fa-sm"></i>
                            New category
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer rounded-bottom-5 bg-white border-0 text-end">
            <button type="submit" class="btn btn-primary px-4 py-1">Tweet</button>
        </div>
    </form>
    <livewire:create-category-modal :wire:key="1" />
</div>