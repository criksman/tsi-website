@extends('templates.home')

@section('main-content')

<div class="row align-items-center justify-content-center h-100">
    <div class="col-md-6">
        <div class="card bg-white">
            <div class="card-body">
                <h2 class="card-title text-center font-weight-bold my-3">Restablecer contraseña</h5>
                    <form method="GET" action="{{ route('home.contrasena.edit_contrasena') }}">
                        @csrf
                        <div class="form-group my-4">
                            <label for="email">Ingrese el e-mail del usuario</label>
                            <input type="email" class="form-control mt-2 @error('email') is-invalid @enderror" id="email" name="email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-9 d-grid text-center mt-3">
                                <button type="submit" class="btn btn-secondary"> Buscar </button>
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
