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
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <img src="{{ asset('storage/documentos/img/idiomas/' . $idioma->idioma_id . '/' . $idioma->foto) }}" class="card-img-top img-fluid" style="height: 200px;" alt="">
            <div class="card-body">
                <h5 class="card-title text-center">{{$idioma->nombre}}</h5>
                <div class="text-center mt-3 d-grid">
                    <a href="{{ route('admin.list_tematicas', $idioma->idioma_id) }}" class="btn btn-secondary text-white">Temáticas</a>
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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="agregarModalLabel">Agregar Idioma</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="botonAgregarIdioma"></button>
            </div>
            {{-- @if ($errors->CrearIdiomaBag->any())
            <div class="text-start alert alert-warning">
                @foreach ($errors->CrearIdiomaBag->all() as $error)
                <div class="row">
                    <span>- {{ $error }}</span>
                </div>
                @endforeach
            </div>
            @endif --}}
            <form method="POST" action="{{ route('idioma.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="col mb-2">
                        <label for="nombre" class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control @error('nombre', 'CrearIdiomaBag') is-invalid @enderror" id="nombre" name="nombre">
                        @error('nombre', 'CrearIdiomaBag')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="foto" class="col-form-label">Imágen:</label>
                        <input class="form-control form-control-sm @error('foto', 'CrearIdiomaBag') is-invalid @enderror" id="foto" name="foto" type="file" accept=".png, .jpeg, .jpg">
                        @error('foto', 'CrearIdiomaBag')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-secondary">Crear</button>
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
