@extends('layouts.sica')

@section('titulo', 'Auditoría')

@section('contenido')

<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">

    <div>
        <h1>Auditoría</h1>
        <p>Historial de acciones realizadas dentro del sistema SICA.</p>
    </div>

    <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-2"></i>
        Regresar
    </a>

</div>


<div class="card card-sica">

    <div class="card-body p-4">

        <div class="row g-3 align-items-end mb-4">

            <div class="col-12 col-md-6">

                <label for="buscarAuditoria" class="form-label fw-bold">
                    Buscar
                </label>

                <input
                    type="text"
                    id="buscarAuditoria"
                    class="form-control"
                    placeholder="Usuario, acción, módulo o descripción..."
                >

            </div>


            <div class="col-12 col-md-3">

                <label for="filtroModulo" class="form-label fw-bold">
                    Módulo
                </label>

                <select id="filtroModulo" class="form-select">

                    <option value="">
                        Todos
                    </option>

                    <option value="afiliaciones">
                        Afiliaciones
                    </option>

                    <option value="vehiculos">
                        Vehículos
                    </option>

                    <option value="credenciales">
                        Credenciales
                    </option>

                    <option value="usuarios">
                        Usuarios
                    </option>

                    <option value="configuracion">
                        Configuración
                    </option>

                    <option value="sistema">
                        Sistema
                    </option>

                </select>

            </div>


            <div class="col-12 col-md-3">

                <label for="filtroAccion" class="form-label fw-bold">
                    Acción
                </label>

                <select id="filtroAccion" class="form-select">

                    <option value="">
                        Todas
                    </option>

                    <option value="crear">
                        Crear
                    </option>

                    <option value="editar">
                        Editar
                    </option>

                    <option value="eliminar">
                        Eliminar
                    </option>

                    <option value="login">
                        Inicio de sesión
                    </option>

                    <option value="logout">
                        Cierre de sesión
                    </option>

                    <option value="consultar">
                        Consulta
                    </option>

                </select>

            </div>

        </div>


        <div class="table-responsive">

            <table
                class="table table-hover align-middle mb-0"
                id="tablaAuditoria"
            >

                <thead class="table-light">

                    <tr>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Módulo</th>
                        <th>Acción</th>
                        <th>Descripción</th>
                        <th>IP</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($auditorias ?? $registros ?? [] as $registro)

                        @php

                            $usuarioNombre =
                                $registro->usuario->name
                                ?? $registro->usuario_nombre
                                ?? $registro->usuario
                                ?? 'Sistema';

                            $modulo =
                                strtolower(
                                    $registro->modulo
                                    ?? 'sistema'
                                );

                            $accion =
                                strtolower(
                                    $registro->accion
                                    ?? 'consultar'
                                );

                            $descripcion =
                                $registro->descripcion
                                ?? $registro->detalle
                                ?? $registro->mensaje
                                ?? 'Sin descripción';

                            $badgeAccion = match($accion) {

                                'crear' => 'success',
                                'creado' => 'success',

                                'editar' => 'primary',
                                'actualizar' => 'primary',
                                'actualizado' => 'primary',

                                'eliminar' => 'danger',
                                'eliminado' => 'danger',

                                'login' => 'info',
                                'logout' => 'secondary',

                                'consultar' => 'warning',

                                default => 'secondary',

                            };

                        @endphp


                        <tr
                            data-busqueda="{{ strtolower(
                                $usuarioNombre . ' ' .
                                $modulo . ' ' .
                                $accion . ' ' .
                                $descripcion
                            ) }}"
                            data-modulo="{{ $modulo }}"
                            data-accion="{{ $accion }}"
                        >

                            <td>

                                @if(!empty($registro->created_at))

                                    <div class="fw-bold">
                                        {{ \Carbon\Carbon::parse($registro->created_at)->format('d/m/Y') }}
                                    </div>

                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($registro->created_at)->format('H:i:s') }}
                                    </small>

                                @elseif(!empty($registro->fecha))

                                    <div class="fw-bold">
                                        {{ \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y') }}
                                    </div>

                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($registro->fecha)->format('H:i:s') }}
                                    </small>

                                @else

                                    <span class="text-muted">
                                        Sin fecha
                                    </span>

                                @endif

                            </td>


                            <td>

                                <div class="d-flex align-items-center gap-2">

                                    <div
                                        class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                        style="width:38px;height:38px;min-width:38px;"
                                    >
                                        <i class="bi bi-person text-secondary"></i>
                                    </div>

                                    <div>

                                        <div class="fw-bold">
                                            {{ $usuarioNombre }}
                                        </div>

                                        @if(isset($registro->usuario_id))

                                            <small class="text-muted">
                                                ID: {{ $registro->usuario_id }}
                                            </small>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            <td>

                                <span class="badge text-bg-light border text-dark">
                                    {{ ucfirst($modulo) }}
                                </span>

                            </td>


                            <td>

                                <span class="badge text-bg-{{ $badgeAccion }}">
                                    {{ ucfirst($accion) }}
                                </span>

                            </td>


                            <td style="min-width:240px;">
                                {{ $descripcion }}
                            </td>


                            <td>

                                <code>
                                    {{ $registro->ip ?? $registro->direccion_ip ?? 'No registrada' }}
                                </code>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="6" class="text-center py-5">

                                <div class="fs-1 text-muted mb-3">
                                    <i class="bi bi-clock-history"></i>
                                </div>

                                <h5 class="fw-bold">
                                    No hay movimientos registrados
                                </h5>

                                <p class="text-muted mb-0">
                                    Las acciones realizadas dentro de SICA aparecerán aquí.
                                </p>

                            </td>

                        </tr>

                    @endforelse


                    <tr
                        id="sinResultadosAuditoria"
                        style="display:none;"
                    >

                        <td colspan="6" class="text-center py-5">

                            <div class="fs-1 text-muted mb-3">
                                <i class="bi bi-search"></i>
                            </div>

                            <h5 class="fw-bold">
                                Sin resultados
                            </h5>

                            <p class="text-muted mb-0">
                                No se encontraron registros con esos filtros.
                            </p>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>


