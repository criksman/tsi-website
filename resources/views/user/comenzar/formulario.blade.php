@extends('templates.master')

@section('main-content')

<div class="row">
    <div class="col">
        <h1>Formulario: {{$tematica->nombre}}</h1>
        <hr>
    </div>
</div>

@php
$usuario = Auth::user();
$tematica_id = $tematica->tematica_id;

$progreso = DB::table('tematica_user')
->where('user_id', $usuario->user_id)
->where('tematica_id', $tematica_id)
->first();

//$progreso = Auth::user()->tematicas()->where('tematica_user.tematica_id', $tematica->tematica_id)->first();
@endphp

<p>Última vez realizada:
    @if ($progreso && $progreso->submitted_at)
    {{ Carbon\Carbon::parse($progreso->submitted_at)->format('d-m-Y H:i:s') }}
    @else
    No se ha realizado antes
    @endif
</p>

<p>

    @if (!$progreso || !$progreso->submitted_at || Carbon\Carbon::parse($progreso->submitted_at)->diffInSeconds() > 30)

    <form method="POST" action="{{route('user.comenzar.calcularResultado', $tematica->tematica_id)}}" autocomplete="off" id="formulario">
        @method('put')
        @csrf
        <div class="row">
            @php
            $preguntas = $tematica->preguntas->shuffle();
            @endphp

            @foreach($preguntas as $num => $pregunta)

            @php
            $respuestas = [$pregunta->respuesta_corr, $pregunta->respuesta_inc1, $pregunta->respuesta_inc2, $pregunta->respuesta_inc3];
            shuffle($respuestas);
            @endphp


            <div class="col-12 bg-white mb-3 rounded py-3 px-3 shadow">
                <div class="row">
                    <div class="col-11">
                        <b>{{ $pregunta->enunciado }}</b>
                    </div>

                    @if ($pregunta->audio != null)
                    <div class="col mt-3">
                        <audio controls>
                            <source src="{{ asset('storage/documentos/audio/preguntas/' . $pregunta->pregunta_id . '/' . $pregunta->audio) }}" type="audio/mpeg">
                        </audio>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col mt-2">

                        @foreach($respuestas as $index => $respuesta)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pregunta_{{$pregunta->pregunta_id}}" id="pregunta_{{$pregunta->pregunta_id}}_opcion{{$index+1}}" value="{{$respuesta}}">
                            <label class="form-check-label" for="pregunta_{{$pregunta->pregunta_id}}_opcion{{$index+1}}">
                                {{$respuesta}}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach

            <div class="row">
                <div class="col  text-center">
                    <button type="submit" class="btn btn-secondary text-white shadow"> Terminar </button>
                </div>
            </div>
        </div>
    </form>
    @else

    <div class="row">
        <div class="col-12 bg-white mb-3 rounded py-3 px-3 d-flex align-items-center justify-content-center">
            <p>
                <h3>Espere 30 segundos para volver a realizar el formulario.</h3>
                <p>
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <a href="{{ route('user.comenzar.list_tematicas.from_formulario' , $tematica->tematica_id) }}" class="btn btn-primary"> Volver </a>
        </div>
    </div>

    @endif

    <div class="row">
        <div class="col">
            <h1>Material de estudio</h1>
            <hr>
        </div>
    </div>

    <div class="col-12 bg-white mb-3 rounded py-3 px-3 shadow">
        @foreach($tematica->enlaces as $enlace)
        <div class="row">
            <div class="col">
                <span class="me-3">- <a href="{{ $enlace->link }}"> {{ $enlace->descripcion }} </a> </span>
            </div>
        </div>
        @endforeach
    </div>

    <script>
        window.addEventListener("pageshow", function(event) {
            var historyTraversal = event.persisted ||
                (typeof window.performance != "undefined" &&
                    window.performance.navigation.type === 2);
            if (historyTraversal) {
                // Handle page restore.
                window.location.reload();
            }
        });

    </script>
    @endsection
