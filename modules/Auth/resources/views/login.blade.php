@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <x-session-notification-component />
        <form action="{{ route('login') }}" method="POST" class="card border-0 rounded-5 shadow-sm">
            @csrf
            <div class="card-header border-light rounded-top-5 bg-white">Login to your account</div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label" for="email">Email address</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autofocus>

                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">

                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label cursor-pointer" for="remember">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            Remember me
                        </label>
                    </div>
                </div>
            </div>
            <div class="card-footer rounded-bottom-5 bg-white border-0 text-center mb-2">
                <button type="submit" class="btn btn-primary px-4 py-1">Login</button>
                <a href="{{ route('auth.register') }}" class="btn btn-link px-4 py-1 text-decoration-none">Register</a>
                <div class="mt-2">
                    <a href="{{ route('password.request') }}" class="btn btn-link px-4 py-1 text-decoration-none">Forgot password?</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection