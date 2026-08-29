<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        Credencial SICA
    </title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 20px;
            font-family: Arial, Helvetica, sans-serif;
            background: #f2f2f2;
        }

        .hoja {
            max-width: 900px;
            margin: 0 auto;
        }

        .acciones {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            border: 0;
            padding: 10px 16px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-imprimir {
            background: #198754;
            color: white;
        }

        .btn-volver {
            background: #e9ecef;
            color: #212529;
        }

        .credencial {
            width: 540px;
            min-height: 340px;
            margin: 0 auto;
            background: white;
            border: 2px solid #198754;
            border-radius: 18px;
            overflow: hidden;
            position: relative;
        }

        .encabezado {
            background: #198754;
            color: white;
            padding: 18px 22px;
        }

        .encabezado-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .marca {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .subtitulo {
            font-size: 11px;
            opacity: .9;
            margin-top: 3px;
        }

        .anio {
            font-size: 18px;
            font-weight: bold;
        }

        .contenido {
            padding: 22px;
        }

        .datos-superiores {
            display: flex;
            gap: 20px;
        }

        .foto {
            width: 115px;
            height: 135px;
            flex-shrink: 0;
            border: 1px solid #d9d9d9;
            background: #f6f6f6;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #777;
            text-align: center;
            font-size: 12px;
        }

        .datos {
            flex: 1;
        }

        .label {
            font-size: 10px;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: .6px;
            margin-bottom: 2px;
        }

        .valor {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 11px;
        }

        .nombre {
            font-size: 20px;
            line-height: 1.15;
        }

        .fila {
            display: flex;
            gap: 18px;
        }

        .col {
            flex: 1;
        }

        .pie {
            margin-top: 18px;
            padding-top: 14px;
            border-top: 1px solid #ddd;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 15px;
        }

        .leyenda {
            font-size: 10px;
            line-height: 1.4;
            max-width: 335px;
            color: #555;
        }

        .qr {
            width: 82px;
            height: 82px;
            border: 1px solid #ccc;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            font-size: 9px;
            color: #777;
            border-radius: 6px;
        }

        .token {
            font-size: 7px;
            color: #999;
            margin-top: 3px;
            word-break: break-all;
            max-width: 82px;
        }

        .estatus {
            position: absolute;
            right: 15px;
            bottom: 10px;
            font-size: 9px;
            color: #777;
        }

        @media print {

            body {
                background: white;
                padding: 0;
            }

            .acciones {
                display: none !important;
            }

            .hoja {
                margin: 0;
                max-width: none;
            }

            .credencial {
                margin: 0;
                box-shadow: none;
            }

        }

    </style>

</head>


<body>

@php

    $registro = $credencial ?? null;

    $afiliado =
        $registro?->afiliado
        ?? $registro?->afiliacion
        ?? null;

@endphp


<div class="hoja">

    <div class="acciones">

        @if($registro)

            <a
                href="{{ url('/credenciales/' . $registro->id) }}"
                class="btn btn-volver"
            >
                Volver
            </a>

        @endif

        <button
            type="button"
            class="btn btn-imprimir"
            onclick="window.print()"
        >
            Imprimir
        </button>

    </div>


    @if(!$registro)

        <div style="padding:20px;background:#fff;border:1px solid #ddd;">
            No se encontró la credencial.
        </div>

    @else

        <div class="credencial">

            <div class="encabezado">

                <div class="encabezado-top">

                    <div>

                        <div class="marca">
                            SICA
                        </div>

                        <div class="subtitulo">
                            Sistema Integral de Control y Afiliación
                        </div>

                    </div>


                    <div class="anio">
                        {{ now()->format('Y') }}
                    </div>

                </div>

            </div>


            <div class="contenido">

                <div class="datos-superiores">

                    <div class="foto">
                        FOTOGRAFÍA
                    </div>


                    <div class="datos">

                        <div class="label">
                            Nombre
                        </div>

                        <div class="valor nombre">
                            {{ $afiliado->nombre ?? 'Sin nombre registrado' }}
                        </div>


                        <div class="fila">

                            <div class="col">

                                <div class="label">
                                    CURP
                                </div>

                                <div class="valor">
                                    {{ $afiliado->curp ?? 'No registrada' }}
                                </div>

                            </div>


                            <div class="col">

                                <div class="label">
                                    Municipio
                                </div>

                                <div class="valor">
                                    {{ $afiliado->municipio ?? 'No registrado' }}
                                </div>

                            </div>

                        </div>


                        <div class="fila">

                            <div class="col">

                                <div class="label">
                                    Vigencia
                                </div>

                                <div class="valor">

                                    @if(!empty($registro->vigencia))

                                        {{ \Carbon\Carbon::parse($registro->vigencia)->format('d/m/Y') }}

                                    @else

                                        No registrada

                                    @endif

                                </div>

                            </div>


                            <div class="col">

                                <div class="label">
                                    Emisión
                                </div>

                                <div class="valor">

                                    @if(!empty($registro->created_at))

                                        {{ \Carbon\Carbon::parse($registro->created_at)->format('d/m/Y') }}

                                    @else

                                        {{ now()->format('d/m/Y') }}

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="pie">

                    <div>

                        <div class="leyenda">
                            La presente acredita al portador como miembro activo de esta organización.
                        </div>

                    </div>


                    <div>

                        <div class="qr">
                            QR
                        </div>

                        <div class="token">
                            {{ $registro->token_qr ?? '' }}
                        </div>

                    </div>

                </div>

            </div>


            <div class="estatus">
                {{ strtoupper($registro->estatus ?? 'ACTIVA') }}
            </div>

        </div>

    @endif

</div>


<script>

    /*
    |--------------------------------------------------------------------------
    | Impresión
    |--------------------------------------------------------------------------
    |
    | Dejamos el botón manual por ahora. Después conectaremos el QR real y
    | ajustaremos el tamaño físico definitivo de la credencial.
    |
    */

</script>

</body>

</html>