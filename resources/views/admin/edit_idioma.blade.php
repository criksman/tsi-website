@extends('templates.master')

@section('main-content')

<div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-xl-9">

        <h1 class="mb-4">Editar nombre</h1>

        <div class="card shadow" style="border-radius: 15px;">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            {{-- @if ($errors->EditarIdiomaNombreBag->any())
            <div class="text-start alert alert-warning">
                @foreach ($errors->EditarIdiomaNombreBag->all() as $error)
                <div class="row">
                    <span>- {{ $error }}</span>
        </div>
        @endforeach
    </div>
    @endif --}}
    <div class="card-body">
        <form method="POST" action="{{ route('idioma.updateNombre', $idioma->idioma_id) }}">
            <div class="row align-items-center pt-4 pb-3">
                @method('put')
                @csrf
                <div class="col-md-3 ps-5">

                    <h6 class="mb-0">Escribir nombre: </h6>

                </div>
                <div class="col-md-9 pe-5">

                    <input type="text" class="form-control @error('nombre', 'EditarIdiomaNombreBag') is-invalid @endif form-control-lg" name="nombre" placeholder="{{ $idioma->nombre }}" />
                    @error('nombre', 'EditarIdiomaNombreBag')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>

            </div>
            <div class="row">
                <div class="col-12 px-5 py-4">
                    {{-- <div class="row">
                        <div class="col-6 d-flex justify-content-center">
                            <button type="submit" class="btn btn-secondary btn-lg">Aplicar cambios</button>
                        </div>

                        <div class="col-6 d-flex justify-content-center">
                            <a href="" class="btn btn-primary btn-lg text-white">Volver</a>
                        </div>
                    </div> --}}

                    <div class="row">
                        <div class="col-9 d-grid text-center mt-3">
                            <button type="submit" class="btn btn-secondary">Aplicar cambios</button>
                        </div>
                        <div class="col-3 d-grid text-center mt-3">
                            <a href="{{ route('admin.list_idiomas') }}" class="btn btn-primary">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

</div>
</div>

<div class="row d-flex justify-content-center align-items-center h-100 mt-4">
    <div class="col-xl-9">

        <h1 class="mb-4">Editar imágen</h1>

        <div class="card shadow" style="border-radius: 15px;">
            @if(session('successFoto'))
            <div class="alert alert-success">
                {{ session('successFoto') }}
            </div>
            @endif
            {{-- @if ($errors->EditarIdiomaFotoBag->any())
            <div class="text-start alert alert-warning">
                @foreach ($errors->EditarIdiomaFotoBag->all() as $error)
                <div class="row">
                    <span>- {{ $error }}</span>
        </div>
        @endforeach
    </div>
    @endif --}}
    <div class="card-body">
        <form method="POST" action="{{ route('idioma.updateFoto', $idioma->idioma_id) }}" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">

                    <h6 class="mb-0">Subir imágen:</h6>

                </div>
                <div class="col-md-9 pe-5">
                    <input class="form-control @error('foto', 'EditarIdiomaFotoBag') is-invalid @enderror form-control-lg" id="foto" name="foto" type="file" accept=".png, .jpeg, .jpg" />
                    @error('foto', 'EditarIdiomaFotoBag')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="small text-muted mt-2"></div>

                </div>
            </div>

            <hr class="mx-n3">

            <div class="row">
                <div class="col-12 px-5 py-4">
                    <div class="row">
                        <div class="col d-flex justify-content-center">
                            <button type="submit" class="btn btn-secondary btn-lg">Subir foto</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col text-center mt-5">
        <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#borrarModal">
            Eliminar idioma
        </button>

        <div class="modal fade" id="borrarModal" tabindex="-1" aria-labelledby="borrarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="borrarModalLabel">Eliminar idioma</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Esta seguro que desea eliminar el idioma?, todas las temáticas y sus respectivas preguntas se eliminarán permanentemente.
                    </div>
                    <form method="POST" action="{{ route('idioma.destroy', $idioma->idioma_id) }}">
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

</div>
</div>
@endsection
