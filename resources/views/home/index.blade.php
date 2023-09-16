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
                        <label for="username" class="form-label">Nombre de usuario</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="{{ Auth::user()->username }}">
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
                <img src="{{ asset('storage/documentos/img/users/' . Auth::user()->user_id . '/' . Auth::user()->foto) }}" class="img-fluid" style="height: 200px;">
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
            @foreach($idiomas as $idioma)
            @php
            //total tematicas en cada dificultad
            $temasFacilTotal = $idioma->tematicas()->where('dificultad_id', 1)->count();
            $temasMedioTotal = $idioma->tematicas()->where('dificultad_id', 2)->count();
            $temasDificilTotal = $idioma->tematicas()->where('dificultad_id', 3)->count();

            $temasFacilAprobados = Auth::user()
            ->tematicasConPivot()
            ->whereIn('tematicas.tematica_id', $idioma->tematicas()->where('dificultad_id', 1)->pluck('tematicas.tematica_id'))
            ->wherePivot('progreso', '>=', 55)
            ->count();

            $temasMedioAprobados = Auth::user()
            ->tematicasConPivot()
            ->whereIn('tematicas.tematica_id', $idioma->tematicas()->where('dificultad_id', 2)->pluck('tematicas.tematica_id'))
            ->wherePivot('progreso', '>=', 55)
            ->count();

            $temasDificilAprobados = Auth::user()
            ->tematicasConPivot()
            ->whereIn('tematicas.tematica_id', $idioma->tematicas()->where('dificultad_id', 3)->pluck('tematicas.tematica_id'))
            ->wherePivot('progreso', '>=', 55)
            ->count();

            //resultados y porcentajes
            $resultadoFacil = $temasFacilAprobados . '/' . $temasFacilTotal;
            if ($temasFacilTotal > 0){
            $porcentajeFacil = ($temasFacilAprobados / $temasFacilTotal) * 100;
            }else{
            $porcentajeFacil = 0;
            }

            $resultadoMedio = $temasMedioAprobados . '/' . $temasMedioTotal;
            if ($temasMedioTotal > 0 ){
            $porcentajeMedio = ($temasMedioAprobados / $temasMedioTotal) * 100;
            }else{
            $porcentajeMedio = 0;
            }

            $resultadoDificil = $temasDificilAprobados . '/' . $temasDificilTotal;

            if ($temasDificilTotal > 0){
            $porcentajeDificil = ($temasDificilAprobados / $temasDificilTotal) * 100;
            }else{
            $porcentajeDificil = 0;
            }

            @endphp

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/documentos/img/idiomas/' . $idioma->idioma_id . '/' . $idioma->foto) }}" class="card-img-top img-fluid" alt="foto">
                    <div class="card-body">
                        <h5 class="card-title">{{$idioma->nombre}}</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Fácil
                                <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="{{$porcentajeFacil}}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-success" style="width:{{$porcentajeFacil}}%">{{$resultadoFacil}}</div>
                                </div>
                            </li>
                            <li class="list-group-item">Medio
                                <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="{{$porcentajeMedio}}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-success" style="width:{{$porcentajeMedio}}%">{{$resultadoMedio}}</div>
                                </div>
                            </li>
                            <li class="list-group-item">Difícil
                                <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="{{$porcentajeDificil}}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-success" style="width:{{$porcentajeDificil}}%">{{$resultadoDificil}}</div>
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
