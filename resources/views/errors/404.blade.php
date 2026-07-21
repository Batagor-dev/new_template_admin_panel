@extends('errors.layout')

@section('code', '404')
@section('title', 'Halaman Tidak Ditemukan')
@section('message', isset($exception) && $exception->getMessage() ? $exception->getMessage() : 'Maaf, halaman yang Anda cari tidak ditemukan atau telah dipindahkan.')
