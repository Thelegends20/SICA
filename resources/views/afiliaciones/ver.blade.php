@extends('layouts.app')

@section('titulo','Expediente del Afiliado')

@section('contenido')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold">
            Expediente del Afiliado
        </h2>

        <small class="text-muted">
            Folio:
            <strong>{{ $afiliacion->folio_afiliado }}</strong>
        </small>
    </div>


    <div class="d-flex gap-2">

        <@if($afiliacion->credencial)

         <a href="{{ route('credenciales.show', $afiliacion->credencial->id) }}"
            class="btn btn-primary">

        <i class="bi bi-person-badge"></i>
        Ver Credencial

    </a>

        @else

         <a href="{{ route('credenciales.create', $afiliacion->id) }}"
            class="btn btn-primary">

        <i class="bi bi-person-badge"></i>
        Generar Credencial

         </a>

@endif


        <span class="badge bg-success fs-6 d-flex align-items-center">
            {{ $afiliacion->estatus }}
        </span>

    </div>

</div>


<div class="row">


    <!-- DATOS DEL AFILIADO -->

    <div class="col-lg-5">
    <div class="card mb-4">

    <div class="card-header bg-dark text-white">

        <i class="bi bi-person-badge"></i>

        Credencial

    </div>


    <div class="card-body">

        @if($afiliacion->credencial)

            <p>
                <strong>Folio:</strong>
                {{ $afiliacion->credencial->folio_credencial }}
            </p>

            <p>
                <strong>Estatus:</strong>
                <span class="badge bg-success">
                    {{ $afiliacion->credencial->estatus }}
                </span>
            </p>

            <p>
                <strong>Vigencia:</strong>
                {{ $afiliacion->credencial->vigencia }}
            </p>

            <a href="{{ route('credenciales.show',$afiliacion->credencial->id) }}"
               class="btn btn-primary">

                <i class="bi bi-eye"></i>
                Ver Credencial

            </a>

        @else

            <div class="alert alert-warning">
                Este afiliado aún no cuenta con credencial.
            </div>

        @endif

    </div>

</div>

        <div class="card mb-4">


            <div class="card-header bg-success text-white">

                <h5 class="mb-0">

                    <i class="bi bi-person-fill"></i>

                    Datos del Afiliado

                </h5>

            </div>


            <div class="card-body">


                <table class="table table-borderless">


                    <tr>
                        <th width="35%">Folio</th>
                        <td>{{ $afiliacion->folio_afiliado }}</td>
                    </tr>


                    <tr>
                        <th>Nombre</th>
                        <td>{{ $afiliacion->nombre }}</td>
                    </tr>


                    <tr>
                        <th>INE</th>
                        <td>{{ $afiliacion->ine }}</td>
                    </tr>


                    <tr>
                        <th>CURP</th>
                        <td>{{ $afiliacion->curp ?? 'No registrado' }}</td>
                    </tr>


                    <tr>
                        <th>RFC</th>
                        <td>{{ $afiliacion->rfc ?? 'No registrado' }}</td>
                    </tr>


                    <tr>
                        <th>Teléfono</th>
                        <td>{{ $afiliacion->telefono }}</td>
                    </tr>


                    <tr>
                        <th>Correo</th>
                        <td>{{ $afiliacion->correo ?? 'No registrado' }}</td>
                    </tr>


                    <tr>
                        <th>Domicilio</th>
                        <td>{{ $afiliacion->domicilio }}</td>
                    </tr>


                    <tr>
                        <th>Municipio</th>
                        <td>{{ $afiliacion->municipio ?? 'No registrado' }}</td>
                    </tr>


                    <tr>
                        <th>Estado</th>
                        <td>{{ $afiliacion->estado ?? 'No registrado' }}</td>
                    </tr>


                    <tr>
                        <th>Vigencia</th>
                        <td>{{ $afiliacion->vigencia }}</td>
                    </tr>


                </table>


            </div>


        </div>


    </div>



    <!-- VEHICULOS -->


    <div class="col-lg-7">


        <div class="card">


            <div class="card-header bg-primary text-white d-flex justify-content-between">


                <span>

                    <i class="bi bi-car-front-fill"></i>

                    Vehículos Registrados

                </span>


                <span class="badge bg-light text-dark">

                    {{ $afiliacion->vehiculos->count() }}

                </span>


            </div>



            <div class="card-body">



                @if($afiliacion->vehiculos->count())


                <table class="table table-hover align-middle">


                    <thead class="table-light">

                        <tr>

                            <th>Folio</th>

                            <th>Vehículo</th>

                            <th>VIN</th>

                            <th>Estatus</th>

                            <th width="100">Acción</th>

                        </tr>

                    </thead>



                    <tbody>



                    @foreach($afiliacion->vehiculos as $vehiculo)



                    <tr>


                        <td>

                            {{ $vehiculo->folio_vehiculo }}

                        </td>



                        <td>

                            {{ $vehiculo->marca }}

                            {{ $vehiculo->modelo }}

                            <br>

                            <small class="text-muted">

                                {{ $vehiculo->anio }}

                            </small>


                        </td>



                        <td>

                            {{ $vehiculo->vin }}

                        </td>



                        <td>


                            <span class="badge bg-success">

                                {{ $vehiculo->estatus }}

                            </span>


                        </td>



                        <td>


                            <a href="{{ route('vehiculos.show', $vehiculo->id) }}"
                               class="btn btn-sm btn-primary">


                                <i class="bi bi-eye-fill"></i>

                                Ver


                            </a>


                        </td>



                    </tr>



                    @endforeach



                    </tbody>


                </table>



                @else



                    <div class="alert alert-warning">

                        Este afiliado todavía no tiene vehículos registrados.

                    </div>



                @endif




                <hr>



                <div class="d-flex gap-2">



                    <a href="{{ route('vehiculos.create', $afiliacion->id) }}"
                       class="btn btn-success">


                        <i class="bi bi-plus-circle"></i>

                        Registrar Vehículo


                    </a>



                    <a href="{{ route('credenciales.create', $afiliacion->id) }}"
                       class="btn btn-primary">


                        <i class="bi bi-person-badge"></i>

                        Generar Credencial


                    </a>



                </div>



            </div>


        </div>


    </div>



</div>


@endsection