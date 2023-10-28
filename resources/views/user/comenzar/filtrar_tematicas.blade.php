@extends('templates.master')

@section('main-content')
<div class="row">
    <div class="col">
        <h1>Filtra las temáticas</h1>
        <hr>
    </div>
</div>

<div class="row my-3 justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="card p-4 shadow">
            <h2 class="mb-4 text-center">Selecciona un idioma y dificultad</h2>

            @if ($errors->any())
            <div class="text-start alert alert-warning">
                @foreach ($errors->all() as $error)
                <div class="row">
                    <span>- {{ $error }}</span>
                </div>
                @endforeach
            </div>
            @endif
            <form method="GET" action="{{ route('user.comenzar.list_tematicas') }}">
                <div class="mb-3">
                    <label for="idioma_id" class="form-label">Languaje</label>
                    <select class="form-select" id="idioma_id" name="idioma_id">
                        <option value="" selected disabled>Selecciona un lenguaje</option>
                        @foreach($idiomas as $idioma)
                        <option value="{{$idioma->idioma_id}}">{{$idioma->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="dificultad_id" class="form-label">Difficultad</label>
                    <select class="form-select" id="dificultad_id" name="dificultad_id">
                        <option value="" selected disabled>Selecciona una dificultad</option>
                        @foreach($dificultades as $dificultad)
                        <option value="{{$dificultad->dificultad_id}}">{{$dificultad->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col d-grid text-center mt-3">
                        <button type="submit" class="btn btn-secondary">Mostrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
