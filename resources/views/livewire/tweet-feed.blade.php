<div>
    @auth
        @if($this->categories->count())
        <div class="mt-3 d-flex align-items-center justify-content-between">
            <div class="col-5 col-md-7 col-lg-9">
                <label for="category">Filter:</label>
            </div>
            <div class="col-7 col-md-5 col-lg-3 text-end">
                <select id="category" class="form-select rounded-5" wire:model="category_id">
                    <option value="">Select category</option>
                    @foreach($this->categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @endif
    @endauth
    @foreach($this->tweets as $tweet)
        <livewire:tweet-list :tweet="$tweet" :wire:key="$tweet->id" />
    @endforeach
    @if($this->tweetsCount > $this->tweets->count())
    <p class="mb-0 text-center">
        <a class="btn btn-link cursor-pointer text-decoration-none" wire:click="perPageIncrease">
            Load more tweets
        </a>
    </p>
    @endif
    @if(!$this->tweets->count())
    <p class="mt-3 mb-0 text-center">
        No tweets!
    </p>
    @endif
</div>
