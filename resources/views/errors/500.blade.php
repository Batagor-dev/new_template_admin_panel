@extends('errors.layout')

@section('code', '500')
@section('title', 'Kesalahan Server')
@section('message', isset($exception) && $exception->getMessage() ? $exception->getMessage() : 'Terjadi kesalahan pada server internal kami. Silakan coba beberapa saat lagi.')
