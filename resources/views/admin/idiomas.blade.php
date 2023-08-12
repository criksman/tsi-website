@extends('templates.master')

@section('main-content')

<div class="row">
    <div class="col-10">
        <h1>Seleccionar idioma</h1>
    </div>
    <div class="col-2 text-end d-flex flex-column align-items-end justify-content-center">
        <button type="button" class="btn btn-secondary fa-plus fa-solid" data-bs-toggle="modal" data-bs-target="#agregarModal"></button>
    </div>
</div>
<hr class="mt-2">
<div class="row">
    @foreach($idiomas as $idioma)
    <div class="col-lg-4 rounded col-md-6 col-sm-12 mt-md-3 mt-sm-3 mt-lg-0 d-flex flex-column justify-content-center align-items-center">
        <div class="card" style="width: 18rem;">
            <img src="{{ asset('storage/documentos/img/idiomas/' . $idioma->id . '/' . $idioma->foto) }}" class="card-img-top" alt="foto">
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <h5 class="card-title text-end">{{$idioma->nombre}}</h5>
                    </div>
                    <div class="col-5 text-start p-0">
                        <button type="button" class="btn btn-warning fa-pencil fa-solid" data-bs-toggle="modal" data-bs-target="#nombreModal" data-bs-id="{{$idioma->id}}"></button>
                    </div>
                </div>
                <form method="POST" action="#" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-9 my-3">
                            <input class="form-control form-control-sm" id="foto" type="file" accept=".png, .jpeg, .jpg">
                        </div>
                        <div class="col-3 my-3 text-center">
                            <button type="submit" class="btn btn-success text-white fa-solid fa-upload"></button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-6 text-start mt-3">
                        <a href="#" class="btn btn-secondary text-white">Temáticas</a>
                    </div>
                    <div class="col-6 text-end mt-3">
                        <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#borrarModal{{$idioma->id}}">Borrar</button></form>
                    </div>

                    <div class="modal fade" id="borrarModal{{$idioma->id}}" tabindex="-1" aria-labelledby="borrarModalLabel{{$idioma->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="borrarModalLabel{{$idioma->id}}">Confirmación</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Esta seguro que desea eliminar el idioma (todos sus temáticas serán eliminadas)</p>
                                </div>
                                <form method="POST" action="{{ route('admin.destroyIdioma', $idioma->id) }}">
                                    @method('delete')
                                    @csrf
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Borrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="modal fade" id="agregarModal" tabindex="-1" aria-labelledby="agregarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="agregarModalLabel">Agregar Idioma</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="botonAgregarIdioma"></button>
            </div>
            <div class="alert alert-warning">
                @foreach ($errors->CrearIdiomaBag->all() as $error)
                <div class="row">
                    <span>- {{ $error }}</span>
                </div>
                @endforeach
            </div>
            <form method="POST" action="{{ route('admin.storeIdioma') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="col mb-2">
                        <label for="nombre" class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>
                    <div class="col">
                        <label for="foto" class="col-form-label">Imágen:</label>
                        <input class="form-control form-control-sm" id="foto" name="foto" type="file" accept=".png, .jpeg, .jpg">
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

{{-- llamar modal en caso de redireccion y verificacion fallida --}}
@if ($errors->CrearIdiomaBag->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const agregarModal = new bootstrap.Modal(document.getElementById('agregarModal'));
        agregarModal.show();
    });

</script>
@endif

@endsection
