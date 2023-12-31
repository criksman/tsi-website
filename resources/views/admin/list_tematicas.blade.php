@extends('templates.master')

@section('main-content')

<div class="row">
    <div class="col-10">
        <h1>Administración de temáticas ({{ $idioma->nombre }})</h1>
    </div>
    <div class="col-2 text-end d-flex flex-column align-items-end justify-content-center">
        <button type="button" class="btn btn-secondary fa-solid fa-plus shadow" data-bs-toggle="modal" data-bs-target="#crearModal">
        </button>

        <div class="modal fade" id="crearModal" tabindex="-1" aria-labelledby="crearModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="crearModalLabel">Crear temática</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{-- @if ($errors->CrearTematicaBag->any())
                    <div class="text-start alert alert-warning">
                        @foreach ($errors->CrearTematicaBag->all() as $error)
                        <div class="row">
                            <span>- {{ $error }}</span>
                </div>
                @endforeach
            </div>
            @endif --}}
            <form method="POST" action="{{ route('tematica.store', $idioma->idioma_id) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body text-start">
                    <div class="col mb-2">
                        <label for="nombre" class="form-label">Nombre: </label>
                        <input type="text" class="form-control @error('nombre', 'CrearTematicaBag') is-invalid @enderror" id="nombre" name="nombre">
                        @error('nombre', 'CrearTematicaBag')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col mb-2">
                        <label for="dificultad_id" class="form-label">Dificultad: </label>
                        <select class="form-select @error('dificultad_id', 'CrearTematicaBag') is-invalid @enderror" aria-label="Default select example" id="dificultad_id" name="dificultad_id">
                            <option value="1">Fácil</option>
                            <option value="2">Medio</option>
                            <option value="3">Difícil</option>
                        </select>

                        @error('dificultad_id', 'CrearTematicaBag')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col mb-2">
                        <label for="seccion_id" class="form-label">Sección: </label>
                        <select class="form-select @error('seccion_id', 'CrearTematicaBag') is-invalid @enderror" aria-label="Default select example" id="seccion_id" name="seccion_id">
                            <option value="1">Textual</option>
                            <option value="2">Listening</option>
                        </select>

                        @error('seccion_id', 'CrearTematicaBag')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col mb-2">
                        <label for="descripcion" class="form-label">Descripcion: </label>
                        <textarea class="form-control @error('descripcion', 'CrearTematicaBag') is-invalid @enderror" id="descripcion" name="descripcion"></textarea>
                        @error('descripcion', 'CrearTematicaBag')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col mb-2">
                        <label for="foto" class="form-label">Imágen:</label>
                        <input class="form-control form-control-sm @error('foto', 'CrearTematicaBag') is-invalid @enderror" id="foto" name="foto" type="file" accept=".png, .jpeg, .jpg">
                        @error('foto', 'CrearTematicaBag')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <hr>
                <div class="row py-3 px-3">
                    <div class="col-9 d-grid text-center">
                        <button type="submit" class="btn btn-secondary">Agregar</button>
                    </div>
                    <div class="col-3 d-grid text-center">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
</div>
<hr class="mt-2">

@foreach($dificultades as $dificultad)
<div class="row">
    <div class="col text-center mt-3">
        <h3><b>{{ $dificultad->nombre }}</b></h3>
    </div>
</div>

<div class="row">
    <div class="col">
        <table class="table table-striped table-bordered align-middle shadow">
            <thead>
                <colgroup>
                    <col style="width: 30%;">
                    <col style="width: 10%;">
                    <col style="width: 10%;">
                    <col style="width: 20%;">
                    <col style="width: 20%;">
                </colgroup>
                <tr class="text-center">
                    <th scope="col">Temática</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Sección</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">
                @foreach($tematicas as $tematica)
                @if($tematica->dificultad->dificultad_id === $dificultad->dificultad_id)
                <tr>
                    <td class="text-center">{{$tematica->nombre}} </td>
                    <td class="text-center"><a href="{{ asset('storage/documentos/img/tematicas/' . $tematica->tematica_id . '/' . $tematica->foto) }}" class="btn btn-success fa-solid fa-magnifying-glass"></a></td>
                    <td class="text-center">{{$tematica->seccion->nombre}}</td>
                    <td class="text-center">@if($tematica->estado == true) Habilitado @else Deshabilitado @endif</td>
                    <td class="text-center">
                        <a href="{{ route('admin.edit_tematica', $tematica->tematica_id) }}" class="btn btn-warning fa-solid fa-pencil"></a>
                        <button type="button" class="btn btn-danger text-white fa-solid fa-trash" data-bs-toggle="modal" data-bs-target="#borrarModal{{ $tematica->tematica_id }}"></button>

                        <div class="modal fade" id="borrarModal{{ $tematica->tematica_id }}" tabindex="-1" aria-labelledby="borrarModalLabel{{ $tematica->tematica_id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="borrarModalLabel{{ $tematica->tematica_id }}">Borrar temática</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Está seguro que desea eliminar la temática: {{ $tematica->nombre }}?
                                        Se eliminarán todas las preguntas asociadas.
                                    </div>
                                    <form method="POST" action="{{ route('tematica.destroy', $tematica->tematica_id) }}">
                                        @method('delete')
                                        @csrf
                                        <hr>
                                        <div class="row py-3 px-3">
                                            <div class="col-9 d-grid text-center">
                                                <button type="submit" class="btn btn-secondary">Borrar</button>
                                            </div>
                                            <div class="col-3 d-grid text-center">
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<hr>
@endforeach

{{-- llamar modal en caso de redireccion y verificacion fallida --}}
@if ($errors->CrearTematicaBag->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const crearModal = new bootstrap.Modal(document.getElementById('crearModal'));
        crearModal.show();
    });

</script>
@endif

@endsection
