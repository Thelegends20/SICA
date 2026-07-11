<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehiculo extends Model
{
    use HasFactory;

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
        'vigencia' => 'date',
     ];


    public function afiliado()
    {
        return $this->belongsTo(Afiliacion::class, 'afiliado_id');
    }
    
};