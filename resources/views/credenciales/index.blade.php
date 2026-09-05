@extends('layouts.sica')

@section('titulo', 'Credenciales')

@section('contenido')

@php
    $totalCredenciales = $credenciales->count();

    $activas = $credenciales->filter(function ($credencial) {
        if (strtolower($credencial->estatus ?? '') !== 'activa') {
            return false;
        }

        if (empty($credencial->vigencia)) {
            return true;
        }

        return !\Carbon\Carbon::parse($credencial->vigencia)->isPast();
    })->count();

    $vencidas = $credenciales->filter(function ($credencial) {
        if (strtolower($credencial->estatus ?? '') !== 'activa') {
            return false;
        }

        if (empty($credencial->vigencia)) {
            return false;
        }

        return \Carbon\Carbon::parse($credencial->vigencia)->isPast();
    })->count();

    $canceladas = $credenciales->filter(function ($credencial) {
        return strtolower($credencial->estatus ?? '') === 'cancelada';
    })->count();
@endphp


<style>

    :root {
        --ucd-vino: #651522;
        --ucd-vino-oscuro: #48131e;
        --ucd-dorado: #a9792f;
        --ucd-marfil: #fbf6e9;
        --ucd-texto: #332822;
    }


    /*
    |--------------------------------------------------------------------------
    | CONTENEDOR
    |--------------------------------------------------------------------------
    */

    .credenciales-page {
        max-width: 1350px;
        margin: 0 auto;
    }


    /*
    |--------------------------------------------------------------------------
    | ENCABEZADO
    |--------------------------------------------------------------------------
    */

    .credenciales-header {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 18px;

        flex-wrap: wrap;

        margin-bottom: 24px;
    }

    .credenciales-title {
        margin: 0;

        color: var(--ucd-vino);

        font-size: 28px;
        line-height: 1.1;

        font-weight: 900;
    }

    .credenciales-subtitle {
        margin-top: 6px;

        color: #7a6a60;

        font-size: 13px;
    }

    .header-acciones {
        display: flex;
        align-items: center;

        gap: 10px;

        flex-wrap: wrap;
    }


    /*
    |--------------------------------------------------------------------------
    | RESUMEN
    |--------------------------------------------------------------------------
    */

    .resumen-grid {
        display: grid;

        grid-template-columns:
            repeat(4, minmax(0, 1fr));

        gap: 15px;

        margin-bottom: 24px;
    }

    .resumen-card {
        position: relative;

        overflow: hidden;

        padding: 18px 19px;

        background: #fff;

        border:
            1px solid rgba(101, 21, 34, 0.10);

        border-radius: 16px;

        box-shadow:
            0 8px 22px rgba(43, 31, 26, 0.06);
    }

    .resumen-card::before {
        content: "";

        position: absolute;

        left: 0;
        top: 0;

        width: 5px;
        height: 100%;

        background: var(--ucd-dorado);
    }

    .resumen-label {
        color: #8d796c;

        font-size: 10px;

        font-weight: 900;

        letter-spacing: 0.09em;

        text-transform: uppercase;
    }

    .resumen-number {
        margin-top: 5px;

        color: var(--ucd-texto);

        font-size: 28px;
        line-height: 1;

        font-weight: 900;
    }

    .resumen-total::before {
        background: var(--ucd-vino);
    }

    .resumen-activa::before {
        background: #3f8058;
    }

    .resumen-vencida::before {
        background: #c3912e;
    }

    .resumen-cancelada::before {
        background: #a33b49;
    }


    /*
    |--------------------------------------------------------------------------
    | BARRA DE IMPRESIÓN
    |--------------------------------------------------------------------------
    */

    .barra-impresion {
        display: flex;

        align-items: center;
        justify-content: space-between;

        gap: 15px;

        flex-wrap: wrap;

        margin-bottom: 14px;

        padding: 13px 15px;

        background:
            linear-gradient(
                135deg,
                #fffaf0,
                #ffffff
            );

        border:
            1px solid rgba(169, 121, 47, .28);

        border-radius: 13px;
    }

    .seleccion-info {
        display: flex;

        align-items: center;

        gap: 10px;

        color: #6d5b4e;

        font-size: 12px;

        font-weight: 700;
    }

    .seleccion-contador {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        min-width: 29px;
        height: 29px;

        padding: 0 8px;

        border-radius: 999px;

        color: #fff;

        background: var(--ucd-vino);

        font-size: 12px;

        font-weight: 900;
    }

    .btn-imprimir-seleccion {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        gap: 7px;

        padding:
            9px
            14px;

        color: #fff;

        background:
            var(--ucd-vino);

        border:
            1px solid var(--ucd-vino);

        border-radius:
            9px;

        font-size:
            12px;

        font-weight:
            900;

        cursor:
            pointer;

        transition:
            opacity .15s ease,
            transform .15s ease;
    }

    .btn-imprimir-seleccion:hover:not(:disabled) {
        transform:
            translateY(-1px);

        background:
            var(--ucd-vino-oscuro);
    }

    .btn-imprimir-seleccion:disabled {
        opacity:
            .42;

        cursor:
            not-allowed;
    }


    /*
    |--------------------------------------------------------------------------
    | TABLA
    |--------------------------------------------------------------------------
    */

    .credenciales-card {
        overflow: hidden;

        background: #fff;

        border:
            1px solid rgba(101, 21, 34, 0.10);

        border-radius: 18px;

        box-shadow:
            0 12px 30px rgba(43, 31, 26, 0.07);
    }

    .tabla-scroll {
        width: 100%;

        overflow-x: auto;
    }

    .credenciales-table {
        width: 100%;

        min-width: 960px;

        margin: 0;

        border-collapse: collapse;
    }

    .credenciales-table thead th {
        padding: 15px 16px;

        background:
            linear-gradient(
                135deg,
                var(--ucd-vino),
                var(--ucd-vino-oscuro)
            );

        color: #fff;

        font-size: 10px;

        font-weight: 900;

        letter-spacing: 0.07em;

        text-transform: uppercase;

        border: 0;
    }

    .credenciales-table tbody td {
        padding: 15px 16px;

        vertical-align: middle;

        border-bottom:
            1px solid #eee7df;

        color: #453932;

        font-size: 13px;
    }

    .credenciales-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .credenciales-table tbody tr:hover {
        background:
            #fdfaf4;
    }

    .credenciales-table tbody tr.fila-seleccionada {
        background:
            #fff8e8;
    }


    /*
    |--------------------------------------------------------------------------
    | SELECCIÓN
    |--------------------------------------------------------------------------
    */

    .col-seleccion {
        width: 54px;

        text-align: center;
    }

    .check-credencial,
    #seleccionarTodas {
        width: 18px;
        height: 18px;

        margin: 0;

        cursor: pointer;

        accent-color:
            var(--ucd-vino);
    }


    /*
    |--------------------------------------------------------------------------
    | AFILIADO
    |--------------------------------------------------------------------------
    */

    .afiliado-box {
        display: flex;

        align-items: center;

        gap: 11px;
    }

    .afiliado-foto {
        width: 44px;
        height: 44px;

        overflow: hidden;

        flex: 0 0 auto;

        border-radius: 50%;

        background: #eee5d8;

        border:
            2px solid rgba(169, 121, 47, 0.35);
    }

    .afiliado-foto img {
        width: 100%;
        height: 100%;

        display: block;

        object-fit: cover;

        object-position: center top;
    }

    .afiliado-sin-foto {
        width: 100%;
        height: 100%;

        display: flex;

        align-items: center;
        justify-content: center;

        color: #9a8473;

        font-size: 20px;
    }

    .afiliado-nombre {
        color: #352a25;

        font-weight: 900;
    }

    .afiliado-folio {
        margin-top: 3px;

        color: #938177;

        font-size: 10px;
    }


    /*
    |--------------------------------------------------------------------------
    | ESTADO
    |--------------------------------------------------------------------------
    */

    .estado {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        min-width: 84px;

        padding:
            6px
            10px;

        border-radius: 999px;

        font-size: 9px;

        font-weight: 900;

        letter-spacing: 0.07em;
    }

    .estado-activa {
        color: #245d3b;

        background: #e6f3e9;

        border:
            1px solid #b2d2ba;
    }

    .estado-vencida {
        color: #775514;

        background: #fff2ca;

        border:
            1px solid #ddc070;
    }

    .estado-cancelada {
        color: #782d37;

        background: #f6e0e3;

        border:
            1px solid #d7a4aa;
    }

    .estado-neutro {
        color: #555;

        background: #eeeeee;

        border:
            1px solid #cccccc;
    }


    /*
    |--------------------------------------------------------------------------
    | BOTONES
    |--------------------------------------------------------------------------
    */

    .acciones {
        display: flex;

        align-items: center;

        gap: 7px;

        flex-wrap: nowrap;
    }

    .btn-accion {
        width: 36px;
        height: 36px;

        display: inline-flex;

        align-items: center;
        justify-content: center;

        border-radius: 9px;

        text-decoration: none;

        transition:
            transform 0.15s ease,
            background 0.15s ease;
    }

    .btn-ver {
        color: var(--ucd-vino);

        background: #f7edef;

        border:
            1px solid #e1bdc3;
    }

    .btn-imprimir {
        color: #765218;

        background: #fff4d9;

        border:
            1px solid #e4ca8a;
    }

    .btn-expediente {
        color: #36596f;

        background: #eaf1f5;

        border:
            1px solid #b7cad6;
    }

    .btn-accion:hover {
        transform: translateY(-1px);
    }


    /*
    |--------------------------------------------------------------------------
    | VACÍO
    |--------------------------------------------------------------------------
    */

    .sin-registros {
        padding:
            55px
            25px;

        text-align: center;
    }

    .sin-registros i {
        display: block;

        margin-bottom: 14px;

        color: var(--ucd-dorado);

        font-size: 48px;
    }

    .sin-registros-titulo {
        color: var(--ucd-vino);

        font-size: 18px;

        font-weight: 900;
    }

    .sin-registros-texto {
        margin-top: 6px;

        color: #88776c;

        font-size: 12px;
    }


    /*
    |--------------------------------------------------------------------------
    | RESPONSIVE
    |--------------------------------------------------------------------------
    */

    @media (max-width: 900px) {

        .resumen-grid {
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }

        .barra-impresion {
            align-items:
                stretch;
        }

        .btn-imprimir-seleccion {
            width:
                100%;
        }
    }

    @media (max-width: 520px) {

        .resumen-grid {
            grid-template-columns:
                1fr;
        }

        .credenciales-title {
            font-size: 23px;
        }
    }

