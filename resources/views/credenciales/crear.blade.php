@extends('layouts.app')

@section('titulo','Generar Credencial')

@section('contenido')

<div class="container">

    <div class="mb-4">
        <h2 class="fw-bold">
            Generar Credencial
        </h2>

        <p class="text-muted">
            Afiliado:
            <strong>{{ $afiliado->nombre }}</strong>
        </p>
    </div>


    @if ($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif



    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">
            Confirmar Credencial
        </div>


        <div class="card-body">


            <form action="{{ route('credenciales.store') }}"
                  method="POST">

                @csrf


                <input type="hidden"
                       name="afiliado_id"
                       value="{{ $afiliado->id }}">



                <div class="mb-3">

                    <label class="form-label">
                        Afiliado
                    </label>

                    <input type="text"
                           class="form-control"
                           value="{{ $afiliado->nombre }}"
                           disabled>

                </div>



                <div class="mb-3">

                    <label class="form-label">
                        Folio Afiliado
                    </label>

                    <input type="text"
                           class="form-control"
                           value="{{ $afiliado->folio_afiliado }}"
                           disabled>

                </div>



                <div class="text-end">

                    <button type="submit"
                            class="btn btn-success">

                        Generar Credencial

                    </button>

                </div>


            </form>


        </div>

    </div>


</div>


@endsection