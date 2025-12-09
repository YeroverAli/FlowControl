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
        // Recupera los usuarios de la base de datos usando el modelo User
        // y aplica paginación para limitar a 10 usuarios por página.
        $users = User::paginate(10);

        // Devuelve la vista 'admin.users.index' pasando la variable
        // 'users' (la colección paginada) para que la vista la muestre.
        return view('admin.users.index', compact('users'));
    }

    /**
     * Nos devuelve la vista para crear el usuario
     */
    public function create()
    {
        // Devuelve la vista que contiene el formulario para crear un nuevo usuario.
        // No hay lógica de negocio aquí: solo mostramos la vista.
        return view('admin.users.create');
    }

    /**
     * Validamos los datos con validate() y luego si está todo correcto lo almacenamos en la base de datos
     */
    public function store(Request $request)
    {
        // Validamos los datos que vienen en la petición.
        // Si la validación falla, Laravel redirige automáticamente
        // y muestra los errores en la sesión.
        $datos = $request->validate([
            // Nombre obligatorio, texto, máximo 50 caracteres
            'name' => 'required|string|max:50',
            // Email obligatorio, formato válido y único en la columna email de la tabla users
            'email' => 'required|email|unique:users,email',
            // Password obligatorio, mínimo 8 caracteres y debe venir con campo *_confirmation
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Creamos un nuevo modelo User (no persistido todavía)
        $user = new User();

        // Asignamos los valores validados al modelo
        $user->name = $datos['name'];
        $user->email = $datos['email'];

        // Nunca guardes la contraseña en claro: la ciframos con bcrypt
        $user->password = bcrypt($datos['password']);

        // Persistimos el usuario en la base de datos
        $user->save();

        // Redirigimos a la lista de usuarios con un mensaje flash de éxito
        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Mostramos en base la id única, todos los datos del usuario
     */
    public function show(string $id)
    {
        // Busca el usuario por su id; si no existe lanza un 404 automáticamente.
        $user = User::findOrFail($id);

        // Devuelve la vista de detalle, pasando el usuario encontrado.
        return view('admin.users.show', compact('user'));
    }

    /**
     * Enseña un pequeño formulario para editar un formulario en específico
     */
    public function edit(string $id)
    {
        // Recupera el usuario a editar; findOrFail lanza 404 si no existe.
        $user = User::findOrFail($id);

        // Muestra la vista de edición con los datos del usuario para precargar el formulario.
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Busca el usuario que queremos actualizar; lanza 404 si no existe
        $user = User::findOrFail($id);

        // Definimos las reglas de validación para los campos que pueden venir
        $rules = [
            // Nombre obligatorio y con máximo 50 caracteres
            'name' => 'required|string|max:50',
            // Email obligatorio, formato válido y único en la tabla users, excepto el usuario actual
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            // Password opcional: si se envía debe cumplir confirmación y longitud mínima
            'password' => 'nullable|string|min:8|confirmed',
        ];

        // Validamos la petición con las reglas definidas
        $datos = $request->validate($rules);

        // Asignamos los campos actualizables
        $user->name = $datos['name'];
        $user->email = $datos['email'];

        // Si se envía una nueva contraseña (no vacía), la ciframos y actualizamos
        if (!empty($datos['password'])) {
            $user->password = bcrypt($datos['password']);
        }

        // Guardamos los cambios en la base de datos
        $user->save();

        // Redirigimos al detalle del usuario con un mensaje de éxito
        return redirect()->route('users.show', $user->id)->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recupera el usuario por id; si no existe se lanza 404
        $user = User::findOrFail($id);

        // Evita que el usuario autenticado se elimine a sí mismo
        // Auth::id() devuelve el id del usuario actualmente autenticado
        if (Auth::id() === $user->id) {
            // Redirige de vuelta con un mensaje de error en la sesión
            return redirect()->back()->with('error', 'No puedes eliminar tu propio usuario.');
        }

        // Elimina el registro de la base de datos
        $user->delete();

        // Redirige a la lista de usuarios con un mensaje de éxito
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
