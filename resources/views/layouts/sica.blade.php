<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('titulo', 'SICA') | SICA</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

    <style>
        :root {
            --sica-verde: #198754;
            --sica-verde-oscuro: #146c43;
            --sica-verde-profundo: #0f5132;
            --sica-fondo: #f4f6f9;
            --sica-texto: #212529;
            --sica-gris: #6c757d;
            --sica-borde: #dee2e6;
            --sidebar-width: 250px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--sica-fondo);
            color: var(--sica-texto);
            font-family: Arial, Helvetica, sans-serif;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background:
                linear-gradient(
                    180deg,
                    var(--sica-verde-profundo) 0%,
                    var(--sica-verde) 58%,
                    var(--sica-verde-oscuro) 100%
                );
            color: white;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 3px 0 14px rgba(0,0,0,.11);
        }

        .sidebar-header {
            padding: 18px 16px 14px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,.14);
        }

        .sidebar-logo {
            width: 52px;
            height: 52px;
            margin: 0 auto 8px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.22);
            font-size: 26px;
        }

        .sidebar-header h3 {
            margin: 0;
            font-size: 22px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .sidebar-header small {
            display: block;
            margin-top: 3px;
            font-size: 10px;
            color: rgba(255,255,255,.75);
        }

        .sidebar-menu {
            padding: 12px 10px 24px;
        }

        .menu-label {
            margin: 14px 9px 6px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: rgba(255,255,255,.55);
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 9px 11px;
            margin-bottom: 4px;
            color: white;
            text-decoration: none;
            border-radius: 9px;
            transition: .18s ease;
            font-size: 14px;
        }

        .sidebar-link i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        .sidebar-link:hover {
            color: white;
            background: rgba(255,255,255,.13);
        }

        .sidebar-link.active {
            background: white;
            color: var(--sica-verde-profundo);
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(0,0,0,.12);
        }

        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 900;
            min-height: 58px;
            background: white;
            border-bottom: 1px solid var(--sica-borde);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,.035);
        }

        .topbar-title {
            display: flex;
            flex-direction: column;
        }

        .topbar-title strong {
            font-size: 16px;
        }

        .topbar-title span {
            font-size: 11px;
            color: var(--sica-gris);
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #e9f5ee;
            color: var(--sica-verde-profundo);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        .content {
            padding: 18px;
        }

        .page-header {
            margin-bottom: 14px;
        }

        .page-header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 800;
        }

        .page-header p {
            margin: 4px 0 0;
            color: var(--sica-gris);
            font-size: 13px;
        }

        .card-sica {
            border: 0;
            border-radius: 14px;
            box-shadow: 0 3px 12px rgba(0,0,0,.055);
        }

        .btn-sica {
            background: var(--sica-verde);
            border-color: var(--sica-verde);
            color: white;
        }

        .btn-sica:hover {
            background: var(--sica-verde-oscuro);
            border-color: var(--sica-verde-oscuro);
            color: white;
        }

        .mobile-header {
            display: none;
        }

        .sidebar-overlay {
            display: none;
        }

        @media (max-width: 991px) {
            .sidebar {
                left: calc(-1 * var(--sidebar-width));
                transition: left .25s ease;
            }

            .sidebar.show {
                left: 0;
            }

            .main-wrapper {
                margin-left: 0;
            }

            .mobile-header {
                display: inline-flex;
            }

            .sidebar-overlay {
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,.45);
                z-index: 950;
            }

            .sidebar-overlay.show {
                display: block;
            }

            .content {
                padding: 12px;
            }

            .topbar {
                padding: 8px 12px;
            }

            .user-info-text {
                display: none;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

<div
    class="sidebar-overlay"
    id="sidebarOverlay"
    onclick="cerrarSidebar()"
></div>

<aside class="sidebar" id="sidebar">

    <div class="sidebar-header">

        <div class="sidebar-logo">
            <i class="bi bi-shield-check"></i>
        </div>

        <h3>SICA</h3>

        <small>Sistema Integral de Control y Afiliación</small>

    </div>

    <nav class="sidebar-menu">

        <div class="menu-label">
            Principal
        </div>

        <a
            href="{{ url('/dashboard') }}"
            class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}"
        >
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>


        <div class="menu-label">
            Expedientes
        </div>

        <a
            href="{{ url('/afiliaciones') }}"
            class="sidebar-link {{ request()->is('afiliaciones*') ? 'active' : '' }}"
        >
            <i class="bi bi-folder2-open"></i>
            <span>Afiliados</span>
        </a>

        <a
            href="{{ url('/afiliaciones/nueva') }}"
            class="sidebar-link {{ request()->is('afiliaciones/nueva') ? 'active' : '' }}"
        >
            <i class="bi bi-person-plus"></i>
            <span>Nueva afiliación</span>
        </a>


        <div class="menu-label">
            Administración
        </div>

        <a
            href="{{ url('/usuarios') }}"
            class="sidebar-link {{ request()->is('usuarios*') ? 'active' : '' }}"
        >
            <i class="bi bi-person-gear"></i>
            <span>Usuarios</span>
        </a>

        <a
            href="{{ url('/configuracion') }}"
            class="sidebar-link {{ request()->is('configuracion*') ? 'active' : '' }}"
        >
            <i class="bi bi-gear"></i>
            <span>Configuración</span>
        </a>

        <a
            href="{{ url('/auditoria') }}"
            class="sidebar-link {{ request()->is('auditoria*') ? 'active' : '' }}"
        >
            <i class="bi bi-clock-history"></i>
            <span>Auditoría</span>
        </a>


        <div class="menu-label">
            Sesión
        </div>

        <form
            method="POST"
            action="{{ route('logout') }}"
        >
            @csrf

            <button
                type="submit"
                class="sidebar-link border-0 bg-transparent text-start"
            >
                <i class="bi bi-box-arrow-left"></i>
                <span>Cerrar sesión</span>
            </button>
        </form>

    </nav>

