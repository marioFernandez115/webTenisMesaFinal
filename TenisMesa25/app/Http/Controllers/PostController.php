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
        'nombreyapellidos' => 'required|string|max:255',
      
        'telefono' => 'required|string|max:15',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = \App\Models\User::create([
        'nombreyapellidos' => $request->nombre,
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
