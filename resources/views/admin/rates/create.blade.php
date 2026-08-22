@extends('adminlte::page')

@section('title', 'Crear Tarifa')

@section('content_header')
    <h1>Crear Tarifa</h1>
@stop

@section('content')
    <x-adminlte-card title="Nueva Tarifa" theme="success" icon="fas fa-fw fa-plus-circle">
        <form method="POST" action="{{ route('rates.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-select name="zone_id" label="Zona" required>
                        <option value="">Seleccionar zona</option>
                        @foreach ($zones as $zone)
                            <option value="{{ $zone->id }}" {{ old('zone_id') == $zone->id ? 'selected' : '' }}>
                                {{ $zone->name }}
                            </option>
                        @endforeach
                    </x-adminlte-select>
                </div>
                <div class="col-md-6">
                    <x-adminlte-input name="permit_type" label="Tipo de Permiso" placeholder="Ej: Carga/Descarga" required />
                </div>
                <div class="col-md-6">
                    <x-adminlte-input name="max_weight_kg" label="Peso Máximo (kg)" type="number" min="0" />
                </div>
                <div class="col-md-6">
                    <x-adminlte-input name="street_side" label="Lado de Calle" placeholder="right, left, circulation" />
                </div>
                <div class="col-md-6">
                    <x-adminlte-input name="base_price" label="Precio Base" type="number" step="0.01" min="0" required />
                </div>
            </div>

            <x-adminlte-button type="submit" label="Guardar Tarifa" theme="success" icon="fas fa-save"/>
            <a href="{{ route('rates.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Cancelar
            </a>
        </form>
    </x-adminlte-card>
@stop
