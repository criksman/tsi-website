@extends('templates.master')

@section('main-content')
<div class="row">
    <div class="col-12">
        <h1>Edición de temática: {{$tematica->nombre}}</h1>
    </div>
</div>
<hr class="mt-2">
<div class="row my-3">
    <div class="col-lg-7 col-sm-12 p-4 bg-white rounded">
        <div class="row">
            <div class="col mb-3">
                <h4>Detalles</h4>
            </div>
        </div>
        @if ($errors->EditarTematicaDetallesBag->any())
        <div class="text-start alert alert-warning">
            @foreach ($errors->EditarTematicaDetallesBag->all() as $error)
            <div class="row">
                <span>- {{ $error }}</span>
            </div>
            @endforeach
        </div>
        @endif
        <form method="POST" action="{{ route('tematica.updateDetalles', $tematica->tematica_id) }}">
            @method('put')
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="{{$tematica->nombre}}">
                    </div>
                </div>
                <div class="col-6">
                    <label for="seccion_id" class="form-label">Seccion</label>
                    <select class="form-select" aria-label="Default select example" id="seccion_id" name="seccion_id">
                        <option value="1" @if($tematica->seccion_id == 1) selected @endif>Escrito</option>
                        <option value="2" @if($tematica->seccion_id == 2) selected @endif>Listening</option>
                    </select>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder={{$tematica->descripcion}}></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col d-grid">
                    <button type="submit" class="btn btn-success text-white">Aplicar Cambios</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-1 d-sm-none d-lg-block"></div>
    <div class="col-lg-4 col-sm-12 mt-lg-0 mt-sm-3 p-4 bg-white rounded">
        <div class="row">
            <div class="col mb-3">
                <h4>Subir foto</h4>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <img src="{{ asset('storage/documentos/img/tematicas/' . $tematica->tematica_id . '/' . $tematica->foto) }}" alt="Sin Imágen" class="img-fluid" style="height: 200px;">
            </div>
        </div>
        @if ($errors->EditarTematicaFotoBag->any())
        <div class="text-start alert alert-warning">
            @foreach ($errors->EditarTematicaFotoBag->all() as $error)
            <div class="row">
                <span>- {{ $error }}</span>
            </div>
            @endforeach
        </div>
        @endif
        <form method="POST" action="{{ route('tematica.updateFoto', $tematica->tematica_id) }}" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row">
                <div class="col-9 my-3">
                    <input class="form-control form-control-sm" id="formFileSm" name="foto" type="file" accept=".png, .jpeg, .jpg">
                </div>
                <div class="col-3 my-3 text-center">
                    <button type="submit" class="btn btn-success text-white fa-solid fa-upload"></button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    @foreach($tematica->preguntas as $pregunta)
    <div class="col-12 bg-white mb-3 rounded py-3 px-3">
        <div class="row">
            <div class="col-11">
                <b>{{$pregunta->enunciado}}</b>
            </div>

            <div class="col-1 text-end">
                <a href="{{ route('admin.edit_pregunta', [$tematica->tematica_id, $pregunta->pregunta_id]) }}" class="btn btn-info fa-solid fa-gear fa-sm p-2"></a>

                <button type="button" class="btn btn-danger fa-solid fa-trash fa-sm p-2 text-white" data-bs-toggle="modal" data-bs-target="#borrarModal{{$pregunta->pregunta_id}}"></button>

                <div class="modal fade" id="borrarModal{{$pregunta->pregunta_id}}" tabindex="-1" aria-labelledby="borrarModalLabel{{$pregunta->pregunta_id}}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="borrarModalLabel{{$pregunta->pregunta_id}}">Borrar pregunta</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                                <p>¿Está seguro que desea borrar la pregunta? Se eliminarán todas las respuestas asociadas.</p>
                            </div>
                            <form method="POST" action="{{ route('pregunta.destroy', $pregunta->pregunta_id) }}">
                                @method('delete')
                                @csrf
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Eliminar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

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
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_{{$pregunta->pregunta_id}}" id="pregunta_{{$pregunta->pregunta_id}}_opcion1">
                    <label class="form-check-label" for="pregunta_{{$pregunta->pregunta_id}}_opcion1">
                        {{$pregunta->respuesta_corr}}
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_{{$pregunta->pregunta_id}}" id="pregunta_{{$pregunta->pregunta_id}}_opcion2">
                    <label class="form-check-label" for="pregunta_{{$pregunta->pregunta_id}}_opcion2">
                        {{$pregunta->respuesta_inc1}}
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_{{$pregunta->pregunta_id}}" id="pregunta_{{$pregunta->pregunta_id}}_opcion3">
                    <label class="form-check-label" for="pregunta_{{$pregunta->pregunta_id}}_opcion3">
                        {{$pregunta->respuesta_inc2}}
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pregunta_{{$pregunta->pregunta_id}}" id="pregunta_{{$pregunta->pregunta_id}}_opcion4">
                    <label class="form-check-label" for="pregunta_{{$pregunta->pregunta_id}}_opcion4">
                        {{$pregunta->respuesta_inc3}}
                    </label>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="col-12 bg-white mb-3 rounded p-3 text-center">
        <button type="button" class="btn btn-secondary fa-solid fa-plus" data-bs-toggle="modal" data-bs-target="#crearPreguntaModal"></button> <span> Añadir otra pregunta</span>

        <div class="modal fade" id="crearPreguntaModal" tabindex="-1" aria-labelledby="crearPreguntaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="crearPreguntaModalLabel">Creación de pregunta</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    @if ($errors->CrearPreguntaBag->any())
                    <div class="text-start alert alert-warning">
                        @foreach ($errors->CrearPreguntaBag->all() as $error)
                        <div class="row">
                            <span>- {{ $error }}</span>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <form method="POST" action="{{ route('pregunta.store', $tematica->tematica_id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="enunciado" class="col-form-label">Enunciado</label>
                                    <textarea class="form-control" id="enunciado" name="enunciado"></textarea>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="audio" class="form-label">Archivo de audio (opcional)</label>
                                    <input class="form-control form-control-sm" id="audio" name="audio" type="file" accept=".mp3">
                                </div>
                                <div class="row">
                                    <div class="col mb-1">
                                        <h4><b>Respuestas</b></h4>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-1 text-center d-flex flex-column align-items-center justify-content-center">
                                        <b>1. </b>
                                    </div>
                                    <div class="col-10">
                                        <input type="text" class="form-control col-7" id="respuesta_corr" name="respuesta_corr" placeholder="RESPUESTA CORRECTA">
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-1 d-flex flex-column align-items-center justify-content-center">
                                        <b>2. </b>
                                    </div>
                                    <div class="col-10">
                                        <input type="text" class="form-control col-7" id="respuesta_inc1" name="respuesta_inc1" placeholder="RESPUESTA INCORRECTA">
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-1 d-flex flex-column align-items-center justify-content-center">
                                        <b>3. </b>
                                    </div>
                                    <div class="col-10">
                                        <input type="text" class="form-control col-7" id="respuesta_inc2" name="respuesta_inc2" placeholder="RESPUESTA INCORRECTA">
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-1 d-flex flex-column align-items-center justify-content-center">
                                        <b>4. </b>
                                    </div>
                                    <div class="col-10">
                                        <input type="text " class="form-control col-7" id="respuesta_inc3" name="respuesta_inc3" placeholder="RESPUESTA INCORRECTA">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h1>Material de estudio</h1>
            <hr>
        </div>
    </div>

    <div class="col-12 bg-white mb-3 rounded py-3 px-3">
        @foreach($tematica->enlaces as $enlace)
            <div class="row">
                <div class="col">
                    <span class="me-3">- <a href="{{ $enlace->link }}"> {{ $enlace->descripcion }} </a> </span>

                    <button type="button" class="btn btn-danger fa-solid fa-trash fa-sm p-2 text-white" data-bs-toggle="modal" data-bs-target="#borrarEnlaceModal{{$enlace->enlace_id}}"></button>

                    <div class="modal fade" id="borrarEnlaceModal{{$enlace->enlace_id}}" tabindex="-1" aria-labelledby="borrarEnlaceModalLabel{{$enlace->enlace_id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="borrarEnlaceModalLabel{{$enlace->enlace_id}}">Borrar enlace</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <p>¿Está seguro que desea borrar el enlace?</p>
                                </div>
                                <form method="POST" action="{{ route('enlace.destroy', $enlace->enlace_id) }}">
                                    @method('delete')
                                    @csrf
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Eliminar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="row">
            <div class="col text-center">
                <button type="button" class="btn btn-secondary fa-solid fa-plus" data-bs-toggle="modal" data-bs-target="#crearMaterialModal"></button> <span> Añadir enlace (Material de estudio)</span>
            </div>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="crearMaterialModal" tabindex="-1" aria-labelledby="crearMaterialModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="crearMaterialModalLabel">Ingresar Material de estudio</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @if ($errors->CrearEnlacesBag->any())
                <div class="text-start alert alert-warning">
                    @foreach ($errors->CrearEnlacesBag->all() as $error)
                    <div class="row">
                        <span>- {{ $error }}</span>
                    </div>
                    @endforeach
                </div>
                @endif
                <form method="POST" action="{{ route('enlace.store', $tematica->tematica_id) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="col">
                            <div class="mb-3">
                                <label for="link" class="form-label">Link</label>
                                <input type="text" class="form-control" id="link" name="link" placeholder="Ingrese el link">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection
