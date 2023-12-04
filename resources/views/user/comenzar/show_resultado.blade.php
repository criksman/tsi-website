@extends('templates.master')

@section('main-content')

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mt-5">
                <div class="card-body text-center shadow">
                    <h1 class="card-title">Resultado: {{$porcentaje}}%</h1>
                    <p class="card-text">¡Has completado el test!</p>
                    <a href="{{ route('user.comenzar.formulario', $tematica->tematica_id) }}" class="btn btn-primary mt-3"> Volver </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection