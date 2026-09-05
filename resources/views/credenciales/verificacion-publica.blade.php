<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <meta name="robots"
          content="noindex,nofollow">

    <title>
        Verificación de credencial | SICA
    </title>

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }

        body {
            font-family:
                Arial,
                Helvetica,
                sans-serif;

            background:
                #e8e5df;

            color:
                #2b211d;
        }

        .pagina {
            min-height: 100vh;

            padding:
                34px 16px;

            display: flex;

            justify-content: center;

            align-items: flex-start;
        }

        .documento {
            position: relative;

            width: 100%;

            max-width: 760px;

            min-height: 1050px;

            overflow: hidden;

            border-radius: 18px;

            background:
                #f8f0e4;

            box-shadow:
                0 18px 50px
                rgba(46, 28, 18, .22);
        }

        /*
        |--------------------------------------------------------------------------
        | FONDO UCD
        |--------------------------------------------------------------------------
        */

        .fondo {
            position: absolute;

            inset: 0;

            z-index: 0;

            background-image:
                url('{{ asset('images/fondo-verificacion-ucd-2027.png') }}');

            background-size:
                100% 100%;

            background-position:
                center top;

            background-repeat:
                no-repeat;

            pointer-events: none;
        }

        /*
        |--------------------------------------------------------------------------
        | CAPA PARA MEJORAR LEGIBILIDAD
        |--------------------------------------------------------------------------
        */

        .velo {
            position: absolute;

            inset:
                60px 48px 100px 48px;

            z-index: 1;

            border-radius: 18px;

            background:
                rgba(255, 250, 242, .78);

            backdrop-filter:
                blur(1px);

            -webkit-backdrop-filter:
                blur(1px);
        }

        /*
        |--------------------------------------------------------------------------
        | CONTENIDO
        |--------------------------------------------------------------------------
        */

        .contenido {
            position: relative;

            z-index: 2;

            padding:
                78px 72px 105px;
        }

        /*
        |--------------------------------------------------------------------------
        | ENCABEZADO
        |--------------------------------------------------------------------------
        */

        .encabezado {
            display: flex;

            align-items: center;

            gap: 18px;

            padding-bottom: 22px;

            margin-bottom: 22px;

            border-bottom:
                2px solid
                rgba(151, 103, 32, .55);
        }

        .sello {
            width: 86px;

            height: 86px;

            flex:
                0 0 86px;

            border-radius:
                50%;

            object-fit:
                contain;
        }

        .encabezado-texto {
            flex: 1;
        }

        .ucd {
            margin: 0;

            color:
                #701421;

            font-size:
                35px;

            line-height: 1;

            font-weight:
                900;

            letter-spacing:
                2px;
        }

        .region {
            margin-top:
                8px;

            color:
                #4d2817;

            font-size:
                14px;

            font-weight:
                900;

            letter-spacing:
                1.7px;

            text-transform:
                uppercase;
        }

        .sistema {
            margin-top:
                6px;

            color:
                #9b6b2c;

            font-size:
                11px;

            font-weight:
                800;

            letter-spacing:
                1px;

            text-transform:
                uppercase;
        }

        /*
        |--------------------------------------------------------------------------
        | ESTADO
        |--------------------------------------------------------------------------
        */

        .estado {
            display: flex;

            align-items: center;

            gap: 16px;

            padding:
                16px 18px;

            margin-bottom:
                26px;

            border-radius:
                14px;
        }

        .estado.activa {
            background:
                rgba(223, 244, 229, .93);

            border:
                1px solid
                #8acfa2;

            color:
                #076735;
        }

        .estado.vencida {
            background:
                rgba(255, 243, 205, .94);

            border:
                1px solid
                #e2c15d;

            color:
                #765600;
        }

        .estado.cancelada {
            background:
                rgba(248, 215, 218, .94);

            border:
                1px solid
                #de8f96;

            color:
                #842029;
        }

        .estado-icono {
            width:
                44px;

            height:
                44px;

            flex:
                0 0 44px;

            border-radius:
                50%;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            background:
                rgba(255, 255, 255, .6);

            font-size:
                25px;

            font-weight:
                900;
        }

        .estado-titulo {
            font-size:
                14px;

            font-weight:
                900;

            letter-spacing:
                1px;
        }

        .estado-texto {
            margin-top:
                3px;

            font-size:
                12px;
        }

        /*
        |--------------------------------------------------------------------------
        | TÍTULO
        |--------------------------------------------------------------------------
        */

        .titulo {
            margin:
                0 0 6px;

            color:
                #701421;

            font-size:
                25px;

            font-weight:
                900;
        }

        .descripcion {
            margin:
                0 0 22px;

            color:
                #5d4b42;

            font-size:
                13px;

            line-height:
                1.6;
        }

        /*
        |--------------------------------------------------------------------------
        | DATOS
        |--------------------------------------------------------------------------
        */

        .datos {
            display:
                grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap:
                12px;
        }

        .dato {
            min-width:
                0;

            padding:
                14px 15px;

            border:
                1px solid
                rgba(130, 83, 44, .20);

            border-radius:
                12px;

            background:
                rgba(255, 250, 242, .88);
        }

        .dato.ancho {
            grid-column:
                1 / -1;
        }

        .dato-etiqueta {
            color:
                #9a6a3d;

            font-size:
                10px;

            font-weight:
                900;

            letter-spacing:
                .7px;

            text-transform:
                uppercase;

            margin-bottom:
                6px;
        }

        .dato-valor {
            color:
                #17120f;

            font-size:
                14px;

            font-weight:
                800;

            line-height:
                1.35;

            overflow-wrap:
                anywhere;
        }

        .folio {
            font-size:
                17px;

            letter-spacing:
                .3px;
        }

        /*
        |--------------------------------------------------------------------------
        | AVISO
        |--------------------------------------------------------------------------
        */

        .aviso {
            margin-top:
                18px;

            padding:
                14px 16px;

            border-left:
                4px solid
                #b07a1f;

            border-radius:
                8px;

            background:
                rgba(255, 250, 239, .91);

            color:
                #665349;

            font-size:
                11px;

            line-height:
                1.55;
        }

        /*
        |--------------------------------------------------------------------------
        | AUTENTICIDAD
        |--------------------------------------------------------------------------
        */

        .autenticidad {
            margin-top:
                20px;

            padding:
                14px 16px;

            text-align:
                center;

            color:
                #6f1620;

            border-top:
                1px solid
                rgba(157, 106, 45, .30);

            font-size:
                11px;

            font-weight:
                700;

            letter-spacing:
                .3px;
        }

        .autenticidad strong {
            display:
                block;

            margin-bottom:
                5px;

            font-size:
                12px;

            letter-spacing:
                .8px;
        }

        /*
        |--------------------------------------------------------------------------
        | RESPONSIVE
        |--------------------------------------------------------------------------
        */

        @media (max-width: 650px) {

            .pagina {
                padding:
                    0;
            }

            .documento {
                border-radius:
                    0;

                min-height:
                    100vh;
            }

            .velo {
                inset:
                    22px 16px 60px;
            }

            .contenido {
                padding:
                    42px 32px 80px;
            }

            .encabezado {
                gap:
                    12px;
            }

            .sello {
                width:
                    65px;

                height:
                    65px;

                flex-basis:
                    65px;
            }

            .ucd {
                font-size:
                    28px;
            }

            .region {
                font-size:
                    11px;
            }

            .sistema {
                font-size:
                    9px;
            }

            .datos {
                grid-template-columns:
                    1fr;
            }

            .dato.ancho {
                grid-column:
                    auto;
            }

            .titulo {
                font-size:
                    22px;
            }
        }

        @media (max-width: 430px) {

            .contenido {
                padding:
                    34px 23px 70px;
            }

            .sello {
                width:
                    56px;

                height:
                    56px;

                flex-basis:
                    56px;
            }

            .ucd {
                font-size:
                    25px;
            }

            .region {
                letter-spacing:
                    1px;
            }

            .estado {
                padding:
                    13px;
            }
        }

    </style>
