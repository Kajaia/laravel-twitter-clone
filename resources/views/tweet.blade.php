@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <livewire:tweet-list :tweet="$tweet" />
    </div>
    <x-the-sidebar :user="auth()->user()" />
</div>
@endsection