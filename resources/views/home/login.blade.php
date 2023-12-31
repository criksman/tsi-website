@extends('templates.home')

@section('titulo')
<title>Login</title>
@endsection

@section('main-content')
<div class="row align-items-center justify-content-center h-100">
    <div class="col-md-6">
        <div class="card bg-white shadow">
            <div class="card-body">
                <h2 class="card-title text-center font-weight-bold my-3">Inicio de sesión</h5>
                    @if ($errors->any())
                    <div class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                        <div class="row">
                            <span>- {{ $error }}</span>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    <form method="POST" action="{{ route('user.login') }}">
                        @csrf
                        <div class="form-group my-3">
                            <label for="username">Nombre de usuario</label>
                            <input type="text" class="form-control @if($errors->has('username')) is-invalid @endif mt-2" id="username" name="username">
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif mt-2" id="password" name="password">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-secondary text-white mt-3 mb-3">Iniciar Sesión</button>
                        </div>
                    </form>

                    <div class="my-3">
                        <span> ¿No tienes cuenta? <a href="{{ route('home.register') }}"> Regístrate </a></span>
                    </div>
                    <div class="mb-3">
                        <span> ¿Olvidaste tu contraseña? <a href="{{ route('home.contrasena.validar_email') }}"> Restablecela </a></span>
                    </div>
            </div>
        </div>
    </div>
    @endsection
