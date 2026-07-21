@extends('layouts.auth.main')

@section('title', 'Reset Password')
@section('subtitle', 'Create a new password for your account.')

@section('content')
  <div class="space-y-6">
    @if($errors->any())
      <div class="rounded-2xl border border-rose-200 bg-rose-50 p-4 text-base text-rose-700">
        <ul class="list-disc space-y-1 pl-5">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
      @csrf

      <input type="hidden" name="token" value="{{ $request->route('token') }}" />

      <x-ui.input id="email" name="email" type="email" value="{{ old('email', $request->email) }}" placeholder="name@example.com" required class="w-full" label="Email" />

      <x-ui.password id="password" name="password" placeholder="Enter new password" required class="w-full" label="New Password" />

      <x-ui.password id="password_confirmation" name="password_confirmation" placeholder="Repeat new password" required class="w-full" label="Confirm Password" />

      <x-ui.button type="submit" font="bold" size="md" class="w-full">Reset Password</x-ui.button>
    </form>

    <div class="text-center text-base text-slate-600">
        Remember your password?
        <a
            href="{{ route('login') }}"
            class="font-semibold text-slate-900 hover:underline"
        >
            Sign in now
        </a>
    </div>
  </div>
@endsection
