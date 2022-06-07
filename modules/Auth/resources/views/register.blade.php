@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <form action="{{ route('register') }}" method="POST" class="card border-0 rounded-5 shadow-sm">
            @csrf
            <div class="card-header border-light rounded-top-5 bg-white">Register a new account</div>
            <div class="card-body">
                <div class="form-group mb-3">
                    <label class="form-label" for="name">Your name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autofocus>

                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="email">
                        Email address
                        <small class="text-secondary">(Should be verified)</small>
                    </label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">

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
                    <label class="form-label" for="password_confirmation">Confirm password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">

                    @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="card-footer rounded-bottom-5 bg-white border-0 text-center mb-2">
                <button type="submit" class="btn btn-primary px-4 py-1">Register</button>
                <a href="{{ route('auth.login') }}" class="btn btn-link px-4 py-1 text-decoration-none">Already have an account?</a>
            </div>
        </form>
    </div>
</div>
@endsection