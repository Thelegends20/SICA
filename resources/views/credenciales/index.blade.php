@extends('layouts.app')

@section('contenido')

<div class="container">

    <h1 class="mb-4">
        Credenciales
    </h1>


    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <div class="card">

        <div class="card-body">

            <table class="table table-striped">

                <thead>
                    <tr>
                        <th>Folio</th>
                        <th>Afiliado</th>
                        <th>QR</th>
                        <th>Estatus</th>
                        <th>Vigencia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>


                <tbody>

                @forelse($credenciales as $credencial)

                    <tr>

                        <td>
                            {{ $credencial->folio_credencial }}
                        </td>


                        <td>
                            {{ $credencial->afiliado->nombre ?? 'Sin nombre' }}
                            {{ $credencial->afiliado->apellido ?? '' }}
                        </td>


                        <td>
                            {{ $credencial->token_qr }}
                        </td>


                        <td>
                            {{ $credencial->estatus }}
                        </td>


                        <td>
                            {{ $credencial->vigencia }}
                        </td>


                        <td>

                            <a href="{{ route('credenciales.show',$credencial->id) }}"
                               class="btn btn-primary btn-sm">
                                Ver
                            </a>

                        </td>

                    </tr>


                @empty

                    <tr>
                        <td colspan="6" class="text-center">
                            No hay credenciales registradas.
                        </td>
                    </tr>

                @endforelse


                </tbody>


            </table>

        </div>

    </div>


</div>


@endsection