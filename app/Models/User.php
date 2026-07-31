<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;


    protected $fillable = [

    'name',

    'email',

    'password',

    'rol',

    'activo',

    'telefono',

    'municipio',

];


    /**
     * Campos ocultos.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * Conversiones automáticas.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'activo' => 'boolean',
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Métodos de roles
    |--------------------------------------------------------------------------
    */


    public function esAdministradorPrincipal(): bool
    {
        return $this->rol === 'ADMIN_PRINCIPAL';
    }


    public function esAdministradorAuxiliar(): bool
    {
        return $this->rol === 'ADMIN_AUXILIAR';
    }


    public function esCoordinador(): bool
    {
        return $this->rol === 'COORDINADOR';
    }


    public function estaActivo(): bool
    {
        return $this->activo === true;
    }
}