@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Dilarang'))
@section('button')
    <img src="{{ asset('assets/img/errors.svg') }}" alt="not found" class="img-fluid" style="width: 50%">
@endsection
