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
        return $this->mostrarRegistros();
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

        // 2. PREPARAR LA LÍNEA DE DATOS
        $dataRow = [
            $validated['email'],
            $validated['topic'],
            $validated['description']
        ];

        $csvLine = implode(',', $dataRow) . "\n";

        // 3. LÓGICA: ¿EXISTE O NO EL ARCHIVO?
        $exists = Storage::exists($filename);

        if (!$exists) {
            $headers = ['Email', 'Tema', 'Descripción'];
            $headerLine = implode(',', $headers) . "\n";
            Storage::put($filename, $headerLine . $csvLine);
            $message = "El archivo CSV ha sido creado y la fila guardada.";
        } else {
            Storage::append($filename, $csvLine);
            $message = "La nueva fila ha sido añadida al CSV existente.";
        }

        // 4. REDIRECCIÓN a index (mejor que devolver la vista directamente)
        return redirect()->route('formulario.index')->with('status', $message);
    }

    // Leer contenido del .csv
    public function mostrarRegistros()
    {
        $filename = 'formularios_enviados.csv'; // ahora en storage/app/

        $records = [];
        $headers = [];

        // Comprobar si el archivo existe en storage/app/
        if (Storage::disk('local')->exists($filename)) {

            // Leer contenido completo del archivo
            $content = Storage::disk('local')->get($filename);

            // Normalizar y dividir líneas (soporta CRLF y LF)
            $lines = preg_split('/\r\n|\r|\n/', trim($content));

            foreach ($lines as $index => $line) {
                $line = trim($line);
                if ($line === '') continue;

                $data = str_getcsv($line, ',');

                if ($index === 0) {
                    $headers = $data;
                } else {
                    // Asegurar que el número de campos coincide con los encabezados
                    if (count($data) < count($headers)) {
                        $data = array_pad($data, count($headers), '');
                    } elseif (count($data) > count($headers)) {
                        // Si hay campos extra, concatenarlos en el último (por comas en la descripción)
                        $lastIndex = count($headers) - 1;
                        $first = array_slice($data, 0, $lastIndex);
                        $last  = implode(',', array_slice($data, $lastIndex));
                        $data  = array_merge($first, [$last]);
                    }

                    if (count($headers) === count($data)) {
                        $records[] = array_combine($headers, $data);
                    }
                }
            }
        }

        return view('formulario.index', [
            'headers' => $headers,
            'records' => $records,
        ]);
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
