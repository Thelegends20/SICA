@extends('layouts.sica')

@section('titulo', 'Administradores')

@section('contenido')

<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">

    <div>
        <h1>Administradores</h1>
        <p>Consulta de usuarios con privilegios administrativos dentro de SICA.</p>
    </div>

    <a href="{{ url('/configuracion') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>
        Regresar
    </a>

</div>


<div class="card card-sica">

    <div class="card-body p-4">

        <div class="mb-4">

            <label for="buscarAdministrador" class="form-label fw-bold">
                Buscar administrador
            </label>

            <input
                type="text"
                id="buscarAdministrador"
                class="form-control"
                placeholder="Nombre o correo electrónico..."
            >

        </div>


        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0" id="tablaAdministradores">

                <thead class="table-light">

                    <tr>
                        <th>Administrador</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Registro</th>
                        <th class="text-end">Acciones</th>
                    </tr>

                </thead>


                <tbody>

                    @php
                        $listaAdministradores =
                            $administradores
                            ?? collect($usuarios ?? [])->filter(function ($usuario) {
                                return strtoupper($usuario->rol ?? '') === 'ADMIN_PRINCIPAL';
                            });
                    @endphp


                    @forelse($listaAdministradores as $usuario)

                        <tr
                            data-busqueda="{{ strtolower(($usuario->name ?? '') . ' ' . ($usuario->email ?? '')) }}"
                        >

                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    <div
                                        class="rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center"
                                        style="width:46px;height:46px;min-width:46px;"
                                    >
                                        <i class="bi bi-person-badge fs-4"></i>
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
                                <span class="badge text-bg-success">
                                    Administrador principal
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
                                    <i class="bi bi-person-badge"></i>
                                </div>

                                <h5 class="fw-bold">
                                    No hay administradores registrados
                                </h5>

                                <p class="text-muted mb-0">
                                    Los usuarios ADMIN_PRINCIPAL aparecerán aquí.
                                </p>

                            </td>

                        </tr>

                    @endforelse


                    <tr id="sinResultadosAdmin" style="display:none;">

                        <td colspan="5" class="text-center py-5">

                            <i class="bi bi-search fs-1 text-muted"></i>

                            <h5 class="fw-bold mt-3">
                                Sin resultados
                            </h5>

                            <p class="text-muted mb-0">
                                No encontramos administradores con esa búsqueda.
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

    const buscarAdministrador =
        document.getElementById('buscarAdministrador');

    buscarAdministrador.addEventListener('input', function () {

        const texto =
            this.value.toLowerCase().trim();

        const filas =
            document.querySelectorAll(
                '#tablaAdministradores tbody tr[data-busqueda]'
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

        document.getElementById('sinResultadosAdmin').style.display =
            filas.length > 0 && visibles === 0
                ? ''
                : 'none';

    });

</script>

@endpush