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
            <img src="img/montblanc.jpg" class="card-img-top" alt="foto">
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <h5 class="card-title text-end">Idioma</h5>
                    </div>
                    <div class="col-5 text-start p-0">
                        <button type="button" class="btn btn-warning fa-pencil fa-solid" data-bs-toggle="modal" data-bs-target="#nombreModal{{$idioma->id}}"></button>
                    </div>
                </div>
                <form>
                    <div class="row">
                        <div class="col-9 my-3">
                            <input class="form-control form-control-sm" id="formFileSm" type="file">
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
                        <form>
                            <button type="submit" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#borrarModal{{$idioma->id}}">Borrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="borrarModal{{$idioma->id}}" tabindex="-1" aria-labelledby="borrarModalLabel{{$idioma->id}}" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="borrarModalLabel{{$idioma->id}}">New message</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <p>¿Esta seguro que desea eliminar el idioma (todos sus temáticas serán eliminadas)</p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary">Borrar</button>
              </div>
          </div>
      </div>
    </div>

    <div class="modal fade" id="nombreModal{{$idioma->id}}" tabindex="-1" aria-labelledby="nombreModalLabel{{$idioma->id}}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="nombreModalLabel{{$idioma->id}}">Edición de idioma</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="idioma-nombre" class="col-form-label">Nuevo nombre:</label>
                            <input type="text" class="form-control" id="idioma-nombre">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary">Aplicar cambios</button>
                    </div>
                </form>
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
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form>
              <div class="modal-body">
                  <div class="col mb-2">
                      <label for="idioma-nombre" class="col-form-label">Nombre:</label>
                      <input type="text" class="form-control" id="idioma-nombre">
                  </div>
                  <div class="col">
                      <label for="idioma-imagen" class="col-form-label">Imágen:</label>
                      <input class="form-control form-control-sm" id="idioma-imagen" type="file">
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary">Crear</button>
              </div>
          </form>
      </div>
  </div>
</div>

@endsection
