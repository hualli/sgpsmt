@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <p>Bienvenido, {{ Auth::user()->name }}. Este es tu panel de inicio.</p>
        </div>
    </div>
@endsection