</style>


<div class="credenciales-page">


    {{-- ENCABEZADO --}}

    <div class="credenciales-header">

        <div>

            <h2 class="credenciales-title">
                Credenciales UCD
            </h2>

            <div class="credenciales-subtitle">
                Control de credenciales de afiliación
                · Sistema SICA
            </div>

        </div>


        <div class="header-acciones">

            <a
                href="{{ route('credenciales.create') }}"
                class="btn btn-sica"
            >
                <i class="bi bi-plus-circle me-1"></i>

                Nueva credencial
            </a>

        </div>

    </div>



    {{-- RESUMEN --}}

    <div class="resumen-grid">

        <div class="resumen-card resumen-total">

            <div class="resumen-label">
                Total
            </div>

            <div class="resumen-number">
                {{ $totalCredenciales }}
            </div>

        </div>


        <div class="resumen-card resumen-activa">

            <div class="resumen-label">
                Activas
            </div>

            <div class="resumen-number">
                {{ $activas }}
            </div>

        </div>


        <div class="resumen-card resumen-vencida">

            <div class="resumen-label">
                Vencidas
            </div>

            <div class="resumen-number">
                {{ $vencidas }}
            </div>

        </div>


        <div class="resumen-card resumen-cancelada">

            <div class="resumen-label">
                Canceladas
            </div>

            <div class="resumen-number">
                {{ $canceladas }}
            </div>

        </div>

    </div>



    {{-- CONTENIDO --}}

    <div class="credenciales-card">

        @if($credenciales->isEmpty())

            <div class="sin-registros">

                <i class="bi bi-person-vcard"></i>

                <div class="sin-registros-titulo">
                    No hay credenciales registradas
                </div>

                <div class="sin-registros-texto">
                    Crea la primera credencial de afiliación.
                </div>

                <div class="mt-3">

                    <a
                        href="{{ route('credenciales.create') }}"
                        class="btn btn-sica"
                    >
                        <i class="bi bi-plus-circle me-1"></i>

                        Crear credencial
                    </a>

                </div>

            </div>

        @else

            {{--
            |--------------------------------------------------------------------------
            | FORMULARIO DE IMPRESIÓN MÚLTIPLE
            |--------------------------------------------------------------------------
            --}}

            <form
                id="formImpresionMultiple"
                method="GET"
                action="{{ route('credenciales.imprimir-hoja') }}"
                target="_blank"
            >

                <div
                    class="barra-impresion"
                    style="
                        margin: 14px;
                        margin-bottom: 0;
                    "
                >

                    <div class="seleccion-info">

                        <span class="seleccion-contador"
                              id="contadorSeleccion">
                            0
                        </span>

                        <span id="textoSeleccion">
                            Ninguna credencial seleccionada
                        </span>

                    </div>


                    <button
                        type="submit"
                        id="btnImprimirSeleccion"
                        class="btn-imprimir-seleccion"
                        disabled
                    >

                        <i class="bi bi-printer"></i>

                        Imprimir seleccionadas

                    </button>

                </div>


                <div class="tabla-scroll">

                    <table class="credenciales-table">

                        <thead>

                            <tr>

                                <th class="col-seleccion">

                                    <input
                                        type="checkbox"
                                        id="seleccionarTodas"
                                        title="Seleccionar todas"
                                    >

                                </th>


                                <th>
                                    Credencial
                                </th>

                                <th>
                                    Afiliado
                                </th>

                                <th>
                                    Vigencia
                                </th>

                                <th>
                                    Estado
                                </th>

                                <th>
                                    Emisión
                                </th>

                                <th style="width: 150px;">
                                    Acciones
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($credenciales as $credencial)

                                @php

                                    $afiliado =
                                        $credencial->afiliado;


                                    $estatusOriginal =
                                        strtolower(
                                            $credencial->estatus
                                            ?? 'activa'
                                        );


                                    $estatusVisual =
                                        $estatusOriginal;


                                    if (
                                        $estatusOriginal === 'activa'
                                        && !empty($credencial->vigencia)
                                        && \Carbon\Carbon::parse(
                                            $credencial->vigencia
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


                                    $vigencia =
                                        !empty($credencial->vigencia)

                                        ? \Carbon\Carbon::parse(
                                            $credencial->vigencia
                                        )->format('d/m/Y')

                                        : 'Sin definir';


                                    $emision =
                                        !empty($credencial->created_at)

                                        ? \Carbon\Carbon::parse(
                                            $credencial->created_at
                                        )->format('d/m/Y')

                                        : 'Sin definir';

                                @endphp


                                <tr
                                    data-fila-credencial="{{ $credencial->id }}"
                                >


                                    {{-- SELECCIÓN --}}

                                    <td class="col-seleccion">

                                        <input
                                            type="checkbox"
                                            class="check-credencial"
                                            name="credenciales[]"
                                            value="{{ $credencial->id }}"
                                            aria-label="Seleccionar {{ $credencial->folio_credencial }}"
                                        >

                                    </td>



                                    {{-- CREDENCIAL --}}

                                    <td>

                                        <div
                                            class="fw-bold"
                                            style="
                                                color:
                                                    var(--ucd-vino);
                                            "
                                        >

                                            {{ $credencial->folio_credencial }}

                                        </div>


                                        <div class="text-muted small mt-1">

                                            ID #{{ $credencial->id }}

                                        </div>

                                    </td>



                                    {{-- AFILIADO --}}

                                    <td>

                                        <div class="afiliado-box">

                                            <div class="afiliado-foto">

                                                @if(
                                                    $afiliado
                                                    && !empty($afiliado->foto)
                                                )

                                                    <img
                                                        src="{{ asset(
                                                            'storage/'
                                                            . $afiliado->foto
                                                        ) }}"
                                                        alt="{{ $afiliado->nombre }}"
                                                    >

                                                @else

                                                    <div class="afiliado-sin-foto">

                                                        <i class="bi bi-person"></i>

                                                    </div>

                                                @endif

                                            </div>


                                            <div>

                                                <div class="afiliado-nombre">

                                                    {{
                                                        $afiliado->nombre
                                                        ?? 'Afiliado no disponible'
                                                    }}

                                                </div>


                                                @if($afiliado)

                                                    <div class="afiliado-folio">

                                                        {{
                                                            $afiliado->folio_afiliado
                                                            ?? ''
                                                        }}

                                                    </div>

                                                @endif

                                            </div>

                                        </div>

                                    </td>



                                    {{-- VIGENCIA --}}

                                    <td>
                                        {{ $vigencia }}
                                    </td>



                                    {{-- ESTADO --}}

                                    <td>

                                        <span
                                            class="estado {{ $estatusClase }}"
                                        >
                                            {{ $estatusTexto }}
                                        </span>

                                    </td>



                                    {{-- EMISIÓN --}}

                                    <td>
                                        {{ $emision }}
                                    </td>



                                    {{-- ACCIONES --}}

                                    <td>

                                        <div class="acciones">


                                            <a
                                                href="{{ route(
                                                    'credenciales.show',
                                                    $credencial->id
                                                ) }}"
                                                class="btn-accion btn-ver"
                                                title="Ver credencial"
                                            >
                                                <i class="bi bi-eye"></i>
                                            </a>


                                            <a
                                                href="{{ route(
                                                    'credenciales.imprimir',
                                                    $credencial->id
                                                ) }}"
                                                class="btn-accion btn-imprimir"
                                                title="Imprimir individual"
                                            >
                                                <i class="bi bi-printer"></i>
                                            </a>


                                            @if($afiliado)

                                                <a
                                                    href="{{ route(
                                                        'afiliaciones.show',
                                                        $afiliado->id
                                                    ) }}"
                                                    class="btn-accion btn-expediente"
                                                    title="Ver expediente"
                                                >
                                                    <i class="bi bi-person-vcard"></i>
                                                </a>

                                            @endif


                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </form>

        @endif

    </div>

