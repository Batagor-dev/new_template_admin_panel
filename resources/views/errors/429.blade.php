@extends('errors.layout')

@section('code', '429')
@section('title', 'Terlalu Banyak Permintaan')
@section('message', isset($exception) && $exception->getMessage() ? $exception->getMessage() : 'Anda melakukan terlalu banyak permintaan dalam waktu singkat. Silakan tunggu beberapa saat.')