</aside>


<div class="main-wrapper">

    <header class="topbar">

        <div class="d-flex align-items-center gap-3">

            <button
                type="button"
                class="btn btn-outline-success mobile-header"
                onclick="abrirSidebar()"
            >
                <i class="bi bi-list"></i>
            </button>

            <div class="topbar-title">
                <strong>@yield('titulo', 'SICA')</strong>
                <span>Panel administrativo</span>
            </div>

        </div>

        <div class="topbar-user">

            <div class="user-info-text text-end">

                <div class="fw-bold">
                    {{ auth()->user()->name ?? 'Usuario' }}
                </div>

                <small class="text-muted">
                    {{ auth()->user()->rol ?? 'SICA' }}
                </small>

            </div>

            <div class="user-avatar">
                <i class="bi bi-person"></i>
            </div>

        </div>

    </header>


    <main class="content">

        @if(session('success'))
            <div
                class="alert alert-success alert-dismissible fade show"
                role="alert"
            >
                <i class="bi bi-check-circle me-2"></i>

                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>
            </div>
        @endif


        @if(session('error'))
            <div
                class="alert alert-danger alert-dismissible fade show"
                role="alert"
            >
                <i class="bi bi-exclamation-triangle me-2"></i>

                {{ session('error') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>
            </div>
        @endif


        @if($errors->any())
            <div
                class="alert alert-danger alert-dismissible fade show"
                role="alert"
            >

                <strong>
                    Revisa la información:
                </strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>

            </div>
        @endif


        @yield('contenido')

    </main>

</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

<script>
    function abrirSidebar()
    {
        document
            .getElementById('sidebar')
            .classList
            .add('show');

        document
            .getElementById('sidebarOverlay')
            .classList
            .add('show');
    }

    function cerrarSidebar()
    {
        document
            .getElementById('sidebar')
            .classList
            .remove('show');

        document
            .getElementById('sidebarOverlay')
            .classList
            .remove('show');
    }
</script>

@stack('scripts')

</body>
</html>