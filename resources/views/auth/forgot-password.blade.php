@extends('layouts.auth.main')

@section('title', 'Lupa Password')
@section('subtitle', 'Masukkan email Anda untuk menerima link reset password.')

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

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
      @csrf

      <div>
        <label for="email" class="mb-2 block text-sm font-medium text-slate-700">Email</label>
        <x-ui.input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="name@example.com" required autofocus class="w-full" />
      </div>

      <div>
        <x-ui.button type="submit" font="bold" size="md" class="w-full">Kirim Link Reset</x-ui.button>
      </div>
    </form>

    <div class="text-center text-sm text-slate-600">
        Sudah ingat password Anda?
        <a
            href="{{ route('login') }}"
            class="font-semibold text-slate-900 hover:underline"
        >
            Masuk sekarang
        </a>
    </div>
  </div>
@endsection
