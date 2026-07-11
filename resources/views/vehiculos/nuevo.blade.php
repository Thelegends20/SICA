@extends('layouts.app')

@section('titulo','Nuevo Vehículo')

@section('contenido')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold">Registrar Vehículo</h2>
            <small class="text-muted">
                Afiliado:
                <strong>{{ $afiliado->nombre }}</strong>
            </small>
        </div>

    </div>


    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Revisa los datos:</strong>

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif



    <div class="card shadow-sm">

        <div class="card-header bg-success text-white">
            Datos del Vehículo
        </div>


        <div class="card-body">


            <form action="{{ route('vehiculos.store') }}" method="POST">

                @csrf


                <input 
                    type="hidden" 
                    name="afiliado_id" 
                    value="{{ $afiliado->id }}">


                <div class="row">


                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Marca
                        </label>

                        <input 
                            type="text"
                            name="marca"
                            class="form-control"
                            required>

                    </div>



                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Submarca
                        </label>

                        <input 
                            type="text"
                            name="submarca"
                            class="form-control">

                    </div>



                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Modelo
                        </label>

                        <input 
                            type="text"
                            name="modelo"
                            class="form-control"
                            required>

                    </div>



                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Año
                        </label>

                        <input 
                            type="number"
                            name="anio"
                            class="form-control"
                            required>

                    </div>



                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Color
                        </label>

                        <input 
                            type="text"
                            name="color"
                            class="form-control"
                            required>

                    </div>



                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            VIN
                        </label>

                        <input 
                            type="text"
                            name="vin"
                            class="form-control"
                            required>

                    </div>



                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Número de Motor
                        </label>

                        <input 
                            type="text"
                            name="motor"
                            class="form-control">

                    </div>



                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Placas
                        </label>

                        <input 
                            type="text"
                            name="placas"
                            class="form-control">

                    </div>



                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Serie Motor
                        </label>

                        <input 
                            type="text"
                            name="serie_motor"
                            class="form-control">

                    </div>


                </div>



                <div class="text-end">

                    <button 
                        type="submit" 
                        class="btn btn-success btn-lg">

                        Guardar Vehículo

                    </button>

                </div>


            </form>


        </div>

    </div>


</div>


@endsection