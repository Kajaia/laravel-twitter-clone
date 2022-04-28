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
            @auth
                @if($user->visibility !== 0 || auth()->user()->id === $user->id || $user->visibility === 0 && in_array(auth()->user()->id, $user->following->pluck('followed_id')->toArray()))
                    <livewire:user-likes-feed :userId="$user->id" />
                @else
                    <p class="text-center mt-3 mb-0">
                        Private content!
                    </p>
                @endif
            @else
                @if($user->visibility !== 0)
                    <livewire:user-likes-feed :userId="$user->id" />
                @else
                    <p class="text-center mt-3 mb-0">
                        Private content!
                    </p>
                @endif
            @endauth
        @elseif(request('tab') === 'replied')
            @auth
                @if($user->visibility !== 0 || auth()->user()->id === $user->id || $user->visibility === 0 && in_array(auth()->user()->id, $user->following->pluck('followed_id')->toArray()))
                    <livewire:user-reply-feed :userId="$user->id" />
                @else
                    <p class="text-center mt-3 mb-0">
                        Private content!
                    </p>
                @endif
            @else
                @if($user->visibility !== 0)
                    <livewire:user-reply-feed :userId="$user->id" />
                @else
                    <p class="text-center mt-3 mb-0">
                        Private content!
                    </p>
                @endif
            @endauth
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
                    :model="'following'" 
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
                    :model="'followers'" 
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
                @if($user->visibility !== 0 || auth()->user()->id === $user->id || $user->visibility === 0 && in_array(auth()->user()->id, $user->following->pluck('followed_id')->toArray()))
                    <livewire:tweet-feed :feed="false" :userId="$user->id" />
                @else
                    <p class="text-center mt-3 mb-0">
                        Private content!
                    </p>
                @endif
            @else
                @if($user->visibility !== 0)
                    <livewire:tweet-feed :feed="false" :userId="$user->id" />
                @else
                    <p class="text-center mt-3 mb-0">
                        Private content!
                    </p>
                @endif
            @endauth
        @endif
    </div>
    <x-the-sidebar :user="$user" />
</div>
@endsection