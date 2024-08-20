@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Halaman Kadaluarsa'))
@section('button')
    <img src="{{ asset('assets/img/errors.svg') }}" alt="not found" class="img-fluid" style="width: 50%">
@endsection
