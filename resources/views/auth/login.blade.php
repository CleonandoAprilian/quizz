<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="auth-page">
    <div class="auth-card card">
        <div class="card-header">
            <h4>Welcome Back!</h4>
            <p>Login to your account</p>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-envelope text-primary"></i></span>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
                    </div>
                    @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-lock text-primary"></i></span>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">
                    </div>
                    @error('password')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Remember Me
                        </label>
                    </div>
                </div>
                
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-sign-in-alt me-2"></i> Login
                    </button>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
        </div>
    </div>
</div>
@endsection