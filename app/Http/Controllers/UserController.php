<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Usamos el modelo para recolectar todos los usuarios y los paginamos de 10 en 10
     */
    public function index()
    {
        
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Nos devuelve la vista para crear el usuario
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Validamos los datos con validate() y luego si está todo correcto lo almacenamos en la base de datos
     */
    public function store(Request $request)
    {
        // Validamos los datos recibidos
        $datos = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        //Creamos la instancia de usuario para almacenar los datos
        $user = new User();
        $user->name = $datos['name'];
        $user->email = $datos['email'];
        $user->password = bcrypt($datos['password']);
        //Guardamos finalmente en la base de datos
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Mostramos en base la id única, todos los datos del usuario
     */
    public function show(string $id)
    {
        // Muestra los detalles de un usuario
        $user = User::findOrFail($id);
        // Devulve la vista show con el usuario como variable
        return view('admin.users.show', compact('user'));
    }

    /**
     * Enseña un pequeño formulario para editar un formulario en específico
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // Reglas de validación
        $rules = [
            'name' => 'required|string|max:50',
            // unique ignorando el email del usuario actual
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            // password puede venir vacío (no actualizar) o si viene debe cumplir confirmación y longitud
            'password' => 'nullable|string|min:8|confirmed',
        ];

        $datos = $request->validate($rules);

        $user->name = $datos['name'];
        $user->email = $datos['email'];

        // Si el campo password viene y no está vacío, lo ciframos y actualizamos
        if (!empty($datos['password'])) {
            $user->password = bcrypt($datos['password']);
        }

        $user->save();

        // Ajusta la ruta de redirección según tus nombres de rutas; aquí uso edit como ejemplo
        return redirect()->route('users.show', $user->id)->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Impide que un usuario se elimine a sí mismo
        if (Auth::id() === $user->id) {
            return redirect()->back()->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $user->delete();

        // Ajusta la ruta de redirección según tu configuración (index/listado)
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
