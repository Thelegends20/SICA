<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{

    public function index()
    {
        $usuarios = User::orderBy('name')->get();

        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.nuevo');
    }

    public function store(Request $request)
    {

        $request->validate([

            'name'=>'required',

            'email'=>'required|email|unique:users',

            'password'=>'required|min:8',

            'rol'=>'required',

        ]);

        User::create([

            'name'=>$request->name,

            'email'=>$request->email,

            'password'=>$request->password,

            'rol'=>$request->rol,

            'activo'=>1,

            'telefono'=>$request->telefono,

            'municipio'=>$request->municipio,

        ]);

        return redirect()->route('usuarios.index')
            ->with('success','Usuario creado correctamente');

    }

    public function edit(User $user)
    {
        return view('usuarios.editar',compact('user'));
    }

    public function update(Request $request, User $user)
    {

        $user->update([

            'name'=>$request->name,

            'email'=>$request->email,

            'rol'=>$request->rol,

            'activo'=>$request->activo,

            'telefono'=>$request->telefono,

            'municipio'=>$request->municipio,

        ]);

        return redirect()->route('usuarios.index');

    }

}