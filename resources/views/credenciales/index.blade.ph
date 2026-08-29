@extends('layouts.sica')

@section('titulo', 'Credenciales')

@section('contenido')

<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">

    <div>
        <h1>Credenciales</h1>
        <p>Consulta y generación de credenciales de afiliación SICA.</p>
    </div>

    <a href="{{ url('/credenciales/crear') }}" class="btn btn-sica">
        <i class="bi bi-person-vcard me-2"></i>
        Nueva credencial
    </a>

</div>


<div class="card card-sica">

    <div class="card-body p-4">

        <div class="row g-3 align-items-end mb-4">

            <div class="col-12 col-md-8 col-lg-6">

                <label for="buscadorCredenciales" class="form-label fw-bold">
                    Buscar credencial
                </label>

                <input
                    type="text"
                    id="buscadorCredenciales"
                    class="form-control"
                    placeholder="Folio, nombre, CURP o municipio..."
                >

            </div>

            <div class="col-12 col-md-4 col-lg-3">

                <label for="filtroCredencial" class="form-label fw-bold">
                    Estado
                </label>

                <select id="filtroCredencial" class="form-select">

                    <option value="">
                        Todas
                    </option>

                    <option value="activa">
                        Activa
                    </option>

                    <option value="vencida">
                        Vencida
                    </option>

                    <option value="cancelada">
                        Cancelada
                    </option>

                </select>

            </div>

        </div>


        <div class="table-responsive">

            <table
                class="table table-hover align-middle mb-0"
                id="tablaCredenciales"
            >

                <thead class="table-light">

                    <tr>
                        <th>Folio</th>
                        <th>Afiliado</th>
                        <th>Municipio</th>
                        <th>Emisión</th>
                        <th>Vigencia</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($credenciales ?? [] as $credencial)

                        @php

                            $afiliado =
                                $credencial->afiliado
                                ?? $credencial->afiliacion
                                ?? null;

                            $estadoCredencial =
                                strtolower(
                                    $credencial->estatus
                                    ?? $credencial->estado
                                    ?? 'activa'
                                );

                            if (
                                !empty($credencial->vigencia)
                                && \Carbon\Carbon::parse($credencial->vigencia)->isPast()
                                && $estadoCredencial === 'activa'
                            ) {
                                $estadoCredencial = 'vencida';
                            }

                            $badgeCredencial = match($estadoCredencial) {
                                'activa' => 'success',
                                'vencida' => 'warning',
                                'cancelada' => 'danger',
                                default => 'secondary',
                            };

                            $nombreAfiliado =
                                $afiliado->nombre
                                ?? $credencial->nombre
                                ?? 'Sin nombre';

                            $municipio =
                                $afiliado->municipio
                                ?? $credencial->municipio
                                ?? 'Sin municipio';

                            $curp =
                                $afiliado->curp
                                ?? $credencial->curp
                                ?? '';

                        @endphp


                        <tr
                            data-busqueda="
                                {{ strtolower(
                                    ($credencial->folio_credencial ?? '') . ' ' .
                                    $nombreAfiliado . ' ' .
                                    $curp . ' ' .
                                    $municipio
                                ) }}
                            "
                            data-estado="{{ $estadoCredencial }}"
                        >

                            <td>

                                <span class="fw-bold text-success">
                                    {{ $credencial->folio_credencial ?? 'Sin folio' }}
                                </span>

                            </td>


                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    <div
                                        class="rounded-3 bg-warning-subtle text-warning d-flex align-items-center justify-content-center"
                                        style="width:46px;height:46px;min-width:46px;"
                                    >
                                        <i class="bi bi-person-vcard fs-4"></i>
                                    </div>

                                    <div>

                                        <div class="fw-bold">
                                            {{ $nombreAfiliado }}
                                        </div>

                                        @if(!empty($curp))

                                            <small class="text-muted">
                                                {{ $curp }}
                                            </small>

                                        @else

                                            <small class="text-muted">
                                                CURP no registrada
                                            </small>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            <td>
                                {{ $municipio }}
                            </td>


                            <td>

                                @if(!empty($credencial->created_at))

                                    {{ \Carbon\Carbon::parse($credencial->created_at)->format('d/m/Y') }}

                                @else

                                    <span class="text-muted">
                                        Sin fecha
                                    </span>

                                @endif

                            </td>


                            <td>

                                @if(!empty($credencial->vigencia))

                                    {{ \Carbon\Carbon::parse($credencial->vigencia)->format('d/m/Y') }}

                                @else

                                    <span class="text-muted">
                                        Sin vigencia
                                    </span>

                                @endif

                            </td>


                            <td>

                                <span class="badge text-bg-{{ $badgeCredencial }}">
                                    {{ ucfirst($estadoCredencial) }}
                                </span>

                            </td>


                            <td class="text-end">

                                <div class="btn-group">

                                    @if(isset($credencial->id))

                                        <a
                                            href="{{ url('/credenciales/' . $credencial->id) }}"
                                            class="btn btn-sm btn-outline-primary"
                                            title="Ver credencial"
                                        >
                                            <i class="bi bi-eye"></i>
                                        </a>

                                    @endif


                                    @if(isset($credencial->id))

                                        <a
                                            href="{{ url('/credenciales/' . $credencial->id . '/imprimir') }}"
                                            class="btn btn-sm btn-outline-secondary"
                                            title="Imprimir credencial"
                                        >
                                            <i class="bi bi-printer"></i>
                                        </a>

                                    @endif

                                </div>

                            </td>

                        </tr>


                    @empty


                        <tr>

                            <td colspan="7" class="text-center py-5">

                                <div class="fs-1 text-muted mb-3">
                                    <i class="bi bi-person-vcard"></i>
                                </div>

                                <h5 class="fw-bold">
                                    No hay credenciales registradas
                                </h5>

                                <p class="text-muted">
                                    Cuando generes una credencial aparecerá aquí.
                                </p>

                                <a
                                    href="{{ url('/credenciales/crear') }}"
                                    class="btn btn-sica"
                                >
                                    <i class="bi bi-person-vcard me-2"></i>
                                    Crear primera credencial
                                </a>

                            </td>

                        </tr>


                    @endforelse


                    <tr
                        id="sinResultadosCredenciales"
                        style="display:none;"
                    >

                        <td colspan="7" class="text-center py-5">

                            <div class="fs-1 text-muted mb-3">
                                <i class="bi bi-search"></i>
                            </div>

                            <h5 class="fw-bold">
                                No se encontraron credenciales
                            </h5>

                            <p class="text-muted mb-0">
                                Intenta con otro folio, nombre, CURP o municipio.
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

    const buscadorCredenciales =
        document.getElementById('buscadorCredenciales');

    const filtroCredencial =
        document.getElementById('filtroCredencial');


    function filtrarCredenciales()
    {
        const texto =
            buscadorCredenciales.value
                .toLowerCase()
                .trim();

        const estado =
            filtroCredencial.value
                .toLowerCase();

        const filas =
            document.querySelectorAll(
                '#tablaCredenciales tbody tr[data-busqueda]'
            );

        let visibles = 0;


        filas.forEach(function(fila) {

            const contenido =
                fila.dataset.busqueda || '';

            const estadoFila =
                fila.dataset.estado || '';

            const coincideTexto =
                texto === ''
                || contenido.includes(texto);

            const coincideEstado =
                estado === ''
                || estadoFila === estado;


            if (coincideTexto && coincideEstado) {

                fila.style.display = '';
                visibles++;

            } else {

                fila.style.display = 'none';

            }

        });


        const sinResultados =
            document.getElementById(
                'sinResultadosCredenciales'
            );


        if (filas.length > 0 && visibles === 0) {

            sinResultados.style.display = '';

        } else {

            sinResultados.style.display = 'none';

        }
    }


    buscadorCredenciales.addEventListener(
        'input',
        filtrarCredenciales
    );

    filtroCredencial.addEventListener(
        'change',
        filtrarCredenciales
    );

</script>

@endpush