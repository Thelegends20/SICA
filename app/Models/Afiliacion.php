<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afiliacion extends Model
{
    use HasFactory;

    protected $table = 'afiliaciones';

    protected $fillable = [
        'folio_afiliado',
        'nombre',
        'foto',
        'ine',
        'curp',
        'rfc',
        'correo',
        'telefono',
        'domicilio',
        'municipio',
        'estado',
        'estatus',
        'vigencia',
    ];

    protected $casts = [
        'vigencia' => 'date',
    ];

    /**
     * Vehículos pertenecientes a este afiliado.
     */
    public function vehiculos()
    {
        return $this->hasMany(
            Vehiculo::class,
            'afiliado_id'
        );
    }

    /**
     * Credenciales pertenecientes a este afiliado.
     */
    public function credenciales()
    {
        return $this->hasMany(
            Credencial::class,
            'afiliado_id'
        );
    }
}