@extends('adminlte::page')

@section('title', 'Zonas')

@section('content_header')
    <h1>Gestión de Zonas</h1>
@stop

@section('content')
    <x-adminlte-card title="Zonas" theme="primary" icon="fas fa-fw fa-map-marked-alt">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($zones as $zone)
                        <tr>
                            <td>{{ $zone->id }}</td>
                            <td>{{ $zone->name }}</td>
                            <td>{{ $zone->description ?? '—' }}</td>
                            <td class="text-center">
                                <a href="{{ route('zones.edit', $zone) }}" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('zones.destroy', $zone) }}" class="d-inline"
                                    onsubmit="return confirm('¿Está seguro de eliminar esta zona?');">
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
                            <td colspan="4" class="text-center">No hay zonas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $zones->links() }}
        </div>

        <div class="card-footer">
            <a href="{{ route('zones.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Nueva Zona
            </a>
        </div>
    </x-adminlte-card>
@stop
