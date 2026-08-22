@extends('adminlte::page')

@section('title', 'Bandeja de Permisos')

@section('content_header')
    <h1>Bandeja de Permisos</h1>
@stop

@section('content')
    <x-adminlte-card title="Permisos" theme="primary" icon="fas fa-fw fa-inbox">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Código de Seguimiento</th>
                        <th>Solicitante</th>
                        <th>Zona</th>
                        <th>Tipo</th>
                        <th>Fecha Solicitud</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Pagado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permits as $permit)
                        <tr>
                            <td>{{ $permit->id }}</td>
                            <td>{{ $permit->tracking_code }}</td>
                            <td>{{ $permit->applicant->name ?? '—' }}</td>
                            <td>{{ $permit->zone->name ?? '—' }}</td>
                            <td>{{ $permit->permit_type }}</td>
                            <td>{{ $permit->request_date->format('d/m/Y') }}</td>
                            <td class="text-center">
                                @php
                                    $statusLabel = [
                                        'pending' => 'Pendiente',
                                        'approved' => 'Aprobado',
                                        'rejected' => 'Rechazado',
                                        'expired' => 'Vencido',
                                    ];
                                    $statusColor = [
                                        'pending' => 'warning',
                                        'approved' => 'success',
                                        'rejected' => 'danger',
                                        'expired' => 'secondary',
                                    ];
                                    $status = $permit->status->value;
                                @endphp
                                <span class="badge bg-{{ $statusColor[$status] }}">
                                    {{ $statusLabel[$status] }}
                                </span>
                            </td>
                            <td class="text-center">
                                {{ $permit->is_paid ? 'Sí' : 'No' }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('permits.show', $permit) }}" class="btn btn-sm btn-info" title="Ver detalle">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No hay permisos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $permits->links() }}
        </div>
    </x-adminlte-card>
@stop

@push('css')
<style>
    .badge.bg-warning { color: #212529; }
</style>
@endpush
