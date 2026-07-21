@extends('errors.layout')

@section('code', '403')
@section('title', 'Access Denied')
@section('message', isset($exception) && $exception->getMessage() ? $exception->getMessage() : 'Sorry, you do not have permission to access this page.')
