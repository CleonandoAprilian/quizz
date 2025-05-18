<!-- resources/views/auth/register.blade.php -->
@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="auth-page">
    <div class="auth-card card">
        <div class="card-header">
            <h4>Create an account</h4>
            <p>Join our quiz platform</p>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="form-group">
                    <label for="name" class="form-label">Full Name</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-user text-primary"></i></span>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter your full name">
                    </div>
                    @error('name')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-envelope text-primary"></i></span>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email">
                    </div>
                    @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="school" class="form-label">School</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-school text-primary"></i></span>
                        <input id="school" type="text" class="form-control @error('school') is-invalid @enderror" name="school" value="{{ old('school') }}" required placeholder="Enter your school name">
                    </div>
                    @error('school')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="address" class="form-label">Address</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-map-marker-alt text-primary"></i></span>
                        <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" required placeholder="Enter your address">{{ old('address') }}</textarea>
                    </div>
                    @error('address')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-lock text-primary"></i></span>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Create a password">
                    </div>
                    @error('password')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password-confirm" class="form-label">Confirm Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-lock text-primary"></i></span>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password">
                    </div>
                </div>
                
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-user-plus me-2"></i> Register
                    </button>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
        </div>
    </div>
</div>
@endsection