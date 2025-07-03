@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('title', 'Iniciar sesión')

@section('auth_header', 'Iniciar sesión')

@section('auth_body')
    <form action="{{ route('login') }}" method="POST">
        @csrf

        {{-- Email --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required autofocus value="{{ old('email') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        @error('email')
            <span class="text-danger text-sm">{{ $message }}</span>
        @enderror

        {{-- Password --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        @error('password')
            <span class="text-danger text-sm">{{ $message }}</span>
        @enderror

        {{-- Remember Me --}}
        <div class="row mb-2">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Recordarme</label>
                </div>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
            </div>
        </div>
    </form>
@endsection

@section('auth_footer')
    {{-- Si tenés ruta de registro o recuperación, podés agregar enlaces aquí --}}
    {{-- <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a> --}}
@endsection
