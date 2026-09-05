<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoVehiculo extends Model
{
    use HasFactory;

    protected $table = 'documento_vehiculos';

    protected $fillable = [
        'vehiculo_id',
        'tipo_documento',
        'nombre_original',
        'archivo',
        'mime_type',
        'tamano',
        'estatus',
        'observaciones',
        'revisado_por',
        'revisado_at',
    ];

    protected $casts = [
        'revisado_at' => 'datetime',
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function revisor()
    {
        return $this->belongsTo(User::class, 'revisado_por');
    }
}