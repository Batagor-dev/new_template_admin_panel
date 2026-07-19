@php
    $sub_title = ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Dashboard';

    if (isset($user_data)) {
        $breadcrumbsData = Breadcrumbs::generate(Request::route()->getName(), $user_data);
        $breadcrumb_parent = $breadcrumbsData->where('title', '!=', $breadcrumb->title)->last();
    } else {
        $breadcrumbsData = Breadcrumbs::generate(Request::route()->getName());
        $breadcrumb_parent = $breadcrumbsData->where('title', '!=', $breadcrumb->title)->last();
    }
@endphp

@extends('layouts.backend.main')

@section('title', 'User Form')
@section('sub_title', $sub_title)

@section('breadcrumb')
    <x-layout.admin.breadcrumb :breadcrumbs="$breadcrumbsData" />
@endsection

@section('content')
    <div class="space-y-6">

        <x-ui.card>
            <form method="POST" action="{{ $action }}" class="space-y-6" enctype="multipart/form-data">
                @isset($user_data) @method('PUT') @endisset
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-ui.input 
                        name="username" 
                        label="Username" 
                        placeholder="Username" 
                        value="{{ old('username', $user_data->username ?? '') }}"
                        required
                    />

                    <x-ui.input 
                        name="name" 
                        label="Name" 
                        placeholder="Name" 
                        value="{{ old('name', $user_data->name ?? '') }}"
                        required
                    />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-ui.input 
                        type="email"
                        name="email" 
                        label="Email" 
                        placeholder="Email" 
                        value="{{ old('email', $user_data->email ?? '') }}"
                        required
                    />

                    <div>
                        <label for="foto" class="mb-2 block text-base font-satoshi-medium text-slate-700">Foto</label>
                        <input 
                            type="file" 
                            name="foto" 
                            id="foto" 
                            class="block w-full font-satoshi-medium text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 cursor-pointer"
                        />
                        @error('foto')
                            <span class="mt-1.5 block text-sm font-medium text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-ui.password 
                        name="password" 
                        label="Password" 
                        placeholder="••••••••" 
                    />

                    <x-ui.password 
                        name="password_confirmation" 
                        label="Confirm Password" 
                        placeholder="••••••••" 
                    />
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
