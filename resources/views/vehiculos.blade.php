<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registrar Vehículo</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>Registrar Vehículo</h3>

</div>

<div class="card-body">

<form action="/vehiculo/guardar" method="POST">

@csrf

<input type="hidden" name="afiliado_id" value="{{ $afiliado->id }}">

<div class="mb-3">

<label>Marca</label>

<input type="text" name="marca" class="form-control">

</div>

<div class="mb-3">

<label>Submarca</label>

<input type="text" name="submarca" class="form-control">

</div>

<div class="mb-3">

<label>Modelo</label>

<input type="text" name="modelo" class="form-control">

</div>

<div class="mb-3">

<label>Año</label>

<input type="number" name="anio" class="form-control">

</div>

<div class="mb-3">

<label>Color</label>

<input type="text" name="color" class="form-control">

</div>

<div class="mb-3">

<label>VIN</label>

<input type="text" name="vin" class="form-control">

</div>

<div class="mb-3">

<label>Motor</label>

<input type="text" name="motor" class="form-control">

</div>

<div class="mb-3">

<label>Placas</label>

<input type="text" name="placas" class="form-control">

</div>

<button class="btn btn-success">

Guardar Vehículo

</button>

</form>

</div>

</div>

</div>

</body>

</html>