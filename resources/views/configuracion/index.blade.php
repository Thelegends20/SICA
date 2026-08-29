@extends('layouts.sica')

@section('titulo', 'Configuración')

@section('contenido')

<div class="page-header">

    <h1>Configuración</h1>

    <p>
        Administración general del sistema SICA.
    </p>

</div>


<div class="row g-4">


    <div class="col-12 col-md-6 col-xl-4">

        <a
            href="{{ url('/configuracion/administradores') }}"
            class="text-decoration-none"
        >

            <div class="card card-sica h-100">

                <div class="card-body p-4">

                    <div class="d-flex align-items-start gap-3">

                        <div
                            class="rounded-3 bg-success-subtle text-success d-flex align-items-center justify-content-center"
                            style="width:52px;height:52px;min-width:52px;"
                        >
                            <i class="bi bi-person-badge fs-4"></i>
                        </div>


                        <div>

                            <h5 class="fw-bold text-dark mb-1">
                                Administradores
                            </h5>

                            <p class="text-muted mb-0">
                                Gestión de usuarios con acceso administrativo.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </a>

    </div>


    <div class="col-12 col-md-6 col-xl-4">

        <a
            href="{{ url('/configuracion/coordinadores') }}"
            class="text-decoration-none"
        >

            <div class="card card-sica h-100">

                <div class="card-body p-4">

                    <div class="d-flex align-items-start gap-3">

                        <div
                            class="rounded-3 bg-primary-subtle text-primary d-flex align-items-center justify-content-center"
                            style="width:52px;height:52px;min-width:52px;"
                        >
                            <i class="bi bi-people fs-4"></i>
                        </div>


                        <div>

                            <h5 class="fw-bold text-dark mb-1">
                                Coordinadores
                            </h5>

                            <p class="text-muted mb-0">
                                Administración de coordinadores y accesos operativos.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </a>

    </div>


    <div class="col-12 col-md-6 col-xl-4">

        <a
            href="{{ url('/configuracion/folios') }}"
            class="text-decoration-none"
        >

            <div class="card card-sica h-100">

                <div class="card-body p-4">

                    <div class="d-flex align-items-start gap-3">

                        <div
                            class="rounded-3 bg-warning-subtle text-warning d-flex align-items-center justify-content-center"
                            style="width:52px;height:52px;min-width:52px;"
                        >
                            <i class="bi bi-upc-scan fs-4"></i>
                        </div>


                        <div>

                            <h5 class="fw-bold text-dark mb-1">
                                Folios
                            </h5>

                            <p class="text-muted mb-0">
                                Control de series y numeración interna de SICA.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </a>

    </div>


    <div class="col-12 col-md-6 col-xl-4">

        <a
            href="{{ url('/configuracion/parametros') }}"
            class="text-decoration-none"
        >

            <div class="card card-sica h-100">

                <div class="card-body p-4">

                    <div class="d-flex align-items-start gap-3">

                        <div
                            class="rounded-3 bg-info-subtle text-info d-flex align-items-center justify-content-center"
                            style="width:52px;height:52px;min-width:52px;"
                        >
                            <i class="bi bi-sliders fs-4"></i>
                        </div>


                        <div>

                            <h5 class="fw-bold text-dark mb-1">
                                Parámetros
                            </h5>

                            <p class="text-muted mb-0">
                                Valores generales y comportamiento del sistema.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </a>

    </div>


    <div class="col-12 col-md-6 col-xl-4">

        <a
            href="{{ url('/configuracion/permisos') }}"
            class="text-decoration-none"
        >

            <div class="card card-sica h-100">

                <div class="card-body p-4">

                    <div class="d-flex align-items-start gap-3">

                        <div
                            class="rounded-3 bg-danger-subtle text-danger d-flex align-items-center justify-content-center"
                            style="width:52px;height:52px;min-width:52px;"
                        >
                            <i class="bi bi-shield-lock fs-4"></i>
                        </div>


                        <div>

                            <h5 class="fw-bold text-dark mb-1">
                                Permisos
                            </h5>

                            <p class="text-muted mb-0">
                                Control de privilegios y acceso por rol.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </a>

    </div>


    <div class="col-12 col-md-6 col-xl-4">

        <a
            href="{{ url('/configuracion/respaldos') }}"
            class="text-decoration-none"
        >

            <div class="card card-sica h-100">

                <div class="card-body p-4">

                    <div class="d-flex align-items-start gap-3">

                        <div
                            class="rounded-3 bg-secondary-subtle text-secondary d-flex align-items-center justify-content-center"
                            style="width:52px;height:52px;min-width:52px;"
                        >
                            <i class="bi bi-database-check fs-4"></i>
                        </div>


                        <div>

                            <h5 class="fw-bold text-dark mb-1">
                                Respaldos
                            </h5>

                            <p class="text-muted mb-0">
                                Copias de seguridad y protección de información.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </a>

    </div>

</div>


<div class="card card-sica mt-4">

    <div class="card-body p-4">

        <div class="d-flex align-items-center gap-3">

            <div
                class="rounded-3 bg-success-subtle text-success d-flex align-items-center justify-content-center"
                style="width:52px;height:52px;min-width:52px;"
            >
                <i class="bi bi-check-circle fs-4"></i>
            </div>


            <div>

                <div class="fw-bold">
                    Sistema operativo
                </div>

                <div class="text-muted small">
                    Panel de configuración general de SICA disponible.
                </div>

            </div>

        </div>

    </div>

</div>

@endsection