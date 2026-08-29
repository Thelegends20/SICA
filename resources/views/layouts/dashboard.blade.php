@extends('layouts.sica')

@section('titulo', 'Dashboard')

@section('contenido')

<div class="page-header">
    <h1>Dashboard</h1>
    <p>Resumen general del sistema SICA.</p>
</div>

<div class="row g-4 mb-4">

    <div class="col-12 col-md-6 col-xl-3">
        <div class="card card-sica h-100">
            <div class="card-body d-flex align-items-center justify-content-between">

                <div>
                    <div class="text-muted small mb-1">
                        Afiliados
                    </div>

                    <div class="fs-2 fw-bold">
                        {{ $totalAfiliados ?? 0 }}
                    </div>

                    <div class="small text-success">
                        <i class="bi bi-people-fill me-1"></i>
                        Registrados
                    </div>
                </div>

                <div class="fs-1 text-success">
                    <i class="bi bi-people"></i>
                </div>

            </div>
        </div>
    </div>


    <div class="col-12 col-md-6 col-xl-3">
        <div class="card card-sica h-100">
            <div class="card-body d-flex align-items-center justify-content-between">

                <div>
                    <div class="text-muted small mb-1">
                        Vehículos
                    </div>

                    <div class="fs-2 fw-bold">
                        {{ $totalVehiculos ?? 0 }}
                    </div>

                    <div class="small text-primary">
                        <i class="bi bi-car-front-fill me-1"></i>
                        Registrados
                    </div>
                </div>

                <div class="fs-1 text-primary">
                    <i class="bi bi-car-front"></i>
                </div>

            </div>
        </div>
    </div>


    <div class="col-12 col-md-6 col-xl-3">
        <div class="card card-sica h-100">
            <div class="card-body d-flex align-items-center justify-content-between">

                <div>
                    <div class="text-muted small mb-1">
                        Credenciales
                    </div>

                    <div class="fs-2 fw-bold">
                        {{ $totalCredenciales ?? 0 }}
                    </div>

                    <div class="small text-warning">
                        <i class="bi bi-person-vcard-fill me-1"></i>
                        Emitidas
                    </div>
                </div>

                <div class="fs-1 text-warning">
                    <i class="bi bi-person-vcard"></i>
                </div>

            </div>
        </div>
    </div>


    <div class="col-12 col-md-6 col-xl-3">
        <div class="card card-sica h-100">
            <div class="card-body d-flex align-items-center justify-content-between">

                <div>
                    <div class="text-muted small mb-1">
                        Usuarios
                    </div>

                    <div class="fs-2 fw-bold">
                        {{ $totalUsuarios ?? 0 }}
                    </div>

                    <div class="small text-secondary">
                        <i class="bi bi-person-gear me-1"></i>
                        Con acceso
                    </div>
                </div>

                <div class="fs-1 text-secondary">
                    <i class="bi bi-person-gear"></i>
                </div>

            </div>
        </div>
    </div>

</div>


