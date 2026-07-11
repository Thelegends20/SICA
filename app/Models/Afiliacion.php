<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afiliacion extends Model

{
    use HasFactory;

    /**
     * Nombre de la tabla
     */
    protected $table = 'afiliacions';

    /**
     * Campos que se pueden asignar masivamente
     */
    protected $fillable = [
        'folio_afiliado',
        'nombre',
        'ine',
        'curp',
        'rfc',
        'correo',
        'telefono',
        'ine',
        'domicilio',
        'municipio',
        'estado',
        'estatus',
        'vigencia',
     ];

    /**
     * Conversión de tipos
     */

    protected $casts = [
        'vigencia' => 'date',
     ];

    /**
     * Relación:
     * Un afiliado puede tener muchos vehículos.
     */

    public function vehiculos()
     {
        return $this->hasMany(Vehiculo::class, 'afiliado_id');
     }

    /**
     * Accesor:
     * Total de vehículos registrados.
     */

    public function getTotalVehiculosAttribute()
     {
        return $this->vehiculos()->count();
     }

    /**
     * Accesor:
     * Indica si el afiliado está vigente.
     */
    public function getEsVigenteAttribute()
     {
        return $this->estatus === 'VIGENTE';
     }

    /**
     * Accesor:
     * Nombre en mayúsculas.
     */
    public function getNombreCompletoAttribute()

     {
        return strtoupper($this->nombre);
     }

    public function credencial()

     {
    return $this->hasOne(Credencial::class, 'afiliado_id');
     }

};
