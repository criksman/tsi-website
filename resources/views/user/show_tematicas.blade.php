@extends('templates.master')

@section('main-content')

@foreach($secciones as $seccion)
<div class="row">
    <div class="col">
        <h1>Enunciados {{ $seccion->nombre }}</h1>
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

                @php
                $user = Auth::user();
                $pivot = $user->tematicasConPivot()->where('tematica_usuario.tematica_id', $tematica->tematica_id)->first();
                @endphp

                <div class="progress mb-3">
                    @if($pivot)
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$pivot->pivot->progreso}}%;" aria-valuenow="{{$pivot->pivot->progreso}}" aria-valuemin="0" aria-valuemax="100">{{$pivot->pivot->progreso}}%</div>
                    @else
                    <div class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    @endif
                </div>
                <div class="row">
                    <div class="col d-grid mt-3">
                        <a href="{{ route('user.show_preguntas', $tematica->tematica_id) }}" class="btn btn-secondary text-white">Empezar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endforeach
@endsection
