@extends('templates.home')

@section('main-content')

<div class="row align-items-center justify-content-center h-100">
    <div class="col-md-6">
        <div class="card bg-white shadow">
            <div class="card-body">
                <h2 class="card-title text-center font-weight-bold my-3"> Restablecer contraseña </h5>
                    <form method="POST" action="{{ route('home.contrasena.updateContrasena', $usuario->user_id) }}">
                        @csrf
                        <div class="form-group my-4">
                            <label for="username"> Nombre de usuario</label>
                            <input type="text" class="form-control mt-2 @error('username') is-invalid @enderror" id="username" name="username">
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group my-4">
                            <label for="password"> Nueva contraseña </label>
                            <input type="password" class="form-control mt-2 @error('password') is-invalid @enderror" id="password" name="password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group my-4">
                            <label for="password_confirmation"> Confirmar contraseña </label>
                            <input type="password" class="form-control mt-2 @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-9 d-grid text-center mt-3">
                                <button type="submit" class="btn btn-secondary"> Restablecer </button>
                            </div>
                            <div class="col-3 d-grid text-center mt-3">
                                <a href="{{ route('home.contrasena.validar_email') }}" class="btn btn-primary"> Volver </a>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>

@endsection
