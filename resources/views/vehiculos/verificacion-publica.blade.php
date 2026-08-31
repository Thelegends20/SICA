<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="robots"
        content="noindex, nofollow"
    >

    <title>
        Verificación vehicular | UCD
    </title>

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --verde: #198754;
            --verde-oscuro: #146c43;
            --verde-profundo: #0f5132;

            --rojo: #dc3545;
            --amarillo: #ffc107;
            --gris: #6c757d;
            --oscuro: #212529;

            --fondo: #f3f6f4;
            --blanco: #ffffff;
            --borde: #dde5e0;
        }

        body {
            margin: 0;
            padding: 0;

            font-family:
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Roboto,
                Helvetica,
                Arial,
                sans-serif;

            background:
                linear-gradient(
                    180deg,
                    #e8f3ed 0%,
                    var(--fondo) 260px
                );

            color: var(--oscuro);
        }

        .pagina {
            width: 100%;
            max-width: 720px;

            margin: 0 auto;

            padding:
                24px
                16px
                48px;
        }

        .cabecera {
            text-align: center;

            margin-bottom: 22px;
        }

        .escudo {
            width: 78px;
            height: 78px;

            margin:
                0 auto
                14px;

            border-radius: 22px;

            display: flex;
            align-items: center;
            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    var(--verde),
                    var(--verde-profundo)
                );

            color: white;

            font-size: 29px;
            font-weight: 800;

            letter-spacing: -2px;

            box-shadow:
                0 10px 30px
                rgba(15, 81, 50, 0.22);
        }

        .organizacion {
            margin: 0;

            color: var(--verde-profundo);

            font-size: 14px;
            font-weight: 800;

            letter-spacing: 1.4px;

            text-transform: uppercase;
        }

        .titulo {
            margin:
                5px
                0
                5px;

            font-size: 27px;
            line-height: 1.15;
        }

        .subtitulo {
            margin: 0;

            color: var(--gris);

            font-size: 14px;
        }

        .estado {
            overflow: hidden;

            margin-bottom: 18px;

            background: var(--blanco);

            border:
                1px
                solid
                var(--borde);

            border-radius: 22px;

            box-shadow:
                0 12px 34px
                rgba(31, 50, 40, 0.08);
        }

        .estado-superior {
            padding:
                26px
                22px;

            text-align: center;
        }

        .estado-icono {
            width: 68px;
            height: 68px;

            margin:
                0 auto
                14px;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 34px;
            font-weight: 900;
        }

        .estado.activo .estado-icono {
            background: #dff4e8;
            color: var(--verde);
        }

        .estado.inactivo .estado-icono {
            background: #eceff1;
            color: var(--gris);
        }

        .estado.suspendido .estado-icono {
            background: #fff3cd;
            color: #997404;
        }

        .estado.robado .estado-icono {
            background: #f8d7da;
            color: var(--rojo);
        }

        .estado.baja .estado-icono {
            background: #e2e3e5;
            color: #343a40;
        }

        .estado.vencido .estado-icono {
            background: #fff3cd;
            color: #997404;
        }

        .estado-etiqueta {
            margin-bottom: 5px;

            color: var(--gris);

            font-size: 12px;
            font-weight: 700;

            letter-spacing: 1px;

            text-transform: uppercase;
        }

        .estado-nombre {
            margin: 0;

            font-size: 28px;
            font-weight: 900;

            letter-spacing: 0.5px;
        }

        .estado.activo .estado-nombre {
            color: var(--verde);
        }

        .estado.inactivo .estado-nombre {
            color: var(--gris);
        }

        .estado.suspendido .estado-nombre {
            color: #997404;
        }

        .estado.robado .estado-nombre {
            color: var(--rojo);
        }

        .estado.baja .estado-nombre {
            color: #343a40;
        }

        .estado.vencido .estado-nombre {
            color: #997404;
        }

        .estado-descripcion {
            max-width: 500px;

            margin:
                8px auto
                0;

            color: var(--gris);

            font-size: 14px;
            line-height: 1.5;
        }

        .folio {
            padding:
                15px
                18px;

            background: #f8faf9;

            border-top:
                1px
                solid
                var(--borde);

            text-align: center;
        }

        .folio-label {
            display: block;

            margin-bottom: 3px;

            color: var(--gris);

            font-size: 11px;
            font-weight: 700;

            letter-spacing: 1px;

            text-transform: uppercase;
        }

        .folio-numero {
            color: var(--verde-profundo);

            font-size: 18px;
            font-weight: 800;
        }

        .tarjeta {
            margin-bottom: 18px;

            padding:
                22px
                20px;

            background: var(--blanco);

            border:
                1px
                solid
                var(--borde);

            border-radius: 22px;

            box-shadow:
                0 12px 34px
                rgba(31, 50, 40, 0.06);
        }

        .tarjeta-titulo {
            margin:
                0
                0
                18px;

            padding-bottom: 13px;

            border-bottom:
                1px
                solid
                #edf1ef;

            color: var(--verde-profundo);

            font-size: 17px;
            font-weight: 800;
        }

        .datos {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap:
                18px
                14px;
        }

        .dato.completo {
            grid-column:
                1 / -1;
        }

        .dato-label {
            margin-bottom: 4px;

            color: var(--gris);

            font-size: 11px;
            font-weight: 700;

            letter-spacing: 0.6px;

            text-transform: uppercase;
        }

        .dato-valor {
            color: var(--oscuro);

            font-size: 16px;
            font-weight: 700;

            word-break: break-word;
        }

        .nota {
            padding:
                18px
                20px;

            background: #e8f3ed;

            border:
                1px
                solid
                #cfe4d7;

            border-radius: 18px;

            color: var(--verde-profundo);

            font-size: 13px;
            line-height: 1.55;
        }

        .nota strong {
            display: block;

            margin-bottom: 4px;

            font-size: 14px;
        }

        .pie {
            padding-top: 22px;

            text-align: center;

            color: var(--gris);

            font-size: 11px;
            line-height: 1.6;
        }

        .pie strong {
            color: var(--verde-profundo);
        }

        @media (max-width: 480px) {
            .pagina {
                padding:
                    18px
                    12px
                    36px;
            }

            .titulo {
                font-size: 24px;
            }

            .datos {
                grid-template-columns: 1fr;
            }

            .dato.completo {
                grid-column: auto;
            }

            .estado-superior {
                padding:
                    24px
                    18px;
            }
        }
    </style>
