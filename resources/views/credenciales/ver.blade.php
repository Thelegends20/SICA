@extends('layouts.sica')

@section('titulo', 'Credencial de afiliación')

@section('contenido')

@php
    $registro = $credencial ?? null;
    $afiliado = $registro?->afiliado ?? null;

    $estatusOriginal = strtolower($registro->estatus ?? 'activa');
    $estatusVisual = $estatusOriginal;

    if (
        $estatusOriginal === 'activa'
        && !empty($registro->vigencia)
        && \Carbon\Carbon::parse($registro->vigencia)->isPast()
    ) {
        $estatusVisual = 'vencida';
    }

    $estatusTexto = match($estatusVisual) {
        'activa' => 'ACTIVA',
        'vencida' => 'VENCIDA',
        'cancelada' => 'CANCELADA',
        default => strtoupper($estatusVisual),
    };

    $estatusClase = match($estatusVisual) {
        'activa' => 'estado-activa',
        'vencida' => 'estado-vencida',
        'cancelada' => 'estado-cancelada',
        default => 'estado-neutro',
    };

    $fechaVigencia = !empty($registro->vigencia)
        ? \Carbon\Carbon::parse($registro->vigencia)->format('d/m/Y')
        : 'Sin definir';

    $fechaEmision = !empty($registro->created_at)
        ? \Carbon\Carbon::parse($registro->created_at)->format('d/m/Y')
        : now()->format('d/m/Y');

    /*
    |--------------------------------------------------------------------------
    | URL PÚBLICA DE VERIFICACIÓN
    |--------------------------------------------------------------------------
    |
    | Se genera con APP_URL + token único.
    | Así evitamos colocar el token como información visible en la credencial.
    |
    */

    $urlVerificacion = null;

    if (
        $registro
        && !empty($registro->token_qr)
    ) {
        $urlVerificacion =
            rtrim(config('app.url'), '/')
            . '/verificar/credencial/'
            . $registro->token_qr;
    }
@endphp


