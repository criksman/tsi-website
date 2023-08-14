@extends('templates.master')

@section('main-content')

<div class="row">
    <div class="col-10">
        <h1>Administración de temáticas ({{ $idioma->nombre }})</h1>
    </div>
    <div class="col-2 text-end d-flex flex-column align-items-end justify-content-center">
        <button type="button" class="btn btn-secondary fa-solid fa-plus" data-bs-toggle="modal" data-bs-target="#crearModal">
        </button>

        <div class="modal fade" id="crearModal" tabindex="-1" aria-labelledby="crearModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="crearModalLabel">Crear temática</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('tematica.store', $idioma->idioma_id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body text-start">
                            <div class="col mb-2">
                                <label for="nombre" class="form-label">Nombre: </label>
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>
                            <div class="col mb-2">
                                <label for="dificultad_id" class="form-label">Dificultad: </label>
                                <select class="form-select" aria-label="Default select example" id="dificultad_id" name="dificultad_id">
                                    <option value="1">Fácil</option>
                                    <option value="2">Medio</option>
                                    <option value="3">Difícil</option>
                                </select>
                            </div>
                            <div class="col mb-2">
                                <label for="seccion_id" class="form-label">Sección: </label>
                                <select class="form-select" aria-label="Default select example" id="seccion_id" name="seccion_id">
                                    <option value="1">Escrito</option>
                                    <option value="2">Listening</option>
                                </select>
                            </div>
                            <div class="col mb-2">
                                <label for="descripcion" class="form-label">Descripcion: </label>
                                <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                            </div>
                            <div class="col mb-2">
                                <label for="foto" class="form-label">Imágen:</label>
                                <input class="form-control form-control-sm" id="foto" name="foto" type="file" accept=".png, .jpeg, .jpg">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<hr class="mt-2">

<div class="row">
    <div class="col text-center mt-3">
        <h3><b>Fácil</b></h3>
    </div>
</div>

<div class="row">
    <div class="col">
        <table class="table table-striped table-bordered align-middle">
            <thead>
                <colgroup>
                    <col style="width: 30%;">
                    <col style="width: 30%;">
                    <col style="width: 20%;">
                    <col style="width: 20%;">
                </colgroup>
                <tr class="text-center">
                    <th scope="col">Temática</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">
                @foreach($tematicas as $tematica)
                @if($tematica->dificultad->dificultad_id === 1)
                <tr>
                    <td class="text-center">{{$tematica->nombre}} </td>
                    <td class="text-center"><span class="mx-2">{{ $tematica->foto }}</span><a href="{{ asset('storage/documentos/img/tematicas/' . $tematica->tematica_id . '/' . $tematica->foto) }}" class="btn btn-success fa-solid fa-magnifying-glass"></a></td>
                    <td class="text-center">{{$tematica->seccion->nombre}}</td>
                    <td class="text-center">
                        <form>
                            <a href="#" class="btn btn-warning fa-solid fa-pencil"></a>
                            <button type="submit" class="btn btn-danger text-white fa-solid fa-trash"></button>
                        </form>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<hr>

<div class="row">
    <div class="col text-center mt-3">
        <h3><b>Medio</b></h3>
    </div>
</div>

<div class="row">
    <div class="col">
        <table class="table table-striped table-bordered align-middle">
            <thead>
                <colgroup>
                    <col style="width: 30%;">
                    <col style="width: 30%;">
                    <col style="width: 20%;">
                    <col style="width: 20%;">
                </colgroup>
                <tr class="text-center">
                    <th scope="col">Temática</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach($tematicas as $tematica)
                @if($tematica->dificultad->dificultad_id === 2)
                <tr>
                    <td class="text-center">{{$tematica->nombre}} </td>
                    <td class="text-center"><span class="mx-2">Nombre_Archivo</span><a href="#" class="btn btn-success fa-solid fa-magnifying-glass"></a></td>
                    <td class="text-center">Enunciado escrito</td>
                    <td class="text-center">
                        <form>
                            <a href="#" class="btn btn-warning fa-solid fa-pencil"></a>
                            <button type="submit" class="btn btn-danger text-white fa-solid fa-trash"></button>
                        </form>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<hr>

<div class="row">
    <div class="col text-center mt-3">
        <h3><b>Difícil</b></h3>
    </div>
</div>

<div class="row">
    <div class="col">
        <table class="table table-striped table-bordered align-middle">
            <thead>
                <colgroup>
                    <col style="width: 30%;">
                    <col style="width: 30%;">
                    <col style="width: 20%;">
                    <col style="width: 20%;">
                </colgroup>
                <tr class="text-center">
                    <th scope="col">Temática</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach($tematicas as $tematica)
                @if($tematica->dificultad->dificultad_id === 3)
                <tr>
                    <td class="text-center">{{$tematica->nombre}} </td>
                    <td class="text-center"><span class="mx-2">Nombre_Archivo</span><a href="#" class="btn btn-success fa-solid fa-magnifying-glass"></a></td>
                    <td class="text-center">Enunciado escrito</td>
                    <td class="text-center">
                        <form>
                            <a href="#" class="btn btn-warning fa-solid fa-pencil"></a>
                            <button type="submit" class="btn btn-danger text-white fa-solid fa-trash"></button>
                        </form>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
