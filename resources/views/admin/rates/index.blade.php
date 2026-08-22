@extends('adminlte::page')

@section('title', 'Tarifas')

@section('content_header')
    <h1>Tabla de Tarifas</h1>
@stop

@section('content')
    <x-adminlte-card title="Tarifas" theme="primary" icon="fas fa-fw fa-money-bill-wave">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Zona</th>
                        <th>Tipo de Permiso</th>
                        <th class="text-center">Peso Máx. (kg)</th>
                        <th>Lado de Calle</th>
                        <th class="text-right">Precio Base</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rates as $rate)
                        <tr>
                            <td>{{ $rate->id }}</td>
                            <td>{{ $rate->zone->name ?? '—' }}</td>
                            <td>{{ $rate->permit_type }}</td>
                            <td class="text-center">{{ $rate->max_weight_kg ?? '—' }}</td>
                            <td>{{ $rate->street_side ?? '—' }}</td>
                            <td class="text-right">${{ number_format($rate->base_price, 2) }}</td>
                            <td class="text-center">
                                <a href="{{ route('rates.edit', $rate) }}" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('rates.destroy', $rate) }}" class="d-inline"
                                    onsubmit="return confirm('¿Está seguro de eliminar esta tarifa?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No hay tarifas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $rates->links() }}
        </div>

        <div class="card-footer">
            <a href="{{ route('rates.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Nueva Tarifa
            </a>
        </div>
    </x-adminlte-card>
@stop
