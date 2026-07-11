<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SICA | @yield('titulo')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            background:#eef2f7;
            font-family:Segoe UI,Tahoma,Geneva,Verdana,sans-serif;
        }

        /*==========================
            SIDEBAR
        ==========================*/

        .sidebar{

            position:fixed;

            left:0;

            top:0;

            width:260px;

            height:100vh;

            background:#0b5e35;

            color:#fff;

            overflow-y:auto;

            box-shadow:3px 0 12px rgba(0,0,0,.15);

        }

        .sidebar h3{

            text-align:center;

            padding:25px;

            font-weight:bold;

            border-bottom:1px solid rgba(255,255,255,.15);

            margin-bottom:10px;

        }

        .sidebar a{

            display:block;

            color:white;

            text-decoration:none;

            padding:14px 22px;

            transition:.25s;

            font-size:15px;

        }

        .sidebar a i{

            margin-right:10px;

        }

        .sidebar a:hover{

            background:#198754;

            padding-left:30px;

        }

        /*==========================
            CONTENIDO
        ==========================*/

        .main{

            margin-left:260px;

            padding:30px;

            min-height:100vh;

        }

        /*==========================
            CARDS
        ==========================*/

        .card{

            border:none;

            border-radius:15px;

            box-shadow:0 5px 15px rgba(0,0,0,.08);

        }

        .card-header{

            font-weight:bold;

        }

        /*==========================
            TABLAS
        ==========================*/

        .table{

            background:white;

        }

        /*==========================
            BOTONES
        ==========================*/

        .btn{

            border-radius:10px;

        }

    </style>

</head>

<body>

<div class="sidebar">

    <h3>
        SICA
    </h3>

    <a href="/">
        <i class="bi bi-speedometer2"></i>
        Dashboard
    </a>

    <a href="/afiliados">
        <i class="bi bi-people-fill"></i>
        Afiliados
    </a>

    <a href="/vehiculos">
        <i class="bi bi-car-front-fill"></i>
        Vehículos
    </a>

    <a href="#">
        <i class="bi bi-card-heading"></i>
        Credenciales
    </a>

    <a href="#">
        <i class="bi bi-file-earmark-text"></i>
        Hojas de Afiliación
    </a>

    <a href="#">
        <i class="bi bi-qr-code"></i>
        Verificación QR
    </a>

    <a href="#">
        <i class="bi bi-cash-coin"></i>
        Pagos
    </a>

    <a href="#">
        <i class="bi bi-calendar-check"></i>
        Renovaciones
    </a>

    <a href="#">
        <i class="bi bi-bar-chart-fill"></i>
        Reportes
    </a>

    <a href="#">
        <i class="bi bi-person-badge-fill"></i>
        Usuarios
    </a>

    <a href="#">
        <i class="bi bi-gear-fill"></i>
        Configuración
    </a>

</div>

<div class="main">

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>