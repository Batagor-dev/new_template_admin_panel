@extends('errors.layout')

@section('code', '404')
@section('title', 'Page Not Found')
@section('message', isset($exception) && $exception->getMessage() ? $exception->getMessage() : 'Sorry, the page you are looking for could not be found or has been moved.')
