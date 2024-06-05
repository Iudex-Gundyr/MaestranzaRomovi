<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Usuario;

class LoginController extends Controller
{
    public function login()
    {
        return view('Login');
    }

    public function iniciarSesion(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar iniciar sesión con las credenciales proporcionadas
        $credenciales = $request->only('email', 'password');

        if (Auth::attempt($credenciales)) {
            // La autenticación fue exitosa
            return redirect()->intended('/dashboard');
        }

        // La autenticación falló
        return back()->withErrors(['mensaje' => 'Credenciales inválidas'])->withInput();
    }
}
