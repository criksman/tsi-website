@extends('templates.master')

@section('main-content')

<div class="row">
      <div class="col-10">
        <h1>Administración de temáticas (LENGUAJE)</h1>
      </div>
      <div class="col-2 text-end d-flex flex-column align-items-end justify-content-center">
        <a href="#" class="btn btn-secondary fa-solid fa-plus"></a>
      </div>
    </div>
    <hr class="mt-2">
    <div class="row">
      <div class="col text-center mt-3">
        <h3><b>Fácil</b></h3>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <table class="table table-striped table-bordered align-middle">
          <thead>
            <colgroup>
              <col style="width: 30%;">
              <col style="width: 30%;">
              <col style="width: 20%;">
              <col style="width: 20%;">
            </colgroup>
            <tr class="text-center">
              <th scope="col">Temática</th>
              <th scope="col">Foto</th>
              <th scope="col">Tipo</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <tr>
              <td class="text-center">Conjugación de verbos</td>
              <td class="text-center"><span class="mx-2">Nombre_Archivo</span><a href="#"
                  class="btn btn-success fa-solid fa-magnifying-glass"></a></td>
              <td class="text-center">Enunciado escrito</td>
              <td class="text-center">
                <form>
                  <a href="#" class="btn btn-warning fa-solid fa-pencil"></a>
                  <button type="submit" class="btn btn-danger text-white fa-solid fa-trash"></button>
                </form>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <hr>

    <div class="row">
      <div class="col text-center mt-3">
        <h3><b>Medio</b></h3>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <table class="table table-striped table-bordered align-middle">
          <thead>
            <colgroup>
              <col style="width: 30%;">
              <col style="width: 30%;">
              <col style="width: 20%;">
              <col style="width: 20%;">
            </colgroup>
            <tr class="text-center">
              <th scope="col">Temática</th>
              <th scope="col">Foto</th>
              <th scope="col">Tipo</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <tr>
              <td class="text-center">deportes</td>
              <td class="text-center"><span class="mx-2">Nombre_Archivo</span><a href="#"
                  class="btn btn-success fa-solid fa-magnifying-glass"></a></td>
              <td class="text-center">Enunciado escrito</td>
              <td class="text-center">
                <form>
                  <a href="#" class="btn btn-warning fa-solid fa-pencil"></a>
                  <button type="submit" class="btn btn-danger text-white fa-solid fa-trash"></button>
                </form>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <hr>

    <div class="row">
      <div class="col text-center mt-3">
        <h3><b>Difícil</b></h3>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <table class="table table-striped table-bordered align-middle">
          <thead>
            <colgroup>
              <col style="width: 30%;">
              <col style="width: 30%;">
              <col style="width: 20%;">
              <col style="width: 20%;">
            </colgroup>
            <tr class="text-center">
              <th scope="col">Temática</th>
              <th scope="col">Foto</th>
              <th scope="col">Tipo</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <tr>
              <td class="text-center">Entender textodgdfh</td>
              <td class="text-center"><span class="mx-2">Nombre_Archivo</span><a href="#"
                  class="btn btn-success fa-solid fa-magnifying-glass"></a></td>
              <td class="text-center">Enunciado listening</td>
              <td class="text-center">
                <form>
                  <a href="#" class="btn btn-warning fa-solid fa-pencil"></a>
                  <button type="submit" class="btn btn-danger text-white fa-solid fa-trash"></button>
                </form>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

@endsection
