<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function afiliado()
    {
        return $this->belongsTo(Afiliacion::class, 'afiliado_id');
    }
}