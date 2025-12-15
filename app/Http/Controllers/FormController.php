<?php

namespace App\Http\Controllers;

use App\Models\FormUser;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = FormUser::all();
        return view('formulario.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('formulario/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. VALIDACIÓN BÁSICA (Asegura que los datos existan)
        $validated = $request->validate([
            'email' => 'required|email',
            'topic' => 'required|max:50',
            'description' => 'required|max:250',
        ]);

        $user = new FormUser(); //Se crea una instancia del modelo User
        $user->email = $request->email; //Se establecen los valores para cada columna de la tabla
        $user->topic = $request->topic;
        $user->description = $request->description;
        $user->save();

        // Mensaje de confirmación para el usuario
        $message = "El formulario se ha registrado en la base de datos";

         // Redirigir de nuevo al formulario con un mensaje de estado
        return redirect()->route('formulario.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    
}
