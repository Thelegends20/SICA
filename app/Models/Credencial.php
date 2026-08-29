<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credencial extends Model
{
    use HasFactory;

    protected $table = 'credenciales';

    protected $fillable = [
        'afiliado_id',
        'folio_credencial',
        'token_qr',
        'estatus',
        'vigencia',
    ];

    protected $casts = [
        'vigencia' => 'date',
    ];

    /**
     * Afiliado al que pertenece la credencial.
     */
    public function afiliado()
    {
        return $this->belongsTo(
            Afiliacion::class,
            'afiliado_id'
        );
    }

    /**
     * Alias para mantener compatibilidad
     * con partes anteriores de SICA.
     */
    public function afiliacion()
    {
        return $this->belongsTo(
            Afiliacion::class,
            'afiliado_id'
        );
    }

    /**
     * Determina si la credencial está activa.
     */
    public function estaActiva(): bool
    {
        if ($this->estatus !== 'activa') {
            return false;
        }

        if (!$this->vigencia) {
            return true;
        }

        return $this->vigencia->isToday()
            || $this->vigencia->isFuture();
    }

    /**
     * Determina si la credencial está vencida.
     */
    public function estaVencida(): bool
    {
        if (!$this->vigencia) {
            return false;
        }

        return $this->vigencia->isPast()
            && !$this->vigencia->isToday();
    }
}