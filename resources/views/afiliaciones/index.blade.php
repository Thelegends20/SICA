@extends('layouts.sica')

@section('titulo', 'Afiliados')

@section('contenido')

<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
        <h1>Afiliados</h1>
        <p>Consulta y administración de personas registradas en SICA.</p>
    </div>

    <a href="{{ url('/afiliaciones/nueva') }}" class="btn btn-sica">
        <i class="bi bi-person-plus me-2"></i>
        Nueva afiliación
    </a>
</div>


<div class="card card-sica">
    <div class="card-body p-4">

        <div class="row g-3 align-items-end mb-4">

            <div class="col-12 col-md-8 col-lg-6">
                <label class="form-label fw-bold">
                    Buscar afiliado
                </label>

                <input
                    type="text"
                    id="buscadorAfiliados"
                    class="form-control"
                    placeholder="Nombre, folio, CURP, teléfono o municipio..."
                >
            </div>

            <div class="col-12 col-md-4 col-lg-3">
                <label class="form-label fw-bold">
                    Estado
                </label>

                <select id="filtroEstado" class="form-select">
                    <option value="">Todos</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                    <option value="suspendido">Suspendido</option>
                    <option value="baja">Baja</option>
                </select>
            </div>

        </div>


        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0" id="tablaAfiliados">

                <thead class="table-light">

                    <tr>
                        <th>Folio</th>
                        <th>Afiliado</th>
                        <th>Municipio</th>
                        <th>Teléfono</th>
                        <th>Vigencia</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($afiliaciones ?? [] as $afiliado)

                        @php
                            $estado = strtolower($afiliado->estatus ?? 'activo');

                            $badge = match($estado) {
                                'activo' => 'success',
                                'inactivo' => 'secondary',
                                'suspendido' => 'warning',
                                'baja' => 'danger',
                                default => 'secondary',
                            };
                        @endphp

                        <tr
                            data-busqueda="
                                {{ strtolower(
                                    ($afiliado->folio_afiliado ?? '') . ' ' .
                                    ($afiliado->nombre ?? '') . ' ' .
                                    ($afiliado->curp ?? '') . ' ' .
                                    ($afiliado->telefono ?? '') . ' ' .
                                    ($afiliado->municipio ?? '')
                                ) }}
                            "
                            data-estado="{{ $estado }}"
                        >

                            <td>
                                <span class="fw-bold text-success">
                                    {{ $afiliado->folio_afiliado ?? 'Sin folio' }}
                                </span>
                            </td>


                            <td>
                                <div class="d-flex align-items-center gap-3">

                                    <div
                                        class="rounded-circle bg-light border d-flex align-items-center justify-content-center"
                                        style="width:42px;height:42px;min-width:42px;"
                                    >
                                        <i class="bi bi-person fs-5 text-secondary"></i>
                                    </div>

                                    <div>
                                        <div class="fw-bold">
                                            {{ $afiliado->nombre ?? 'Sin nombre' }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $afiliado->curp ?? 'CURP no registrada' }}
                                        </small>
                                    </div>

                                </div>
                            </td>


                            <td>
                                {{ $afiliado->municipio ?? 'Sin municipio' }}
                            </td>


                            <td>
                                {{ $afiliado->telefono ?? 'Sin teléfono' }}
                            </td>


                            <td>
                                @if(!empty($afiliado->vigencia))

                                    <span>
                                        {{ \Carbon\Carbon::parse($afiliado->vigencia)->format('d/m/Y') }}
                                    </span>

                                @else

                                    <span class="text-muted">
                                        Sin vigencia
                                    </span>

                                @endif
                            </td>


                            <td>
                                <span class="badge text-bg-{{ $badge }}">
                                    {{ ucfirst($estado) }}
                                </span>
                            </td>


                            <td class="text-end">

                                <div class="btn-group">

                                    <a
                                        href="{{ url('/afiliaciones/' . $afiliado->id) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="Ver expediente"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a
                                        href="{{ url('/afiliaciones/' . $afiliado->id . '/editar') }}"
                                        class="btn btn-sm btn-outline-secondary"
                                        title="Editar"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr id="filaSinRegistros">

                            <td colspan="7" class="text-center py-5">

                                <div class="fs-1 text-muted mb-3">
                                    <i class="bi bi-people"></i>
                                </div>

                                <h5 class="fw-bold">
                                    No hay afiliados registrados
                                </h5>

                                <p class="text-muted">
                                    Cuando registres una afiliación aparecerá aquí.
                                </p>

                                <a
                                    href="{{ url('/afiliaciones/nueva') }}"
                                    class="btn btn-sica"
                                >
                                    <i class="bi bi-person-plus me-2"></i>
                                    Registrar primer afiliado
                                </a>

                            </td>

                        </tr>

                    @endforelse


                    <tr id="sinResultadosBusqueda" style="display:none;">

                        <td colspan="7" class="text-center py-5">

                            <div class="fs-1 text-muted mb-3">
                                <i class="bi bi-search"></i>
                            </div>

                            <h5 class="fw-bold">
                                No se encontraron resultados
                            </h5>

                            <p class="text-muted mb-0">
                                Intenta con otro nombre, folio o municipio.
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

    const buscador = document.getElementById('buscadorAfiliados');
    const filtroEstado = document.getElementById('filtroEstado');

    function filtrarAfiliados()
    {
        const texto = buscador.value.toLowerCase().trim();
        const estadoSeleccionado = filtroEstado.value.toLowerCase();

        const filas = document.querySelectorAll(
            '#tablaAfiliados tbody tr[data-busqueda]'
        );

        let visibles = 0;

        filas.forEach(function(fila) {

            const contenido = fila.dataset.busqueda || '';
            const estado = fila.dataset.estado || '';

            const coincideTexto =
                texto === '' || contenido.includes(texto);

            const coincideEstado =
                estadoSeleccionado === '' ||
                estado === estadoSeleccionado;

            if (coincideTexto && coincideEstado) {
                fila.style.display = '';
                visibles++;
            } else {
                fila.style.display = 'none';
            }

        });

        const mensajeSinResultados =
            document.getElementById('sinResultadosBusqueda');

        if (filas.length > 0 && visibles === 0) {
            mensajeSinResultados.style.display = '';
        } else {
            mensajeSinResultados.style.display = 'none';
        }
    }

    buscador.addEventListener('input', filtrarAfiliados);
    filtroEstado.addEventListener('change', filtrarAfiliados);

</script>

@endpush