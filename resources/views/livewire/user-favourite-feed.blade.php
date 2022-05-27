<div>
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
        No saved tweets!
    </p>
    @endif
</div>