</div>


@if(!$credenciales->isEmpty())

<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const seleccionarTodas =
                document.getElementById(
                    'seleccionarTodas'
                );


            const checks =
                Array.from(
                    document.querySelectorAll(
                        '.check-credencial'
                    )
                );


            const contador =
                document.getElementById(
                    'contadorSeleccion'
                );


            const textoSeleccion =
                document.getElementById(
                    'textoSeleccion'
                );


            const botonImprimir =
                document.getElementById(
                    'btnImprimirSeleccion'
                );


            const formulario =
                document.getElementById(
                    'formImpresionMultiple'
                );


            /*
            |--------------------------------------------------------------------------
            | ACTUALIZAR INTERFAZ
            |--------------------------------------------------------------------------
            */

            function actualizarSeleccion() {

                const seleccionados =
                    checks.filter(
                        checkbox =>
                            checkbox.checked
                    );


                const cantidad =
                    seleccionados.length;


                /*
                |--------------------------------------------------------------------------
                | CONTADOR
                |--------------------------------------------------------------------------
                */

                contador.textContent =
                    cantidad;


                /*
                |--------------------------------------------------------------------------
                | TEXTO
                |--------------------------------------------------------------------------
                */

                if (cantidad === 0) {

                    textoSeleccion.textContent =
                        'Ninguna credencial seleccionada';

                } else if (cantidad === 1) {

                    textoSeleccion.textContent =
                        '1 credencial seleccionada';

                } else {

                    textoSeleccion.textContent =
                        cantidad
                        + ' credenciales seleccionadas';
                }


                /*
                |--------------------------------------------------------------------------
                | BOTÓN
                |--------------------------------------------------------------------------
                */

                botonImprimir.disabled =
                    cantidad === 0;


                /*
                |--------------------------------------------------------------------------
                | SELECCIONAR TODAS
                |--------------------------------------------------------------------------
                */

                seleccionarTodas.checked =
                    cantidad > 0
                    && cantidad === checks.length;


                seleccionarTodas.indeterminate =
                    cantidad > 0
                    && cantidad < checks.length;


                /*
                |--------------------------------------------------------------------------
                | RESALTAR FILAS
                |--------------------------------------------------------------------------
                */

                checks.forEach(
                    checkbox => {

                        const fila =
                            checkbox.closest('tr');

                        if (!fila) {
                            return;
                        }

                        fila.classList.toggle(
                            'fila-seleccionada',
                            checkbox.checked
                        );
                    }
                );
            }


            /*
            |--------------------------------------------------------------------------
            | CHECK GENERAL
            |--------------------------------------------------------------------------
            */

            seleccionarTodas.addEventListener(
                'change',
                function () {

                    checks.forEach(
                        checkbox => {

                            checkbox.checked =
                                seleccionarTodas.checked;
                        }
                    );


                    actualizarSeleccion();
                }
            );


            /*
            |--------------------------------------------------------------------------
            | CHECK INDIVIDUAL
            |--------------------------------------------------------------------------
            */

            checks.forEach(
                checkbox => {

                    checkbox.addEventListener(
                        'change',
                        actualizarSeleccion
                    );
                }
            );


            /*
            |--------------------------------------------------------------------------
            | VALIDAR ENVÍO
            |--------------------------------------------------------------------------
            */

            formulario.addEventListener(
                'submit',
                function (evento) {

                    const cantidad =
                        checks.filter(
                            checkbox =>
                                checkbox.checked
                        ).length;


                    if (cantidad === 0) {

                        evento.preventDefault();

                        return;
                    }
                }
            );


            /*
            |--------------------------------------------------------------------------
            | ESTADO INICIAL
            |--------------------------------------------------------------------------
            */

            actualizarSeleccion();

        }
    );

</script>

@endif


@endsection