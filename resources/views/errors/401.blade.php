@extends('errors.layout')

@section('code', '401')
@section('title', 'Unauthenticated')
@section('message', isset($exception) && $exception->getMessage() ? $exception->getMessage() : 'Please log in to your account first to access this page.')
