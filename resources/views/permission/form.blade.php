@php
    $sub_title = ($breadcrumb = Breadcrumbs::current()) ? $breadcrumb->title : 'Dashboard';

    if (isset($permission_data)) {
        $breadcrumbsData = Breadcrumbs::generate(Request::route()->getName(), $permission_data);
    } else {
        $breadcrumbsData = Breadcrumbs::generate(Request::route()->getName());
    }
    $breadcrumb_parent = $breadcrumbsData->where('title', '!=', $breadcrumb->title)->last();
@endphp

@extends('layouts.backend.main')

@section('title', 'Permission Form')
@section('sub_title', $sub_title)

@section('breadcrumb')
    <x-layout.admin.breadcrumb :breadcrumbs="$breadcrumbsData" />
@endsection

@section('content')
    <div class="space-y-6">
        <x-ui.card>
            <form method="POST" action="{{ $action }}" class="space-y-6">
                @isset($permission_data) @method('PUT') @endisset
                @csrf

                <div>
                    <h5 class="text-lg font-satoshi-bold text-slate-900 mb-4">{{ $sub_title }}</h5>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <x-ui.input 
                            name="name" 
                            label="Name" 
                            placeholder="Permission Name" 
                            value="{{ old('name', $permission_data->name ?? '') }}"
                            required
                        />

                        <!-- Guard Name -->
                        <x-ui.input 
                            name="guard_name" 
                            label="Guard" 
                            placeholder="Guard Name" 
                            value="{{ old('guard_name', $permission_data->guard_name ?? 'web') }}"
                            required
                        />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <!-- Permission Group -->
                        <x-ui.select2 
                            name="permission_group_id" 
                            label="Permission Group" 
                            placeholder="-- Select Permission Group --" 
                            :options="$permissiongroups->pluck('name', 'id')->toArray()"
                            :value="old('permission_group_id', $permission_data->permission_group_id ?? '')"
                        />
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