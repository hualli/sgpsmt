@extends('layouts.public') 

@section('title', 'Bienvenido')

@section('content')
<div class="text-center">
    <h1 class="mb-4">Seleccione una opción para continuar</h1>

    <div style="max-width: 300px; margin: 0 auto;">
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg w-100 mb-3">Acceder al sistema</a>
        <a href="{{ route('permits.create') }}" class="btn btn-success btn-lg w-100 mb-3">Solicitar permiso</a>
        <a href="{{ route('permits.status') }}" class="btn btn-info btn-lg w-100">Consultar estado del permiso</a>
    </div>
</div>
@endsection