</head>

<body>

@php

    $estatusOriginal =
        strtolower(
            $vehiculo->estatus
            ?? 'inactivo'
        );

    $estaVencido = false;

    if (!empty($vehiculo->vigencia)) {

        $estaVencido =
            \Carbon\Carbon::parse(
                $vehiculo->vigencia
            )->endOfDay()->isPast();
    }

    /*
    |--------------------------------------------------------------------------
    | ESTADO PÚBLICO
    |--------------------------------------------------------------------------
    */

    if (
        $estaVencido
        && $estatusOriginal === 'activo'
    ) {

        $estadoClase = 'vencido';
        $estadoTexto = 'VENCIDO';
        $estadoIcono = '!';

        $estadoDescripcion =
            'El registro existe en SICA, pero su vigencia ha concluido.';

    } else {

        $estadoClase = match($estatusOriginal) {

            'activo' =>
                'activo',

            'inactivo' =>
                'inactivo',

            'suspendido' =>
                'suspendido',

            'robado' =>
                'robado',

            'baja' =>
                'baja',

            default =>
                'inactivo',
        };


        $estadoTexto = match($estatusOriginal) {

            'activo' =>
                'VIGENTE',

            'inactivo' =>
                'INACTIVO',

            'suspendido' =>
                'SUSPENDIDO',

            'robado' =>
                'REPORTE DE ROBO',

            'baja' =>
                'DADO DE BAJA',

            default =>
                'SIN ESTATUS',
        };


        $estadoIcono = match($estatusOriginal) {

            'activo' =>
                '✓',

            'inactivo' =>
                '•',

            'suspendido' =>
                '!',

            'robado' =>
                '!',

            'baja' =>
                '×',

            default =>
                '?',
        };


        $estadoDescripcion = match($estatusOriginal) {

            'activo' =>
                'El vehículo se encuentra registrado y vigente en el sistema.',

            'inactivo' =>
                'El registro se encuentra actualmente inactivo.',

            'suspendido' =>
                'El registro del vehículo se encuentra temporalmente suspendido.',

            'robado' =>
                'ATENCIÓN: este vehículo aparece con reporte de robo dentro del sistema.',

            'baja' =>
                'Este vehículo fue dado de baja del registro.',

            default =>
                'No fue posible determinar el estado actual del registro.',
        };
    }


    /*
    |--------------------------------------------------------------------------
    | VIN PROTEGIDO
    |--------------------------------------------------------------------------
    */

    $vin = $vehiculo->vin ?? '';

    if (strlen($vin) >= 8) {

        $vinVisible =
            substr($vin, 0, 4)
            . str_repeat(
                '•',
                max(
                    strlen($vin) - 8,
                    4
                )
            )
            . substr($vin, -4);

    } elseif (!empty($vin)) {

        $vinVisible =
            substr($vin, 0, 2)
            . '••••'
            . substr($vin, -2);

    } else {

        $vinVisible =
            'No registrado';
    }

