@extends('errors.layout')

@section('code', '401')
@section('title', 'Tidak Terautentikasi')
@section('message', isset($exception) && $exception->getMessage() ? $exception->getMessage() : 'Silakan masuk ke akun Anda terlebih dahulu untuk mengakses halaman ini.')
