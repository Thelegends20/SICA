@extends('layouts.sica')

@section('titulo', 'Usuarios')

@section('contenido')

<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">

    <div>
        <h1>Usuarios</h1>
        <p>Administración de accesos y roles dentro de SICA.</p>
    </div>

    <a href="{{ url('/usuarios/crear') }}" class="btn btn-sica">
        <i class="bi bi-person-plus me-2"></i>
        Nuevo usuario
    </a>

</div>


<div class="card card-sica">

    <div class="card-body p-4">

        <div class="row g-3 align-items-end mb-4">

            <div class="col-12 col-md-8 col-lg-6">

                <label for="buscadorUsuarios" class="form-label fw-bold">
                    Buscar usuario
                </label>

                <input
                    type="text"
                    id="buscadorUsuarios"
                    class="form-control"
                    placeholder="Nombre, correo o rol..."
                >

            </div>


            <div class="col-12 col-md-4 col-lg-3">

                <label for="filtroRol" class="form-label fw-bold">
                    Rol
                </label>

                <select id="filtroRol" class="form-select">

                    <option value="">
                        Todos
                    </option>

                    <option value="admin_principal">
                        Administrador principal
                    </option>

                    <option value="coordinador">
                        Coordinador
                    </option>

                </select>

            </div>

        </div>


        <div class="table-responsive">

            <table
                class="table table-hover align-middle mb-0"
                id="tablaUsuarios"
            >

                <thead class="table-light">

                    <tr>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Registro</th>
                        <th class="text-end">Acciones</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($usuarios ?? [] as $usuario)

                        @php

                            $rolUsuario =
                                strtolower(
                                    $usuario->rol
                                    ?? 'coordinador'
                                );

                            $rolTexto = match($rolUsuario) {
                                'admin_principal' => 'Administrador principal',
                                'coordinador' => 'Coordinador',
                                default => ucfirst($rolUsuario),
                            };

                            $rolBadge = match($rolUsuario) {
                                'admin_principal' => 'success',
                                'coordinador' => 'primary',
                                default => 'secondary',
                            };

                        @endphp


                        <tr
                            data-busqueda="
                                {{ strtolower(
                                    ($usuario->name ?? '') . ' ' .
                                    ($usuario->email ?? '') . ' ' .
                                    $rolUsuario
                                ) }}
                            "
                            data-rol="{{ $rolUsuario }}"
                        >

                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    <div
                                        class="rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center"
                                        style="width:46px;height:46px;min-width:46px;"
                                    >
                                        <i class="bi bi-person fs-4"></i>
                                    </div>

                                    <div>

                                        <div class="fw-bold">
                                            {{ $usuario->name ?? 'Sin nombre' }}
                                        </div>

                                        <small class="text-muted">
                                            ID: {{ $usuario->id ?? '-' }}
                                        </small>

                                    </div>

                                </div>

                            </td>


                            <td>
                                {{ $usuario->email ?? 'Sin correo' }}
                            </td>


                            <td>

                                <span class="badge text-bg-{{ $rolBadge }}">
                                    {{ $rolTexto }}
                                </span>

                            </td>


                            <td>

                                @if(!empty($usuario->created_at))

                                    {{ \Carbon\Carbon::parse($usuario->created_at)->format('d/m/Y') }}

                                @else

                                    <span class="text-muted">
                                        Sin fecha
                                    </span>

                                @endif

                            </td>


                            <td class="text-end">

                                <div class="btn-group">

                                    @if(isset($usuario->id))

                                        <a
                                            href="{{ url('/usuarios/' . $usuario->id . '/editar') }}"
                                            class="btn btn-sm btn-outline-primary"
                                            title="Editar usuario"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                    @endif

                                </div>

                            </td>

                        </tr>


                    @empty


                        <tr>

                            <td colspan="5" class="text-center py-5">

                                <div class="fs-1 text-muted mb-3">
                                    <i class="bi bi-person-gear"></i>
                                </div>

                                <h5 class="fw-bold">
                                    No hay usuarios registrados
                                </h5>

                                <p class="text-muted">
                                    Los usuarios con acceso aparecerán aquí.
                                </p>

                                <a
                                    href="{{ url('/usuarios/crear') }}"
                                    class="btn btn-sica"
                                >
                                    <i class="bi bi-person-plus me-2"></i>
                                    Crear usuario
                                </a>

                            </td>

                        </tr>


                    @endforelse


                    <tr
                        id="sinResultadosUsuarios"
                        style="display:none;"
                    >

                        <td colspan="5" class="text-center py-5">

                            <div class="fs-1 text-muted mb-3">
                                <i class="bi bi-search"></i>
                            </div>

                            <h5 class="fw-bold">
                                No se encontraron usuarios
                            </h5>

                            <p class="text-muted mb-0">
                                Intenta con otro nombre, correo o rol.
                            </p>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>

    const buscadorUsuarios =
        document.getElementById('buscadorUsuarios');

    const filtroRol =
        document.getElementById('filtroRol');


    function filtrarUsuarios()
    {
        const texto =
            buscadorUsuarios.value
                .toLowerCase()
                .trim();

        const rol =
            filtroRol.value
                .toLowerCase();

        const filas =
            document.querySelectorAll(
                '#tablaUsuarios tbody tr[data-busqueda]'
            );

        let visibles = 0;


        filas.forEach(function(fila) {

            const contenido =
                fila.dataset.busqueda || '';

            const rolFila =
                fila.dataset.rol || '';

            const coincideTexto =
                texto === ''
                || contenido.includes(texto);

            const coincideRol =
                rol === ''
                || rolFila === rol;


            if (coincideTexto && coincideRol) {

                fila.style.display = '';
                visibles++;

            } else {

                fila.style.display = 'none';

            }

        });


        const sinResultados =
            document.getElementById(
                'sinResultadosUsuarios'
            );


        if (filas.length > 0 && visibles === 0) {

            sinResultados.style.display = '';

        } else {

            sinResultados.style.display = 'none';

        }
    }


    buscadorUsuarios.addEventListener(
        'input',
        filtrarUsuarios
    );

    filtroRol.addEventListener(
        'change',
        filtrarUsuarios
    );

</script>

@endpush