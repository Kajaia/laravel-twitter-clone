<div class="col-md-4 my-2">
    <aside class="aside">
        @auth
            @if($user->id === auth()->user()->id && Route::currentRouteName() === 'profile')
            <livewire:token-generator :user="$user" />
            @endif
        @endauth
        <livewire:search-users />
        @auth
        <livewire:follow-users :limit="5" />
        @endauth
        <x-the-copyright />
    </aside>
</div>