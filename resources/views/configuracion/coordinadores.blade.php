@extends('layouts.sica')

@section('titulo', 'Coordinadores')

@section('contenido')

<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">

    <div>
        <h1>Coordinadores</h1>
        <p>Administración de usuarios con funciones operativas dentro de SICA.</p>
    </div>

    <div class="d-flex gap-2 flex-wrap">

        <a href="{{ url('/usuarios/crear') }}" class="btn btn-sica">
            <i class="bi bi-person-plus me-2"></i>
            Nuevo coordinador
        </a>

        <a href="{{ url('/configuracion') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>
            Regresar
        </a>

    </div>

</div>


<div class="card card-sica">

    <div class="card-body p-4">

        <div class="row g-3 align-items-end mb-4">

            <div class="col-12 col-md-8 col-lg-6">

                <label for="buscarCoordinador" class="form-label fw-bold">
                    Buscar coordinador
                </label>

                <input
                    type="text"
                    id="buscarCoordinador"
                    class="form-control"
                    placeholder="Nombre o correo electrónico..."
                >

            </div>

        </div>


        <div class="table-responsive">

            <table
                class="table table-hover align-middle mb-0"
                id="tablaCoordinadores"
            >

                <thead class="table-light">

                    <tr>
                        <th>Coordinador</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Registro</th>
                        <th class="text-end">Acciones</th>
                    </tr>

                </thead>


                <tbody>

                    @php

                        $listaCoordinadores =
                            $coordinadores
                            ?? collect($usuarios ?? [])->filter(function ($usuario) {
                                return strtoupper($usuario->rol ?? '') === 'COORDINADOR';
                            });

                    @endphp


                    @forelse($listaCoordinadores as $usuario)

                        <tr
                            data-busqueda="{{ strtolower(
                                ($usuario->name ?? '') . ' ' .
                                ($usuario->email ?? '')
                            ) }}"
                        >

                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    <div
                                        class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center"
                                        style="width:46px;height:46px;min-width:46px;"
                                    >
                                        <i class="bi bi-person-check fs-4"></i>
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

                                <span class="badge text-bg-primary">
                                    Coordinador
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

                                @if(isset($usuario->id))

                                    <a
                                        href="{{ url('/usuarios/' . $usuario->id . '/editar') }}"
                                        class="btn btn-sm btn-outline-primary"
                                    >
                                        <i class="bi bi-pencil me-1"></i>
                                        Editar
                                    </a>

                                @endif

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="5" class="text-center py-5">

                                <div class="fs-1 text-muted mb-3">
                                    <i class="bi bi-people"></i>
                                </div>

                                <h5 class="fw-bold">
                                    No hay coordinadores registrados
                                </h5>

                                <p class="text-muted">
                                    Los usuarios con rol COORDINADOR aparecerán aquí.
                                </p>

                                <a
                                    href="{{ url('/usuarios/crear') }}"
                                    class="btn btn-sica"
                                >
                                    <i class="bi bi-person-plus me-2"></i>
                                    Crear coordinador
                                </a>

                            </td>

                        </tr>

                    @endforelse


                    <tr
                        id="sinResultadosCoordinador"
                        style="display:none;"
                    >

                        <td colspan="5" class="text-center py-5">

                            <div class="fs-1 text-muted mb-3">
                                <i class="bi bi-search"></i>
                            </div>

                            <h5 class="fw-bold">
                                Sin resultados
                            </h5>

                            <p class="text-muted mb-0">
                                No encontramos coordinadores con esa búsqueda.
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

    const buscarCoordinador =
        document.getElementById('buscarCoordinador');


    buscarCoordinador.addEventListener('input', function () {

        const texto =
            this.value
                .toLowerCase()
                .trim();

        const filas =
            document.querySelectorAll(
                '#tablaCoordinadores tbody tr[data-busqueda]'
            );

        let visibles = 0;


        filas.forEach(function (fila) {

            const contenido =
                fila.dataset.busqueda || '';

            if (
                texto === ''
                || contenido.includes(texto)
            ) {

                fila.style.display = '';
                visibles++;

            } else {

                fila.style.display = 'none';

            }

        });


        const sinResultados =
            document.getElementById(
                'sinResultadosCoordinador'
            );

        sinResultados.style.display =
            filas.length > 0 && visibles === 0
                ? ''
                : 'none';

    });

</script>

@endpush