@extends('layouts.auth.main')

@section('title', 'Sign Up')
@section('subtitle', 'Create a new account to start using the application.')

@section('content')
  <div class="space-y-6">

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
      @csrf

     <x-ui.input 
        name="name" 
        label="Name" 
        placeholder="Enter your name" 
        value="{{ old('name') }}" 
      />

     <x-ui.input 
        name="username" 
        label="Username" 
        placeholder="Enter your username" 
        value="{{ old('username') }}" 
      />

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

      <x-ui.password 
        name="password_confirmation" 
        id="password-confirm"        
        label="Confirm Password" 
        placeholder="Repeat your password" 
        required 
      />

      <x-ui.button type="submit" font="bold" size="md" class="w-full">Sign Up</x-ui.button>
    </form>

    <div class="space-y-4">
        <div class="text-center text-lg text-slate-500 font-satoshi-medium">or</div>
        <x-ui.google-button :href="route('google.login')" label="Sign in with Google" />
    </div>


    <div class="text-center text-base text-slate-600 font-satoshi-medium">
        Already have an account?
        <a
            href="{{ route('login') }}"
            class="font-satoshi-bold text-base text-slate-900 hover:underline"
        >
            Sign in now
        </a>
    </div>
  </div>
@endsection
