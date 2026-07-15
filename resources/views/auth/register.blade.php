@extends('layouts.auth.main')

@section('title', 'Daftar')
@section('subtitle', 'Buat akun baru untuk mulai menggunakan aplikasi.')

@section('content')
  <div class="space-y-6">

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
      @csrf

     <x-ui.input 
        name="name" 
        label="Nama" 
        placeholder="Masukkan nama Anda" 
        value="{{ old('name') }}" 
      />

     <x-ui.input 
        name="username" 
        label="Username" 
        placeholder="Masukkan username Anda" 
        value="{{ old('username') }}" 
      />

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

      <x-ui.password 
        name="password_confirmation" 
        id="password-confirm"        
        label="Ulangi Kata Sandi" 
        placeholder="Ulangi kata sandi baru" 
        required 
      />

      <x-ui.button type="submit" class="w-full">Daftar</x-ui.button>
    </form>

    <div class="space-y-4">
        <div class="text-center text-lg text-slate-500 font-satoshi-medium">atau</div>
        <x-ui.google-button :href="route('google.login')" label="Masuk dengan Google" />
    </div>


    <div class="text-center text-base text-slate-600 font-satoshi-medium">
        Sudah punya akun?
        <a
            href="{{ route('login') }}"
            class="font-satoshi-bold text-base text-slate-900 hover:underline"
        >
            Masuk sekarang
        </a>
    </div>
  </div>
@endsection
