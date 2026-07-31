<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('titulo') | SICA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>

        body{

            background:#f4f6f9;

        }

        .sidebar{

            position:fixed;

            width:250px;

            height:100vh;

            background:#198754;

            color:white;

            padding:20px;

        }

        .sidebar h3{

            text-align:center;

            margin-bottom:30px;

        }

        .sidebar a{

            display:block;

            color:white;

            text-decoration:none;

            padding:12px;

            border-radius:8px;

            margin-bottom:8px;

        }

        .sidebar a:hover{

            background:rgba(255,255,255,.15);

        }

        .main{

            margin-left:270px;

            padding:30px;

        }

        .topbar{

            background:white;

            border-radius:10px;

            padding:15px;

            margin-bottom:25px;

            display:flex;

            justify-content:space-between;

            align-items:center;

            box-shadow:0 0 10px rgba(0,0,0,.05);

        }

        .card{

            border:none;

            box-shadow:0 0 10px rgba(0,0,0,.05);

        }

    </style>

</head>

<body>

<div class="sidebar">

    <h3>SICA</h3>

    <a href="{{ route('dashboard') }}">
        <i class="bi bi-speedometer2"></i>
        Dashboard
    </a>

    <a href="{{ route('afiliados.index') }}">
        <i class="bi bi-people-fill"></i>
        Afiliados
    </a>

    <a href="{{ route('vehiculos.index') }}">
        <i class="bi bi-car-front-fill"></i>
        Vehículos
    </a>

    <a href="{{ route('usuarios.index') }}">
        <i class="bi bi-person-workspace"></i>
        Usuarios
    </a>

    <a href="{{ route('configuracion.index') }}">
        <i class="bi bi-gear-fill"></i>
        Configuración
    </a>

</div>

<div class="main">

    <div class="topbar">

        <div>

            <strong>{{ Auth::user()->name }}</strong>

            <br>

            <small>{{ Auth::user()->rol }}</small>

        </div>

        <form method="POST" action="{{ route('logout') }}">

            @csrf

            <button class="btn btn-danger">

                <i class="bi bi-box-arrow-right"></i>

                Cerrar sesión

            </button>

        </form>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    @yield('contenido')

</div>

</body>

</html>