@extends('layouts.app')

@section('contenido')

<h1 style="color:red">PRUEBA VEHÍCULOS</h1>

<div class="container mt-4">

    <h2>Vehículos registrados</h2>

    <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-3">
        Regresar
    </a>

    @if($vehiculos->count())

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Afiliado</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Placas</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

            @foreach($vehiculos as $vehiculo)

                <tr>

                    <td>
                        {{ $vehiculo->folio_vehiculo }}
                    </td>

                    <td>
                        {{ $vehiculo->afiliado ? $vehiculo->afiliado->nombre : 'SIN AFILIADO' }}
                    </td>

                    <td>
                        {{ $vehiculo->marca }}
                    </td>

                    <td>
                        {{ $vehiculo->modelo }}
                    </td>

                    <td>
                        {{ $vehiculo->placas }}
                    </td>

                    <td>
                        {{ $vehiculo->estatus }}
                    </td>

                    <td>
                        <a href="{{ route('vehiculos.show',$vehiculo->id) }}"
                           class="btn btn-primary btn-sm">
                            Ver
                        </a>
                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

        {{ $vehiculos->links() }}

    @else

        <div class="alert alert-info">
            No hay vehículos registrados.
        </div>

    @endif

</div>

@endsection