</head>

<body>

@php

    use Carbon\Carbon;

    $vigencia = $credencial->vigencia
        ? Carbon::parse($credencial->vigencia)
        : null;

    $emision = $credencial->created_at
        ? Carbon::parse($credencial->created_at)
        : null;

    $estatusOriginal = strtolower(
        trim(
            $credencial->estatus ?? 'activa'
        )
    );

    $estaVencida =
        $vigencia
        && $vigencia->copy()->endOfDay()->isPast();

    if (
        in_array(
            $estatusOriginal,
            [
                'cancelada',
                'cancelado',
                'suspendida',
                'suspendido'
            ]
        )
    ) {

        $estadoClase = 'cancelada';

        $estadoTitulo =
            'CREDENCIAL NO VIGENTE';

        $estadoTexto =
            'El registro no se encuentra activo en el sistema SICA.';

        $estadoIcono =
            '×';

    } elseif ($estaVencida) {

        $estadoClase =
            'vencida';

        $estadoTitulo =
            'CREDENCIAL VENCIDA';

        $estadoTexto =
            'La vigencia registrada en SICA ha concluido.';

        $estadoIcono =
            '!';

    } else {

        $estadoClase =
            'activa';

        $estadoTitulo =
            'CREDENCIAL ACTIVA';

        $estadoTexto =
            'El registro se encuentra vigente en el sistema SICA.';

        $estadoIcono =
            '✓';
    }

