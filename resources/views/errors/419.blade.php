@extends('errors.layout')

@section('code', '419')
@section('title', 'Session Expired')
@section('message', isset($exception) && $exception->getMessage() ? $exception->getMessage() : 'Your session has expired due to inactivity. Please refresh the page.')
