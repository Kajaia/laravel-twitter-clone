<div>
    @foreach($tweets as $tweet)
        <livewire:tweet-list :tweet="$tweet" :wire:key="$tweet->id" />
    @endforeach
    <p class="mb-0 text-center">
        <a href="#!" class="text-decoration-none">
            Load more tweets
        </a>
    </p>
</div>
