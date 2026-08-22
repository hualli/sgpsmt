@extends('adminlte::page')

@section('title', 'Editar Tarifa')

@section('content_header')
    <h1>Editar Tarifa</h1>
@stop

@section('content')
    <x-adminlte-card title="Editar Tarifa" theme="warning" icon="fas fa-fw fa-edit">
        <form method="POST" action="{{ route('rates.update', $rate) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-select name="zone_id" label="Zona" required>
                        @foreach ($zones as $zone)
                            <option value="{{ $zone->id }}" {{ $rate->zone_id == $zone->id ? 'selected' : '' }}>
                                {{ $zone->name }}
                            </option>
                        @endforeach
                    </x-adminlte-select>
                </div>
                <div class="col-md-6">
                    <x-adminlte-input name="permit_type" label="Tipo de Permiso" value="{{ $rate->permit_type }}" required />
                </div>
                <div class="col-md-6">
                    <x-adminlte-input name="max_weight_kg" label="Peso Máximo (kg)" type="number" min="0" value="{{ $rate->max_weight_kg }}"/>
                </div>
                <div class="col-md-6">
                    <x-adminlte-input name="street_side" label="Lado de Calle" value="{{ $rate->street_side }}" />
                </div>
                <div class="col-md-6">
                    <x-adminlte-input name="base_price" label="Precio Base" type="number" step="0.01" min="0" value="{{ $rate->base_price }}" required />
                </div>
            </div>

            <x-adminlte-button type="submit" label="Actualizar Tarifa" theme="primary" icon="fas fa-save"/>
            <a href="{{ route('rates.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Cancelar
            </a>
        </form>
    </x-adminlte-card>
@stop
