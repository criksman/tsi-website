@extends('templates.home')

@section('main-content')

<div class="row align-items-center justify-content-center h-100">
    <div class="col-md-6">
        <div class="card bg-white shadow">
            <div class="card-body">
                <h2 class="card-title text-center font-weight-bold my-3">Registro</h5>
                    @if(session('successRegistro'))
                    <div class="alert alert-success">
                        {{ session('successRegistro') }}
                    </div>
                    @endif

                    {{-- @if ($errors->any())
                    <div class="text-start alert alert-warning">
                        @foreach ($errors->all() as $error)
                        <div class="row">
                            <span>- {{ $error }}</span>
            </div>
            @endforeach
        </div>
        @endif --}}
        <form method="POST" action="{{ route('user.store') }}">
            <div class="form-group my-3">
                <label for="username">Nombre de usuario</label>
                <input type="text" class="form-control mt-2 @error('username') is-invalid @enderror" id="username" name="username">
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group my-3">
                <label for="email">E-mail</label>
                <input type="email" class="form-control mt-2 @error('email') is-invalid @enderror" id="email" name="email">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control mt-2 @error('password') is-invalid @enderror" id="password" name="password">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            @csrf
            <div class="row">
                <div class="col-9 d-grid text-center mt-3">
                    <button type="submit" class="btn btn-secondary"> Registrarse </button>
                </div>
                <div class="col-3 d-grid text-center mt-3">
                    <a href="{{ route('home.login') }}" class="btn btn-primary"> Volver </a>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>

@endsection
