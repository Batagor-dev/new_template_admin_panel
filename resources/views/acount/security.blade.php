@php
    $breadcrumbsData = Breadcrumbs::generate(); 
    $sub_title = ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Dashboard';
@endphp

@extends('layouts.backend.main')

@section('title', 'Security Settings')
@section('sub_title', $sub_title)

@section('breadcrumb')
    <x-layout.admin.breadcrumb :breadcrumbs="$breadcrumbsData" />
@endsection

@section('content')
<div class="space-y-6 pb-12">
    <!-- Tabs Nav -->
    <div class="flex items-center gap-2 bg-slate-100 p-1.5 rounded-2xl w-fit">
        <a href="{{ route('acount.index') }}" class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-slate-500 hover:text-slate-900 font-satoshi-medium transition">
            <i class="ri-user-3-line text-lg"></i>
            <span>Account</span>
        </a>
        <a href="javascript:void(0);" class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white text-slate-900 font-satoshi-bold shadow-sm transition">
            <i class="ri-lock-line text-lg"></i>
            <span>Security</span>
        </a>
    </div>

    <!-- Main Card -->
    <x-ui.card>
        <div class="border-b border-slate-100 pb-4 mb-6">
            <h5 class="text-lg font-satoshi-bold text-slate-900">Change Password</h5>
        </div>

        <form id="formSecurity" method="POST" action="{{ route('acount.password') }}" class="space-y-6 w-full">
            @csrf

            {{-- Current Password --}}
            <div>
                <x-ui.password 
                    name="currentPassword" 
                    id="currentPassword"
                    label="Current Password" 
                    placeholder="••••••••" 
                />
            </div>

            {{-- New Password --}}
            <div>
                <x-ui.password 
                    name="newPassword" 
                    id="newPassword"
                    label="New Password" 
                    placeholder="••••••••" 
                />
            </div>

            {{-- Confirm New Password --}}
            <div>
                <x-ui.password 
                    name="newPassword_confirmation" 
                    id="confirmPassword"
                    label="Confirm New Password" 
                    placeholder="••••••••" 
                />
            </div>

            {{-- Requirements --}}
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5 space-y-3">
                <h6 class="text-sm font-satoshi-bold text-slate-700">Password Requirements:</h6>
                <ul class="list-disc pl-5 text-sm text-slate-500 space-y-1.5 font-satoshi-medium">
                    <li>Minimum 8 characters long - the more, the better</li>
                    <li>At least one lowercase character</li>
                    <li>At least one number, symbol, or whitespace character</li>
                </ul>
            </div>

            {{-- Actions --}}
            <div class="flex justify-end pt-4 border-t border-slate-100">
                <x-ui.button type="submit" size="md">
                    Save changes
                </x-ui.button>
            </div>
        </form>
    </x-ui.card>
</div>
@endsection

@push('scripts')
    {{-- SweetAlert otomatis --}}
    @if(session('success'))
        <script>
            Swal.fire({
                icon : 'success',
                title: 'Success',
                text : "{{ session('success') }}"
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon : 'error',
                title: 'Error',
                text : "{{ session('error') }}"
            });
        </script>
    @endif
@endpush