@extends('errors.layout')

@section('code', '500')
@section('title', 'Server Error')
@section('message', isset($exception) && $exception->getMessage() ? $exception->getMessage() : 'An internal server error occurred. Please try again later.')
