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
            <x-follow-users :limit="5" />
            <p class="mt-3 mb-0">
                <small>&copy; {{ \Carbon\Carbon::now()->format('Y') . ' ' . config('app.name') }}</small>
            </p>
        </aside>
    </div>
    <!-- /Sidebar -->
</div>
@endsection