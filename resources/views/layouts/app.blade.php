@extends('adminlte::page')

@section('title', 'Panel de control')

@section('content_header')
    <h1 class="m-0 text-dark">@yield('page-title', 'Inicio')</h1>
@endsection

@section('content')
    @yield('content')
@endsection