@extends('adminlte::page')

@section('title', 'Editar Zona')

@section('content_header')
    <h1>Editar Zona</h1>
@stop

@section('content')
    <x-adminlte-card title="Editar Zona" theme="warning" icon="fas fa-fw fa-edit">
        <form method="POST" action="{{ route('zones.update', $zone) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <x-adminlte-input name="name" label="Nombre" value="{{ $zone->name }}" required />
                </div>
                <div class="col-md-12">
                    <x-adminlte-textarea name="description" label="Descripción" rows="3">{{ $zone->description }}</x-adminlte-textarea>
                </div>
            </div>

            <x-adminlte-button type="submit" label="Actualizar Zona" theme="primary" icon="fas fa-save"/>
            <a href="{{ route('zones.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Cancelar
            </a>
        </form>
    </x-adminlte-card>
@stop
