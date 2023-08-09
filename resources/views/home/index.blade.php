@extends('templates.master')

@section('main-content')
    <div class="row">
        <div class="col">
          <h1>Mi perfil</h1>
          <hr>
        </div>
      </div>

      <div class="row my-3">
        <div class="col-lg-7 col-sm-12 p-4 bg-white rounded">
          <div class="row">
            <div class="col mb-3">
              <h4>Detalles</h4>
            </div>
          </div>
          @if ($errors->any())
            <div class="alert alert-warning">
              @foreach ($errors->all() as $error)
                <div class="row">
                  <span>- {{ $error }}</span>
                </div>
              @endforeach
            </div>
          @endif
          <form method="POST" action="{{ route('user.updateCredenciales') }}">
            @method('put')
            @csrf
            <div class="row">
              <div class="col-6">
                <div class="mb-3">
                  <label for="usuario_id" class="form-label">Nombre de usuario</label>
                  <input type="text" class="form-control" id="usuario_id" name="usuario_id" placeholder="{{ Auth::user()->usuario_id }}">
                </div>              
              </div>
              <div class="col-6">
                <div class="mb-3">
                  <label for="email" class="form-label">E-mail</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="{{ Auth::user()->email }}">
                </div> 
              </div>
              <div class="col-6">
                <div class="mb-3">
                  <label for="password" class="form-label">Contraseña</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese Contraseña">
                </div> 
              </div>
            </div>

            <div class="row">
              <div class="col d-grid">
                <button type="submit" class="btn btn-success text-white mt-3 mb-3">Aplicar Cambios</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-lg-1 d-sm-none d-lg-block"></div>
        <div class="col-lg-4 col-sm-12 mt-lg-0 mt-sm-3 p-4 bg-white rounded">
          <div class="row">
            <div class="col mb-3">
              <h4>Sube tu foto</h4>
            </div>
          </div>
          <div class="row">
            <div class="col text-center">
              <img src="{{ asset('storage/documentos/img/users/' . Auth::user()->usuario_id . '/' . Auth::user()->foto) }}" class="img-fluid" style="height: 200px;">
            </div>
          </div>
          <form method="POST" action="{{ route('user.updateFoto') }}" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row">
              <div class="col-9 my-3">
                <input class="form-control form-control-sm" id="foto" name="foto" type="file" accept=".png, .jpeg, .jpg">
              </div>
              <div class="col-3 my-3 text-center">
                <button type="submit" class="btn btn-success text-white fa-solid fa-upload"></button>
              </div>
            </div>
          </form>
        </div>
      </div>
      
      <div class="row">
        <div class="col p-4 bg-white rounded">
          <div class="row">
            <div class="col mb-3">
              <h4>Progreso</h4>
            </div>        
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-6 text-center d-flex flex-column justify-content-center align-items-center">
              <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="foto">
                <div class="card-body">
                  <h5 class="card-title">Idioma</h5>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Fácil
                    <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar bg-success" style="width: 100%">100%</div>
                    </div>
                  </li>
                  <li class="list-group-item">Medio
                    <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar bg-success" style="width: 75%">75%</div>
                    </div>
                  </li>
                  <li class="list-group-item">Difícil 
                    <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar bg-success" style="width: 50%">50%</div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 text-center d-flex flex-column justify-content-center align-items-center">
              <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="foto">
                <div class="card-body">
                  <h5 class="card-title">Idioma</h5>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Fácil
                    <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar bg-success" style="width: 100%">100%</div>
                    </div>
                  </li>
                  <li class="list-group-item">Medio
                    <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar bg-success" style="width: 75%">75%</div>
                    </div>
                  </li>
                  <li class="list-group-item">Difícil 
                    <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar bg-success" style="width: 50%">50%</div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 mt-md-3 mt-lg-0 text-center d-flex flex-column justify-content-center align-items-center">
              <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="foto">
                <div class="card-body">
                  <h5 class="card-title">Idioma</h5>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Fácil
                    <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar bg-success" style="width: 100%">100%</div>
                    </div>
                  </li>
                  <li class="list-group-item">Medio
                    <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar bg-success" style="width: 75%">75%</div>
                    </div>
                  </li>
                  <li class="list-group-item">Difícil 
                    <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar bg-success" style="width: 50%">50%</div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection