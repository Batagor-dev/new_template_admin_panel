@extends('layouts.auth.main')

@section('title', 'Verify Email')
@section('subtitle', 'One more step to activate your account.')
@section('meta_description', 'Verify your account email address.')

@section('content')
<div class="space-y-5">

  {{-- Status berhasil kirim ulang --}}
  @if(session('status') == 'verification-link-sent')
    <div class="flex items-center gap-2.5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-satoshi-medium text-emerald-700">
      <i class="ri-checkbox-circle-line text-base shrink-0"></i>
      <span>Verification email has been resent. Please check your inbox.</span>
    </div>
  @endif

  {{-- Info card --}}
  <div class="flex items-start gap-3.5 rounded-xl border border-slate-100 bg-slate-50 p-4">
    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-500 border border-indigo-100">
      <i class="ri-mail-check-line text-xl"></i>
    </span>
    <div class="space-y-1">
      <p class="text-sm font-satoshi-bold text-slate-800">Check your inbox</p>
      <p class="text-sm font-satoshi-medium text-slate-500 leading-relaxed">
        We have sent a confirmation link to your email. Please also check your <strong class="text-slate-700">Spam</strong> folder if it is not in your inbox.
      </p>
    </div>
  </div>

  {{-- Action button --}}
  <form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <x-ui.button type="submit" font="bold" size="md" class="w-full flex items-center justify-center gap-2">
      <i class="ri-refresh-line text-base"></i>
      Resend Email
    </x-ui.button>
  </form>

</div>
@endsection