@endphp


<div class="pagina">

    <main class="documento">

        <div class="fondo"></div>

        <div class="velo"></div>


        <div class="contenido">

            {{-- ENCABEZADO --}}
            <header class="encabezado">

                <img
                    src="{{ asset('images/logo-ucd.png') }}"
                    alt="UCD"
                    class="sello"
                >

                <div class="encabezado-texto">

                    <h1 class="ucd">
                        U-C-D
                    </h1>

                    <div class="region">
                        Michoacán · Meseta Purépecha
                    </div>

                    <div class="sistema">
                        Sistema Integral de Control de Afiliación
                    </div>

                </div>

            </header>


            {{-- ESTADO --}}
            <section class="estado {{ $estadoClase }}">

                <div class="estado-icono">
                    {{ $estadoIcono }}
                </div>

                <div>

                    <div class="estado-titulo">
                        {{ $estadoTitulo }}
                    </div>

                    <div class="estado-texto">
                        {{ $estadoTexto }}
                    </div>

                </div>

            </section>


            {{-- TÍTULO --}}
            <h2 class="titulo">
                Verificación de credencial
            </h2>

            <p class="descripcion">
                Este registro corresponde a una credencial emitida
                por UCD Meseta Purépecha y consultada mediante su
                código único de verificación SICA.
            </p>


            {{-- DATOS --}}
            <section class="datos">

                <div class="dato ancho">

                    <div class="dato-etiqueta">
                        Folio de credencial
                    </div>

                    <div class="dato-valor folio">
                        {{ $credencial->folio_credencial ?? 'SIN FOLIO' }}
                    </div>

                </div>


                <div class="dato">

                    <div class="dato-etiqueta">
                        Afiliado
                    </div>

                    <div class="dato-valor">
                        {{ $credencial->afiliado->nombre ?? 'No disponible' }}
                    </div>

                </div>


                <div class="dato">

                    <div class="dato-etiqueta">
                        Organización
                    </div>

                    <div class="dato-valor">
                        Unión Campesina Democrática
                    </div>

                </div>


                <div class="dato">

                    <div class="dato-etiqueta">
                        Vigencia
                    </div>

                    <div class="dato-valor">
                        {{ $vigencia ? $vigencia->format('d/m/Y') : 'No registrada' }}
                    </div>

                </div>


                <div class="dato">

                    <div class="dato-etiqueta">
                        Fecha de emisión
                    </div>

                    <div class="dato-valor">
                        {{ $emision ? $emision->format('d/m/Y') : 'No registrada' }}
                    </div>

                </div>


                <div class="dato ancho">

                    <div class="dato-etiqueta">
                        Coordinación
                    </div>

                    <div class="dato-valor">
                        Coordinación Estatal Michoacán · Meseta Purépecha
                    </div>

                </div>

            </section>


            {{-- PRIVACIDAD --}}
            <div class="aviso">

                Por protección de datos personales,
                esta consulta pública no muestra domicilio,
                CURP, RFC, INE, teléfono, correo electrónico
                ni otros datos contenidos en el expediente
                interno del afiliado.

            </div>


            {{-- PIE --}}
            <footer class="autenticidad">

                <strong>
                    UCD MESETA PURÉPECHA · MICHOACÁN
                </strong>

                Verificación electrónica mediante Sistema SICA

            </footer>

        </div>

    </main>

</div>

</body>
</html>