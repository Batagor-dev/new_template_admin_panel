@extends('layouts.auth.main')

@section('title', 'Verifikasi OTP')
@section('subtitle', 'Masukkan kode OTP yang dikirim ke email Anda.')

@section('content')
  <div class="space-y-6">
    @if(session('status'))
      <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">
        {{ session('status') }}
      </div>
    @endif

    @if($errors->has('otp_code'))
      <div class="rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
        {{ $errors->first('otp_code') }}
      </div>
    @endif

    <form method="POST" action="{{ route('verification.otp.verify') }}" class="space-y-5">
      @csrf

      <div>
        <label for="otp_code" class="mb-2 block text-sm font-medium text-slate-700">Kode OTP</label>
        <x-ui.input id="otp_code" name="otp_code" type="text" value="{{ old('otp_code') }}" placeholder="123456" required class="w-full" />
      </div>

      <div>
        <x-ui.button type="submit" font="bold" size="md" class="w-full">Verifikasi OTP</x-ui.button>
      </div>
    </form>

    <form method="POST" action="{{ route('verification.otp.resend') }}" class="space-y-4">
      @csrf
      <div>
        <x-ui.button type="submit" font="bold" size="md" class="w-full bg-slate-100 text-slate-900 hover:bg-slate-200">Kirim Ulang OTP</x-ui.button>
      </div>
    </form>
  </div>
@endsection
