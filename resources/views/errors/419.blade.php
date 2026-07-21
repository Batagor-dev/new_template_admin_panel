@extends('errors.layout')

@section('code', '419')
@section('title', 'Sesi Telah Berakhir')
@section('message', isset($exception) && $exception->getMessage() ? $exception->getMessage() : 'Sesi Anda telah berakhir karena tidak ada aktivitas. Silakan muat ulang halaman.')
