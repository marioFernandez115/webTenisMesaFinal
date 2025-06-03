<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function showRegisterForm()
{
    return view('auth.register'); 
}

public function register(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido_1' => 'required|string|max:255',
        'apellido_2' => 'required|string|max:255',
        'telefono' => 'required|string|max:15',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = \App\Models\User::create([
        'nombre' => $request->nombre,
        'apellido_1' => $request->apellido_1,
        'apellido_2' => $request->apellido_2,
        'telefono' => $request->telefono,
        'email' => $request->email,
        'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        'activo' => true,
        'rol' => 'usuario',
    ]);

    auth()->login($user); 

    return redirect()->route('home')->with('success', '¡Registro exitoso!');
}
}
