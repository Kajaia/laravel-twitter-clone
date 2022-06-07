@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <x-session-notification-component />
        <form action="{{ route('password.email') }}" method="POST" class="card border-0 rounded-5 shadow-sm">
            @csrf
            <div class="card-header border-light rounded-top-5 bg-white">Reset your password</div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label" for="email">Email address</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autofocus>

                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="card-footer rounded-bottom-5 bg-white border-0 text-center mb-2">
                <button type="submit" class="btn btn-primary px-4 py-1">Send</button>
                <a href="{{ route('auth.login') }}" class="btn btn-link px-4 py-1 text-decoration-none">Login</a>
            </div>
        </form>
    </div>
</div>
@endsection