<div class="alert alert-light border mt-4">

    <div class="d-flex gap-3">

        <i class="bi bi-shield-check fs-4 text-success"></i>

        <div>

            <div class="fw-bold">
                Registro de seguridad
            </div>

            <div class="small text-muted">
                La auditoría permite identificar quién realizó cada movimiento y cuándo ocurrió.
            </div>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>

    const buscarAuditoria =
        document.getElementById('buscarAuditoria');

    const filtroModulo =
        document.getElementById('filtroModulo');

    const filtroAccion =
        document.getElementById('filtroAccion');


    function filtrarAuditoria()
    {
        const texto =
            buscarAuditoria.value
                .toLowerCase()
                .trim();

        const modulo =
            filtroModulo.value
                .toLowerCase();

        const accion =
            filtroAccion.value
                .toLowerCase();

        const filas =
            document.querySelectorAll(
                '#tablaAuditoria tbody tr[data-busqueda]'
            );

        let visibles = 0;


        filas.forEach(function (fila) {

            const contenido =
                fila.dataset.busqueda || '';

            const moduloFila =
                fila.dataset.modulo || '';

            const accionFila =
                fila.dataset.accion || '';


            const coincideTexto =
                texto === ''
                || contenido.includes(texto);

            const coincideModulo =
                modulo === ''
                || moduloFila === modulo;

            const coincideAccion =
                accion === ''
                || accionFila === accion;


            if (
                coincideTexto
                && coincideModulo
                && coincideAccion
            ) {

                fila.style.display = '';
                visibles++;

            } else {

                fila.style.display = 'none';

            }

        });


        const sinResultados =
            document.getElementById(
                'sinResultadosAuditoria'
            );


        sinResultados.style.display =
            filas.length > 0 && visibles === 0
                ? ''
                : 'none';
    }


    buscarAuditoria.addEventListener(
        'input',
        filtrarAuditoria
    );

    filtroModulo.addEventListener(
        'change',
        filtrarAuditoria
    );

    filtroAccion.addEventListener(
        'change',
        filtrarAuditoria
    );

</script>

@endpush