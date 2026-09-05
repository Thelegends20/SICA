@extends('layouts.sica')

@section('titulo', 'Expediente del vehículo')

@section('contenido')

@php
    $registro = $vehiculo ?? null;

    $estadoVehiculo = strtolower($registro->estatus ?? 'activo');

    $badgeVehiculo = match($estadoVehiculo) {
        'activo' => 'success',
        'inactivo' => 'secondary',
        'suspendido' => 'warning',
        'robado' => 'danger',
        'baja' => 'dark',
        default => 'secondary',
    };

    $propietario =
        $registro->afiliado
        ?? $registro->afiliacion
        ?? null;

    $documentos =
        $registro
        ? $registro->documentos()
            ->orderByDesc('created_at')
            ->get()
        : collect();

    $totalDocumentos = $documentos->count();

    $documentosValidados =
        $documentos
            ->where('estatus', 'VALIDADO')
            ->count();

    $documentosPendientes =
        $documentos
            ->where('estatus', 'PENDIENTE')
            ->count();

    $documentosObservados =
        $documentos
            ->where('estatus', 'OBSERVADO')
            ->count();
@endphp


<div class="page-header d-flex justify-content-between align-items-start flex-wrap gap-3">

    <div>
        <h1>Expediente del vehículo</h1>
        <p>Consulta completa de la unidad registrada en SICA.</p>
    </div>

    <div class="d-flex gap-2 flex-wrap">

        <a
            href="{{ url('/vehiculos') }}"
            class="btn btn-outline-secondary"
        >
            <i class="bi bi-arrow-left me-2"></i>
            Regresar
        </a>

        @if(isset($registro->id))
            <a
                href="{{ url('/vehiculos/' . $registro->id . '/editar') }}"
                class="btn btn-outline-primary"
            >
                <i class="bi bi-pencil me-2"></i>
                Editar
            </a>
        @endif

    </div>

</div>


