@extends('layouts.auth.main')

@section('title', 'Masuk')
@section('subtitle', 'Masuk untuk mengelola aplikasi.')

@section('content')
  <div class="space-y-6">
    @if(session('status'))
      <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">
        {{ session('status') }}
      </div>
    @endif

    @if($errors->any())
      <div class="rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
        <ul class="list-disc space-y-1 pl-5">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
      @csrf

      <div>
        <label for="email" class="mb-2 block text-sm font-medium text-slate-700">Email</label>
        <x-ui.input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="name@example.com" required autofocus class="w-full" />
      </div>

      <div>
        <label for="password" class="mb-2 block text-sm font-medium text-slate-700">Password</label>
        <x-ui.password id="password" name="password" placeholder="Masukkan password" required class="w-full" />
      </div>

      <div class="flex items-center justify-between text-sm text-slate-600">
        <label class="inline-flex items-center gap-2">
          <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-slate-700 focus:ring-slate-500" />
          Remember me
        </label>
        <a href="{{ route('password.request') ?? '#' }}" class="font-medium text-slate-700 hover:text-slate-900">Lupa password?</a>
      </div>

      <div>
        <x-ui.button type="submit" class="w-full">Masuk</x-ui.button>
      </div>
    </form>

    <div class="space-y-4">
        <div class="text-center text-sm text-slate-500">atau</div>
        <x-ui.google-button :href="route('google.login')" label="Masuk dengan Google" />
    </div>


    <div class="text-center text-sm text-slate-600">
        Belum punya akun?
        <a
            href="{{ route('register') }}"
            class="font-semibold text-slate-900 hover:underline"
        >
            Daftar sekarang
        </a>
    </div>
  </div>
@endsection
