@extends('errors.layout')

@section('code', '503')
@section('title', 'Service Maintenance')
@section('message', isset($exception) && $exception->getMessage() ? $exception->getMessage() : 'The system is currently undergoing scheduled maintenance. Please check back shortly.')
