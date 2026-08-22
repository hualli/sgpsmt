@extends('adminlte::page')

@section('title', 'Crear Zona')

@section('content_header')
    <h1>Crear Zona</h1>
@stop

@section('content')
    <x-adminlte-card title="Nueva Zona" theme="success" icon="fas fa-fw fa-plus-circle">
        <form method="POST" action="{{ route('zones.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <x-adminlte-input name="name" label="Nombre" placeholder="Ej: Zona 1" required />
                </div>
                <div class="col-md-12">
                    <x-adminlte-textarea name="description" label="Descripción" rows="3" placeholder="Descripción opcional de la zona"></x-adminlte-textarea>
                </div>
            </div>

            <x-adminlte-button type="submit" label="Guardar Zona" theme="success" icon="fas fa-save"/>
            <a href="{{ route('zones.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Cancelar
            </a>
        </form>
    </x-adminlte-card>
@stop