@if(session('success'))

    <div class="alert alert-success alert-dismissible fade show">

        <i class="bi bi-check-circle me-2"></i>

        {{ session('success') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
        ></button>

    </div>

@endif


@if($errors->any())

    <div class="alert alert-danger">

        <div class="fw-bold mb-2">
            <i class="bi bi-exclamation-triangle me-2"></i>
            Revisa los datos enviados
        </div>

        <ul class="mb-0">

            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>

    </div>

@endif


@if($registro)

<div class="row g-4">

    <div class="col-12 col-xl-8">


        {{-- INFORMACIÓN PRINCIPAL --}}

        <div class="card card-sica mb-4">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <div class="d-flex align-items-center gap-3">

                    <div
                        class="rounded-3 bg-primary-subtle text-primary d-flex align-items-center justify-content-center"
                        style="width:64px;height:64px;min-width:64px;"
                    >
                        <i class="bi bi-car-front fs-2"></i>
                    </div>

                    <div class="flex-grow-1">

                        <div class="d-flex align-items-center gap-2 flex-wrap">

                            <h4 class="fw-bold mb-0">

                                {{ $registro->marca ?? 'Sin marca' }}

                                {{ $registro->submarca ?? '' }}

                            </h4>

                            <span class="badge text-bg-{{ $badgeVehiculo }}">
                                {{ ucfirst($estadoVehiculo) }}
                            </span>

                        </div>

                        <div class="text-muted mt-1">
                            {{ $registro->folio_vehiculo ?? 'Folio no asignado' }}
                        </div>

                    </div>

                </div>

            </div>


            <div class="card-body p-4">

                <div class="row g-4">

                    <div class="col-12 col-md-4">

                        <div class="text-muted small">
                            Año
                        </div>

                        <div class="fw-bold">
                            {{ $registro->anio ?? $registro->año ?? 'No registrado' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-4">

                        <div class="text-muted small">
                            Color
                        </div>

                        <div class="fw-bold">
                            {{ $registro->color ?? 'No registrado' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-4">

                        <div class="text-muted small">
                            Placas
                        </div>

                        <div class="fw-bold">
                            {{ $registro->placas ?? 'No registradas' }}
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- IDENTIFICACIÓN --}}

        <div class="card card-sica mb-4">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <div class="d-flex align-items-center gap-3">

                    <div
                        class="rounded-3 bg-warning-subtle text-warning d-flex align-items-center justify-content-center"
                        style="width:48px;height:48px;"
                    >
                        <i class="bi bi-upc-scan fs-4"></i>
                    </div>

                    <div>

                        <h5 class="fw-bold mb-1">
                            Identificación de la unidad
                        </h5>

                        <p class="text-muted small mb-0">
                            Números de serie y datos técnicos.
                        </p>

                    </div>

                </div>

            </div>


            <div class="card-body p-4">

                <div class="row g-4">

                    <div class="col-12">

                        <div class="text-muted small">
                            VIN / Número de serie
                        </div>

                        <div class="fw-bold font-monospace fs-5">
                            {{ $registro->vin ?? 'No registrado' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="text-muted small">
                            Motor
                        </div>

                        <div class="fw-bold">
                            {{ $registro->motor ?? 'No registrado' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="text-muted small">
                            Serie de motor
                        </div>

                        <div class="fw-bold">
                            {{ $registro->serie_motor ?? 'No registrada' }}
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- PROPIETARIO --}}

        <div class="card card-sica mb-4">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>

                        <h5 class="fw-bold mb-1">
                            Propietario / Afiliado
                        </h5>

                        <p class="text-muted small mb-0">
                            Persona vinculada a esta unidad.
                        </p>

                    </div>

                    @if(isset($propietario->id))

                        <a
                            href="{{ url('/afiliaciones/' . $propietario->id) }}"
                            class="btn btn-sm btn-outline-success"
                        >
                            <i class="bi bi-person me-2"></i>
                            Ver afiliado
                        </a>

                    @endif

                </div>

            </div>


            <div class="card-body p-4">

                @if($propietario)

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center"
                            style="width:56px;height:56px;min-width:56px;"
                        >
                            <i class="bi bi-person fs-3"></i>
                        </div>

                        <div>

                            <div class="fw-bold fs-5">
                                {{ $propietario->nombre ?? 'Sin nombre' }}
                            </div>

                            <div class="text-muted">
                                {{ $propietario->folio_afiliado ?? 'Sin folio' }}
                            </div>

                            @if(!empty($propietario->telefono))
                                <div class="small mt-1">
                                    <i class="bi bi-telephone me-1"></i>
                                    {{ $propietario->telefono }}
                                </div>
                            @endif

                        </div>

                    </div>

                @else

                    <div class="text-center py-4">

                        <div class="fs-1 text-muted mb-3">
                            <i class="bi bi-person-x"></i>
                        </div>

                        <h6 class="fw-bold">
                            Sin afiliado vinculado
                        </h6>

                        <p class="text-muted mb-0">
                            No se encontró información del propietario.
                        </p>

                    </div>

                @endif

            </div>

        </div>


        {{-- EXPEDIENTE DOCUMENTAL --}}

        <div class="card card-sica mb-4">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="rounded-3 bg-info-subtle text-info d-flex align-items-center justify-content-center"
                            style="width:48px;height:48px;min-width:48px;"
                        >
                            <i class="bi bi-folder2-open fs-4"></i>
                        </div>

                        <div>

                            <h5 class="fw-bold mb-1">
                                Documentación del expediente
                            </h5>

                            <p class="text-muted small mb-0">
                                Archivos privados vinculados a esta unidad.
                            </p>

                        </div>

                    </div>

                    <span class="badge text-bg-dark fs-6">
                        {{ $totalDocumentos }}
                        {{ $totalDocumentos === 1 ? 'documento' : 'documentos' }}
                    </span>

                </div>

            </div>


            <div class="card-body p-4">

                <div class="row g-3 mb-4">

                    <div class="col-6 col-md-3">

                        <div class="border rounded-3 p-3 h-100">

                            <div class="text-muted small">
                                Total
                            </div>

                            <div class="fw-bold fs-4">
                                {{ $totalDocumentos }}
                            </div>

                        </div>

                    </div>


                    <div class="col-6 col-md-3">

                        <div class="border rounded-3 p-3 h-100">

                            <div class="text-muted small">
                                Validados
                            </div>

                            <div class="fw-bold fs-4 text-success">
                                {{ $documentosValidados }}
                            </div>

                        </div>

                    </div>


                    <div class="col-6 col-md-3">

                        <div class="border rounded-3 p-3 h-100">

                            <div class="text-muted small">
                                Pendientes
                            </div>

                            <div class="fw-bold fs-4 text-warning">
                                {{ $documentosPendientes }}
                            </div>

                        </div>

                    </div>


                    <div class="col-6 col-md-3">

                        <div class="border rounded-3 p-3 h-100">

                            <div class="text-muted small">
                                Observados
                            </div>

                            <div class="fw-bold fs-4 text-danger">
                                {{ $documentosObservados }}
                            </div>

                        </div>

                    </div>

                </div>


                <div class="border rounded-3 p-4 mb-4">

                    <div class="d-flex align-items-center gap-2 mb-3">

                        <i class="bi bi-cloud-arrow-up fs-5"></i>

                        <h6 class="fw-bold mb-0">
                            Agregar documento
                        </h6>

                    </div>


                    <form
                        method="POST"
                        action="{{ route('vehiculos.documentos.store', $registro->id) }}"
                        enctype="multipart/form-data"
                    >

                        @csrf

                        <div class="row g-3">

                            <div class="col-12 col-md-6">

                                <label
                                    for="tipo_documento"
                                    class="form-label fw-bold"
                                >
                                    Tipo de documento
                                </label>

                                <select
                                    id="tipo_documento"
                                    name="tipo_documento"
                                    class="form-select"
                                    required
                                >

                                    <option value="">
                                        Selecciona el tipo
                                    </option>

                                    <option value="TITULO_PROPIEDAD">
                                        Título / Documento de propiedad
                                    </option>

                                    <option value="INE">
                                        INE del propietario
                                    </option>

                                    <option value="LICENCIA">
                                        Licencia de conducir
                                    </option>

                                    <option value="COMPROBANTE_DOMICILIO">
                                        Comprobante de domicilio
                                    </option>

                                    <option value="INSPECCION_FISICA">
                                        Inspección física
                                    </option>

                                    <option value="CARFAX">
                                        Carfax / Reporte vehicular
                                    </option>

                                    <option value="FOTOGRAFIA_VEHICULO">
                                        Fotografía del vehículo
                                    </option>

                                    <option value="FACTURA">
                                        Factura
                                    </option>

                                    <option value="PEDIMENTO">
                                        Pedimento
                                    </option>

                                    <option value="OTRO">
                                        Otro documento
                                    </option>

                                </select>

                            </div>


                            <div class="col-12 col-md-6">

                                <label
                                    for="archivo"
                                    class="form-label fw-bold"
                                >
                                    Archivo
                                </label>

                                <input
                                    type="file"
                                    id="archivo"
                                    name="archivo"
                                    class="form-control"
                                    accept=".pdf,.jpg,.jpeg,.png,.webp"
                                    required
                                >

                                <div class="form-text">
                                    PDF, JPG, PNG o WEBP. Máximo 10 MB.
                                </div>

                            </div>


                            <div class="col-12">

                                <label
                                    for="observaciones"
                                    class="form-label fw-bold"
                                >
                                    Observaciones
                                </label>

                                <textarea
                                    id="observaciones"
                                    name="observaciones"
                                    class="form-control"
                                    rows="2"
                                    placeholder="Opcional"
                                >{{ old('observaciones') }}</textarea>

                            </div>


                            <div class="col-12">

                                <button
                                    type="submit"
                                    class="btn btn-sica"
                                >
                                    <i class="bi bi-cloud-arrow-up me-2"></i>
                                    Agregar al expediente
                                </button>

                            </div>

                        </div>

                    </form>

                </div>


                @if($documentos->isEmpty())

                    <div class="text-center py-5">

                        <div class="fs-1 text-muted mb-3">
                            <i class="bi bi-folder2"></i>
                        </div>

                        <h6 class="fw-bold">
                            Expediente documental vacío
                        </h6>

                        <p class="text-muted mb-0">
                            Todavía no se han agregado documentos a esta unidad.
                        </p>

                    </div>

                @else

                    <div class="d-grid gap-3">

                        @foreach($documentos as $documento)

                            @php
                                $estadoDocumento =
                                    strtoupper(
                                        $documento->estatus
                                        ?? 'PENDIENTE'
                                    );

                                $badgeDocumento = match($estadoDocumento) {
                                    'VALIDADO' => 'success',
                                    'OBSERVADO' => 'danger',
                                    'PENDIENTE' => 'warning',
                                    default => 'secondary',
                                };

                                $iconoDocumento =
                                    str_contains(
                                        strtolower($documento->mime_type ?? ''),
                                        'pdf'
                                    )
                                    ? 'bi-file-earmark-pdf'
                                    : 'bi-file-earmark-image';

                                $tamanoDocumento =
                                    $documento->tamano
                                    ? number_format(
                                        $documento->tamano / 1024,
                                        1
                                    ) . ' KB'
                                    : 'Tamaño desconocido';

                                $tipoVisible = match($documento->tipo_documento) {
                                    'TITULO_PROPIEDAD' =>
                                        'Título / Documento de propiedad',

                                    'INE' =>
                                        'INE del propietario',

                                    'LICENCIA' =>
                                        'Licencia de conducir',

                                    'COMPROBANTE_DOMICILIO' =>
                                        'Comprobante de domicilio',

                                    'INSPECCION_FISICA' =>
                                        'Inspección física',

                                    'CARFAX' =>
                                        'Carfax / Reporte vehicular',

                                    'FOTOGRAFIA_VEHICULO' =>
                                        'Fotografía del vehículo',

                                    'FACTURA' =>
                                        'Factura',

                                    'PEDIMENTO' =>
                                        'Pedimento',

                                    'OTRO' =>
                                        'Otro documento',

                                    default =>
                                        str_replace(
                                            '_',
                                            ' ',
                                            $documento->tipo_documento
                                        ),
                                };
                            @endphp


                            <div class="border rounded-3 p-3">

                                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">

                                    <div class="d-flex align-items-start gap-3">

                                        <div
                                            class="rounded-3 bg-light d-flex align-items-center justify-content-center"
                                            style="width:48px;height:48px;min-width:48px;"
                                        >
                                            <i class="bi {{ $iconoDocumento }} fs-4"></i>
                                        </div>


                                        <div>

                                            <div class="d-flex align-items-center gap-2 flex-wrap">

                                                <div class="fw-bold">
                                                    {{ $tipoVisible }}
                                                </div>

                                                <span class="badge text-bg-{{ $badgeDocumento }}">
                                                    {{ $estadoDocumento }}
                                                </span>

                                            </div>

                                            <div class="small text-muted mt-1">

                                                {{ $documento->nombre_original ?? 'Archivo sin nombre' }}

                                                <span class="mx-1">•</span>

                                                {{ $tamanoDocumento }}

                                            </div>

                                            <div class="small text-muted">

                                                Subido:

                                                {{ optional($documento->created_at)->format('d/m/Y H:i') ?? 'Sin fecha' }}

                                            </div>

                                        </div>

                                    </div>


                                    <div class="d-flex gap-2 flex-wrap">

                                        <a
                                            href="{{ route('vehiculos.documentos.ver', $documento->id) }}"
                                            class="btn btn-sm btn-outline-primary"
                                            target="_blank"
                                        >
                                            <i class="bi bi-eye me-1"></i>
                                            Ver
                                        </a>

                                        <a
                                            href="{{ route('vehiculos.documentos.descargar', $documento->id) }}"
                                            class="btn btn-sm btn-outline-secondary"
                                        >
                                            <i class="bi bi-download me-1"></i>
                                            Descargar
                                        </a>

                                    </div>

                                </div>


                                @if(!empty($documento->observaciones))

                                    <div class="alert alert-light border mt-3 mb-3 py-2">

                                        <div class="small text-muted">
                                            Observaciones
                                        </div>

                                        <div>
                                            {{ $documento->observaciones }}
                                        </div>

                                    </div>

                                @endif


                                <div class="border-top pt-3 mt-3">

                                    <form
                                        method="POST"
                                        action="{{ route('vehiculos.documentos.update', $documento->id) }}"
                                    >

                                        @csrf
                                        @method('PUT')

                                        <div class="row g-2 align-items-end">

                                            <div class="col-12 col-md-4">

                                                <label class="form-label small fw-bold">
                                                    Estado de revisión
                                                </label>

                                                <select
                                                    name="estatus"
                                                    class="form-select form-select-sm"
                                                    required
                                                >

                                                    <option
                                                        value="PENDIENTE"
                                                        {{ $estadoDocumento === 'PENDIENTE' ? 'selected' : '' }}
                                                    >
                                                        Pendiente
                                                    </option>

                                                    <option
                                                        value="VALIDADO"
                                                        {{ $estadoDocumento === 'VALIDADO' ? 'selected' : '' }}
                                                    >
                                                        Validado
                                                    </option>

                                                    <option
                                                        value="OBSERVADO"
                                                        {{ $estadoDocumento === 'OBSERVADO' ? 'selected' : '' }}
                                                    >
                                                        Observado
                                                    </option>

                                                </select>

                                            </div>


                                            <div class="col-12 col-md-5">

                                                <label class="form-label small fw-bold">
                                                    Observaciones de revisión
                                                </label>

                                                <input
                                                    type="text"
                                                    name="observaciones"
                                                    class="form-control form-control-sm"
                                                    value="{{ $documento->observaciones }}"
                                                    placeholder="Opcional"
                                                >

                                            </div>


                                            <div class="col-12 col-md-3">

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-outline-success w-100"
                                                >
                                                    <i class="bi bi-check2-circle me-1"></i>
                                                    Guardar revisión
                                                </button>

                                            </div>

                                        </div>

                                    </form>


                                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">

                                        <div class="small text-muted">

                                            @if(!empty($documento->revisado_at))

                                                Última revisión:

                                                {{ \Carbon\Carbon::parse($documento->revisado_at)->format('d/m/Y H:i') }}

                                            @else

                                                Sin revisión registrada

                                            @endif

                                        </div>


                                        <form
                                            method="POST"
                                            action="{{ route('vehiculos.documentos.destroy', $documento->id) }}"
                                            onsubmit="return confirm('¿Eliminar este documento del expediente? Esta acción no se puede deshacer.');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                            >
                                                <i class="bi bi-trash me-1"></i>
                                                Eliminar
                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @endif

            </div>

        </div>


        {{-- IDENTIFICACIÓN SICA --}}

        <div class="card card-sica">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <div class="d-flex align-items-center gap-3">

                    <div
                        class="rounded-3 bg-success-subtle text-success d-flex align-items-center justify-content-center"
                        style="width:48px;height:48px;"
                    >
                        <i class="bi bi-qr-code fs-4"></i>
                    </div>

                    <div>

                        <h5 class="fw-bold mb-1">
                            Identificación SICA
                        </h5>

                        <p class="text-muted small mb-0">
                            Datos internos de control y verificación.
                        </p>

                    </div>

                </div>

            </div>


            <div class="card-body p-4">

                <div class="row g-4">

                    <div class="col-12 col-md-6">

                        <div class="text-muted small">
                            Folio del vehículo
                        </div>

                        <div class="fw-bold text-success">
                            {{ $registro->folio_vehiculo ?? 'No asignado' }}
                        </div>

                    </div>


                    <div class="col-12 col-md-6">

                        <div class="text-muted small">
                            Token QR
                        </div>

                        @if(!empty($registro->token_qr))

                            <div
                                class="font-monospace text-break"
                                style="font-size:13px;"
                            >
                                {{ $registro->token_qr }}
                            </div>

                        @else

                            <div class="text-muted">
                                No generado
                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- COLUMNA DERECHA --}}

    <div class="col-12 col-xl-4">


        {{-- ESTADO --}}

        <div class="card card-sica mb-4">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <h5 class="fw-bold mb-1">
                    Estado de la unidad
                </h5>

                <p class="text-muted small mb-0">
                    Control operativo actual.
                </p>

            </div>


            <div class="card-body p-4">

                <div class="py-3 border-bottom">

                    <div class="text-muted small">
                        Estatus
                    </div>

                    <div class="mt-1">

                        <span class="badge text-bg-{{ $badgeVehiculo }}">
                            {{ ucfirst($estadoVehiculo) }}
                        </span>

                    </div>

                </div>


                <div class="py-3 border-bottom">

                    <div class="text-muted small">
                        Vigencia
                    </div>

                    <div class="fw-bold">

                        @if(!empty($registro->vigencia))

                            {{ \Carbon\Carbon::parse($registro->vigencia)->format('d/m/Y') }}

                        @else

                            No registrada

                        @endif

                    </div>

                </div>


                <div class="py-3">

                    <div class="text-muted small">
                        Fecha de registro
                    </div>

                    <div class="fw-bold">

                        @if(!empty($registro->created_at))

                            {{ \Carbon\Carbon::parse($registro->created_at)->format('d/m/Y H:i') }}

                        @else

                            Sin información

                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- RESUMEN DOCUMENTAL --}}

        <div class="card card-sica mb-4">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <h5 class="fw-bold mb-1">
                    Estado del expediente
                </h5>

                <p class="text-muted small mb-0">
                    Resumen de documentación.
                </p>

            </div>


            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center py-2 border-bottom">

                    <span class="text-muted">
                        Documentos
                    </span>

                    <span class="fw-bold">
                        {{ $totalDocumentos }}
                    </span>

                </div>


                <div class="d-flex justify-content-between align-items-center py-2 border-bottom">

                    <span class="text-muted">
                        Validados
                    </span>

                    <span class="badge text-bg-success">
                        {{ $documentosValidados }}
                    </span>

                </div>


                <div class="d-flex justify-content-between align-items-center py-2 border-bottom">

                    <span class="text-muted">
                        Pendientes
                    </span>

                    <span class="badge text-bg-warning">
                        {{ $documentosPendientes }}
                    </span>

                </div>


                <div class="d-flex justify-content-between align-items-center py-2">

                    <span class="text-muted">
                        Observados
                    </span>

                    <span class="badge text-bg-danger">
                        {{ $documentosObservados }}
                    </span>

                </div>

            </div>

        </div>


        {{-- ACCIONES --}}

        <div class="card card-sica">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <h5 class="fw-bold mb-1">
                    Acciones
                </h5>

                <p class="text-muted small mb-0">
                    Herramientas disponibles para esta unidad.
                </p>

            </div>


            <div class="card-body p-4 d-grid gap-2">

                @if(isset($registro->id))

                    <a
                        href="{{ url('/vehiculos/' . $registro->id . '/editar') }}"
                        class="btn btn-outline-primary"
                    >
                        <i class="bi bi-pencil me-2"></i>
                        Editar vehículo
                    </a>

                    <a
                        href="{{ url('/vehiculos/' . $registro->id . '/qr') }}"
                        class="btn btn-outline-success"
                    >
                        <i class="bi bi-qr-code me-2"></i>
                        Ver QR
                    </a>

                    <a
                        href="#expediente-documental"
                        class="btn btn-outline-info"
                        onclick="
                            document.querySelector(
                                '.bi-folder2-open'
                            )?.closest('.card')?.scrollIntoView({
                                behavior: 'smooth'
                            });
                            return false;
                        "
                    >
                        <i class="bi bi-folder2-open me-2"></i>
                        Documentación
                    </a>

                @endif


                @if(isset($propietario->id))

                    <a
                        href="{{ url('/afiliaciones/' . $propietario->id) }}"
                        class="btn btn-outline-secondary"
                    >
                        <i class="bi bi-person me-2"></i>
                        Ver expediente del afiliado
                    </a>

                @endif

            </div>

        </div>

    </div>

</div>


@else

<div class="card card-sica">

    <div class="card-body text-center py-5">

        <div class="fs-1 text-danger mb-3">
            <i class="bi bi-exclamation-triangle"></i>
        </div>

        <h4 class="fw-bold">
            Vehículo no encontrado
        </h4>

        <p class="text-muted">
            No se encontró la unidad solicitada.
        </p>

        <a
            href="{{ url('/vehiculos') }}"
            class="btn btn-sica"
        >
            Regresar a vehículos
        </a>

    </div>

</div>

@endif

@endsection