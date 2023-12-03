@extends('templates.master')

@section('main-content')

<div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-xl-9">

        <h1 class="mb-4">Editar Enunciado/Respuestas</h1>

        <div class="card shadow" style="border-radius: 15px;">
            <div class="card-body">
                @if(session('successEnunciadoResp'))
                <div class="alert alert-success">
                    {{ session('successEnunciadoResp') }}
                </div>
                @endif
                @if(session('errorEnunciadoResp'))
                <div class="alert alert-danger">
                    {{ session('errorEnunciadoResp') }}
                </div>
                @endif
                {{-- @if ($errors->EditarPreguntaBag->any())
                <div class="text-start alert alert-warning">
                    @foreach ($errors->EditarPreguntaBag->all() as $error)
                    <div class="row">
                        <span>- {{ $error }}</span>
            </div>
            @endforeach
        </div>
        <hr class="mx-n3">
        @endif --}}

        <form method="POST" action="{{ route('pregunta.updateDetalles', $pregunta->pregunta_id) }}">
            @method('put')
            @csrf
            <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">

                    <h6 class="mb-0">Enunciado</h6>

                </div>
                <div class="col-md-9 pe-5">

                    <textarea class="form-control @error('enunciado', 'EditarPreguntaBag') is-invalid @enderror" rows="3" placeholder="{{$pregunta->enunciado}}" name="enunciado"></textarea>
                    @error('enunciado', 'EditarPreguntaBag')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <hr class="mx-n3">

            <div class="row align-items-center pt-4 pb-3">

                <div class="col-md-3 ps-5">

                    <h6 class="mb-0">1. (Respuesta correcta)</h6>

                </div>
                <div class="col-md-9 pe-5">

                    <input type="text" class="form-control form-control-lg @error('respuesta_corr', 'EditarPreguntaBag') is-invalid @enderror" name="respuesta_corr" placeholder="{{$pregunta->respuesta_corr}}" />
                    @error('respuesta_corr', 'EditarPreguntaBag')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-3 ps-5 mt-2">

                    <h6 class="mb-0">2.</h6>

                </div>
                <div class="col-md-9 pe-5 mt-2">

                    <input type="text" class="form-control form-control-lg @error('respuesta_corr', 'EditarPreguntaBag') is-invalid @enderror" name="respuesta_inc1" placeholder="{{$pregunta->respuesta_inc1}}" />
                    @error('respuesta_inc1', 'EditarPreguntaBag')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-3 ps-5">

                    <h6 class="mb-0">3.</h6>

                </div>
                <div class="col-md-9 pe-5 mt-2">

                    <input type="text" class="form-control form-control-lg @error('respuesta_inc2', 'EditarPreguntaBag') is-invalid @enderror" name="respuesta_inc2" placeholder="{{$pregunta->respuesta_inc2}}" />
                    @error('respuesta_inc2', 'EditarPreguntaBag')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="col-md-3 ps-5">

                    <h6 class="mb-0">4.</h6>

                </div>
                <div class="col-md-9 pe-5 mt-2">

                    <input type="text" class="form-control form-control-lg @error('respuesta_inc3', 'EditarPreguntaBag') is-invalid @enderror" name="respuesta_inc3" placeholder="{{$pregunta->respuesta_inc3}}" />
                    @error('respuesta_inc3', 'EditarPreguntaBag')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row p-3">
                <div class="col-9 d-grid text-center mt-3">
                    <button type="submit" class="btn btn-secondary">Aplicar cambios</button>
                </div>
                <div class="col-3 d-grid text-center mt-3">
                    <a href="{{ route('admin.edit_tematica', $tematica->tematica_id) }}" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </form>
    </div>
</div>

</div>
</div>

<div class="row d-flex justify-content-center align-items-center h-100 mt-4">
    <div class="col-xl-9">

        <h1 class="mb-4">Editar audio</h1>

        <div class="card shadow" style="border-radius: 15px;">
            <div class="card-body">
                @if(session('successFoto'))
                <div class="alert alert-success">
                    {{ session('successFoto') }}
                </div>
                @endif
                {{-- @if ($errors->EditarPreguntaAudioBag->any())
                <div class="text-start alert alert-warning">
                    @foreach ($errors->EditarPreguntaAudioBag->all() as $error)
                    <div class="row">
                        <span>- {{ $error }}</span>
            </div>
            @endforeach
        </div>
        <hr class="mx-n3">
        @endif --}}
        <div class="row align-items-center py-3">
            <div class="col-md-3 ps-5">

                <h6 class="mb-0">Subir archivo de audio</h6>

            </div>
            <div class="col-md-9 pe-5">
                <form method="POST" action="{{ route('pregunta.updateAudio', $pregunta->pregunta_id) }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input class="form-control form-control-lg @error('audio', 'EditarPreguntaAudioBag') is-invalid @enderror" id="audio" name="audio" type="file" />
                    @error('audio', 'EditarPreguntaAudioBag')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="small text-muted mt-2">@if($pregunta->audio != null) Archivo actual: {{$pregunta->audio}} @else Actualmente la pregunta no tiene un archivo de audio asociado (se considera como una pregunta para la sección escrita)@endif</div>

            </div>
        </div>

        <hr class="mx-n3">

        <div class="row">
            {{-- <div class="row">
                    <div class="col-6 d-flex justify-content-center">
                        <button type="submit" class="btn btn-secondary btn-lg">Subir audio</button>
                        </form>
                    </div>
                    <div class="col-6 d-flex justify-content-center">
                        <form method="POST" action="{{ route('pregunta.deleteAudio', $pregunta->pregunta_id) }}">
            @method('put')
            @csrf
            <button type="submit" class="btn btn-danger btn-lg text-white">Eliminar actual</button>
            </form>
        </div>
    </div> --}}

    <div class="row p-3">
        <div class="col-9 d-grid text-center mt-3">
            <button type="submit" class="btn btn-secondary">Subir audio</button>
            </form>
        </div>
        <div class="col-3 d-grid text-center mt-3">
            <form method="POST" action="{{ route('pregunta.deleteAudio', $pregunta->pregunta_id) }}">
                @method('put')
                @csrf
                <button type="submit" class="btn btn-danger text-white">Eliminar actual</button>
            </form>
        </div>
    </div>
</div>

</div>
</div>

</div>
</div>
@endsection
