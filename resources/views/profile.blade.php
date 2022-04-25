@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 mt-2 mb-3">
        <livewire:user-profile :user="$user" />
    </div>
    <div class="col-md-8 @auth my-2 @endauth">
        <div class="card border-0 rounded-5 shadow-sm @guest mt-2 @if(request('tab')) mb-4 @endif @endguest @if(!request('tab')) mb-3 @endif">
            <div class="card-body p-2 d-flex align-items-center justify-content-center flex-wrap gap-5">
                <a class="text-decoration-none @if(!request('tab')) fw-bold @endif" href="{{ route('profile', $user->slug) }}">Tweets</a>
                <a class="text-decoration-none @if(request('tab') === 'liked') fw-bold @endif" href="{{ route('profile', [$user->slug, 'tab' => 'liked']) }}">Liked</a>
                <a class="text-decoration-none @if(request('tab') === 'replied') fw-bold @endif" href="{{ route('profile', [$user->slug, 'tab' => 'replied']) }}">Replied</a>
                @auth
                    @if($user->id === auth()->user()->id)
                    <a class="text-decoration-none @if(request('tab') === 'saved') fw-bold @endif" href="{{ route('profile', [$user->slug, 'tab' => 'saved']) }}">Saved</a>
                    @endif
                @endauth
            </div>
        </div>
        @if(request('tab') === 'liked')
            <livewire:user-likes-feed :userId="$user->id" />
        @elseif(request('tab') === 'replied')
            <livewire:user-reply-feed :userId="$user->id" />
        @elseif(request('tab') === 'saved')
            @auth
                @if($user->id === auth()->user()->id)
                <livewire:user-favourite-feed :userId="$user->id" />
                @endif
            @else
                <p class="text-center mb-0">
                    Favourites are hidden!
                </p>
            @endauth
        @elseif(request('tab') === 'edit')
            @auth
                <x-change-user-details :user="$user" />
            @else
                <p class="text-center mb-0">
                    Locked!
                </p>
            @endauth
        @elseif(request('tab') === 'followers')
            @auth
                @if($user->id === auth()->user()->id)
                <livewire:following-users 
                    :userId="$user->id" 
                    :model="'follower'" 
                    :field="'followed_id'" 
                />
                @else
                    <p class="text-center mt-3 mb-0">
                        Hidden information!
                    </p>
                @endif
            @else
                <p class="text-center mb-0">
                    Hidden information!
                </p>
            @endauth
        @elseif(request('tab') === 'following')
            @auth
                @if($user->id === auth()->user()->id)
                <livewire:following-users 
                    :userId="$user->id" 
                    :model="'following'" 
                    :field="'follower_id'" 
                />
                @else
                    <p class="text-center mt-3 mb-0">
                        Hidden information!
                    </p>
                @endif
            @else
                <p class="text-center mb-0">
                    Hidden information!
                </p>
            @endauth
        @else
            @auth
                @if($user->id === auth()->user()->id)
                <livewire:create-tweet />
                @endif
            @endauth
            <livewire:tweet-feed :feed="false" :userId="$user->id" />
        @endif
    </div>
    <!-- Sidebar -->
    <div class="col-md-4 my-2">
        <aside class="aside">
            <livewire:search-users />
            @auth
            <livewire:follow-users :limit="5" />
            @endauth
            <x-the-copyright />
        </aside>
    </div>
    <!-- /Sidebar -->
</div>
@endsection