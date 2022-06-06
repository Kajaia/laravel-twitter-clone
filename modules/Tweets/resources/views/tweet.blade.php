@extends('layouts.app')

@section('content')
<div class="row">
    <div class="@auth col-md-8 @else col-md-12 @endauth">
        <livewire:tweet-list :tweet="$tweet" />
    </div>
    @auth
    <x-the-sidebar :user="auth()->user()" />
    @endauth
</div>
@endsection