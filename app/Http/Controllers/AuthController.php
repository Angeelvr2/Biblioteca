<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function register()
    {
        # Validar datos de registro
        $validateData = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ]);

        # Crear usuario
        $user = \App\Models\User::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'password' => bcrypt($validateData['password']),
            'username' => $validateData['email'], // Asignar el email como username
            'user_type' => 'user', // Asignar un tipo de usuario por defecto
        ]);

        #Redirigir o Iniciar sesión automáticamente
        auth()->login($user);
        return redirect()->route('home');
    }

    public function login(Request $request)
    {
        # Validar datos de login
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        # Intentar iniciar sesión
        if (auth()->attempt($credentials)) {
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Credenciales inválidas', 
            ]);
    }
    
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
