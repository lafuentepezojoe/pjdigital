<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        // Retornar la vista con las variables usuarios y roles
        $usuarios=User::all();
        return view('panel.usuarios.index', compact('usuarios'));
    }
    

    public function password_reset(Request $request, $id)
{
    // Validar la contraseña ingresada
    $request->validate([
        'password' => 'required|string|max:255',
    ]);

    // Buscar el usuario por su ID
    $usuario = User::findOrFail($id);

    // Actualizar la contraseña encriptada
    $usuario->update([
        'password' => bcrypt($request->password), // Asegúrate de encriptar la contraseña
    ]);

    // Redirigir con mensaje de éxito
    return redirect()->route('usuarios.index')->with('success', 'Contraseña reseteada correctamente.');
}



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        User::create([
            'name' => $request->name,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Puedes cambiar la lógica del password
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'rol' => $request->rol,
            'status'=>$request->status
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('panel.usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'string|max:255',
            'direccion' => 'string|max:255',
            'rol' => 'string|max:255',

        ]);

        $usuario->update($request->only('name','apellidos','telefono','direccion','rol'));

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}