@extends('adminlte::page')

@section('title', 'Detalle de Permiso')

@section('content_header')
    <h1>Detalle de Permiso #{{ $permit->id }}</h1>
@stop

@section('content')
    @if (session('success'))
        <x-adminlte-alert theme="success" title="¡Éxito!">{{ session('success') }}</x-adminlte-alert>
    @endif

    <x-adminlte-card title="Información del Permiso" theme="info" icon="fas fa-fw fa-file-alt">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tracking_code">Código de Seguimiento</label>
                    <input type="text" id="tracking_code" class="form-control" value="{{ $permit->tracking_code }}" readonly>
                </div>
                <div class="form-group">
                    <label for="permit_type">Tipo de Permiso</label>
                    <input type="text" id="permit_type" class="form-control" value="{{ $permit->permit_type }}" readonly>
                </div>
                <div class="form-group">
                    <label for="request_date">Fecha de Solicitud</label>
                    <input type="text" id="request_date" class="form-control" value="{{ $permit->request_date->format('d/m/Y') }}" readonly>
                </div>
                <div class="form-group">
                    <label for="start_date">Fecha de Inicio</label>
                    <input type="text" id="start_date" class="form-control" value="{{ $permit->start_date->format('d/m/Y') }}" readonly>
                </div>
                <div class="form-group">
                    <label for="end_date">Fecha de Fin</label>
                    <input type="text" id="end_date" class="form-control" value="{{ $permit->end_date ? $permit->end_date->format('d/m/Y') : '—' }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="zone">Zona</label>
                    <input type="text" id="zone" class="form-control" value="{{ $permit->zone->name ?? '—' }}" readonly>
                </div>
                <div class="form-group">
                    <label for="applicant">Solicitante</label>
                    <input type="text" id="applicant" class="form-control" value="{{ $permit->applicant->name ?? '—' }}" readonly>
                </div>
                <div class="form-group">
                    <label for="vehicle_weight_kg">Peso del Vehículo (kg)</label>
                    <input type="text" id="vehicle_weight_kg" class="form-control" value="{{ $permit->vehicle_weight_kg ?? '—' }}" readonly>
                </div>
                <div class="form-group">
                    <label for="license_plate">Patente</label>
                    <input type="text" id="license_plate" class="form-control" value="{{ $permit->license_plate ?? '—' }}" readonly>
                </div>
                <div class="form-group">
                    <label for="street_side">Lado de Calle</label>
                    <input type="text" id="street_side" class="form-control" value="{{ $permit->street_side ?? '—' }}" readonly>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="operations_count">Cantidad de Operaciones</label>
                    <input type="text" id="operations_count" class="form-control" value="{{ $permit->operations_count }}" readonly>
                </div>
                <div class="form-group">
                    <label for="calculated_amount">Monto Calculado</label>
                    <input type="text" id="calculated_amount" class="form-control" value="${{ number_format($permit->calculated_amount, 2) }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">Estado Actual</label>
                    <input type="text" id="status" class="form-control"
                        value="@php
                            $statusLabel = ['pending' => 'Pendiente', 'approved' => 'Aprobado', 'rejected' => 'Rechazado', 'expired' => 'Vencido'];
                            echo $statusLabel[$permit->status->value] ?? $permit->status->value;
                        @endphp" readonly>
                </div>
                <div class="form-group">
                    <label for="is_paid">¿Pagado?</label>
                    <input type="text" id="is_paid" class="form-control" value="{{ $permit->is_paid ? 'Sí' : 'No' }}" readonly>
                </div>
            </div>
        </div>

        @if ($permit->notes)
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="notes">Notas</label>
                        <textarea id="notes" class="form-control" rows="3" readonly>{{ $permit->notes }}</textarea>
                    </div>
                </div>
            </div>
        @endif

        <hr>

        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-3"><i class="fas fa-cog"></i> Acciones de Estado</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <form method="POST" action="{{ route('permits.status', $permit) }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="approved">
                    <x-adminlte-button type="submit" label="Aprobar" theme="success" icon="fas fa-check"/>
                </form>
            </div>
            <div class="col-md-4">
                <form method="POST" action="{{ route('permits.status', $permit) }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="rejected">
                    <x-adminlte-button type="submit" label="Rechazar" theme="danger" icon="fas fa-times"/>
                </form>
            </div>
            <div class="col-md-4">
                <form method="POST" action="{{ route('permits.status', $permit) }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="is_paid" value="1">
                    <x-adminlte-button type="submit" label="Marcar como Pagado" theme="info" icon="fas fa-dollar-sign"/>
                </form>
            </div>
        </div>
    </x-adminlte-card>

    <div class="mt-3">
        <a href="{{ route('permits.index') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver a Bandeja
        </a>
    </div>
@stop
