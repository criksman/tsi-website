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
    <div class="col-12 bg-white mb-3 rounded py-3 px-3">
        <div class="row">
            <div class="col-11">
                <b>OEOEOEOEJFDHFJSHDJHGOIGHOISDHGOIAGSAHGAHSGAGHJGSDSJHFSHFS</b>
                <button type="button" class="btn btn-warning fa-solid fa-pencil fa-sm p-2" data-bs-toggle="modal" data-bs-target="#enunciadoModal"></button>

                <div class="modal fade" id="enunciadoModal" tabindex="-1" aria-labelledby="enunciadoModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="enunciadoModalLabel">Editar enunciado</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="enunciado-text" class="col-form-label">Ingresar contenido:</label>
                                        <textarea class="form-control" id="enunciado-text"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary">Aplicar Cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-1 text-end">
                <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#borrarModal"></button>

                <div class="modal fade" id="borrarModal" tabindex="-1" aria-labelledby="borrarModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="borrarModalLabel">Borrar pregunta</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                                <p>¿Está seguro que desea borrar la pregunta? Se eliminarán todas las respuestas asociadas.</p>
                            </div>
                            <form>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Eliminar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col">
                <audio controls src="#">
                </audio>
                <button type="button" class="btn btn-warning fa-solid fa-pencil fa-sm p-2" data-bs-toggle="modal" data-bs-target="#audioModal"></button>

                <div class="modal fade" id="audioModal" tabindex="-1" aria-labelledby="audioModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="audioModalLabel">Cambiar archivo de audio</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col my-3">
                                                <input class="form-control form-control-sm" id="audio-thing" type="file">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Subir audio</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col mt-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault3" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Respuesta 1
                    </label>
                    <button type="button" class="btn btn-warning fa-solid fa-pencil fa-sm p-2" data-bs-toggle="modal" data-bs-target="#respuestasModal" data-bs-id="" data-bs-respuesta="Respuesta 2-1"></button>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault3" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Respuesta 2
                    </label>
                    <button type="button" class="btn btn-warning fa-solid fa-pencil fa-sm p-2" data-bs-toggle="modal" data-bs-target="#respuestasModal" data-bs-id="" data-bs-respuesta="Respuesta 2-2"></button>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault3" id="flexRadioDefault3">
                    <label class="form-check-label" for="flexRadioDefault3">
                        Respuesta 3
                    </label>
                    <button type="button" class="btn btn-warning fa-solid fa-pencil fa-sm p-2" data-bs-toggle="modal" data-bs-target="#respuestasModal" data-bs-id="" data-bs-respuesta="Respuesta 2-3"></button>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault3" id="flexRadioDefault4">
                    <label class="form-check-label" for="flexRadioDefault4">
                        Respuesta 4
                    </label>
                    <button type="button" class="btn btn-warning fa-solid fa-pencil fa-sm p-2" data-bs-toggle="modal" data-bs-target="#respuestasModal" data-bs-id="" data-bs-respuesta="Respuesta 2-4"></button>
                </div>
            </div>
        </div>
    </div>


    <div class="col-12 bg-white mb-3 rounded p-3 text-center">
        <button type="button" class="btn btn-primary fa-solid fa-plus" data-bs-toggle="modal" data-bs-target="#crearPreguntaModal"></button> <span> Añadir otra pregunta</span>

        <div class="modal fade" id="crearPreguntaModal" tabindex="-1" aria-labelledby="crearPreguntaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="crearPreguntaModalLabel">Creación de pregunta</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
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

    </div>
</div>
</div>


<div class="modal fade" id="respuestasModal" tabindex="-1" aria-labelledby="respuestasModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="respuestasModalLabel">Editar respuesta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Ingresar contenido:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Aplicar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>

<script>
    const respuestasModal = document.getElementById('respuestasModal');
    if (respuestasModal) {
        respuestasModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const respuestaText = button.getAttribute('data-bs-respuesta'); // Get the respuesta text from the data-bs-whatever attribute
            //const respuestaId = button.getAttribute('data-bs-respuestaid'); Necesitamos mejorar la base datos para esto

            // Update the modal's content.
            const modalBodyInput = respuestasModal.querySelector('#message-text'); // Use the ID attribute of the textarea
            modalBodyInput.value = respuestaText; // Set the textarea value to the respuesta text
        });
    }

</script>
@endsection
