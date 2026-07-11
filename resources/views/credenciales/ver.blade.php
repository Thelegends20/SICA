@extends('layouts.app')

@section('titulo','Credencial del Afiliado')

@section('contenido')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold">
                Credencial del Afiliado
            </h2>

            <small class="text-muted">
                Folio:
                <strong>{{ $credencial->folio_credencial }}</strong>
            </small>
        </div>


        <span class="badge bg-success fs-6">
            {{ $credencial->estatus }}
        </span>

    </div>



    <div class="row">


        <div class="col-md-6">


            <div class="card shadow">


                <div class="card-header bg-primary text-white">

                    <h5 class="mb-0">
                        UCD - Credencial
                    </h5>

                </div>



                <div class="card-body text-center">


                    <h3 class="fw-bold">
                        {{ $credencial->afiliado->nombre }}
                    </h3>


                    <hr>


                    <p>
                        <strong>Folio Afiliado:</strong><br>
                        {{ $credencial->afiliado->folio_afiliado }}
                    </p>


                    <p>
                        <strong>Folio Credencial:</strong><br>
                        {{ $credencial->folio_credencial }}
                    </p>


                    <p>
                        <strong>Vigencia:</strong><br>
                        {{ $credencial->vigencia }}
                    </p>


                    <p>
                        <strong>Token QR:</strong><br>
                        <code>
                            {{ $credencial->token_qr }}
                        </code>
                    </p>


                </div>


            </div>


        </div>



        <div class="col-md-6">


            <div class="card shadow">


                <div class="card-header bg-success text-white">

                    Vehículos Registrados

                </div>


                <div class="card-body">


                    @forelse($credencial->afiliado->vehiculos as $vehiculo)


                        <div class="border rounded p-3 mb-3">


                            <h5>
                                {{ $vehiculo->marca }}
                                {{ $vehiculo->modelo }}
                            </h5>


                            <p class="mb-1">
                                <strong>Folio:</strong>
                                {{ $vehiculo->folio_vehiculo }}
                            </p>


                            <p class="mb-1">
                                <strong>VIN:</strong>
                                {{ $vehiculo->vin }}
                            </p>


                            <p class="mb-1">
                                <strong>Placas:</strong>
                                {{ $vehiculo->placas }}
                            </p>


                        </div>


                    @empty


                        <p class="text-muted">
                            No hay vehículos registrados.
                        </p>


                    @endforelse


                </div>


            </div>


        </div>


    </div>



    <div class="mt-4">

        <a href="{{ route('afiliados.show', $credencial->afiliado->id) }}"
           class="btn btn-secondary">

            Volver al Expediente

        </a>

    </div>


</div>


@endsection