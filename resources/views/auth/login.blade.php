@extends('layouts.auth.main')

@section('title', 'Sign In')
@section('subtitle', 'Sign in to manage the application.')

@section('content')
  <div class="space-y-6">
    @if(session('status'))
      <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-base text-emerald-700">
        {{ session('status') }}
      </div>
    @endif


    <form method="POST" action="{{ route('login') }}" class="space-y-5">
      @csrf

      <x-ui.input 
        name="email" 
        label="Email" 
        placeholder="Enter your email" 
        value="{{ old('email') }}" 
      />

      <x-ui.password 
        name="password" 
        label="Password" 
        placeholder="Enter your password" 
        required 
      />

      <div class="flex items-center justify-between text-base font-satoshi-medium text-slate-600">
        <x-ui.checkbox name="remember" label="Remember Me" />
        <a href="{{ route('password.request') ?? '#' }}" class="font-satoshi-medium text-base text-slate-700 hover:text-slate-900">Forgot password?</a>
      </div>

      <x-ui.button type="submit" font="bold" size="md" class="w-full">Sign In</x-ui.button>
    </form>

    <div class="space-y-4">
        <div class="text-center text-lg text-slate-500 font-satoshi-medium">or</div>
        <x-ui.google-button :href="route('google.login')" label="Sign in with Google" />
    </div>


    <div class="text-center text-base text-slate-600 font-satoshi-medium">
        Don't have an account?
        <a
            href="{{ route('register') }}"
            class="font-satoshi-bold text-base text-slate-900 hover:underline"
        >
            Sign up now
        </a>
    </div>
  </div>
@endsection
