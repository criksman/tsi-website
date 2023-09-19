@extends('templates.master')

@section('main-content')

<style>
    .card-image {
        height: 200px; /* Set the desired height for the card images */
        object-fit: cover; /* Ensure images maintain their aspect ratio and cover the entire space */
    }
</style>

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
    <div class="col-lg-4 col-md-6 col-sm-12 mt-md-3 mt-sm-3 mt-lg-0">
        <div class="card h-100" style="width: 18rem;">
            <img src="{{ asset('storage/documentos/img/idiomas/' . $idioma->idioma_id . '/' . $idioma->foto) }}" class="card-img-top img-fluid card-image" alt="foto">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title text-center">{{$idioma->nombre}}</h5>
                <div class="text-center mt-3 d-grid">
                    <a href="{{ route('admin.show_tematicas', $idioma->idioma_id) }}" class="btn btn-secondary text-white">Temáticas</a>
                </div>
                <div class="text-center mt-3 d-grid">
                    <a href="{{ route('admin.edit_idioma', $idioma->idioma_id) }}" class="btn btn-warning">Editar</a>
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
            @if ($errors->CrearIdiomaBag->any())
            <div class="text-start alert alert-warning">
                @foreach ($errors->CrearIdiomaBag->all() as $error)
                <div class="row">
                    <span>- {{ $error }}</span>
                </div>
                @endforeach
            </div>
            @endif
            <form method="POST" action="{{ route('idioma.store') }}" enctype="multipart/form-data">
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