<div class="row g-4">

    <div class="col-12 col-xl-8">

        <div class="card card-sica">

            <div class="card-header bg-white border-0 pt-4 px-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                    <div>
                        <h5 class="mb-1 fw-bold">
                            Accesos rápidos
                        </h5>

                        <p class="text-muted mb-0 small">
                            Operaciones principales del sistema.
                        </p>
                    </div>

                    <i class="bi bi-grid fs-4 text-success"></i>

                </div>
            </div>


            <div class="card-body px-4 pb-4">

                <div class="row g-3">

                    <div class="col-12 col-md-6">

                        <a
                            href="{{ url('/afiliaciones/nueva') }}"
                            class="text-decoration-none"
                        >
                            <div class="border rounded-4 p-3 h-100 bg-light">

                                <div class="d-flex align-items-center gap-3">

                                    <div class="fs-3 text-success">
                                        <i class="bi bi-person-plus"></i>
                                    </div>

                                    <div>
                                        <div class="fw-bold text-dark">
                                            Nueva afiliación
                                        </div>

                                        <div class="small text-muted">
                                            Registrar un nuevo afiliado.
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </a>

                    </div>


                    <div class="col-12 col-md-6">

                        <a
                            href="{{ url('/vehiculos/nuevo') }}"
                            class="text-decoration-none"
                        >
                            <div class="border rounded-4 p-3 h-100 bg-light">

                                <div class="d-flex align-items-center gap-3">

                                    <div class="fs-3 text-primary">
                                        <i class="bi bi-car-front"></i>
                                    </div>

                                    <div>
                                        <div class="fw-bold text-dark">
                                            Registrar vehículo
                                        </div>

                                        <div class="small text-muted">
                                            Agregar una nueva unidad.
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </a>

                    </div>


                    <div class="col-12 col-md-6">

                        <a
                            href="{{ url('/credenciales') }}"
                            class="text-decoration-none"
                        >
                            <div class="border rounded-4 p-3 h-100 bg-light">

                                <div class="d-flex align-items-center gap-3">

                                    <div class="fs-3 text-warning">
                                        <i class="bi bi-person-vcard"></i>
                                    </div>

                                    <div>
                                        <div class="fw-bold text-dark">
                                            Credenciales
                                        </div>

                                        <div class="small text-muted">
                                            Consultar y generar credenciales.
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </a>

                    </div>


                    <div class="col-12 col-md-6">

                        <a
                            href="{{ url('/usuarios') }}"
                            class="text-decoration-none"
                        >
                            <div class="border rounded-4 p-3 h-100 bg-light">

                                <div class="d-flex align-items-center gap-3">

                                    <div class="fs-3 text-secondary">
                                        <i class="bi bi-person-gear"></i>
                                    </div>

                                    <div>
                                        <div class="fw-bold text-dark">
                                            Usuarios
                                        </div>

                                        <div class="small text-muted">
                                            Administrar accesos y roles.
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-12 col-xl-4">

        <div class="card card-sica h-100">

            <div class="card-header bg-white border-0 pt-4 px-4">

                <h5 class="fw-bold mb-1">
                    Estado del sistema
                </h5>

                <p class="text-muted small mb-0">
                    Información rápida de operación.
                </p>

            </div>


            <div class="card-body px-4">

                <div class="d-flex align-items-center justify-content-between py-3 border-bottom">

                    <div>
                        <div class="fw-bold">
                            Plataforma
                        </div>

                        <small class="text-muted">
                            SICA operativo
                        </small>
                    </div>

                    <span class="badge rounded-pill text-bg-success">
                        Activo
                    </span>

                </div>


                <div class="d-flex align-items-center justify-content-between py-3 border-bottom">

                    <div>
                        <div class="fw-bold">
                            Usuario actual
                        </div>

                        <small class="text-muted">
                            {{ auth()->user()->name ?? 'Usuario' }}
                        </small>
                    </div>

                    <i class="bi bi-person-check fs-4 text-success"></i>

                </div>


                <div class="d-flex align-items-center justify-content-between py-3">

                    <div>
                        <div class="fw-bold">
                            Rol
                        </div>

                        <small class="text-muted">
                            {{ auth()->user()->rol ?? 'Sin definir' }}
                        </small>
                    </div>

                    <i class="bi bi-shield-check fs-4 text-primary"></i>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="card card-sica mt-4">

    <div class="card-body p-4">

        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">

            <div>

                <h5 class="fw-bold mb-1">
                    SICA
                </h5>

                <p class="text-muted mb-0">
                    Sistema Integral de Control y Afiliación.
                </p>

            </div>

            <div class="text-end">

                <div class="small text-muted">
                    Sesión iniciada como
                </div>

                <div class="fw-bold">
                    {{ auth()->user()->name ?? 'Usuario' }}
                </div>

            </div>

        </div>

    </div>

</div>

@endsection