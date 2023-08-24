@extends('templates.master')

@section('main-content')

<div class="row">
    <div class="col">
        <h1>Formulario: TEMA</h1>
        <hr>
    </div>
</div>

<div class="row">
    @foreach($tematica->preguntas as $num => $pregunta)
    @php
        $respuestas = [$pregunta->respuesta_corr, $pregunta->respuesta_inc1, $pregunta->respuesta_inc2, $pregunta->respuesta_inc3];
        shuffle($respuestas);
    @endphp
    
    <div class="col-12 bg-white mb-3 rounded py-3 px-3">
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
                    <input class="form-check-input" type="radio" name="pregunta_{{$pregunta->pregunta_id}}" id="pregunta_{{$pregunta->pregunta_id}}_opcion{{$index+1}}">
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
        <div class="col text-center">
            <button type="submit" class="btn btn-primary">Terminar</button>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h1>Material de estudio</h1>
            <hr>
        </div>
    </div>

    <div class="col-12 bg-white mb-3 rounded py-3 px-3">

    </div>

</div>

@endsection
