@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <form action="{{ route('password.update') }}" method="POST" class="card border-0 rounded-5 shadow-sm">
            @csrf
            <div class="card-header border-light rounded-top-5 bg-white">Register a new account</div>
            <div class="card-body">
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group mb-3">
                    <label class="form-label" for="email">Email address</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ request('email') }}">

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
                <button type="submit" class="btn btn-primary px-4 py-1">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection