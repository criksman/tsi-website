@extends('templates.master')

@section('main-content')

<div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-xl-9">

        <h1 class="mb-4">Editar Enunciado/Respuestas</h1>

        <div class="card" style="border-radius: 15px;">
            <div class="card-body">

                <div class="row align-items-center py-3">
                    <div class="col-md-3 ps-5">

                        <h6 class="mb-0">Enunciado</h6>

                    </div>
                    <div class="col-md-9 pe-5">

                        <textarea class="form-control" rows="3" placeholder="" name="enunciado"></textarea>

                    </div>
                </div>

                <hr class="mx-n3">

                <div class="row align-items-center pt-4 pb-3">

                    <div class="col-md-3 ps-5">

                        <h6 class="mb-0">1. (Respuesta correcta)</h6>

                    </div>
                    <div class="col-md-9 pe-5">

                        <input type="text" class="form-control form-control-lg" name="respuesta_corr" placeholder="" />

                    </div>

                    <div class="col-md-3 ps-5 mt-2">

                        <h6 class="mb-0">2.</h6>

                    </div>
                    <div class="col-md-9 pe-5 mt-2">

                        <input type="text" class="form-control form-control-lg" name="respuesta_inc1" placeholder="" />

                    </div>

                    <div class="col-md-3 ps-5">

                        <h6 class="mb-0">3.</h6>

                    </div>
                    <div class="col-md-9 pe-5 mt-2">

                        <input type="text" class="form-control form-control-lg" name="respuesta_inc2" placeholder="" />

                    </div>

                    <div class="col-md-3 ps-5">

                        <h6 class="mb-0">4.</h6>

                    </div>
                    <div class="col-md-9 pe-5 mt-2">

                        <input type="text" class="form-control form-control-lg" name="respuesta_inc3" placeholder="" />

                    </div>
                </div>

                <div class="row">
                    <div class="col-12 px-5 py-4">
                        <div class="row">
                            <div class="col-6 d-flex justify-content-center">
                                <button type="submit" class="btn btn-secondary btn-lg">Aplicar cambios</button>
                            </div>

                            <div class="col-6 d-flex justify-content-center">
                                <a href="" class="btn btn-primary btn-lg text-white">Volver</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="row d-flex justify-content-center align-items-center h-100 mt-4">
    <div class="col-xl-9">

        <h1 class="mb-4">Editar audio</h1>

        <div class="card" style="border-radius: 15px;">
            <div class="card-body">
                <div class="row align-items-center py-3">
                    <div class="col-md-3 ps-5">

                        <h6 class="mb-0">Subir archivo de audio</h6>

                    </div>
                    <div class="col-md-9 pe-5">
                        <input class="form-control form-control-lg" id="audio" name="audio" type="file" />
                        <div class="small text-muted mt-2"></div>

                    </div>
                </div>

                <hr class="mx-n3">

                <div class="row">
                    <div class="col-12 px-5 py-4">
                        <div class="row">
                            <div class="col-6 d-flex justify-content-center">
                                <button type="submit" class="btn btn-secondary btn-lg">Subir audio</button>
                            </div>
                            <div class="col-6 d-flex justify-content-center">


                                <button type="submit" class="btn btn-danger btn-lg text-white">Eliminar actual</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
