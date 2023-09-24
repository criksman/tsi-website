@extends('templates.home')

@section('main-content')

<div class="row align-items-center justify-content-center h-100">
    <div class="col-md-6">
        <div class="card bg-white">
            <div class="card-body">
                <h2 class="card-title text-center font-weight-bold my-3">Registro</h5>
                    @if(session('successRegistro'))
                    <div class="alert alert-success">
                        {{ session('successRegistro') }}
                    </div>
                    @endif
                    
                    @if ($errors->any())
                    <div class="text-start alert alert-warning">
                        @foreach ($errors->all() as $error)
                        <div class="row">
                            <span>- {{ $error }}</span>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    <form method="POST" action="{{ route('user.store') }}">
                        <div class="form-group my-3">
                            <label for="usuario">Nombre de usuario</label>
                            <input type="text" class="form-control mt-2" id="username" name="username">
                        </div>
                        <div class="form-group my-3">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control mt-2" id="email" name="email">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control mt-2" id="password" name="password">
                        </div>
                        @csrf
                        <div class="row">
                            <div class="col-6 text-center">
                                <button type="submit" class="btn btn-secondary text-white mt-3 mb-3">Crear cuenta</button>
                            </div>
                            <div class="col-6 text-center">
                                <a href="{{ route("home.login") }}" class="btn btn-primary text-white mt-3 mb-3"> Volver </a>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>

@endsection