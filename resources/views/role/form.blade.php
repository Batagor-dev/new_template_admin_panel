@php
    $sub_title = ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Dashboard';

    if (isset($role_data)) {
        $breadcrumbsData = Breadcrumbs::generate(Request::route()->getName(), $role_data);
    } else {
        $breadcrumbsData = Breadcrumbs::generate(Request::route()->getName());
    }
    $breadcrumb_parent = $breadcrumbsData->where('title', '!=', $breadcrumb->title)->last();
@endphp

@extends('layouts.backend.main')

@section('title', 'User Roles')
@section('sub_title', $sub_title)

@section('breadcrumb')
    <x-layout.admin.breadcrumb :breadcrumbs="$breadcrumbsData" />
@endsection

@section('content')
    <div class="space-y-6">
        <x-ui.card>
            <form method="POST" action="{{ $action }}" class="space-y-6">
                @isset($role_data) @method('PUT') @endisset
                @csrf

                <div>
                    <h5 class="text-lg font-satoshi-bold text-slate-900 mb-4">{{ $sub_title }}</h5>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="mb-2 block text-base font-satoshi-medium text-slate-700">Role Name</label>
                            <input type="text"
                                id="name"
                                name="name"
                                class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 bg-slate-50 text-slate-900 font-satoshi-medium outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200 transition @error('name') border-red-400 bg-red-50/50 text-red-900 @enderror"
                                value="{{ old('name', $role_data->name ?? '') }}"
                                placeholder="Role Name"/>
                            @error('name')
                                <span class="mt-1.5 block text-sm font-medium text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Guard Name -->
                        <div>
                            <label for="guard_name" class="mb-2 block text-base font-satoshi-medium text-slate-700">Guard</label>
                            <input type="text"
                                id="guard_name"
                                name="guard_name"
                                class="w-full px-4 py-2.5 rounded-2xl border border-slate-200 bg-slate-50 text-slate-900 font-satoshi-medium outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200 transition @error('guard_name') border-red-400 bg-red-50/50 text-red-900 @enderror"
                                value="{{ old('guard_name', $role_data->guard_name ?? 'web') }}"
                                placeholder="Guard Name"/>
                            @error('guard_name')
                                <span class="mt-1.5 block text-sm font-medium text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit / Cancel -->
                <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                    <x-ui.button type="button" font="medium" size="sm" style="secondary" onclick="window.location.href='{{ $breadcrumb_parent->url }}'">
                        Cancel
                    </x-ui.button>
                    <x-ui.button type="submit" font="bold" size="sm">
                        Submit
                    </x-ui.button>
                </div>
            </form>
        </x-ui.card>
    </div>
@endsection