<style>
    :root {
        --ucd-vino: #651522;
        --ucd-dorado: #a9792f;
        --ucd-texto: #391f1c;
    }

    .credencial-page {
        max-width: 1250px;
        margin: 0 auto;
    }

    .credencial-shell {
        display: flex;
        justify-content: center;
        padding: 20px 0 25px;
    }

    .credencial-ucd {
        position: relative;

        width: 100%;
        max-width: 1050px;

        aspect-ratio: 3 / 2;

        overflow: hidden;

        border-radius: 14px;

        background-image:
            url('{{ asset('images/fondo-credencial-ucd-2026.png') }}');

        background-size: 100% 100%;
        background-position: center;
        background-repeat: no-repeat;

        box-shadow:
            0 20px 55px rgba(49, 31, 24, 0.20),
            0 4px 12px rgba(49, 31, 24, 0.10);
    }

    /*
    |--------------------------------------------------------------------------
    | FOTO
    |--------------------------------------------------------------------------
    */

    .foto-afiliado {
        position: absolute;

        left: 10.25%;
        top: 41.0%;

        width: 17.8%;
        height: 29.5%;

        z-index: 5;

        overflow: hidden;

        border-radius: 8px;

        background:
            rgba(250, 245, 232, 0.90);
    }

    .foto-afiliado img {
        width: 100%;
        height: 100%;

        display: block;

        object-fit: cover;
        object-position: center top;
    }

    .foto-placeholder {
        width: 100%;
        height: 100%;

        display: flex;
        flex-direction: column;

        align-items: center;
        justify-content: center;

        color: rgba(101, 21, 34, 0.55);

        text-align: center;
    }

    .foto-placeholder i {
        font-size: clamp(28px, 4vw, 55px);
    }

    .foto-placeholder span {
        margin-top: 5px;

        font-size: clamp(7px, 0.8vw, 11px);

        font-weight: 800;
    }

    /*
    |--------------------------------------------------------------------------
    | VALORES
    |--------------------------------------------------------------------------
    */

    .valor {
        position: absolute;

        z-index: 6;

        color: var(--ucd-texto);

        font-family:
            Arial,
            Helvetica,
            sans-serif;

        font-weight: 700;

        line-height: 1.05;
    }

    /*
    |--------------------------------------------------------------------------
    | NOMBRE
    |--------------------------------------------------------------------------
    */

    .valor-nombre {
        left: 31.3%;
        top: 39.5%;

        width: 31%;
        height: 8%;

        display: flex;
        align-items: flex-start;

        font-size: clamp(11px, 1.55vw, 22px);

        line-height: 1.02;

        font-weight: 900;

        text-transform: uppercase;

        white-space: normal;

        overflow: hidden;

        text-overflow: clip;

        word-break: normal;
    }

    /*
    |--------------------------------------------------------------------------
    | DOMICILIO
    |--------------------------------------------------------------------------
    */

    .valor-domicilio {
        left: 31.3%;
        top: 49.5%;

        width: 29.5%;

        font-size: clamp(9px, 1.2vw, 17px);

        white-space: nowrap;

        overflow: hidden;

        text-overflow: ellipsis;
    }

    /*
    |--------------------------------------------------------------------------
    | MUNICIPIO
    |--------------------------------------------------------------------------
    */

    .valor-municipio {
        left: 31.3%;
        top: 63.3%;

        width: 16%;

        font-size: clamp(8px, 1.05vw, 15px);

        text-transform: uppercase;

        white-space: nowrap;

        overflow: hidden;

        text-overflow: ellipsis;
    }

    /*
    |--------------------------------------------------------------------------
    | ESTADO
    |--------------------------------------------------------------------------
    */

    .valor-estado {
        left: 49.4%;
        top: 63.3%;

        width: 13%;

        font-size: clamp(8px, 1.05vw, 15px);

        text-transform: uppercase;

        white-space: nowrap;

        overflow: hidden;

        text-overflow: ellipsis;
    }

    /*
    |--------------------------------------------------------------------------
    | VIGENCIA
    |--------------------------------------------------------------------------
    */

    .valor-vigencia {
        left: 44.5%;
        top: 78.1%;

        width: 11.5%;

        text-align: center;

        font-size: clamp(8px, 1vw, 14px);

        font-weight: 900;
    }

    /*
    |--------------------------------------------------------------------------
    | EMISIÓN
    |--------------------------------------------------------------------------
    */

    .valor-emision {
        left: 61.7%;
        top: 78.1%;

        width: 11.5%;

        text-align: center;

        font-size: clamp(8px, 1vw, 14px);

        font-weight: 900;
    }

    /*
    |--------------------------------------------------------------------------
    | FOLIO
    |--------------------------------------------------------------------------
    */

    .valor-folio {
        left: 49.5%;
        top: 87.0%;

        width: 19%;

        text-align: center;

        color: var(--ucd-vino);

        font-size: clamp(8px, 1vw, 14px);

        font-weight: 900;

        letter-spacing: 0.04em;
    }

    /*
    |--------------------------------------------------------------------------
    | ESTADO DE LA CREDENCIAL
    |--------------------------------------------------------------------------
    */

    .estado-credencial {
        position: absolute;

        z-index: 8;

        right: 7.8%;
        bottom: 7.8%;

        min-width: 78px;

        padding:
            5px
            10px;

        border-radius: 999px;

        text-align: center;

        font-family:
            Arial,
            Helvetica,
            sans-serif;

        font-size: clamp(7px, 0.8vw, 11px);

        font-weight: 900;

        letter-spacing: 0.08em;
    }

    .estado-activa {
        color: #215c38;

        background:
            rgba(231, 245, 234, 0.94);

        border:
            1px solid rgba(75, 139, 91, 0.55);
    }

    .estado-vencida {
        color: #775312;

        background:
            rgba(255, 242, 204, 0.95);

        border:
            1px solid rgba(183, 140, 48, 0.55);
    }

    .estado-cancelada {
        color: #7a2731;

        background:
            rgba(248, 225, 228, 0.95);

        border:
            1px solid rgba(160, 64, 76, 0.50);
    }

    .estado-neutro {
        color: #555;

        background:
            rgba(240, 240, 240, 0.95);

        border:
            1px solid #bbb;
    }

    /*
    |--------------------------------------------------------------------------
    | QR DE VERIFICACIÓN
    |--------------------------------------------------------------------------
    */

    .verificacion-panel {
        max-width: 1050px;

        margin:
            5px auto 25px;

        padding:
            22px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 25px;

        border:
            1px solid rgba(101, 21, 34, 0.15);

        border-radius:
            16px;

        background:
            linear-gradient(
                135deg,
                #fffdf9,
                #f8f1e7
            );

        box-shadow:
            0 5px 18px
            rgba(49, 31, 24, 0.07);
    }

    .verificacion-info {
        flex: 1;
        min-width: 0;
    }

    .verificacion-titulo {
        display: flex;

        align-items: center;

        gap: 9px;

        margin-bottom:
            8px;

        color:
            var(--ucd-vino);

        font-size:
            18px;

        font-weight:
            900;
    }

    .verificacion-texto {
        max-width:
            650px;

        color:
            #6c5a50;

        font-size:
            13px;

        line-height:
            1.55;
    }

    .verificacion-folio {
        margin-top:
            10px;

        color:
            var(--ucd-texto);

        font-size:
            12px;

        font-weight:
            800;
    }

    .qr-contenedor {
        flex:
            0 0 auto;

        padding:
            10px;

        display:
            flex;

        align-items:
            center;

        justify-content:
            center;

        border:
            2px solid
            rgba(101, 21, 34, .22);

        border-radius:
            12px;

        background:
            #ffffff;
    }

    .qr-contenedor svg {
        display:
            block;

        width:
            145px;

        height:
            145px;
    }

    .qr-no-disponible {
        width:
            145px;

        height:
            145px;

        display:
            flex;

        flex-direction:
            column;

        align-items:
            center;

        justify-content:
            center;

        gap:
            7px;

        text-align:
            center;

        color:
            #8a7770;

        font-size:
            11px;

        font-weight:
            700;
    }

    .qr-no-disponible i {
        font-size:
            35px;

        color:
            var(--ucd-vino);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCIONES
    |--------------------------------------------------------------------------
    */

    .acciones-credencial {
        display: flex;

        align-items: center;
        justify-content: space-between;

        flex-wrap: wrap;

        gap: 12px;

        margin-top: 15px;
    }

    /*
    |--------------------------------------------------------------------------
    | RESPONSIVE
    |--------------------------------------------------------------------------
    */

    @media (max-width: 850px) {

        .credencial-shell {
            justify-content: flex-start;

            overflow-x: auto;

            padding-bottom: 15px;
        }

        .credencial-ucd {
            min-width: 760px;
        }

        .verificacion-panel {
            align-items:
                flex-start;
        }
    }

    @media (max-width: 650px) {

        .verificacion-panel {
            flex-direction:
                column;

            align-items:
                center;

            text-align:
                center;
        }

        .verificacion-titulo {
            justify-content:
                center;
        }

        .verificacion-folio {
            text-align:
                center;
        }

        .qr-contenedor svg {
            width:
                170px;

            height:
                170px;
        }

        .qr-no-disponible {
            width:
                170px;

            height:
                170px;
        }
    }
</style>


<div class="credencial-page">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">

        <div>

            <h4 class="fw-bold mb-1">
                Credencial de afiliación
            </h4>

            <div class="text-muted small">
                UCD Meseta Purépecha · SICA
            </div>

        </div>


        <div class="d-flex gap-2">

            @if($afiliado)

                <a
                    href="{{ url('/afiliaciones/' . $afiliado->id) }}"
                    class="btn btn-outline-secondary"
                >
                    <i class="bi bi-arrow-left me-1"></i>
                    Regresar
                </a>

            @endif


            @if($registro)

                <a
                    href="{{ url('/credenciales/' . $registro->id . '/imprimir') }}"
                    class="btn btn-sica"
                >
                    <i class="bi bi-printer me-1"></i>
                    Imprimir
                </a>

            @endif

        </div>

    </div>


    @if(!$registro || !$afiliado)

        <div class="alert alert-danger">

            <i class="bi bi-exclamation-triangle me-2"></i>

            No fue posible cargar la información de la credencial.

        </div>

    @else

        <div class="credencial-shell">

            <div class="credencial-ucd">

                {{-- FOTO --}}
                <div class="foto-afiliado">

                    @if(!empty($afiliado->foto))

                        <img
                            src="{{ asset('storage/' . $afiliado->foto) }}"
                            alt="Fotografía de {{ $afiliado->nombre }}"
                        >

                    @else

                        <div class="foto-placeholder">

                            <i class="bi bi-person-bounding-box"></i>

                            <span>
                                SIN FOTOGRAFÍA
                            </span>

                        </div>

                    @endif

                </div>


                {{-- NOMBRE --}}
                <div class="valor valor-nombre">
                    {{ $afiliado->nombre }}
                </div>


                {{-- DOMICILIO --}}
                <div class="valor valor-domicilio">
                    {{ $afiliado->domicilio ?? 'No registrado' }}
                </div>


                {{-- MUNICIPIO --}}
                <div class="valor valor-municipio">
                    {{ $afiliado->municipio ?? 'No registrado' }}
                </div>


                {{-- ESTADO --}}
                <div class="valor valor-estado">
                    {{ $afiliado->estado ?? 'Michoacán' }}
                </div>


                {{-- VIGENCIA --}}
                <div class="valor valor-vigencia">
                    {{ $fechaVigencia }}
                </div>


                {{-- EMISIÓN --}}
                <div class="valor valor-emision">
                    {{ $fechaEmision }}
                </div>


                {{-- FOLIO --}}
                <div class="valor valor-folio">
                    {{ $registro->folio_credencial }}
                </div>


                {{-- ESTADO --}}
                <div class="estado-credencial {{ $estatusClase }}">
                    {{ $estatusTexto }}
                </div>

            </div>

        </div>


        {{-- QR REAL DE VERIFICACIÓN --}}
        <div class="verificacion-panel">

            <div class="verificacion-info">

                <div class="verificacion-titulo">

                    <i class="bi bi-qr-code-scan"></i>

                    Verificación electrónica SICA

                </div>

                <div class="verificacion-texto">

                    Este código QR corresponde exclusivamente a esta
                    credencial. Al escanearlo se consulta directamente
                    su estado y vigencia en el sistema SICA.

                </div>

                <div class="verificacion-folio">

                    Folio:
                    {{ $registro->folio_credencial }}

                </div>

            </div>


            <div class="qr-contenedor">

                @if($urlVerificacion)

                    {!! QrCode::size(220)
                        ->margin(1)
                        ->generate($urlVerificacion) !!}

                @else

                    <div class="qr-no-disponible">

                        <i class="bi bi-qr-code"></i>

                        QR no disponible

                    </div>

                @endif

            </div>

        </div>


        <div class="acciones-credencial">

            <div class="text-muted small">
                Credencial UCD 2026 · Sistema SICA
            </div>


            <div class="d-flex gap-2">

                <a
                    href="{{ url('/afiliaciones/' . $afiliado->id) }}"
                    class="btn btn-outline-secondary"
                >
                    <i class="bi bi-person-vcard me-1"></i>
                    Ver expediente
                </a>


                <a
                    href="{{ url('/credenciales/' . $registro->id . '/imprimir') }}"
                    class="btn btn-sica"
                >
                    <i class="bi bi-printer me-1"></i>
                    Imprimir credencial
                </a>

            </div>

        </div>

    @endif

</div>

@endsection