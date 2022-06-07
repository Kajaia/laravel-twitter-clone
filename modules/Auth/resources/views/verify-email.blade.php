@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <x-session-notification-component />
        <div class="card border-0 rounded-5 shadow-sm">
            <div class="card-header border-light rounded-top-5 bg-white">Verify Your Email Address</div>
            <div class="card-body">
                Before proceeding, please check your email for a verification link. If you did not receive the email,<br>
                <a class="cursor-pointer" onclick="return document.querySelector('#verify-form').submit();">click here to request another</a>.
            </div>
            <form id="verify-form" action="{{ route('verification.send') }}" method="POST">
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection