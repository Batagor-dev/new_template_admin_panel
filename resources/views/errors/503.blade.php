@extends('errors.layout')

@section('code', '503')
@section('title', 'Layanan Pemeliharaan')
@section('message', isset($exception) && $exception->getMessage() ? $exception->getMessage() : 'Sistem sedang dalam pemeliharaan berkala. Silakan kembali dalam beberapa saat.')
