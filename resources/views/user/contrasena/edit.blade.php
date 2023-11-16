@extends('templates.master')

@section('main-content')
<div class="row align-items-center justify-content-center h-100">
    <div class="col-md-6">
        <div class="card bg-white">
            <div class="card-body">
                <h2 class="card-title text-center font-weight-bold my-3"> Restablecer contraseña </h5>
                    @if ($errors->any())
                    <div class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                        <div class="row">
                            <span>- {{ $error }}</span>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    <form method="POST" action="{{ route('user.contrasena.update') }}">
                        @csrf
                        @method('put')
                        <div class="form-group my-4">
                            <label for="password-actual"> Contraseña Actual </label>
                            <input type="password" class="form-control mt-2" name="password_actual" id="password_actual">
                        </div>
                        <div class="form-group my-4">
                            <label for="password_nueva"> Nueva contraseña </label>
                            <input type="password" class="form-control mt-2" name="password" id="password">
                        </div>
                        <div class="form-group my-4">
                            <label for="password_confirmation"> Confirmar contraseña </label>
                            <input type="password" class="form-control mt-2" name="password_confirmation" id="password_confirmation">
                        </div>
                        <div class="row">
                            <div class="col-6 text-center">
                                <button type="submit" class="btn btn-success text-white mt-3 mb-3"> Restablecer </button>
                            </div>
                            <div class="col-6 text-center">
                                <a href="{{ route('home.index') }}" class="btn btn-dark text-white mt-3 mb-3"> Volver </a>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
