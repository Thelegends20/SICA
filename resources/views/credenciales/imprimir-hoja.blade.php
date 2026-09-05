<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Imprimir credenciales en hoja oficio</title>

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #e9ecef;
            color: #212529;
        }

        /*
        |--------------------------------------------------------------------------
        | BARRA SUPERIOR
        |--------------------------------------------------------------------------
        */

        .barra {
            width: 100%;
            max-width: 1200px;

            margin: 0 auto;
            padding: 20px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;
            flex-wrap: wrap;
        }

        .titulo {
            font-size: 20px;
            font-weight: 900;
            color: #651522;
        }

        .subtitulo {
            margin-top: 4px;

            color: #6c757d;
            font-size: 13px;
        }

        .acciones {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            border: 0;
            border-radius: 8px;

            padding: 10px 16px;

            text-decoration: none;

            font-size: 14px;
            font-weight: 800;

            cursor: pointer;
        }

        .btn-volver {
            background: #ffffff;
            color: #212529;

            border: 1px solid #ced4da;
        }

        .btn-imprimir {
            background: #651522;
            color: #ffffff;
        }

        /*
        |--------------------------------------------------------------------------
        | CONTENEDOR
        |--------------------------------------------------------------------------
        */

        .contenedor {
            width: 100%;

            display: flex;
            justify-content: center;

            padding: 0 20px 30px;
        }

        /*
        |--------------------------------------------------------------------------
        | HOJA OFICIO
        |--------------------------------------------------------------------------
        |
        | 215.9 × 330.2 mm
        |
        | 2 columnas × 4 filas
        | 8 credenciales por hoja
        |
        |--------------------------------------------------------------------------
        */

        .hoja {
            width: 215.9mm;
            height: 330.2mm;

            background: #ffffff;

            padding:
                15mm 10mm;

            display: grid;

            grid-template-columns:
                repeat(2, 85.60mm);

            grid-template-rows:
                repeat(4, 53.98mm);

            column-gap:
                10mm;

            row-gap:
                12mm;

            justify-content:
                center;

            align-content:
                start;

            position:
                relative;

            box-shadow:
                0 12px 30px rgba(0, 0, 0, .12);
        }

        /*
        |--------------------------------------------------------------------------
        | ENVOLVENTE DE CREDENCIAL
        |--------------------------------------------------------------------------
        */

        .credencial-wrapper {
            width:
                85.60mm;

            height:
                53.98mm;

            position:
                relative;
        }

        /*
        |--------------------------------------------------------------------------
        | CREDENCIAL ID-1
        |--------------------------------------------------------------------------
        */

        .credencial {
            width:
                85.60mm;

            height:
                53.98mm;

            position:
                relative;

            overflow:
                hidden;

            background-image:
                url('{{ asset('images/fondo-credencial-ucd-2026.png') }}');

            background-size:
                100% 100%;

            background-position:
                center;

            background-repeat:
                no-repeat;

            -webkit-print-color-adjust:
                exact;

            print-color-adjust:
                exact;
        }

        /*
        |--------------------------------------------------------------------------
        | GUÍAS DE CORTE
        |--------------------------------------------------------------------------
        */

        .marca {
            position:
                absolute;

            z-index:
                50;

            background:
                #000000;

            pointer-events:
                none;
        }

        .marca-h {
            width:
                3mm;

            height:
                .18mm;
        }

        .marca-v {
            width:
                .18mm;

            height:
                3mm;
        }

        .tl-h {
            left:
                -4mm;

            top:
                0;
        }

        .tl-v {
            left:
                0;

            top:
                -4mm;
        }

        .tr-h {
            right:
                -4mm;

            top:
                0;
        }

        .tr-v {
            right:
                0;

            top:
                -4mm;
        }

        .bl-h {
            left:
                -4mm;

            bottom:
                0;
        }

        .bl-v {
            left:
                0;

            bottom:
                -4mm;
        }

        .br-h {
            right:
                -4mm;

            bottom:
                0;
        }

        .br-v {
            right:
                0;

            bottom:
                -4mm;
        }

        /*
        |--------------------------------------------------------------------------
        | FOTO
        |--------------------------------------------------------------------------
        */

        .foto-afiliado {
            position:
                absolute;

            left:
                10.25%;

            top:
                41%;

            width:
                17.8%;

            height:
                29.5%;

            z-index:
                5;

            overflow:
                hidden;

            border-radius:
                1mm;

            background:
                rgba(250, 245, 232, .94);
        }

        .foto-afiliado img {
            display:
                block;

            width:
                100%;

            height:
                100%;

            object-fit:
                cover;

            object-position:
                center top;
        }

        .foto-placeholder {
            width:
                100%;

            height:
                100%;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            text-align:
                center;

            color:
                rgba(101, 21, 34, .70);

            font-size:
                3.7pt;

            font-weight:
                900;

            line-height:
                1.1;
        }

        /*
        |--------------------------------------------------------------------------
        | DATOS GENERALES
        |--------------------------------------------------------------------------
        */

        .valor {
            position:
                absolute;

            z-index:
                6;

            color:
                #391f1c;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            font-weight:
                700;

            line-height:
                1;
        }

        /*
        |--------------------------------------------------------------------------
        | NOMBRE
        |--------------------------------------------------------------------------
        */

        .valor-nombre {
            left:
                31.3%;

            top:
                39.5%;

            width:
                31%;

            height:
                7%;

            display:
                flex;

            align-items:
                flex-start;

            font-size:
                5.2pt;

            line-height:
                1;

            font-weight:
                900;

            text-transform:
                uppercase;

            white-space:
                nowrap;

            overflow:
                hidden;

            text-overflow:
                ellipsis;
        }

        /*
        |--------------------------------------------------------------------------
        | DOMICILIO
        |--------------------------------------------------------------------------
        */

        .valor-domicilio {
            left:
                31.3%;

            top:
                49.7%;

            width:
                29%;

            font-size:
                4.6pt;

            white-space:
                nowrap;

            overflow:
                hidden;

            text-overflow:
                ellipsis;
        }

        /*
        |--------------------------------------------------------------------------
        | MUNICIPIO
        |--------------------------------------------------------------------------
        */

        .valor-municipio {
            left:
                31.3%;

            top:
                63.4%;

            width:
                15.5%;

            font-size:
                4.1pt;

            text-transform:
                uppercase;

            white-space:
                nowrap;

            overflow:
                hidden;

            text-overflow:
                ellipsis;
        }

        /*
        |--------------------------------------------------------------------------
        | ESTADO
        |--------------------------------------------------------------------------
        */

        .valor-estado {
            left:
                49.3%;

            top:
                63.4%;

            width:
                12.5%;

            font-size:
                4.1pt;

            text-transform:
                uppercase;

            white-space:
                nowrap;

            overflow:
                hidden;

            text-overflow:
                ellipsis;
        }

        /*
        |--------------------------------------------------------------------------
        | VIGENCIA
        |--------------------------------------------------------------------------
        */

        .valor-vigencia {
            left:
                43.1%;

            top:
                78.2%;

            width:
                12.5%;

            text-align:
                center;

            font-size:
                3.6pt;

            font-weight:
                900;

            white-space:
                nowrap;
        }

        /*
        |--------------------------------------------------------------------------
        | EMISIÓN
        |--------------------------------------------------------------------------
        */

        .valor-emision {
            left:
                58.5%;

            top:
                78.2%;

            width:
                12.5%;

            text-align:
                center;

            font-size:
                3.6pt;

            font-weight:
                900;

            white-space:
                nowrap;
        }

        /*
        |--------------------------------------------------------------------------
        | FOLIO
        |--------------------------------------------------------------------------
        */

        .valor-folio {
            left:
                43%;

            top:
                86.3%;

            width:
                28%;

            text-align:
                center;

            color:
                #651522;

            font-size:
                3.5pt;

            line-height:
                1;

            font-weight:
                900;

            letter-spacing:
                0;

            white-space:
                nowrap;

            overflow:
                hidden;

            text-overflow:
                ellipsis;
        }

        /*
        |--------------------------------------------------------------------------
        | QR
        |--------------------------------------------------------------------------
        */

        .qr-credencial {
            position:
                absolute;

            z-index:
                10;

            right:
                8.3%;

            top:
                43.2%;

            width:
                12%;

            aspect-ratio:
                1 / 1;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            padding:
                .6%;

            background:
                rgba(255, 255, 255, .98);

            border:
                .12mm solid rgba(101, 21, 34, .18);

            border-radius:
                .7mm;
        }

        .qr-credencial svg {
            display:
                block;

            width:
                100%;

            height:
                100%;
        }

        /*
        |--------------------------------------------------------------------------
        | ESTATUS
        |--------------------------------------------------------------------------
        */

        .estado-credencial {
            position:
                absolute;

            z-index:
                8;

            right:
                7.8%;

            bottom:
                7.5%;

            min-width:
                11mm;

            padding:
                .35mm .8mm;

            border-radius:
                10mm;

            text-align:
                center;

            font-size:
                3.5pt;

            line-height:
                1;

            font-weight:
                900;

            letter-spacing:
                .03em;

            white-space:
                nowrap;
        }

        .estado-activa {
            color:
                #215c38;

            background:
                rgba(231, 245, 234, .94);

            border:
                .12mm solid rgba(75, 139, 91, .55);
        }

        .estado-vencida {
            color:
                #775312;

            background:
                rgba(255, 242, 204, .95);

            border:
                .12mm solid rgba(183, 140, 48, .55);
        }

        .estado-cancelada {
            color:
                #7a2731;

            background:
                rgba(248, 225, 228, .95);

            border:
                .12mm solid rgba(160, 64, 76, .50);
        }

        .estado-neutro {
            color:
                #555;

            background:
                rgba(240, 240, 240, .95);

            border:
                .12mm solid #bbb;
        }

        /*
        |--------------------------------------------------------------------------
        | SALTO ENTRE HOJAS
        |--------------------------------------------------------------------------
        */

        .salto-pagina {
            break-after:
                page;

            page-break-after:
                always;
        }

        /*
        |--------------------------------------------------------------------------
        | IMPRESIÓN
        |--------------------------------------------------------------------------
        */

        @page {
            size:
                215.9mm 330.2mm;

            margin:
                0;
        }

        @media print {

            html,
            body {
                width:
                    215.9mm;

                margin:
                    0;

                padding:
                    0;

                background:
                    #ffffff;
            }

            body {
                -webkit-print-color-adjust:
                    exact !important;

                print-color-adjust:
                    exact !important;
            }

            .barra {
                display:
                    none !important;
            }

            .contenedor {
                width:
                    215.9mm;

                display:
                    block;

                margin:
                    0;

                padding:
                    0;
            }

            .hoja {
                width:
                    215.9mm;

                height:
                    330.2mm;

                min-height:
                    330.2mm;

                max-height:
                    330.2mm;

                margin:
                    0;

                padding:
                    15mm 10mm;

                box-shadow:
                    none;

                overflow:
                    hidden;
            }

            .credencial-wrapper,
            .credencial {
                width:
                    85.60mm !important;

                height:
                    53.98mm !important;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | PANTALLAS PEQUEÑAS
        |--------------------------------------------------------------------------
        */

        @media screen and (max-width: 900px) {

            .contenedor {
                justify-content:
                    flex-start;

                overflow-x:
                    auto;
            }

            .hoja {
                flex-shrink:
                    0;
            }
        }

    </style>
</head>


<body>

<div class="barra">

    <div>

        <div class="titulo">
            Impresión múltiple de credenciales
        </div>

        <div class="subtitulo">
            Hoja oficio · Tarjetas ID-1 85.60 × 53.98 mm · 8 por hoja
        </div>

    </div>


    <div class="acciones">

        <a
            href="{{ route('credenciales.index') }}"
            class="btn btn-volver"
        >
            ← Volver
        </a>

        <button
            type="button"
            class="btn btn-imprimir"
            onclick="window.print()"
        >
            Imprimir hoja
        </button>

    </div>

</div>


@php

    /*
    |--------------------------------------------------------------------------
    | 8 CREDENCIALES POR HOJA
    |--------------------------------------------------------------------------
    */

    $porHoja = 8;

    $grupos =
        $credenciales->chunk($porHoja);

@endphp


@if($credenciales->isEmpty())

    <div style="
        max-width:900px;
        margin:40px auto;
        background:#fff;
        padding:25px;
        border-radius:12px;
        text-align:center;
    ">

        No hay credenciales disponibles para imprimir.

    </div>

@else

    @foreach($grupos as $grupo)

        <div class="contenedor">

            <div
                class="hoja {{ !$loop->last ? 'salto-pagina' : '' }}"
            >

                @foreach($grupo as $registro)

                    @php

                        $afiliado =
                            $registro->afiliado
                            ?? $registro->afiliacion
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
                                    strtoupper(
                                        $estatusVisual
                                    ),
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
                            !empty($registro->token_qr)

                            ? rtrim(
                                config('app.url'),
                                '/'
                            )
                            . '/verificar/credencial/'
                            . $registro->token_qr

                            : null;

                    @endphp


                    <div class="credencial-wrapper">

                        <!-- GUÍAS DE CORTE -->

                        <span class="marca marca-h tl-h"></span>
                        <span class="marca marca-v tl-v"></span>

                        <span class="marca marca-h tr-h"></span>
                        <span class="marca marca-v tr-v"></span>

                        <span class="marca marca-h bl-h"></span>
                        <span class="marca marca-v bl-v"></span>

                        <span class="marca marca-h br-h"></span>
                        <span class="marca marca-v br-v"></span>


                        <div class="credencial">

                            @if($afiliado)

                                <!-- FOTO -->

                                <div class="foto-afiliado">

                                    @if(!empty($afiliado->foto))

                                        <img
                                            src="{{ asset('storage/' . $afiliado->foto) }}"
                                            alt="Fotografía de {{ $afiliado->nombre }}"
                                        >

                                    @else

                                        <div class="foto-placeholder">
                                            SIN<br>FOTO
                                        </div>

                                    @endif

                                </div>


                                <!-- NOMBRE -->

                                <div class="valor valor-nombre">
                                    {{ $afiliado->nombre }}
                                </div>


                                <!-- DOMICILIO -->

                                <div class="valor valor-domicilio">
                                    {{ $afiliado->domicilio ?? 'No registrado' }}
                                </div>


                                <!-- MUNICIPIO -->

                                <div class="valor valor-municipio">
                                    {{ $afiliado->municipio ?? 'No registrado' }}
                                </div>


                                <!-- ESTADO -->

                                <div class="valor valor-estado">
                                    {{ $afiliado->estado ?? 'Michoacán' }}
                                </div>

                            @endif


                            <!-- VIGENCIA -->

                            <div class="valor valor-vigencia">
                                {{ $fechaVigencia }}
                            </div>


                            <!-- EMISIÓN -->

                            <div class="valor valor-emision">
                                {{ $fechaEmision }}
                            </div>


                            <!-- FOLIO -->

                            <div class="valor valor-folio">
                                {{ $registro->folio_credencial }}
                            </div>


                            <!-- QR -->

                            <div class="qr-credencial">

                                @if($urlVerificacion)

                                    {!! QrCode::size(300)
                                        ->margin(1)
                                        ->generate(
                                            $urlVerificacion
                                        ) !!}

                                @endif

                            </div>


                            <!-- ESTATUS -->

                            <div
                                class="estado-credencial {{ $estatusClase }}"
                            >
                                {{ $estatusTexto }}
                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    @endforeach

@endif


</body>

</html>