@extends('layouts.app')

@section('titulo','Usuarios')

@section('contenido')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold">
            Administración de Usuarios
        </h2>

        <small class="text-muted">
            Administradores y Coordinadores del Sistema SICA
        </small>

    </div>

    <a href="{{ route('usuarios.create') }}" class="btn btn-success">

        <i class="bi bi-person-plus-fill"></i>

        Nuevo Usuario

    </a>

</div>

<div class="card shadow">

    <div class="card-body">

        <table class="table table-hover align-middle">

            <thead class="table-dark">

                <tr>

                    <th>ID</th>

                    <th>Nombre</th>

                    <th>Correo</th>

                    <th>Rol</th>

                    <th>Municipio</th>

                    <th>Estatus</th>

                    <th width="120">Acciones</th>

                </tr>

            </thead>

            <tbody>

            @forelse($usuarios as $usuario)

                <tr>

                    <td>{{ $usuario->id }}</td>

                    <td>{{ $usuario->name }}</td>

                    <td>{{ $usuario->email }}</td>

                    <td>

                        @if($usuario->rol=="ADMIN_PRINCIPAL")

                            <span class="badge bg-danger">

                                ADMIN PRINCIPAL

                            </span>

                        @elseif($usuario->rol=="ADMIN")

                            <span class="badge bg-primary">

                                ADMIN

                            </span>

                        @else

                            <span class="badge bg-success">

                                COORDINADOR

                            </span>

                        @endif

                    </td>

                    <td>

                        {{ $usuario->municipio ?? '-' }}

                    </td>

                    <td>

                        @if($usuario->activo)

                            <span class="badge bg-success">

                                ACTIVO

                            </span>

                        @else

                            <span class="badge bg-secondary">

                                INACTIVO

                            </span>

                        @endif

                    </td>

                    <td>

                        <a href="{{ route('usuarios.edit',$usuario->id) }}"
                           class="btn btn-warning btn-sm">

                            Editar

                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" class="text-center">

                        No existen usuarios registrados.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection