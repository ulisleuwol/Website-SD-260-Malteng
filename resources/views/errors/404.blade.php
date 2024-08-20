@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Halaman Yang Anda Cari Tidak Ada'))
@section('button')
    <img src="{{ asset('assets/img/errors.svg') }}" alt="not found" class="img-fluid" style="width: 50%">
@endsection