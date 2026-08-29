@extends('layouts.sica')

@section('titulo', 'Vehículos')

@section('contenido')

<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">

    <div>
        <h1>Vehículos</h1>
        <p>Consulta y administración de unidades registradas en SICA.</p>
    </div>

    <a href="{{ url('/vehiculos/nuevo') }}" class="btn btn-sica">
        <i class="bi bi-car-front me-2"></i>
        Registrar vehículo
    </a>

</div>


<div class="card card-sica">

    <div class="card-body p-4">

        <div class="row g-3 align-items-end mb-4">

            <div class="col-12 col-md-8 col-lg-6">

                <label for="buscadorVehiculos" class="form-label fw-bold">
                    Buscar vehículo
                </label>

                <input
                    type="text"
                    id="buscadorVehiculos"
                    class="form-control"
                    placeholder="Folio, marca, submarca, VIN, placas o propietario..."
                >

            </div>


            <div class="col-12 col-md-4 col-lg-3">

                <label for="filtroEstadoVehiculo" class="form-label fw-bold">
                    Estado
                </label>

                <select id="filtroEstadoVehiculo" class="form-select">

                    <option value="">
                        Todos
                    </option>

                    <option value="activo">
                        Activo
                    </option>

                    <option value="inactivo">
                        Inactivo
                    </option>

                    <option value="suspendido">
                        Suspendido
                    </option>

                    <option value="robado">
                        Robado
                    </option>

                    <option value="baja">
                        Baja
                    </option>

                </select>

            </div>

        </div>


        <div class="table-responsive">

            <table
                class="table table-hover align-middle mb-0"
                id="tablaVehiculos"
            >

                <thead class="table-light">

                    <tr>

                        <th>
                            Folio
                        </th>

                        <th>
                            Vehículo
                        </th>

                        <th>
                            Propietario
                        </th>

                        <th>
                            VIN
                        </th>

                        <th>
                            Vigencia
                        </th>

                        <th>
                            Estado
                        </th>

                        <th class="text-end">
                            Acciones
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($vehiculos ?? [] as $vehiculo)

                        @php

                            $estadoVehiculo = strtolower(
                                $vehiculo->estatus ?? 'activo'
                            );

                            $badgeVehiculo = match($estadoVehiculo) {
                                'activo' => 'success',
                                'inactivo' => 'secondary',
                                'suspendido' => 'warning',
                                'robado' => 'danger',
                                'baja' => 'dark',
                                default => 'secondary',
                            };

                            $nombreAfiliado =
                                $vehiculo->afiliado->nombre
                                ?? $vehiculo->afiliacion->nombre
                                ?? 'Sin propietario';

                        @endphp


                        <tr
                            data-busqueda="
                                {{ strtolower(
                                    ($vehiculo->folio_vehiculo ?? '') . ' ' .
                                    ($vehiculo->marca ?? '') . ' ' .
                                    ($vehiculo->submarca ?? '') . ' ' .
                                    ($vehiculo->vin ?? '') . ' ' .
                                    ($vehiculo->placas ?? '') . ' ' .
                                    $nombreAfiliado
                                ) }}
                            "
                            data-estado="{{ $estadoVehiculo }}"
                        >

                            <td>

                                <span class="fw-bold text-success">
                                    {{ $vehiculo->folio_vehiculo ?? 'Sin folio' }}
                                </span>

                            </td>


                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    <div
                                        class="rounded-3 bg-primary-subtle text-primary d-flex align-items-center justify-content-center"
                                        style="width:46px;height:46px;min-width:46px;"
                                    >
                                        <i class="bi bi-car-front fs-4"></i>
                                    </div>

                                    <div>

                                        <div class="fw-bold">

                                            {{ $vehiculo->marca ?? 'Sin marca' }}

                                            {{ $vehiculo->submarca ?? '' }}

                                        </div>

                                        <small class="text-muted">

                                            {{ $vehiculo->anio ?? $vehiculo->año ?? 'Sin año' }}

                                            @if(!empty($vehiculo->color))
                                                · {{ $vehiculo->color }}
                                            @endif

                                        </small>

                                    </div>

                                </div>

                            </td>


                            <td>

                                <div class="fw-semibold">
                                    {{ $nombreAfiliado }}
                                </div>

                                @if(
                                    isset($vehiculo->afiliado->folio_afiliado)
                                    || isset($vehiculo->afiliacion->folio_afiliado)
                                )

                                    <small class="text-muted">

                                        {{
                                            $vehiculo->afiliado->folio_afiliado
                                            ?? $vehiculo->afiliacion->folio_afiliado
                                        }}

                                    </small>

                                @endif

                            </td>


                            <td>

                                @if(!empty($vehiculo->vin))

                                    <span
                                        class="font-monospace"
                                        style="font-size:13px;"
                                    >
                                        {{ $vehiculo->vin }}
                                    </span>

                                @else

                                    <span class="text-muted">
                                        Sin VIN
                                    </span>

                                @endif

                            </td>


                            <td>

                                @if(!empty($vehiculo->vigencia))

                                    {{ \Carbon\Carbon::parse($vehiculo->vigencia)->format('d/m/Y') }}

                                @else

                                    <span class="text-muted">
                                        Sin vigencia
                                    </span>

                                @endif

                            </td>


                            <td>

                                <span class="badge text-bg-{{ $badgeVehiculo }}">
                                    {{ ucfirst($estadoVehiculo) }}
                                </span>

                            </td>


                            <td class="text-end">

                                <div class="btn-group">

                                    <a
                                        href="{{ url('/vehiculos/' . $vehiculo->id) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="Ver vehículo"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a
                                        href="{{ url('/vehiculos/' . $vehiculo->id . '/editar') }}"
                                        class="btn btn-sm btn-outline-secondary"
                                        title="Editar vehículo"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                </div>

                            </td>

                        </tr>


                    @empty


                        <tr id="filaVehiculosVacia">

                            <td
                                colspan="7"
                                class="text-center py-5"
                            >

                                <div class="fs-1 text-muted mb-3">
                                    <i class="bi bi-car-front"></i>
                                </div>

                                <h5 class="fw-bold">
                                    No hay vehículos registrados
                                </h5>

                                <p class="text-muted">
                                    Cuando registres una unidad aparecerá aquí.
                                </p>

                                <a
                                    href="{{ url('/vehiculos/nuevo') }}"
                                    class="btn btn-sica"
                                >
                                    <i class="bi bi-plus-circle me-2"></i>
                                    Registrar primer vehículo
                                </a>

                            </td>

                        </tr>


                    @endforelse


                    <tr
                        id="sinResultadosVehiculos"
                        style="display:none;"
                    >

                        <td
                            colspan="7"
                            class="text-center py-5"
                        >

                            <div class="fs-1 text-muted mb-3">
                                <i class="bi bi-search"></i>
                            </div>

                            <h5 class="fw-bold">
                                No se encontraron vehículos
                            </h5>

                            <p class="text-muted mb-0">
                                Intenta con otro folio, VIN, placa, marca o propietario.
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

    const buscadorVehiculos =
        document.getElementById('buscadorVehiculos');

    const filtroEstadoVehiculo =
        document.getElementById('filtroEstadoVehiculo');


    function filtrarVehiculos()
    {
        const texto =
            buscadorVehiculos.value
                .toLowerCase()
                .trim();

        const estadoSeleccionado =
            filtroEstadoVehiculo.value
                .toLowerCase();

        const filas =
            document.querySelectorAll(
                '#tablaVehiculos tbody tr[data-busqueda]'
            );

        let visibles = 0;


        filas.forEach(function(fila) {

            const contenido =
                fila.dataset.busqueda || '';

            const estado =
                fila.dataset.estado || '';

            const coincideTexto =
                texto === ''
                || contenido.includes(texto);

            const coincideEstado =
                estadoSeleccionado === ''
                || estado === estadoSeleccionado;


            if (coincideTexto && coincideEstado) {

                fila.style.display = '';
                visibles++;

            } else {

                fila.style.display = 'none';

            }

        });


        const sinResultados =
            document.getElementById(
                'sinResultadosVehiculos'
            );


        if (filas.length > 0 && visibles === 0) {

            sinResultados.style.display = '';

        } else {

            sinResultados.style.display = 'none';

        }
    }


    buscadorVehiculos.addEventListener(
        'input',
        filtrarVehiculos
    );


    filtroEstadoVehiculo.addEventListener(
        'change',
        filtrarVehiculos
    );

</script>

@endpush