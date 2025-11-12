<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filename = 'formularios_enviados.csv';

        $formularios = [];

        if (Storage::disk('local')->exists($filename)) {
            // Leer todo el contenido del CSV
            $csvContent = Storage::disk('local')->get($filename);

            // Separar por líneas
            $lines = explode("\n", $csvContent);

            $firstLine = $lines[0];     // Tomamos la primera línea
            $headers = str_getcsv($firstLine); // Convertimos a array CSV
            array_shift($lines);         // Eliminamos la primera línea del array

            // Recorrer el resto de líneas y convertirlas en arrays asociativos
            foreach ($lines as $line) {
                if (!empty(trim($line))) { // Evitar líneas vacías
                    $formularios[] = array_combine($headers, str_getcsv($line));
                }
            }
        }
    // Pasar los formularios a la vista
    return view('formulario.index', compact('formularios'));
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

        // Nombre del archivo CSV que vamos a usar en storage/app/
        $filename = 'formularios_enviados.csv';

        // Preparar la línea del CSV sin escapar comillas
        $line = implode(',', [
            $validated['email'],
            $validated['topic'],
            $validated['description']
        ]) . "\n";

        if (!Storage::disk('local')->exists($filename)) {
            Storage::disk('local')->put($filename, "\"email\",\"topic\",\"description\"\n");
        }

        Storage::disk('local')->append($filename, trim($line));

        $message = "La nueva fila ha sido añadida al CSV existente.";

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
