@extends('layouts.auth.main')

@section('title', 'Daftar')
@section('subtitle', 'Buat akun baru untuk mulai menggunakan aplikasi.')

@section('content')
  <div class="space-y-6">
    @if($errors->any())
      <div class="rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
        <ul class="list-disc space-y-1 pl-5">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif


    <form method="POST" action="{{ route('register') }}" class="space-y-5">
      @csrf

      <div>
        <label for="name" class="mb-2 block text-sm font-medium text-slate-700">Nama</label>
        <x-ui.input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Nama lengkap" required autofocus class="w-full" />
      </div>

      <div>
        <label for="email" class="mb-2 block text-sm font-medium text-slate-700">Email</label>
        <x-ui.input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="name@example.com" required class="w-full" />
      </div>

      <div>
        <label for="password" class="mb-2 block text-sm font-medium text-slate-700">Password</label>
        <x-ui.password id="password" name="password" placeholder="Masukkan password" required class="w-full" />
      </div>

      <div>
        <label for="password_confirmation" class="mb-2 block text-sm font-medium text-slate-700">Konfirmasi Password</label>
        <x-ui.password id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required class="w-full" />
      </div>

      <div>
        <x-ui.button type="submit" class="w-full">Daftar</x-ui.button>
      </div>
    </form>

    <div class="space-y-4">
        <div class="text-center text-sm text-slate-500">atau</div>
        <x-ui.google-button :href="route('google.login')" label="Masuk dengan Google" />
    </div>


    <div class="text-center text-sm text-slate-600">
        Sudah punya akun?
        <a
            href="{{ route('login') }}"
            class="font-semibold text-slate-900 hover:underline"
        >
            Masuk sekarang
        </a>
    </div>
  </div>
@endsection
