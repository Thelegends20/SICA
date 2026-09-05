<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        Imprimir credencial UCD
    </title>

    <style>

        * {
            box-sizing: border-box;
        }

        :root {
            --ucd-vino: #651522;
            --ucd-dorado: #a9792f;
            --ucd-texto: #391f1c;
        }

        html,
        body {
            margin: 0;
            padding: 0;
        }

        body {
            font-family:
                Arial,
                Helvetica,
                sans-serif;

            background: #e9e9e9;

            color: #212529;
        }

        .pagina {
            width: 100%;
            max-width: 1900px;

            margin: 0 auto;

            padding: 25px;
        }

        /*
        |--------------------------------------------------------------------------
        | BOTONES
        |--------------------------------------------------------------------------
        */

        .acciones {
            display: flex;

            align-items: center;

            justify-content: space-between;

            flex-wrap: wrap;

            gap: 12px;

            margin-bottom: 22px;
        }

        .acciones-grupo {
            display: flex;

            gap: 10px;

            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            padding: 10px 17px;

            border: 0;

            border-radius: 8px;

            text-decoration: none;

            cursor: pointer;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            font-size: 14px;

            font-weight: 700;
        }

        .btn-volver {
            color: #212529;

            background: #ffffff;

            border:
                1px solid #ced4da;
        }

        .btn-imprimir {
            color: #ffffff;

            background:
                var(--ucd-vino);
        }

        .titulo-pagina {
            margin-bottom: 5px;

            font-size: 18px;

            font-weight: 900;

            color:
                var(--ucd-vino);
        }

        .subtitulo-pagina {
            color: #6c757d;

            font-size: 12px;
        }

        /*
        |--------------------------------------------------------------------------
        | FRENTE + REVERSO EN LÍNEA
        |--------------------------------------------------------------------------
        */

        .contenedor-tarjetas {
            display: flex;

            flex-direction: row;

            align-items: flex-start;

            justify-content: center;

            gap: 25px;

            flex-wrap: nowrap;
        }

        .bloque-tarjeta {
            flex: 0 0 auto;
        }

        .etiqueta-lado {
            margin-bottom: 8px;

            text-align: center;

            font-size: 11px;

            font-weight: 900;

            letter-spacing: .14em;

            color:
                var(--ucd-vino);

            text-transform: uppercase;
        }

        .area-impresion {
            padding: 15px;

            border-radius: 15px;

            background: #ffffff;

            box-shadow:
                0 10px 35px
                rgba(0, 0, 0, .10);
        }

        /*
        |--------------------------------------------------------------------------
        | TARJETA BASE
        |--------------------------------------------------------------------------
        */

        .tarjeta-id1 {
            position: relative;

            width: 856px;

            height: 540px;

            overflow: hidden;

            background-repeat:
                no-repeat;

            background-position:
                center;

            background-size:
                100% 100%;

            -webkit-print-color-adjust:
                exact;

            print-color-adjust:
                exact;
        }

        /*
        |--------------------------------------------------------------------------
        | FRENTE
        |--------------------------------------------------------------------------
        */

        .credencial-frente {
            background-image:
                url('{{ asset('images/fondo-credencial-ucd-2026.png') }}');
        }

        /*
        |--------------------------------------------------------------------------
        | REVERSO
        |--------------------------------------------------------------------------
        */

        .credencial-reverso {
            background-image:
                url('{{ asset('images/fondo-reverso-credencial-ucd-2026.png') }}');
        }

        /*
        |--------------------------------------------------------------------------
        | FOTO
        |--------------------------------------------------------------------------
        */

        .foto-afiliado {
            position: absolute;

            left: 10.25%;

            top: 41%;

            width: 17.8%;

            height: 29.5%;

            z-index: 5;

            overflow: hidden;

            border-radius: 8px;

            background:
                rgba(250, 245, 232, .90);
        }

        .foto-afiliado img {
            display: block;

            width: 100%;

            height: 100%;

            object-fit: cover;

            object-position:
                center top;
        }

        .foto-placeholder {
            width: 100%;

            height: 100%;

            display: flex;

            align-items: center;

            justify-content: center;

            text-align: center;

            color:
                rgba(101, 21, 34, .60);

            font-size: 11px;

            font-weight: 900;
        }

        /*
        |--------------------------------------------------------------------------
        | DATOS
        |--------------------------------------------------------------------------
        */

        .valor {
            position: absolute;

            z-index: 6;

            color:
                var(--ucd-texto);

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            font-weight: 700;

            line-height: 1.05;
        }

        .valor-nombre {
            left: 31.3%;

            top: 39.5%;

            width: 31%;

            height: 8%;

            display: flex;

            align-items: flex-start;

            font-size: 18px;

            line-height: 1.02;

            font-weight: 900;

            text-transform:
                uppercase;

            white-space: normal;

            overflow: hidden;
        }

        .valor-domicilio {
            left: 31.3%;

            top: 49.5%;

            width: 29.5%;

            font-size: 14px;

            white-space: nowrap;

            overflow: hidden;

            text-overflow:
                ellipsis;
        }

        .valor-municipio {
            left: 31.3%;

            top: 63.3%;

            width: 16%;

            font-size: 12px;

            text-transform:
                uppercase;

            white-space: nowrap;

            overflow: hidden;

            text-overflow:
                ellipsis;
        }

        .valor-estado {
            left: 49.4%;

            top: 63.3%;

            width: 13%;

            font-size: 12px;

            text-transform:
                uppercase;

            white-space: nowrap;

            overflow: hidden;

            text-overflow:
                ellipsis;
        }

        .valor-vigencia {
            left: 44.5%;

            top: 78.1%;

            width: 11.5%;

            text-align: center;

            font-size: 11px;

            font-weight: 900;
        }

        .valor-emision {
            left: 61.7%;

            top: 78.1%;

            width: 11.5%;

            text-align: center;

            font-size: 11px;

            font-weight: 900;
        }

        .valor-folio {
            left: 49.5%;

            top: 87%;

            width: 19%;

            text-align: center;

            color:
                var(--ucd-vino);

            font-size: 10px;

            font-weight: 900;

            letter-spacing: .04em;
        }

        /*
        |--------------------------------------------------------------------------
        | QR
        |--------------------------------------------------------------------------
        */

        .qr-credencial {
            position: absolute;

            z-index: 10;

            right: 7.8%;

            top: 43.5%;

            width: 13%;

            aspect-ratio: 1 / 1;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 1%;

            background:
                rgba(255, 255, 255, .97);

            border:
                1px solid
                rgba(101, 21, 34, .18);

            border-radius: 6px;
        }

        .qr-credencial svg {
            display: block;

            width: 100%;

            height: 100%;
        }

        /*
        |--------------------------------------------------------------------------
        | ESTADO
        |--------------------------------------------------------------------------
        */

        .estado-credencial {
            position: absolute;

            z-index: 8;

            right: 7.8%;

            bottom: 7.8%;

            min-width: 70px;

            padding: 4px 8px;

            border-radius: 999px;

            text-align: center;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            font-size: 9px;

            font-weight: 900;

            letter-spacing: .08em;
        }

        .estado-activa {
            color: #215c38;

            background:
                rgba(231, 245, 234, .94);

            border:
                1px solid
                rgba(75, 139, 91, .55);
        }

        .estado-vencida {
            color: #775312;

            background:
                rgba(255, 242, 204, .95);

            border:
                1px solid
                rgba(183, 140, 48, .55);
        }

        .estado-cancelada {
            color: #7a2731;

            background:
                rgba(248, 225, 228, .95);

            border:
                1px solid
                rgba(160, 64, 76, .50);
        }

        .estado-neutro {
            color: #555;

            background:
                rgba(240, 240, 240, .95);

            border:
                1px solid #bbb;
        }

        /*
        |--------------------------------------------------------------------------
        | IMPRESIÓN
        |--------------------------------------------------------------------------
        */

        @page {
            size: auto;

            margin: 5mm;
        }

        @media print {

            html,
            body {
                margin: 0;

                padding: 0;

                background: #ffffff;
            }

            body {
                -webkit-print-color-adjust:
                    exact !important;

                print-color-adjust:
                    exact !important;
            }

            .pagina {
                width: auto;

                max-width: none;

                margin: 0;

                padding: 0;
            }

            .acciones,
            .etiqueta-lado {
                display:
                    none !important;
            }

            /*
            |--------------------------------------------------------------------------
            | AMBAS TARJETAS EN LA MISMA HOJA
            |--------------------------------------------------------------------------
            */

            .contenedor-tarjetas {
                display: flex !important;

                flex-direction: row !important;

                justify-content:
                    flex-start !important;

                align-items:
                    flex-start !important;

                flex-wrap:
                    nowrap !important;

                gap: 8mm !important;

                margin: 0;

                padding: 0;
            }

            .bloque-tarjeta {
                display: block;

                flex:
                    0 0 85.60mm;

                width:
                    85.60mm;

                margin: 0;

                padding: 0;

                break-before:
                    auto !important;

                break-after:
                    auto !important;

                page-break-before:
                    auto !important;

                page-break-after:
                    auto !important;
            }

            .area-impresion {
                width:
                    85.60mm;

                height:
                    53.98mm;

                margin: 0;

                padding: 0;

                background:
                    transparent;

                border-radius: 0;

                box-shadow: none;
            }

            /*
            |--------------------------------------------------------------------------
            | TAMAÑO REAL ID-1
            |--------------------------------------------------------------------------
            */

            .tarjeta-id1 {
                width:
                    85.60mm !important;

                height:
                    53.98mm !important;

                min-width:
                    85.60mm !important;

                max-width:
                    85.60mm !important;

                min-height:
                    53.98mm !important;

                max-height:
                    53.98mm !important;

                margin: 0;

                background-size:
                    100% 100% !important;

                background-position:
                    center !important;

                background-repeat:
                    no-repeat !important;
            }

            /*
            |--------------------------------------------------------------------------
            | TIPOGRAFÍA IMPRESA
            |--------------------------------------------------------------------------
            */

            .valor-nombre {
                font-size: 6.7pt;
            }

            .valor-domicilio {
                font-size: 5.4pt;
            }

            .valor-municipio,
            .valor-estado {
                font-size: 4.8pt;
            }

            .valor-vigencia,
            .valor-emision {
                font-size: 4.5pt;
            }

            .valor-folio {
                font-size: 4.2pt;
            }

            .estado-credencial {
                font-size: 4pt;

                min-width: 45px;

                padding: 1px 4px;
            }

            .foto-placeholder {
                font-size: 5pt;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | PANTALLAS PEQUEÑAS
        |--------------------------------------------------------------------------
        */

        @media screen and (max-width: 1800px) {

            .contenedor-tarjetas {
                flex-wrap: wrap;
            }

            .tarjeta-id1 {
                max-width: 100%;
            }
        }

    </style>

</head>


<body>

@php

    $registro =
        $credencial
        ?? null;


    $afiliado =
        $registro?->afiliado
        ?? $registro?->afiliacion
        ?? null;


    $estatusOriginal =
        strtolower(
            $registro->estatus
            ?? 'activa'
        );


    $estatusVisual =
        $estatusOriginal;


    if (
        $estatusOriginal === 'activa'
        && !empty($registro->vigencia)
        && \Carbon\Carbon::parse(
            $registro->vigencia
        )->isPast()
    ) {

        $estatusVisual =
            'vencida';
    }


    $estatusTexto =
        match($estatusVisual) {

            'activa' =>
                'ACTIVA',

            'vencida' =>
                'VENCIDA',

            'cancelada' =>
                'CANCELADA',

            default =>
                strtoupper($estatusVisual),
        };


    $estatusClase =
        match($estatusVisual) {

            'activa' =>
                'estado-activa',

            'vencida' =>
                'estado-vencida',

            'cancelada' =>
                'estado-cancelada',

            default =>
                'estado-neutro',
        };


    $fechaVigencia =
        !empty($registro->vigencia)

        ? \Carbon\Carbon::parse(
            $registro->vigencia
        )->format('d/m/Y')

        : 'Sin definir';


    $fechaEmision =
        !empty($registro->created_at)

        ? \Carbon\Carbon::parse(
            $registro->created_at
        )->format('d/m/Y')

        : now()->format('d/m/Y');


    $urlVerificacion =
        null;


    if (
        $registro
        && !empty($registro->token_qr)
    ) {

        $urlVerificacion =
            rtrim(
                config('app.url'),
                '/'
            )
            . '/verificar/credencial/'
            . $registro->token_qr;
    }

@endphp


<div class="pagina">

    <div class="acciones">

        <div>

            <div class="titulo-pagina">
                Impresión de credencial
            </div>

            <div class="subtitulo-pagina">
                UCD Meseta Purépecha · Frente y reverso · ID-1
            </div>

        </div>


        <div class="acciones-grupo">

            @if($registro)

                <a
                    href="{{ url('/credenciales/' . $registro->id) }}"
                    class="btn btn-volver"
                >
                    ← Volver
                </a>

            @endif


            <button
                type="button"
                class="btn btn-imprimir"
                onclick="window.print()"
            >
                Imprimir frente y reverso
            </button>

        </div>

    </div>


    @if(!$registro || !$afiliado)

        <div>
            No fue posible cargar la credencial.
        </div>

    @else


        <div class="contenedor-tarjetas">

            {{-- =====================================================
                 FRENTE
            ====================================================== --}}

            <div class="bloque-tarjeta">

                <div class="etiqueta-lado">
                    Frente
                </div>


                <div class="area-impresion">

                    <div class="tarjeta-id1 credencial-frente">

                        <div class="foto-afiliado">

                            @if(!empty($afiliado->foto))

                                <img
                                    src="{{ asset('storage/' . $afiliado->foto) }}"
                                    alt="Fotografía de {{ $afiliado->nombre }}"
                                >

                            @else

                                <div class="foto-placeholder">
                                    SIN FOTOGRAFÍA
                                </div>

                            @endif

                        </div>


                        <div class="valor valor-nombre">
                            {{ $afiliado->nombre }}
                        </div>


                        <div class="valor valor-domicilio">
                            {{ $afiliado->domicilio ?? 'No registrado' }}
                        </div>


                        <div class="valor valor-municipio">
                            {{ $afiliado->municipio ?? 'No registrado' }}
                        </div>


                        <div class="valor valor-estado">
                            {{ $afiliado->estado ?? 'Michoacán' }}
                        </div>


                        <div class="valor valor-vigencia">
                            {{ $fechaVigencia }}
                        </div>


                        <div class="valor valor-emision">
                            {{ $fechaEmision }}
                        </div>


                        <div class="valor valor-folio">
                            {{ $registro->folio_credencial }}
                        </div>


                        <div class="qr-credencial">

                            @if($urlVerificacion)

                                {!! QrCode::size(300)
                                    ->margin(1)
                                    ->generate($urlVerificacion) !!}

                            @else

                                QR

                            @endif

                        </div>


                        <div
                            class="
                                estado-credencial
                                {{ $estatusClase }}
                            "
                        >
                            {{ $estatusTexto }}
                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 REVERSO
            ====================================================== --}}

            <div class="bloque-tarjeta">

                <div class="etiqueta-lado">
                    Reverso
                </div>


                <div class="area-impresion">

                    <div
                        class="
                            tarjeta-id1
                            credencial-reverso
                        "
                    ></div>

                </div>

            </div>

        </div>

    @endif

</div>

</body>

</html>