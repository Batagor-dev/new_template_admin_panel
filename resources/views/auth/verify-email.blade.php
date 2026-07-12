@extends('layouts.auth.main')

@section('title', 'Verifikasi Email')
@section('subtitle', 'Pastikan email Anda sudah diverifikasi untuk melanjutkan.')

@section('content')
  <div class="space-y-6">
    @if(session('status') == 'verification-link-sent')
      <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">
        Link verifikasi baru sudah dikirim ke email Anda.
      </div>
    @endif

    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5 text-sm text-slate-700">
      Silakan periksa inbox email Anda dan klik tautan verifikasi untuk mengaktifkan akun.
    </div>

    <form method="POST" action="{{ route('verification.send') }}" class="space-y-4">
      @csrf
      <div>
        <x-ui.button type="submit" class="w-full">Kirim Ulang Link Verifikasi</x-ui.button>
      </div>
    </form>

    <div class="mt-6 border-t border-slate-200 pt-5 text-center text-sm text-slate-500">
      Tidak mau pakai link? <a href="{{ route('verification.otp') }}" class="font-semibold text-slate-900 hover:text-slate-700">Verifikasi lewat OTP</a>
    </div>
  </div>
@endsection
