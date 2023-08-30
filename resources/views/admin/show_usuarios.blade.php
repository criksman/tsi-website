@extends('templates.master')

@section('main-content')

<div class="row">
    <div class="col">
        <h1>Lista de usuarios</h1>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col">
        <table class="table table-striped table-bordered align-middle">
            <thead>
                <colgroup>
                    <col style="width: 30%;">
                    <col style="width: 30%;">
                    <col style="width: 15%;">
                    <col style="width: 25%;">
                </colgroup>
                <tr class="text-center">
                    <th scope="col">Nombre de usuario</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach($usuarios as $usuario)
                <tr>
                    <td class="text-center">{{ $usuario->username }}</td>
                    <td class="text-center">{{ $usuario->email }}</td>
                    <td class="text-center">@if($usuario->estado == 1) Activo @else Baneado @endif</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-warning fa-solid fa-rotate-left @if(Auth::user()->user_id == $usuario->user_id) disabled @endif" data-bs-toggle="modal" data-bs-target="#desbanearModal{{$usuario->user_id}}"> </button>

                        <div class="modal fade" id="desbanearModal{{$usuario->user_id}}" tabindex="-1" aria-labelledby="desbanearModalLabel{{$usuario->user_id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="desbanearModalLabel{{$usuario->user_id}}">Desbanear usuario</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Esta seguro que desea desbanear al usuario?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-warning">Desbanear</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-warning fa-solid fa-ban @if(Auth::user()->user_id == $usuario->user_id) disabled @endif" data-bs-toggle="modal" data-bs-target="#banModal{{$usuario->user_id}}"> </button>

                        <div class="modal fade" id="banModal{{$usuario->user_id}}" tabindex="-1" aria-labelledby="banModalLabel{{$usuario->user_id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="banModalLabel{{$usuario->user_id}}">Banear Usuario</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Está seguro que desea banear el usuario?
                                    </div>
                                    <form>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-warning">Banear</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-danger text-white fa-solid fa-trash @if(Auth::user()->user_id == $usuario->user_id) disabled @endif" data-bs-toggle="modal" data-bs-target="#borrarModal{{$usuario->user_id}}"> </button>

                        <div class="modal fade" id="borrarModal{{$usuario->user_id}}" tabindex="-1" aria-labelledby="borrarModalLabel{{$usuario->user_id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="borrarModalLabel{{$usuario->user_id}}">Borrar usuario</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Está seguro que desea borrar al usuario?
                                    </div>
                                    <form method="POST" action="{{ route('user.destroy', $usuario->user_id) }}">
                                        @method('delete')
                                        @csrf
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-danger text-white">Borrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
