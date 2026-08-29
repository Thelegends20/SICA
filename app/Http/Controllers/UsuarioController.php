<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    /**
     * Mostrar listado de usuarios.
     */
    public function index()
    {
        $usuarios = User::orderByDesc('id')->get();

        return view(
            'usuarios.index',
            compact('usuarios')
        );
    }


    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        return view('usuarios.crear');
    }


    /**
     * Guardar nuevo usuario.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'email' => [
                'required',
                'email',
                'max:150',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'rol' => [
                'required',
                Rule::in([
                    'ADMIN_PRINCIPAL',
                    'COORDINADOR',
                ]),
            ],
        ]);


        $usuario = new User();

        $usuario->name =
            $datos['name'];

        $usuario->email =
            strtolower($datos['email']);

        $usuario->password =
            Hash::make($datos['password']);

        $usuario->rol =
            $datos['rol'];

        $usuario->save();


        return redirect('/usuarios')
            ->with(
                'success',
                'Usuario creado correctamente.'
            );
    }


    /**
     * Mostrar formulario de edición.
     */
    public function edit($id)
    {
        $usuario = User::findOrFail($id);

        return view(
            'usuarios.editar',
            compact('usuario')
        );
    }


    /**
     * Actualizar usuario.
     */
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);


        $datos = $request->validate([
            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'email' => [
                'required',
                'email',
                'max:150',

                Rule::unique('users', 'email')
                    ->ignore($usuario->id),
            ],

            'rol' => [
                'required',
                Rule::in([
                    'ADMIN_PRINCIPAL',
                    'COORDINADOR',
                ]),
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);


        $usuario->name =
            $datos['name'];

        $usuario->email =
            strtolower($datos['email']);

        $usuario->rol =
            $datos['rol'];


        /*
        |--------------------------------------------------------------------------
        | CAMBIAR CONTRASEÑA SOLO SI SE ESCRIBIÓ UNA NUEVA
        |--------------------------------------------------------------------------
        */

        if (!empty($datos['password'])) {

            $usuario->password =
                Hash::make($datos['password']);

        }


        $usuario->save();


        return redirect('/usuarios')
            ->with(
                'success',
                'Usuario actualizado correctamente.'
            );
    }
}