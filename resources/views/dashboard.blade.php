@extends('layouts.sica')

@section('titulo', 'Dashboard')

@section('contenido')

<style>
    .sica-dashboard {
        padding-bottom: 30px;
    }

    .sica-header {
        background: linear-gradient(135deg, #0f5132, #198754);
        border-radius: 18px;
        padding: 26px;
        color: white;
        margin-bottom: 25px;
        box-shadow: 0 8px 24px rgba(0,0,0,.12);
    }

    .sica-header h2 {
        margin: 0;
        font-weight: 700;
    }

    .sica-header p {
        margin: 6px 0 0;
        opacity: .88;
    }

    .stat-card {
        border: none;
        border-radius: 16px;
        padding: 22px;
        background: white;
        box-shadow: 0 5px 18px rgba(0,0,0,.07);
        transition: .2s ease;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0,0,0,.10);
    }

    .stat-icon {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 14px;
    }

    .icon-green {
        background: #d1e7dd;
        color: #0f5132;
    }

    .icon-blue {
        background: #cfe2ff;
        color: #084298;
    }

    .icon-yellow {
        background: #fff3cd;
        color: #664d03;
    }

    .icon-red {
        background: #f8d7da;
        color: #842029;
    }

    .stat-title {
        color: #6c757d;
        font-size: 14px;
        margin-bottom: 6px;
    }

    .stat-number {
        font-size: 30px;
        font-weight: 700;
        line-height: 1;
    }

    .panel-card {
        background: white;
        border-radius: 18px;
        border: none;
        box-shadow: 0 5px 18px rgba(0,0,0,.07);
        padding: 22px;
        height: 100%;
    }

    .panel-card h5 {
        font-weight: 700;
        margin-bottom: 18px;
    }

    .quick-btn {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        border-radius: 12px;
        text-decoration: none;
        margin-bottom: 10px;
        background: #f8f9fa;
        color: #212529;
        border: 1px solid #e9ecef;
        transition: .2s ease;
    }

    .quick-btn:hover {
        background: #198754;
        color: white;
        border-color: #198754;
    }

    .quick-btn i {
        font-size: 20px;
    }

    .status-row {
        padding: 12px 0;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .status-row:last-child {
        border-bottom: none;
    }

    .badge-soft-success {
        background: #d1e7dd;
        color: #0f5132;
        padding: 7px 11px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-soft-warning {
        background: #fff3cd;
        color: #664d03;
        padding: 7px 11px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-soft-danger {
        background: #f8d7da;
        color: #842029;
        padding: 7px 11px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .system-box {
        background: #f8f9fa;
        border-radius: 14px;
        padding: 16px;
        margin-top: 14px;
    }

    @media (max-width: 767px) {
        .sica-header {
            padding: 20px;
        }

        .stat-number {
            font-size: 26px;
        }
    }
</style>

<div class="sica-dashboard">

    {{-- ENCABEZADO --}}
    <div class="sica-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div>
                <h2>
                    <i class="bi bi-grid-1x2-fill me-2"></i>
                    Panel SICA
                </h2>

                <p>
                    Sistema Integral de Control de Afiliaciones
                </p>
            </div>

            <div class="text-end">
                <div class="small opacity-75">
                    {{ now()->format('d/m/Y') }}
                </div>

                <div class="fw-semibold">
                    {{ auth()->user()->name ?? 'Usuario SICA' }}
                </div>
            </div>

        </div>
    </div>


    {{-- TARJETAS PRINCIPALES --}}
    <div class="row g-4 mb-4">

        {{-- AFILIADOS --}}
        <div class="col-6 col-md-3">
            <div class="stat-card">

                <div class="stat-icon icon-green">
                    <i class="bi bi-people-fill"></i>
                </div>

                <div class="stat-title">
                    Afiliados
                </div>

                <div class="stat-number">
                    {{ $afiliados ?? 0 }}
                </div>

            </div>
        </div>


        {{-- VEHÍCULOS --}}
        <div class="col-6 col-md-3">
            <div class="stat-card">

                <div class="stat-icon icon-blue">
                    <i class="bi bi-car-front-fill"></i>
                </div>

                <div class="stat-title">
                    Vehículos
                </div>

                <div class="stat-number">
                    {{ $vehiculos ?? 0 }}
                </div>

            </div>
        </div>


        {{-- CREDENCIALES --}}
        <div class="col-6 col-md-3">
            <div class="stat-card">

                <div class="stat-icon icon-yellow">
                    <i class="bi bi-person-vcard-fill"></i>
                </div>

                <div class="stat-title">
                    Credenciales
                </div>

                <div class="stat-number">
                    {{ $credenciales ?? 0 }}
                </div>

            </div>
        </div>


        {{-- VIGENCIAS --}}
        <div class="col-6 col-md-3">
            <div class="stat-card">

                <div class="stat-icon icon-red">
                    <i class="bi bi-calendar-check-fill"></i>
                </div>

                <div class="stat-title">
                    Por vencer
                </div>

                <div class="stat-number">
                    {{ $porVencer ?? 0 }}
                </div>

            </div>
        </div>

    </div>


    {{-- SEGUNDA FILA --}}
    <div class="row g-4">

        {{-- ACCIONES RÁPIDAS --}}
        <div class="col-lg-5">

            <div class="panel-card">

                <h5>
                    <i class="bi bi-lightning-charge-fill text-warning me-2"></i>
                    Acciones rápidas
                </h5>


                <a href="{{ route('afiliaciones.nueva') }}"
                   class="quick-btn">

                    <i class="bi bi-person-plus-fill"></i>

                    <div>
                        <strong>Nueva afiliación</strong>
                        <div class="small">
                            Registrar nuevo afiliado
                        </div>
                    </div>

                </a>


                <a href="{{ route('vehiculos.nuevo') }}"
                   class="quick-btn">

                    <i class="bi bi-car-front-fill"></i>

                    <div>
                        <strong>Registrar vehículo</strong>
                        <div class="small">
                            Agregar vehículo al sistema
                        </div>
                    </div>

                </a>


                <a href="{{ route('afiliaciones.index') }}"
                   class="quick-btn">

                    <i class="bi bi-search"></i>

                    <div>
                        <strong>Buscar afiliación</strong>
                        <div class="small">
                            Consultar expedientes
                        </div>
                    </div>

                </a>


                <a href="{{ route('vehiculos.index') }}"
                   class="quick-btn">

                    <i class="bi bi-qr-code-scan"></i>

                    <div>
                        <strong>Consultar vehículos</strong>
                        <div class="small">
                            Revisar registro y QR
                        </div>
                    </div>

                </a>

            </div>

        </div>


        {{-- ESTADO DEL SISTEMA --}}
        <div class="col-lg-7">

            <div class="panel-card">

                <h5>
                    <i class="bi bi-activity text-success me-2"></i>
                    Estado general
                </h5>


                <div class="status-row">

                    <span>
                        Afiliaciones activas
                    </span>

                    <span class="badge-soft-success">
                        {{ $afiliadosActivos ?? $afiliados ?? 0 }}
                    </span>

                </div>


                <div class="status-row">

                    <span>
                        Vehículos activos
                    </span>

                    <span class="badge-soft-success">
                        {{ $vehiculosActivos ?? $vehiculos ?? 0 }}
                    </span>

                </div>


                <div class="status-row">

                    <span>
                        Vigencias próximas a vencer
                    </span>

                    <span class="badge-soft-warning">
                        {{ $porVencer ?? 0 }}
                    </span>

                </div>


                <div class="status-row">

                    <span>
                        Registros suspendidos
                    </span>

                    <span class="badge-soft-danger">
                        {{ $suspendidos ?? 0 }}
                    </span>

                </div>


                <div class="system-box">

                    <div class="row">

                        <div class="col-md-6 mb-3 mb-md-0">

                            <small class="text-muted">
                                Organización
                            </small>

                            <div class="fw-semibold">
                                SICA
                            </div>

                        </div>


                        <div class="col-md-6">

                            <small class="text-muted">
                                Año operativo
                            </small>

                            <div class="fw-semibold">
                                {{ date('Y') }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- MÓDULOS --}}
    <div class="row g-4 mt-1">

        <div class="col-12">

            <div class="panel-card">

                <h5>
                    <i class="bi bi-boxes me-2 text-success"></i>
                    Módulos del sistema
                </h5>


                <div class="row g-3">


                    <div class="col-6 col-md-3">

                        <a href="{{ route('afiliaciones.index') }}"
                           class="quick-btn mb-0">

                            <i class="bi bi-people"></i>

                            <span>
                                Afiliaciones
                            </span>

                        </a>

                    </div>


                    <div class="col-6 col-md-3">

                        <a href="{{ route('vehiculos.index') }}"
                           class="quick-btn mb-0">

                            <i class="bi bi-car-front"></i>

                            <span>
                                Vehículos
                            </span>

                        </a>

                    </div>


                    <div class="col-6 col-md-3">

                        <a href="{{ route('credenciales.index') }}"
                           class="quick-btn mb-0">

                            <i class="bi bi-person-vcard"></i>

                            <span>
                                Credenciales
                            </span>

                        </a>

                    </div>


                    <div class="col-6 col-md-3">

                        <a href="{{ route('usuarios.index') }}"
                           class="quick-btn mb-0">

                            <i class="bi bi-person-gear"></i>

                            <span>
                                Usuarios
                            </span>

                        </a>

                    </div>


                </div>

            </div>

        </div>

    </div>


    {{-- PIE --}}
    <div class="text-center text-muted mt-4 small">

        SICA · Sistema Integral de Control de Afiliaciones
        <br>

        Plataforma de identificación y administración vehicular

    </div>

</div>

@endsection