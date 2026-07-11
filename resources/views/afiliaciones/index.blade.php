@extends('layouts.app')

@section('titulo','Afiliados')

@section('contenido')

<div class="d-flex justify-content-between mb-4">

<h2>Afiliados</h2>

<a href="/nueva" class="btn btn-success">
Nueva Afiliación
</a>

</div>

<table class="table table-striped">

<thead>

<tr>

<th>Folio</th>

<th>Nombre</th>

<th>Teléfono</th>

<th>Estatus</th>

<th></th>

</tr>

</thead>

<tbody>

@foreach($afiliados as $a)

<tr>

<td>{{ $a->folio_afiliado }}</td>

<td>{{ $a->nombre }}</td>

<td>{{ $a->telefono }}</td>

<td>

@if($a->estatus=='VIGENTE')

<span class="badge bg-success">
VIGENTE
</span>

@else

<span class="badge bg-danger">
VENCIDO
</span>

@endif

</td>

<td>

<a href="/afiliado/{{ $a->id }}"
class="btn btn-primary btn-sm">

Abrir Expediente

</a>

</td>

</tr>

@endforeach

</tbody>

</table>

@endsection