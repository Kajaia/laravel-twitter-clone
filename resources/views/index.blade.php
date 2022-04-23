@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 @auth my-2 @endauth">
        @auth
        <livewire:create-tweet />
        @endauth
        <livewire:tweet-feed />
    </div>
    <!-- Sidebar -->
    <div class="col-md-4 my-2">
        <aside class="aside">
            @auth
            <livewire:follow-users :limit="5" />
            @endauth
            <x-the-copyright />
        </aside>
    </div>
    <!-- /Sidebar -->
</div>
@endsection