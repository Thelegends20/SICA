<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $table = 'vehiculos';

    protected $fillable = [
        'afiliado_id',
        'folio_vehiculo',
        'token_qr',
        'marca',
        'submarca',
        'modelo',
        'anio',
        'color',
        'vin',
        'motor',
        'placas',
        'serie_motor',
        'estatus',
        'vigencia',
    ];

    protected $casts = [
        'anio' => 'integer',
        'vigencia' => 'date',
    ];

    /**
     * Afiliado propietario del vehículo.
     */
    public function afiliado()
    {
        return $this->belongsTo(
            Afiliacion::class,
            'afiliado_id'
        );
    }

    /**
     * Alias para compatibilidad con vistas anteriores.
     */
    public function afiliacion()
    {
        return $this->belongsTo(
            Afiliacion::class,
            'afiliado_id'
        );
    }

    /**
     * Documentos que forman parte del expediente del vehículo.
     */
    public function documentos()
    {
        return $this->hasMany(
            DocumentoVehiculo::class,
            'vehiculo_id'
        );
    }
}