@endphp


<div class="pagina">

    <header class="cabecera">

        <div class="escudo">
            UCD
        </div>

        <p class="organizacion">
            UCD Meseta Purépecha
        </p>

        <h1 class="titulo">
            Verificación vehicular
        </h1>

        <p class="subtitulo">
            Consulta pública de registro SICA
        </p>

    </header>


    <section
        class="estado {{ $estadoClase }}"
    >

        <div class="estado-superior">

            <div class="estado-icono">
                {{ $estadoIcono }}
            </div>

            <div class="estado-etiqueta">
                Estado del registro
            </div>

            <h2 class="estado-nombre">
                {{ $estadoTexto }}
            </h2>

            <p class="estado-descripcion">
                {{ $estadoDescripcion }}
            </p>

        </div>


        <div class="folio">

            <span class="folio-label">
                Folio vehicular
            </span>

            <span class="folio-numero">
                {{ $vehiculo->folio_vehiculo ?? 'Sin folio' }}
            </span>

        </div>

    </section>


    <section class="tarjeta">

        <h3 class="tarjeta-titulo">
            Datos del vehículo
        </h3>


        <div class="datos">

            <div class="dato">

                <div class="dato-label">
                    Marca
                </div>

                <div class="dato-valor">
                    {{ $vehiculo->marca ?? 'No registrada' }}
                </div>

            </div>


            <div class="dato">

                <div class="dato-label">
                    Submarca
                </div>

                <div class="dato-valor">
                    {{ $vehiculo->submarca ?? 'No registrada' }}
                </div>

            </div>


            <div class="dato">

                <div class="dato-label">
                    Año
                </div>

                <div class="dato-valor">
                    {{ $vehiculo->anio ?? 'No registrado' }}
                </div>

            </div>


            <div class="dato">

                <div class="dato-label">
                    Color
                </div>

                <div class="dato-valor">
                    {{ $vehiculo->color ?? 'No registrado' }}
                </div>

            </div>


            <div class="dato">

                <div class="dato-label">
                    Placas
                </div>

                <div class="dato-valor">
                    {{ $vehiculo->placas ?? 'No registradas' }}
                </div>

            </div>


            <div class="dato">

                <div class="dato-label">
                    Vigencia
                </div>

                <div class="dato-valor">

                    @if(!empty($vehiculo->vigencia))

                        {{
                            \Carbon\Carbon::parse(
                                $vehiculo->vigencia
                            )->format('d/m/Y')
                        }}

                    @else

                        No registrada

                    @endif

                </div>

            </div>


            <div class="dato completo">

                <div class="dato-label">
                    VIN / Número de serie
                </div>

                <div class="dato-valor">
                    {{ $vinVisible }}
                </div>

            </div>

        </div>

    </section>


    <div class="nota">

        <strong>
            Registro verificado en SICA
        </strong>

        Esta consulta confirma que el código utilizado corresponde
        a un registro existente en el sistema de UCD Meseta Purépecha.
        Los datos personales del afiliado permanecen protegidos.

    </div>


    <footer class="pie">

        <strong>
            SICA
        </strong>

        <br>

        Sistema de Identificación y Control de Afiliaciones

        <br>

        Consulta generada:
        {{ now()->format('d/m/Y H:i') }}

    </footer>

</div>

</body>
</html>