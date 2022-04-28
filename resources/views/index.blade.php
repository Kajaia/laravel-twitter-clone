@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 @auth my-2 @endauth">
        <x-session-notification-component />
        @auth
        <livewire:create-tweet />
        @endauth
        <livewire:tweet-feed :feed="true" :userId="auth()->user()->id" />
    </div>
    <x-the-sidebar :user="auth()->user()" />
</div>
@endsection