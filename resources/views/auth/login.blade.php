@extends('layout.auth.main')
@section('container')
<div class="d-flex align-items-center justify-content-center min-vh-100" style="background-color: #f8f9fa;">
    <div class="card shadow rounded" style="width: 400px; background-color: #ffffff;">
        <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 text-center">Sign In</h3>

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="form-floating form-floating-outline mb-3">
                    <input type="text" id="form-alignment-username" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email" />
                    <label for="form-alignment-username">Email</label>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3 form-password-toggle">
                    <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                            <input type="password" id="form-alignment-password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" aria-describedby="form-alignment-password2" />
                            <label for="form-alignment-password">Password</label>
                        </div>
                        <span class="input-group-text cursor-pointer" id="form-alignment-password2">
                            <i class="icon-base ri ri-eye-off-line"></i>
                        </span>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="mb-3">
                    <label class="form-check m-0">
                        <input type="checkbox" name="remember" class="form-check-input" />
                        <span class="form-check-label">Remember me</span>
                    </label>
                </div>

                <!-- Login Button -->
                <div class="d-grid gap-2 mb-3">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>

                <!-- Divider "OR" -->
                <div class="d-flex align-items-center my-4">
                    <hr class="flex-grow-1">
                    <span class="mx-3 text-muted" style="font-size: 0.85rem;">OR</span>
                    <hr class="flex-grow-1">
                </div>

                <!-- Google Login Button -->
                <div class="d-grid gap-2 mb-3">
                    <a href="{{ route('google.login') }}" class="btn btn-outline-secondary d-flex align-items-center justify-content-center shadow-sm">
                        <img src="https://authjs.dev/img/providers/google.svg" alt="Google Logo" width="18" class="me-2">
                        Continue with Google
                    </a>
                </div>

                <!-- Forgot Password -->
                <div class="text-center mb-3">
                    <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot Password?</a>
                </div>

                <!-- Sign Up Button -->
                <div class="text-center">
                    <span>Don't have an account?</span>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm ms-2">Sign Up</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
