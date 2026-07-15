@extends('layouts.auth.main')

@section('title', 'Masuk')
@section('subtitle', 'Masuk untuk mengelola aplikasi.')

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
        placeholder="Masukkan email Anda" 
        value="{{ old('email') }}" 
      />

      <x-ui.password 
        name="password" 
        label="Kata Sandi" 
        placeholder="Masukkan kata sandi baru" 
        required 
      />

      <div class="flex items-center justify-between text-base font-satoshi-medium text-slate-600">
        <x-ui.checkbox name="remember" label="Ingat Saya" />
        <a href="{{ route('password.request') ?? '#' }}" class="font-satoshi-medium text-base text-slate-700 hover:text-slate-900">Lupa password?</a>
      </div>

      <div>
        <x-ui.button type="submit" class="w-full">Masuk</x-ui.button>
      </div>
    </form>

    <div class="space-y-4">
        <div class="text-center text-lg text-slate-500 font-satoshi-medium">atau</div>
        <x-ui.google-button :href="route('google.login')" label="Masuk dengan Google" />
    </div>


    <div class="text-center text-base text-slate-600 font-satoshi-medium">
        Belum punya akun?
        <a
            href="{{ route('register') }}"
            class="font-satoshi-bold text-base text-slate-900 hover:underline"
        >
            Daftar sekarang
        </a>
    </div>
  </div>
@endsection
