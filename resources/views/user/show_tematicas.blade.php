@extends('templates.master')

@section('main-content')

@foreach($secciones as $seccion)
<div class="row">
    <div class="col">
        <h1>Seccion: {{ $seccion->nombre }}</h1>
        <hr>
    </div>
</div>

<div class="row">
    @foreach($tematicas->where('seccion_id', $seccion->seccion_id)->where('estado', true) as $tematica)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <img src="{{ asset('storage/documentos/img/tematicas/' . $tematica->tematica_id . '/' . $tematica->foto) }}" class="card-img-top img-fluid" style="height: 200px;" alt="">
            <div class="card-body">
                <h5 class="card-title">{{$tematica->nombre}}</h5>
                <p class="card-text">{{$tematica->descripcion}}</p>
                <div class="progress mb-3">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75% Correcto</div>
                </div>
                <div class="row">
                    <div class="col d-grid mt-3">
                        <a href="#" class="btn btn-secondary text-white">Empezar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endforeach
@endsection
