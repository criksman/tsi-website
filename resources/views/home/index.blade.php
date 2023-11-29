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
        {{-- @if ($errors->EditarUsuarioCredencialesBag->any())
        <div class="alert alert-warning">
            @foreach ($errors->EditarUsuarioCredencialesBag->all() as $error)
            <div class="row">
                <span>- {{ $error }}</span>
            </div>
            @endforeach
        </div>
        @endif --}}
        <form method="POST" action="{{ route('user.updateCredenciales') }}">
            @method('put')
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="mt-3">
                        <label for="username" class="form-label">Nombre de usuario</label>
                        <input type="text" class="form-control @error('username', 'EditarUsuarioCredencialesBag') is-invalid @enderror" id="username" name="username" placeholder="{{ Auth::user()->username }}">
                        @error('username', 'EditarUsuarioCredencialesBag')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="mt-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control @error('email', 'EditarUsuarioCredencialesBag') is-invalid @enderror" id="email" name="email" placeholder="{{ Auth::user()->email }}">
                        @error('email', 'EditarUsuarioCredencialesBag')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3 mt-4">
                        <label for="password" class="form-label">Ingrese su contraseña para confirmar cambios</label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password', 'EditarUsuarioCredencialesBag') is-invalid @enderror" id="password" name="password" placeholder="Ingrese Contraseña">
                            <a href="{{ route('user.contrasena.edit') }}" class="btn btn-warning fa-solid fa-arrow-rotate-right d-flex justify-content-center align-items-center"></a>
                            @error('password', 'EditarUsuarioCredencialesBag')
                            <div class="invalid-feedback" style="height: 0px;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col d-grid mt-5">
                    <button type="submit" class="btn btn-success text-white">Aplicar Cambios</button>
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
        {{-- @if ($errors->EditarUsuarioFotoBag->any())
        <div class="alert alert-warning">
            @foreach ($errors->EditarUsuarioFotoBag as $error)
            <div class="row">
                <span>- {{ $error }}</span>
            </div>
            @endforeach
        </div>
        @endif --}}

        <div class="row">
            <div class="col text-center d-flex align-items-center justify-content-center" style="height: 197px;">
                @if (Auth::user()->foto != 'none')
                    <img src="{{ asset('storage/documentos/img/users/' . Auth::user()->user_id . '/' . Auth::user()->foto) }}" class="img-fluid"  style="height: 197px;">
                @else
                    <i class="fas fa-user-circle fa-5x text-secondary"></i>
                @endif
            </div>
        </div>
        <form method="POST" action="{{ route('user.updateFoto') }}" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row">
                <div class="col-10 mt-5">
                    <input class="form-control @error('foto', 'EditarUsuarioFotoBag') is-invalid @enderror form-control-sm" id="foto" name="foto" type="file" accept=".png, .jpeg, .jpg">
                    @error('foto', 'EditarUsuarioFotoBag')
                    <div class="invalid-feedback" style="height: 0px;">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-2 mt-5 text-center">
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
            @foreach($idiomas as $idioma)
            @php
                //$facil = Auth::user()->progresoDificultadIdiomaConPivot()->where('dificultad_idioma_user.idioma_id', $idioma->idioma_id)->where('dificultad_idioma_user.dificultad_id', 1)->first();
                //$medio = Auth::user()->progresoDificultadIdiomaConPivot()->where('dificultad_idioma_user.idioma_id', $idioma->idioma_id)->where('dificultad_idioma_user.dificultad_id', 2)->first();
                //$dificil = Auth::user()->progresoDificultadIdiomaConPivot()->where('dificultad_idioma_user.idioma_id', $idioma->idioma_id)->where('dificultad_idioma_user.dificultad_id', 3)->first();

                //$progresoFacil = $facil ? $facil->pivot->progreso : 'N/A';
                //$progresoMedio = $medio ? $medio->pivot->progreso : 'N/A';
                //$progresoDificil = $dificil ? $dificil->pivot->progreso : 'N/A';

                $facil = DB::table('dificultad_idioma_user')
                    ->where('user_id', Auth::user()->user_id)
                    ->where('idioma_id', $idioma->idioma_id)
                    ->where('dificultad_id', 1)
                    ->value('progreso');

                $medio = DB::table('dificultad_idioma_user')
                    ->where('user_id', Auth::user()->user_id)
                    ->where('idioma_id', $idioma->idioma_id)
                    ->where('dificultad_id', 2)
                    ->value('progreso');

                $dificil = DB::table('dificultad_idioma_user')
                    ->where('user_id', Auth::user()->user_id)
                    ->where('idioma_id', $idioma->idioma_id)
                    ->where('dificultad_id', 3)
                    ->value('progreso');
                
                $progresoFacil = $facil ?? 0;
                $progresoMedio = $medio ?? 0;
                $progresoDificil = $dificil ?? 0;
            @endphp

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/documentos/img/idiomas/' . $idioma->idioma_id . '/' . $idioma->foto) }}" class="card-img-top img-fluid" style="height: 200px;" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{$idioma->nombre}}</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Fácil
                                <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="{{$progresoFacil}}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-success" style="width:{{$progresoFacil}}%">{{$progresoFacil}}</div>
                                </div>
                            </li>
                            <li class="list-group-item">Medio
                                <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="{{$progresoMedio}}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-success" style="width:{{$progresoMedio}}%">{{$progresoMedio}}</div>
                                </div>
                            </li>
                            <li class="list-group-item">Difícil
                                <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="{{$progresoDificil}}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-success" style="width:{{$progresoDificil}}%">{{$progresoDificil}}</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
