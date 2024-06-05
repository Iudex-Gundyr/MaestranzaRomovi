<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function Usuarios()
    {
        $usuarios = Usuario::all(); // Obtener todos los usuarios
        return view('Intranet.usuarios.usuarios', ['usuarios' => $usuarios]);
    }
    public function CrearUsuario()
    {
        return view('Intranet/usuarios/CrearUsuario');
    }
    public function RegistrarUsuario(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios|max:255',
            'password' => 'required|string|min:8',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena de caracteres.',
            'nombre.max' => 'El campo nombre no debe exceder los 255 caracteres.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El email proporcionado no es válido.',
            'email.unique' => 'El email proporcionado ya está registrado.',
            'email.max' => 'El campo email no debe exceder los 255 caracteres.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.string' => 'El campo contraseña debe ser una cadena de caracteres.',
            'password.min' => 'El campo contraseña debe tener al menos 8 caracteres.'
        ]);
    
        // Crear un nuevo usuario
        $usuario = new Usuario();
        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->save();
    
        // Puedes redirigir a donde desees después de registrar el usuario
        return redirect()->route('Usuarios')->with('success', 'Usuario creado correctamente');
    }
    public function eliminarUsuario($id)
    {
        // Buscar el usuario por su ID
        $usuario = Usuario::find($id);
    
        // Verificar si el usuario existe
        if (!$usuario) {
            // Si el usuario no existe, redirige con un mensaje de error
            return redirect()->route('Usuarios')->with('error', 'Usuario no encontrado');
        }
    
        // Eliminar el usuario
        $usuario->delete();
    
        // Redirigir de vuelta a la página de usuarios con un mensaje de éxito
        return redirect()->route('Usuarios')->with('success', 'Usuario eliminado correctamente');
    }
    public function examinarUsuario($id)
    {
        $usuario = Usuario::find($id);
        if ($usuario) {
            return view('Intranet/usuarios/ModificarUsuario', ['usuario' => $usuario]);
        } else {
            return redirect()->route('usuarios')->with('error', 'El usuario no fue encontrado');
        }
    }
    public function modificarUsuario($id, Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,'.$id.',id_usuario|max:255',
            'password' => 'nullable|string|min:8', // La contraseña es opcional
        ]);
    
        // Buscar el usuario por su ID
        $usuario = Usuario::find($id);
    
        // Verificar si se encontró el usuario
        if ($usuario) {
            // Actualizar los datos del usuario
            $usuario->nombre = $request->nombre;
            $usuario->email = $request->email;
            
            // Verificar si se proporcionó una nueva contraseña
            if ($request->filled('password')) {
                $usuario->password = bcrypt($request->password);
            }
    
            // Guardar los cambios
            $usuario->save();
    
            // Redirigir con un mensaje de éxito
            return redirect()->route('Usuarios')->with('success', 'Usuario modificado correctamente');
        } else {
            // Si no se encuentra el usuario, redirigir con un mensaje de error
            return redirect()->route('Usuarios')->with('error', 'El usuario no fue encontrado');
        }
    }
}